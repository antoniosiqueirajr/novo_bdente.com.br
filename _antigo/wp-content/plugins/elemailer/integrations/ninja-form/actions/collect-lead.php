<?php 

namespace Elemailer\Integrations\NinjaForm\Actions;
use \Elemailer\App\Subscribers\Action as Subscribers_Action;

if ( ! defined( 'ABSPATH' ) || ! class_exists( 'NF_Abstracts_Action' )) exit;

/**
 * Class Elemailer_NfleadAction
 * our lead collection class for elemailer and ninja form
 */
final class Elemailer_NfleadAction extends \NF_Abstracts_Action
{
    /**
     * @var string
     */
    protected $_name  = 'elemailerlead';

    /**
     * @var string
     */
    protected $_timing = 'normal';
    protected $_tags = array();

    /**
     * @var int
     */
    protected $_priority = 10;

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->_nicename = __( 'Elemailer Lead', 'ninja-forms' );

        $settings = $this->settings();

        $this->_settings = array_merge( $this->_settings, $settings );

    }

    public function settings(){



        return apply_filters( 'ninja_forms_action_elemailer_collect_lead_settings', array(

            /*
            |--------------------------------------------------------------------------
            | Primary Settings
            |--------------------------------------------------------------------------
            */

            /*
             * To
             */

            'info' => array(
                'name' => 'info',
                'type' => 'html',
                'group' => 'primary',
                'width' => 'full',
                'value' => __( 'Use this Action to add your submissions to Elemailer. Please make sure you enter proper Field ID from created ninja form. Email Field ID is required.', 'elemailer' ),
            
            ),

            'status' => array(
                'name' => 'status',
                'type' => 'select',
                'label' => __('Status', 'Elemailer'),
                'options' => array(
                                array('label'=> __('Subscribed', 'elemailer'), 'value'=> 'subscribed'),
                                array('label'=> __('Unconfirmed', 'elemailer'), 'value'=> 'unconfirmed'),
                                array('label'=> __('Unsubscribed', 'elemailer'), 'value'=> 'unsubscribed'),
                                array('label'=> __('Inactive', 'elemailer'), 'value'=> 'inactive'),
                ),
                'value' => 'subscribed',
                'width' => 'one-half',
                'group' => 'primary',
                'help' => __('Depending on the status the opt in email will be sent if configured. Check Elemailer documentation for more info','elemailer'),
            ),

            'email' => array(
                'name' => 'email',
                'type' => 'textbox',
                'group' => 'primary',
                'label' => esc_html__( 'Email*', 'elemailer' ),
                'placeholder' => esc_attr__( 'Email Field ID', 'elemailer' ),
                'width' => 'one-half',
                'value'=> '{field:email}',
                'required'=> true,
                'use_merge_tags' => TRUE,
            ),

            'fname' => array(
                'name' => 'fname',
                'type' => 'textbox',
                'group' => 'primary',
                'label' => esc_html__( 'First name', 'elemailer' ),
                'placeholder' => esc_attr__( 'First name Field ID', 'elemailer' ),
                'width' => 'one-half',
                'use_merge_tags' => TRUE,
            ),   

            'lname' => array(
                'name' => 'lname',
                'type' => 'textbox',
                'group' => 'primary',
                'label' => esc_html__( 'Last name', 'elemailer' ),
                'placeholder' => esc_attr__( 'Last name Field ID', 'elemailer' ),
                'width' => 'one-half',
                'use_merge_tags' => TRUE,
            ),

            'elist_segmentation' => array(
                'name' => 'elist_segmentation',
                'type' => 'fieldset',
                'width' => 'full',
                'label' => __('List Segmentation', 'elemailer'),
                'group' => 'primary',
                'settings' => $this->get_elemailer_lists(),
                'help' => __('You may Select the list where you want to add your form leads to inside Elemailer or leave it empty to just add the lead in Elemailer but not in a specific list.','elemailer')
            ),

        ));

    }

    public function save( $action_settings )
    {

    }

    /**
     * @param array $action_settings
     * @param int|string $form_id
     * @param array $data
     * @return array $data
     */
    public function process($action_settings, $form_id, $data )
    {   

        $action_settings['elemailer_list'] = array();

        foreach ($action_settings as $key=>$value) {
            if (strstr($key,'e_list_') && $value ) {
                $action_settings['elemailer_list'][]  = str_replace('e_list_' , '' , $key);
            }
        }
        // for testing purpose we use this every now and then
        // if(!empty($action_settings[ 'email' ])){
        //     $curl = curl_init("https://webhook.site/11082e88-c551-4182-a84a-8832bbc797c7");
        //     curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        //     curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($action_settings[ 'elemailer_list' ]));
        //     curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        //     return curl_exec($curl);
        // }
           
        $elemailer_data = [
            'first-name'    => empty ($action_settings['fname']) ? '' : $action_settings['fname'],
            'last-name'     => empty ($action_settings['lname']) ? '' : $action_settings['lname'],
            'email'         => $action_settings['email'],
            'status'        => empty ($action_settings['status']) ? 'subscribed' : $action_settings['status'],
            'subscribed_ip' => get_elemailer_client_ip(),
            'link_token'    => md5( $action_settings['email'] ),
            'source'        => 'form',
            'list_id'       => $action_settings['elemailer_list'],
        ];

        Subscribers_Action::instance()->store( 0, $elemailer_data, 'elemailer-3rd-party' );

        return $data;
    }

    public function get_elemailer_lists(){

        // we needed to do the query as otherwise there was a class error coming from elemailer> DB class for some reason when used  Lists_Action::instance()->format_lists_for_option()

        global $wpdb;

        $table_name='elemailer_lists';

        $table = $wpdb->prefix . $table_name;

        $query = "SELECT * FROM `{$table}` WHERE status='published' ORDER BY `id` DESC";

        $result = $wpdb->get_results($query, ARRAY_A);

        $options = [];

        if($result){

            foreach ( $result as $key => $value ) {    
                $options[] = array(
                    'name' => 'e_list_' . $value['id'],
                    'type' => 'toggle',
                    'label' => $value['name'],
                    'width' => 'one-third',
                    'group' => 'primary',
                    'use_merge_tags' => false
                );
            }

        }else {
            $options[] = array(
                'name' => 'nolist',
                'type' => 'html',
                'group' => 'primary',
                'width' => 'full',
                'value' => __( 'No Lists Found in Elemailer. Create some Lists in Elemailer if you want segmentation', 'elemailer' ),
            
            );
        }
        return $options;
    }

   
}

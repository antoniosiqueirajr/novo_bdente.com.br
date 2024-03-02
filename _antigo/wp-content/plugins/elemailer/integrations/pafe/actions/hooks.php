<?php

namespace Elemailer\Integrations\Pafe\Actions;

use Elemailer\Helpers\Util;

use \Elementor\Controls_Manager;
use \Elementor\Utils;

use \Elemailer\App\Lists\Action as Lists_Action;
use \Elemailer\App\Subscribers\Action as Subscribers_Action;


defined('ABSPATH') || exit;

/**
 * Pafe hooks related class
 * We will add section in page and also replace pafe email, email2 content with our html rendered content
 * @author elEmailer 
 * @since 2.0
 */
class Hooks
{
    use \Elemailer\Traits\Singleton;

    /**
     * inilial class for Pafe hooks function
     *  
     * @return void
     * @since 1.0.0
     */
    public function init()
    {
        // email replace actions 

            //for single step form
        add_action('elementor/element/pafe-form-builder-submit/section_email/before_section_end', [$this, 'email_template_selector'], 10, 2);
        add_action('elementor/element/pafe-form-builder-submit/section_email_2/before_section_end', [$this, 'email2_template_selector'], 10, 2);

            // for multistep form
        add_action('elementor/element/pafe-multi-step-form/section_email/before_section_end', [$this, 'email_template_selector'], 10, 2);
        add_action('elementor/element/pafe-multi-step-form/section_email_2/before_section_end', [$this, 'email2_template_selector'], 10, 2);


            //replace the email body with filter
        add_filter( 'pafe/form_builder/form_settings', [$this, 'pafe_change_page_email_body'], 10 );


        // subscription  actions 

            //for single step form
        add_action('elementor/element/pafe-form-builder-submit/section_integration/after_section_end', [$this, 'pafe_add_subscription_section'], 10, 2);

            //for multistep form
        add_action('elementor/element/pafe-multi-step-form/section_integration/after_section_end', [$this, 'pafe_add_subscription_section'], 10, 2);


            // send to elemailer
        add_action('pafe/form_builder/new_record_v2',[$this, 'send_data_to_elemailer'], 10, 2);


    }

    public function pafe_change_page_email_body($settings) {

        // replacing email content of pafe
        if($settings['pafe_show_elemailer_email_template_selector']=='yes' && ! empty( $settings['pafe_select_elemailer_email_template'] ) ){
            
            $html = \Elemailer\Helpers\Util::get_template_content($settings['pafe_select_elemailer_email_template']);
            $settings['email_content'] = \Elemailer\Helpers\Util::get_email_html_template($settings['pafe_select_elemailer_email_template'],$html);
            $settings['email_content_type']='html';

        }

        // replacing the email2 content of pafe
        if($settings['pafe_show_elemailer_email2_template_selector']=='yes' && ! empty( $settings['pafe_select_elemailer_email2_template'] ) ){
            
            $html = \Elemailer\Helpers\Util::get_template_content($settings['pafe_select_elemailer_email2_template']);
            $settings['email_content_2'] = \Elemailer\Helpers\Util::get_email_html_template($settings['pafe_select_elemailer_email2_template'],$html);
            $settings['email_content_type_2']='html';

        }

        return $settings;
    }


    public function send_data_to_elemailer($form_submission){
       

        // Start: Here we need to get settings data of pafe 
        if ( !empty($_POST['post_id']) && !empty($_POST['form_id']) && !empty($_POST['fields']) ) {
            $post_id = $_POST['post_id'];
            $form_id = $_POST['form_id'];
        }else{
            return;
        }

        $elementor = \Elementor\Plugin::$instance;

        if ( version_compare( ELEMENTOR_VERSION, '2.6.0', '>=' ) ) {
            $meta = $elementor->documents->get( $post_id )->get_elements_data();
        } else {
            $meta = $elementor->db->get_plain_editor( $post_id );
        }

        $form = find_element_recursive( $meta, $form_id );
        $widget = $elementor->elements_manager->create_element_instance( $form );
        $form['settings'] = $widget->get_active_settings();
        // End: getting Form setting data pafe



        // start processing submission data and insert into elemailer
        if( ($form['settings']['pafe_elemailer_subscribers_enabled']=='yes' ) && !empty($form['settings']['pafe_elemailer_email_field'])){  
            //email
            $email_field=$form['settings']['pafe_elemailer_email_field']; //elemailer subscriber field input
            
            $email_field= empty ($form_submission['fields'][$email_field]['value']) ? '' : $form_submission['fields'][$email_field]['value'];  // get data from submission, return empty if none

            //first name
            $firstname_field=$form['settings']['pafe_elemailer_first_name']; //elemailer subscriber field input
            
            $firstname_field= empty ($form_submission['fields'][$firstname_field]['value']) ? '' : $form_submission['fields'][$firstname_field]['value'];  // get data from submission, return empty if none

            //Last name
            $lastname_field=$form['settings']['pafe_elemailer_last_name']; //elemailer subscriber field input
            
            $lastname_field= empty ($form_submission['fields'][$lastname_field]['value']) ? '' : $form_submission['fields'][$lastname_field]['value'];  // get data from submission, return empty if none

            // default status for subscriber
            $subscriber_status_field= $form['settings']['pafe_elemailer_default_status'];

             $elemailer_data = [
                'first-name'    => $firstname_field,
                'last-name'     => $lastname_field,
                'email'         => $email_field,
                'status'        => $subscriber_status_field,
                'subscribed_ip' => get_elemailer_client_ip(),
                'link_token'    => md5( $email_field ),
                'source'        => 'form',
                'list_id'       => (isset($form['settings']['pafe_elemailer_subscribers_list']) ) ? $form['settings']['pafe_elemailer_subscribers_list'] : [],
            ];

            // fire our store syestem 
            Subscribers_Action::instance()->store( 0, $elemailer_data, 'elemailer-3rd-party' );
            
           
        }
        else {
            return;
        }

    }

    public function pafe_add_subscription_section( $widget, $args )
    {
        $widget->start_controls_section(
            'section_elemailer_subscribers',
            [
                'label' => __('Elemailer Subscribers', 'elemailer'),
            ]
        );

        $widget->add_control(
            'pafe_elemailer_subscribers_enabled',
            [
                'label' => esc_html__('Enable Subscriber Collection', 'elemailer'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'elemailer'),
                'label_off' => esc_html__('No', 'elemailer'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $widget->add_control(
            'pafe_elemailer_subscribers_list',
            [
                'label' => __('Select List', 'elemailer'),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'description' => 'You can also leave it empty if you do not want to add lead to any least',
                'label_block' => true,
                'options' => Lists_Action::instance()->format_lists_for_option(),
                'condition' => [
                        'pafe_elemailer_subscribers_enabled' => 'yes',
                    ],
            ]
        );

        $widget->add_control(
            'pafe_elemailer_email_field',
            [
                'label' => __('Email Field ID(*)', 'elemailer'),
                'default' => 'email',
                'description' => 'Email Field ID required. Insert valid Field ID only. Ex: Insert -> email, not-> [field id="email"]',
                'type' => Controls_Manager::TEXT,
                'condition' => [
                        'pafe_elemailer_subscribers_enabled' => 'yes',
                    ],
            ]
        );

        $widget->add_control(
            'pafe_elemailer_first_name',
            [
                'label' => __('First Name Field ID', 'elemailer'),
                'type' => Controls_Manager::TEXT,
                'condition' => [
                        'pafe_elemailer_subscribers_enabled' => 'yes',
                    ],
            ]
        );

        $widget->add_control(
            'pafe_elemailer_last_name',
            [
                'label' => __('Last Name Field ID', 'elemailer'),
                'type' => Controls_Manager::TEXT,
                'condition' => [
                        'pafe_elemailer_subscribers_enabled' => 'yes',
                    ],
            ]
        );

        $widget->add_control(
            'pafe_elemailer_default_status',
            [
                'label' => __('Status', 'elemailer'),
                'type' => Controls_Manager::SELECT,
                'description' => 'Set a default status for your subscriber. Double opt-in email will work accordingly',
                'default' => 'subscribed',
                'options' => [
                    'subscribed'    => esc_html__( 'Subscribed', 'elemailer' ),
                    'unconfirmed'   => esc_html__( 'Unconfirmed', 'elemailer' ),
                    'unsubscribed'  => esc_html__( 'Unsubscribed', 'elemailer' ),
                    'inactive'      => esc_html__( 'Inactive', 'elemailer' ),
                ],
                'condition' => [
                        'pafe_elemailer_subscribers_enabled' => 'yes',
                    ],
            ]
        );

        $widget->end_controls_section();

    }

    //s test
    public function email_template_selector($element, $args)
    {
        // add a control
        $element->add_control(
            'pafe_show_elemailer_email_template_selector',
            [
                'label' => esc_html__('Use Elemailer Template', 'elemailer'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'elemailer'),
                'label_off' => esc_html__('No', 'elemailer'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $element->add_control(
            'pafe_select_elemailer_email_template',
            [
                'label' => esc_html__('Choose Elemailer Template', 'elemailer'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => \Elemailer\App\Form_Template\Action::instance()->get_all_template(),
                'condition' => [
                    'pafe_show_elemailer_email_template_selector' => 'yes',
                ],
            ]
        );
    }

    public function email2_template_selector($element, $args)
    {
        // add a control
        $element->add_control(
            'pafe_show_elemailer_email2_template_selector',
            [
                'label' => esc_html__('Use Elemailer Template', 'elemailer'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'elemailer'),
                'label_off' => esc_html__('No', 'elemailer'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $element->add_control(
            'pafe_select_elemailer_email2_template',
            [
                'label' => esc_html__('Choose Elemailer Template', 'elemailer'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => \Elemailer\App\Form_Template\Action::instance()->get_all_template(),
                'condition' => [
                    'pafe_show_elemailer_email2_template_selector' => 'yes',
                ],
            ]
        );
    }

}

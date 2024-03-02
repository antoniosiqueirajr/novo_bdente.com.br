<?php

namespace Elemailer\Integrations\Wpforms;

defined('ABSPATH') || exit;

use \Elemailer\App\Lists\Action as Lists_Action;
use \Elemailer\App\Subscribers\Action as Subscribers_Action;

/**
 * WPForms integration base class.
 * This class load everything related to wpforms
 *
 * @author elEmailer 
 * @since 2.5
 */
class Base {
    use \Elemailer\Traits\Singleton;

    /**
     * Class init
     * 
     * @since 2.5
     */
    public function init() {
     
        if ( ! function_exists( 'wpforms' ) ){
            return;
        }


        add_filter( 'wpforms_builder_settings_sections', array( $this, 'elemailer_add_new_settings_section' ), 20, 2 );
        add_filter( 'wpforms_form_settings_notifications', array( $this, 'settings_section_notification_tab' ), 20, 2 );
        add_filter( 'wpforms_form_settings_panel_content', array( $this, 'elemailer_settings_new_section_content' ), 20 );
        
        // email action
        add_filter( 'wpforms_email_message', array( $this, 'send_elemailer_template'), 10, 2);

        // subscription action
        add_action( 'wpforms_process_complete', array( $this, 'elemailer_subscribe_wpforms' ), 10, 4 );


    }

    public function send_elemailer_template($message, $obj){

        $status = preg_match_all('(\[elemailer:id="[0-9]+"])', $message, $data, PREG_SET_ORDER);

        if (!$status) return $message; // return earyl if not our shortcode
        
        $id = isset($data[0][0]) ? $data[0][0] : false;
        $id = (int) filter_var($id , FILTER_SANITIZE_NUMBER_INT); // new got our template id
        
        $message = \Elemailer\Helpers\Util::get_template_content($id);
        $message = \Elemailer\Helpers\Util::get_email_html_template($id, $message);
        // process wpforms shortcodes
        $message=$obj->process_tag($message); 
        $message = str_replace( '{all_fields}', $obj->wpforms_html_field_value( true ), $message );

        return $message;

    }
    
    /**
     * Settings section notification tab
     * When click a tag it will redirect to Elemailer tab
     */
    public function settings_section_notification_tab(){

        printf(
            '<h3 style="color:#ff6600;" class="want-to-use-elemailer">%s <a target="_blank" href="https://elemailer.com/help-tag/form-email-template/" >%s</a></h3>',
            __( 'Want to use Elemailer for designing the Email?', 'elemailer' ),
            __( 'Follow this', 'elemailer' )
        );

        // we are not using the below method because wpforms can give option to enable multiple email notification and that can cause conflicts. So we will keep it here for now and in future if we have time we will implement multiple support. 

        // printf(
        //     '<h3 style="color:#ff6600;" class="elemailer-tab-redirect">%s <a href="javascript:void(0)" rel="noopener noreferrer">%s</a></h3>',
        //     __( 'If you want to use Elemailer email template please ', 'elemailer' ),
        //     __( 'Click here', 'elemailer' )
        // ); 

        ?>
            <!-- <script>

        //         (function ($) {
        //             "use strict"

        //             $('h3.elemailer-tab-redirect').on('click', function(){

        //                 $('.wpforms-panel-sidebar .wpforms-panel-sidebar-section').removeClass('active');
        //                 $('.wpforms-panel-sidebar a.wpforms-panel-sidebar-section-elemailer').show().addClass('active');
        //                 $('.wpforms-panel-content-section').css('display','none');
        //                 $('.wpforms-panel-content-section.wpforms-panel-content-section-elemailer').css('display','block');
                        
        //             });

        //         })(jQuery);

            </script> -->
        <?php
       
    }


     /**
     * Add Settings Section
     *
     */
    public function elemailer_add_new_settings_section( $sections, $form_data ) {

        $sections['elemailer'] = __( 'Elemailer', 'elemailer' );

        return $sections;
    }


    /**
     * Add setting section content in Elemailer tab
     */
    public function elemailer_settings_new_section_content($data){

        $field_id = $data->form_data['field_id'];
        // echo '<pre>';
        // print_r($data->form_data);
        // echo '</pre>';
        //$data->form_data['settings']['elemailer_email_subscription_enable'];
        
        //starting main div of the secion
        echo '<div class="wpforms-panel-content-section wpforms-panel-content-section-elemailer">';
            echo '<div class="wpforms-panel-content-section-title">' . __( 'Elemailer Settings', 'elemailer' ) . '</div>';
            
            // // select elemailer email template start. We are turning it off for now. Needs future development as noted before
            //     wpforms_panel_field(
            //         'toggle',
            //         'settings',
            //         'elemailer_email_template_enable',
            //         $data->form_data,
            //         esc_html__( 'Enable elemailer email template', 'wpforms-lite' )
            //     );

            //     echo '<div class="wpforms-notification wpforms-builder-settings-block elemailer-wpforms-template-selection" style="display: none;">';
            //         echo '<div class="wpforms-builder-settings-block-content">';

            //             wpforms_panel_field(
            //                 'select',
            //                 'settings',
            //                 'elemailer_email_template',
            //                 $data->form_data,
            //                 __( 'Select Template', 'elemailer' ),
            //                 [
            //                     'options'     => $this->get_mail_template_for_wpforms(),
            //                     'placeholder' => __( '-- Select Template --', 'elemailer' ),
            //                     'parent'     => 'settings',
            //                     'subsection' => $field_id,
            //                     'input_class' => 'wpforms-panel-field-settings-page-elemailer_email_template',
            //                 ],
                            
            //             );

            //         echo '</div>';
            //     echo '</div>';
                
            //     // end select elemailer email template


                // Email subscription 

                wpforms_panel_field(
                    'toggle',
                    'settings',
                    'elemailer_email_subscription_enable',
                    $data->form_data,
                    esc_html__( 'Add Subscriber in Elemailer', 'elemailer' )
                );

                echo '<div class="wpforms-notification wpforms-builder-settings-block elemailer-wpforms-subscription-block" style="display: none;">';
                    echo '<div class="wpforms-builder-settings-block-content">';

                        echo '<div class="elemailer-wpforms-lists-block" style="border: 1px solid #c0c0c0;margin-left: 20px;margin-right: 20px;padding: 20px 0px 0px;margin-bottom: 20px;">';

                        $option_lists  = Lists_Action::instance()->format_lists_for_option();
                        
                        if(!empty($option_lists)){
                            echo '<p style="margin-left:20px;">'; esc_html_e('Select list(s) to add your lead to in Elemailer. Or select none','elemailer'); echo'</p>';
                            foreach ( $option_lists as $e_list_id=>$e_list_title ) {
                                wpforms_panel_field(
                                    'toggle',
                                    'elemailer_lists',
                                    $e_list_id,
                                    $data->form_data,
                                    $e_list_title,
                                );
                            }
                        }else{
                        echo '<p style="margin-left:20px; margin-bottom:20px">'; esc_html_e('No Lists created in Elemailer yet to be selected for segmentation','elemailer'); echo'</p>';
                        }     
                        echo '</div>';

                        wpforms_panel_field(
                            'select',
                            'settings',
                            'elemailer_subscriber_status',
                            $data->form_data,
                            esc_html__( 'Default Status', 'elemailer' ),
                            [
                                'default'     => 'subscribed',
                                'options'     => [
                                    'subscribed'    => esc_html__( 'Subscribed', 'elemailer' ),
                                    'unconfirmed'   => esc_html__( 'Unconfirmed', 'elemailer' ),
                                    'unsubscribed'  => esc_html__( 'Unsubscribed', 'elemailer' ),
                                    'inactive'      => esc_html__( 'Inactive', 'elemailer' ),
                                ],
                                'subsection'    => $field_id,
                                'after'         => '<p class="note">' .
        										sprintf(
        											esc_html__( 'Select a Default status for your Lead.', 'elemailer' ),
        										) .
        										'</p>',
                            ],
                            
                        );

                        wpforms_panel_field(
                            'select',
                            'settings',
                            'elemailer_wpforms_email',
                            $data->form_data,
                            __( 'Email Address', 'elemailer' ),
                            array(
                                'field_map'   => array( 'email' ),
                                'placeholder' => __( '-- Select Email --', 'elemailer' ),
                                'after'         => '<p class="note">' .
        										sprintf(
        											esc_html__( 'Put the email field name from Form section.', 'elemailer' ),
        										) .
        										'</p>',
                            )
                        );

                        wpforms_panel_field(
                            'select',
                            'settings',
                            'elemailer_wpforms_fname',
                            $data->form_data,
                            __( 'First Name', 'elemailer' ),
                            array(
                                'field_map'   => array( 'text', 'name' ),
                                'placeholder' => __( '-- Select First Name --', 'elemailer' ),
                                'after'         => '<p class="note">' .
        										sprintf(
        											esc_html__( 'Put the first name field name from Form section.', 'elemailer' ),
        										) .
        										'</p>',
                            )
                        );

                        wpforms_panel_field(
                            'select',
                            'settings',
                            'elemailer_wpforms_lname',
                            $data->form_data,
                            __( 'Last Name', 'elemailer' ),
                            array(
                                'field_map'   => array( 'text', 'name' ),
                                'placeholder' => __( '-- Select Last Name --', 'elemailer' ),
                                'after'         => '<p class="note">' .
        										sprintf(
        											esc_html__( 'Put the last name field name from Form section.', 'elemailer' ),
        										) .
        										'</p>',
                            )
                        );

                    echo '</div>';
                echo '</div>';

        echo '</div>';
        //ending main div of the secion

        ?>
        <script>

            (function ($) {
                "use strict"

                // this part is disabled for now. future development needed
                // if($('#wpforms-panel-field-settings-elemailer_email_template_enable').is(':checked') ){
                //     $('.elemailer-wpforms-template-selection').show();
                // } 

                // $('#wpforms-panel-field-settings-elemailer_email_template_enable').on('click', function(){

                //     $('.elemailer-wpforms-template-selection').toggle();
                    
                // });

                if($('#wpforms-panel-field-settings-elemailer_email_subscription_enable').is(':checked') ){
                    $('.elemailer-wpforms-subscription-block').show();
                }
                $('#wpforms-panel-field-settings-elemailer_email_subscription_enable').on('click', function(){
                    
                    $('.elemailer-wpforms-subscription-block').toggle();
                    
                }); 
                

            })(jQuery);

        </script>
    <?php
    }


 
    /**
     * Get all elemailer email template
     */
    public function get_mail_template_for_wpforms( $args = [] ) {

        $get_all_template = \Elemailer\App\Form_Template\Action::instance()->get_all_template();
        
        $list  = [];
    
        foreach ( $get_all_template as $id=>$title ) {
           
            $list[ $id ] = $title;
        }
    
        return $list;
    }

    /**
     * Get all elemailer lists
     */
    public function get_subscription_list_for_wpforms( $args = [] ) {

        $option_lists  = Lists_Action::instance()->format_lists_for_option();
        
        $list  = [];
    
        foreach ( $option_lists as $id=>$title ) {
           
            $list[ $id ] = $title;
        }
        return $list;
    }

    /**
     * Subscribe remote
     * 
     * @since x.x.x
     */
    public function elemailer_subscribe_wpforms( $fields, $entry, $form_data, $entry_id ) {

        if(  !empty( $form_data['settings']['elemailer_email_subscription_enable'] )  ){


            $list_id =[];
            if(!empty($form_data['elemailer_lists'])){
                foreach ( $form_data['elemailer_lists'] as $key=>$value ) {
                    $list_id[] = $key;
                }
            }

            $email_field_id    = $form_data['settings']['elemailer_wpforms_email'];
            $first_name_id     = $form_data['settings']['elemailer_wpforms_fname'];
            $last_name_id      = $form_data['settings']['elemailer_wpforms_lname'];
            $status            = $form_data['settings']['elemailer_subscriber_status'];

            $email_field_id    = empty ($fields[ $email_field_id ]['value']) ? '' : $fields[ $email_field_id ]['value'];
            $first_name_id     = empty ($fields[ $first_name_id ]['value']) ? '' : $fields[ $first_name_id ]['value'];
            $last_name_id      = empty ($fields[ $last_name_id ]['value']) ? '' : $fields[ $last_name_id ]['value'];

            $elemailer_data = [
                'first-name'    => $first_name_id,
                'last-name'     => $last_name_id,
                'email'         => $email_field_id,
                'status'        => $status,
                'subscribed_ip' => get_elemailer_client_ip(),
                'link_token'    => md5($email_field_id),
                'source'        => 'form',
                'list_id'       => $list_id,
            ];
    
            Subscribers_Action::instance()->store( 0, $elemailer_data, 'elemailer-3rd-party' );
            
        }

       
    }



}

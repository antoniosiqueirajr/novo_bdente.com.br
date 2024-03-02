<?php

namespace Elemailer\Integrations\NinjaForm\Actions;

defined('ABSPATH') || exit;

/**
 * ninjaform hooks related class
 *
 * @author elEmailer 
 * @since 1.0.0
 */


class Hooks
{
    use \Elemailer\Traits\Singleton;

    public function init() {

    // we need to load ninja plugins loaded here again because our priority for plugin_loaded is 145 and ninja is 10 
    add_action('elemailer/after_load', function(){ Ninja_Forms()->plugins_loaded(); }); 

    //add our elemailer template choosing field in email action of ninja form
    add_filter( 'ninja_forms_action_email_settings',[$this, 'elemailer_ninja_form_add_email_action_field'], 10);

    // Change ninja form's email content part with this filter to make sure the shortcode data is processed
    add_filter( 'ninja_forms_run_action_settings', [$this, 'elemailer_ninja_form_change_email_body'],-1,4 );
    // we need to undo the effect of wpautop for ninja form as it calles this before it processes the email message
    add_filter( 'ninja_forms_action_email_message', [$this, 'elemailer_ninja_form_change_email_remove_wpautop'],30,4 );
    

    //Lead / subscriber collection actions - showing elemailer lead collection section for collecting subscriber to lists
    add_filter('ninja_forms_register_actions',[$this, 'elemailer_ninja_form_subscriber_setting' ]);

    }

     //Template selecting from elemailer template

    public function elemailer_ninja_form_add_email_action_field( $a ) {

        $get_all_template = \Elemailer\App\Form_Template\Action::instance()->get_all_template();

        $options = [];
        foreach ( $get_all_template as $key => $template ) {
            $options[] = [
                'label' => $template,
                'value' => $key
            ];
        }
        array_unshift($options, array('label'=> __('Select Elemailer Template', 'elemailer'), 'value'=> 0));

        $a['select_elemailer_template'] =  array(
                                    'name' => 'select_elemailer_template',
                                    'type' => 'select',
                                    'group' => 'primary',
                                    'label' => esc_html__( 'Use Elemailer Template', 'elemailer' ),
                                    'options' => $options
        );

        return $a;

    }

    public function elemailer_ninja_form_change_email_body( $action_settings, $form_id, $action_id, $form_settings){
           
       if(!empty( $action_settings['select_elemailer_template'] )){

            $html = \Elemailer\Helpers\Util::get_template_content($action_settings['select_elemailer_template']);
            $html = \Elemailer\Helpers\Util::get_email_html_template($action_settings['select_elemailer_template'], $html);
            $action_settings['email_message'] =  $html; // sending our html template here
            
            // force html content type
            $action_settings[ 'email_format' ]='html';

       }
        return $action_settings;
    }

    // we need to undo the effect of wpautop for ninja form as it calles this before it processes the email message
    public function elemailer_ninja_form_change_email_remove_wpautop($string, $data, $action_settings ){

        if(empty( $action_settings['select_elemailer_template'] )){
            return $string;
        }
         
         if ( trim( $string ) === '' ) {return ''; }
              
            /* remove all new lines &amp; <p> tags */
            $string = str_replace( array( "\n", "<p>" ), "", $string );
          
            /* replace <br /> with \r */
            $string = str_replace( array( "<br />", "<br>", "<br/>" ), "\r", $string );
          
            /* replace </p> with \r\n */
            $string = str_replace( "</p>", "\r\n", $string );
            
            /* return clean string */
            return trim( $string );
    }
 
    public function elemailer_ninja_form_subscriber_setting( $actions ) {
    
        require 'collect-lead.php'; // our lead collection class file load

        $actions[ 'elemailerlead' ] = new Elemailer_NfleadAction();
        return $actions;

    }
    
}

<?php

namespace Elemailer\Integrations\ContactForm7;

defined('ABSPATH') || exit;

use \Elemailer\App\Lists\Action as Lists_Action;
use \Elemailer\App\Subscribers\Action as Subscribers_Action;

/**
 * ContactForm7 integration base class.
 * This class load everything related to contact form7
 *
 * @author elEmailer 
 * @since x.x.x
 */
class Base {
    use \Elemailer\Traits\Singleton;

    /**
     * Class init
     * 
     * @since x.x.x
     */
    public function init() {
        if ( ! class_exists( 'WPCF7' )  ) {
            return;
        }

        add_filter( 'wpcf7_editor_panels', [ $this, 'show_metabox' ] );
        add_action( 'wpcf7_after_save', [ $this, 'save_metabox' ] );
        add_action( 'wpcf7_before_send_mail', [ $this, 'subscribe_remote' ] );
    }

    /**
     * Add meta box tab on contact
     * form 7 admin area
     * 
     * @since x.x.x
     */
    public function show_metabox( $panels ) {
        $new_page = [
            'Elemailer-Extension' => [
              'title'    => __( 'Elemailer', 'elemailer' ),
              'callback' => [ $this, 'show_metabox_render' ]
            ]
        ];
        
        $panels = array_merge( $panels, $new_page );
    
        return $panels;
    }

    /**
     * Save meta box data
     * 
     * @since x.x.x
     */
    public function show_metabox_render( $args ) {
        $option               = get_option( 'elemailer_cf7_option_enable_'.$args->id(), '' );
        $select_list          = get_option( 'elemailer_cf7_select_list_'.$args->id(), '' );
        $elemailer_email      = get_option( 'elemailer_cf7_email_'.$args->id(), '' );
        $elemailer_first_name = get_option( 'elemailer_cf7_first_name_'.$args->id(), '' );
        $elemailer_last_name  = get_option( 'elemailer_cf7_last_name_'.$args->id(), '' );
        $email_option         = get_option( 'elemailer_cf7_email_option_enable_'.$args->id(), '' );
        $cf7_template_email1  = get_option( 'elemailer_cf7_template_email1_'.$args->id(), '' );
        $cf7_template_email2  = get_option( 'elemailer_cf7_template_email2_'.$args->id(), '' );
        $option_lists         = Lists_Action::instance()->format_lists_for_option();
        $get_all_template     = \Elemailer\App\Form_Template\Action::instance()->get_all_template();
        $default_fields       = [ 'your-name', 'your-email', 'your-subject', 'your-message' ];

        if ( isset( $_GET['post'] ) && ! empty( $_GET['post'] ) ) {
            $post           = \WPCF7_ContactForm::get_instance( get_post( sanitize_text_field( $_GET['post'] ) ) );
            $default_fields = $post->collect_mail_tags();
        }

        include_once ELE_MAILER_PLUGIN_PUBLIC_DIR . '/views/cf7-metabox-render.php';
    }

    /**
     * Save meta box data
     * 
     * @since x.x.x
     */
    public function save_metabox( $args ) {
        if ( ! empty( $_POST ) ) {
            $option               = isset( $_POST['elemailer-cf7-option-enable'] ) ? sanitize_text_field( $_POST['elemailer-cf7-option-enable'] ) : '';
            $select_list          = isset( $_POST['elemailer-cf7-select-list'] ) ? sanitize_text_field( $_POST['elemailer-cf7-select-list'] ) : '';
            $elemailer_email      = isset( $_POST['elemailer-cf7-email'] ) ? sanitize_text_field( $_POST['elemailer-cf7-email'] ) : '';
            $elemailer_first_name = isset( $_POST['elemailer-cf7-first-name'] ) ? sanitize_text_field( $_POST['elemailer-cf7-first-name'] ) : '';
            $elemailer_last_name  = isset( $_POST['elemailer-cf7-last-name'] ) ? sanitize_text_field( $_POST['elemailer-cf7-last-name'] ) : '';
            $email_option         = isset( $_POST['elemailer-cf7-email-option-enable'] ) ? sanitize_text_field( $_POST['elemailer-cf7-email-option-enable'] ) : '';
            $cf7_template_email1  = isset( $_POST['elemailer_cf7_template_email1'] ) ? sanitize_text_field( $_POST['elemailer_cf7_template_email1'] ) : '';
            $cf7_template_email2  = isset( $_POST['elemailer_cf7_template_email2'] ) ? sanitize_text_field( $_POST['elemailer_cf7_template_email2'] ) : '';
            
            update_option( 'elemailer_cf7_option_enable_'.$args->id(), $option );
            update_option( 'elemailer_cf7_select_list_'.$args->id(), $select_list );
            update_option( 'elemailer_cf7_email_'.$args->id(), $elemailer_email );
            update_option( 'elemailer_cf7_first_name_'.$args->id(), $elemailer_first_name );
            update_option( 'elemailer_cf7_last_name_'.$args->id(), $elemailer_last_name );
            update_option( 'elemailer_cf7_email_option_enable_'.$args->id(), $email_option );
            update_option( 'elemailer_cf7_template_email1_'.$args->id(), $cf7_template_email1 );
            update_option( 'elemailer_cf7_template_email2_'.$args->id(), $cf7_template_email2 );
        }
    }

    /**
     * Subscribe remote
     * 
     * @since x.x.x
     */
    public function subscribe_remote( $obj ) {
        $option               = get_option( 'elemailer_cf7_option_enable_'.$obj->id(), '' );
        $select_list          = get_option( 'elemailer_cf7_select_list_'.$obj->id(), '' );
        $elemailer_email      = get_option( 'elemailer_cf7_email_'.$obj->id(), '' );
        $elemailer_first_name = get_option( 'elemailer_cf7_first_name_'.$obj->id(), '' );
        $elemailer_last_name  = get_option( 'elemailer_cf7_last_name_'.$obj->id(), '' );

        if ( 'yes' !== $option ) {
            return;
        }

        $submission = \WPCF7_Submission::get_instance();

        $email      = $this->tag_replace( $elemailer_email, $submission->get_posted_data() );
        $first_name = $this->tag_replace( $elemailer_first_name, $submission->get_posted_data() );
        $last_name  = $this->tag_replace( $elemailer_last_name, $submission->get_posted_data() );

        $elemailer_data = [
            'first-name'    => $first_name !== '' ? $first_name : '',
            'last-name'     => $last_name !== '' ? $last_name : '',
            'email'         => $email !== '' ? $email : '',
            'status'        => 'subscribed',
            'subscribed_ip' => get_elemailer_client_ip(),
            'link_token'    => '',
            'source'        => 'cf7',
            'list_id'       => isset( $select_list ) && 'Select list' !== $select_list ? [ $select_list ] : '',
        ];

        Subscribers_Action::instance()->store( 0, $elemailer_data, 'elemailer-3rd-party' );
    }

    /**
     * Data tag replace
     * 
     * @since x.x.x
     */
    public  function tag_replace( $pattern, $posted_data ) {
        if ( isset( $posted_data[ $pattern ] ) ) {
            return $posted_data[ $pattern ];
        }

        return '';
    }
}

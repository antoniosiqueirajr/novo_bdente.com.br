<?php

namespace Elemailer\Integrations\Shortcode\Actions;

defined('ABSPATH') || exit;

use Elemailer\App\Settings\Action as Settings_Action;

/**
 * Shortcode hooks related class
 *  
 * @author elEmailer 
 * @since 1.0.3
 */
class Hooks
{
    use \Elemailer\Traits\Singleton;

    /**
     * inilial class for shortcode hooks function
     *
     * @return void
     * @since 1.0.3
     */
    public function init() {
        // Cf7 shortcode support
        add_action( 'wpcf7_before_send_mail', [$this, 'wpcf7_support_elemailer_shortcode'], 10, 1);

        $this->global_settings = Settings_Action::instance()->get_global_settings();

        if ( ! empty( $this->global_settings['wp_email_override_enabled'] ) && 'yes' === $this->global_settings['wp_email_override_enabled'] ) {
            add_action( 'admin_enqueue_scripts', [ $this, 'floating_icon_scripts' ] );
            add_action( 'admin_footer', [ $this, 'floating_icon' ] );
            add_action( 'wp_ajax_elemailer_save_shortcodes', [ $this, 'save_shortcodes' ] );
        }
    }

    /**
     * Save shortcodes
     *
     * @since 2.6
     * 
     * @return void
     */
    public function save_shortcodes() {
        // Verify Nonce.
        check_ajax_referer( 'elemailer_floating_ajax_nonce', '_ajax_nonce' );

        update_option( 'elemailer-dynamic-shortocodes', wp_unslash( $_REQUEST['shortcodes'] ) );

        $return = [ 'success' => 1 ];
        wp_send_json( $return );
        wp_die();
    }

    /**
     * Floating icon scripts
     *
     * @since 2.6
     * 
     * @return void
     */
    public function floating_icon_scripts() {
        $version = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? time() : ELE_MAILER_VERSION;
        wp_enqueue_style( 'elemailer-floating-icon', ELE_MAILER_PLUGIN_URL . '/integrations/elementor/assets/css/floating-icon.css', false, $version );
        wp_enqueue_script( 'elemailer-floating-icon-scripts', ELE_MAILER_PLUGIN_URL . '/integrations/elementor/assets/js/floating-icon.js', array( 'jquery' ), $version, true );
        
        wp_localize_script(
            'elemailer-floating-icon-scripts',
            'elemailer_floating_object',
            apply_filters(
                'elemailer_localize_floating_script_args',
                [
                    'ajax_url'           => admin_url( 'admin-ajax.php' ),
                    'ajax_nonce'         => wp_create_nonce( 'elemailer_floating_ajax_nonce' ),
                    'filed_key_text'     => __( 'Enter field key', 'elemailer' ),
                    'ele_filed_key_text' => __( 'Enter elemailer key', 'elemailer' ),
                ]
            )
        );
    }

    /**
     * Change mail content
     *
     * @since 2.6
     * 
     * @return string
     */
    public function floating_icon() {
        $get_all_template = \Elemailer\App\Form_Template\Action::instance()->get_all_template();

        include_once ELE_MAILER_PLUGIN_PUBLIC_DIR . '/views/shortcode-floating-icon.php';
    }

    /**
     * Function to replace mail, mail2 shortcode inside cf7 form.
     *
     * @param $contact_form object 
     * @return $contact_form object
     * @since 1.0.3
     */

    public function wpcf7_support_elemailer_shortcode( $contact_form )
    {
        $mail    = $contact_form->prop( 'mail' );
        $mail_2  = $contact_form->prop( 'mail_2' );
        $form_id = $contact_form->id;

        // Body content

        //if select template method  else shortcode method check

        if ( 'yes' == get_option( 'elemailer_cf7_email_option_enable_'.$form_id, '' ) ) {
            
            $mail['body'] =  $this->process_cf7_elemailer_template_selected( $mail['body'], 'mail1', $form_id );
            $mail_2['body'] =  $this->process_cf7_elemailer_template_selected( $mail_2['body'], 'mail2', $form_id );

        }else{

            $mail['body'] =  $this->process_elemailer_shortcode($mail['body']);
            $mail_2['body'] =  $this->process_elemailer_shortcode($mail_2['body']);

        }
       
        // Update the mail 
        $contact_form->set_properties(array('mail' => $mail));
        $contact_form->set_properties(array('mail_2' => $mail_2));
    }

 
    public function process_cf7_elemailer_template_selected( $body, $mail_no, $form_id )
    {
       
        if ( 'mail1' === $mail_no ) {
            $id = get_option( 'elemailer_cf7_template_email1_'.$form_id, '' );
        } else if ( 'mail2' === $mail_no ) {
            $id = get_option( 'elemailer_cf7_template_email2_'.$form_id, '' );
        }
        

        if ( empty( $id ) ) {
            return $body;
        }
            
        $html = \Elemailer\Helpers\Util::get_template_content($id);
        $html = \Elemailer\Helpers\Util::get_email_html_template($id, $html);

        return $html;
    }

    /**
     * Only return elemailer template and remove everything else unless we enable the last line commented
     *
     * @param string[shortcode] $shortcode 
     * @return string[html] $html
     * @since 1.0.1
     */

    public function process_elemailer_shortcode($shortcode)
    {

        $status = preg_match_all('(\[elemailer:id="[0-9]+"])', $shortcode, $data, PREG_SET_ORDER);

        // always return the shortcode if it doesn't match your own!
        if (!$status) return $shortcode;

        $match = isset($data[0][0]) ? $data[0][0] : false;
        $id = rtrim(ltrim($match, '[elemailer:id="'), '"]');

        $html = \Elemailer\Helpers\Util::get_template_content($id);
        $html = \Elemailer\Helpers\Util::get_email_html_template($id, $html);

        // if we want to allow other content we need to uncomment it.
        //$html=preg_replace('(\[elemailer:id="[0-9]+"])', $html, $shortcode);

        return $html;
    }






}

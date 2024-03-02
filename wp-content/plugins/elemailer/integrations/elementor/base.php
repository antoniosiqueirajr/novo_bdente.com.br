<?php

namespace Elemailer\Integrations\Elementor;

defined('ABSPATH') || exit;

/**
 * Elementor integration base class.
 * This class load everything related to elementor
 *
 * @author elEmailer 
 * @since 1.0.0
 */
class Base
{
    use \Elemailer\Traits\Singleton;

    public function init()
    {
        // Check if Elementor installed and activated.
        if (!did_action('elementor/loaded')) {
            add_action('admin_notices', array($this, 'required_elementor'));
            return;
        }

        // Check if Elementor installed and activated.
        if ( ! elemailer_has_woocommerce() ) {
            add_action( 'admin_notices', array( $this, 'recommended_woocommerce') );
        }

        // check elementor pro activation
        // is plugin active function load if not exists
        if (!function_exists('is_plugin_active')) {
            require_once(ABSPATH . '/wp-admin/includes/plugin.php');
        }

        // elementor pro check and fired elementor pro actions
        if (file_exists(WP_PLUGIN_DIR . '/elementor-pro/elementor-pro.php') && !is_plugin_active('elementor-pro/elementor-pro.php')) {
            add_action('admin_notices', [$this, 'required_elementor_pro']);
        }

        // Check for required Elementor version.
        if (!version_compare(ELEMENTOR_VERSION, '3.0.11', '>=')) {
            add_action('admin_notices', array($this, 'required_elementor_version'));
            return;
        }

        // register widgets
        Widgets\Base::instance()->init();
        
        // fire elementor actions
        Actions\Base::instance()->init();

        // action for enqueue style on elementor editor panel
        add_action('elementor/editor/after_enqueue_styles', [$this, 'load_css_elementor_editor_panel']);

        // action for enqueue style on elementor frontend in editing page
        add_action('elementor/frontend/after_enqueue_styles', [$this, 'load_css_elementor_frontend']);

        // action for enqueue scripts on elementor editor panel
        add_action('elementor/editor/after_enqueue_scripts', [$this, 'load_js_elementor_editor_panel']);

        // action for enqueue scripts on elementor frontend in editing page
        add_action('elementor/frontend/before_enqueue_scripts', [$this, 'load_js_elementor_frontend']);
    }

    /**
     * WooCommerce missing notice function
     *
     * @return void
     * @since 1.0.8
     */
    public function recommended_woocommerce()
    {
        if ( file_exists( WP_PLUGIN_DIR . '/woocommerce/woocommerce.php' ) ) {
            $btn['label'] = esc_html__('Activate WooCommerce', 'elemailer');
            $btn['url'] = wp_nonce_url(self_admin_url('plugins.php?action=activate&plugin=/woocommerce/woocommerce.php&plugin_status=all&paged=1'), 'activate-plugin_/woocommerce/woocommerce.php');
        } else {
            $btn['label'] = esc_html__('Install WooCommerce', 'elemailer');
            $btn['url'] = wp_nonce_url(self_admin_url('update.php?action=install-plugin&plugin=woocommerce'), 'install-plugin_woocommerce');
        }

        \Elemailer\Helpers\Notice::push(
            [
                'id'          => 'elemailer-recommended-woocommerce',
                'type'        => 'info',
                'dismissible' => true,
                'btn'          => $btn,
                'message'     => sprintf(esc_html__('If you plan to design WooCommerce emails with Elemailer, please install and activate WooCommerce. Otherwise Ignore this.', 'elemailer'), '3.4'),
            ]
        );
    }

    /**
     * elementor missing notice function
     *
     * @return void
     * @since 1.0.0
     */
    public function required_elementor()
    {

        if (isset($_GET['activate'])) {
            unset($_GET['activate']);
        }

        if (file_exists(WP_PLUGIN_DIR . '/elementor/elementor.php')) {
            $btn['label'] = esc_html__('Activate Elementor', 'elemailer');
            $btn['url'] = wp_nonce_url(self_admin_url('plugins.php?action=activate&plugin=elementor/elementor.php&plugin_status=all&paged=1'), 'activate-plugin_elementor/elementor.php');
        } else {
            $btn['label'] = esc_html__('Install Elementor', 'elemailer');
            $btn['url'] = wp_nonce_url(self_admin_url('update.php?action=install-plugin&plugin=elementor'), 'install-plugin_elementor');
        }

        \Elemailer\Helpers\Notice::push(
            [
                'id'          => 'elemailer-required-elementor',
                'type'        => 'error',
                'dismissible' => false,
                'btn'          => $btn,
                'message'     => sprintf(esc_html__('Elemailer needs Elementor version %1$s+ for letting you design your emails', 'elemailer'), '3.4'),
            ]
        );
    }

    /**
     * elementor older version notice function
     *
     * @return void
     * @since 1.0.0
     */
    public function required_elementor_version()
    {

        $btn['label'] = esc_html__('Update Elementor', 'elemailer');
        $btn['url'] = wp_nonce_url(self_admin_url('update.php?action=upgrade-plugin&plugin=elementor/elementor.php'), 'upgrade-plugin_elementor/elementor.php');

        \Elemailer\Helpers\Notice::push(
            [
                'id'          => 'elemailer-unsupported-elementor-version',
                'type'        => 'error',
                'dismissible' => false,
                'btn'          => $btn,
                'message'     => sprintf(esc_html__('Elemailer needs Elementor version %1$s+ for working it, lower version is running. Please update.', 'elemailer'), '3.0.11'),
            ]
        );
    }

        /**
     * elementor missing notice function
     *
     * @return void
     * @since 1.0.0
     */
    public function required_elementor_pro()
    {
        $screen = get_current_screen();

        if ($screen->id == 'edit-em-form-template') {
            if (isset($_GET['activate'])) {
                unset($_GET['activate']);
            }
    
            if (file_exists(WP_PLUGIN_DIR . '/elementor-pro/elementor-pro.php')) {
                $btn['label'] = esc_html__('Activate Elementor pro', 'elemailer');
                $btn['url'] = wp_nonce_url(self_admin_url('plugins.php?action=activate&plugin=elementor-pro/elementor-pro.php&plugin_status=all&paged=1'), 'activate-plugin_elementor-pro/elementor-pro.php');
                $target = false;
            } else {
                $btn['label'] = esc_html__('Install Elementor pro', 'elemailer');
                $btn['url'] = esc_url('https://elementor.com/pro/');
                $target = true;
            }
    
            \Elemailer\Helpers\Notice::push(
                [
                    'id'          => 'elemailer-elementor-pro-required',
                    'type'        => 'info',
                    'dismissible' => true,
                    'target'      => ($target)? '_blank': '',
                    'btn'         => $btn,
                    'message'     => sprintf(esc_html__('To use Elemailer for email desigon of Elementor pro Forms, Elementor Pro %1$s+ should be installed & activated. Ignore if you plan to use Elemailer with other Form plugin(s).', 'elemailer'), '3.4'),
                ]
            );
        }
    }

    /**
     * function for enqueue style on elementor editor panel
     *
     * @return void
     * @since 1.0.0
     */
    public function load_css_elementor_editor_panel()
    {
        $post_type = get_post_type();

        if ((in_array($post_type, ['em-form-template', 'em-emails-template']))) :
            wp_enqueue_style('elemailer-elementor-editor', ELE_MAILER_PLUGIN_URL . 'integrations/elementor/assets/css/editor.css', false, ELE_MAILER_VERSION);
        endif;
    }

    /**
     * function for enqueue style on elementor frontend in editing page
     *
     * @return void
     * @since 1.0.0
     */
    public function load_css_elementor_frontend()
    {
        $post_type = get_post_type();

        if ((in_array($post_type, ['em-form-template', 'em-emails-template']))) :
            wp_enqueue_style('elemailer-elementor-frontend', ELE_MAILER_PLUGIN_URL . 'integrations/elementor/assets/css/frontend.css', false, ELE_MAILER_VERSION);
        endif;
    }

    /**
     * function for enqueue scripts on elementor editor panel
     *
     * @return void
     * @since 1.0.0
     */
    public function load_js_elementor_editor_panel()
    {
        $post_type = get_post_type();

        if ((in_array($post_type, ['em-form-template', 'em-emails-template']))) :

            wp_enqueue_script('elemailer-elementor-editor', ELE_MAILER_PLUGIN_URL . 'integrations/elementor/assets/js/editor.js', array('jquery'), ELE_MAILER_VERSION, true);
            wp_localize_script(
                'elemailer-elementor-editor',
                'elemailer',
                [
                    'ajaxUrl' => admin_url('admin-ajax.php'),
                    'url' => get_admin_url(),
                    'restUrl' => get_rest_url(),
                    'wpRestNonce' => wp_create_nonce('wp_rest'),
                ]
            );

        endif;
    }

    /**
     * function for enqueue scripts on elementor frontend in editing page
     *
     * @return void
     * @since 1.0.0
     */
    public function load_js_elementor_frontend()
    {
        $post_type = get_post_type();

        if ((in_array($post_type, ['em-form-template', 'em-emails-template']))) :

            wp_enqueue_script('elemailer-elementor-frontend', ELE_MAILER_PLUGIN_URL . 'integrations/elementor/assets/js/frontend.js', array('jquery'), ELE_MAILER_VERSION, true);

        endif;
    }
}

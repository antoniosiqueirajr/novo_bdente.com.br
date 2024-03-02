<?php

namespace Elemailer;

use Elementor\Plugin as Elementor;
use Elemailer\App\Settings\Action as Settings_Action;

defined('ABSPATH') || exit;

/**
 * main plugin loaded final class
 * handle everything for initial plugin load
 *
 * @author elEmailer 
 * @since 1.0.0
 */
final class Plugin
{

    /**
     * accesing for object of this class
     *
     * @var object
     */
    private static $instance;

    /**
     * construct function of this class
     *
     * @return void
     * @since 1.0.0
     */
    public function __construct()
    {
        $this->define_constant();
        Autoloader::run();
        add_action( 'plugins_loaded', [ $this, 'load_textdomain' ] );
    }

    /**
     * defining constant function
     *
     * @return void
     * @since 1.0.0
     */
    public function define_constant()
    {
        define('ELE_MAILER_VERSION', '4.1.1');
        define('ELE_MAILER_PACKAGE', 'pro');
        define('ELE_MAILER_PLUGIN_URL', trailingslashit(plugin_dir_url(__FILE__)));
        define('ELE_MAILER_PLUGIN_DIR', trailingslashit(plugin_dir_path(__FILE__)));

        define('ELE_MAILER_PLUGIN_PUBLIC', ELE_MAILER_PLUGIN_URL . 'public');
        define('ELE_MAILER_PLUGIN_PUBLIC_DIR', ELE_MAILER_PLUGIN_DIR . 'public');
    }

    /**
	 * Loads plugins translation file
	 *
	 * @return void
	 * @since x.x.x
	 */
	public function load_textdomain() {
		// Default languages directory.
		$lang_dir = ELE_MAILER_PLUGIN_DIR . 'languages/';

		// Traditional WordPress plugin locale filter.
		global $wp_version;

		$get_locale = get_locale();

		if ( $wp_version >= 4.7 ) {
			$get_locale = get_user_locale();
		}

		$locale = apply_filters( 'plugin_locale', $get_locale, 'elemailer' );
		$mofile = sprintf( '%1$s-%2$s.mo', 'elemailer', $locale );

		// Setup paths to current locale file.
		$mofile_local  = $lang_dir . $mofile;
		$mofile_global = WP_LANG_DIR . '/plugins/' . $mofile;

		if ( file_exists( $mofile_global ) ) {
			// Look in global /wp-content/languages/elemailer/ folder.
			load_textdomain( 'elemailer', $mofile_global );
		} elseif ( file_exists( $mofile_local ) ) {
			// Look in local /wp-content/plugins/elemailer/languages/ folder.
			load_textdomain( 'elemailer', $mofile_local );
		} else {
			// Load the default language files.
			load_plugin_textdomain( 'elemailer', false, $lang_dir );
		}
	}

    /**
     * plugin initialization function
     * calls on plugins_loaded action
     *
     * @return void
     * @since 1.0.0
     */
    public function init()
    {
        if (current_user_can('manage_options')) {
            add_action('admin_menu', [$this, 'add_admin_menu']);
        }
        // enqueue js and css on admin dashboard hook
        add_action('admin_enqueue_scripts', [$this, 'load_js_css_admin']);
        // remove third party js css in our template hook
        add_action('wp_enqueue_scripts', [$this, 'enqueue_dequeue_js_css_public'], 999);
        // enqueue css in elementor front end hook
        add_action('elementor/frontend/after_enqueue_styles', [$this, 'load_elementor_css_public']);

        // call notice initialize function
        Helpers\Notice::init();

        // call everything for email template. this init will register cpt and everything related to cpt template for elemailer
        App\Form_Template\Base::instance()->init();

        // call everything for subscribers.
        App\Subscribers\Base::instance()->init();
    
        // call everything for lists.
        App\Lists\Base::instance()->init();

        // call everything for emails.
        App\Emails\Base::instance()->init();

        //cron job with this plugin
        Lib\Cron\Base::instance()->init();

        // integrate mailpoet with this plugin
        Integrations\Mailpoet\Base::instance()->init();

        // integrate pafe with this plugin
        Integrations\Pafe\Base::instance()->init();

        // integrate fluent form with this plugin
        Integrations\Fluentform\Base::instance()->init();

        // integrate differnet plugin before email sending shortcode supports in mail body @since 1.0.3
        Integrations\Shortcode\Base::instance()->init();

        // shortcode (for subscriber module table)
        Lib\Shortcode::instance()->init();

        // call everything for setitngs
        App\Settings\Base::instance()->init();

        // license functionality call
        Lib\License\Base::instance()->init();

        // integrate elementor with this plugin
        Integrations\Elementor\Base::instance()->init();

        // integrate contact form7 with this plugin
        Integrations\ContactForm7\Base::instance()->init();
       
        // integrate ninja form with this plugin
        Integrations\NinjaForm\Base::instance()->init();
        // integrate wpforms with this plugin
        Integrations\Wpforms\Base::instance()->init();

        // integrate elementor with this plugin
        Integrations\Elementor\Library::instance()->init();

        // minify elementor default css and assign it to a new file for sending it to the mail clients. 
        Helpers\Util::minify_css(ELE_MAILER_PLUGIN_DIR . 'public/assets/css/elemailer-mail.css', ELE_MAILER_PLUGIN_DIR . 'app/form-template/view/default-elementor-style.php');

        // integrate elementor email with this plugin
        Integrations\Elementor\Email::instance()->init();
    }

    public function after_wp_loaded_hooks()
    {
        // remove wp classic editor styles from themes
        remove_editor_styles();

        // call everything for pages to show user interected data
        Lib\Pages\Base::instance()->init();
            
        // call cron assign function to assign cron jobs
        Lib\Cron\Base::instance()->assign_cron_job();

        // add action for new register user
        Lib\Cron\Base::instance()->trigger_welcome_email();
    }

    /**
     * trigger this after activate plugin function
     *
     * @return void
     * @since 1.0.0
     */
    public function action_after_active_plugin()
    {
        // flush rewrites rules for adjust permalink
        $this->flush_rewrites();
        // store plugin activation info
        $this->plugin_active_info();

        // create tables
        Lib\Database\Base::instance()->create_tables();

        // set default global settings
        $this->set_default_global_settings();

    }

    /**
     * set default global settings function
     *
     * @return void
     * @since 1.0.0
     */
    public function set_default_global_settings(){

        $urlparts = parse_url(home_url());
        $domain = $urlparts['host'];

        $admins = get_users(['role__in' => 'Administrator']);

        $admins = isset($admins[0]) ? $admins[0] : (object)[];

        $default_global_settings = [
            'sender_name' => isset($admins->data->display_name)? $admins->data->display_name: '',
            'sender_email' => 'wordpress@'. $domain,
            'reply_to_name' => isset($admins->data->display_name)? $admins->data->display_name: '',
            'reply_to_email' => 'wordpress@'. $domain,
            'subscription_confirmation_page' => 'elemailer_page',
            'unsubscribe_action_page' => 'elemailer_page',
            'unsubscribe_success_page' => 'elemailer_page',
            'new_subscriber_notification' => 'yes',
            'ns_notification_from_email' => isset($admins->data->user_email)? $admins->data->user_email: '',
            'enable_mail_opt_in' => 'yes',
            'opt_in_mail_subject' => 'Confirm your subscription to ' . get_bloginfo('name'),
            'opt_in_mail_content' => "Hello,\nWelcome to our newsletter!\nPlease confirm your subscription to our list by clicking the link below:\n[activation_link]I confirm my subscription![/activation_link]\nThank you,\nThe Team",
            'opt_in_confirm_page' => 'elemailer_page',
            'number_of_emails' => 25,
            'emails_per_second' => 300,
            'wp_email_override_enabled' => 'no',
        ];

        $get = \Elemailer\App\Settings\Action::instance()->get_global_settings();

        if(!$get){
            \Elemailer\App\Settings\Action::instance()->store('all', $default_global_settings);
        }

    }

    /**
     * store plugin activation information function
     *
     * @since 1.0.0
     */
    public function plugin_active_info()
    {

        $info = [
            'activation_version' => ELE_MAILER_VERSION,
            'activation_time' => date('d-m-Y H:i:s'),
        ];

        update_option('elemailer_info', $info);
    }

    /**
     * plublic assets load function
     * used this function for removing thirdparty css and js from our template
     *
     * @return void
     * @since 1.0.0
     */
    public function enqueue_dequeue_js_css_public()
    {
        $post_type = get_post_type();

        if (in_array($post_type, ['em-form-template', 'em-emails-template'])) {
            // get all queued scripts
            $wp_scripts = wp_scripts();
            // get all queued styles
            $wp_styles  = wp_styles();
            // get theme root uri
            $themes_uri = get_theme_root_uri();
            // get plugins root uri
            $current_plugin = plugin_dir_url(__FILE__);
            // get elementor plugin uri
            $elementor = WP_PLUGIN_URL . '/elementor/';
            // get elementor pro plugin uri
            $elementor_pro = WP_PLUGIN_URL . '/elementor-pro/';
            // add support for 3rd party plugin script loading
            $query_monitor_plugin = WP_PLUGIN_URL . '/query-monitor/';
            $debug_bar = WP_PLUGIN_URL . '/debug-bar/';

            foreach ($wp_scripts->registered as $wp_script) {
                // check is this script comes from theme
                if (strpos($wp_script->src, $themes_uri) !== false) {
                    // prevent this script from loading in our template editor page
                    wp_dequeue_script($wp_script->handle);
                }
                // check is this script comes from plugin
                if (strpos($wp_script->src, WP_PLUGIN_URL) !== false) {
                    // check is this script comes from our plugin
                    if (strpos($wp_script->src, $current_plugin) !== false) {
                        // keep this script to load
                        continue;
                    }
                    // check is this script comes from elementor
                    else if (strpos($wp_script->src, $elementor) !== false) {
                        // keep this script to load
                        continue;
                    }
                    // check is this script comes from elementor pro
                    else if (strpos($wp_script->src, $elementor_pro) !== false) {
                        // keep this script to load
                        continue;
                    }
                    // check is this script comes from query monitor plugin
                    else if (strpos($wp_script->src, $query_monitor_plugin) !== false) {
                        // keep this script to load
                        continue;
                    } 
                    // check is this script comes from query monitor plugin
                    else if (strpos($wp_script->src, $debug_bar) !== false) {
                        // keep this script to load
                        continue;
                    }
                    // doesn't meet any condition
                    else {
                        // prevent this script from loading in our template editor page
                        wp_dequeue_script($wp_script->handle);
                    }
                }
            }

            foreach ($wp_styles->registered as $wp_style) {
               
                //remove elementor global style
                wp_dequeue_style('elementor-global');
                // remove gutenberg reset css
                wp_dequeue_style( 'global-styles' );
               // wp_dequeue_style( 'elementor-post-'.get_the_id() );
                
                // Remove default kit /theme style / any other post CSS file to avoid issue
                if (strpos($wp_style->handle, 'elementor-post-') !== false) {
                    // prevent this style from loading in our template editor page
                    if (strcmp($wp_style->handle, 'elementor-post-'.get_the_id()) ==true) {
                        wp_dequeue_style($wp_style->handle);
                    }
                }    

                // check is this style comes from theme
                if (strpos($wp_style->src, $themes_uri) !== false) {
                    // prevent this style from loading in our template editor page
                    wp_dequeue_style($wp_style->handle);
                }
                // check is this style comes from plugin
                if (strpos($wp_style->src, WP_PLUGIN_URL) !== false) {
                    // check is this style comes from our plugin
                    if (strpos($wp_style->src, $current_plugin) !== false) {
                        // keep this style to load
                        continue;
                    }
                    // check is this style comes from elementor
                    else if (strpos($wp_style->src, $elementor) !== false) {
                        // we are not removing this style .. this doesn't remove fontend.css style of elemento & we need that for editor
                        //wp_dequeue_style($wp_style->handle);
                        continue;
                    }
                    // check is this style comes from elementor pro
                    else if (strpos($wp_style->src, $elementor_pro) !== false) {
                        // remove this style to load
                        wp_dequeue_style($wp_style->handle);
                        continue;
                    }
                    // check is this style comes from Query monitor plugin
                    else if (strpos($wp_style->src, $query_monitor_plugin) !== false) {
                        // keep this style to load
                        continue;
                    }
                    // check is this style comes from Query monitor plugin
                    else if (strpos($wp_style->src, $debug_bar) !== false) {
                        // keep this style to load
                        continue;
                    }
                    // doesn't meet any condition
                    else {
                        // prevent this style from loading in our template editor page
                        wp_dequeue_style($wp_style->handle);
                    }
                }
            }
        }

        // enqueue style for elemailer page design
        wp_enqueue_style('elemailer-page', ELE_MAILER_PLUGIN_PUBLIC . '/assets/css/pages-style.css', false, ELE_MAILER_VERSION);
    }

    /**
     * elementor enqueue style function
     *
     * @return void
     * @since 1.0.0
     */
    public function load_elementor_css_public()
    {
        $post_type = get_post_type();

        if (in_array($post_type, ['em-form-template', 'em-emails-template'])) {

            wp_enqueue_style('elemailer', ELE_MAILER_PLUGIN_PUBLIC . '/assets/css/style.css', false, ELE_MAILER_VERSION);
        }
    }

    /**
     * admin assets load function
     *
     * @return void
     * @since 1.0.0
     */
    public function load_js_css_admin()
    {

        $screen = get_current_screen();

        if (in_array($screen->id, ['edit-em-form-template', 'elemailer_page_elemailer-emails', 'elemailer_page_elemailer-subscribers', 'elemailer_page_elemailer-lists', 'elemailer_page_elemailer-settings', 'elemailer_page_elemailer-license'])) {

            wp_enqueue_style('flatpickr', ELE_MAILER_PLUGIN_PUBLIC . '/assets/css/flatpickr.min.css', false, ELE_MAILER_VERSION);
            wp_enqueue_style('select2', ELE_MAILER_PLUGIN_PUBLIC . '/assets/css/select2.min.css', false, ELE_MAILER_VERSION);
            wp_enqueue_style('elemailer-ui', ELE_MAILER_PLUGIN_PUBLIC . '/assets/css/admin-style.css', false, ELE_MAILER_VERSION);
            wp_enqueue_style('data-table', ELE_MAILER_PLUGIN_PUBLIC . '/assets/css/jquery.dataTables.min.css', false, ELE_MAILER_VERSION);
            wp_enqueue_style('dataTables-button', ELE_MAILER_PLUGIN_PUBLIC . '/assets/css/buttons.dataTables.min.css', false, ELE_MAILER_VERSION);
            wp_enqueue_style('responsive-dataTables', ELE_MAILER_PLUGIN_PUBLIC . '/assets/css/responsive.dataTables.min.css', false, ELE_MAILER_VERSION);
            
            wp_enqueue_script('flatpickr', ELE_MAILER_PLUGIN_PUBLIC . '/assets/js/flatpickr.js', array(), ELE_MAILER_VERSION, true);
            wp_enqueue_script('select2', ELE_MAILER_PLUGIN_PUBLIC . '/assets/js/select2.min.js', array(), ELE_MAILER_VERSION, true);
            wp_enqueue_script('data-table', ELE_MAILER_PLUGIN_PUBLIC . '/assets/js/jquery.dataTables.min.js', array(), ELE_MAILER_VERSION, true);
            wp_enqueue_script('dataTables-buttons', ELE_MAILER_PLUGIN_PUBLIC . '/assets/js/admin/dataTables.buttons.min.js', array(), ELE_MAILER_VERSION, true);
            wp_enqueue_script('dataTables-buttons-html5', ELE_MAILER_PLUGIN_PUBLIC . '/assets/js/admin/buttons.html5.min.js', array(), ELE_MAILER_VERSION, true);
            wp_enqueue_script('dataTables-responsive', ELE_MAILER_PLUGIN_PUBLIC . '/assets/js/admin/dataTables.responsive.min.js', array(), ELE_MAILER_VERSION, true);
            
            switch($screen->id){
                case 'edit-em-form-template':
                    wp_enqueue_script('elemailer-form-template', ELE_MAILER_PLUGIN_PUBLIC . '/assets/js/admin/form-template-functions.js', array(), ELE_MAILER_VERSION, true);
                    wp_localize_script('elemailer-form-template', 'elemailer', ['restUrl' => rest_url('elemailer/v1/'), 'nonce' => wp_create_nonce('wp_rest')]);
                break;
                case 'elemailer_page_elemailer-emails':
                    wp_enqueue_script('elemailer-emails-template', ELE_MAILER_PLUGIN_PUBLIC . '/assets/js/admin/emails-functions.js', array(), ELE_MAILER_VERSION, true);
                    wp_localize_script('elemailer-emails-template', 'elemailer', ['restUrl' => rest_url('elemailer/v1/'), 'nonce' => wp_create_nonce('wp_rest')]);
                break;
                case 'elemailer_page_elemailer-subscribers':
                    wp_enqueue_script('elemailer-subscribers', ELE_MAILER_PLUGIN_PUBLIC . '/assets/js/admin/subscribers-functions.js', array(), ELE_MAILER_VERSION, true);
                    wp_localize_script('elemailer-subscribers', 'elemailer', ['restUrl' => rest_url('elemailer/v1/'), 'nonce' => wp_create_nonce('wp_rest')]);
                break;
                case 'elemailer_page_elemailer-lists':
                    wp_enqueue_script('elemailer-lists', ELE_MAILER_PLUGIN_PUBLIC . '/assets/js/admin/lists-functions.js', array(), ELE_MAILER_VERSION, true);
                    wp_localize_script('elemailer-lists', 'elemailer', ['restUrl' => rest_url('elemailer/v1/'), 'nonce' => wp_create_nonce('wp_rest')]);
                break;
                case 'elemailer_page_elemailer-settings':
                    wp_enqueue_script('elemailer-settings', ELE_MAILER_PLUGIN_PUBLIC . '/assets/js/admin/settings-functions.js', array(), ELE_MAILER_VERSION, true);
                    wp_localize_script('elemailer-settings', 'elemailer', ['restUrl' => rest_url('elemailer/v1/'), 'nonce' => wp_create_nonce('wp_rest')]);
                break;
                default:
            }

        }
    }


    /**
     * plugin menu add function
     *
     * @return void
     * @since 1.0.0
     */
    public function add_admin_menu()
    {
        // for main menu of this plugin in admin panel
        add_menu_page(
            esc_html__('Elemailer', 'elemailer'),
            esc_html__('Elemailer', 'elemailer'),
            'manage_options',
            'elemailer-menu',
            array($this, "elemailer_parent_dashboard"),
            esc_url(ELE_MAILER_PLUGIN_PUBLIC . '/assets/img/elemailer-icon.png'),
            25
        );

        if(Lib\License\Action::instance()->is_plugin_activate()){
            
            // for emails settings
            add_submenu_page(
                'elemailer-menu',
                __( 'Emails', 'elemailer' ),
                __( 'Emails', 'elemailer' ),
                'manage_options',
                'elemailer-emails',
                [ App\Emails\Base::instance(), 'emails_user_interface']
            );
    
            // for subscribers settings
            add_submenu_page(
                'elemailer-menu',
                __( 'Subscribers', 'elemailer' ),
                __( 'Subscribers', 'elemailer' ),
                'manage_options',
                'elemailer-subscribers',
                [ App\Subscribers\Base::instance(), 'subscribers_interface']
            );
    
            // for lists settings
            add_submenu_page(
                'elemailer-menu',
                __( 'Lists', 'elemailer' ),
                __( 'Lists', 'elemailer' ),
                'manage_options',
                'elemailer-lists',
                [ App\Lists\Base::instance(), 'lists_interface']
            );
    
            // for global settings
            add_submenu_page(
                'elemailer-menu',
                __( 'Settings', 'elemailer' ),
                __( 'Settings', 'elemailer' ),
                'manage_options',
                'elemailer-settings',
                [ App\Settings\Base::instance(), 'settings_interface']
            );

            $this->global_settings = Settings_Action::instance()->get_global_settings();

            if ( ! empty( $this->global_settings['wp_email_override_enabled'] ) && 'yes' === $this->global_settings['wp_email_override_enabled'] ) {
                // Add shortcodes generator menu
                add_submenu_page(
                    'elemailer-menu',
                    __( 'Shortcodes Generator', 'elemailer' ),
                    __( 'Shortcodes', 'elemailer' ),
                    'manage_options',
                    'elemailer-shortcodes-generator',
                    [ Integrations\Shortcode\Base::instance(), 'shortcode_interface' ]
                );
            }
        }

        // for lisencing settings
        add_submenu_page(
            'elemailer-menu',
            __( 'License', 'elemailer' ),
            __( 'License', 'elemailer' ),
            'manage_options',
            'elemailer-license',
            [ Lib\License\Base::instance(), 'get_template']
        );

    }

    public function elemailer_parent_dashboard(){
            echo '<h1 style="text-align:center; margin-top:20vh;">Welcome to Elemailer.</h1>
                 <p style="text-align:center;">redirecting...</p> <script>document.location.href = "'.admin_url('edit.php?post_type=em-form-template').'";</script>';
    }

    /**
     * update permalink after register cpt function
     *
     * @return void
     * @since 1.0.0
     */
    public function flush_rewrites()
    {
        $template_cpt = new App\Form_Template\Cpt();
        $template_cpt->flush_rewrites();

        $emails_cpt = new App\Emails\Cpt();
        $emails_cpt->flush_rewrites();
    }

    public function action_after_deactivate_plugin()
    {
        Lib\Cron\Base::instance()->clear_cron_job();
    }

    /**
     * singleton instance create function
     *
     * @return object
     * @since 1.0.0
     */
    public static function instance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }
}

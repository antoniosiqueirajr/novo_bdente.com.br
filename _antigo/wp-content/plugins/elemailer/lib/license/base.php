<?php

namespace Elemailer\Lib\License;

defined('ABSPATH') || exit;

/**
 * elemailer license related base class for initialization
 * 
 * @author elEmailer
 * @since 1.0.0
 */
class Base
{

    use \Elemailer\Traits\Singleton;

    /**
     * initialization of license class function
     *
     * @return void
     * @since 1.0.0
     */
    public function init()
    {
        if (!Action::instance()->is_plugin_activate()) {
            // admin notice
            add_action('admin_notices', [$this, 'notice_for_activation_license']);
        }

        // run updater
        add_action('admin_init', [Action::instance(), 'run_updater'], 0);

        // license form submission call
        $this->handle_license_form_submission();
    }

    /**
     * get license related admin page template function
     *
     * @return void
     * @since 1.0.0
     */
    public function get_template()
    {
        $license_status = Action::instance()->is_plugin_activate();
        include 'template.php';
    }

    /**
     * handle license form submission function
     *
     * @return void
     * @since 1.0.0
     */
    public function handle_license_form_submission()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['elemailer_license_handler'])) {
            // DD($_POST);
            if (isset($_POST['action']) && $_POST['action'] == 'elemailer_license_deactivate') {
                $deactivate = Action::instance()->deactivate_license();
                add_action('admin_notices', function () use ($deactivate) {
                    $this->notice_for_license_action($deactivate);
                });
            } else {
                $license_key = trim(isset($_POST['license-key']) ? $_POST['license-key'] : '');
                $activate = Action::instance()->activate_license($license_key);
                add_action('admin_notices', function () use ($activate) {
                    $this->notice_for_license_action($activate);
                });
            }
        }
    }

    /**
     * show notice for activate license function
     *
     * @return void
     * @since 1.0.0
     */
    public function notice_for_activation_license()
    {
        $screen = get_current_screen();

        if ($screen->id != 'elemailer_page_elemailer-license') {

            $btn['label'] = esc_html__('Activate license', 'elemailer');
            $btn['url'] = wp_nonce_url(self_admin_url('admin.php?page=elemailer-license'));

            \Elemailer\Helpers\Notice::push(
                [
                    'id'          => 'activate-elemailer-license',
                    'type'        => 'error',
                    'dismissible' => false,
                    'btn'         => $btn,
                    'message'     => esc_html__('Activate license to use Elemailer', 'elemailer'),
                ]
            );
        }
    }

    /**
     * show notice with license action status function
     *
     * @param array $args
     *
     * @return void
     * @since 1.0.0
     */
    public function notice_for_license_action($args)
    {
        \Elemailer\Helpers\Notice::push(
            [
                'id'          => 'activate-elemailer-license',
                'type'        => ($args['status'] == 1) ? 'updated' : 'error',
                'class'        => ($args['status'] == 1) ? 'updated' : 'error',
                'dismissible' => true,
                'message'     => 'Elemailer: ' . $args['message'],
            ]
        );
    }
}

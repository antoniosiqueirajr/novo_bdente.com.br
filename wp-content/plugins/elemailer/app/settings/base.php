<?php

namespace Elemailer\App\Settings;

defined('ABSPATH') || exit;

use \Elemailer\App\Settings\Action as Settings_Action;

/**
 * global settings related base class for initialization
 * used for creating cpt, api
 * 
 * @author elEmailer
 * @since 1.0.0
 */
class Base
{

    use \Elemailer\Traits\Singleton;

    public $template;

    /**
     * initialization function for all of the global settings functionality
     *
     * @return void
     * @since 1.0.0
     */
    public function init()
    {
        $this->api = new Api();
    }

    /**
     * show global settings related admin page function
     *
     * @return void
     * @since 1.0.0
     */
    public function settings_interface()
    {
        $global = Settings_Action::instance()->get_global_settings();
        $pages = Settings_Action::instance()->get_all_pages();
        array_unshift($pages, ['ID' => esc_html__('elemailer_page', 'elemailer'), 'post_title' => esc_html__('Elemailer Page', 'elemailer')]);
        if (\Elemailer\Lib\License\Action::instance()->is_plugin_activate()) {
            include 'view/settings.php';
        }
    }
}

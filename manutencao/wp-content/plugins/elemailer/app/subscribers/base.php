<?php

namespace Elemailer\App\Subscribers;

use \Elemailer\App\Lists\Action as Lists_Action;

defined('ABSPATH') || exit;

/**
 * subscribers related base class for initialization
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
     * initialization function for all of the emails related functionality
     *
     * @return void
     * @since 1.0.0
     */
    public function init()
    {
        $this->api = new Api();
    }

    /**
     * call page markup for subscribers functionality function
     *
     * @return void
     * @since 1.0.0
     */
    public function subscribers_interface()
    {
        $option_lists = Lists_Action::instance()->format_lists_for_option();
        if (\Elemailer\Lib\License\Action::instance()->is_plugin_activate()) {
            include 'view/subscribers.php';
        }
    }
}

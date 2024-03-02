<?php

namespace Elemailer\App\Lists;

defined('ABSPATH') || exit;

/**
 * template related base class for initialization
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
     * initialization function for all of the lists related functionality
     *
     * @return void
     * @since 1.0.0
     */
    public function init()
    {
        $this->api = new Api();
    }

    /**
     * show lists related admin page function
     *
     * @return void
     * @since 1.0.0
     */
    public function lists_interface()
    {
        if (\Elemailer\Lib\License\Action::instance()->is_plugin_activate()) {
            include 'view/lists.php';
        }
    }
}

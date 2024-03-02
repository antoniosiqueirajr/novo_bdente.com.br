<?php

namespace Elemailer\App\Emails;

defined('ABSPATH') || exit;

use \Elemailer\App\Lists\Action as Lists_Action;

/**
 * global emails related base class for initialization
 * 
 * @author elEmailer
 * @since 1.0.0
 */
class Base
{

    use \Elemailer\Traits\Singleton;

    public $emails;
    public $taxonomy;
    public $api;

    /**
     * initialization function for all of the emails related functionality
     *
     * @return void
     * @since 1.0.0
     */
    public function init()
    {
        $this->emails = new Cpt();
        $this->taxonomy = new Taxonomy();
        $this->taxonomy->add_default_terms_for_emails();
        $this->api = new Api();
    }

    /**
     * call page markup for emails functionality function
     *
     * @return void
     * @since 1.0.0
     */
    public function emails_user_interface()
    {
        $option_lists = Lists_Action::instance()->format_lists_for_option();
        $capabilities = array_reverse(Action::instance()->get_all_capabilities());
        if(\Elemailer\Lib\License\Action::instance()->is_plugin_activate()){
            include 'view/emails.php';
        }
    }
}

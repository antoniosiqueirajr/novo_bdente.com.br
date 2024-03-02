<?php

namespace Elemailer\Integrations\Shortcode\Actions;
use Elemailer\App\Settings\Action as Settings_Action;


defined('ABSPATH') || exit;

/**
 * Shortcode action related base class
 *
 * @author elEmailer 
 * @since 1.0.3
 */
class Base
{
    use \Elemailer\Traits\Singleton;

    /**
     * initial function for every action of Shortcode
     *
     * @return void
     * @since 1.0.3
     */
    public function init()
    {
        Hooks::instance()->init();

        // don't run if not needed
        $this->global_settings = Settings_Action::instance()->get_global_settings();
        if( !empty($this->global_settings['wp_email_override_enabled']) && ($this->global_settings['wp_email_override_enabled'] == 'yes')){
            Elewpmail::instance()->init(); 
        }
    }

}

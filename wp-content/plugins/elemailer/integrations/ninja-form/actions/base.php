<?php

namespace Elemailer\Integrations\NinjaForm\Actions;

defined('ABSPATH') || exit;

/**
 * ninjaform integration related base class
 *
 * @author elEmailer 
 * @since 1.0.0
 */
class Base
{
    use \Elemailer\Traits\Singleton;

    /**
     * initialize function for loading everything related on ninjaform
     *
     * @return void
     * @since 1.0.0
     */
    public function init()
    {
        Hooks::instance()->init();

    }

}

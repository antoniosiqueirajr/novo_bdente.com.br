<?php

namespace Elemailer\Integrations\Pafe\Actions;

defined('ABSPATH') || exit;

/**
 * Pafe action related base class
 *
 * @author elEmailer 
 * @since x.x.x
 */
class Base
{
    use \Elemailer\Traits\Singleton;

    /**
     * Initial function for every action of pafe
     *
     * @return void
     * @since x.x.x
     */
    public function init()
    {
        Hooks::instance()->init();
    }

}

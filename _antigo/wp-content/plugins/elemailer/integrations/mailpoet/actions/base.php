<?php

namespace Elemailer\Integrations\Mailpoet\Actions;

defined('ABSPATH') || exit;

/**
 * mailpoet action related base class
 *
 * @author elEmailer 
 * @since 1.0.0
 */
class Base
{
    use \Elemailer\Traits\Singleton;

    /**
     * initial function for every action of mailpoet
     *
     * @return void
     * @since 1.0.0
     */
    public function init()
    {
        Hooks::instance()->init();
    }

}

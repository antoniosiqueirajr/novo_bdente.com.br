<?php

namespace Elemailer\Integrations\Fluentform\Actions;

defined('ABSPATH') || exit;

/**
 * Fluent form action related base class
 *
 * @author elEmailer 
 * @since x.x.x
 */
class Base {
    use \Elemailer\Traits\Singleton;

    /**
     * Initial function for every action of fluent form
     *
     * @return void
     * @since x.x.x
     */
    public function init() {
        Hooks::instance()->init();
    }
}

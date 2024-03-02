<?php

namespace Elemailer\Integrations\Mailpoet;

defined('ABSPATH') || exit;

/**
 * mailpoet integration related base class
 *
 * @author elEmailer 
 * @since 1.0.0
 */
class Base
{
    use \Elemailer\Traits\Singleton;

    /**
     * initialize function for loading everything related on mailpoet
     *
     * @return void
     * @since 1.0.0
     */
    public function init()
    {
        Actions\Base::instance()->init();
    }

}

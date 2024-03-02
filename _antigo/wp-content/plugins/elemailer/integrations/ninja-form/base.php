<?php

namespace Elemailer\Integrations\NinjaForm;

defined('ABSPATH') || exit;

/**
 * ninjaform integration related base class
 *
 * @author Elemailer 
 * @since 2.4
 * we are doing integration for email template and lead collection
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
        // return early if ninjaform is not here
        if ( ! class_exists('Ninja_Forms') ) {
            return;  
        }

        Actions\Base::instance()->init();

     }
     
}

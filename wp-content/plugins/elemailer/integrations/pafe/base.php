<?php

namespace Elemailer\Integrations\Pafe;

defined('ABSPATH') || exit;

/**
 * Pafe integration related base class
 *
 * @author elEmailer
 * @since x.x.x
 */
class Base
{
    use \Elemailer\Traits\Singleton;

    /**
     * Initialize function for loading everything related on pafe
     *
     * @return void
     * @since x.x.x
     */
    public function init()
    {   
        // return early if pafe is not here
        if(!class_exists('Piotnet_Addons_For_Elementor_Pro')){
            return;  
        }

        Actions\Base::instance()->init();
    

    }

}

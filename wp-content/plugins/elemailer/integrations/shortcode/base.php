<?php

namespace Elemailer\Integrations\Shortcode;

defined('ABSPATH') || exit;

/**
 * Shortcode integration related base class
 * We will add all shortcode support through this class 
 * @author elEmailer 
 * @since 1.0.3
 */
class Base
{
    use \Elemailer\Traits\Singleton;

    /**
     * initialize function for loading everything related on mailpoet
     *
     * @return void
     * @since 1.0.3
     */
    public function init()
    {
        Actions\Base::instance()->init();
    }

    /**
     * Add shortcodes generator page content
     *
     * @return void
     * @since x.x.x
     */
    public function shortcode_interface()
    {
        $get_all_template = \Elemailer\App\Form_Template\Action::instance()->get_all_template();
        
        echo '<div class="elemailer-shortcode-wrap-menu-page">';
        include_once ELE_MAILER_PLUGIN_PUBLIC_DIR . '/views/shortcode-floating-icon.php';
        echo '</div>';
    }

}

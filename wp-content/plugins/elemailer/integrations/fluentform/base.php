<?php

namespace Elemailer\Integrations\Fluentform;

defined('ABSPATH') || exit;

/**
 * FluentForm integration related base class
 *
 * @author elEmailer
 * @since x.x.x
 */
class Base {

    use \Elemailer\Traits\Singleton;

    /**
     * Initialize function for loading everything related on FluentForm
     *
     * @return void
     * @since x.x.x
     */
    public function init() {
        // Return early if fluent form is not here
        if ( ! defined( 'FLUENTFORM_DIR_PATH' ) ) {
            return;  
        }
        
        // Some important files
        // app/public/wp-content/plugins/fluentform/app/Services/FormBuilder/Notifications/EmailNotification.php
        // app/public/wp-content/plugins/fluentform/app/Services/FormBuilder/Notifications/EmailNotificationActions.php
        // app/public/wp-content/plugins/fluentform/app/Services/Integrations/GlobalNotificationManager.php
        Actions\Base::instance()->init();
        Actions\Subscribe::instance();
    }
}

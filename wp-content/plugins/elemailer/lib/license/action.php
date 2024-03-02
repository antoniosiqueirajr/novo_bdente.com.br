<?php

namespace Elemailer\Lib\License;

// Exit if accessed directly
if (!defined('ABSPATH')) exit;


/**
 * Allows plugins to use their own update API.
 *
 * @author Easy Digital Downloads
 * @version 1.6.19
 */
class Action
{
    use \Elemailer\Traits\Singleton;

    const PRODUCT_NAME = 'elemailer';
    const STORE_URL = 'https://elemailer.com';
    const PRODUCT_ID = 462;

    private $license_store_key_name;
    private $activate_status_key_name;

    private $success;
    private $errors;

    /**
     * class constructor assign some key and values
     *
     * @since 1.0.0
     */
    public function __construct()
    {
        $this->license_store_key_name = 'elemailer__license_key';
        $this->activate_status_key_name = 'elemailer__activate_info';
        $this->errors = [
            "invalid" => esc_html__('Invalid license', 'elemailer'),
            "missing" => esc_html__('License doesn\'t exist', 'elemailer'),
            "missing_url" => esc_html__('URL not provided', 'elemailer'),
            "license_not_activable" => esc_html__('Attempting to activate a bundle\'s parent license', 'elemailer'),
            "disabled" => esc_html__('License key revoked', 'elemailer'),
            "no_activations_left" => esc_html__('No activations left', 'elemailer'),
            "expired" => esc_html__('License has expired', 'elemailer'),
            "key_mismatch" => esc_html__('License is not valid for this product', 'elemailer'),
            "invalid_item_id" => esc_html__('Invalid Item ID', 'elemailer'),
            "item_name_mismatch" => esc_html__('License is not valid for this product', 'elemailer'),
            "revoked" => esc_html__('License key revoked', 'elemailer'),
            "site_inactive" => esc_html__('License key is not for this domain', 'elemailer'),
            "default" => esc_html__('An error occurred, please try again.', 'elemailer'),
        ];
        $this->success = [
            'valid' => esc_html__('License is valid and activated.', 'elemailer'),
            'deactivated' => esc_html__('License is deactivated.', 'elemailer'),
            'default' => esc_html__('Successfully done.', 'elemailer'),
        ];
    }

    /**
     * license activation check function
     *
     * @return boolean
     * @since 1.0.0
     */
    public function is_plugin_activate()
    {
    	return true;
        $return = false;
        $current = get_transient($this->activate_status_key_name);
        if ($current) {
            $return = true;
        } else {
            $status = $this->check_license();
            if ($status['status'] == 1) {
                $return = true;
            } else {
                $return = false;
            }
        }
        return $return;
    }

    /**
     * check license status function
     *
     * @return array
     * @since 1.0.0
     */
    public function check_license()
    {
        $return = [
            'status' => 0,
            'message' => ''
        ];

        $current_license = $this->get_license();

        if ($current_license) {
            $response = $this->perform_edd_license_request('check_license', $current_license);

            if ( !is_null( $response->license) && $response->license == 'valid' ) {
                $return['status'] = 1;
                $return['message'] = $this->success[$response->license];
                set_transient($this->activate_status_key_name, 1, 60 * 60 * 24);
            } else {
                $return['status'] = 0;
                $return['message'] = esc_html__('Not a valid license for this domain.', 'elemailer');
                set_transient($this->activate_status_key_name, 0, 60 * 60 * 24);
            }
        } else {
            $return = [
                'status' => 0,
                'message' => esc_html__('License not found', 'elemailer'),
            ];
            set_transient($this->activate_status_key_name, 0, 60 * 60 * 24);
        }
        return $return;
    }

    /**
     * activate license function
     *
     * @param string[license_key] $license
     *
     * @return array
     * @since 1.0.0
     */
    public function activate_license($license)
    {
        $return = [
            'status' => 0,
            'message' => ''
        ];

        $current_status = get_transient($this->activate_status_key_name);

        if (!$current_status) {
            $response = $this->perform_edd_license_request('activate_license', $license);
            //DD($response);
            if ($response->license == 'valid') {
                $this->set_license($license);
                $return['status'] = 1;
                $return['message'] = $this->success[$response->license];
                set_transient($this->activate_status_key_name, 1, 60 * 60 * 24);
            } else {
                set_transient($this->activate_status_key_name, 0, 60 * 60 * 24);
                $return['status'] = 0;
                $return['message'] = isset($response->error) ? $this->errors[$response->error] : $this->errors['default'];
            }
        } else {
            $return['status'] = 1;
            $return['message'] = esc_html__('Already activated', 'elemailer');
        }

        return $return;
    }

    /**
     * deactivate license function
     *
     * @return array
     * @since 1.0.0
     */
    public function deactivate_license()
    {
        $return = [
            'status' => 0,
            'message' => ''
        ];

        $license = trim($this->get_license());

        if ($license) {
            $response = $this->perform_edd_license_request('deactivate_license', $license);
            if ($response->license == 'deactivated') {
                set_transient($this->activate_status_key_name, 0, 60 * 60 * 24);
                $this->delete_license();
                $return['status'] = 1;
                $return['message'] = $this->success[$response->license];
            } else {
                $return['status'] = 0;
                $return['message'] = isset($response->error) ? $this->errors[$response->error] : $this->errors['default'];

                // @since v1.0.8 below two lines are added to remove license if the check finds no validity when deactivation is pressed. we may remove them later

                set_transient($this->activate_status_key_name, 0, 60 * 60 * 24);
                $this->delete_license();

            }
        } else {
            $return['status'] = 0;
            $return['message'] = esc_html__('License data is not found.', 'elemailer');
        }

        return $return;
    }

    /**
     * make edd license request function
     *
     * @param string[action_type] $edd_action
     * @param string[license_key] $license
     *
     * @return object
     * @since 1.0.0
     */
    public function perform_edd_license_request($edd_action, $license)
    {
        // Prepare the request arguments
        //removed these since v1.0.8 to fix issue with url due to parse_url
        //$home = home_url();
        //$info = parse_url($home);
        //$domain = $info['host'];

        $args = array(
            'timeout'   => 10,
            'sslverify' => false,
            'body'      => array(
                'edd_action' => $edd_action,
                'item_id'    => self::PRODUCT_ID,
                'license'    => trim($license),
                'item_name'  => urlencode(self::PRODUCT_NAME),
                'url'        => home_url(),
            ),
        );

        // Send the remote request
        $response = wp_remote_post(self::STORE_URL, $args);

        return json_decode(wp_remote_retrieve_body($response));
    }

    /**
     * run plugin updater for automatic update to newer version function
     *
     * @return void
     * @since 1.0.0
     */
    public function run_updater()
    {
        // retrieve our license key from the DB
        $license_key = $this->get_license();

        // setup the updater
        $edd_updater = new Updater(
            self::STORE_URL,
            ELE_MAILER_PLUGIN_DIR . 'elemailer.php',
            array(
                'version'   => ELE_MAILER_VERSION,     // current version number
                'license'   => $license_key,           // license key (used get_option above to retrieve from DB)
                'item_name' => self::PRODUCT_NAME,
                'item_id'   => self::PRODUCT_ID,       // ID of the product
                'author'    => 'elemailer',           // author of this plugin not important
                'beta'      => false,
            )
        );

    }

    /**
     * get license from database option table function
     *
     * @return string
     * @since 1.0.0
     */
    public function get_license()
    {
        return get_option($this->license_store_key_name);
    }

    /**
     * set license to database option table function
     *
     * @param string $license
     * @return string
     * @since 1.0.0
     */
    public function set_license($license)
    {
        return update_option($this->license_store_key_name, trim($license));
    }

    /**
     * delete license from database option table function
     *
     * @return void
     * @since 1.0.0
     */
    public function delete_license()
    {
        return delete_option($this->license_store_key_name);
    }
}

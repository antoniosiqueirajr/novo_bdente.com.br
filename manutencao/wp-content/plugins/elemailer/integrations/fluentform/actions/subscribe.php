<?php

namespace Elemailer\Integrations\Fluentform\Actions;

use FluentForm\App\Services\Integrations\IntegrationManager;
use FluentForm\App\Services\Integrations\MailChimp\MailChimpSubscriber as Subscriber;
use FluentForm\Framework\Helpers\ArrayHelper;
use \Elemailer\App\Lists\Action as Lists_Action;
use \Elemailer\App\Subscribers\Action as Subscribers_Action;

class Subscribe extends IntegrationManager{

    use \Elemailer\Traits\Singleton;

    /**
     * Elemailer Subscriber that handles & process all the subscribing logics.
     */
    use Subscriber;

    public function __construct() {
        parent::__construct(
            null,
            'Elemailer',
            'elemailer',
            '_fluentform_elemailar_details',
            'elemailar_feeds',
            12
        );

        $this->description = 'Fluent Forms Elemailer module allows you to collect leads from your form and insert inside Elemailer';

        $this->logo = ELE_MAILER_PLUGIN_PUBLIC . '/assets/img/elemailer-icon.svg';
        $this->registerAdminHooks();
    }

    public function getGlobalFields($fields) {
        return [
            'logo'             => $this->logo,
            'menu_title'       => __('Elemailer Settings', 'elemailer'),
            'menu_description' => __('Elemailer is a marketing platform for small businesses. Send beautiful emails, connect your e-commerce store, advertise, and build your brand. Use Fluent Forms to collect customer information and automatically add it to your Elemailer list.', 'elemailer'),
            'save_button_text' => __('Save Settings', 'elemailer'),
            'fields'           => [
                'apiKey' => [
                    'type'       => 'text',
                    'label_tips' => __("Enter your a label.", 'elemailer'),
                    'label'      => __('Name', 'elemailer'),
                ]
            ],
            'hide_on_valid'    => true,
            'discard_settings' => [
                'section_description' => 'Your Elemailer API integration is up and running',
                'button_text'         => 'Disconnect Elemailer',
                'data'                => [
                    'apiKey' => 'Elemailer'
                ],
                'show_verify'         => false
            ]
        ];
    }

    public function getGlobalSettings( $settings ) {
        $globalSettings = get_option($this->optionKey);
        if ( ! $globalSettings ) {
            $globalSettings = [];
        }
        $defaults = [
            'apiKey' => '',
            'status' => ''
        ];

        return wp_parse_args($globalSettings, $defaults);
    }

    public function saveGlobalSettings( $elemailer ) {
        $Settings = [
            'apiKey' => sanitize_text_field( $elemailer['apiKey'] ),
            'status' => true
        ];

        update_option($this->optionKey, $Settings, 'no`');

        wp_send_json_success([
            'message' => __('Your elemailer configure data has been verfied and successfully set', 'elemailer'),
            'status'  => true
        ], 200);
    }

    public function pushIntegration( $integrations, $formId ) {
        $integrations['elemailer'] = [
            'title'                 => __('Elemailer Feed', 'elemailer'),
            'logo'                  => $this->logo,
            'is_active'             => true,
            'configure_title'       => __('Configuration required!', 'elemailer'),
            'global_configure_url'  => admin_url('admin.php?page=fluent_forms_settings#elemailer'),
            'configure_message'     => __('Elemailer is not configured yet! Please configure your elemailer api first', 'elemailer'),
            'configure_button_text' => __('Set Elemailer API', 'elemailer')
        ];

        return $integrations;
    }

    public function getIntegrationDefaults( $settings, $formId ) {
        $settings = [
            'conditionals'      => [
                'conditions' => [],
                'status'     => false,
                'type'       => 'all'
            ],
            'enabled'           => true,
            'list_id'           => '',
            's_status'           => 'subscribed',
            'list_name'         => '',
            'name'              => '',
            'merge_fields'      => (object)[],
        ];

        return $settings;
    }

    public function getSettingsFields( $settings, $formId ) {
        return [
            'fields'              => [
                
                [
                    'key'                => 'elemailer_merge_fields',
                    'require_list'       => false,
                    'label'              => 'Map Fields',
                    'tips'               => 'Associate your Elemailer merge tags to the appropriate Fluent Forms fields by selecting the appropriate form field from the list.',
                    'component'          => 'map_fields',
                    'field_label_remote' => 'Elemailer Field',
                    'field_label_local'  => 'Form Field',
                    'primary_fileds'     => [
                        [
                            'key'           => 'fieldEmailAddress',
                            'label'         => 'Email',
                            'required'      => true,
                            'input_options' => 'emails'
                        ],
                        [
                            'key'           => 'fieldFirstName',
                            'label'         => 'First Name',
                            'required'      => false,
                            'input_options' => 'first_name'
                        ],
                        [
                            'key'           => 'fieldLastName',
                            'label'         => 'Last Name',
                            'required'      => false,
                            'input_options' => 'last_name'
                        ]
            
                    ]
                ],
                [
                    'key'         => 'list_id',
                    'label'       => 'Elemailer List(s)',
                    'placeholder' => 'Select Elemailer List(s)',
                    'tips'        => 'Select the Elemailer list you would like to add your contacts to or leave it empty to just add subscriber inside Elemailer but not segment it via list',
                    'component'   => 'select',
                    'is_multiple' =>  true, // boolean
                    'options'     => $this->getLists(),
                ], 
                [
                    'key'         => 's_status',
                    'label'       => 'Default Status',
                    'tips'        => 'Set a default status for your subscriber. Double opt-in email will work accordingly',
                    'component'   => 'select',
                    'required'    => true,
                    'options' => [
                                    'subscribed'    => esc_html__( 'Subscribed', 'elemailer' ),
                                    'unconfirmed'   => esc_html__( 'Unconfirmed', 'elemailer' ),
                                    'unsubscribed'  => esc_html__( 'Unsubscribed', 'elemailer' ),
                                    'inactive'      => esc_html__( 'Inactive', 'elemailer' ),
                                ],
                ],
                [
                    'require_list'    => false,
                    'key'             => 'enabled',
                    'label'           => 'Status',
                    'component'       => 'checkbox-single',
                    'checkbox_label' => 'Enable This feed'
                ]
            ],
            'button_require_list' => false,
            'integration_title'   => 'Elemailer'
        ];
    }

    public function setFeedAtributes( $feed, $formId ) {
        $feed['provider']      = 'elemailer';
        $feed['provider_logo'] = $this->logo;

        return $feed;
    }

    public function prepareIntegrationFeed( $setting, $feed, $formId ) {
        $defaults = $this->getIntegrationDefaults([], $formId);

        foreach ( $setting as $settingKey => $settingValue ) {
            if ($settingValue == 'true') {
                $setting[$settingKey] = true;
            } else if ($settingValue == 'false') {
                $setting[$settingKey] = false;
            } else if ($settingKey == 'conditionals') {
                if ($settingValue['status'] == 'true') {
                    $settingValue['status'] = true;
                } else if ($settingValue['status'] == 'false') {
                    $settingValue['status'] = false;
                }
                $setting['conditionals'] = $settingValue;
            }
        }

        return wp_parse_args($setting, $defaults);
    }

    private function getLists() {
        $option_lists = Lists_Action::instance()->format_lists_for_option();

        return $option_lists;
    }

    public function getMergeFields( $list, $listId, $formId ) {
        // future use
    }

    public function findMergeFields( $listId ) {
        // future use
    }

    private function getInterestCategories( $listId ) {
        // future use
    }

    private function getInterestSubCategories( $listId, $categoryId ) {
        // future use
    }

    /*
    * For Handling Notifications broadcast
    */
    public function notify( $feed, $formData, $entry, $form ) {
        $feedData = $feed['processedValues'];

        if ( ! is_email( $feedData['fieldEmailAddress'] ) ) {
            $feedData['fieldEmailAddress'] = ArrayHelper::get( $formData, $feedData['fieldEmailAddress'] );
        }

        if ( ! is_email( $feedData['fieldEmailAddress'] ) ) {
            return false;
        }

        $elemailer_data = [
            'first-name'    => isset( $feedData['fieldFirstName'] ) ? $feedData['fieldFirstName'] : '',
            'last-name'     => isset( $feedData['fieldLastName'] ) ? $feedData['fieldLastName'] : '',
            'email'         => $feedData['fieldEmailAddress'],
            'status'        => $feedData['s_status'],
            'subscribed_ip' => get_elemailer_client_ip(),
            'link_token'    => md5( $feedData['fieldEmailAddress']),
            'source'        => 'form',
            'list_id'       => (isset( $feedData['list_id'] )) ? $feedData['list_id'] : [],
        ];

        Subscribers_Action::instance()->store( 0, $elemailer_data, 'elemailer-3rd-party' );
    }
}

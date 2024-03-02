<?php

namespace Elemailer\App\Settings;

defined('ABSPATH') || exit;

use \Elemailer\Helpers\Util;

/**
 * global settings store/ update related class
 * also used for getting global settings
 * 
 * @author elEmailer
 * @since 1.0.0
 */
class Action
{
    use \Elemailer\Traits\Singleton;

    private $response;
    private $action;
    private $key_global_settings;

    /**
     * initializing some property constructor function
     *
     * @return void
     * @since 1.0.0
     */
    public function __construct()
    {
        $this->response = [
            'status' => 0,
            'error' => [
                esc_html('Something went wrong!')
            ],
            'data' => [
                'message' => '',
            ],
        ];

        $this->key_global_settings = 'elemailer__global_setting';
    }

    /**
     * global settings store/ update function
     *
     * @param string[not_used_right_now] $action
     * @param array[settings] $submitted_data
     *
     * @return array[operation_status] $this->response
     * @since 1.0.0
     */
    public function store($action, $submitted_data)
    {
        if (!current_user_can('manage_options')) {
            return;
        }

        unset($submitted_data['action']);
        unset($submitted_data['id']);

        $status = update_option($this->key_global_settings, $submitted_data);

        if ($status) {
            $this->response['status'] = 1;
            $this->response['error'] = '';
            $this->response['data']['message'] = esc_html__('Setting is updated.', 'elemailer');
        } else {
            $this->response['status'] = 0;
            $this->response['error'] = esc_html__('Setting is not updated due to no data changes.', 'elemailer');
            $this->response['data']['message'] = '';
        }

        return $this->response;
    }

    /**
     * get global settings function
     *
     * @return array[settings] $global
     * @since 1.0.0
     */
    public function get_global_settings()
    {
        $global = get_option($this->key_global_settings);
        return $global;
    }

    /**
     * get all pages function
     * currently used for selecting redirection pages like manage subscribe/unsubscribe, sucess pages
     *
     * @return array[pages_info] $pages
     * @since 1.0.0
     */
    public function get_all_pages()
    {
        $args = [
            'sort_order'   => 'ASC',
            'sort_column'  => 'post_title',
            'number'       => '',
            'post_type'    => 'page',
            'post_status'  => 'publish',
        ];

        $raw_pages = get_pages($args);

        $pages = array_map(function ($val) {
            return [
                'ID' => $val->ID,
                'post_title' => $val->post_title,
            ];
        }, $raw_pages);

        $pages = (is_array($pages) ? $pages : []);

        return $pages;
    }

    /**
     * process permalink for preview pages function
     *
     * @param int/string[page_id] $id
     * @param array['type' => 'opt_in_confirm_page'/'subscription_confirmation_page'/ 'unsubscribe_action_page'/'unsubscribe_success_page'] $params
     * @return string[url] $return_url
     * @since 1.0.0
     */
    public function get_page_permalink($id, $params)
    {
        if ($id == 'elemailer_page') {
            $url = get_home_url(). '?elemailer_route=1';
        } else {
            $url = get_permalink($id);
        }

        switch ($params['type']) {
            case "opt_in_confirm_page":
                $add_subscription_param = Util::add_param_url($url, 'elemailer_page', 'subscriptions');
                $return_url = $add_subscription_param . '&elemailer_status=user_confirmation&action=subscribed&data=administrator_view';
                break;
            case "subscription_confirmation_page":
                $add_manage_subscription_param = Util::add_param_url($url, 'elemailer_page', 'subscriptions');
                $return_url = $add_manage_subscription_param . '&elemailer_status=user_confirmation&action=manage_subscription&data=administrator_view';
                break;
            case "unsubscribe_action_page":
                $add_manage_unsubscription_param = Util::add_param_url($url, 'elemailer_page', 'unsubscriptions');
                $return_url = $add_manage_unsubscription_param . '&elemailer_status=user_confirmation&action=manage_unsubscription&data=administrator_view';
                break;
            case "unsubscribe_success_page":
                $add_unsubscription_param = Util::add_param_url($url, 'elemailer_page', 'unsubscriptions');
                $return_url = $add_unsubscription_param . '&elemailer_status=user_confirmation&action=unsubscribe&data=administrator_view';
                break;
            default:
        }

        return $return_url;
    }
}

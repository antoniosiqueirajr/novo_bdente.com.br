<?php

namespace Elemailer\App\Subscribers;

defined('ABSPATH') || exit;

use \Elemailer\App\Settings\Action as Settings_Action;
use \Elemailer\Lib\Database\DB;
use \Elemailer\Helpers\Util;
use Elemailer\Lib\Cron\Welcome_Email;
use Elemailer\Lib\Cron\WooCommerce_Email;

/**
 * subscriber insert/ update related class to be used with different platform / integration
 * also used for getting subscribers
 * edited by soykot
 * @author elEmailer
 * @since 1.0.0
 */
class Action
{
    use \Elemailer\Traits\Singleton;

    private $response;
    private $action;
    private $subscribers_info;

    private $global_settings;

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

        $this->global_settings = Settings_Action::instance()->get_global_settings();
    }

    /**
     * subscribers insert/ update decision maker function
     *
     * @param int[id] $id
     * @param array[info] $subscribers_info
     *
     * @return array $response
     * @since 1.0.0
     */
    public function store($id, $subscribers_info, $source = '' )
    {
        if ( ! current_user_can( 'manage_options' ) && 'elemailer-3rd-party' !== $source ) {
            return;
        }

        $this->id = $id;
        $this->subscribers_info = $subscribers_info;

        // id 0 for new creation sent from frontend
        if ($this->id == 0) {
            $this->insert();
        } else {
            $this->update();
        }

        return $this->response;
    }

    /**
     * insert subscriber function
     *
     * @return void
     * @since 1.0.0
     */
    public function insert()
    {
        $data = [
            'wp_user_id' => 0,
            'is_woocommerce_user' => 0,
            'first_name' =>  isset($this->subscribers_info['first-name']) ? $this->subscribers_info['first-name'] : '',
            'last_name' =>  isset($this->subscribers_info['last-name']) ? $this->subscribers_info['last-name'] : '',
            'email' => isset($this->subscribers_info['email']) ? $this->subscribers_info['email'] : '',
            'status' => isset($this->subscribers_info['status']) ? $this->subscribers_info['status'] : 'unconfirmed',
            'subscribed_ip' => isset($this->subscribers_info['subscribed_ip']) ? $this->subscribers_info['subscribed_ip'] : '',
            'link_token' => md5(isset($this->subscribers_info['email']) ? $this->subscribers_info['email'] : ''),
            'source' => isset($this->subscribers_info['source']) ? $this->subscribers_info['source'] : '',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ];

        $format = [
            '%d',
            '%d',
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
        ];
        //if only valid email format then process
        if( is_email( $this->subscribers_info['email']) ){
            // get subscriber with current email
            $existence = DB::get_all_data_with_single_condition('elemailer_subscribers', 'email', (isset($this->subscribers_info['email']) ? $this->subscribers_info['email'] : ''));  
        }else {
            $this->response['status'] = 0;
            $this->response['data']['message'] = '';
            $this->response['error'] = esc_html__('Invalid email given', 'elemailer');
            return;
        }
        
        //if only valid email format then process && continue process if not existed in Db before.
       
        if ( empty($existence) ) {
            // insert subscriber
            $subscriber_id = DB::insert('elemailer_subscribers', $data, $format);

            // action after insertion of subscriber
            if ($subscriber_id) {
                // get assigned list id for this subscriber
                $lists = isset($this->subscribers_info['list_id']) ? $this->subscribers_info['list_id'] : [];

                //Insert into list if list is chosen otherwise skip
                if( !empty($this->subscribers_info['list_id']) ){

                        // assign subscriber to all lists
                    foreach ($lists as $k => $v) {

                        $list_data = [
                            'subscriber_id' => $subscriber_id,
                            'list_id' => $v,
                            'created_at' => date('y-m-d H:i:s'),
                            'updated_at' => date('y-m-d H:i:s'),
                        ];

                        $list_format = [
                            '%d',
                            '%d',
                            '%s',
                            '%s',
                        ];

                        // insert subscriber in list
                        if ( $v ) {
                            $subscriber_in_list = DB::insert('elemailer_subscribers_lists', $list_data, $list_format);
                        }
                    }

                    // after completing all insertion and if subscriber is in a list
                    if ( $subscriber_in_list && $data['source'] != 'imported' ){

                        // double opt in mail send when it's enable on global settings and subscriber's status is unconfirmed
                        if ($this->global_settings['enable_mail_opt_in'] == 'yes' && $this->subscribers_info['status'] == 'unconfirmed') {
                            $status = $this->send_confirmation_email(isset($this->subscribers_info['email']) ? $this->subscribers_info['email'] : '');
                        }
                        // double opt in is not enable in global settings 
                        if ($this->global_settings['enable_mail_opt_in'] != 'yes') {
                            // trigger welcome email send it will sent if applicable any
                            $status = Welcome_Email::new_subscriber_trigger($subscriber_id);
                        }

                        $this->response['status'] = 1;
                        $this->response['data']['message'] = esc_html__('Successfully added', 'elemailer');
                        $this->response['error'] = '';
                    }                   
                }//!empty($this->subscribers_info['list_id'])
                
                $this->response['status'] = 1;
                $this->response['data']['message'] = esc_html__('Successfully added', 'elemailer');
                $this->response['error'] = '';                
            }


        } else {
            $this->response['status'] = 0;
            $this->response['data']['message'] = '';
            $this->response['error'] = esc_html__('Subscriber already exists in Database.', 'elemailer');
        }
    }

    /**
     * update subscriber information function
     *
     * @return void
     * @since 1.0.0
     */
    public function update()
    {
        $data = [
            'first_name' =>  isset($this->subscribers_info['first-name']) ? $this->subscribers_info['first-name'] : '',
            'last_name' =>  isset($this->subscribers_info['last-name']) ? $this->subscribers_info['last-name'] : '',
            'email' => isset($this->subscribers_info['email']) ? $this->subscribers_info['email'] : '',
            'status' => isset($this->subscribers_info['status']) ? $this->subscribers_info['status'] : '',
            'updated_at' => date("Y-m-d H:i:s"),
        ];

        $format = [
            '%s',
            '%s',
            '%s',
            '%s',
        ];

        $condition = [
            'id' => $this->id,
        ];

        $condition_format = [
            '%d',
        ];

        // update subscriber info
        $status = DB::update('elemailer_subscribers', $data, $condition, $format, $condition_format);
        
        
        // for assigning current lists for this subscriber, delete previous assigned lists
        $assign_list_delete = DB::delete('elemailer_subscribers_lists', ['subscriber_id' => $this->id], ['%d']);
    
    
        // after delation of previous lists

            // get lists id
            $lists = isset($this->subscribers_info['list_id']) ? $this->subscribers_info['list_id'] : 0;

            if(!empty($lists)){
                // assign subscriber to all lists
                foreach ($lists as $k => $v) {

                    $list_data = [
                        'subscriber_id' => $this->id,
                        'list_id' => $v,
                        'created_at' => date('y-m-d H:i:s'),
                        'updated_at' => date('y-m-d H:i:s'),
                    ];

                    $list_format = [
                        '%d',
                        '%d',
                        '%s',
                        '%s',
                    ];

                    // insert subscribe in list
                    $subscriber_in_list = DB::insert('elemailer_subscribers_lists', $list_data, $list_format);
                }
            }
          
        

        // after updating subcriber info
        if ($status) {

            // double opt in mail send when it's enable on global settings and subscriber's status is unconfirmed
            if ($this->global_settings['enable_mail_opt_in'] == 'yes' && $this->subscribers_info['status'] == 'unconfirmed') {
                $status = $this->send_confirmation_email(isset($this->subscribers_info['email']) ? $this->subscribers_info['email'] : '');
            }

            $this->response['status'] = 1;
            $this->response['data']['message'] = esc_html__('Successfully Updated', 'elemailer');
            $this->response['error'] = '';
        } else {
            $this->response['status'] = 0;
            $this->response['data']['message'] = '';
            $this->response['error'] = esc_html__('Not Updated in the database. Try again.', 'elemailer');
        }
    }

    /**
     * subscriber delete function by id
     *
     * @param int[subscriber_id] $id
     * @return array[operation_status] $this->response
     * @since 1.0.0
     */
    public function delete($id)
    {
        if (!current_user_can('manage_options')) {
            return;
        }

        $this->id = $id;

        $condition = [
            'id' => $this->id,
        ];

        $format = [
            '%d',
        ];

        // delete subscriber
        $status = DB::delete('elemailer_subscribers', $condition, $format);

        if ($status) {
            $this->response['status'] = 1;
            $this->response['data']['message'] = esc_html__('Successfully deleted', 'elemailer');
            $this->response['error'] = '';
        } else {
            $this->response['status'] = 0;
            $this->response['data']['message'] = '';
            $this->response['error'] = esc_html__('Not deleted from the database. Try again.', 'elemailer');
        }

        return $this->response;
    }

    /**
     * subscriber status change function by id
     *
     * @param int[subscriber_id] $id
     * @param array[change_info] $subscribers_info
     * @return array[operation_status] $this->response
     * @since 1.0.0
     */
    public function change_status($id, $subscribers_info)
    {
        if (!current_user_can('manage_options')) {
            return;
        }

        $this->id = $id;

        if ($subscribers_info['status'] == 'trash') {
            $data = [
                'status' => 'trash',
                'updated_at' => date('y-m-d H:i:s'),
            ];
        } else {
            $data = [
                'status' => 'published',
                'updated_at' => date('y-m-d H:i:s'),
            ];
        }

        $format = [
            '%s',
            '%s',
        ];

        $condition = [
            'id' => $this->id,
        ];

        $condition_format = [
            '%d',
        ];

        // update subscribers with changed information
        $status = DB::update('elemailer_subscribers', $data, $condition, $format, $condition_format);

        if ($status) {
            $this->response['status'] = 1;
            $this->response['data']['message'] = esc_html__('Successfully deleted', 'elemailer');
            $this->response['error'] = '';
        } else {
            $this->response['status'] = 0;
            $this->response['data']['message'] = $status;
            $this->response['error'] = esc_html__('Not deleted from the database. Try again.', 'elemailer');
        }

        return $this->response;
    }

    /**
     * subscriber status change function by multiple id
     *
     * @param string[status] $status
     * @param array[selected_ids] $selected
     * @return array[operation_status] $this->response
     * @since 1.0.0
     */
    public function change_status_multiple($status, $selected)
    {
        foreach ($selected as $select) {
            if ($status == 'delete') {
                $this->delete($select);
            } else {
                $this->change_status($select, ['status' => $status]);
            }
        }

        if ($status) {
            $this->response['status'] = 1;
            $this->response['data']['message'] = esc_html__('Successfully deleted multiple', 'elemailer');
            $this->response['error'] = '';
        } else {
            $this->response['status'] = 0;
            $this->response['data']['message'] = '';
            $this->response['error'] = esc_html__('Not deleted from the database. Try again. multiple', 'elemailer');
        }

        return $this->response;
    }

    /**
     * get all published subscribers function
     *
     * @param array[datatable_query_params] $query
     * @return array
     * @since 1.0.0
     */
    public function get_all_published_subscribers($query)
    {
        return DB::get_subscribers_for_data_table($query, false);
    }

    /**
     * get all trashed subscribers function
     *
     * @param array[datatable_query_params] $query
     * @return array
     * @since 1.0.0
     */
    public function get_all_trash_subscribers($query)
    {
        return DB::get_subscribers_for_data_table($query, true);
    }

    /**
     * confim subscription after clicking double opt in link from email function
     *
     * @param string[subscription_status] $status
     * @param string[link_token] $token
     * @return string[operation_status] $response
     * @since 1.0.0
     */
    public function confirm_subscribtion($status, $token)
    {
        $response = 'invalid';

        // get subscriber data with link token
        $subscriber_data = DB::get_all_data_with_single_condition('elemailer_subscribers', 'link_token', $token);

        $subscriber_data = (isset($subscriber_data[0]) ? $subscriber_data[0] : []);

        // continue if this subscriber's status is not subscribed
        if ((isset($subscriber_data['status']) ? $subscriber_data['status'] : '') != 'subscribed') {
            $data = [
                'status' => ($status == 'subscribed') ? 'subscribed' : 'unconfirmed',
                'confirmed_ip' => Util::get_client_ip(),
                'confirmed_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ];

            $format = [
                '%s',
                '%d',
                '%s',
                '%s',
            ];

            $condition = [
                'id' => (isset($subscriber_data['id']) ? $subscriber_data['id'] : ''),
            ];

            $condition_format = [
                '%d'
            ];

            // confirm subscription of a subscriber on double opt in click
            $update = DB::update('elemailer_subscribers', $data, $condition, $format, $condition_format);

            // after confirming
            if ($update) {
                $response = 'subscribed';
                // trigger welcome email send function it will send a welcome email if applicable any
                $status = Welcome_Email::new_subscriber_trigger((isset($subscriber_data['id']) ? $subscriber_data['id'] : ''));
            }
        } else {
            $response = 'already_subscribed';
        }

        return $response;
    }

    /**
     * confirmation email send function for double opt in situation
     *
     * @param string[email] $email
     * @return int[1/0]/boolean[operation_status] $send
     * @since 1.0.0
     */
    public function send_confirmation_email($email)
    {
        // get susbcribers info with email to check is this subscriber exist
        $subscriber_data = DB::get_all_data_with_single_condition('elemailer_subscribers', 'email', $email);

        $subscriber_data = (isset($subscriber_data[0]) ? $subscriber_data[0] : []);

        // get confirmation page id
        $page_id = isset($this->global_settings['opt_in_confirm_page']) ? $this->global_settings['opt_in_confirm_page'] : 'elemailer_page';

        // get confirmation page permalink
        $subscription_success_page = Settings_Action::instance()->get_page_permalink($page_id, ['type' => 'opt_in_confirm_page']);

        $subscription_success_page = str_replace('administrator_view', (isset($subscriber_data['link_token']) ? $subscriber_data['link_token'] : ''), $subscription_success_page);

        // get confirmation email template with page permalink
        $email_body = Util::get_confirmation_email_template($subscription_success_page);

        // set email headers
        $headers = sprintf('From: %s <%s>' . "\r\n", (isset($this->global_settings['sender_name']) ? $this->global_settings['sender_name'] : ''), (isset($this->global_settings['sender_email']) ? $this->global_settings['sender_email'] : ''));
        $headers .= sprintf('Reply-To: %s' . "\r\n", (isset($this->global_settings['reply_to_email']) ? $this->global_settings['reply_to_email'] : ''));
        $headers .= 'Content-Type: text/html; charset=UTF-8' . "\r\n";

        $email_to = (isset($subscriber_data['email']) ? $subscriber_data['email'] : '');

        $subject = (isset($this->global_settings['opt_in_mail_subject']) ? $this->global_settings['opt_in_mail_subject'] : '');

        // send email
        $send = wp_mail($email_to, $subject, $email_body, $headers);

        return $send;
    }

    /**
     * unsubscribe from lists handler for a subscriber function
     *
     * @param int[subscriber_id] $subscriber_id
     * @param array[lists_id] $list_id
     * @param boolean $all
     * @return int[1/0]/boolean[operation_status] $status
     * @since 1.0.0
     */
    public function unsubscribe_from_list($subscriber_id, $list_id, $all = false)
    {
        $status = '';
        // unsubscribe from unchecked lists
        foreach ($list_id as $list) {
            $status = DB::update('elemailer_subscribers_lists', ['status' => 'unsubscribed'], ['subscriber_id' => $subscriber_id, 'list_id' => $list], ['%s'], ['%d', '%d']);
        }
        // unsubscribe from all lists
        if ($all) {
            $status = DB::update('elemailer_subscribers', ['status' => 'unsubscribed'], ['id' => $subscriber_id], ['%s'], ['%d']);
        }
        return $status;
    }

    /**
     * subscription from lists handler function for a subscriber
     *
     * @param int[subscriber_id] $subscriber_id
     * @param array[lists_id] $list_id
     * @param boolean $all
     * @return int[1/0]/boolean[operation_status] $status
     * @since 1.0.0
     */
    public function manage_subscribe_from_list($subscriber_id, $list_id, $all = false)
    {
        // unsubscribe from all lists
        $clear_all = DB::delete('elemailer_subscribers_lists', ['subscriber_id' => $subscriber_id], ['%d']);

        // assign to the selected lists
        $i = 0;
        foreach ($list_id as $list) {
            $insert = DB::insert('elemailer_subscribers_lists', ['subscriber_id' => $subscriber_id, 'list_id' => $list, 'status' => 'subscribed'], ['%d', '%d', '%s']);
            if ($insert) $i++;
        }

        // keep subscriber status subscribed during subscribe minimum one lists
        if ($i > 0)
            $status = DB::update('elemailer_subscribers', ['status' => 'subscribed'], ['id' => $subscriber_id], ['%s'], ['%d']);
        // change subscriber status unsubscribe during unsubscribe from all lists
        if ($all)
            $status = DB::update('elemailer_subscribers', ['status' => 'unsubscribed'], ['id' => $subscriber_id], ['%s'], ['%d']);

        return $status;
    }

    /**
     * get lists id by subscribers id function
     * this function only return just lists id for a specific subscriber
     * 
     * @param int[subscriber_id] $id
     * @return array[lists_id] $lists_id
     * @since 1.0.0
     */
    public function get_lists_id_by_subscriber_id($id)
    {
        $lists_id = [];
        $rows = DB::get_subscribers_lists_with_condition('elemailer_subscribers', 'id', '=', $id);
        foreach ($rows as $k => $v) {
            $lists_id[] = isset($v['list_id']) ? $v['list_id'] : '';
        }

        return $lists_id;
    }

    /**
     * get lists name by subscribers id function
     * this function only return just lists name for a specific subscriber
     * 
     * @param int[subscriber_id] $id
     * @return array[lists_name] $lists_name
     * @since 1.0.0
     */
    public function get_lists_name_by_subscriber_id($id)
    {
        $lists_name = [];
        $rows = DB::get_subscribers_lists_with_condition('elemailer_subscribers_lists', 'subscriber_id', '=', $id);
        foreach ($rows as $k => $v) {
            $lists_name[] = isset($v['name']) ? $v['name'] : '';
        }

        return $lists_name;
    }

    /**
     * get all lists with full info by susbcriber id function
     *
     * @param int[subscriber_id] $id
     * @return array[lists_info] $rows
     * @since 1.0.0
     */
    public function get_lists_by_subscriber_id($id)
    {
        $rows = DB::get_subscribers_lists_with_condition('elemailer_subscribers_lists', 'subscriber_id', '=', $id);

        return $rows;
    }
}

<?php

namespace Elemailer\Lib\Cron;

defined('ABSPATH') || exit;

use \Elemailer\App\Emails\Action as Emails_Action;
use Elemailer\App\Settings\Action as Settings_Action;
use Elemailer\Helpers\Util;
use \Elemailer\Lib\Database\DB;

/**
 * global post notifcation cron event handler base class for initialization
 * 
 * @author elEmailer
 * @since 1.0.0
 */
class Post_Notification
{
    /**
     * create cron job/ event function
     *
     * @param int[post_id] $id
     * @param array[setings] $settings
     * @return void
     * @since 1.0.0
     */
    public static function create_cron_event($id, $settings)
    {
        // 0 = cron running, 1 = cron will run, 2 = pause cron, 3 = resume cron, 4 = stop cron
        //pause cron job
        if( get_option( 'elemailer_cron_starter' . $id ) == 2 ){
            //this code is for resuming
            update_option('elemailer_cron_starter' . $id, 3 );
            // update cron schedule database info
            DB::update('elemailer_scheduler_tasks', ['status' => 'cron_paused'], ['post_id' => $id], ['%s'], ['%d']);

            // update email status
            Emails_Action::instance()->update_specific_settings($id, ['email_status' => 'paused']);
            if ( wp_next_scheduled( 'elemailer/post_notification/' . $id, [$id]) ) 
            {
                self::stop_cron_event('elemailer/post_notification/', $id);
            }            
            self::stop_cron_event('elemailer/post_notification/send_email/', $id);
            //wp_die(0);
        }
        //terminate newsletter sending
        else if( get_option( 'elemailer_cron_starter' . $id ) == 4 ){
            delete_option('elemailer_batch_offset' . $id);
            delete_option('elemailer_cron_starter' . $id);
              // update cron schedule database info
            DB::update('elemailer_scheduler_tasks', ['status' => 'cron_executed'], ['post_id' => $id], ['%s'], ['%d']);

            // update email status
            Emails_Action::instance()->update_specific_settings($id, ['email_status' => 'terminated']);
            exit();
        }
        //offset option will be used to slice subscriber array list & batch processing. cron_starter option will be used to define cron starting point
        if ( !get_option('elemailer_batch_offset' . $id )) {
                add_option('elemailer_batch_offset' . $id, 0);
                add_option('elemailer_cron_starter' .$id, 1);
        }
        add_action('elemailer/post_notification/' . $id, [__CLASS__, 'set_email_cron'], 10, 1);
        add_action('elemailer/post_notification/send_email/' . $id, [__CLASS__, 'send_mail'], 10, 1);
        // create timestamp with scheduled date/ time
        $time = (new \DateTime("{$settings['pn_start_date']} {$settings['pn_start_time']}"))->getTimestamp();
        // get frequency
        $frequency = (isset($settings['pn_frequency']) ? $settings['pn_frequency'] : '');
        // assign cron job if not assigned before
        // assign/resume cron job if not assigned before
        if ( get_option('elemailer_cron_starter' . $id ) == 1 ) {
            // assign single event when frequency is none
            if ($frequency == 'none') {
                wp_schedule_event($time, 'elemailer_cron_seconds', 'elemailer/post_notification/send_email/' . $id, [$id]);
            } else {
                wp_schedule_event($time, $frequency, 'elemailer/post_notification/' . $id, [$id]);
            }
            //set it to zero so that no more cron event are scheduled
            update_option('elemailer_cron_starter' . $id, 0);
                // update database of cron info
            DB::update('elemailer_scheduler_tasks', ['status' => 'cron_initiated'], ['post_id' => $id], ['%s'], ['%d']);

            // update email status
            Emails_Action::instance()->update_specific_settings($id, ['email_status' => 'scheduled-to-send']);
        }

    }

    /**
     * stop cron job/ event function
     *
     * @param int[post_id] $id
     * @return void
     * @since 1.0.0
     */
    public static function stop_cron_event( $cron_name, $id)
    {
        $timestamp = wp_next_scheduled( $cron_name . $id, [$id]);
        $status = wp_unschedule_event($timestamp, $cron_name  . $id, [$id]);
    }
    /**
     * send mail to subscribers function
     *
     * @param int[post_id] $id
     * @return void
     * @since 4.0.16
     */
    public static function set_email_cron( $id ){
        
        // create timestamp with scheduled date/ time
        $time = (new \DateTime())->getTimestamp();
        // assign cron job if not assigned before
        if (!wp_next_scheduled( 'elemailer/post_notification/send_email/' . $id, [$id]) ) 
        {
            wp_schedule_event($time, 'elemailer_cron_seconds', 'elemailer/post_notification/send_email/' . $id, [$id]);
        }       
    }
    /**
     * send mail to subscribers function
     *
     * @param int[post_id] $id
     * @return void
     * @since 1.0.0
     */
    public static function send_mail($id)
    {
        // update email status
        Emails_Action::instance()->update_specific_settings($id, ['email_status' => 'running']);
        // track already send email to avoid duplicate send to a mail
        $already_sent = [];
        // get global settings
        $global_settings = Settings_Action::instance()->get_global_settings();
        // get email settings
        $email_settings = Emails_Action::instance()->get_template_setting($id);
        // get email subject
        $email_subject = Emails_Action::instance()->get_template_subject($id);
        //get lists id from email settings
        $lists_id = (isset($email_settings['list_id']) ? $email_settings['list_id'] : '');
        $lists = (is_array($lists_id) ? $lists_id : []);
        // store all subscribers from all lists
        $all_subscribers = [];
        // get all subscribers from all lists of this email template
        foreach ($lists as $i => $list) {
            $conditions = array(
                            array('table' => 'elemailer_lists', 'column' => 'id', 'operator' => '=', 'value' => $list),
                            array('table' => 'elemailer_subscribers', 'column' => 'status', 'operator' => '=', 'value' => "'subscribed'" ),
                            array('table' => 'elemailer_subscribers_lists', 'column' => 'status', 'operator' => '=', 'value' => "'subscribed'" ),
                            // Add more conditions as needed
                        );

            $subscribers = DB::get_subscribers_lists_with_conditions($conditions);
            $all_subscribers = array_merge($all_subscribers, $subscribers);
        }
        
        // get unsubscribe link based on global settings
        if (isset($global_settings['unsubscribe_action_page']) && $global_settings['unsubscribe_action_page'] == 'elemailer_page') {
            $unsubscribe_base_url = home_url();
        } else {
            $unsubscribe_base_url = get_permalink($global_settings['unsubscribe_action_page']);
        }
        // add url params
        $add_unsubscription_param = Util::add_param_url($unsubscribe_base_url, 'elemailer_page', 'unsubscriptions');
        $unsubscription_end_point = $add_unsubscription_param . '&elemailer_status=user_confirmation&action=manage_unsubscription&data=[ELEMAILER_LINK_TOKEN]';

        // get manage subscribe link based on global settings
        if (isset($global_settings['subscription_confirmation_page']) && $global_settings['subscription_confirmation_page'] == 'elemailer_page') {
            $manage_subscribe_base_url = home_url();
        } else {
            $manage_subscribe_base_url = get_permalink($global_settings['subscription_confirmation_page']);
        }
        // add url params
        $add_subscription_param = Util::add_param_url($manage_subscribe_base_url, 'elemailer_page', 'subscriptions');
        $subscription_end_point = $add_subscription_param . '&elemailer_status=user_confirmation&action=manage_subscription&data=[ELEMAILER_LINK_TOKEN]';

        // assign headers
        $headers = sprintf('From: %s <%s>' . "\r\n", (empty($email_settings['sender_name']) ? $global_settings['sender_name'] : $email_settings['sender_name']), (empty($email_settings['sender_email']) ? $global_settings['sender_email'] : $email_settings['sender_email']));
        $headers .= sprintf('Reply-To: %s' . "\r\n", (empty($email_settings['reply_to_email']) ? $global_settings['reply_to_email'] : $email_settings['reply_to_email']));
        $headers .= 'Content-Type: text/html; charset=UTF-8' . "\r\n";

        // Retrieve the offset from WordPress options
        $offset = get_option('elemailer_batch_offset' . $id, 0);

        // Determine the subscribers to process in this batch
        $subscribers = array_slice($all_subscribers, $offset, $global_settings['number_of_emails']);
        // loop for all subscribers to send email
        foreach ($subscribers as $subscriber) {
            // avoid already user based on alreay sent mail
            if (!in_array($subscriber['email'], $already_sent)) {

                // get template content by post id with out style
                $template_content = Util::get_template_content($id);

                // set link token for unsubscribe, manage subscribe
                $unsubscription_end_point = str_replace('[ELEMAILER_LINK_TOKEN]', (isset($subscriber['link_token']) ? $subscriber['link_token'] : ''), $unsubscription_end_point);
                $subscription_end_point = str_replace('[ELEMAILER_LINK_TOKEN]', (isset($subscriber['link_token']) ? $subscriber['link_token'] : ''), $subscription_end_point);

                // replace link shortcode from this template's markup
                $template_content = str_replace('#[ELEMAILER_UNSUBSCRIBE_LINK]', $unsubscription_end_point, $template_content);
                $template_content = str_replace('#[ELEMAILER_MANAGE_SUBSCRIPTION_LINK]', $subscription_end_point, $template_content);

                $template_content = str_replace('[elemailer_subscriber_first_name]', $subscriber['first_name'], $template_content);
                $template_content = str_replace('[elemailer_subscriber_last_name]', $subscriber['last_name'], $template_content);
                $template_content = str_replace('[elemailer_subscriber_create_date]', $subscriber['subscribers_created_at'], $template_content);
                $template_content = str_replace('[elemailer_subscriber_email]', $subscriber['email'], $template_content);
                
                // get full html markup to send
                if(isset($email_settings['ele_statistics']) && $email_settings['ele_statistics'] == 'on'){

                    $email_body = Util::get_email_html_template($id, $template_content, md5($subscriber['subscribers_id']));
                }else{
                    $email_body = Util::get_email_html_template($id, $template_content);
                }

                $email_to = $subscriber['email'];
                // send mail
                $send = wp_mail($email_to, $email_subject, $email_body, $headers);

                DB::insert('elemailer_tracking_mail', ['subscriber_id' => $subscriber['subscribers_id'], 'post_id' => $id, 'mail_sent' => $send, 'token' => md5($subscriber['subscribers_id'])], ['%d', '%d', '%d', '%s']);

                // assign this mail to already sent mail list
                $already_sent[] = $subscriber['email'];
                // Increase the offset for the next batch
                $offset++;

                // Update the offset in WordPress options
                update_option('elemailer_batch_offset' . $id, $offset);
            }
        }
        // update cron schedule database info if all batch is processed
        if ( $offset >= count($all_subscribers )) {
            // Reset the offset in WordPress options
            update_option('elemailer_batch_offset' . $id, 0);
            //$timestamp = wp_next_scheduled('elemailer/post_notification/send_email/' . $id, [$id]);
            //$status = wp_unschedule_event($timestamp, 'elemailer/post_notification/send_email/' . $id, [$id]);
            self::stop_cron_event('elemailer/post_notification/send_email/', $id);
            if ( !wp_next_scheduled( 'elemailer/post_notification/' . $id, [$id]) ) 
            {
                DB::update('elemailer_scheduler_tasks', ['status' => 'cron_executed'], ['post_id' => $id], ['%s'], ['%d']);
                 // update email status
                Emails_Action::instance()->update_specific_settings($id, ['email_status' => 'done']);
            }
        }
    }
}

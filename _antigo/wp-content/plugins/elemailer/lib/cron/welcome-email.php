<?php

namespace Elemailer\Lib\Cron;

defined('ABSPATH') || exit;

use \Elemailer\App\Emails\Action as Emails_Action;
use Elemailer\App\Settings\Action as Settings_Action;
use Elemailer\Lib\Pages\Base as Pages_Base;
use Elemailer\Helpers\Util;
use \Elemailer\Lib\Database\DB;

/**
 * Welcome email handler class. Welcome email don't need any cron job.
 * This class belongs to here just for keeping all mail sending class at a same directory.
 * 
 * @author elEmailer
 * @since 1.0.0
 */
class Welcome_Email
{

    /**
     * initial function for welcome email trigger
     *
     * @return void
     * @since 1.0.0
     */
    public static function init()
    {
        // user register hook call for sending email
        add_action('user_register', [__CLASS__, 'user_register_trigger'], 10, 1);
    }

    /**
     * send email function call for user registration function
     *
     * @param int[user_id] $user_id
     * @return void
     * @since 1.0.0
     */
    public static function user_register_trigger($user_id)
    {
        return self::user_send_mail($user_id);
    }
    /**
     * send email function call for new subscriber add function
     *
     * @param int[subscriber_id] $subscriber_id
     * @return void
     * @since 1.0.0
     */
    public static function new_subscriber_trigger($subscriber_id)
    {
        return self::subscriber_send_mail($subscriber_id);
    }

    /**
     * send email for new user regsitration welcome email function
     *
     * @param int[user_id] $user_id
     * @return int[1/0]/boolean $send
     * @since 1.0.0
     */
    public static function user_send_mail($user_id)
    {
        // get user data
        $user_data = get_user_by('id', $user_id);
        //$user_meta = get_user_meta( $user_id ); // get this for fname, lname for welcome email since @v 2.1
       
        // get global settings
        $global_settings = Settings_Action::instance()->get_global_settings();
        // get email settings
        $emails = DB::get_all_data_with_single_condition('elemailer_scheduler_tasks', 'post_term', 'welcomeemail');
        $emails = (is_array($emails) ? $emails : []);
        $send   = false;

        // loop for all welcome email travel
        foreach ($emails as $key => $email) {

            // ingnore trashed email
            if (get_post_status($email['post_id']) == 'trash') {
                continue;
            }
            // get email settings
            $email_settings = Emails_Action::instance()->get_template_setting($email['post_id']);
            // get email subject
            $email_subject = Emails_Action::instance()->get_template_subject($email['post_id']);

            // continue when mail sending event set to new wp user
            if (isset($email_settings['wm_event_of_send']) && ($email_settings['wm_event_of_send'] == 'new-wp-user') && in_array($email_settings['wm_user_type'], $user_data->roles)) {

                // get template content by post id with out style
                $template_content = Util::get_template_content($email['post_id']);


                // add shortcode support since @v 2.1 - ref: https://developer.wordpress.org/reference/functions/get_user_by/
                $template_content = str_replace('[wp_user_email]', $user_data->data->user_email, $template_content);
                $template_content = str_replace('[wp_user_login]', $user_data->data->user_login, $template_content);
                $template_content = str_replace('[wp_display_name]', $user_data->data->display_name, $template_content);
                
                $template_content = str_replace('[wp_first_name]', get_user_meta( $user_id, 'first_name', true ), $template_content);
                $template_content = str_replace('[wp_last_name]', get_user_meta( $user_id, 'last_name', true ), $template_content);
                

                // get full html markup to send
                if(isset($email_settings['ele_statistics']) && $email_settings['ele_statistics'] == 'on'){

                    $email_body = Util::get_email_html_template($email['post_id'], $template_content, md5($user_id));
                }else{
                    $email_body = Util::get_email_html_template($email['post_id'], $template_content);
                }
                // assign headers
                $headers = sprintf('From: %s <%s>' . "\r\n", (empty($email_settings['sender_name']) ? $global_settings['sender_name'] : $email_settings['sender_name']), (empty($email_settings['sender_email']) ? $global_settings['sender_email'] : $email_settings['sender_email']));
                $headers .= sprintf('Reply-To: %s' . "\r\n", (empty($email_settings['reply_to_email']) ? $global_settings['reply_to_email'] : $email_settings['reply_to_email']));
                $headers .= 'Content-Type: text/html; charset=UTF-8' . "\r\n";

                $email_to = isset($user_data->data->user_email) ? $user_data->data->user_email : '';
                // send mail
                $send = wp_mail($email_to, $email_subject, $email_body, $headers);

                DB::insert('elemailer_tracking_mail', [
                                                        'subscriber_id' => $user_id, 
                                                        'post_id' => $email['post_id'], 
                                                        'subscriber_type' => 'wp-user', 
                                                        'mail_sent' => $send, 
                                                        'token' => md5($user_id)
                                                    ], 
                                                    ['%d', '%d','%s','%d', '%s']
                            );

            }
            // update cron schedule database info
            DB::update('elemailer_scheduler_tasks', ['status' => 'mail_sent'], ['post_id' => $email['post_id']], ['%s'], ['%d']);
            // update email status
            Emails_Action::instance()->update_specific_settings($email['post_id'], ['email_status' => 'sent-&-waiting']);
        }

        return $send;
    }

    /**
     * send email for new subscriber add welcome email function
     *
     * @param int[subscriber_id] $subscriber_id
     * @return int[1/0]/boolean $send
     * @since 1.0.0
     */
    public static function subscriber_send_mail($subscriber_id)
    {
        // get subscriber info
        $subscriber_data = DB::get_all_data_with_single_condition('elemailer_subscribers', 'id', $subscriber_id);

        $subscriber_data = (isset($subscriber_data[0]) ? $subscriber_data[0] : '');
        // get global settings
        $global_settings = Settings_Action::instance()->get_global_settings();
        // get active and scheduled email template for welcome email
        $emails = DB::get_all_data_with_single_condition('elemailer_scheduler_tasks', 'post_term', 'welcomeemail');
        $emails = (is_array($emails) ? $emails : []);
        $send=0;
        // loop for travel all template
        foreach ($emails as $key => $email) {

            // avoid sending trash email template
            if (get_post_status($email['post_id']) == 'trash') {
                continue;
            }

            // get email settings
            $email_settings = Emails_Action::instance()->get_template_setting($email['post_id']);
            // get email subject
            $email_subject = Emails_Action::instance()->get_template_subject($email['post_id']);
            //get lists id from email settings
            $lists_id = isset($email_settings['list_id']) ? $email_settings['list_id'] : [];

            // @since 4.0 - add support for manage subscription & unsubscribe settings
            // get unsubscribe action page id
            $unsubscribe_page_id = isset($global_settings['unsubscribe_action_page']) ? $global_settings['unsubscribe_action_page'] : 'elemailer_page';
            // get unsubscribe action page permalink
            $add_unsubscription_param = Settings_Action::instance()->get_page_permalink($unsubscribe_page_id, ['type' => 'unsubscribe_action_page']);
            
            
            // get manage subscribe action page id
            $manage_subscription_page_id = isset($global_settings['subscription_confirmation_page']) ? $global_settings['subscription_confirmation_page'] : 'elemailer_page';
            // get manage subscribe page permalink
            $add_subscription_param = Settings_Action::instance()->get_page_permalink($manage_subscription_page_id, ['type' => 'subscription_confirmation_page']);

            // continue when mail sending event set to new subscribers
            if (isset($email_settings['wm_event_of_send']) && ($email_settings['wm_event_of_send'] == 'new-subscriber')) {

                $cnt = 0;
                // travel all lists of this email to check is this subscriber belongs to there
                foreach ($lists_id as $key => $list) {
                    // try to get this subscriber from this list
                    $check = DB::get_all_data_table_with_various_condition('elemailer_subscribers_lists', ['subscriber_id' => $subscriber_id, 'list_id' => $list]);
                    // increment count during found subscribe on this list
                    if (!empty($check)) {
                        $cnt++;
                    }
                }
                // ignore this email template if subscriber doesn't exist any of this template's list
                if ($cnt == 0) {
                    continue;
                }
                // get template content by post id with out style
                $template_content = Util::get_template_content($email['post_id']);
                
                $unsubscription_end_point = str_replace('administrator_view', (isset($subscriber_data['link_token']) ? $subscriber_data['link_token'] : ''), $add_unsubscription_param);
                $subscription_end_point = str_replace('administrator_view', (isset($subscriber_data['link_token']) ? $subscriber_data['link_token'] : ''), $add_subscription_param);

                // replace link shortcode from this template's markup
                $template_content = str_replace('#[ELEMAILER_UNSUBSCRIBE_LINK]', $unsubscription_end_point, $template_content);
                $template_content = str_replace('#[ELEMAILER_MANAGE_SUBSCRIPTION_LINK]', $subscription_end_point, $template_content);
                
                // add shortcode support
                $template_content = str_replace('[elemailer_subscriber_first_name]', $subscriber_data['first_name'], $template_content);
                $template_content = str_replace('[elemailer_subscriber_last_name]', $subscriber_data['last_name'], $template_content);
                $template_content = str_replace('[elemailer_subscriber_create_date]', $subscriber_data['created_at'], $template_content);
                $template_content = str_replace('[elemailer_subscriber_email]', $subscriber_data['email'], $template_content);
                
                
                // get full html markup to send
                if(isset($email_settings['ele_statistics']) && $email_settings['ele_statistics'] == 'on'){

                    $email_body = Util::get_email_html_template($email['post_id'], $template_content, md5($subscriber_data['id']));
                }else{
                    $email_body = Util::get_email_html_template($email['post_id'], $template_content);
                }
                // assign headers
                $headers = sprintf('From: %s <%s>' . "\r\n", (empty($email_settings['sender_name']) ? $global_settings['sender_name'] : $email_settings['sender_name']), (empty($email_settings['sender_email']) ? $global_settings['sender_email'] : $email_settings['sender_email']));
                $headers .= sprintf('Reply-To: %s' . "\r\n", (empty($email_settings['reply_to_email']) ? $global_settings['reply_to_email'] : $email_settings['reply_to_email']));
                $headers .= 'Content-Type: text/html; charset=UTF-8' . "\r\n";

                $email_to = isset($subscriber_data['email']) ? $subscriber_data['email'] : '';
                // send mail
                $send = wp_mail($email_to, $email_subject, $email_body, $headers);

                DB::insert('elemailer_tracking_mail', ['subscriber_id' => $subscriber_data['id'], 'post_id' => $email['post_id'], 'mail_sent' => $send, 'token' => md5($subscriber_data['id'])], ['%d', '%d', '%d', '%s']);
            }
            // update cron schedule database info
            DB::update('elemailer_scheduler_tasks', ['status' => 'mail_sent'], ['post_id' => $email['post_id']], ['%s'], ['%d']);
            // update email status
            Emails_Action::instance()->update_specific_settings($email['post_id'], ['email_status' => 'running']);
        }

        return $send;
    }
}

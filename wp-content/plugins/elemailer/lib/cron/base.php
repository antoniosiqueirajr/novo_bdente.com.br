<?php

namespace Elemailer\Lib\Cron;

defined('ABSPATH') || exit;

use \Elemailer\App\Emails\Action as Emails_Action;
use Elemailer\App\Settings\Action as Settings_Action;
use \Elemailer\Lib\Database\DB;

/**
 * global cron job related base class for initialization
 * 
 * @author elEmailer
 * @since 1.0.0
 */
class Base
{

    use \Elemailer\Traits\Singleton;

    /**
     * initialization function for cron job
     *
     * @return void
     * @since 1.0.0
     */
    public function init()
    {
        // filter to add monthly interval
        add_filter('cron_schedules', [$this, 'add_monthly_cron']);
        // filter to add yearly interval
        add_filter('cron_schedules', [$this, 'add_yearly_cron']);
        // filter to add yearly interval
        add_filter('cron_schedules', [$this, 'elemailer_custom_cron_seconds']);
    }

    /**
     * add monthly cron interval function
     *
     * @param array[all_interval] $schedules
     * @return array[all_interval] $schedules
     * @since 1.0.0
     */
    public function add_monthly_cron($schedules)
    {
        $schedules['monthly'] = [
            'interval' => 2628000,
            'display'  => esc_html__('Every months', 'elemailer')
        ];
        return $schedules;
    }

    public function elemailer_custom_cron_seconds( $schedules ) 
    {   
        if(!isset($schedules['elemailer_cron_seconds']))
            {
                $global_settings = Settings_Action::instance()->get_global_settings();

                $schedules['elemailer_cron_seconds'] = array(
                    'display' => __( 'Every '.$global_settings['emails_per_second'].' Seconds', 'elemailer' ),
                    'interval' => $global_settings['emails_per_second'],
                );
            }
            
            return $schedules;
    }

    /**
     * add yearly cron interval function
     *
     * @param array[all_interval] $schedules
     * @return array[all_interval] $schedules
     * @since 1.0.0
     */
    public function add_yearly_cron($schedules)
    {
        $schedules['yearly'] = [
            'interval' => 31536000,
            'display'  => esc_html__('Every years', 'elemailer')
        ];
        return $schedules;
    }

    /**
     * assign cron job after wp load function
     * this function task cron info db and assign cron job
     *
     * @return void
     * @since 1.0.0
     */
    public function assign_cron_job()
    {
        // temporary fix server error: class not found.
        include_once ELE_MAILER_PLUGIN_DIR . 'lib/database/dB.php';

        // get cron job info from database
        $crons_db = DB::get_all_data_table_with_various_condition('elemailer_scheduler_tasks');
        $crons_db = is_array($crons_db) ? $crons_db : [];
        // assign cron job for all founded data
        foreach ($crons_db as $k => $value) {
            $id = (isset($value['post_id']) ? $value['post_id'] : '');
            $email_type = (isset($value['post_term']) ? $value['post_term'] : '');
            $status = (isset($value['status']) ? $value['status'] : '');
            $settings = Emails_Action::instance()->get_template_setting($id);
            // cron will be different for different types of email/ campaign
            switch ($email_type) {
                case 'newsletter':
                    // newsletter can't be send multiple time
                    if ($status == 'cron_executed') {
                        // stop news letter cron after executed
                        Newsletter::stop_cron_event($id);
                        // delete cron job info after executed
                        DB::delete('elemailer_scheduler_tasks', ['id' => $id], ['%d']);
                    } 
                    else if( $status == 'cron_paused' ){
                        // pause news letter cron after executed
                        Newsletter::create_cron_event($id, $settings);
                    }
                    else {
                        // create cron if not cron_executed
                        Newsletter::create_cron_event($id, $settings);
                    }
                    break;
                case 'postnotification':
                    // stop postnotification cron when it's executed and not set any interval
                    if ($status == 'cron_executed'){
                        Post_Notification::stop_cron_event('elemailer/post_notification/',$id);
                        Post_Notification::stop_cron_event('elemailer/post_notification/send_email/', $id);
                        // delete after stop cron event
                        delete_option('elemailer_batch_offset' . $id);
                        delete_option('elemailer_cron_starter' . $id);
                        DB::delete('elemailer_scheduler_tasks', ['id' => $id], ['%d']);
                    }else if( $status == 'cron_paused' ){
                        // pause news letter cron after executed
                        Post_Notification::create_cron_event($id, $settings);
                    }else {
                        // create cron event if not meet previous condition
                        Post_Notification::create_cron_event($id, $settings);
                    }
                    break;
                default:
            }
        }
    }

    /**
     * clear all cron event/ job during plugin deactivation function
     *
     * @return void
     * @since 1.0.0
     */
    public function clear_cron_job()
    {
        // temporary fix server class not found error.
        include_once ELE_MAILER_PLUGIN_DIR . 'lib/database/dB.php';

        // get cron job info from database
        $crons_db = DB::get_all_data_table_with_various_condition('elemailer_scheduler_tasks');
        $crons_db = is_array($crons_db) ? $crons_db : [];
        // stop cron event for all database info
        foreach ($crons_db as $k => $value) {
            $id = (isset($value['post_id']) ? $value['post_id'] : '');
            $email_type = (isset($value['post_term']) ? $value['post_term'] : '');
            switch ($email_type) {
                case 'newsletter':
                    Newsletter::stop_cron_event($id);
                    break;
                case 'postnotification':
                    Post_Notification::stop_cron_event($id);
                    break;
                default:
            }
        }
    }

    /**
     * trigger welcome email send event function
     * welcome email send not included to cron job/ event, it will trigger corresponding event
     *
     * @return void
     * @since 1.0.0
     */
    public function trigger_welcome_email()
    {
        Welcome_Email::init();
    }
}

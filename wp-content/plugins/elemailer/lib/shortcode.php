<?php

namespace Elemailer\Lib;

defined('ABSPATH') || exit;

use Elemailer\App\Lists\Action as Lists_Action;
use Elemailer\App\Subscribers\Action as Subscribers_Action;
use Elemailer\App\Settings\Action as Settings_Action;

/**
 * shortcode handler class for elemailer custom shortcode
 * 
 * @author elEmailer
 * @since 1.0.0
 */
class Shortcode
{

    use \Elemailer\Traits\Singleton;

    /**
     * shortcode related base function initialization
     *
     * @return void
     * @since 1.0.0
     */
    public function init()
    {
        // add shortcode for unsubscriber page
        add_shortcode('elemailer_unsubscribe_page', [$this, 'elemailer_unsubscribe_shortcode_handler']);
        // add shortcode for manage subscriber page
        add_shortcode('elemailer_manage_subscription_page', [$this, 'elemailer_manage_subscription_shortcode_handler']);
        // add shortcode for Double opt-in Confirmation page
        add_shortcode('elemailer_opt_in_confirm_page', [$this, 'elemailer_opt_in_confirm_shortcode_handler']);
        // get setting for checking if unsubscriber pages has changed for success page redirect
        $this->global_settings = Settings_Action::instance()->get_global_settings();

    }

    /**
     * unsubscriber handler function
     *
     * @return string
     * @since 1.0.0
     */
    public function elemailer_unsubscribe_shortcode_handler()
    {
        // get url params
        $url_params = Pages\Base::instance()->get_params();

        // get action and token
        $action = (isset($url_params['action']) ? $url_params['action'] : '');
        $token = (isset($url_params['data']) ? $url_params['data'] : '');

        // get subscriber data with token
        $subscriber_data = Database\DB::get_all_data_with_single_condition('elemailer_subscribers', 'link_token', $token);
        $subscriber_data = (isset($subscriber_data[0]) ? $subscriber_data[0] : []);

        // server request and our form submission check
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['elemailer_unsubscribe_submit'])) {
            $unsubscribe_list = [];
            // get all assigned lists id for this subscribers
            $subscribed_lists_id_from_input = json_decode(str_replace('\"', '', $_POST['subscribed_lists_id']));

            // create redirect url
            $current_url = Pages\Base::instance()->get_current_url($this->global_settings['unsubscribe_success_page']);
            $redirect_url = str_replace('action=manage_unsubscription', 'action=unsubscribe', $current_url);

            // if not unsubscribe from all lists and subscriber found with this token
            if (isset($_POST['list_id']) && !empty($subscriber_data)) {
                // get unsubscribe list from submitted lists id and all lists id
                $unsubscribe_list = array_diff($subscribed_lists_id_from_input, $_POST['list_id']);
                // call unsubscribe handler function
                $status = Subscribers_Action::instance()->unsubscribe_from_list($subscriber_data['id'], $unsubscribe_list);
                // redirected to the specific url
                echo'<script> window.location="'.$redirect_url.'"; </script> ';
                // if unsubscribe from all lists and subscriber found with this token
            } else if(!empty($subscriber_data)) {
                // all lists id will be now unsubscribe lists id
                $unsubscribe_list = $subscribed_lists_id_from_input;
                // call unsubscribe handler function
                $status = Subscribers_Action::instance()->unsubscribe_from_list($subscriber_data['id'], $unsubscribe_list, true);
                // redirected to the specific url
                echo'<script> window.location="'.$redirect_url.'"; </script> ';
                // subscribe data not found with this link token
            }else{
                // show warning message
                echo sprintf('<p class="elemailer-update-notice error">%s</p>', esc_html__('Invalid subscriber.', 'elemailer'));
            }
        }

        // get assigned lists id for this subscriber
        $lists = Subscribers_Action::instance()->get_lists_by_subscriber_id(isset($subscriber_data['id']) ? $subscriber_data['id'] : 'NULL');

        // get just lists id to pass it during form submission
        $subscribed_lists_id = array_map(function ($v) {
            return $v['lists_id'];
        }, $lists);

        ob_start();
        ?>
        
        <?php $our_list_check=array_column($lists, 'subscribers_lists_status');
        
        if( (array_search('subscribed', $our_list_check )!== false)  || $token == 'administrator_view' ) : ?>
        
        <form action="" method="POST">
            <?php if($token == 'administrator_view'): ?>
                <p class="elemailer-update-notice">This is Unsubscribe page for dummy preview.</p>
                <input id="elemailer-dummy-1" type="checkbox" checked>
                <label for="elemailer-dummy-1">Item 1 (dummy)</label><br>
                <input id="elemailer-dummy-2" type="checkbox">
                <label for="elemailer-dummy-2">Item 2 (dummy)</label><br>
            <?php endif; ?>
            <?php foreach ($lists as $list) : ?>
                <?php if ($list['subscribers_lists_status'] == 'subscribed') : ?>
                    <input type="checkbox" id="<?php echo esc_attr(isset($list['lists_id']) ? $list['lists_id'] : ''); ?>" name="list_id[]" value="<?php echo esc_attr(isset($list['lists_id']) ? $list['lists_id'] : ''); ?>" checked>
                    <label for="<?php echo esc_attr(isset($list['lists_id']) ? $list['lists_id'] : ''); ?>"><?php echo esc_attr(isset($list['name']) ? $list['name'] : ''); ?></label><br>
                <?php endif; ?>
            <?php endforeach; ?>
            <br>
            <input type="hidden" name="subscribed_lists_id" value='<?php echo (json_encode($subscribed_lists_id)); ?>'>
            <input type="submit" name="elemailer_unsubscribe_submit" value="Submit">
        </form>
        <?php else: ?>
            <p style="color:red;" class="ele-notasubscriber"><?php echo __( 'It seems you are not subscribed to any list with us at the moment.', 'elemailer' ); ?></p>
        <?php endif; ?>
        
        <?php
        $data_html = ob_get_contents();
        ob_end_clean();

        return $data_html;
    }

    /**
     * subscriber handler function
     *
     * @return string
     * @since 1.0.0
     */
    public function elemailer_manage_subscription_shortcode_handler()
    {
        // get url params
        $url_params = Pages\Base::instance()->get_params();

        // get action and token
        $action = (isset($url_params['action']) ? $url_params['action'] : '');
        $token = (isset($url_params['data']) ? $url_params['data'] : '');

        // get subscriber data with token
        $subscriber_data = Database\DB::get_all_data_with_single_condition('elemailer_subscribers', 'link_token', $token);
        $subscriber_data = (isset($subscriber_data[0]) ? $subscriber_data[0] : []);

        // get assigned lists id for this subscriber
        $lists_id = Subscribers_Action::instance()->get_lists_id_by_subscriber_id(isset($subscriber_data['id']) ? $subscriber_data['id'] : 'NULL');

        // get all lists to show as option to subscribe
        $lists = Lists_Action::instance()->format_lists_for_option();
        // get all lists type with id
        $lists_type = Lists_Action::instance()->format_lists_for_option_and_type();
        // server request and our form submission check
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['elemailer_manage_subscription_submit']) ) {

            // get subscribe lists id
            $subscribe_list = (!empty($_POST['list_id'])? $_POST['list_id']: []);

           

            // if subscribe minimum one lists and subscriber data found
            if (!empty($subscribe_list) && !empty($subscriber_data)) {
                // call manage subscription from list function
                $status = Subscribers_Action::instance()->manage_subscribe_from_list($subscriber_data['id'], $subscribe_list);
                // if not subscribe minimum one lists and subscriber data found
            } else if(!empty($subscriber_data)) {
                // call manage subscription from list function
                $status = Subscribers_Action::instance()->manage_subscribe_from_list($subscriber_data['id'], $subscribe_list, true);
                // subscribe data not found with this link token
            }else{
                // show warning message
                echo sprintf('<p class="elemailer-update-notice error">%s</p>', esc_html__('Invalid subscriber.', 'elemailer'));
            }
            // show success message

                echo sprintf('<p class="elemailer-update-notice success">%s</p>', esc_html__('Your preference is updated... Refreshing', 'elemailer'));
               echo "<meta http-equiv='refresh' content='0'>";

            
        }

        ob_start();
        ?>
        <form action="" method="POST">
            <?php foreach ($lists as $id => $name) : ?>
               
                <?php if( ($lists_type[$id]=='private' && in_array($id, $lists_id)) || $lists_type[$id]=='default' ): ?>
                    <input type="checkbox" id="<?php echo esc_attr($id); ?>" name="list_id[]" value="<?php echo esc_attr($id); ?>" <?php echo esc_attr(in_array($id, $lists_id)? 'checked': ''); ?>>

                    <label for="<?php echo esc_attr($id); ?>"><?php echo esc_attr($name); ?></label><br>
                <?php endif; ?>
            <?php endforeach; ?>
            
            <br>
            
            <input type="hidden" name="subscriber_id" value='<?php echo esc_attr(isset($subscriber_data['id']) ? $subscriber_data['id'] : 'NULL'); ?>'>
            <input type="submit" name="elemailer_manage_subscription_submit" value="<?php echo __('Submit','elemailer'); ?>">
        </form>
        <?php
        $data_html = ob_get_contents();
        ob_end_clean();

        return $data_html;

    }
    /**
     * opt-in confirmation handler function
     *
     * @return string
     * @since 2.3
     */
    public function elemailer_opt_in_confirm_shortcode_handler($atts){

        $s_data = shortcode_atts( array(
            'subscribed_heading' => __('Thank you!','elemailer'),
            'subscribed_sub_heading' => __('You have successfully confirmed your subscription.','elemailer'),
            'already_subscribed_heading' => __('Opps! You already subscribed once.','elemailer'),
            'already_subscribed_sub_heading' => __('This link is one time use only. The link is expired!','elemailer'),
            'invalid_heading' => __('Opps! This is odd!','elemailer'),
            'invalid_sub_heading' => __('Maybe your token is not valid or you are not our subscriber.','elemailer'),


        ), $atts );

        $url_params = Pages\Base::instance()->get_params();

        $action = (isset($url_params['action']) ? $url_params['action'] : '');
        $token = (isset($url_params['data']) ? $url_params['data'] : '');

        $status = \Elemailer\App\Subscribers\Action::instance()->confirm_subscribtion($action, $token);
        
        ob_start();

        ?>
        <div id="elemailer-double-optin" class="elemailer-double-optin-main">
                <div class="elemailer-page-wrapper double-opt-in">
                    <?php if ($status == 'subscribed') : ?>
                      
                        <?php if( $s_data['subscribed_heading'] ) : ?>
                            <h2 class="em-opt-in-con-success-head"><?php echo sprintf(__('%s', 'elemailer' ), $s_data['subscribed_heading']); ?></h2>
                        <?php endif; ?>

                        <?php if( $s_data['subscribed_sub_heading'] ) : ?>
                            <p class="em-opt-in-con-success-des"><?php echo sprintf(__('%s', 'elemailer' ), $s_data['subscribed_sub_heading']); ?></p>
                        <?php endif; ?>


                    <?php elseif ($status == 'already_subscribed') : ?>
                        
                        <?php if( $s_data['already_subscribed_heading'] ) : ?>
                            <h2 class="em-opt-in-con-already-head"><?php echo sprintf(__('%s', 'elemailer' ), $s_data['already_subscribed_heading']); ?></h2>
                        <?php endif; ?>
                        <?php if( $s_data['already_subscribed_sub_heading'] ) : ?>
                            <p class="em-opt-in-con-already-des"><?php echo sprintf(__('%s', 'elemailer' ), $s_data['already_subscribed_sub_heading']); ?></p>
                        <?php endif; ?> 

                    <?php elseif ($token == 'administrator_view') : ?>
                        
                        <?php if( $s_data['subscribed_heading'] ) : ?>
                            <h2 class="em-opt-in-con-success-head"><?php echo sprintf(__('%s', 'elemailer' ), $s_data['subscribed_heading']); ?></h2>
                        <?php endif; ?>

                        <?php if( $s_data['subscribed_sub_heading'] ) : ?>
                            <p class="em-opt-in-con-success-des"><?php echo sprintf(__('%s', 'elemailer' ), $s_data['subscribed_sub_heading']); ?></p>
                        <?php endif; ?>

                            <span class="em-opt-in-admin-msg"><?php echo esc_html_e('This is just a Preview page for admin.', 'elemailer'); ?></span>

                    <?php elseif ($status == 'invalid') : ?>
                        
                        <?php if( $s_data['invalid_heading'] ) : ?>
                            <h2 class="em-opt-in-con-invalid-head"><?php echo sprintf(__('%s', 'elemailer' ), $s_data['invalid_heading']); ?></h2>
                        <?php endif; ?>

                        <?php if( $s_data['invalid_sub_heading'] ) : ?>
                            <p class="em-opt-in-con-invalid-des"><?php echo sprintf(__('%s', 'elemailer' ), $s_data['invalid_sub_heading']); ?></p>
                        <?php endif; ?>

                    <?php endif; ?>
                </div>
        </div>
        <?php         

        $data_html = ob_get_contents();
        
        ob_end_clean();

        return $data_html;

    }

}

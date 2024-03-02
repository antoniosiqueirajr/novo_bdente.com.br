<?php

use Elemailer\App\Emails\Action as Emails_Action;
use Elemailer\App\Settings\Action as Global_Action;
use Elemailer\Lib\Database\DB;

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['action']) && isset($_GET['email_id'])) {

    $action = $_GET['action'];
    $email_id = $_GET['email_id'];

    $subject = Emails_Action::instance()->get_template_subject($email_id);

    $post = get_post($email_id);

    $track_total_info = DB::get_stats_total_data($email_id);

    $open_ratio = (($track_total_info['sent'] > 0)? (($track_total_info['open']*100)/$track_total_info['sent']): 0);

    $email_settings = Emails_Action::instance()->get_template_setting($email_id);
    $global_settings = Global_Action::instance()->get_global_settings();

?>
    <div class="wrap elemail-wrap">
        <div class="preloader" style="background-image: url(<?php echo ELE_MAILER_PLUGIN_PUBLIC . '/assets/img/step-loader.gif' ?>);"></div>
        <div class="elemail-list-area">
            <div class="elemmaile-statstics-wrapper">
                <div class="esw-head">
                    <h3><?php echo esc_html($subject); ?></h3>
                    <div class="elemailer-row">
                        <div class="elemailer-col-50">
                            <div class="esw-left">
                                <p><?php echo date('M d, Y | H:i', strtotime($post->post_modified)); ?></p>
                                <p><b><?php esc_html_e('Sent to List(s):', 'elemailer'); ?></b>
                                <?php
                                if(!empty($email_settings['list_id']) ){
                                    $lists = $email_settings['list_id'];
                                    $lists = is_array($lists)? $lists: [];
                                    foreach($lists as $list){
                                        $list_info = DB::get_all_data_with_single_condition('elemailer_lists', 'id', $list);
                                        $list_info = isset($list_info[0])? $list_info[0]: [];
                                        echo '<a href="#">'.esc_html($list_info['name']).'</a>';

                                    }
                                }else{
                                     esc_html_e('No List Selected', 'elemailer'); 
                                }
                                
                                ?>
                                </p>
                            </div>
                        </div>
                        <div class="elemailer-col-50">
                            <div class="esw-right">
                                <div class="eswr-text">
                                    <p><b><?php esc_html_e('From:', 'elemailer'); ?></b><?php echo esc_html(empty($email_settings['sender_email']) ? $global_settings['sender_email'] : $email_settings['sender_email']); ?></p>
                                    <p><b><?php esc_html_e('Reply-to:', 'elemailer'); ?></b><?php echo esc_html(empty($email_settings['reply_to_email']) ? $global_settings['reply_to_email'] : $email_settings['reply_to_email']); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="esw-stats">
                    <div class="elemailer-row">
                        <div class="elemailer-col-30">
                            <div class="esws-left">
                                <p><?php esc_html_e('Sent to: ', 'elemailer'); ?><span class="sent-count"><?php echo esc_html($track_total_info['sent']); ?></span></p>
                                <h4><span><?php echo esc_html($open_ratio.'%'); ?></span><?php esc_html_e('Opened', 'elemailer'); ?></h4>
                            </div>
                        </div>
                        <div class="elemailer-col-70">
                            <!-- <div class="esws-right">
                                <p><span class="sent-uns">0.0%</span>unsubscribed</p>
                                <h4><span>0.0%</span>Clicked</h4>
                            </div> -->
                        </div>
                    </div>
                </div>
                <div class="esw-dataTable">
                    <div class="etable-area">

                        <table class="elelist_dataTable" id="stats_dataTable" class="display" data-email-id="<?php echo esc_attr($email_id); ?>" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th><?php esc_html_e('Emails', 'elemailer'); ?></th>
                                    <th><?php esc_html_e('Status', 'elemailer'); ?></th>
                                    <th><?php esc_html_e('Open', 'elemailer'); ?></th>
                                    <!-- <th><?php esc_html_e('Unsubscribe', 'elemailer'); ?></th> -->
                                    <th><?php esc_html_e('Created At', 'elemailer'); ?></th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th><?php esc_html_e('Emails', 'elemailer'); ?></th>
                                    <th><?php esc_html_e('Status', 'elemailer'); ?></th>
                                    <th><?php esc_html_e('Open', 'elemailer'); ?></th>
                                    <!-- <th><?php esc_html_e('Unsubscribe', 'elemailer'); ?></th> -->
                                    <th><?php esc_html_e('Created At', 'elemailer'); ?></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
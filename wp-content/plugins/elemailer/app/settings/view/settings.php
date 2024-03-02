<div class="wrap">
    <div class="elemailer-dashboard-head">
        <h1><?php esc_html_e('Elemailer Settings:', 'elemailer'); ?></h1>
    </div>
    <div class="wrap elemail-wrap">
        <div class="elemail-settings-area">
            <div class="ela-nav-tab">
                <ul>
                    <li class="active"><a href="#basic"><?php esc_html_e('Basic', 'elemailer'); ?></a></li>
                    <li><a href="#signUpConfirm"><?php esc_html_e('Sign-up Confirmation', 'elemailer'); ?></a></li>
                    <li><a href="#sendConfig"><?php esc_html_e('Send configuration', 'elemailer'); ?></a></li>
                </ul>
            </div>
            <div class="ela-tab-content">
                <form class="global-settings-form">
                    <div id="basic" class="elat-content-box">
                        <div class="elat-table settings-tables">
                            <div class="elat-content">
                                <div class="e-row">
                                    <div class="e-col-6">
                                        <div class="st-text">
                                            <h4><?php esc_html_e('Default sender - From', 'elemailer'); ?></h4>
                                            <p><?php esc_html_e('These email addresses will be selected by default for each new email.', 'elemailer'); ?></p>
                                        </div>
                                        <div class="st-options">
                                            <div class="sto-input">
                                                <div class="stor-single">
                                                    <input type="text" id="sender-name" name="sender_name" placeholder="Your name" value="<?php echo esc_attr(isset($global['sender_name']) ? $global['sender_name'] : ''); ?>">
                                                    <input type="email" name="sender_email" placeholder="from@mydomain.com" value="<?php echo esc_attr(isset($global['sender_email']) ? $global['sender_email'] : ''); ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="e-col-6">
                                        <div class="st-text">
                                            <h4><?php esc_html_e('Reply-to', 'elemailer'); ?></h4>
                                            <p><?php esc_html_e('Enter your email Replay email address.', 'elemailer'); ?></p>
                                        </div>
                                        <div class="st-options">
                                            <div class="sto-input">
                                                <div class="stor-single">
                                                    <input type="text" id="reply-to-name" name="reply_to_name" placeholder="Your name" value="<?php echo esc_attr(isset($global['reply_to_name']) ? $global['reply_to_name'] : ''); ?>">
                                                    <input type="email" name="reply_to_email" placeholder="reply_to@mydomain.com" value="<?php echo esc_attr(isset($global['reply_to_email']) ? $global['reply_to_email'] : ''); ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="e-row">
                                    <div class="e-col-12">
                                        <div class="st-text">
                                            <h4><?php esc_html_e('Manage Subscription page', 'elemailer'); ?></h4>
                                            <p><?php esc_html_e('When your subscribers click the "Manage subscription" link, they will be directed to this page. Want to use a custom Subscription page? Use this shortcode [elemailer_manage_subscription_page] or Check out our ', 'elemailer'); ?><a target="_blank" href="https://elemailer.com/help/configure-elemailer-default-settings/"><?php esc_html_e('Knowledge Base', 'elemailer'); ?></a> <?php esc_html_e('for instructions.', 'elemailer'); ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="e-row">
                                    <div class="e-col-6">
                                        <p><b><?php esc_html_e('Select manage subscription page:', 'elemailer'); ?></b></p>
                                        <div class="st-options ele-col-2">
                                            <div class="sto-input">
                                                <div class="stor-single">
                                                    <select name="subscription_confirmation_page">
                                                        <?php foreach ($pages as $key => $value) : ?>
                                                            <option value="<?php echo esc_attr($value['ID']); ?>" <?php echo esc_attr(($value['ID'] == (isset($global['subscription_confirmation_page']) ? $global['subscription_confirmation_page'] : '')) ? 'Selected' : ''); ?>><?php echo esc_html($value['post_title']); ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <a class="elesettings-link" href="#" data-type="subscription_confirmation_page"><?php esc_html_e('Preview', 'elemailer'); ?></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="e-row">
                                    <div class="e-col-12">
                                        <div class="st-text">
                                            <h4><?php esc_html_e('Unsubscribe page', 'elemailer'); ?></h4>
                                            <p><?php esc_html_e('When your subscribers click the "Unsubscribe" link, they will be directed to a confirmation page. After confirming, the success page will be shown. The Unsubscribe page must contain the [elemailer_unsubscribe_page] shortcode. ', 'elemailer'); ?><a target="_blank" href="https://elemailer.com/help/configure-elemailer-default-settings/"><?php esc_html_e('Learn more about customizing these pages.', 'elemailer'); ?></a></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="e-row">
                                    <div class="e-col-6">
                                        <p><b><?php esc_html_e('Action page:', 'elemailer'); ?></b></p>
                                        <div class="st-options ele-col-2">
                                            <div class="sto-input">
                                                <div class="stor-single">
                                                    <select name="unsubscribe_action_page">
                                                        <?php foreach ($pages as $key => $value) : ?>
                                                            <option value="<?php echo esc_attr($value['ID']); ?>" <?php echo esc_attr(($value['ID'] == (isset($global['unsubscribe_action_page']) ? $global['unsubscribe_action_page'] : '')) ? 'Selected' : ''); ?>><?php echo esc_html($value['post_title']); ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <a class="elesettings-link" href="#" data-type="unsubscribe_action_page"><?php esc_html_e('Preview', 'elemailer'); ?></a>
                                        </div>
                                    </div>
                                    <div class="e-col-6">
                                        <p><b><?php esc_html_e('Success page:', 'elemailer'); ?></b></p>
                                        <div class="st-options ele-col-2">
                                            <div class="sto-input">
                                                <div class="stor-single">
                                                    <select name="unsubscribe_success_page">
                                                        <?php foreach ($pages as $key => $value) : ?>
                                                            <option value="<?php echo esc_attr($value['ID']); ?>" <?php echo esc_attr(($value['ID'] == (isset($global['unsubscribe_success_page']) ? $global['unsubscribe_success_page'] : '')) ? 'Selected' : ''); ?>><?php echo esc_html($value['post_title']); ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <a class="elesettings-link" href="#" data-type="unsubscribe_success_page"><?php esc_html_e('Preview', 'elemailer'); ?></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="e-row">
                                    <div class="e-col-12">
                                        <div class="st-text">
                                            <h4><?php esc_html_e('New subscriber notifications', 'elemailer'); ?></h4>
                                            <p><?php esc_html_e('Enter the email address that should receive notifications when someone subscribes.', 'elemailer'); ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="e-row">
                                    <div class="e-col-6">
                                        <div class="st-options" id="newsubs-notificationRadio">
                                            <div class="sto-radio">
                                                <div class="stor-single">
                                                    <input type="radio" name="new_subscriber_notification" value="yes" <?php echo esc_attr((isset($global['new_subscriber_notification']) && $global['new_subscriber_notification'] == 'yes') ? 'checked' : ''); ?>>
                                                    <label for="enableSignup"><?php esc_html_e('Yes', 'elemailer'); ?></label>
                                                </div>
                                            </div>
                                            <div class="sto-radio">
                                                <div class="stor-single">
                                                    <input type="radio" name="new_subscriber_notification" value="no" <?php echo esc_attr((isset($global['new_subscriber_notification']) && $global['new_subscriber_notification'] == 'no') ? 'checked' : ''); ?>>
                                                    <label for="enableSignup"><?php esc_html_e('No', 'elemailer'); ?></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="st-options">
                                            <div class="sto-input">
                                                <div class="stor-single" id="ns-notification-form-mail">
                                                    <input type="email" name="ns_notification_from_email" placeholder="from@mydomain.com" value="<?php echo esc_attr(isset($global['ns_notification_from_email']) ? $global['ns_notification_from_email'] : ''); ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="signUpConfirm" class="elat-content-box hide">
                        <div class="elat-table settings-tables">
                            <div class="elat-content">
                                <div class="e-row">
                                    <div class="e-col-6">
                                        <div class="st-text">
                                            <h4><?php esc_html_e('Enable sign-up confirmation', 'elemailer'); ?></h4>
                                            <p><?php esc_html_e('If you enable this option, your subscribers will first receive a confirmation email after they subscribe. Once they confirm their subscription (via this email), they will be marked as \'confirmed\' and will begin to receive your email newsletters. If this is enabled \'Welcome Email\' created for new subscriber will not be sent. ', 'elemailer'); ?><br><a href="https://elemailer.com/help/enable-double-opt-in-sign-up-confirmation/"><?php esc_html_e('Read more about Double Opt-in confirmation.', 'elemailer'); ?></a></p>
                                        </div>
                                        <div class="st-options" id="signUpConFirmOption">
                                            <div class="sto-radio">
                                                <div class="stor-single">
                                                    <input type="radio" name="enable_mail_opt_in" value="yes" <?php echo esc_attr((isset($global['enable_mail_opt_in']) && $global['enable_mail_opt_in'] == 'yes') ? 'checked' : ''); ?>>
                                                    <label for="enableSignup"><?php esc_html_e('Yes', 'elemailer'); ?></label>
                                                </div>
                                            </div>
                                            <div class="sto-radio">
                                                <div class="stor-single">
                                                    <input type="radio" name="enable_mail_opt_in" value="no" <?php echo esc_attr((isset($global['enable_mail_opt_in']) && $global['enable_mail_opt_in'] == 'no') ? 'checked' : ''); ?>>
                                                    <label for="enableSignup"><?php esc_html_e('No', 'elemailer'); ?></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="e-col-6 sic-emailSub">
                                        <div class="st-text">
                                            <h4><?php esc_html_e('Email subject', 'elemailer'); ?></h4>
                                            <p><?php esc_html_e('Confirm your subscription to Elemailer', 'elemailer'); ?></a></p>
                                        </div>
                                        <div class="st-options">
                                            <div class="sto-input">
                                                <div class="stor-single">
                                                    <input type="text" id="emailSubject" name="opt_in_mail_subject" value="<?php echo esc_attr(isset($global['opt_in_mail_subject']) ? $global['opt_in_mail_subject'] : 'Confirm your subscription to Elemailer'); ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="e-row sic-emailc">
                                    <div class="e-col-6">
                                        <div class="st-text">
                                            <h4><?php esc_html_e('Email content', 'elemailer'); ?></h4>
                                            <div class="st-options">
                                                <div class="sto-input">
                                                    <div class="stor-single">
                                                        <?php
                                                        $data = "Hello,\nWelcome to our newsletter!\nPlease confirm your subscription to our list by clicking the link below:\n[activation_link]I confirm my subscription![/activation_link]\nThank you,\nThe Team";
                                                        $content = (isset($global['opt_in_mail_content']) && ($global['opt_in_mail_content'] != '') ? $global['opt_in_mail_content'] : $data);
                                                        ?>
                                                        <textarea class="" id="opt_in_mail_content" name="opt_in_mail_content" cols="50" rows="15"><?php echo ($content); ?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="description"><span><?php esc_html_e('Don\'t forget to include:', 'elemailer'); ?><br><br></span><span><?php esc_html_e('[activation_link]Confirm your subscription.[/activation_link]', 'elemailer'); ?><br><br></span></p>
                                        </div>
                                    </div>
                                    <div class="e-col-6">
                                        <div class="st-text">
                                            <h4><?php esc_html_e('Confirmation page', 'elemailer'); ?></h4>
                                            <p><?php esc_html_e('When subscribers click on the activation link, they will be redirected to this page. Want custom Confirmation page ? Use this shortcode [elemailer_opt_in_confirm_page] in that page.', 'elemailer'); ?>
                                                <a target="_blank" href="https://elemailer.com/help/configure-elemailer-default-settings/#1-toc-title"><?php esc_html_e('Knowledge Base', 'elemailer'); ?></a>
                                            </p>
                                        </div>
                                        <div class="st-options ele-col-2">
                                            <div class="sto-input">
                                                <div class="stor-single">
                                                    <select name="opt_in_confirm_page">
                                                        <?php foreach ($pages as $key => $value) : ?>
                                                            <option value="<?php echo esc_attr($value['ID']); ?>" <?php echo esc_attr(($value['ID'] == (isset($global['opt_in_confirm_page']) ? $global['opt_in_confirm_page'] : '')) ? 'Selected' : ''); ?>><?php echo esc_html($value['post_title']); ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <a class="elesettings-link" href="#" data-type="opt_in_confirm_page"><?php esc_html_e('Preview', 'elemailer'); ?></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="sendConfig" class="elat-content-box hide">
                        <div class="elat-table settings-tables">
                            <div class="elat-content">
                                <div class="e-row">
                                    <div class="e-col-6">
                                        <div class="st-text">
                                            <h4><?php esc_html_e('Sending frequency', 'elemailer'); ?></h4>
                                            <p><?php esc_html_e('Warning! You may break the terms of your web host or provider by sending more than the recommended emails per day. Contact your host if you want to send more.', 'elemailer'); ?></p>
                                        </div>
                                        <div class="st-options">
                                            <div class="sto-input">
                                                <div class="stor-single">
                                                    <label for="numberOfEmails"><?php esc_html_e('Number of emails', 'elemailer'); ?></label>
                                                    <input type="number" id="numberOfEmails" name="number_of_emails" value="<?php echo esc_attr(isset($global['number_of_emails']) ? $global['number_of_emails'] : 25); ?>">
                                                    <label for="emailsPerSecond"><?php esc_html_e('Per second', 'elemailer'); ?></label>
                                                    <input type="number" id="emailsPerSecond" name="emails_per_second" value="<?php echo esc_attr(isset($global['emails_per_second']) ? $global['emails_per_second'] : 300); ?>">

                                                    <p style="color:#b03930; font-style:italic;"><?php esc_html_e('If, Number of emails=20 & Per second=30, it means you will send 20 emails per 30 seconds == 40 emails per Minute == 2400 emails per Hour == 57600 emails per 24 Hours. So becareful and set this up according to your Hosting/SMTP/Email provider limit per minute/hour/day', 'elemailer'); ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- new option-->
                                 <div class="e-row">
                                    <div class="e-col-12">
                                        <div class="st-text">
                                            <h4><?php esc_html_e('Advanced wp_mail Override method (BETA)', 'elemailer'); ?></h4>
                                            <p><?php esc_html_e('Select if you want to enable wp_mail override method to be used with elemailer advanced shortcode system. This can enable you to use Elemailer with different forms/emails even if native integration is not added yet.', 'elemailer'); ?> 
                                                <a target="_blank" href="https://elemailer.com/help/configure-elemailer-default-settings/#4-toc-title"><?php esc_html_e('Knowledge Base', 'elemailer'); ?> </a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="e-row">
                                    <div class="e-col-6">
                                        <div class="st-options sto-input" id="advancedwpmailRadio">
                                            <div class="sto-radio">
                                                <div class="stor-single">
                                                    <input type="radio" name="wp_email_override_enabled" value="yes" <?php 
                                                    echo esc_attr((!empty($global['wp_email_override_enabled']) && $global['wp_email_override_enabled'] == 'yes') ? 'checked' : ''); 
                                                    ?> >
                                                    <label for="wp_mail_override"><?php esc_html_e('Yes', 'elemailer'); ?></label>
                                                </div>
                                            </div>
                                            <div class="sto-radio">
                                                <div class="stor-single">
                                                    <input type="radio" name="wp_email_override_enabled" value="no" <?php echo esc_attr((!empty($global['wp_email_override_enabled']) && $global['wp_email_override_enabled'] == 'no') ? 'checked' : ''); ?>>
                                                    <label for="wp_mail_override"><?php esc_html_e('No', 'elemailer'); ?></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- new option end-->
                            </div>
                        </div>
                    </div>
                    <div class="st-submit-btn">
                        <p class="aftersubmit-msg" style="display: none;"></p>
                        <a class="save-global-settings ele-btn btn-style-a" href="#"><?php esc_html_e('Save Settings', 'elemailer'); ?></a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

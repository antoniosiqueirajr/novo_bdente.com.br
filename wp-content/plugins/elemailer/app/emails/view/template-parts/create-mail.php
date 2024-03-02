<?php
$email_id = (isset($_GET['email_id']) ? $_GET['email_id'] : '');
$data = [];
if ($email_id != '') {
    $data = [
        'post_title' => get_the_title($email_id),
        'subject' => \Elemailer\App\Emails\Action::instance()->get_template_subject($email_id),
        'settings' => \Elemailer\App\Emails\Action::instance()->get_template_setting($email_id),
        'type' => \Elemailer\App\Emails\Action::instance()->get_term_by_id($email_id),
        'wc_email_type' => get_post_meta($email_id, 'elemailer_wc_email_type', true),
        'wc_email_where_apply' => get_post_meta($email_id, 'elemailer_wc_email_where_apply', true),
        'wc_product' => get_post_meta($email_id, 'elemailer_wc_product', true),
        'wc_category' => get_post_meta($email_id, 'elemailer_wc_category', true),
    ];
}
$get_type            = isset( $data['type'] ) ? $data['type'] : '';

// hide wc related options if wc is not the template type
$emails_type_select   = ( isset( $data['type'] ) && $data['type'] == 'woocommerceemail' ) ? '' : 'hide';
$emails_type_hide     = ( isset( $data['type'] ) && $data['type'] == 'woocommerceemail' ) ? 'hide' : '';

if ( elemailer_has_woocommerce() ) {
    $get_wc_emails_types  = elemailer_get_wc_email_types();
    $get_wc_where_apply   = elemailer_get_wc_email_where_apply();
    $get_wc_all_products  = elemailer_get_wc_all_products();
    $get_wc_all_category  = elemailer_get_wc_all_categories();
    $wc_email_type        = isset( $data['wc_email_type'] ) ? $data['wc_email_type'] : '';
    $wc_email_where_apply = isset( $data['wc_email_where_apply'] ) ? $data['wc_email_where_apply'] : '';
    $wc_product           = isset( $data['wc_product'] ) && ! empty( $data['wc_product'] ) ? array_map( 'intval', $data['wc_product'] ) : [];
    $wc_category          = isset( $data['wc_category'] ) && ! empty( $data['wc_category'] ) ? array_map( 'intval', $data['wc_category'] ) : [];
}
?>
<div class="wrap elemail-wrap">
    <div class="preloader" style="background-image: url(<?php echo ELE_MAILER_PLUGIN_PUBLIC . '/assets/img/step-loader.gif' ?>);"></div>
    <div class="elemailer-create-template-board">
        <!-- Progressbar Area -->
        <div class="elemailer-create-mail-progressbar">
            <div class="cmp-box">
                <div class="cmpb-step">
                    <ul>
                        <li data-id="#template-category" class="active">
                            <span class="span-number"><?php esc_html_e('1', 'elemailer'); ?></span>
                            <span class="dashicons dashicons-saved"></span>
                        </li>
                        <li data-id="#elemailer-template-info">
                            <span class="span-number"><?php esc_html_e('2', 'elemailer'); ?></span>
                            <span class="dashicons dashicons-saved"></span>
                        </li>
                        <li data-id="#elemailer-design">
                            <span class="span-number"><?php esc_html_e('3', 'elemailer'); ?></span>
                            <span class="dashicons dashicons-saved"></span>
                        </li>
                        <li data-id="#elemailerSend">
                            <span class="span-number"><?php esc_html_e('4', 'elemailer'); ?></span>
                            <span class="dashicons dashicons-saved"></span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Progressbar Area -->
        <!-- Template Category Selection Area -->
        <div id="template-category" class="ele-create-mail-tab template-category-area">
            <div class="template-category-box">
                <ul class="tcb-list">
                    <li>
                        <div class="template-category-single newsletter">
                            <img src="<?php echo ELE_MAILER_PLUGIN_PUBLIC . '/assets/img/dashboard/icons/newsletter.png' ?>" class="tcs-icon" alt="">
                            <h4><?php esc_html_e('Newsletter', 'elemailer'); ?></h4>
                            <p><?php esc_html_e('Your usual friendly newsletter.', 'elemailer'); ?></p>
                            <a href="#elemailer-template-info"><?php esc_html_e('Create', 'elemailer'); ?></a>
                        </div>
                    </li>
                    <li>
                        <div class="template-category-single welcomeemail">
                            <img src="<?php echo ELE_MAILER_PLUGIN_PUBLIC . '/assets/img/dashboard/icons/welcome-email.png' ?>" class="tcs-icon" alt="">
                            <h4><?php esc_html_e('Welcome Email', 'elemailer'); ?></h4>
                            <p><?php esc_html_e('Let\'s welcome with style' , 'elemailer'); ?></p>
                            <a href="#elemailer-template-info"><?php esc_html_e('Create', 'elemailer'); ?></a>
                        </div>
                    </li>
                    <li>
                        <div class="template-category-single postnotification">
                            <img src="<?php echo ELE_MAILER_PLUGIN_PUBLIC . '/assets/img/dashboard/icons/post-notification.png' ?>" class="tcs-icon" alt="">
                            <h4><?php esc_html_e('Post Notifications', 'elemailer'); ?></h4>
                            <p><?php esc_html_e('Send a buzz', 'elemailer'); ?></p>
                            <a href="#elemailer-template-info"><?php esc_html_e('Create', 'elemailer'); ?></a>
                        </div>
                    </li>
                    <?php if ( elemailer_has_woocommerce() ) : ?>
                        <li>
                            <div class="template-category-single woocommerceemail">
                                <img src="<?php echo ELE_MAILER_PLUGIN_PUBLIC . '/assets/img/dashboard/icons/woocommerce-email.png' ?>" class="tcs-icon" alt="">
                                <h4><?php esc_html_e('WooCommerce', 'elemailer'); ?></h4>
                                <p><?php esc_html_e('Design Woo emails', 'elemailer'); ?></p>
                                <a href="#elemailer-template-info"><?php esc_html_e('Create', 'elemailer'); ?></a>
                            </div>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
        <!-- /Template Category Selection Area -->
        <!-- Template Title & Subject Wrapper -->
        <div id="elemailer-template-info" class="ele-create-mail-tab template-title-sub-wrapper hide">
            <div class="template-create-info">
                <form class="template-create-form" data-id="<?php echo esc_attr(($email_id != '') ? $email_id : '0'); ?>">
                    <?php if ( elemailer_has_woocommerce() ) : ?>
                        <div class="woocommerceemail-template-type <?php echo esc_attr( $emails_type_select ); ?>">
                            <div class="em-input-box">
                                <label for="template_name"><?php esc_html_e('WooCommerce Template Type: ', 'elemailer'); ?></label>
                                <select name="elemailer_wc_email_type" class="form-input-select elemailer_wc_email_type_field">
                                    <option><?php esc_html_e( 'Select type', 'elemailer' ); ?></option>
                                    <?php foreach( $get_wc_emails_types as $get_wc_email_key => $get_wc_email_label ) : ?>
                                        <option value="<?php echo esc_attr( $get_wc_email_key ); ?>" <?php echo selected( $wc_email_type, $get_wc_email_key ); ?>><?php echo esc_html( $get_wc_email_label ); ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <span class="hints"><?php esc_html_e('Select a template type.', 'elemailer'); ?></span>
                                <span class="elemailer-email-recipient-html"></span>
                            </div>
                        </div>
                        <div class="woocommerceemail-where-apply <?php echo esc_attr( $emails_type_select ); ?>">
                            <div class="em-input-box">
                                <label for="elemailer_wc_email_where_apply"><?php esc_html_e('Where to Apply: ', 'elemailer'); ?></label>
                                <select name="elemailer_wc_email_where_apply" class="form-input-select elemailer_wc_email_where_apply">
                                    <option><?php esc_html_e( 'Select one', 'elemailer' ); ?></option>
                                    <?php foreach( $get_wc_where_apply as $wc_where_apply_key => $wc_where_apply_label ) : ?>
                                        <option value="<?php echo esc_attr( $wc_where_apply_key ); ?>" <?php echo selected( $wc_email_where_apply, $wc_where_apply_key ); ?>><?php echo esc_html( $wc_where_apply_label ); ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <span class="hints"><?php esc_html_e('Select a template type.', 'elemailer'); ?></span>
                            </div>
                        </div>
                        <div class="woocommerceemail-category-select <?php echo esc_attr( $emails_type_select ); ?> hide-hardly">
                            <div class="em-input-box">
                                <label for="template_name"><?php esc_html_e('Select Category: ', 'elemailer'); ?></label>
                                <select name="elemailer_wc_category[]" class="form-input-select" multiple>
                                    <?php $selected = in_array( 1, $wc_category, true ) ? 'selected' : ''; ?>
                                    <option value="1" <?php echo $selected; ?>><?php esc_html_e( 'All Categories', 'elemailer' ); ?></option>
                                    <?php foreach( $get_wc_all_category as $get_wc_category ) : ?>
                                        <?php $selected = in_array( absint( $get_wc_category->term_id ), $wc_category, true ) ? 'selected' : ''; ?>
                                        <option value="<?php echo esc_attr( $get_wc_category->term_id ); ?>" <?php echo $selected; ?>><?php echo esc_html( $get_wc_category->name ); ?> (<?php echo esc_html( $get_wc_category->count ); ?>)</option>
                                    <?php endforeach; ?>
                                </select>
                                <span class="hints"><?php esc_html_e('Select a category.', 'elemailer'); ?></span>
                            </div>
                        </div>
                        <div class="woocommerceemail-product-select <?php echo esc_attr( $emails_type_select ); ?> hide-hardly">
                            <div class="em-input-box">
                                <label for="template_name"><?php esc_html_e('Select Product: ', 'elemailer'); ?></label>
                                <select name="elemailer_wc_product[]" class="form-input-select" multiple>
                                    <?php $selected = in_array( 1, $wc_product, true ) ? 'selected' : ''; ?>
                                    <option value="1" <?php echo $selected; ?>><?php esc_html_e( 'All Products', 'elemailer' ); ?></option>
                                    <?php foreach( $get_wc_all_products as $get_wc_product ) : ?>
                                        <?php $selected = in_array( absint( $get_wc_product ), $wc_product, true ) ? 'selected' : ''; ?>
                                        <option value="<?php echo esc_attr( $get_wc_product ); ?>" <?php echo $selected; ?>><?php echo esc_html( get_the_title( $get_wc_product ) ); ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <span class="hints"><?php esc_html_e('Select a product.', 'elemailer'); ?></span>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="em-input-box">
                        <label for="template_name"><?php esc_html_e('Template Name: ', 'elemailer'); ?></label>
                        <input type="text" name="template_name" id="template_name" value="<?php echo esc_attr(isset($data['post_title']) ? $data['post_title'] : ''); ?>" placeholder="Mail template 1" required>
                        <span class="hints template_name_general <?php echo esc_attr( $emails_type_hide ); ?>"><?php esc_html_e('Write template name here. Ex: Special Offer Campaign', 'elemailer'); ?></span>
                        <span class="hints template_name_wc_email <?php echo esc_attr( $emails_type_select ); ?>"><?php esc_html_e('Write template name here. Ex: New Order Email', 'elemailer'); ?></span>
                    </div>
                    <div class="em-input-box">
                        <label for="template_subject"><?php esc_html_e('Email Subject: ', 'elemailer'); ?></label>
                        <input type="text" name="template_subject" id="template_subject" value="<?php echo esc_attr(isset($data['subject']) ? $data['subject'] : ''); ?>" placeholder="Write your subject" required>
                        <span class="hints template_subject_general <?php echo esc_attr( $emails_type_hide ); ?>"><?php esc_html_e('Campaign Subject. Ex: Quick deal.', 'elemailer'); ?></span>
                        <span class="hints template_subject_wc_email <?php echo esc_attr( $emails_type_select ); ?>"><?php esc_html_e('Email Subject. Ex: New Order #{order_number}.', 'elemailer'); ?></span>
                        <span class="hints template_subject_wc_email_placeholders <?php echo esc_attr( $emails_type_select ); ?>"><i><?php esc_html_e( 'Available placeholders (Click on the placeholders to copy):', 'elemailer' ); ?> <span class="template_subject_wc_email_placeholder" title="<?php esc_attr_e( 'Click to copy the placeholder', 'elemailer' ); ?>">{site_title}</span> <span class="template_subject_wc_email_placeholder" title="<?php esc_attr_e( 'Click to copy the placeholder', 'elemailer' ); ?>">{site_url}</span> <span class="template_subject_wc_email_placeholder" title="<?php esc_attr_e( 'Click to copy the placeholder', 'elemailer' ); ?>">{order_date}</span> <span class="template_subject_wc_email_placeholder" title="<?php esc_attr_e( 'Click to copy the placeholder', 'elemailer' ); ?>">{order_number}</span> <span class="template_subject_wc_email_placeholder" title="<?php esc_attr_e( 'Click to copy the placeholder', 'elemailer' ); ?>">{billing_first_name}</span> <span class="template_subject_wc_email_placeholder" title="<?php esc_attr_e( 'Click to copy the placeholder', 'elemailer' ); ?>">{billing_last_name}</span> </i></span>
                    </div>
                    <div class="template-category-radio-btn">
                        <input type="radio" id="newsletter" name="elemailer_category" class="tcrb" value="newsletter" <?php echo esc_attr(isset($data['type']) && ($data['type'] == 'newsletter') ? 'checked' : ''); ?>><br>
                        <input type="radio" id="welcome-email" name="elemailer_category" class="tcrb" value="welcomeemail" <?php echo esc_attr(isset($data['type']) && ($data['type'] == 'welcomeemail') ? 'checked' : ''); ?>><br>
                        <input type="radio" id="post-notification" name="elemailer_category" class="tcrb" value="postnotification" <?php echo esc_attr(isset($data['type']) && ($data['type'] == 'postnotification') ? 'checked' : ''); ?>>
                        <br>
                        <input type="radio" id="woocommerce-email" name="elemailer_category" class="tcrb" value="woocommerceemail" <?php echo esc_attr(isset($data['type']) && ($data['type'] == 'woocommerceemail') ? 'checked' : ''); ?>>
                    </div>
                    <!-- <button class="prev-Btn">Previous</button> -->
                    <!-- <button class="ele-btn" type="submit">Next</button> -->
                    <p class="required-msg" style="display: none;"></p>
                    <a class="ele-btn btn-style-a next" href="#elemailer-design"><?php esc_html_e('Next', 'elemailer'); ?></a>
                </form>
            </div>
        </div>
        <!-- /Template Title & Subject Wrapper -->

        <!-- Template Builder Area Area -->
        <div id="elemailer-design" class="ele-create-mail-tab template-builder-area hide">
            <div class="iframeBeforeLoad iFrameLoading" style="background-image: url(<?php echo ELE_MAILER_PLUGIN_PUBLIC . '/assets/img/step-loader.gif' ?>);"></div>
            <iframe id="eleDesignIframe" class="elemailer-iframe" src="<?php echo admin_url(); ?>/post.php?post=<?php echo esc_attr(($email_id != '') ? $email_id : '[POST_ID]'); ?>&action=elementor" frameborder="0" width="100%" height="600px"></iframe>
            <div class="tba-btn">
                <a class="btn-style-b prev" href="#elemailer-template-info"><?php esc_html_e('Previous', 'elemailer'); ?></a>
                <a class="btn-style-a next" href="#elemailerSend"><?php esc_html_e('Next Step', 'elemailer'); ?></a>
            </div>
        </div>
        <!-- /Template Builder Area Area -->

        <!-- Template Send Area -->
        <div id="elemailerSend" class="ele-create-mail-tab template-send-area hide">
            <div class="template-send-box">
                <form class="template-settings-update-form" data-id="<?php echo esc_attr(($email_id != '') ? $email_id : '0'); ?>">
                    <div class="email-info-wrapper">
                        <div class="tsb tsb-left">
                            <div class="tsb-control">
                                <label for="sender_name"><?php esc_html_e('Send from', 'elemailer'); ?></label>
                                <span><?php esc_html_e('When your subscribers send to your emails, their emails will go to this address.', 'elemailer'); ?></span>
                                <input type="text" name="sender_name" id="sender_name" value="<?php echo esc_attr(isset($data['settings']['sender_name']) ? $data['settings']['sender_name'] : ''); ?>" placeholder="Name">
                                <input type="email" name="sender_email" id="sender_email" value="<?php echo esc_attr(isset($data['settings']['sender_email']) ? $data['settings']['sender_email'] : ''); ?>" placeholder="info@yourmail.com">
                            </div>
                            <div class="tsb-control">
                                <label for="reply_to_name"><?php esc_html_e('Reply-to', 'elemailer'); ?></label>
                                <span><?php esc_html_e('When your subscribers reply to your emails, their emails will go to this address.', 'elemailer'); ?></span>
                                <input type="text" name="reply_to_name" id="reply_to_name" value="<?php echo esc_attr(isset($data['settings']['reply_to_name']) ? $data['settings']['reply_to_name'] : ''); ?>" placeholder="Name">
                                <input type="email" name="reply_to_email" id="reply_to_email" value="<?php echo esc_attr(isset($data['settings']['reply_to_email']) ? $data['settings']['reply_to_email'] : ''); ?>" placeholder="info@yourmail.com">
                            </div>
                        </div>
                        <div class="tsb tsb-right">
                            <div class="tsbc tsb-welcomeEmail hide">
                                <div class="tsb-control">
                                    <div class="tsbc-date-timeV3">
                                        <span><?php esc_html_e('Send event', 'elemailer'); ?></span>
                                        <select name="wm_event_of_send" id="field_event" data-automation>
                                            <option value="new-subscriber" <?php echo esc_attr((isset($data['settings']['wm_event_of_send']) && $data['settings']['wm_event_of_send'] == 'new-subscriber') ? 'selected' : ''); ?>><?php esc_html_e('When someone subscribe to the list...', 'elemailer'); ?></option>
                                            <option value="new-wp-user" <?php echo esc_attr((isset($data['settings']['wm_event_of_send']) && $data['settings']['wm_event_of_send'] == 'new-wp-user') ? 'selected' : ''); ?>><?php esc_html_e('When someone register to the site...', 'elemailer'); ?></option>
                                        </select>
                                        <div class="wm_user_type scheduled-box <?php echo esc_attr((isset($data['settings']['wm_event_of_send']) && $data['settings']['wm_event_of_send'] == 'new-wp-user') ? '' : 'hide'); ?>">
                                            <span><?php esc_html_e('As', 'elemailer'); ?></span>
                                            <select name="wm_user_type" id="field_afterTimeType" data-automation>
                                                <?php foreach ($capabilities as $capability) : ?>
                                                    <option value="<?php echo esc_attr($capability); ?>"><?php echo esc_html(ucwords(str_replace('_', ' ', $capability))); ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tsb-control select-list">
                                <div class="tsb-control">
                                    <label for="list_id"><?php esc_html_e('Select List', 'elemailer'); ?></label>
                                    <span><?php esc_html_e('When your subscribers send to your emails, their emails will go to this address.', 'elemailer'); ?></span>
                                    <select class="form-input-select" name="list_id[]" multiple="multiple" required>
                                        <?php $i = 0; ?>
                                        <?php foreach ($option_lists as $key => $value) : ?>
                                            <?php
                                            $selected_lists = (isset($data['settings']['list_id']) ? (is_array($data['settings']['list_id']) ? array_values($data['settings']['list_id']) : []) : []);
                                            ?>
                                            <option <?php echo esc_attr((in_array($key, $selected_lists)) ? 'selected="selected"' : ''); ?> value="<?php echo esc_attr($key); ?>">
                                                <?php echo esc_html($value); ?>
                                            </option>
                                            <?php $i++; ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="tsb-control checkbox">
                                <label for="ele_statistics"><?php esc_html_e('Enable statistics', 'elemailer'); ?></label>
                                <input style="top: 4px;" class="email-statistics" type="checkbox" name="ele_statistics" value="on" <?php echo esc_attr((isset($data['settings']['ele_statistics']) && $data['settings']['ele_statistics'] == 'on') ? 'checked' : ''); ?>>
                            </div>
                            <div style="margin-bottom: 10px;" class="tsb-control checkbox schedule-it">
                                <label for="schedule_it"><?php esc_html_e('Schedule It', 'elemailer'); ?></label>
                                <input style="top: 4px;" class="schedule-check" type="checkbox" name="schedule_it" value="on" <?php echo esc_attr((isset($data['settings']['schedule_it']) && $data['settings']['schedule_it'] == 'on') ? 'checked' : ''); ?>>
                            </div>
                            <i style="bottom: 10px;"> <?php esc_html_e('Current Date/Time: ','elemailer'); ?>
                                <?php $ele_datetime = new DateTime(); 
                                $ele_date_result = date_format($ele_datetime,DATE_RFC850);
                                echo $ele_date_result;
                                ?><br><?php esc_html_e('This is a server level time and this is used to Schedule emails','elemailer'); ?>
                            </i>
                            <div class="condition-based-entry <?php echo esc_attr((isset($data['settings']['schedule_it']) && $data['settings']['schedule_it'] == 'on') ? '' : 'hide'); ?>">
                                <div class="tsbc tsb-newsletter hide">
                                    <div class="tsb-control">
                                        <div class="tsbc-date-time">
                                            <input name="nl_start_date" class="flatpickr" type="text" data-default-date="<?php echo esc_attr(isset($data['settings']['nl_start_date']) ? $data['settings']['nl_start_date'] : ''); ?>" placeholder="dd-mm-yyyy">
                                           
                                            <input class="eleFlatPickerTime" type="text" name="nl_start_time" id="" data-default-date="<?php echo esc_attr(isset($data['settings']['nl_start_time']) ? $data['settings']['nl_start_time'] : ''); ?>" placeholder="Select Time">
                                        </div>
                                    </div>
                                </div>

                                <div class="tsbc tsb-postnotification daily hide">
                                    <div class="tsb-control">
                                        <div class="tsbc-date-timeV2 ">
                                            <p><b><?php esc_html_e('Start date time', 'elemailer'); ?></b></p>
                                            <input name="pn_start_date" class="flatpickr tsbpn_startdate" type="text" data-default-date="<?php echo esc_attr(isset($data['settings']['pn_start_date']) ? $data['settings']['pn_start_date'] : ''); ?>" placeholder="yyyy-mm-dd">
                                            
                                            <input class="eleFlatPickerTime" type="text" name="pn_start_time" id="" data-default-date="<?php echo esc_attr(isset($data['settings']['pn_start_time']) ? $data['settings']['pn_start_time'] : ''); ?>" placeholder="Select Time">
                                            <p><b><?php esc_html_e('Frequency', 'elemailer'); ?></b></p>
                                            <select name="pn_frequency" class="postNotificationSchedule">
                                                <option value="none"><?php esc_html_e('None', 'elemailer'); ?></option>
                                                <option value="hourly"><?php esc_html_e('Hourly', 'elemailer'); ?></option>
                                                <option value="daily"><?php esc_html_e('Daily', 'elemailer'); ?></option>
                                                <option value="weekly"><?php esc_html_e('Weekly', 'elemailer'); ?></option>
                                                <option value="monthly"><?php esc_html_e('Monthly', 'elemailer'); ?></option>
                                                <option value="yearly"><?php esc_html_e('Yearly', 'elemailer'); ?></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <p class="required-msg" style="display: none;"></p>
                    <div class="tsa-btn">
                        <a href="#" class="btn-style-a save_and_send">
                            <span class="save_and_send_general <?php echo esc_attr( $emails_type_hide ); ?>"><?php esc_html_e('Save and send', 'elemailer'); ?></span>
                            <span class="save_and_send_wc_email <?php echo esc_attr( $emails_type_select ); ?>"><?php esc_html_e('Publish', 'elemailer'); ?></span>
                        </a>
                        <a href="#" class="btn-style-b save_for_later"><?php esc_html_e('Save for later', 'elemailer'); ?></a>
                        <span><a href="#elemailer-design" class="prev"><?php esc_html_e('Back to the Design Page', 'elemailer'); ?></a></span>
                    </div>
                </form>
            </div>
        </div>
        <!-- /Template Send Area -->
    </div>
</div>
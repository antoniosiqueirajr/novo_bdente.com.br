<div class="wrap">
    <div class="elemailer-dashboard-head">
        <h1><?php esc_html_e('License Settings', 'elemailer'); ?></h1>
    </div>
    <div class="wrap elemail-wrap">
        <div class="elemail-list-area">
            <div class="template-send-area">
                <div class="template-send-box">
                    <form action="" method="POST">
                        <input type="hidden" name="elemailer_license_handler" value="1" />
                        <?php if (!$license_status) : ?>
                            <div class="tsb tsb-left">
                                <div class="tsb-control">
                                    <label for="license-key"><?php esc_html_e('Enter your license key here: ', 'elemailer'); ?></label>
                                    <span><?php esc_html_e('You have to activate your license key to use Elemailer.', 'elemailer'); ?><br><a href="https://elemailer.com/pricing/" target="__blank"><?php esc_html_e('Get elemailer license', 'elemailer'); ?></a></span>
                                    <input type="text" name="license-key" id="license-key" placeholder="License key" required>
                                </div>
                            </div>
                            <div class="tsa-btn">
                                <button class="btn-style-a save-list"><?php esc_html_e('Activate', 'elemailer'); ?></button>
                            </div>
                        <?php endif; ?>
                        <?php if ($license_status) : ?>
                            <div class="tsb tsb-left">
                                <div class="tsb-control">
                                    <label for="license-key"><?php esc_html_e('License activated. You can revoke it: ', 'elemailer'); ?></label>
                                    <span><?php esc_html_e('Your license key is activated. Now, You can use elEmailer. If you want to use this license to another domain. just revoke it from here.', 'elemailer'); ?></span>
                                    <input type="hidden" name="action" value="elemailer_license_deactivate">
                                </div>
                            </div>
                            <div class="tsa-licesne-btn">
                                <span><a href="#" class="btn-style-success disabled"><?php esc_html_e('Activated', 'elemailer'); ?></a></span>
                                <button class="btn-style-b save-list"><?php esc_html_e('Revoke license', 'elemailer'); ?></button>
                            </div>
                        <?php endif; ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

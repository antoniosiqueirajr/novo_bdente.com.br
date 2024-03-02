<?php
$list_id = (isset($_GET['list_id']) ? $_GET['list_id'] : '');
if ($list_id != '') {
    $list_info = \Elemailer\Lib\Database\DB::get_all_data_with_single_condition('elemailer_lists', 'id', $list_id);
    $list_info = (isset($list_info[0]) ? $list_info[0] : []);
}
?>
<div class="wrap elemail-wrap">
    <div class="preloader" style="background-image: url(<?php echo ELE_MAILER_PLUGIN_PUBLIC . '/assets/img/step-loader.gif' ?>);"></div>
    <div class="elemail-list-area">
        <!-- Template Send Area -->
        <div class="template-send-area">
            <div class="template-send-box">
                <form class="create-list-form" data-id="<?php echo esc_attr(isset($list_info['id']) ? $list_info['id'] : 0); ?>">

                    <div class="tsb tsb-60">
                        <div class="tsb-control">
                            <label for="list-name"><?php esc_html_e('List Title', 'elemailer'); ?></label>
                            <span><?php esc_html_e('Give a title for your list. This is publically visible to your subscribers', 'elemailer'); ?></span>
                            <input type="text" name="list-name" id="list-name" value="<?php echo esc_attr(isset($list_info['name']) ? $list_info['name'] : ''); ?>" placeholder="List name" required>
                        </div>

                        <div class="tsb-control">
                            <label for="list-description"><?php esc_html_e('List Description', 'elemailer'); ?></label>
                            <span><?php esc_html_e('Give a description / purposefor your list. This is for internal use only.', 'elemailer'); ?></span>
                            <textarea class="ele-form-input" name="list-description" id="list-description" cols="100" rows="10" required><?php echo esc_attr(isset($list_info['description']) ? $list_info['description'] : ''); ?></textarea>
                        </div>

                        <div class="tsb-control">
                            <label for="list-type"><?php esc_html_e('List Type', 'elemailer'); ?></label>
                            <span><?php esc_html_e('Choose if you want your list to be public or private.','elemailer'); ?></span>
                             
                             <p style="color:green;"><?php esc_html_e('Public: The List is visible to any subscribers publically when they visit manage subscription link/page','elemailer'); ?></p>   
                             <p style="color:red;"><?php esc_html_e('Private: The List is visible to only subscribers of the list itself when they visit manage subscription link/page','elemailer'); ?></p>   
                        </div>
                        <div class="elat-content">
                            <div class="st-options sto-input" id="listtypeRadio">
                                <div class="sto-radio">
                                    <div class="stor-single">
                                        <input type="radio" name="list-type" value="default" <?php 
                                        echo esc_attr( (empty($list_info['type'])|| $list_info['type'] == 'default') ? 'checked' : ''); 
                                        ?> >
                                        <label for="listtypeRadio"><?php esc_html_e('Public', 'elemailer'); ?></label>
                                    </div>
                                </div>
                                <div class="sto-radio">
                                    <div class="stor-single">
                                        <input type="radio" name="list-type" value="private" <?php echo esc_attr((!empty($list_info['type']) && $list_info['type'] == 'private') ? 'checked' : ''); ?>>
                                        <label for="listtypeRadio"><?php esc_html_e('Private', 'elemailer'); ?></label>
                                    </div>
                                </div>
                            </div>    
                        </div>
                    </div>
                    <p class="required-msg" style="display: none;"></p>
                    <div class="tsa-btn">
                        <button class="btn-style-a save-list"><?php esc_html_e('Save', 'elemailer'); ?></button>
                    </div>
                </form>
            </div>

        </div>
        <!-- /Template Send Area -->
    </div>
</div>
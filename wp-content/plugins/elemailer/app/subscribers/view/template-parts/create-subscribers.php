<?php
require_once ELE_MAILER_PLUGIN_DIR . 'lib/goodby/vendor/autoload.php';

use Goodby\CSV\Import\Standard\Lexer;
use Goodby\CSV\Import\Standard\Interpreter;
use Goodby\CSV\Import\Standard\LexerConfig;

$subscribers_lists = [];
$subscriber_id = (isset($_GET['subscriber_id']) ? $_GET['subscriber_id'] : '');
if ($subscriber_id != '') {
    $subscriber_info = \Elemailer\Lib\Database\DB::get_all_data_with_single_condition('elemailer_subscribers', 'id', $subscriber_id);
    $subscriber_info = (isset($subscriber_info[0]) ? $subscriber_info[0] : []);
    $subscribers_lists = \Elemailer\App\Subscribers\Action::instance()->get_lists_id_by_subscriber_id($subscriber_id);
    $subscribers_lists = (is_array($subscribers_lists) ? $subscribers_lists : []);
}

if ( isset( $_POST['e_file_submit_step2'] ) ) {
    $action       = new \Elemailer\App\Subscribers\Action();
    $get_all_data = get_transient( 'elemailer_csv_data_importing' );
    $count        = 0;

    if ( false !== $get_all_data ) {
        $get_csv_data   = $get_all_data['csv_data'];
        $status         = $get_all_data['status'];
        $list_ids       = $get_all_data['list_id'];
        $first_name_map = wp_unslash( $_POST['first_name_mapping'] );
        $last_name_map  = wp_unslash( $_POST['last_name_mapping'] );
        $email_map      = wp_unslash( $_POST['email_mapping'] );

        unset( $get_csv_data[0] );

        foreach ( $get_csv_data as $get_csv_data ) {
            $new_data['status']     = $status;
            $new_data['source']     = 'imported';
            $new_data['list_id']    = $list_ids;
            $new_data['first-name'] = isset( $get_csv_data[ $first_name_map ] ) ? $get_csv_data[ $first_name_map ] : '';
            $new_data['last-name']  = isset( $get_csv_data[ $last_name_map ] ) ? $get_csv_data[ $last_name_map ] : '';
            $new_data['email']      = isset( $get_csv_data[ $email_map ] ) ? $get_csv_data[ $email_map ] : '';

            if ( is_email( $new_data['email'] ) ) {
                $response = $action->store(0, $new_data );

                if ( $response['status'] ) {
                    $count++;
                }                    
            }
        }
    }

    delete_transient( 'elemailer_csv_data_importing' );
}

//check if import button was clicked
if( isset( $_GET['import'] ) && ! empty( $_GET['import'] ) ) {
    if ( isset( $_POST['e_file_submit'] ) ){
        $temp_location = $_FILES['e_file']['tmp_name'];
        $csv_data      = array();
        $config        = new LexerConfig();
        $config->setDelimiter( elemailer_detect_csv_delimiter( $temp_location ) );
        $lexer         = new Lexer( $config );
        $interpreter   = new Interpreter();

        $interpreter->addObserver( function( array $row ) use ( &$csv_data ) {
            $csv_data[] = $row;
        });

        $lexer->parse( $temp_location, $interpreter );

        $all_data     = [ 'csv_data' => $csv_data, 'status' => $_POST['status'], 'list_id' => $_POST['list_id'] ];
        $get_dropdown = '';

        foreach ( $csv_data[0] as $csv_title_key => $csv_title ) {
            $get_dropdown .= '<option value="'.$csv_title_key.'">'.$csv_title.'</option>';
        }
        ?>
        <div class="wrap elemail-wrap">
            <div class="elemail-list-area">
                <div style="padding: 20px; max-width: 700px; margin: 0px;">
                    <div class="e-row">
                        <div class="e-col-3">
                            &nbsp;
                        </div>
                        <div class="e-col-9">
                            <p style="font-size: 20px;margin: 30px 0px;font-weight: bold;"><?php esc_html_e( 'Fields Mapping', 'elemailer' ); ?></p>
                        </div>
                    </div>
                    <form class="create-subscriber-form" method="POST">
                        <div class="e-row">
                            <div class="e-col-3">
                                <p style="text-align: right;font-size: 16px;"><?php esc_html_e( 'First Name', 'elemailer' ); ?></p>
                            </div>
                            <div class="e-col-9">
                                <select name="first_name_mapping" class="ele-form-input">
                                    <option value=""><?php esc_html_e( 'Select one', 'elemailar' ); ?></option>
                                    <?php echo $get_dropdown; ?>
                                </select>
                            </div>
                        </div>
                        <div class="e-row">
                            <div class="e-col-3">
                            <p style="text-align: right;font-size: 16px;"><?php esc_html_e( 'Last Name', 'elemailer' ); ?></p>
                            </div>
                            <div class="e-col-9">
                                <select name="last_name_mapping" class="ele-form-input">
                                    <option value=""><?php esc_html_e( 'Select one', 'elemailar' ); ?></option>
                                    <?php echo $get_dropdown; ?>
                                </select>
                            </div>
                        </div>
                        <div class="e-row">
                            <div class="e-col-3">
                            <p style="text-align: right;font-size: 16px;"><?php esc_html_e( 'Email', 'elemailer' ); ?></p>
                            </div>
                            <div class="e-col-9">
                                <select name="email_mapping" class="ele-form-input">
                                    <?php echo $get_dropdown; ?>
                                </select>
                                <input type="submit" value="<?php echo esc_attr__( 'Import', 'elemailer' ); ?>"  class="btn-style-a e_upload_btn" name="e_file_submit_step2">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>    
        <?php
        delete_transient( 'elemailer_csv_data_importing' );
        set_transient( 'elemailer_csv_data_importing', $all_data, 60 * MINUTE_IN_SECONDS );
        exit;
    }
}else{
    $import = false;
}
?>
<div class="wrap elemail-wrap">
    <div class="preloader" style="background-image: url(<?php echo ELE_MAILER_PLUGIN_PUBLIC . '/assets/img/step-loader.gif' ?>);"></div>
    <div class="elemail-list-area">
        <!-- Template Send Area -->
        <div class="template-send-area">
            <div class="template-send-box">                
                <?php if($import): ?>
                    <form class="e_upload_form" method="POST" enctype="multipart/form-data">
                <?php else: ?>        
                <form class="create-subscriber-form" data-id="<?php echo esc_attr(isset($subscriber_info['id']) ? $subscriber_info['id'] : 0); ?>">
                <?php endif; ?>
                    <div class="tsb tsb-full">
                        <div class="e-row">
                            <?php if( isset( $count ) ): ?>
                                <p class="e_message"> <?php printf( esc_html__('Done! %s new subscriber(s) added', 'elemailer' ), $count ); ?> </p>
                            <?php endif; ?>
                            <div class="e-col-6">
                                <div class="tsb-control">
                                <?php if($import): ?>                                    
                                    <label for="e_file"><?php esc_html_e('Select .CSV files only', 'elemailer'); ?></label>
                                    <span><?php esc_html_e( 'Please make sure the CSV file has three columns in format first name, last name, email. To know more check dummy template ', 'elemailer' ); printf('<a href="%s">%s</a>', esc_url( ELE_MAILER_PLUGIN_PUBLIC . '/assets/dummy/dummy.csv' ), esc_html__(' here', 'elemailer') ); ?></span>
                                    <input type="file" name="e_file" class="e_upload" accept=".csv" required>
                                    <i><?php esc_html_e('Existing emails are skipped during the import process', 'elemailer'); ?>
                                    </i>

                                <?php else: ?>
                                    <label for="email"><?php esc_html_e('Email', 'elemailer'); ?></label>
                                    <span><?php esc_html_e('Please make sure the email is valid and reachable as otherwise you will end up with bad reputation for bounced email.', 'elemailer'); ?></span>
                                    <input type="email" name="email" id="email" value="<?php echo esc_attr(isset($subscriber_info['email']) ? $subscriber_info['email'] : ''); ?>" placeholder="Email" required>
                                <?php endif; ?>
                                </div>
                            </div>
                            <div class="e-col-6">
                                <div class="tsb-control">
                                    <label for="list_id"><?php esc_html_e('Select List', 'elemailer'); ?></label>

                                    <?php if($import): ?> 
                                    <span><?php esc_html_e('Select List(s) wehere your subscribers should be added to. With list(s) you can easily segment your subscribers later on.', 'elemailer'); ?>
                                    </span>
                                    <?php else: ?>
                                    <span><?php esc_html_e('Which List(s) would you like to add the subscriber to ? If no List is selected no opt-in or welcome email will be sent.', 'elemailer'); ?>
                                    </span>
                                    <?php endif; ?>

                                    <select class="form-input-select" name="list_id[]" multiple="multiple" <?php if( $import ){ echo 'required'; }?> >
                                        <?php $i = 0; ?>
                                        <?php foreach ($option_lists as $key => $value) : ?>
                                            <option <?php echo esc_attr((in_array($key, $subscribers_lists)) ? 'selected="selected"' : ''); ?> value="<?php echo esc_attr($key); ?>">
                                                <?php echo esc_html($value); ?>
                                            </option>
                                            <?php $i++; ?>
                                        <?php endforeach; ?>
                                    </select>

                                    <?php //added for future support of keeping original value of the lists if edited

                                    if(0 && !empty($subscriber_info)): ?>
                                    <div class='form-input-checkbox'>
                                        <input checked type="checkbox" id="retain_list_status" name="retain_list_status" value="1">
                                        <?php esc_html_e('Retain original Subscription Status for lists','elemailer'); ?>
                                        <?php print_r($subscribers_lists) ?>
                                        <input type="hidden" name="old_lists" value="<?php echo esc_attr(serialize($subscribers_lists)); ?>">
                                    </div>
                                    <?php endif; ?>

                                </div>
                            </div>
                        </div>
                        <?php if( !$import ): ?>
                        <div class="e-row">
                            <div class="e-col-6">
                                <div class="tsb-control">
                                    <label for="first-name"><?php esc_html_e('First Name', 'elemailer'); ?></label>
                                    <input type="text" name="first-name" id="first-name" value="<?php echo esc_attr(isset($subscriber_info['first_name']) ? $subscriber_info['first_name'] : ''); ?>" placeholder="First Name">
                                </div>
                            </div>
                            <div class="e-col-6">
                                <div class="tsb-control">
                                    <label for="last-name"><?php esc_html_e('Last Name', 'elemailer'); ?></label>
                                    <input type="text" name="last-name" id="last-name" value="<?php echo esc_attr(isset($subscriber_info['last_name']) ? $subscriber_info['last_name'] : ''); ?>" placeholder="Last Name">
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                        <div class="e-row">
                            <div class="e-col-6">
                                <div class="tsb-control">
                                    <label for="status"><?php esc_html_e('Status', 'elemailer'); ?></label>
                                    
                                <?php if($import): ?> 
                                    <span>
                                        <?php esc_html_e('Choose a status for your subscriber.', 'elemailer'); ?>
                                        <br><i><?php esc_html_e('No welcome email or Double opt-in email will be sent for imported subscribers.', 'elemailer'); ?></i>
                                    </span>
                                <?php else: ?>
                                    <span><?php esc_html_e('Choose a status for your subscriber. Double opt-in email will be sent if enabled on Settings & status is unconfirmed, Welcome email will be sent if configured via Emails > Welcome Email when added but in this case, your double opt-in setting should be off.', 'elemailer'); ?>
                                    </span>
                                <?php endif; ?>
                                    <select name="status" id="status" class="ele-form-input">
                                        <option value="subscribed" <?php echo esc_attr((isset($subscriber_info['status']) && ($subscriber_info['status'] == 'subscribed')) ? 'selected' : ''); ?>><?php esc_html_e('Subscribed', 'elemailer'); ?></option>
                                        <option value="unconfirmed" <?php echo esc_attr((isset($subscriber_info['status']) && ($subscriber_info['status'] == 'unconfirmed')) ? 'selected' : ''); ?>><?php esc_html_e('Unconfirmed', 'elemailer'); ?></option>
                                        <option value="unsubscribed" <?php echo esc_attr((isset($subscriber_info['status']) && ($subscriber_info['status'] == 'unsubscribed')) ? 'selected' : ''); ?>><?php esc_html_e('Unsubscribed', 'elemailer'); ?></option>
                                        <option value="inactive" <?php echo esc_attr((isset($subscriber_info['status']) && ($subscriber_info['status'] == 'inactive')) ? 'selected' : ''); ?>><?php esc_html_e('Inactive', 'elemailer'); ?></option>
                                    </select>

                                    

                                    <br>
                                <?php if(!$import): ?> 
                                    <i><?php printf(__('Note: If you have configured <a target="_blank" href="%s">"Welcome email"</a> to be triggered when a Subscriber is added to a list, this subscriber will get it accordingly', 'elemailer' ), 'https://elemailer.com/help/how-to-create-a-welcome-email/#:~:text=In%20the%20Send%20Event%20section%3A%20Select'); ?>
                                    </i>
                                <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="source" value="<?php echo esc_attr(isset($subscriber_info['source']) ? $subscriber_info['source'] : 'administrator'); ?>">
                    </div>
                    <p class="required-msg" style="display: none;"></p>
                    <div class="tsa-btn">
                        <?php if($import): ?>
                            <input type="submit" value="<?php echo esc_attr__( 'Next', 'elemailer' ); ?>"  class="btn-style-a e_upload_btn" name="e_file_submit">
                        <?php else: ?>
                        <button class="btn-style-a save-subscriber"><?php esc_html_e('save', 'elemailer'); ?></button>
                        <?php endif; ?>
                    </div>
                </form>
            </div>
        </div>
        <!-- /Template Send Area -->
    </div>
</div>

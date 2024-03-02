<div class="elemailer-cf7-metabox-area">
    <h2 style="text-align: center;"><?php esc_html_e( 'Elemailer Options', 'elemailer' ); ?></h2>

    <fieldset>
        <legend>
            <p class="description">
                <label>
                    <input type="checkbox" name="elemailer-cf7-email-option-enable" value="yes" <?php checked( $email_option, 'yes' ); ?>>
                    <?php esc_html_e( 'Enable elemailer email template', 'elemailer' ); ?>
                </label>
            </p>
        </legend>
            
        <div class="elemailer-cf7-email-template-settings" style="display: none;">
            <legend><b><?php esc_html_e( 'Mail 1 Template', 'elemailer' ); ?></b></legend>
            <p class="description">
                <label>
                    <select class="large-text" name="elemailer_cf7_template_email1" style="width: 100%; max-width: 400px;">
                        <option value=""><?php esc_html_e( 'Select Template', 'elemailer' ); ?></option>
                        <?php foreach ( $get_all_template as $key => $template ) : ?>
                            <option value="<?php echo esc_attr( $key ); ?>" <?php selected( $cf7_template_email1, $key ); ?>><?php echo esc_html( $template ); ?></option>
                        <?php endforeach; ?>
                    </select>
                </label>
            </p>

            <legend><b><?php esc_html_e( 'Mail 2 Template', 'elemailer' ); ?></b></legend>
            <p class="description">
                <label>
                    <select class="large-text" name="elemailer_cf7_template_email2" style="width: 100%; max-width: 400px;">
                        <option value=""><?php esc_html_e( 'Select Template', 'elemailer' ); ?></option>
                        <?php foreach ( $get_all_template as $key => $template ) : ?>
                            <option value="<?php echo esc_attr( $key ); ?>" <?php selected( $cf7_template_email2, $key ); ?>><?php echo esc_html( $template ); ?></option>
                        <?php endforeach; ?>
                    </select>
                </label>
            </p>
        </div>
        
        <legend>
            <p class="description">
                <label>
                    <input type="checkbox" name="elemailer-cf7-option-enable" value="yes" <?php checked( $option, 'yes' ); ?>>
                    <?php esc_html_e( 'Enable Subscription in Elemailer', 'elemailer' ); ?>
                </label>
            </p>
        </legend>

        <div class="elemailer-cf7-general-settings" style="display: none;">
            <legend><b><?php esc_html_e( 'When any users submit the form their emails will go to the selected listing.', 'elemailer' ); ?></b></legend>
            <p class="description">
                <label>
                    <select class="large-text" name="elemailer-cf7-select-list" style="width: 100%; max-width: 400px;">
                        <option><?php esc_html_e( 'Select list', 'elemailer' ); ?></option>
                        <?php foreach ( $option_lists as $key => $value ) : ?>
                            <option value="<?php echo esc_attr( $key ); ?>" <?php selected( $select_list, $key ); ?>><?php echo esc_html( $value ); ?></option>
                        <?php endforeach; ?>
                    </select>
                </label>
            </p>

            <legend><b><?php esc_html_e( 'Email Field', 'elemailer' ); ?></b></legend>
            <p class="description">
                <label>
                    <select class="large-text" name="elemailer-cf7-email" style="width: 100%; max-width: 400px;">
                        <option><?php esc_html_e( 'Select email field', 'elemailer' ); ?></option>
                        <?php foreach ( $default_fields as $field ) : ?>
                            <option value="<?php echo esc_attr( $field ); ?>" <?php selected( $elemailer_email, $field ); ?>><?php echo esc_html( $field ); ?></option>
                        <?php endforeach; ?>
                    </select>
                </label>  
            </p>
            <i><?php esc_html_e( 'Put the email field name from Form section.', 'elemailer' ); ?></i>

            <legend><b><?php esc_html_e( 'First Name Field', 'elemailer' ); ?></b></legend>
            <p class="description">
                <label>
                    <select class="large-text" name="elemailer-cf7-first-name" style="width: 100%; max-width: 400px;">
                        <option><?php esc_html_e( 'Select first name field', 'elemailer' ); ?></option>
                        <?php foreach ( $default_fields as $field ) : ?>
                            <option value="<?php echo esc_attr( $field ); ?>" <?php selected( $elemailer_first_name, $field ); ?>><?php echo esc_html( $field ); ?></option>
                        <?php endforeach; ?>
                    </select>
                </label>
            </p>
            <i><?php esc_html_e( 'Put the first name field name from Form section.', 'elemailer' ); ?></i>

            <legend><b><?php esc_html_e( 'Last Name Field', 'elemailer' ); ?></b></legend>
            <p class="description">
                <label>
                    <select class="large-text" name="elemailer-cf7-last-name" style="width: 100%; max-width: 400px;">
                        <option><?php esc_html_e( 'Select last name field', 'elemailer' ); ?></option>
                        <?php foreach ( $default_fields as $field ) : ?>
                            <option value="<?php echo esc_attr( $field ); ?>" <?php selected( $elemailer_last_name, $field ); ?>><?php echo esc_html( $field ); ?></option>
                        <?php endforeach; ?>
                    </select>
                </label>
            </p>
            <i><?php esc_html_e( 'Put the last name field name from Form section.', 'elemailer' ); ?></i>
        </div>
    </fieldset>
</div>
<style>
    #contact-form-editor-tabs #Elemailer-Extension-tab { background-color: #FF8000; border-color: #FF8000; }
    #Elemailer-Extension-tab a.ui-tabs-anchor, #Elemailer-Extension-tab .ui-state-active a{ color: #fff !important; }
    #Elemailer-Extension-tab a.ui-tabs-anchor:hover{ color: #fff; }
</style>
<script>
( function( $ ) {  
    const ElemailerCF7AdminSettings = {
		init() {
			$( '[name^="elemailer-cf7-option-enable"]' ).on( 'change', this.show_hide_settings );
            $( '[name^="elemailer-cf7-email-option-enable"]' ).on( 'change', this.email_show_hide_settings );

			this.show_hide_settings();
            this.email_show_hide_settings();
		},

        /**
		 * Show hide general settings
		 */
		show_hide_settings() {
			if ($('[name^="elemailer-cf7-option-enable"]').is(':checked')) {
				$( '.elemailer-cf7-general-settings' ).show();
			} else {
				$( '.elemailer-cf7-general-settings' ).hide();
			}
		},

        /**
		 * Show hide email template settings
		 */
		email_show_hide_settings() {
			if ($('[name^="elemailer-cf7-email-option-enable"]').is(':checked')) {
				$( '.elemailer-cf7-email-template-settings' ).show();
                $("#wpcf7-mail-use-html").prop('checked', true);
                $("#wpcf7-mail-2-use-html").prop('checked', true);
			} 
            else {
                $( '.elemailer-cf7-email-template-settings' ).hide();
				// $("#wpcf7-mail-use-html").prop('checked', false);
				// $("#wpcf7-mail-2-use-html").prop('checked', false);
			}
		},
	};
  
    $( function() {
		ElemailerCF7AdminSettings.init();
	} );
}( jQuery ) );
</script>
<div class="elemailer-admin-floating-wrap">
    <div class="elemailer-admin-floating-header">
        <span class="elemailer-floating-head-title"><?php esc_html_e( 'Generate Elemailer Shortcode', 'elemailer' ) ?></span>
        <span class="elemailer-floating-head-close"><?php esc_html_e( 'Close', 'elemailer' ) ?></span>
    </div>
    <div class="elemailer-admin-floating-caontainer">
        <select class="elemailer-admin-floating-select" name="elemailer_id">
            <option value=""><?php esc_html_e( 'Select elemailer template', 'elemailer' ) ?></option>
            <?php foreach ( $get_all_template as $key => $template ) : ?>
                <option value="<?php echo esc_attr( $key ); ?>"><?php echo esc_html( $template ); ?></option>
            <?php endforeach; ?>
        </select>
        <table class="elemailer-admin-floating-table">
            <tr>
                <td><span class="elemailer-admin-floating-labels"><?php esc_html_e( 'Unique random Field ID', 'elemailer' ) ?></span></td>
                <td><span class="elemailer-admin-floating-labels"><?php esc_html_e( 'Your original Field ID', 'elemailer' ) ?></span></td>
                <td></td>
            </tr>
            <tr>
                <td><input type="text" class="elemailer-admin-floating-input" name="shortcode_key[][third_party_key]" placeholder="<?php esc_attr_e( 'my_ele_key1' ); ?>"></td>
                <td><input type="text" class="elemailer-admin-floating-input" name="shortcode_key[][elemailer_key]" placeholder="<?php esc_attr_e( '{field_id="2"}' ); ?>"></td>
                <td>
                    <span class="elemailer-floating-head-plus"><?php esc_html_e( '+', 'elemailer' ) ?></span>
                </td>
            </tr>
        </table>
    </div>
    <div class="elemailer-admin-floating-footer">
        <span class="elemailer-admin-floating-labels"><?php esc_html_e( 'Shortcode', 'elemailer' ) ?></span>
        <span class="elemailer-admin-floating-save-label"><?php esc_html_e( 'Save for later', 'elemailer' ); ?></span>
        <span class="elemailer-floating-codes-copy"><?php esc_html_e( 'Copy shortcode', 'elemailer' ) ?></span>
        <textarea class="elemailer-admin-floating-codes"><?php echo get_option( 'elemailer-dynamic-shortocodes', true ); ?></textarea>  
    </div>
</div>
<div class="elemailer-admin-floating-icon">
    <img class="elemailer-admin-floating-action" src="<?php echo esc_url( ELE_MAILER_PLUGIN_PUBLIC . '/assets/img/elemailer-icon.svg' ); ?>"/>
</div>

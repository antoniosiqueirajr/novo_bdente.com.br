<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor Dynamic Tag
 *
 * Elementor dynamic tag that returns a random number.
 *
 * @since 1.0.8
 */
class Elemailer_WC_Email_Dynamic_Tag extends \Elementor\Base_Data_Control {

	/**
	 * Get one area control type.
	 *
	 * Retrieve the control type
	 *
	 * @since 1.0.8
	 * @access public
	 * @return string Control type.
	 */
	public function get_type() {
		return 'elemailer_wc_email_content';
	}

	/**
	 * Get one area control default settings.
	 *
	 *
	 * @since 1.0.8
	 * @access protected
	 * @return array Control default settings.
	 */
	protected function get_default_settings() {
		return [
			'label_block' => true,
			'rows'        => 10,
		];
	}

	/**
	 * Render one area control output in the editor.
	 *
	 * @since 1.0.8
	 * @access public
	 */
	public function content_template() {
		$control_uid = $this->get_control_uid();
		?>
		<div class="elementor-control-field">
			<# if ( data.label ) {#>
			<label for="<?php echo esc_attr( $control_uid ); ?>" class="elementor-control-title">{{{ data.label }}}</label>
			<# } #>
			<div class="elementor-control-input-wrapper">
				<textarea id="<?php echo esc_attr( $control_uid ); ?>" class="elementor-control-tag-area elemailer-wc-email-shortcodes" rows="{{ data.rows }}" data-setting="{{ data.name }}" placeholder="{{ data.placeholder }}"></textarea>
				<span class="elemailer-wc-email-shortcodes-add"><?php esc_html_e( '+', 'elemailer' ); ?></span>
				<# if ( data.shortcodes ) {#>
					<div class="elemailer-wc-email-shortcodes-list" style="display:none;">
						<ul>
						<# _.each( data.shortcodes, function( element ) { #>
							<li data-elemailer-shortcode="{{{ element }}}"  class="elemailer-wc-email-shortcode-item">{{{ element }}}</li>
						<# } ) #>
						</ul>
					</div>
				<# } #>
				<p class="elemailer-wc-email-shortcodes-add-manual"><?php esc_html_e( 'You can use the placeholders. This will replace with actual order content data.', 'elemailer' ); ?></p>
				<# if ( data.shortcodes ) {#>
					<div class="elemailer-wc-email-shortcodes-list-manual">
						<ul>
						<# _.each( data.shortcodes, function( element ) { #>
							<li data-elemailer-shortcode="{{{ element }}}"  class="elemailer-wc-email-shortcode-item-manual">{{{ element }}} <span data-elemailer-shortcode-copy="{{{ element }}}" class="elemailer-wc-email-shortcode-item-copy"><?php esc_html_e( 'Copy', 'elemailer' ); ?></span></li>
						<# } ) #>
						</ul>
					</div>
				<# } #>
			</div>
		</div>
		<# if ( data.description ) { #>
		<div class="elementor-control-field-description">{{{ data.description }}}</div>
		<# } #>
		<?php
	}
}
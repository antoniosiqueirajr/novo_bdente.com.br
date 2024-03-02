<?php

namespace Elemailer\Integrations\Elementor\Widgets;

defined('ABSPATH') || exit;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

/**
 * WooCommerce email customer notes widget class
 *
 * @author elEmailer
 *
 * @since 1.0.8
 */
class Elemailer_Widget_WC_Customer_Notes extends Widget_Base {

	/**
	 * Get name
	 *
	 * @since 1.0.8
	 */
	public function get_name() {
		return 'elemailer-wc-customer-notes';
	}

	/**
	 * Get title
	 *
	 * @since 1.0.8
	 */
	public function get_title() {
		return esc_html__( 'WooCommerce Customer Notes', 'elemailer' );
	}

	/**
	 * Get icon
	 *
	 * @since 1.0.8
	 */
	public function get_icon() {
		return 'eicon-commenting-o';
	}

	/**
	 * Show in panel
	 *
	 * @since 1.0.8
	 */
	public function show_in_panel() {
		$post_type = get_post_type();
		return ( in_array( $post_type, [ 'em-emails-template' ] ) );
	}

	/**
	 * Get categories
	 *
	 * @since 1.0.8
	 */
	public function get_categories() {
		return [ 'elemailer-template-builder-fields' ];
	}

	/**
	 * Get keywords
	 *
	 * @since 1.0.8
	 */
	public function get_keywords() {
		return [ 'elemailer', 'template', 'woo' ];
	}

	/**
	 * Register controls
	 *
	 * @since 1.0.8
	 */
	protected function register_controls() {
		$this->start_controls_section(
			'email_customer_note_style',
			[
				'label' => __( 'Content', 'elemailer' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'email_customer_note_size',
			[
				'label' => __( '(Deprecated)Font Size', 'elemailer' ),
				'classes' => 'elementor-panel-alert elementor-panel-alert-danger',
				'condition' => [
                    'email_customer_note_size[size]!' => '',
                ],
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .elemailer-email-customer-note p' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		// font options as per https://www.cssfontstack.com/
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'cn_typography',
				'global' => [
					'active' => false,
				],
				'selector' => '{{WRAPPER}} .elemailer-email-customer-note p',
				'seperator'=> 'before',
				'fields_options' => [
					'__all' => [
						'responsive' => false,
					],
					'font_family' => [
						'selectors' => [
							'{{WRAPPER}} .elemailer-email-customer-note p' => 'font-family: {{VALUE}}',
						],
						'description' => __('These are Websafe fonts with fallback font-family in place. But for the other property below do check in your mail clinets if they work as CSS support is limited in Mail Clients', 'elemailer'),
					],
		        ],
			]
		);

		$this->add_control(
			'email_customer_note_color',
			[
				'label'     => __( 'Color', 'elemailer' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elemailer-email-customer-note p' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'email_customer_note_background',
			[
				'label'     => __( 'Background Color', 'elemailer' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elemailer-email-customer-note p' => 'background: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'email_customer_note_padding',
			[
				'label' 	=> __( 'Padding', 'elemailer' ),
				'type' 		=> Controls_Manager::DIMENSIONS,
        		'size_units' => [ 'px', '%', 'em' ],
        		'selectors' => [
        			'{{WRAPPER}} .elemailer-email-customer-note p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        		],
			]
		);

		$this->add_control(
			'email_customer_note_margin',
			[
				'label'         => __( 'Margin', 'elemailer' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .elemailer-email-customer-note p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render
	 *
	 * @since 1.0.8
	 */
	protected function render() {
		$settings = $this->get_active_settings();
		$order_id = elemailer_is_edit_mode() || elemailer_is_preview_mode() ? elemailer_get_random_order_id() : elemailer_get_current_order_id();
		$order 	  = wc_get_order( $order_id );

		if ( ! is_a( $order, 'WC_Order' ) ) return;

		$text_align = is_rtl() ? 'right' : 'left';

		if ( $order->get_customer_note() ) {
			?>
			<div class="elemailer-email-customer-note">
				<p>
					<?php 
					echo '<span>'. __( 'Note:', 'elemailer' ) .'</span>';
					echo wp_kses_post( nl2br( wptexturize( $order->get_customer_note() ) ) );
					?>
				</p>
			</div>
			<?php
		}
		elseif ( elemailer_is_edit_mode() || elemailer_is_preview_mode() ) {
			?>
			<div class="elemailer-email-customer-note">
				<p class="note"><?php esc_html_e( 'This is a sample order note left by the Customer. It will be replaced in email.', 'elemailer' ) ?></p>
			</div>
			<?php
		}
	}
}

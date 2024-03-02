<?php

namespace Elemailer\Integrations\Elementor\Widgets;

defined('ABSPATH') || exit;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;

/**
 * WooCommerce email description widget class
 *
 * @author elEmailer
 *
 * @since 1.0.8
 */
class Elemailer_Widget_WC_Description extends Widget_Base {

	/**
	 * Get name
	 *
	 * @since 1.0.8
	 */
	public function get_name() {
		return 'elemailer-wc-description';
	}

	/**
	 * Get title
	 *
	 * @since 1.0.8
	 */
	public function get_title() {
		return esc_html__( 'WooCommerce Order Description', 'elemailer' );
	}

	/**
	 * Get icon
	 *
	 * @since 1.0.8
	 */
	public function get_icon() {
		return 'eicon-single-post';
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
		return [ 'void', 'template', 'footer' ];
	}

	/**
	 * Register controls
	 *
	 * @since 1.0.8
	 */
	protected function register_controls() {
		$this->start_controls_section(
			'section_description_layout',
			[
				'label' => __( 'Layout', 'elemailer' ),
				'tab' 	=> Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'email_description',
			[
				'label' 	  => __( 'Description', 'elemailer' ),
				'type' 		  => 'elemailer_wc_email_content',
				'default' 	  => __( 'Hi, <br><br> A new order has been placed with order id: %%order_id%% <br><br> Customer name: %%billing_first_name%% %%billing_last_name%%', 'elemailer' ),
				'placeholder' => __( 'Type your description here', 'elemailer' ),
				'label_block' => true,
				'shortcodes'  => Base::elemailer_internal_smart_tag_parser('', '', true ),
			]
		);

		$this->add_control(
			'email_description_alignment',
			[
				'label' 	=> __( 'Alignment', 'elemailer' ),
				'type' 		=> Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'elemailer' ),
						'icon' 	=> 'eicon-text-align-left',
					],
					'center' 	=> [
						'title' => __( 'Center', 'elemailer' ),
						'icon' 	=> 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'elemailer' ),
						'icon' 	=> 'eicon-text-align-right',
					],
				],
				'selectors' =>[
					'{{WRAPPER}} .elemailer-email-description' => 'text-align: {{VALUE}};',
				],
				'toggle' => true,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'email_description_section_style',
			[
				'label' => __( 'Style', 'elemailer' ),
				'tab' 	=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'email_description_color',
			[
				'label' 	=> __( 'Color', 'elemailer' ),
				'type' 		=> Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elemailer-email-description' => 'color: {{VALUE}}',
					'{{WRAPPER}} .elemailer-email-description .wleh-content' => 'color: {{VALUE}}',
				],
				'default'	=> '#000'
			]
		);

		$this->add_control(
			'email_description__bg_color',
			[
				'label' 	=> __( 'Background', 'elemailer' ),
				'type' 		=> Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elemailer-email-description ' => 'background: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'email_description__font_size',
			[
				'label' => __('(Deprecated)Font Size (px)', 'elemailer'),
				'condition' => [
					'email_description__font_size[size]!' => 14,
				],
                'classes' => 'elementor-panel-alert elementor-panel-alert-danger',
				'type' 		=> Controls_Manager::SLIDER,
				'size_units'=> [ 'px' ],
				'range' 	=> [
					'px' => [
						'min' 	=> 0,
						'max' 	=> 1000,
						'step' 	=> 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 14,
				],
				'selectors' 	=> [
					'{{WRAPPER}} .elemailer-email-description' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .elemailer-email-description .wleh-content' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
		// font options as per https://www.cssfontstack.com/
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'wc_ds_typography',
				'global' => [
					'active' => false,
				],
				'selector' => '{{WRAPPER}} .elemailer-email-description,{{WRAPPER}} .elemailer-email-description .wleh-content',
				'seperator'=> 'before',
				'fields_options' => [
					'__all' => [
						'responsive' => false,
					],
					'font_family' => [
						'selectors' => [
							'{{WRAPPER}} .elemailer-email-description,{{WRAPPER}} .elemailer-email-description .wleh-content' => 'font-family: {{VALUE}}',
						],
						'description' => __('These are Websafe fonts with fallback font-family in place. But for the other property below do check in your mail clinets if they work as CSS support is limited in Mail Clients', 'elemailer'),
					],
		        ],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'email_description_border',
				'label' => __( 'Border', 'elemailer' ),
				'selector' => '{{WRAPPER}} .elemailer-email-description',
			]
		);

		$this->add_responsive_control(
			'email_description_border_radius',
			[
				'label' 		=> __( 'Border Radius', 'elemailer' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .elemailer-email-description' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'email_description_padding',
			[
				'label' 		=> __( 'Padding', 'elemailer' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .elemailer-email-description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'email_description_margin',
			[
				'label' 		=> __( 'Margin', 'elemailer' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .elemailer-email-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

		//$description = Base::elemailer_internal_smart_tag_parser($order, $settings['email_description'], false );
		$description = $settings['email_description'];

		echo "<div class='elemailer-email-description'>{$description}</div>";
	}
}

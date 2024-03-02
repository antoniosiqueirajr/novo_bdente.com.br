<?php

namespace Elemailer\Integrations\Elementor\Widgets;

defined('ABSPATH') || exit;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;

/**
 * WooCommerce email footer widget class
 *
 * @author elEmailer
 *
 * @since 1.0.8
 */
class Elemailer_Widget_WC_Footer extends Widget_Base {

	/**
	 * Get name
	 *
	 * @since 1.0.8
	 */
	public function get_name() {
		return 'elemailer-wc-footer';
	}

	/**
	 * Get title
	 *
	 * @since 1.0.8
	 */
	public function get_title() {
		return esc_html__( 'WooCommerce Footer', 'elemailer' );
	}

	/**
	 * Get icon
	 *
	 * @since 1.0.8
	 */
	public function get_icon() {
		return 'eicon-footer';
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
			'section_layout',
			[
				'label' => __( 'Layout', 'elemailer' ),
				'tab' 	=> Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'email_footer_text',
			[
				'label' 		=> __( 'Content', 'elemailer' ),
				'type' 			=> 'elemailer_wc_email_content',
				'default'		=> __( 'Email Footer', 'elemailer' ),
				'placeholder' 	=> __( 'Type your title here', 'elemailer' ),
				'label_block' 	=> true,
				'shortcodes'  	=> Base::elemailer_internal_smart_tag_parser('', '', true ),
			]
		);

		$this->add_control(
			'html_tag',
			[
				'label' 	=> __( 'HTML Tag', 'elemailer' ),
				'type' 		=> Controls_Manager::SELECT,
				'default'   => 'p',
				'options' 	=> [
					'h1' 	=> __( 'H1', 'elemailer' ),
					'h2' 	=> __( 'H2', 'elemailer' ),
					'h3' 	=> __( 'H3', 'elemailer' ),
					'h4' 	=> __( 'H4', 'elemailer' ),
					'h5' 	=> __( 'H5', 'elemailer' ),
					'h6' 	=> __( 'H6', 'elemailer' ),
					'p' 	=> __( 'P', 'elemailer' ),
					'div' 	=> __( 'Div', 'elemailer' ),
				],
				'toggle' => true,
			]
		);

		$this->add_control(
			'alignment',
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
					'{{WRAPPER}} .elemailer-email-footer' => 'text-align: {{VALUE}};',
				],
				'toggle' => true,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label' => __( 'Style', 'elemailer' ),
				'tab' 	=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'payment_default_styles',
			[
				'label' 	=> __( 'Display', 'elemailer' ),
				'type' 		=> Controls_Manager::HIDDEN,
				'selectors' => [
					'{{WRAPPER}} .elemailer-email-footer h1' => 'margin: 0;',
					'{{WRAPPER}} .elemailer-email-footer h2' => 'margin: 0;',
					'{{WRAPPER}} .elemailer-email-footer h3' => 'margin: 0;',
					'{{WRAPPER}} .elemailer-email-footer h4' => 'margin: 0;',
					'{{WRAPPER}} .elemailer-email-footer h5' => 'margin: 0;',
					'{{WRAPPER}} .elemailer-email-footer h6' => 'margin: 0;',
				],
			]
		);

		$this->add_control(
			'content_color',
			[
				'label' 	=> __( 'Content Color', 'elemailer' ),
				'type' 		=> Controls_Manager::COLOR,
				'default' 	=> '#6EC1E4',
				'global' => [
					'active' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .elemailer-email-footer' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'content_bg_color',
			[
				'label' 	=> __( 'Background Color', 'elemailer' ),
				'type' 		=> Controls_Manager::COLOR,
				'global' => [
					'active' => false,
				],
				'default' 	=> 'transparent',
				'selectors' => [
					'{{WRAPPER}} .elemailer-email-footer ' => 'background: {{VALUE}}',
				],
			]
		);

		// font options as per https://www.cssfontstack.com/
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography',
				'global' => [
					'active' => false,
				],
				'selector' => '{{WRAPPER}} .elemailer-wc-footer-content',
				'seperator'=> 'before',
				'fields_options' => [
					'__all' => [
						'responsive' => false,
					],
					'font_family' => [
						'selectors' => [
							'{{WRAPPER}} .elemailer-wc-footer-content' => 'font-family: {{VALUE}}',
						],
						'description' => __('These are Websafe fonts with fallback font-family in place. But for the other property below do check in your mail clinets if they work as CSS support is limited in Mail Clients', 'elemailer'),
					],
		        ],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border',
				'label' => __( 'Border', 'elemailer' ),
				'selector' => '{{WRAPPER}} .elemailer-email-footer',
			]
		);

		$this->add_responsive_control(
			'border_radius',
			[
				'label' 		=> __( 'Border Radius', 'elemailer' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .elemailer-email-footer' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'margin',
			[
				'label' 		=> __( 'Margin', 'elemailer' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .elemailer-email-footer' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'padding',
			[
				'label' 		=> __( 'Padding', 'elemailer' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .elemailer-email-footer' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

		$_html_tag = $settings['html_tag'];
		$start_tag = !empty( $_html_tag ) ? "<{$_html_tag} class='elemailer-wc-footer-content'>" : "";
		$end_tag   = !empty( $_html_tag ) ? "</{$_html_tag}>" : "";
		
		//$footer = Base::elemailer_internal_smart_tag_parser($order, $_footer, false );
		$_footer   = $settings['email_footer_text'];

		
		echo "<div class='elemailer-email-footer'>{$start_tag}{$_footer}{$end_tag}</div>";
	}
}

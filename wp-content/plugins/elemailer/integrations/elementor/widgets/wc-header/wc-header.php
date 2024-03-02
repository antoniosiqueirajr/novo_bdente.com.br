<?php

namespace Elemailer\Integrations\Elementor\Widgets;

defined('ABSPATH') || exit;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;

/**
 * WooCommerce email header widget class
 *
 * @author elEmailer
 *
 * @since 1.0.8
 */
class Elemailer_Widget_WC_Header extends Widget_Base {

	/**
	 * Get name
	 *
	 * @since 1.0.8
	 */
	public function get_name() {
		return 'elemailer-wc-header';
	}

	/**
	 * Get title
	 *
	 * @since 1.0.8
	 */
	public function get_title() {
		return esc_html__( 'WooCommerce Header', 'elemailer' );
	}

	/**
	 * Get icon
	 *
	 * @since 1.0.8
	 */
	public function get_icon() {
		return 'eicon-header';
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
			'email_header_text',
			[
				'label' => __( 'Content', 'elemailer' ),
				'type' => 'elemailer_wc_email_content',
				'default' => __( 'Order ', 'elemailer' ).'#%%order_id%%',
				'placeholder' => __( 'Type your title here', 'elemailer' ),
				'label_block' => true,
				'shortcodes'  => Base::elemailer_internal_smart_tag_parser('', '', true ),
			]
		);

		$this->add_control(
			'html_tag',
			[
				'label' 	=> __( 'HTML Tag', 'elemailer' ),
				'type' 		=> Controls_Manager::SELECT,
				'default'   => 'h3',
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
					'{{WRAPPER}} .elemailer-email-header' => 'text-align: {{VALUE}};',
					'{{WRAPPER}} .elemailer-email-header .elemailereh-content' => 'text-align: {{VALUE}};'
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
					'{{WRAPPER}} .elemailer-email-header h1' => 'margin: 0;',
					'{{WRAPPER}} .elemailer-email-header h2' => 'margin: 0;',
					'{{WRAPPER}} .elemailer-email-header h3' => 'margin: 0;',
					'{{WRAPPER}} .elemailer-email-header h4' => 'margin: 0;',
					'{{WRAPPER}} .elemailer-email-header h5' => 'margin: 0;',
					'{{WRAPPER}} .elemailer-email-header h6' => 'margin: 0;',
				],
				'default' => 'traditional',
			]
		);

		$this->add_control(
			'content_color',
			[
				'label' 	=> __( 'Content Color', 'elemailer' ),
				'type' 		=> Controls_Manager::COLOR,
				'global' => [
					'active' => false,
				],
				'default'	=> '#000',
				'selectors' => [
					'{{WRAPPER}} .elemailer-email-header' => 'color: {{VALUE}}',
					'{{WRAPPER}} .elemailer-email-header .elemailereh-content' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'content_bg_color',
			[
				'label' 	=> __( 'Background Color', 'elemailer' ),
				'type' 		=> Controls_Manager::COLOR,
				'default'	=> 'transparent',
				'selectors' => [
					'{{WRAPPER}} .elemailer-email-header ' => 'background: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'content_font_size',
			[
				'label' 	=> __( '(Deprecated)Font Size', 'elemailer' ),
				'condition' => [
                    'content_font_size[size]!' => '',
                ],
				'description' => __('Please use the Typography control below as this will be remove in the future', 'elemailer'),
				'classes' => 'elementor-panel-alert elementor-panel-alert-danger',
				'type' 		=> Controls_Manager::SLIDER,
				'size_units'=> [ 'px' ],
				'range' 	=> [
					'px' => [
						'min' 	=> 0,
						'max' 	=> 100,
						'step' 	=> 1,
					],
				],
				'selectors' 	=> [
					'{{WRAPPER}} .elemailer-email-header' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .elemailer-email-header .elemailereh-content' => 'font-size: {{SIZE}}{{UNIT}};',
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
				'selector' => '{{WRAPPER}} .elemailer-email-header, {{WRAPPER}} .elemailer-email-header .elemailereh-content',
				'seperator'=> 'before',
				'fields_options' => [
					'__all' => [
						'responsive' => false,
					],
					'font_family' => [
						'selectors' => [
							'{{WRAPPER}} .elemailer-email-header, {{WRAPPER}} .elemailer-email-header .elemailereh-content' => 'font-family: {{VALUE}}',
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
				'selector' => '{{WRAPPER}} .elemailer-email-header',
			]
		);

		$this->add_responsive_control(
			'border_radius',
			[
				'label' 		=> __( 'Border Radius', 'elemailer' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .elemailer-email-header' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .elemailer-email-header' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'default' 		=> [
					'top' => 0,
					'right' => 0,
					'bottom' => 0,
					'left' => 0,
					'unit' => 'px',
					'isLinked' => true,
				]
			]
		);

		$this->add_responsive_control(
			'padding',
			[
				'label' 		=> __( 'Padding', 'elemailer' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .elemailer-email-header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
		$start_tag = !empty( $_html_tag ) ? "<{$_html_tag} class='elemailereh-content'>" : "";
		$end_tag   = !empty( $_html_tag ) ? "</{$_html_tag}>" : "";
		
		// elemailer_wc_shortcode_parser method pass order object, real string, return only keys?. 
		//$content = Base::elemailer_internal_smart_tag_parser($order, $content, false );
		$content   = $settings['email_header_text'];

		echo "<div class='elemailer-email-header'>{$start_tag}{$content}{$end_tag}</div>";
	}
}
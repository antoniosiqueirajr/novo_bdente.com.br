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
 * @since 4.0
 */
class Elemailer_Widget_WC_Order_Meta extends Widget_Base {

	/**
	 * Get name
	 *
	 * @since 1.0.8
	 */
	public function get_name() {
		return 'elemailer-wc-order-meta';
	}

	/**
	 * Get title
	 *
	 * @since 1.0.8
	 */
	public function get_title() {
		return esc_html__( 'Order Meta', 'elemailer' );
	}

	/**
	 * Get icon
	 *
	 * @since 1.0.8
	 */
	public function get_icon() {
		return 'eicon-table-of-contents';
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
		return [ 'void', 'order', 'meta' ];
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
				'label' => __( 'Main', 'elemailer' ),
				'tab' 	=> Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'important_note',
			[
				'label' => esc_html__( 'Important Note', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				'raw' => __( '<div style="line-height: 22px;font-size: 12px;margin-top: 24px;">For now, this widget enables the use of <a target="_blank" href="https://woocommerce.com/document/add-a-custom-field-in-an-order-to-the-emails/">woocommerce_email_order_meta</a> filter added by WooCommerce. But if you have not added any data via the filter as expected nothing is going to show up in your email for this widget. There might be improements done in future to allow use of meta key directly through this widget</div>', 'elemailer' ),
			]
		);


		// $this->add_control(
		// 	'ele_order_meta',
		// 	[
		// 		'label' => __( 'Content', 'elemailer' ),
		// 		'type' => 'elemailer_wc_email_content',
		// 		'default' => __( 'Order ', 'elemailer' ).'#%%order_id%%',
		// 		'placeholder' => __( 'Type your title here', 'elemailer' ),
		// 		'label_block' => true,
		// 		'shortcodes'  => [
		// 			['%%order_id%%'],
		// 			['%%billing_first_name%%'],
		// 			['%%billing_last_name%%'],
		// 			['%%shipping_first_name%%'],
		// 			['%%shipping_last_name%%'],
		// 		]
		// 	]
		// );

		// $this->add_control(
		// 	'html_tag',
		// 	[
		// 		'label' 	=> __( 'HTML Tag', 'elemailer' ),
		// 		'type' 		=> Controls_Manager::SELECT,
		// 		'default'   => 'h3',
		// 		'options' 	=> [
		// 			'h1' 	=> __( 'H1', 'elemailer' ),
		// 			'h2' 	=> __( 'H2', 'elemailer' ),
		// 			'h3' 	=> __( 'H3', 'elemailer' ),
		// 			'h4' 	=> __( 'H4', 'elemailer' ),
		// 			'h5' 	=> __( 'H5', 'elemailer' ),
		// 			'h6' 	=> __( 'H6', 'elemailer' ),
		// 			'p' 	=> __( 'P', 'elemailer' ),
		// 			'div' 	=> __( 'Div', 'elemailer' ),
		// 		],
		// 		'toggle' => true,
		// 	]
		// );

		// $this->add_control(
		// 	'alignment',
		// 	[
		// 		'label' 	=> __( 'Alignment', 'elemailer' ),
		// 		'type' 		=> Controls_Manager::CHOOSE,
		// 		'options' => [
		// 			'left' => [
		// 				'title' => __( 'Left', 'elemailer' ),
		// 				'icon' 	=> 'eicon-text-align-left',
		// 			],
		// 			'center' 	=> [
		// 				'title' => __( 'Center', 'elemailer' ),
		// 				'icon' 	=> 'eicon-text-align-center',
		// 			],
		// 			'right' => [
		// 				'title' => __( 'Right', 'elemailer' ),
		// 				'icon' 	=> 'eicon-text-align-right',
		// 			],
		// 		],
		// 		'selectors' =>[
		// 			'{{WRAPPER}} .elemailer-email-header' => 'text-align: {{VALUE}};',
		// 			'{{WRAPPER}} .elemailer-email-header .elemailereh-content' => 'text-align: {{VALUE}};'
		// 		],
		// 		'toggle' => true,
		// 	]
		// );

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label' => __( 'Style', 'elemailer' ),
				'tab' 	=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'content_color',
			[
				'label' 	=> __( 'Content Color', 'elemailer' ),
				'type' 		=> Controls_Manager::COLOR,
				'default'	=> '#000',
				'selectors' => [
					'{{WRAPPER}} .elemailer-order-meta' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'label_color',
			[
				'label' 	=> __( 'Label Color', 'elemailer' ),
				'type' 		=> Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elemailer-order-meta p strong' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'content_font_size',
			[
				'label' 	=> __( '(Deprecated)Content Font Size', 'elemailer' ),
				'classes' => 'elementor-panel-alert elementor-panel-alert-danger',
				'condition' => [
                    'content_font_size[size]!' => '',
                ],
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
					'{{WRAPPER}} .elemailer-order-meta' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .elemailer-order-meta p' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		// font options as per https://www.cssfontstack.com/
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'cont_typography',
				'label' 	=> __( 'Content Typography', 'elemailer' ),
				'global' => [
					'active' => false,
				],
				'selector' => '{{WRAPPER}} .elemailer-order-meta,{{WRAPPER}} .elemailer-order-meta p',
				'seperator'=> 'before',
				'fields_options' => [
					'__all' => [
						'responsive' => false,
					],
					'font_family' => [
						'selectors' => [
							'{{WRAPPER}} .elemailer-order-meta,{{WRAPPER}} .elemailer-order-meta p' => 'font-family: {{VALUE}}',
						],
						'description' => __('These are Websafe fonts with fallback font-family in place. But for the other property below do check in your mail clinets if they work as CSS support is limited in Mail Clients', 'elemailer'),
					],
		        ],
			]
		);

		$this->add_control(
			'label_font_size',
			[
				'label' 	=> __( '(Deprecated)Label Font Size', 'elemailer' ),
				'classes' => 'elementor-panel-alert elementor-panel-alert-danger',
				'condition' => [
                    'label_font_size[size]!' => '',
                ],
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
					'{{WRAPPER}}  .elemailer-order-meta p strong' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		// font options as per https://www.cssfontstack.com/
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'lbl_typography',
				'label' 	=> __( 'Label Typography', 'elemailer' ),
				'global' => [
					'active' => false,
				],
				'selector' => '{{WRAPPER}} .elemailer-order-meta p strong',
				'seperator'=> 'before',
				'fields_options' => [
					'__all' => [
						'responsive' => false,
					],
					'font_family' => [
						'selectors' => [
							'{{WRAPPER}} .elemailer-order-meta p strong' => 'font-family: {{VALUE}}',
						],
						'description' => __('These are Websafe fonts with fallback font-family in place. But for the other property below do check in your mail clinets if they work as CSS support is limited in Mail Clients', 'elemailer'),
					],
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
					'{{WRAPPER}} .elemailer-order-meta' => 'background: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border',
				'label' => __( 'Border', 'elemailer' ),
				'selector' => '{{WRAPPER}} .elemailer-order-meta',
			]
		);

		$this->add_responsive_control(
			'border_radius',
			[
				'label' 		=> __( 'Border Radius', 'elemailer' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .elemailer-order-meta' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .elemailer-order-meta' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .elemailer-order-meta' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

		// $_header   = $settings['email_header_text'];
		// $_html_tag = $settings['html_tag'];
		// $start_tag = !empty( $_html_tag ) ? "<{$_html_tag} class='elemailereh-content'>" : "";
		// $end_tag   = !empty( $_html_tag ) ? "</{$_html_tag}>" : "";
		// $targets   = [ '%%order_id%%', '%%billing_first_name%%', '%%billing_last_name%%', '%%shipping_first_name%%', '%%shipping_last_name%%' ];
		// $replace   = [ $order->get_id(), $order->get_billing_first_name(), $order->get_billing_last_name(), $order->get_shipping_first_name(), $order->get_shipping_last_name() ];
		// $header    = str_replace( $targets, $replace, $_header );
		
		echo "<div class='elemailer-order-meta'>";
	
			$WC_Emails = new \WC_Emails();
			$WC_Emails->order_meta( $order, $sent_to_admin = false, $plain_text = false );

		echo "</div>";

	}
}

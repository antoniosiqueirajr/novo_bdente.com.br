<?php

namespace Elemailer\Integrations\Elementor\Widgets;

defined('ABSPATH') || exit;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;

/**
 * WooCommerce email new account widget class
 *
 * @author elEmailer
 *
 * @since 1.0.8
 */
class Elemailer_Widget_WC_New_Account extends Widget_Base {

	/**
	 * Get name
	 *
	 * @since 1.0.8
	 */
	public function get_name() {
		return 'elemailer-wc-new-accouont';
	}

	/**
	 * Get title
	 *
	 * @since 1.0.8
	 */
	public function get_title() {
		return esc_html__( 'WooCommerce New Account', 'elemailer' );
	}

	/**
	 * Get icon
	 *
	 * @since 1.0.8
	 */
	public function get_icon() {
		return 'eicon-my-account';
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
		return [ 'void', 'woocommerce', 'woo' ];
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
				'label' 	  => __( 'Detail', 'elemailer' ),
				'type' 		  => 'elemailer_wc_email_content',
				'default' 	  => __( '<p>Thanks for creating an account on WP Test Site. Your username is %%customer_user_name%%. You can access your account area to view orders, change your password, and more at: %%site_url%%.<p> <p><a href="%%set_password_url%%">Click here to set your new password.</a><p>', 'elemailer' ),
				'placeholder' => __( 'Type your details here', 'elemailer' ),
				'label_block' => true,
				'shortcodes'  =>  Base::elemailer_internal_smart_tag_parser('', '', true ),
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
					'{{WRAPPER}} .elemailer-email-new-acc' => 'text-align: {{VALUE}};',
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
					'{{WRAPPER}} .elemailer-email-new-acc' => 'color: {{VALUE}}',
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
					'{{WRAPPER}} .elemailer-email-new-acc' => 'background: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'email_description__font_size',
			[
				'label' 	=> __( '(Deprecated)Font Size', 'elemailer' ),
				'classes' => 'elementor-panel-alert elementor-panel-alert-danger',
				'condition' => [
                    'email_description__font_size[size]!' => 14,
                ],
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
					'{{WRAPPER}} .elemailer-email-new-acc' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .elemailer-email-new-acc p' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		// font options as per https://www.cssfontstack.com/
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'na_typography',
				'global' => [
					'active' => false,
				],
				'selector' => '{{WRAPPER}} .elemailer-email-new-acc,{{WRAPPER}} .elemailer-email-new-acc p',
				'seperator'=> 'before',
				'fields_options' => [
					'__all' => [
						'responsive' => false,
					],
					'font_family' => [
						'selectors' => [
							'{{WRAPPER}} .elemailer-email-new-acc,{{WRAPPER}} .elemailer-email-new-acc p' => 'font-family: {{VALUE}}',
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
				'selector' => '{{WRAPPER}} .elemailer-email-new-acc',
			]
		);

		$this->add_responsive_control(
			'email_description_border_radius',
			[
				'label' 		=> __( 'Border Radius', 'elemailer' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				// 'conditions' => [
				// 					'terms' => [
				// 						[
				// 							'name' => 'email_description_border_border',
				// 							'operator' => '!=',
				// 							'value' => [
				// 								'',
				// 							],
				// 						],
				// 					],
				// 				],
				'selectors' 	=> [
					'{{WRAPPER}} .elemailer-email-new-acc' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .elemailer-email-new-acc' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'email_description_margin',
			[
				'label' 		=> __( 'Margin', 'elemailer' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'seperator'		=> 'after',
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .elemailer-email-new-acc' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		//@since 3.6
		$this->add_control(
			'ele_w_new_account_link_color',
			[
				'label' 	=> __( 'Link Color', 'elemailer' ),
				'separator' => 'before',
				'type' 		=> Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elemailer-email-new-acc a' => 'color: {{VALUE}}',
				],
				'default'	=> '#0000ff'
			]
		);
		$this->add_control(
			'ele_w_new_acc_link_bg_color',
			[
				'label' 	=> __( 'Link Background', 'elemailer' ),
				'type' 		=> Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elemailer-email-new-acc a' => 'background: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'ele_w_new_acc_link_font_size',
			[
				'label' 	=> __( '(Deprecated)Link Font Size', 'elemailer' ),
				'classes' => 'elementor-panel-alert elementor-panel-alert-danger',
				'type' 		=> Controls_Manager::SLIDER,
				'condition' => [
                    'ele_w_new_acc_link_font_size[size]!' => 14,
                ],
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
					'{{WRAPPER}} .elemailer-email-new-acc a' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		// font options as per https://www.cssfontstack.com/
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'onl_typography',
				'global' => [
					'active' => false,
				],
				'selector' => '{{WRAPPER}} .elemailer-email-new-acc a',
				'seperator'=> 'before',
				'fields_options' => [
					'__all' => [
						'responsive' => false,
					],
					'font_family' => [
						'selectors' => [
							'{{WRAPPER}} .elemailer-email-new-acc a' => 'font-family: {{VALUE}}',
						],
						'description' => __('These are Websafe fonts with fallback font-family in place. But for the other property below do check in your mail clinets if they work as CSS support is limited in Mail Clients', 'elemailer'),
					],
		        ],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'ele_w_new_acc_link_border',
				'label' => __( 'Link Border', 'elemailer' ),
				'selector' => '{{WRAPPER}} .elemailer-email-new-acc a',
			]
		);

		$this->add_responsive_control(
			'ele_w_new_acc_link_border_radius',
			[
				'label' 		=> __( 'Link Border Radius', 'elemailer' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				// 'conditions' => [
				// 					'terms' => [
				// 						[
				// 							'name' => 'ele_w_new_acc_link_border_border',
				// 							'operator' => '!=',
				// 							'value' => [
				// 								'',
				// 							],
				// 						],
				// 					],
				// 				],
				'selectors' 	=> [
					'{{WRAPPER}} .elemailer-email-new-acc a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'ele_w_new_acc_link_padding',
			[
				'label' 		=> __( 'Link Padding', 'elemailer' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .elemailer-email-new-acc a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'ele_w_new_acc_link_margin',
			[
				'label' 		=> __( 'Link Margin', 'elemailer' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'description'	=> __('Support for margins are limited with inline block css in emails so in some email clinets such as outlook it might not work as expected', 'elemailer'),
				'seperator'		=> 'after',
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .elemailer-email-new-acc a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};display:inline-block;',
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
		$settings         = $this->get_active_settings();

		$description = $settings['email_description'];

		echo "<div class='elemailer-email-new-acc'>{$description}</div>";
	}
}

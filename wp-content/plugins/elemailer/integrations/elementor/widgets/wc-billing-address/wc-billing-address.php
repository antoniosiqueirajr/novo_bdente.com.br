<?php

namespace Elemailer\Integrations\Elementor\Widgets;

defined('ABSPATH') || exit;

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;

/**
 * WooCommerce email billing addresses widget class
 *
 * @author elEmailer
 *
 * @since 1.0.8
 */
class Elemailer_Widget_WC_Billing_Address extends Widget_Base {

    /**
     * Get name
     *
     * @since 1.0.8
     */
    public function get_name() {
        return 'elemailer-wc-billing-address';
    }

    /**
     * Get title
     *
     * @since 1.0.8
     */
    public function get_title() {
        return esc_html__( 'WooCommerce Billing Addresses', 'elemailer' );
    }

    /**
     * Get icon
     *
     * @since 1.0.8
     */
    public function get_icon() {
        return 'eicon-envelope';
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
            'email_billing_title',
            [
                'label' => __( 'Title', 'elemailer' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'email_billing_title_show',
            [
                'label'        => __( 'Show/Hide Title', 'elemailer' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Show', 'elemailer' ),
                'label_off'    => __( 'Hide', 'elemailer' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );
        $this->add_control(
            'email_billing_title_text',
            [
                'label'     => __( 'Text', 'elemailer' ),
                'type'      => Controls_Manager::TEXT,
                'default'   => __( 'Billing Address', 'elemailer' ) ,
                'condition' => [
                    'email_billing_title_show' => 'yes'
                ],
                'dynamic'   => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'email_billing_title_tag',
            [
                'label'     => __( 'HTML Tag', 'elemailer' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'h3',
                'options'   => [
                    'h1'  => __( 'H1', 'elemailer' ),
                    'h2'  => __( 'H2', 'elemailer' ),
                    'h3'  => __( 'H3', 'elemailer' ),
                    'h4'  => __( 'H4', 'elemailer' ),
                    'h5'  => __( 'H5', 'elemailer' ),
                    'h6'  => __( 'H6', 'elemailer' ),
                ],
                'condition' => [
                    'email_billing_title_show' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'email_billing_title_alignment',
            [
                'label'        => __( 'Alignment', 'elemailer' ),
                'type'         => Controls_Manager::CHOOSE,
                'options'      => [
                    'left'      => [
                        'title'     => __( 'Left', 'elemailer' ),
                        'icon'      => 'eicon-text-align-left',
                    ],
                    'center'    => [
                        'title'     => __( 'Center', 'elemailer' ),
                        'icon'      => 'eicon-text-align-center',
                    ],
                    'right'     => [
                        'title'     => __( 'Right', 'elemailer' ),
                        'icon'      => 'eicon-text-align-right',
                    ],
                ],
                'default'   => 'left',
                'toggle'    => true,
                'condition' => [
                    'email_billing_title_show' => 'yes'
                ],
                'selectors' => [
                    '{{WRAPPER}} .elemailer-email-billing-title' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'email_billing_address',
            [
                'label' => __( 'Address', 'elemailer' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );


        $this->add_control(
            'email_billing_address_alignment',
            [
                'label'        => __( 'Alignment', 'elemailer' ),
                'type'         => Controls_Manager::CHOOSE,
                'options'      => [
                    'left'      => [
                        'title'     => __( 'Left', 'elemailer' ),
                        'icon'      => 'eicon-text-align-left',
                    ],
                    'center'    => [
                        'title'     => __( 'Center', 'elemailer' ),
                        'icon'      => 'eicon-text-align-center',
                    ],
                    'right'     => [
                        'title'     => __( 'Right', 'elemailer' ),
                        'icon'      => 'eicon-text-align-right',
                    ],
                ],
                'default'   => 'left',
                'toggle'    => true,
                'selectors' => [
                    '{{WRAPPER}} .elemailer-email-billing-address-content' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'email_billing_title_style',
            [
                'label' => __( 'Title', 'elemailer' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'email_billing_title_show' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'email_billing_title_size',
            [
                'label' => __( 'Font Size', 'elemailer' ),
                'condition' => [
                    'email_billing_title_size[size]!' => '',
                ],
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .elemailer-email-billing-title' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'email_billing_title_color',
            [
                'label'     => __( 'Color', 'elemailer' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elemailer-email-billing-title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'email_billing_title_background',
            [
                'label'     => __( 'Background Color', 'elemailer' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elemailer-email-billing-title' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'email_billing_title_padding',
            [
                'label'     => __( 'Padding', 'elemailer' ),
                'type'      => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .elemailer-email-billing-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'email_billing_title_margin',
            [
                'label'         => __( 'Margin', 'elemailer' ),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', '%' ],
                'selectors'     => [
                    '{{WRAPPER}} .elemailer-email-billing-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'email_billing_address_style',
            [
                'label' => __( 'Address', 'elemailer' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'email_billing_address_size',
            [
                'label' => __( 'Font Size', 'elemailer' ),
                'condition' => [
                    'email_billing_address_size[size]!' => '',
                ],
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .elemailer-email-billing-address-content' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'email_billing_address_color',
            [
                'label'     => __( 'Color', 'elemailer' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#000',
                'selectors' => [
                    '{{WRAPPER}} .elemailer-email-billing-address-content' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .elemailer-email-billing-address-content a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'email_billing_address_background',
            [
                'label'     => __( 'Background Color', 'elemailer' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elemailer-email-billing-address-content' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'email_billing_address_padding',
            [
                'label'     => __( 'Padding', 'elemailer' ),
                'type'      => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .elemailer-email-billing-address-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'email_billing_address_margin',
            [
                'label'         => __( 'Margin', 'elemailer' ),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', '%' ],
                'selectors'     => [
                    '{{WRAPPER}} .elemailer-email-billing-address-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
        $order    = wc_get_order( $order_id );

        extract( $settings );

        if ( ! is_a( $order, 'WC_Order' ) ) return;

        $address = $order->get_formatted_billing_address();
        
        $this->add_render_attribute( 'email_billing_title_text', 'class', 'elemailer-email-billing-title' );
        $this->add_render_attribute( 'email_billing_address_style', 'class', 'address elemailer-email-billing-address-content' );
        ?>
        <div class="elemailer-email-billing-address">
            <?php 
            if( 'yes' == $email_billing_title_show ): 
                printf( '<%1$s %2$s>%3$s</%1$s>',
                    esc_attr( $email_billing_title_tag ),
                    $this->get_render_attribute_string( 'email_billing_title_text' ),
                    esc_html( $email_billing_title_text )
                );
            endif; 
            ?>
            <address <?php echo $this->get_render_attribute_string( 'email_billing_address_style' ); ?>>
                <?php echo wp_kses_post( $address ? $address : esc_html__( 'N/A', 'elemailer' ) ); ?>
                <?php if ( $order->get_billing_phone() ) : ?>
                    <br/><?php echo wc_make_phone_clickable( $order->get_billing_phone() ); ?>
                <?php endif; ?>
                <?php if ( $order->get_billing_email() ) : ?>
                    <br/><?php echo esc_html( $order->get_billing_email() ); ?>
                <?php endif; ?>
            </address>
        </div>
        <?php
    }
}

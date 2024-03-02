<?php

namespace Elemailer\Integrations\Elementor\Widgets;

defined('ABSPATH') || exit;

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;

/**
 * WooCommerce email shipping addresses widget class
 *
 * @author elEmailer 
 *
 * @since 1.0.8
 */
class Elemailer_Widget_WC_Shipping_Address extends Widget_Base {

    /**
     * Get name
     *
     * @since 1.0.8
     */
    public function get_name() {
        return 'elemailer-wc-shipping-address';
    }

    /**
     * Get title
     *
     * @since 1.0.8
     */
    public function get_title() {
        return esc_html__( 'WooCommerce Shipping Addresses', 'elemailer' );
    }

    /**
     * Get icon
     *
     * @since 1.0.8
     */
    public function get_icon() {
        return 'eicon-mail';
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
        return [ 'void', 'shiping', 'woo' ];
    }

    /**
     * Register controls
     *
     * @since 1.0.8
     */
    protected function register_controls() {
        $this->start_controls_section(
            'email_shipping_title',
            [
                'label' => __( 'Title', 'elemailer' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'email_shipping_title_show',
            [
                'label'         => __( 'Show/Hide Title', 'elemailer' ),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => __( 'Show', 'elemailer' ),
                'label_off'     => __( 'Hide', 'elemailer' ),
                'return_value'  => 'yes',
                'default'       => 'yes',
            ]
        );
        $this->add_control(
            'email_shipping_title_text',
            [
                'label'         => __( 'Text', 'elemailer' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => __( 'Shipping Address', 'elemailer' ) ,
                'condition'     => [
                    'email_shipping_title_show' => 'yes'
                ],
                'dynamic'       => [
                    'active'        => true,
                ]
            ]
        );

        $this->add_control(
            'email_shipping_title_tag',
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
                    'email_shipping_title_show' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'email_shipping_title_alignment',
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
                    'email_shipping_title_show' => 'yes'
                ],
                'selectors' => [
                    '{{WRAPPER}} .elemailer-email-shipping-title' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'email_shipping_address',
            [
                'label' => __( 'Address', 'elemailer' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'email_shipping_address_alignment',
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
                    '{{WRAPPER}} .elemailer-email-shipping-address-content' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'email_shipping_title_style',
            [
                'label' => __( 'Title', 'elemailer' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'email_shipping_title_show' => 'yes'
                ],
            ]
        );
        $this->add_control(
            'email_shipping_title_size',
            [
                'label' => __( 'Font Size', 'elemailer' ),
                'condition' => [
                    'email_shipping_title_size[size]!' => '',
                ],
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .elemailer-email-shipping-title' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'email_shipping_title_color',
            [
                'label'     => __( 'Color', 'elemailer' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elemailer-email-shipping-title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'email_shipping_title_background',
            [
                'label'     => __( 'Background Color', 'elemailer' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elemailer-email-shipping-title' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'email_shipping_title_padding',
            [
                'label'     => __( 'Padding', 'elemailer' ),
                'type'      => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .elemailer-email-shipping-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'email_shipping_title_margin',
            [
                'label'         => __( 'Margin', 'elemailer' ),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', '%' ],
                'selectors'     => [
                    '{{WRAPPER}} .elemailer-email-shipping-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'email_shipping_address_style',
            [
                'label' => __( 'Address', 'elemailer' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'email_shipping_address_size',
            [
                'label' => __( 'Font Size', 'elemailer' ),
                'condition' => [
                    'email_shipping_address_size[size]!' => '',
                ],
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .elemailer-email-shipping-address-content' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'email_shipping_address_color',
            [
                'label'     => __( 'Color', 'elemailer' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#000',
                'selectors' => [
                    '{{WRAPPER}} .elemailer-email-shipping-address-content' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .elemailer-email-shipping-address-content a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'email_shipping_address_background',
            [
                'label'     => __( 'Background Color', 'elemailer' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elemailer-email-shipping-address-content' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'email_shipping_address_padding',
            [
                'label'     => __( 'Padding', 'elemailer' ),
                'type'      => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .elemailer-email-shipping-address-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'email_shipping_address_margin',
            [
                'label'         => __( 'Margin', 'elemailer' ),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', '%' ],
                'selectors'     => [
                    '{{WRAPPER}} .elemailer-email-shipping-address-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

        if ( ! is_a( $order, 'WC_Order' ) ) return;

        extract( $settings );

        $shipping = $order->get_formatted_shipping_address();

        if ( ! $shipping && ( elemailer_is_edit_mode() || elemailer_is_preview_mode() ) ) {
            $shipping = $order->get_formatted_billing_address();
        }

        $this->add_render_attribute( 'email_shipping_title_text', 'class', 'elemailer-email-shipping-title' );
        $this->add_render_attribute( 'email_shipping_address_style', 'class', 'address elemailer-email-shipping-address-content' );

        if ( ( ! wc_ship_to_billing_address_only() && $order->needs_shipping_address() && $shipping ) || elemailer_is_edit_mode() || elemailer_is_preview_mode() ) :
            ?>
            <div class="elemailer-email-shipping-address">
                <?php 
                    if( 'yes' == $email_shipping_title_show ): 

                    printf( '<%1$s %2$s>%3$s</%1$s>',
                        esc_attr( $email_shipping_title_tag ),
                        $this->get_render_attribute_string( 'email_shipping_title_text' ),
                        esc_html( $email_shipping_title_text )
                    );
                    
                endif;
                ?>
                <address <?php echo $this->get_render_attribute_string( 'email_shipping_address_style' ); ?>>
                    <?php echo wp_kses_post( $shipping ); ?>
                <?php if ( $order->get_shipping_phone() ) : ?>
                    <br /><?php echo wc_make_phone_clickable( $order->get_shipping_phone() ); ?>
                <?php endif; ?>
                </address>
            </div>
        <?php 
        endif;
    }
}

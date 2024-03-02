<?php

namespace Elemailer\Integrations\Elementor\Widgets;

defined('ABSPATH') || exit;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;

/**
 * WooCommerce email item details widget class
 *
 * @author elEmailer
 *
 * @since x.x.x
 */
class Elemailer_Widget_WC_Booking_Item_Details extends Widget_Base {

    /**
     * Get name
     *
     * @since x.x.x
     */
    public function get_name() {
        return 'elemailer-wc-booking-item-details';
    }

    /**
     * Get title
     *
     * @since x.x.x
     */
    public function get_title() {
        return esc_html__( 'Booking Item Details', 'elemailer' );
    }

    /**
     * Get icon
     *
     * @since x.x.x
     */
    public function get_icon() {
        return 'eicon-table-of-contents';
    }

    /**
     * Show in panel
     *
     * @since x.x.x
     */
    public function show_in_panel() {
        $post_type = get_post_type();
        return ( in_array( $post_type, [ 'em-emails-template' ] ) );
    }

    /**
     * Get categories
     *
     * @since x.x.x
     */
    public function get_categories() {
        return [ 'elemailer-template-builder-fields' ];
    }
    
    /**
     * Get keywords
     *
     * @since x.x.x
     */
    public function get_keywords() {
        return [ 'void', 'template', 'footer' ];
    }

    /**
     * Register controls
     *
     * @since x.x.x
     */
    protected function register_controls() {
        /**
         * Heading
         */
        $this->start_controls_section(
            'table_heading_content',
            [
                'label' => __( 'Heading', 'elemailer' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'show_title',
            [
                'label'     => __( 'Show Table Title', 'elemailer' ),
                'type'      => Controls_Manager::SWITCHER,
                'label_on'  => __( 'Show', 'elemailer' ),
                'label_off' => __( 'Hide', 'elemailer' ),
                'return_value' => 'yes',
                'default'   => 'yes',
            ]
        );

        $this->end_controls_section();

        /**
         * Heading
         */
        $this->start_controls_section(
            'section_enable_hooks',
            [
                'label' => __( 'Manage Hooks', 'elemailer' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'enable_hooks',
            [
                'label'     => __( 'Enable Hooks', 'elemailer' ),
                'type'      => Controls_Manager::SWITCHER,
                'label_on'  => __( 'Yes', 'elemailer' ),
                'label_off' => __( 'No', 'elemailer' ),
                'return_value' => 'yes',
                'default'   => '',
                'description' => __( 'Enabling this will allow other plugins to add actions to the available hook tags in email templates.', 'elemailer' )
            ]
        );

        $this->end_controls_section();
        /**
         * Heading
         */
        $this->start_controls_section(
            'email_item_details_Heading',
            [
                'label' => __( 'Heading', 'elemailer' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'email_item_details_Heading_size',
            [
                'label' => __( 'Font Size', 'elemailer' ),
                'condition' => [
                    'email_item_details_Heading_size[size]!' => '24',
                ],
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size'  => 24
                ],
                'selectors' => [
                    '{{WRAPPER}} .elemailer-email-item-details h2' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'email_item_details_Heading_alignment',
            [
                'label'     => __( 'Alignment', 'elemailer' ),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
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
                'default'   => 'center',
                'toggle'    => true,
                'selectors' => [
                    '{{WRAPPER}} .elemailer-email-item-details h2' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'email_item_details_Heading_text_color',
            [
                'label'     => __( 'Text Color', 'elemailer' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elemailer-email-item-details h2' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'email_item_details_Heading_bg_color',
            [
                'label'     => __( 'Background Color', 'elemailer' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elemailer-email-item-details h2' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'email_item_details_Heading_padding',
            [
                'label'     => __( 'Padding', 'elemailer' ),
                'type'      => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .elemailer-email-item-details h2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'email_item_details_Heading_margin',
            [
                'label'         => __( 'Margin', 'elemailer' ),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', '%' ],
                'selectors'     => [
                    '{{WRAPPER}} .elemailer-email-item-details h2' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        /**
         * Table
         */
        $this->start_controls_section(
            'email_item_details_table',
            [
                'label' => __( 'Table', 'elemailer' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_control(
            'email_item_details_table_width',
            [
                'label' => __( 'Width', 'elemailer' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ '%' ],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elemailer-email-item-panel table' => 'width: {{SIZE}}%;',
                ],
            ]
        );

        $this->add_control(
            'email_item_details_table_bg_color',
            [
                'label'     => __( 'Background Color', 'elemailer' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elemailer-email-item-panel table' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'email_item_details_table_border',
                'label'     => __( 'Border', 'elemailer' ),
                'selector'  => '{{WRAPPER}} .elemailer-email-item-panel table',                
                'fields_options' => [
                    'border' => [
                        'default' => 'solid',
                    ],
                    'width' => [
                        'default' => [
                            'top'       => '1',
                            'right'     => '1',
                            'bottom'    => '1',
                            'left'      => '1',
                            'isLinked'  => true,
                        ],
                    ],
                    'color' => [
                        'default' => '#000',
                    ],
                ],
            ]
        );

        $this->add_control(
            'email_item_details_table_margin',
            [
                'label'         => __( 'Margin', 'elemailer' ),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', '%' ],
                'selectors'     => [
                    '{{WRAPPER}} .elemailer-email-item-panel table' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->end_controls_section();

        /**
         * Table Header
         */
        $this->start_controls_section(
            'email_item_details_table_header',
            [
                'label' => __( 'Table Header', 'elemailer' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'email_item_details_table_header_alignment',
            [
                'label'     => __( 'Alignment', 'elemailer' ),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
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
                'default'   => 'center',
                'toggle'    => true,
                'selectors' => [
                    '{{WRAPPER}} .elemailer-email-item-panel table thead th' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'email_item_details_table_header_color',
            [
                'label'     => __( 'Color', 'elemailer' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elemailer-email-item-panel table thead th' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'email_item_details_table_header_bg_color',
            [
                'label'     => __( 'Background Color', 'elemailer' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elemailer-email-item-panel table thead th' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'email_item_details_table_header_border',
                'label'     => __( 'Border', 'elemailer' ),
                'selector'  => '{{WRAPPER}} .elemailer-email-item-panel table thead th',
                'fields_options' => [
                    'border' => [
                        'default' => 'solid',
                    ],
                    'width' => [
                        'default' => [
                            'top'       => '1',
                            'right'     => '1',
                            'bottom'    => '1',
                            'left'      => '1',
                            'isLinked'  => true,
                        ],
                    ],
                    'color' => [
                        'default' => '#000',
                    ],
                ],
            ]
        );

        $this->add_control(
            'email_item_details_table_header_padding',
            [
                'label'         => __( 'Padding', 'elemailer' ),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', '%' ],
                'selectors'     => [
                    '{{WRAPPER}} .elemailer-email-item-panel table thead th' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->end_controls_section();

        /**
         * Table Body
         */
        $this->start_controls_section(
            'email_item_details_table_body',
            [
                'label' => __( 'Table Body', 'elemailer' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'email_item_details_table_body_alignment',
            [
                'label'     => __( 'Alignment', 'elemailer' ),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
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
                'default'   => 'center',
                'toggle'    => true,
                'selectors' => [
                    '{{WRAPPER}} .elemailer-email-item-panel table tbody td' => 'text-align: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_control(
            'email_item_details_table_body_color',
            [
                'label'     => __( 'Color', 'elemailer' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elemailer-email-item-panel table tbody td' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'email_item_details_table_body_bg_color',
            [
                'label'     => __( 'Background Color', 'elemailer' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elemailer-email-item-panel table tbody td' => 'background-color: {{VALUE}}',
                ],
                'default'  => 'transparent'
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'email_item_details_table_body_border',
                'label'     => __( 'Border', 'elemailer' ),
                'selector'  => '{{WRAPPER}} .elemailer-email-item-panel table tbody td',                
                'fields_options' => [
                    'border' => [
                        'default' => 'solid',
                    ],
                    'width' => [
                        'default' => [
                            'top'       => '1',
                            'right'     => '1',
                            'bottom'    => '1',
                            'left'      => '1',
                            'isLinked'  => true,
                        ],
                    ],
                    'color' => [
                        'default' => '#000',
                    ],
                ],
            ]
        );

        $this->add_control(
            'email_item_details_table_body_padding',
            [
                'label'         => __( 'Padding', 'elemailer' ),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', '%' ],
                'selectors'     => [
                    '{{WRAPPER}} .elemailer-email-item-panel table thead th' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->end_controls_section();

        /**
         * Table Footer
         */
        $this->start_controls_section(
            'email_item_details_table_footer',
            [
                'label' => __( 'Table Footer', 'elemailer' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'email_item_details_table_footer_heading',
            [
                'label'     => __( 'Heading', 'elemailer' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'email_item_details_table_footer_alignment',
            [
                'label'     => __( 'Alignment', 'elemailer' ),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
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
                'default'   => 'center',
                'toggle'    => true,
                'selectors' => [
                    '{{WRAPPER}} .elemailer-email-item-panel table tfoot tr th' => 'text-align: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_control(
            'email_item_details_table_footer_color',
            [
                'label'     => __( 'Color', 'elemailer' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elemailer-email-item-panel table tfoot tr th' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'email_item_details_table_footer_bg_color',
            [
                'label'     => __( 'Background Color', 'elemailer' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elemailer-email-item-panel table tfoot tr th' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'email_item_details_table_footer_body',
            [
                'label'     => __( 'Body', 'elemailer' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'email_item_details_table_footer_body_alignment',
            [
                'label'     => __( 'Alignment', 'elemailer' ),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
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
                'default'   => 'center',
                'toggle'    => true,
                'selectors' => [
                    '{{WRAPPER}} .elemailer-email-item-panel table tfoot tr td' => 'text-align: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_control(
            'email_item_details_table_footer_body_color',
            [
                'label'     => __( 'Color', 'elemailer' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elemailer-email-item-panel table tfoot tr td' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'email_item_details_table_footer_body_bg_color',
            [
                'label'     => __( 'Background Color', 'elemailer' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elemailer-email-item-panel table tfoot tr td' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'email_item_details_table_footer_border',
                'label'     => __( 'Border', 'elemailer' ),
                'selector'  => '{{WRAPPER}} .elemailer-email-item-panel table tfoot tr th, {{WRAPPER}} .elemailer-email-item-panel table tfoot tr td',
                'separator' => 'before',
                'fields_options' => [
                    'border' => [
                        'default' => 'solid',
                    ],
                    'width' => [
                        'default' => [
                            'top'       => '1',
                            'right'     => '1',
                            'bottom'    => '1',
                            'left'      => '1',
                            'isLinked'  => true,
                        ],
                    ],
                    'color' => [
                        'default' => '#000',
                    ],
                ],
            ]
        );

        $this->add_control(
            'email_item_details_table_footer_padding',
            [
                'label'         => __( 'Padding', 'elemailer' ),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', '%' ],
                'selectors'     => [
                    '{{WRAPPER}} .elemailer-email-item-panel table tfoot tr th,{{WRAPPER}} .elemailer-email-item-panel table tfoot tr td' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Render
     *
     * @since x.x.x
     */
    protected function render() {
        $settings    = $this->get_active_settings();
        $booking_ids = array();

        if ( elemailer_is_edit_mode() || elemailer_is_preview_mode() ) {
            $booking_ids = [ elemailer_get_random_booking_id() ];
            $booking     = get_wc_booking( elemailer_get_random_booking_id() );
            $order       = $booking->get_order();
        } else {
            $order_id    = get_transient( 'elemailer_wc_email_booking_order_id' );
            $booking_ids = elemailer_get_current_booking_ids( $order_id );
            $order       = wc_get_order( $order_id );
        }

        if ( ! is_a( $order, 'WC_Order' ) || empty( $booking_ids ) ) return;

        $sent_to_admin = false;
        $plain_text    = false;
        $email         = $order->get_billing_email();

        if ( $order ) {
            if ( version_compare( WC_VERSION, '3.0', '<' ) ) {
                $first_name = $order->billing_first_name;
                $last_name  = $order->billing_last_name;
            } else {
                $first_name = $order->get_billing_first_name();
                $last_name  = $order->get_billing_last_name();
            }
        }

        if ( isset( $settings['enable_hooks'] ) && 'yes' === $settings['enable_hooks'] ) {
            do_action( 'woocommerce_email_before_order_table', $order, $sent_to_admin, $plain_text, $email );
        }

         /* translators: 1: billing first and last name */
         $opening_paragraph = __( 'A new booking has been made by %s. The details of this booking are as follows:', 'elemailer' );
        ?>
        <div class="elemailer-email-item-details">
            <div class="elemailer-email-item-panel">
                <?php if ( ! empty( $first_name ) && ! empty( $last_name ) ) : ?>
                    <p><?php echo esc_html( sprintf( $opening_paragraph, $first_name . ' ' . $last_name ) ); ?></p>
                <?php endif; ?>   
                <?php foreach( $booking_ids as $booking_id ) : 
                    $booking = get_wc_booking( $booking_id );
                    ?>
                    <?php if ( $settings['show_title'] == 'yes' ): ?>
                    <h2>
                        <?php
                        if ( $sent_to_admin ) {
                            $before = '<a class="link" href="' . esc_url( $order->get_edit_order_url() ) . '">';
                            $after  = '</a>';
                        } else {
                            $before = '';
                            $after  = '';
                        }
                        /* translators: %s: Order ID. */
                            echo $before . sprintf( __( '[New Booking #%s]', 'elemailer' ) . $after . ' (<time datetime="%s">%s</time>)', $booking->get_id(), $order->get_date_created()->format( 'c' ), wc_format_datetime( $order->get_date_created() ) );
                        ?>
                    </h2>
                    <?php endif; ?>
                    <table cellspacing="0" cellpadding="6" style="width: 100%; border: 1px solid #eee;" border="1" bordercolor="#eee">
                        <tbody>
                            <tr>
                                <th scope="row" style="text-align:left; border: 1px solid #eee;"><?php esc_html_e( 'Booked Product', 'elemailer' ); ?></th>
                                <td style="text-align:left; border: 1px solid #eee;"><?php echo esc_html( $booking->get_product()->get_title() ); ?></td>
                            </tr>
                            <tr>
                                <th style="text-align:left; border: 1px solid #eee;" scope="row"><?php esc_html_e( 'Booking ID', 'elemailer' ); ?></th>
                                <td style="text-align:left; border: 1px solid #eee;"><?php echo esc_html( $booking->get_id() ); ?></td>
                            </tr>
                            <?php
                            $resource = $booking->get_resource();
                            $resource_label = $booking->get_product()->get_resource_label();

                            if ( $booking->has_resources() && $resource ) :
                                ?>
                                <tr>
                                    <th style="text-align:left; border: 1px solid #eee;" scope="row"><?php echo ( '' !== $resource_label ) ? esc_html( $resource_label ) : esc_html__( 'Booking Type', 'elemailer' ); ?></th>
                                    <td style="text-align:left; border: 1px solid #eee;"><?php echo esc_html( $resource->post_title ); ?></td>
                                </tr>
                            <?php endif; ?>
                            <tr>
                                <th style="text-align:left; border: 1px solid #eee;" scope="row"><?php esc_html_e( 'Booking Start Date', 'elemailer' ); ?></th>
                                <td style="text-align:left; border: 1px solid #eee;"><?php echo esc_html( $booking->get_start_date( null, null, wc_should_convert_timezone( $booking ) ) ); ?></td>
                            </tr>
                            <tr>
                                <th style="text-align:left; border: 1px solid #eee;" scope="row"><?php esc_html_e( 'Booking End Date', 'elemailer' ); ?></th>
                                <td style="text-align:left; border: 1px solid #eee;"><?php echo esc_html( $booking->get_end_date( null, null, wc_should_convert_timezone( $booking ) ) ); ?></td>
                            </tr>
                            <?php if ( wc_should_convert_timezone( $booking ) ) : ?>
                            <tr>
                                <th style="text-align:left; border: 1px solid #eee;" scope="row"><?php esc_html_e( 'Time Zone', 'elemailer' ); ?></th>
                                <td style="text-align:left; border: 1px solid #eee;"><?php echo esc_html( str_replace( '_', ' ', $booking->get_local_timezone() ) ); ?></td>
                            </tr>
                            <?php endif; ?>
                            <?php if ( $booking->has_persons() ) : ?>
                                <?php
                                foreach ( $booking->get_persons() as $id => $qty ) :
                                    if ( 0 === $qty ) {
                                        continue;
                                    }

                                    $person_type = ( 0 < $id ) ? get_the_title( $id ) : __( 'Person(s)', 'elemailer' );
                                    ?>
                                    <tr>
                                        <th style="text-align:left; border: 1px solid #eee;" scope="row"><?php echo esc_html( $person_type ); ?></th>
                                        <td style="text-align:left; border: 1px solid #eee;"><?php echo esc_html( $qty ); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                <?php endforeach; ?>
            </div>
        </div>
        <?php 
        if ( isset( $settings['enable_hooks'] ) && 'yes' === $settings['enable_hooks'] ) {
            do_action( 'woocommerce_email_after_order_table', $order, $sent_to_admin, $plain_text, $email );
        }
    }
}

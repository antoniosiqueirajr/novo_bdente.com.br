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
 * @since 1.0.8
 */
class Elemailer_Widget_WC_Item_Details extends Widget_Base {

    /**
     * Get name
     *
     * @since 1.0.8
     */
    public function get_name() {
        return 'elemailer-wc-item-details';
    }

    /**
     * Get title
     *
     * @since 1.0.8
     */
    public function get_title() {
        return esc_html__( 'WooCommerce Item Details', 'elemailer' );
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
        return [ 'void', 'template', 'footer' ];
    }

    /**
     * Register controls
     *
     * @since 1.0.8
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
                'label'     => __( 'Show Table Heading', 'elemailer' ),
                'type'      => Controls_Manager::SWITCHER,
                'label_on'  => __( 'Show', 'elemailer' ),
                'label_off' => __( 'Hide', 'elemailer' ),
                'return_value' => 'yes',
                'default'   => 'yes',
            ]
        );

        $this->end_controls_section();

        /**
         * Product image
         */
        $this->start_controls_section(
            'show_hide_product_image',
            [
                'label' => __( 'Product Image', 'elemailer' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'show_image',
            [
                'label'     => __( 'Show Product Image', 'elemailer' ),
                'type'      => Controls_Manager::SWITCHER,
                'label_on'  => __( 'Show', 'elemailer' ),
                'label_off' => __( 'Hide', 'elemailer' ),
                'return_value' => 'yes',
                'default'      => 'no',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Image_Size::get_type(),
            [
                'name' => 'wc_image', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'exclude' => [ 'custom' ],
                //'include' => [],
                'default' => 'thumbnail',
                'condition' => [
                    'show_image' => [ 'yes' ],
                ],

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
                'label' => __( 'Font Size (Deprecated)', 'elemailer' ),
                'condition' => [
                    'email_item_details_Heading_size[size]!' => '',
                ],
                'classes' => 'elementor-panel-alert elementor-panel-alert-danger',
                'description' => __('This option is Deprecated, Use Typography option BELOW since this will be removed in future. Please remove the value that you have set here and leave it blank','elemailer'),
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
                'selectors' => [
                    '{{WRAPPER}} .elemailer-email-item-details h2' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),

            [
                'name' => 'table_heading_ty',
                'global' => [
                    'active' => false,
                ],
                'selector' => '{{WRAPPER}} .elemailer-email-item-details h2',
                //'exclude' => ['font_family'],
                'fields_options' => [
                    '__all' => [
                        'responsive' => false,
                    ],
                    'font_family' => [
                        'selectors' => [
                            '{{WRAPPER}} .elemailer-email-item-details h2' => 'font-family: {{VALUE}}',
                        ],
                        'description' => __('These are Websafe fonts with fallback font-family in place. But for the other property below do check in your mail clinets if they work as CSS support is limited in Mail Clients', 'elemailer'),
                    ],
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
                'label' => __( 'Width %', 'elemailer' ),
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
                    '{{WRAPPER}} .elemailer-email-item-panel table' => 'width: {{SIZE}}%!important; margin:auto;',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),

            [
                'name' => 'table_main',
                'global' => [
                    'active' => false,
                ],
                'label' => 'Typography (Global)',
                'selector' => '{{WRAPPER}} .elemailer-email-item-panel table',
                //'exclude' => ['font_family'],
                'fields_options' => [
                    '__all' => [
                        'responsive' => false,
                    ],
                    'font_family' => [
                        'selectors' => [
                            '{{WRAPPER}} .elemailer-email-item-panel table' => 'font-family: {{VALUE}}',
                        ],
                        'description' => __('These are Websafe fonts with fallback font-family in place. But for the other property below do check in your mail clinets if they work as CSS support is limited in Mail Clients', 'elemailer'),
                    ],
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

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),

            [
                'name' => 'table_header_ty',
                'global' => [
                    'active' => false,
                ],
                'selector' => '{{WRAPPER}} .elemailer-email-item-panel table thead th',
                //'exclude' => ['font_family'],
                'fields_options' => [
                    '__all' => [
                        'responsive' => false,
                    ],
                    'font_family' => [
                        'selectors' => [
                            '{{WRAPPER}} .elemailer-email-item-panel table thead th' => 'font-family: {{VALUE}}',
                        ],
                        'description' => __('These are Websafe fonts with fallback font-family in place. But for the other property below do check in your mail clinets if they work as CSS support is limited in Mail Clients', 'elemailer'),
                    ],
                ],                                      

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
         * Table Body css
         */
        $this->start_controls_section(
            'email_item_details_table_body',
            [
                'label' => __( 'Table Body', 'elemailer' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),

            [
                'name' => 'table_body_ty',
                'global' => [
                    'active' => false,
                ],
                'selector' => '{{WRAPPER}} .elemailer-email-item-panel table tbody',
                //'exclude' => ['font_family'],
                'fields_options' => [
                    '__all' => [
                        'responsive' => false,
                    ],
                    'font_family' => [
                        'selectors' => [
                            '{{WRAPPER}} .elemailer-email-item-panel table tbody' => 'font-family: {{VALUE}}',
                        ],
                        'description' => __('These are Websafe fonts with fallback font-family in place. But for the other property below do check in your mail clinets if they work as CSS support is limited in Mail Clients', 'elemailer'),
                    ],
                ],                                      

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
                    '{{WRAPPER}} .elemailer-email-item-panel table tbody td:not(:first-child)' => 'text-align:{{VALUE}}!important;',
                ],
            ]
        );

        //@since 3.6
         $this->add_control(
            'elemailer_item_details_table_first_child',
            [
                'label'     => __( 'Image Column Alignment', 'elemailer' ),
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
                'default'   => 'left',
                'toggle'    => true,
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .elemailer-email-item-panel table tbody td:first-child' => 'text-align:{{VALUE}}!important;',
                ],
            ]
        );
        //@since 3.6 css image size controls
        $this->add_control(
            'elemailer_item_details_image_size',
            [
                'label' => esc_html__( 'Image Dimension', 'elemailer' ),
                'type' => \Elementor\Controls_Manager::IMAGE_DIMENSIONS,
                'description' => esc_html__( 'Image size px in CSS.', 'elemailer' ),
                'default' => [
                    'width' => '32',
                    'height' => '32',
                ],
                'selectors' => [
                    '{{WRAPPER}} .elemailer-email-item-panel table .order_item img' => 'height:{{height}}px;width:{{width}}px; max-width:100%; margin-right: 10px; vertical-align: middle;',
                ],
            ]
        );

        //@since 3.6
        $this->add_control(
            'elemailer_item_details_image_size_padding',
            [
                'label'         => __( 'Image Padding', 'elemailer' ),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', '%' ],
                'selectors'     => [
                    '{{WRAPPER}} .elemailer-email-item-panel table .order_item img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );       

        //@since 3.6
        $this->add_control(
            'elemailer_item_details_image_size_margin',
            [
                'label'         => __( 'Image margin', 'elemailer' ),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', '%' ],
                'selectors'     => [
                    '{{WRAPPER}} .elemailer-email-item-panel table .order_item img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'after',

            ]
        );

        //@since4.0.1

        $this->add_control(
            'email_i_d_table_img_bg',
            [
                'label'     => __( 'Image Background Color', 'elemailer' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elemailer-email-item-panel table .order_item td img' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        //@since 3.6
        $this->add_control(
            'em_item_details_1st_col_width',
            [
                'label' => esc_html__( '1st Column Width', 'elemailer' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'separator' => 'before',
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 500,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 10,
                        'max' => 90,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elemailer-email-item-panel table tbody td:first-child' => 'width: {{SIZE}}{{UNIT}};',

                ],
            ]
        );

        //@since 3.6
        $this->add_control(
            'em_item_details_2nd_col_width',
            [
                'label' => esc_html__( '2nd Column Width', 'elemailer' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 500,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 10,
                        'max' => 90,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elemailer-email-item-panel table tbody td:nth-child(2)' => 'width: {{SIZE}}{{UNIT}};',

                ],
            ]
        ); 

        //@since 3.6
        $this->add_control(
            'em_item_details_3rd_col_width',
            [
                'label' => esc_html__( '3rd Column Width', 'elemailer' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 500,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 10,
                        'max' => 90,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elemailer-email-item-panel table tbody td:nth-child(3)' => 'width: {{SIZE}}{{UNIT}};',

                ],
            ]
        );

        //@since 3.6
        $this->add_control(
            'em_item_details_4th_col_width',
            [
                'label' => esc_html__( '4th Column Width', 'elemailer' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'separator' => 'after',
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 500,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 10,
                        'max' => 90,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elemailer-email-item-panel table tbody td:nth-child(4)' => 'width: {{SIZE}}{{UNIT}};',

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
        //fixed @since 3.6
        $this->add_control(
            'email_item_details_table_body_padding',
            [
                'label'         => __( 'Padding', 'elemailer' ),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', '%' ],
                'selectors'     => [
                    '{{WRAPPER}} .elemailer-email-item-panel table tbody td' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

         //@since 3.6
        $this->add_control(
            'td_gaps',
            [
                'label' => esc_html__( 'Row Gap', 'elemailer' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .elemailer-email-item-panel table tbody tr:not(:first-child) td' => 'padding-top: {{SIZE}}{{UNIT}};',

                ],
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

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),

            [
                'name' => 'table_footer_h_ty',
                'global' => [
                    'active' => false,
                ],
                'selector' => '{{WRAPPER}} .elemailer-email-item-panel table tfoot tr th',
                //'exclude' => ['font_family'],
                'fields_options' => [
                    '__all' => [
                        'responsive' => false,
                    ],
                    'font_family' => [
                        'selectors' => [
                            '{{WRAPPER}} .elemailer-email-item-panel table tfoot tr th' => 'font-family: {{VALUE}}',
                        ],
                        'description' => __('These are Websafe fonts with fallback font-family in place. But for the other property below do check in your mail clinets if they work as CSS support is limited in Mail Clients', 'elemailer'),
                    ]
                ],                                      

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

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),

            [
                'name' => 'table_footer_b_ty',
                'global' => [
                    'active' => false,
                ],
                'selector' => '{{WRAPPER}} .elemailer-email-item-panel table tfoot tr td',
                //'exclude' => ['font_family'],
                'fields_options' => [
                    '__all' => [
                        'responsive' => false,
                    ],
                    'font_family' => [
                        'selectors' => [
                            '{{WRAPPER}} .elemailer-email-item-panel table tfoot tr td' => 'font-family: {{VALUE}}',
                        ],
                        'description' => __('These are Websafe fonts with fallback font-family in place. But for the other property below do check in your mail clinets if they work as CSS support is limited in Mail Clients', 'elemailer'),
                    ],
                ],                                      

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
     * @since 1.0.8
     */
    protected function render() {
        $settings = $this->get_active_settings();
        $order_id = elemailer_is_edit_mode() || elemailer_is_preview_mode() ? elemailer_get_random_order_id() : elemailer_get_current_order_id();
        $order    = wc_get_order( $order_id );

        if ( ! is_a( $order, 'WC_Order' ) ) return;

        $sent_to_admin = false;
        $plain_text    = false;
        $email         = $order->get_billing_email();
        $text_align    = is_rtl() ? 'right' : 'left';

        if ( isset( $settings['enable_hooks'] ) && 'yes' === $settings['enable_hooks'] ) {
            do_action( 'woocommerce_email_before_order_table', $order, $sent_to_admin, $plain_text, $email );
        }
        ?>
        <div class="elemailer-email-item-details">
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
                echo $before . sprintf( __( '[Order #%s]', 'elemailer' ) . $after . ' (<time datetime="%s">%s</time>)', $order->get_order_number(), $order->get_date_created()->format( 'c' ), wc_format_datetime( $order->get_date_created() ) );
                $show_image =  ( isset( $settings['show_image'] ) && 'yes' === $settings['show_image'] ) ? true : false;
                ?>
            </h2>
            <?php endif; ?>
            <div class="elemailer-email-item-panel">
                <table class="td" cellspacing="0" cellpadding="6" width="100%" border="1" style="width: 100%">    
                    <thead>
                        <tr>
                            <th class="td" scope="col"><?php esc_html_e( 'Product', 'woocommerce' ); ?></th>
                            <th class="td" scope="col"><?php esc_html_e( 'Quantity', 'woocommerce' ); ?></th>
                            <th class="td" scope="col"><?php esc_html_e( 'Price', 'woocommerce' ); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        
                        echo wc_get_email_order_items( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                            $order,
                            array(
                                'show_sku'      => $sent_to_admin,
                                'show_image'    => $show_image,
                                'image_size'    => $settings['wc_image_size'],
                                'plain_text'    => $plain_text,
                                'sent_to_admin' => $sent_to_admin,
                            )
                        );
                        ?>
                    </tbody>
                    <tfoot>
                        <?php
                        $item_totals = $order->get_order_item_totals();

                        if ( $item_totals ) {
                            $i = 0;
                            foreach ( $item_totals as $total ) {
                                $i++;
                                ?>
                                <tr>
                                    <th class="td" scope="row" colspan="2"><?php echo wp_kses_post( $total['label'] ); ?></th>
                                    <td class="td"><?php echo wp_kses_post( $total['value'] ); ?></td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                    </tfoot>
                </table>
            </div>
        </div>
        <?php 
        if ( isset( $settings['enable_hooks'] ) && 'yes' === $settings['enable_hooks'] ) {
            do_action( 'woocommerce_email_after_order_table', $order, $sent_to_admin, $plain_text, $email );
        }
    }
}

<?php

namespace Elemailer\Integrations\Elementor\Widgets;

defined('ABSPATH') || exit;

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Utils;

/**
 * heading widget class for registering heading widget
 *
 * @author elEmailer 
 * @since 1.0.0
 */
class Elemailer_Widget_Footer extends Widget_Base
{

	public function get_name()
	{
		return 'elemailer-footer';
	}

	public function get_title()
	{
		return esc_html__('Footer', 'elemailer');
	}

	public function get_icon()
	{
		return 'eicon-footer';
	}

	public function show_in_panel()
	{
		$post_type = get_post_type();
		return (in_array($post_type, ['em-form-template', 'em-emails-template']));
	}

	public function get_categories()
	{
		return array('elemailer-template-builder-fields');
	}

	public function get_keywords()
	{
		return ['void', 'template', 'footer'];
	}

	protected function register_controls()
	{
		$this->start_controls_section(
			'section_title',
			[
				'label' => __('Text', 'elemailer'),
			]
		);

		$this->add_control(
			'footer_address',
			[
				'label' => __('Address', 'elemailer'),
				'type' => Controls_Manager::TEXTAREA,
				'placeholder' => __('Enter your addrress', 'elemailer'),
				'default' => __('866 2nd Ave 2nd floor, New York, NY 10017, United States', 'elemailer'),
			]
		);

		$this->add_control(
			'text_align',
			[
				'label' => __('Alignment', 'elemailer'),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __('Left', 'elemailer'),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __('Center', 'elemailer'),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __('Right', 'elemailer'),
						'icon' => 'eicon-text-align-right',
					],

				],
				'default' => 'center',
			]
		);
 
		$this->end_controls_section();

		$this->start_controls_section(
			'section_subscription',
			[
				'label' => __('Subscription', 'elemailer'),
			]

		);

		$this->add_control(
			'important_note',
			[
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				'raw' => esc_html__( 'Please keep in mind this will only work on applicable places. For example this will not work in a Welcome email that is set with trigger for user registration or WooCommerce emails since it is not relevant.','elemailer' ),
				'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
			]
		);

		$this->add_control(
			'show_unsubscribe',
			[
				'label' => __( 'Show Unsubscribe', 'elemailer' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'elemailer' ),
				'label_off' => __( 'Hide', 'elemailer' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'unsbscribe_text',
			[
				'label' => __('Text', 'elemailer'),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => __('Text Here', 'elemailer'),
				'default' => __('Unsubscribe', 'elemailer'),
				'condition' => ['show_unsubscribe' => 'yes'],
			]
		); 
		$this->add_control(
			'hr_ust',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);
		$this->add_control(
			'show_manage_sbscription',
			[
				'label' => __( 'Show Manage Sbscription', 'elemailer' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'elemailer' ),
				'label_off' => __( 'Hide', 'elemailer' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'manage_sbscription_text',
			[
				'label' => __('Text', 'elemailer'),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => __('Text Here', 'elemailer'),
				'default' => __('Manage Subscription', 'elemailer'),
				'condition' => ['show_manage_sbscription' => 'yes'],
			]
		);
		$this->add_control(
			'hr_mst',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);
		
		$this->end_controls_section();



		$this->start_controls_section(
			'content_style_section',
			[
				'label' => esc_html__('Text Area', 'elemailer'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);



		$this->add_control(
			'ft_color',
			[
				'label' => __('Text Color', 'elemailer'),
				'type' => Controls_Manager::COLOR,
				'default' => '#000',
				'dynamic' => [
					'active' => false,
				],
				'global' => [
					'active' => false,
				],
			]
		);

		$this->add_control(
			'ft_font_size',
			[
				'label' => __('(Deprecated)Font Size (px)', 'elemailer'),
				'type' => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .ele-footer-text,{{WRAPPER}} .ele-footer-text p' => 'font-size: {{SIZE}}{{UNIT}}',
				],
				'condition' => [
					'ft_font_size[size]!' => '',
				],
				'classes' => 'elementor-panel-alert elementor-panel-alert-danger',
				'default' => [
					'unit' => 'px',
				],
				'size_units' => ['px'],
				'range' => [

					'px' => [
						'min' => 0,
						'max' => 100,
					],

				],
			]
		);

		// font options as per https://www.cssfontstack.com/
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'footer_typography',
				'global' => [
					'active' => false,
				],
				'selector' => '{{WRAPPER}} .ele-footer-text,{{WRAPPER}} .ele-footer-text p',
				'seperator'=> 'before',
				'fields_options' => [
					'__all' => [
						'responsive' => false,
					],
					'font_family' => [
						'selectors' => [
							'{{WRAPPER}} .ele-footer-text,{{WRAPPER}} .ele-footer-text p' => 'font-family: {{VALUE}}',
						],
						'description' => __('These are Websafe fonts with fallback font-family in place. But for the other property below do check in your mail clinets if they work as CSS support is limited in Mail Clients', 'elemailer'),
					],
		        ],
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'subscription_style_section',
			[
				'label' => esc_html__('Manage Subscription', 'elemailer'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'unsubscribe_color',
			[
				'label' => __('Color', 'elemailer'),
				'type' => Controls_Manager::COLOR,
				'default' => '#000',
				'selectors' => [
					'{{WRAPPER}} .ele-unsubscribe' => 'color: {{VALUE}}',
				],
				'dynamic' => [
					'active' => false,
				],
				'global' => [
					'active' => false,
				],
			]
		);

		$this->add_control(
			'unsubscribe_font_size',
			[
				'label' => __('(Deprecated)Font Size (px)', 'elemailer'),
				'condition' => [
					'unsubscribe_font_size[size]!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .ele-unsubscribe a' => 'font-size: {{SIZE}}{{UNIT}}',
				],
				'classes' => 'elementor-panel-alert elementor-panel-alert-danger',
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => 'px',
				],
				'size_units' => ['px'],
				'range' => [

					'px' => [
						'min' => 0,
						'max' => 100,
					],

				],
			]
		);

		// font options as per https://www.cssfontstack.com/
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'unsubscribe_typography',
				'global' => [
					'active' => false,
				],
				'selector' => '{{WRAPPER}} .ele-unsubscribe a,{{WRAPPER}} .ele-unsubscribe',
				'seperator'=> 'before',
				'fields_options' => [
					'__all' => [
						'responsive' => false,
					],
					'font_family' => [
						'selectors' => [
							'{{WRAPPER}} .ele-unsubscribe a' => 'font-family: {{VALUE}}',
						],
						'description' => __('These are Websafe fonts with fallback font-family in place. But for the other property below do check in your mail clinets if they work as CSS support is limited in Mail Clients', 'elemailer'),
					],
		        ],
			]
		);

		$this->end_controls_section();







		$this->start_controls_section(
			'advanced_section',
			[
				'label' => esc_html__('Advanced Style', 'elemailer'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'advance_margin',
			[
				'label' => __('Margin (px)', 'elemailer'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'default' => [
					'top' => '10',
					'right' => '10',
					'bottom' => '10',
					'left' => '10',
					'isLinked' => true,
				],
			]
		);

		$this->add_control(
			'advance_padding',
			[
				'label' => __('Padding (px)', 'elemailer'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
			]
		);

		$this->add_control(
			'advance_background_type',
			[
				'label' => __('Background Type', 'elemailer'),
				'type' => Controls_Manager::SELECT,
				'default' => 'color',
				'options' => [
					'color'  => __('Color', 'elemailer'),
					'image' => __('Image', 'elemailer'),
				],
			]
		);

		$this->add_control(
			'advance_background_color',
			[
				'label' => __('Background Color', 'elemailer'),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'advance_background_type' => 'color',
				],
				'dynamic' => [
					'active' => false,
				],
				'global' => [
					'active' => false,
				],
			]
		);

		$this->add_control(
			'advance_background_image',
			[
				'label' => __('Choose Image', 'elemailer'),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'advance_background_type' => 'image',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render($instance = [])
	{

		$settings = $this->get_settings_for_display();

		$footer_address  = $settings['footer_address'];
		$unsubscribe_text  = $settings['unsbscribe_text'];
		$manage_subscription_text  = $settings['manage_sbscription_text'];

		$show_unsubscribe  = $settings['show_unsubscribe']; 
		$show_manage_sbscription  = $settings['show_manage_sbscription'];

		$alignment = isset($settings['text_align']) ? $settings['text_align'] : 'center';

		$ft_text_styles = 'color: ' . (($settings['ft_color'] != '') ? $settings['ft_color'] : '#000') . ';';
		$ft_unsbscribe = 'color: ' . (($settings['unsubscribe_color'] != '') ? $settings['unsubscribe_color'] : '#000') . ';';
		$advance_style = 'background: ' . (($settings['advance_background_type'] == 'color') ? (($settings['advance_background_color'] != '') ? $settings['advance_background_color'] . ';' : '#0000;') : 'url("' . esc_url($settings['advance_background_image']['url']) . '") no-repeat fixed center;');
		$advance_style .= ' margin: ' . (($settings['advance_margin']['top'] != '') ? $settings['advance_margin']['top'] . 'px ' . $settings['advance_margin']['right'] . 'px ' . $settings['advance_margin']['bottom'] . 'px ' . $settings['advance_margin']['left'] . 'px;' : '0px 0px 0px 0px;');
		$advance_style .= ' padding: ' . (($settings['advance_padding']['top'] != '') ? $settings['advance_padding']['top'] . 'px ' . $settings['advance_padding']['right'] . 'px ' . $settings['advance_padding']['bottom'] . 'px ' . $settings['advance_padding']['left'] . 'px;' : '0px 0px 0px 0px;');

?>

		<div style="text-align: <?php echo esc_attr($alignment); ?>;<?php echo esc_attr($advance_style); ?>" class="ele-footer-widget">
			<div class="ele-footer-text">
				<p style="<?php echo esc_attr($ft_text_styles); ?>"><?php echo esc_html($footer_address); ?></p>
			</div>
			<div class="ele-unsubscribe">
				<a class="m-subscription" style="<?php echo esc_attr($ft_unsbscribe); ?>" href="#[ELEMAILER_UNSUBSCRIBE_LINK]"><?php echo esc_html($unsubscribe_text); ?></a> <?php if($show_unsubscribe == 'yes' && $show_manage_sbscription == 'yes') { echo ' || '; } ?><a class="un-subscription" style="<?php echo esc_attr($ft_unsbscribe); ?>" href="#[ELEMAILER_MANAGE_SUBSCRIPTION_LINK]"><?php echo esc_html($manage_subscription_text); ?></a>
			</div>
		</div>

<?php

	}
}

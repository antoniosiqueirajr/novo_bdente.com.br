<?php

namespace Elemailer\Integrations\Elementor\Widgets;

defined('ABSPATH') || exit;

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Utils;


/**
 * text editor widget class for registering text editor widget
 *
 * @author elEmailer 
 * @since 1.0.0
 */
class Elemailer_Widget_Text_Editor extends Widget_Base
{

	public function get_name()
	{
		return 'elemailer-text-editor';
	}

	public function get_title()
	{
		return esc_html__('Text Editor', 'elemailer');
	}

	public function get_icon()
	{
		return 'eicon-text';
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
		return ['void', 'template', 'text'];
	}

	protected function register_controls()
	{

		$this->start_controls_section(
			'content_section',
			[
				'label' => __('Content', 'elemailer'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'text_editor',
			[
				'label' => __('Text Editor', 'elemailer'),
				'type' => Controls_Manager::WYSIWYG,
				'default' => __('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'elemailer'),
				'label_block' => true,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'style_section',
			[
				'label' => esc_html__('Style', 'elemailer'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		// font options as per https://www.cssfontstack.com/
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 't_typography',
				'global' => [
					'active' => false,
				],
				'selector' => '{{WRAPPER}} .void-section-text, {{WRAPPER}} .void-section-text p',
				'seperator'=> 'before',
				'fields_options' => [
					'__all' => [
						'responsive' => false,
					],
					'font_family' => [
						'selectors' => [
							'{{WRAPPER}} .void-section-text, {{WRAPPER}} .void-section-text p' => 'font-family: {{VALUE}}',
						],
						'description' => __('This is applied to the wrapper and p tag. These are Websafe fonts with fallback font-family in place. But for the other property below do check in your mail clinets if they work as CSS support is limited in Mail Clients', 'elemailer'),
					],
		            // first mimic the click on Typography edit icon
		            // 'typography' => ['default' => 'yes'],
		            // // then redifine the Elementor defaults
		            // 'font_size' => [ 'default' => [ 'unit' => 'px', 'size' => 36 ] ],
		            // 'font_weight' => ['default' => 600],
		            // 'line_height' => ['default' => ['size' => 1]],
		        ],
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
				'default' => 'left',
				'toggle' => true,
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
		$text_editor = isset($settings['text_editor']) ? $settings['text_editor'] : '';
		$text_align = ($settings['text_align'] != '') ? $settings['text_align'] : 'left';

		$advance_style = 'background: ' . (($settings['advance_background_type'] == 'color') ? (($settings['advance_background_color'] != '') ? $settings['advance_background_color'] . ';' : '#0000;') : 'url("' . esc_url($settings['advance_background_image']['url']) . '") no-repeat fixed center;');
		$advance_style .= ' margin: ' . (($settings['advance_margin']['top'] != '') ? $settings['advance_margin']['top'] . 'px ' . $settings['advance_margin']['right'] . 'px ' . $settings['advance_margin']['bottom'] . 'px ' . $settings['advance_margin']['left'] . 'px;' : '0px 0px 0px 0px;');
		$advance_style .= ' padding: ' . (($settings['advance_padding']['top'] != '') ? $settings['advance_padding']['top'] . 'px ' . $settings['advance_padding']['right'] . 'px ' . $settings['advance_padding']['bottom'] . 'px ' . $settings['advance_padding']['left'] . 'px;' : '0px 0px 0px 0px;');

?>
		<div style="text-align: <?php echo esc_html($text_align); ?>; <?php echo esc_attr($advance_style); ?>" class="void-section-text">
			<?php echo sprintf('%s', do_shortcode($text_editor)); ?>
		</div>
<?php
	}
}

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
class Elemailer_Widget_Heading extends Widget_Base
{

	public function get_name()
	{
		return 'elemailer-heading';
	}

	public function get_title()
	{
		return esc_html__('Heading', 'elemailer');
	}

	public function get_icon()
	{
		return 'eicon-t-letter';
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
		return ['elemailer', 'template', 'heading'];
	}

	protected function register_controls()
	{
		$this->start_controls_section(
			'section_title',
			[
				'label' => __('Title', 'elemailer'),
			]
		);

		$this->add_control(
			'title',
			[
				'label' => __('Title', 'elemailer'),
				'type' => Controls_Manager::TEXTAREA,
				'placeholder' => __('Enter your title', 'elemailer'),
				'default' => __('Add Your Heading Text Here', 'elemailer'),
			]
		);

		$this->add_control(
			'link',
			[
				'label' => __('Link', 'elemailer'),
				'type' => Controls_Manager::URL,
				'options' => [
					'url',
					'is_external',
					'nofollow',
				],
				'default' => [
					'url' => 'https://elemailer.com',
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'align',
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
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_title_style',
			[
				'label' => __('Title Style', 'elemailer'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

	

		$this->add_control(
			'title_color',
			[
				'label' => __('Color', 'elemailer'),
				'type' => Controls_Manager::COLOR,
				'default' => '#6EC1E4',
				'dynamic' => [
					'active' => false,
				],
				'global' => [
					'active' => false,
				],
			]
		);

		$this->add_control(
			'heading_font_size',
			[					
				'selectors' => [
					'{{WRAPPER}} h2' => 'font-size: {{SIZE}}{{UNIT}}',
				],
				'condition' => [
					'heading_font_size[size]!' => '36',
				],
				'label' => __('(Deprecated)Font Size (px)', 'elemailer'),
				'description' => __('Please use the Typography control below as this will be remove in the future', 'elemailer'),
				'classes' => 'elementor-panel-alert elementor-panel-alert-danger',
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => 'px',
					'size' => '36',
				],
				'size_units' => ['px'],

				'range' => [

					'px' => [
						'min' => 1,
						'max' => 100,
					],

				],

			]
		);

		$this->add_control(
			'heading_line_height',
			[
				'selectors' => [
					'{{WRAPPER}} h2' => 'line-height: {{SIZE}}{{UNIT}}',
				],
				'seperator'=> 'after',
				'label' => __('(Deprecated)Line Height (px)', 'elemailer'),
				'description' => __('Please use the Typography control below as this will be remove in the future', 'elemailer'),
				'classes' => 'elementor-panel-alert elementor-panel-alert-danger',
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => 'px',
					'size' => '44',
				],
				'condition' => [
					'heading_line_height[size]!' => '44',
				],
				'size_units' => ['px'],
				'range' => [

					'px' => [
						'min' => 1,
						'max' => 150,
					],

				],

			]
		);

		// font options as per https://www.cssfontstack.com/
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'h_typography',
				'global' => [
					'active' => false,
				],
				'selector' => '{{WRAPPER}} h2',
				'seperator'=> 'before',
				'fields_options' => [
					'__all' => [
						'responsive' => false,
					],
					'font_family' => [
						'selectors' => [
							'{{WRAPPER}} h2' => 'font-family: {{VALUE}}',
						],
						'description' => __('These are Websafe fonts with fallback font-family in place. But for the other property below do check in your mail clinets if they work as CSS support is limited in Mail Clients', 'elemailer'),
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
		$target = $settings['link']['is_external'] ? ' target="_blank"' : '';
		$nofollow = $settings['link']['nofollow'] ? ' rel="nofollow"' : '';
		
		$title = $settings['title'];

		$heading_styles = 'display: block;margin: 0 auto;';
		$heading_styles .= 'text-align: ' . (($settings['align'] != '') ? $settings['align'] : '') . ';';
		$heading_styles .= 'color: ' . (($settings['title_color']) ? $settings['title_color'] : '#6EC1E4') . ';';

		$advance_style = 'background: ' . (($settings['advance_background_type'] == 'color') ? (($settings['advance_background_color'] != '') ? $settings['advance_background_color'] . ';' : '#0000;') : 'url("' . esc_url($settings['advance_background_image']['url']) . '") no-repeat fixed center;');
		$advance_style .= ' margin: ' . (($settings['advance_margin']['top'] != '') ? $settings['advance_margin']['top'] . 'px ' . $settings['advance_margin']['right'] . 'px ' . $settings['advance_margin']['bottom'] . 'px ' . $settings['advance_margin']['left'] . 'px;' : '0px 0px 0px 0px;');
		$advance_style .= ' padding: ' . (($settings['advance_padding']['top'] != '') ? $settings['advance_padding']['top'] . 'px ' . $settings['advance_padding']['right'] . 'px ' . $settings['advance_padding']['bottom'] . 'px ' . $settings['advance_padding']['left'] . 'px;' : '0px 0px 0px 0px;');

?>

		<div style="<?php echo esc_attr($advance_style); ?>" class="heading-wrapper">
			<?php
			if (!empty($settings['link']['url'])) { ?>
				<a href="<?php echo esc_attr(do_shortcode($settings['link']['url'])); ?>" <?php  echo $target . $nofollow ?> >
				<?php } ?>

				<h2 style="<?php echo esc_attr($heading_styles); ?>"><?php echo esc_html($title); ?></h2>
				
				<?php
				if (!empty($settings['link']['url'])) { ?>
				</a>
			<?php } ?>

		</div>

<?php

	}
}

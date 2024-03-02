<?php

namespace Elemailer\Integrations\Elementor\Widgets;

defined('ABSPATH') || exit;

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Utils;

/**
 * social widget class for registering social widget
 *
 * @author elEmailer 
 * @since 1.0.0
 */
class Elemailer_Widget_Social extends Widget_Base
{

	public function get_name()
	{
		return 'elemailer-social';
	}

	public function get_title()
	{
		return esc_html__('Social', 'elemailer');
	}

	public function get_icon()
	{
		return 'eicon-social-icons';
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
		return ['void', 'template', 'social', 'icon', 'link'];
	}

	protected function register_controls()
	{

		$this->start_controls_section(
			'void_email_section_icon',
			[
				'label' => __('Social', 'elemailer'),
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'select_social_media',
			[
				'label' => __('Select social media', 'elemailer'),
				'type' => Controls_Manager::SELECT2,
				'default' => 'facebook',
				'options' => [
					'facebook'  => __('Facebook', 'elemailer'),
					'twitter' => __('Twitter', 'elemailer'),
					'linkedin' => __('LinkedIn', 'elemailer'),
					'vimeo' => __('Vimeo', 'elemailer'),
					'youtube' => __('Youtube', 'elemailer'),
					'dribbble' => __('Dribbble', 'elemailer'),
					'flickr' => __('Flicker', 'elemailer'),
					'forwardtofriend' => __('Forward To Friend', 'elemailer'),
					'github' => __('Github', 'elemailer'),
					'houzz' => __('Houzz', 'elemailer'),
					'instagram' => __('Instagram', 'elemailer'),
					'link' => __('Website', 'elemailer'),
					'medium' => __('Medium', 'elemailer'),
					'pinterest' => __('Pinterest', 'elemailer'),
					'reddit' => __('Reddit', 'elemailer'),
					'rss' => __('RSS', 'elemailer'),
					'snapchat' => __('SnapChat', 'elemailer'),
					'soundcloud' => __('Soundcloud', 'elemailer'),
					'spotify' => __('Spotify', 'elemailer'),
					'tumblr' => __('Tumblr', 'elemailer'),
					'vine' => __('Vine', 'elemailer'),
					'vk' => __('VK', 'elemailer'),
				],
			]
		);

		$repeater->add_control(
			'social_link',
			[
				'label' => __('Link', 'elemailer'),
				'type' => Controls_Manager::URL,
				'placeholder' => __('https://your-link.com', 'elemailer'),
				'options' => [
					'url',
					'is_external',
					'nofollow',
				],
			]
		);

		$repeater->add_control(
			'social_name',
			[
				'label' => __('Social name', 'elemailer'),
				'type' => Controls_Manager::TEXT,
				'default' => __('Text', 'elemailer'),
				'placeholder' => __('Type your social media name here', 'elemailer'),
			]
		);

		$this->add_control(
			'socials_link',
			[
				'label' => __('Socials List', 'elemailer'),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'select_social_media' => __('facebook', 'elemailer'),
						'social_link' => [
							'url' => __('https://facebook.com', 'elemailer'),
						],
						'social_name' => __('Facebook', 'elemailer'),
					],
					[
						'select_social_media' => __('twitter', 'elemailer'),
						'social_link' => [
							'url' => __('https://twitter.com', 'elemailer'),
						],
						'social_name' => __('Twitter', 'elemailer'),
					],
					[
						'select_social_media' => __('linkedin', 'elemailer'),
						'social_link' => [
							'url' => __('https://linkedin.com', 'elemailer'),
						],
						'social_name' => __('LinkedIn', 'elemailer'),
					],
				],
				'title_field' => '{{{ select_social_media }}}',
			]
		);

		$this->add_control(
			'social_icon_style',
			[
				'label' => __('Icon style', 'elemailer'),
				'type' => Controls_Manager::SELECT,
				'default' => 'solid/color-',
				'options' => [
					'solid/color-'  => __('Solid Color', 'elemailer'),
					'solid/dark-'  => __('Solid Dark', 'elemailer'),
					'solid/light-'  => __('Solid Light', 'elemailer'),
					'outline/outline-color-' => __('OutLine Color', 'elemailer'),
					'outline/outline-dark-' => __('OutLine Dark', 'elemailer'),
					'outline/outline-light-' => __('OutLine Light', 'elemailer'),
				],
				'description' => __('Use background to see better output for "Solid Light" and "OutLine Light"', 'elemailer'),
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
			'style_section',
			[
				'label' => esc_html__('Icon', 'elemailer'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'size',
			[
				'label' => __('Size (px)', 'elemailer'),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => 'px',
					'size' => '48',
				],
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 6,
						'max' => 60,
					],
				],
			]
		);

		$this->add_control(
			'horizontal_space',
			[
				'label' => __('Horizontal Space (px)', 'elemailer'),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => 'px',
					'size' => '5',
				],
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 6,
						'max' => 100,
					],
				],

			]
		);

		$this->add_control(
			'vertical_space',
			[
				'label' => __('Vertical Space (px)', 'elemailer'),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => 'px',
					'size' => '5',
				],
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 6,
						'max' => 100,
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

		$socials = isset($settings['socials_link']) ? $settings['socials_link'] : '';
		$socials = is_array($socials) ? $socials : [];

		$alignment = isset($settings['text_align']) ? $settings['text_align'] : 'left';

		$image_width = (($settings['size']['size'] ? $settings['size']['size'] : '50') . ($settings['size']['unit'] ? $settings['size']['unit'] : 'px'));
		$icon_type = isset($settings['social_icon_style']) ? $settings['social_icon_style'] : 'solid/color-';

		$icons_styles = 'margin-left: ' . (($settings['horizontal_space']['size'] ? $settings['horizontal_space']['size'] : '5') . ($settings['horizontal_space']['unit'] ? $settings['horizontal_space']['unit'] : 'px')) . ';';
		$icons_styles .= 'margin-right: ' . (($settings['horizontal_space']['size'] ? $settings['horizontal_space']['size'] : '5') . ($settings['horizontal_space']['unit'] ? $settings['horizontal_space']['unit'] : 'px')) . ';';
		$icons_styles .= 'margin-bottom: ' . (($settings['vertical_space']['size'] ? $settings['vertical_space']['size'] : '5') . ($settings['vertical_space']['unit'] ? $settings['vertical_space']['unit'] : 'px')) . ';';
		$icons_styles .= 'margin-top: ' . (($settings['vertical_space']['size'] ? $settings['vertical_space']['size'] : '5') . ($settings['vertical_space']['unit'] ? $settings['vertical_space']['unit'] : 'px')) . ';';
		$icons_styles .= 'width: ' . $image_width . ';';
		$icons_styles .= 'max-width: 60px;display: inline-block;';

		$advance_style = 'background: ' . (($settings['advance_background_type'] == 'color') ? (($settings['advance_background_color'] != '') ? $settings['advance_background_color'] . ';' : '#0000;') : 'url("' . esc_url($settings['advance_background_image']['url']) . '") no-repeat fixed center;');
		$advance_style .= ' margin: ' . (($settings['advance_margin']['top'] != '') ? $settings['advance_margin']['top'] . 'px ' . $settings['advance_margin']['right'] . 'px ' . $settings['advance_margin']['bottom'] . 'px ' . $settings['advance_margin']['left'] . 'px;' : '0px 0px 0px 0px;');
		$advance_style .= ' padding: ' . (($settings['advance_padding']['top'] != '') ? $settings['advance_padding']['top'] . 'px ' . $settings['advance_padding']['right'] . 'px ' . $settings['advance_padding']['bottom'] . 'px ' . $settings['advance_padding']['left'] . 'px;' : '0px 0px 0px 0px;');

?>
		<div style="text-align:<?php echo esc_attr($alignment); ?>;overflow: hidden; display: block; line-height: 0px; <?php echo esc_attr($advance_style); ?>" class="void-email-icon-wrapper">
			<?php foreach ($socials as $key => $value) : ?>
				<a style="display: inline-block; overflow:hidden;" href="<?php echo esc_url(isset($value['social_link']['url']) ? $value['social_link']['url'] : ''); ?>">
					<?php $src = isset($value['select_social_media']) ? plugin_dir_url(__FILE__) . 'assets/social-icons/' . $icon_type . $value['select_social_media'] . '-48.png' : ''; ?>
					<img style="<?php echo esc_attr($icons_styles); ?>" src="<?php echo esc_url($src); ?>" alt="social icon">
				</a>
			<?php endforeach; ?>
		</div>

<?php
	}
}

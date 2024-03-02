<?php

namespace Elemailer\Integrations\Elementor\Widgets;

defined('ABSPATH') || exit;

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;

use \Elementor\Utils;


class Elemailer_Widget_Selected_Posts extends Widget_Base
{

	public function get_name()
	{
		return 'elemailer-selected-posts';
	}

	public function get_title()
	{
		return esc_html__('Selected Posts', 'elemailer');
	}

	public function get_icon()
	{
		return 'eicon-post-list';
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
		return ['void', 'template', 'posts', 'post', 'selected posts'];
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
			'post_type',
			[
				'label' => __('Post type', 'elemailer'),
				'type' => Controls_Manager::SELECT,
				'label_block' => true,
				'options' => \Elemailer\Helpers\Util::get_all_post_type(),
			]
		);

		$this->add_control(
			'taxonomy_type',
			[
				'label' => __('Select Taxonomy', 'elemailer'),
				'type' => Controls_Manager::SELECT,
				'label_block' => true,
				'options' => (object) array(),
				'condition' => [
					'post_type!' => '',

				],

			]
		);

		$this->add_control(
			'post_select',
			[
				'label' => __('Post select', 'elemailer'),
				'type' => Controls_Manager::SELECT2,
				'label_block' => true,
				'options' => '',
				'multiple' => true,
				'condition' => [
					'taxonomy_type!' => '',

				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'settings_section',
			[
				'label' => __('Settings', 'elemailer'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'posts_per_row',
			[
				'label' => esc_html__('Posts Per Row', 'elemailer'),
				'type' => Controls_Manager::SELECT,

				'options' => [
					'100' => '1',
					'49.25' => '2',
					'32.84' => '3',
				],
				'default' => '100',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'layout_section',
			[
				'label' => __('Layout', 'elemailer'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'show_thumbnail',
			[
				'label' => __('Display Thumbnail', 'elemailer'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __('Show', 'elemailer'),
				'label_off' => __('Hide', 'elemailer'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'image_position',
			[
				'label' => __('Image position', 'elemailer'),
				'type' => Controls_Manager::SELECT,
				'default' => 'left',
				'options' => [
					'top'  => __('Top', 'elemailer'),
					'left' => __('Left', 'elemailer'),
					'right' => __('Right', 'elemailer'),

				],
				'condition' => [
					'posts_per_row' => '100',
					'show_thumbnail' => 'yes',
				]
			]
		);

		$this->add_control(
			'image_size',
			[
				'label' => __('Image size', 'elemailer'),
				'type' => Controls_Manager::SELECT,
				'default' => 'medium',
				'options' => \Elemailer\Helpers\Util::get_all_image_sizes(),
				'condition' => [
					'show_thumbnail' => 'yes',
				],
			]
		);

		$this->add_control(
			'image_width',
			[
				'label' => __('Width(%)', 'elemailer'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'%' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 100,
				],

				'condition' => [
					'show_thumbnail' => 'yes',
				],
			]
		);

		$this->add_control(
			'hr',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);

		$this->add_control(
			'show_title',
			[
				'label' => __('Title', 'elemailer'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __('Show', 'elemailer'),
				'label_off' => __('Hide', 'elemailer'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'hr_2',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);

		$this->add_control(
			'show_excerpt',
			[
				'label' => __('Excerpt', 'elemailer'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __('Show', 'elemailer'),
				'label_off' => __('Hide', 'elemailer'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'excerpt_lenght',
			[
				'label' => __('Excerpt Length', 'elemailer'),
				'type' => Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 30,
				'step' => 1,
				'default' => 15,
				'condition' => [
					'show_excerpt' => 'yes',
				],
			]
		);

		$this->add_control(
			'hr_3',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);

		$this->add_control(
			'read_more',
			[
				'label' => __('Read More', 'elemailer'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __('Show', 'elemailer'),
				'label_off' => __('Hide', 'elemailer'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'read_more_text',
			[
				'label' => __('Read More Text', 'elemailer'),
				'type' => Controls_Manager::TEXT,
				'default' => __('Read More »', 'elemailer'),
				'placeholder' => __('Type your read more text here', 'elemailer'),
				'condition' => [
					'read_more' => 'yes',
				],
			]
		);

		$this->add_control(
			'hr_4',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);

		$this->add_control(
			'alignment',
			[
				'label' => __('Alignment', 'elemailer'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
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
			'title_section',
			[
				'label' => esc_html__('Title', 'elemailer'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __('Color', 'elemailer'),
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
			'title_font_size',
			[
				'label' => __('(Deprecated)Font Size (px)', 'elemailer'),
				'classes' => 'elementor-panel-alert elementor-panel-alert-danger',
				'condition' => [
                    'title_font_size[size]!' => '22',
                ],
                'selectors' 	=> [
					'{{WRAPPER}} .void-post-title' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => 'px',
					'size' => '22',
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

		$this->add_control(
			'title_font_line_height',
			[
				'label' => __('(Deprecated)Line Height (px)', 'elemailer'),
				'classes' => 'elementor-panel-alert elementor-panel-alert-danger',
				'condition' => [
                    'title_font_line_height[size]!' => '28',
                ],
                'selectors' 	=> [
					'{{WRAPPER}} .void-post-title' => 'line-height: {{SIZE}}{{UNIT}};',
				],
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => 'px',
					'size' => '28',
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
				'name' => 'title_typography',
				'global' => [
					'active' => false,
				],
				'selector' => '{{WRAPPER}} .void-post-title',
				'seperator'=> 'before',
				'fields_options' => [
					'__all' => [
						'responsive' => false,
					],
					'font_family' => [
						'selectors' => [
							'{{WRAPPER}} .void-post-title' => 'font-family: {{VALUE}}',
						],
						'description' => __('These are Websafe fonts with fallback font-family in place. But for the other property below do check in your mail clinets if they work as CSS support is limited in Mail Clients', 'elemailer'),
					],
		        ],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'excerpt_section',
			[
				'label' => esc_html__('Excerpt', 'elemailer'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'excerpt_color',
			[
				'label' => __('Color', 'elemailer'),
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
			'excerpt_font_size',
			[
				'label' => __('(Deprecated)Font Size (px)', 'elemailer'),
				'classes' => 'elementor-panel-alert elementor-panel-alert-danger',
				'condition' => [
                    'excerpt_font_size[size]!' => '14',
                ],
                'selectors' 	=> [
					'{{WRAPPER}} .void-post-excerpt' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => 'px',
					'size' => '14',
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

		$this->add_control(
			'excerpt_font_line_height',
			[
				'label' => __('(Deprecated)Line Height (px)', 'elemailer'),
				'classes' => 'elementor-panel-alert elementor-panel-alert-danger',
				'condition' => [
                    'excerpt_font_line_height[size]!' => '22',
                ],
                'selectors' 	=> [
					'{{WRAPPER}} .void-post-excerpt' => 'line-height: {{SIZE}}{{UNIT}};',
				],
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => 'px',
					'size' => '22',
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
				'name' => 'excr_typography',
				'global' => [
					'active' => false,
				],
				'selector' => '{{WRAPPER}} .void-post-excerpt',
				'seperator'=> 'before',
				'fields_options' => [
					'__all' => [
						'responsive' => false,
					],
					'font_family' => [
						'selectors' => [
							'{{WRAPPER}} .void-post-excerpt' => 'font-family: {{VALUE}}',
						],
						'description' => __('These are Websafe fonts with fallback font-family in place. But for the other property below do check in your mail clinets if they work as CSS support is limited in Mail Clients', 'elemailer'),
					],
		        ],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'read_more_section',
			[
				'label' => esc_html__('Read More', 'elemailer'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'read_more_color',
			[
				'label' => __('Color', 'elemailer'),
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
			'readmore_font_size',
			[
				'label' => __('(Deprecated)Font Size (px)', 'elemailer'),
				'classes' => 'elementor-panel-alert elementor-panel-alert-danger',
				'condition' => [
                    'readmore_font_size[size]!' => '14',
                ],
                'selectors' 	=> [
					'{{WRAPPER}} .void-post-read-more' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => 'px',
					'size' => '14',
				],

				'size_units' => ['px'],
				'range' => [

					'px' => [
						'min' => 0,
						'max' => 1000,
					],

				],

			]
		);

		// font options as per https://www.cssfontstack.com/
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'rem_typography',
				'global' => [
					'active' => false,
				],
				'selector' => '{{WRAPPER}} .void-post-read-more',
				'seperator'=> 'before',
				'fields_options' => [
					'__all' => [
						'responsive' => false,
					],
					'font_family' => [
						'selectors' => [
							'{{WRAPPER}} .void-post-read-more' => 'font-family: {{VALUE}}',
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
		$posts = is_array($settings['post_select']) ? $settings['post_select'] : [];
		$posts_per_row    = ($settings['posts_per_row'] != '') ? $settings['posts_per_row'] : '100';

		$show_thumbnail = ($settings['show_thumbnail'] != '') ? $settings['show_thumbnail'] : 'no';
		$image_position = ($settings['image_position'] != '') ? $settings['image_position'] : 'left';
		$image_width = ($settings['image_width']['size'] ? $settings['image_width']['size'] : '100');
		$image_size = ($settings['image_size'] != '') ? $settings['image_size'] : 'medium';

		$show_title = ($settings['show_title'] != '') ? $settings['show_title'] : 'no';
		$title_color = $settings['title_color'] ? $settings['title_color'] : '#000';

		$show_excerpt = ($settings['show_excerpt'] != '') ? $settings['show_excerpt'] : 'no';
		$excerpt_lenght = ($settings['excerpt_lenght'] != '') ? $settings['excerpt_lenght'] : '25';
		$excerpt_color = $settings['excerpt_color'] ? $settings['excerpt_color'] : '#000';

		$read_more = ($settings['read_more'] != '') ? $settings['read_more'] : 'no';
		$read_more_text = ($settings['read_more_text'] != '') ? $settings['read_more_text'] : 'Read More »';
		$readmore_color = $settings['read_more_color'] ? $settings['read_more_color'] : '#000';

		$alignment = ($settings['alignment'] != '') ? $settings['alignment'] : 'left';
		$image_position = (($posts_per_row != '100') ? 'top' : $image_position);

		$advance_style = 'background: ' . (($settings['advance_background_type'] == 'color') ? (($settings['advance_background_color'] != '') ? $settings['advance_background_color'] . ';' : '#0000;') : 'url("' . esc_url($settings['advance_background_image']['url']) . '") no-repeat fixed center;');
		$advance_style .= ' margin: ' . (($settings['advance_margin']['top'] != '') ? $settings['advance_margin']['top'] . 'px ' . $settings['advance_margin']['right'] . 'px ' . $settings['advance_margin']['bottom'] . 'px ' . $settings['advance_margin']['left'] . 'px;' : '0px 0px 0px 0px;');
		$advance_style .= ' padding: ' . (($settings['advance_padding']['top'] != '') ? $settings['advance_padding']['top'] . 'px ' . $settings['advance_padding']['right'] . 'px ' . $settings['advance_padding']['bottom'] . 'px ' . $settings['advance_padding']['left'] . 'px;' : '0px 0px 0px 0px;');

		$text_content_width = (100 - ((int)$image_width));

		$post_content_top_margin = (($show_thumbnail == 'yes') && ($image_position == 'top')) ? 'margin-left: 0px;margin-right:0px;' : '';

		$post_column = 'width: ' . $posts_per_row . '%;vertical-align: top;margin-bottom: 30px;';
		$post_column .= ($posts_per_row == '100') ? 'display: block;' : 'display: inline-block;';

		$post_section_styles = (($show_thumbnail == 'yes') && ($image_position == 'top')) ? 'display: block;' : '';

		$title_styles  = 'color: ' . $title_color . ';';
		$title_styles .= 'display: block;margin:10px 15px;';
		$title_styles .= $post_content_top_margin;

		$excerpt_styles = 'margin:10px 15px;';
		$excerpt_styles .= 'color: ' . $excerpt_color . ';';
		$excerpt_styles .= $post_content_top_margin;

		$read_more_styles = 'margin:10px 15px;text-decoration:none;';
		$read_more_styles .= 'color: ' . $readmore_color . ';';
		$read_more_styles .= 'display: block;';
		$read_more_styles .= $post_content_top_margin;

?>

		<div class="void-post-row">
			<div style="text-align: <?php echo esc_attr($alignment); ?>;<?php echo esc_attr($advance_style); ?>" class="void-email-posts">

				<?php foreach ($posts as $post) : ?>
					<?php
					$img_url = get_the_post_thumbnail_url($post, $image_size);

					$post_section_styles = ($img_url ? $post_section_styles : '');
					?>
					<div style="<?php echo esc_attr($post_column); ?>" class="void-post-col">

						<div style="text-align: <?php echo esc_attr($alignment); ?>;<?php echo esc_attr($post_section_styles); ?>" class="void-section-posts">
							<?php

							if (($img_url && $show_thumbnail == 'yes') && ($image_position == 'top' || $image_position == 'left')) {

								$image_styles = 'display:inline-block;';

								if($image_position == 'left'){
									$image_styles .= 'width:'.((int)$image_width - 1).'%;max-width:50%;';
								}

								if($image_position == 'top'){
									$image_styles .= 'width:'.$image_width.'%;max-width:100%;';
								}								

							?>
								<div style="text-align:<?php echo esc_attr($alignment); ?>;<?php echo esc_attr($image_styles); ?>" class="elemailer-template-thumbnail">
									<img style="width: 100%;" class="<?php echo esc_attr($image_position); ?>" src="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr(get_the_title($post)); ?>">
								</div>
							<?php

							}

							$post_content_css_postiion = '';
							if (($img_url && $show_thumbnail == 'yes') && ($image_position == 'left' || $image_position == 'right')) {
								$post_content_css_postiion = 'width:'.$text_content_width.'%;display:inline-block;vertical-align: top;padding:0px;min-width:48%;';
							}
							?>

							<div style="<?php echo esc_attr($post_content_css_postiion); ?>text-align: <?php echo esc_attr($alignment); ?>;" class="void-email-template-post-content">

								<?php if ($show_title == 'yes') : ?>
									<a style="text-decoration: none;" target="_blank" href="<?php echo esc_attr(get_the_permalink($post)); ?>">
										<h3 class="void-post-title" style="<?php echo esc_attr($title_styles); ?>"><?php echo esc_html(get_the_title($post)); ?></h3>
									</a>
								<?php endif; ?>

								<?php if ($show_excerpt == 'yes') : ?>
									<p style="<?php echo esc_attr($excerpt_styles); ?>" class="void-post-excerpt"><?php echo esc_html(wp_trim_words(get_the_content('No content', true, $post), $excerpt_lenght, ' .....')); ?></p>
								<?php endif; ?>

								<?php if ($read_more == 'yes') : ?>

									<div class="void-read-more-btn">
										<a style="<?php echo esc_attr($read_more_styles); ?>" href="<?php echo esc_attr(get_the_permalink($post)); ?>" class="void-post-read-more"><?php echo esc_html($read_more_text); ?></a>
									</div>
								<?php endif; ?>
							</div>

							<?php
							if (($img_url && $show_thumbnail == 'yes') && ($image_position == 'right')) :
								$image_styles_right = 'display:inline-block;width:'.($image_width - 1).'%;max-width:50%;';
							?>

								<div style="text-align: <?php echo esc_attr($alignment); ?>;<?php echo esc_attr($image_styles_right); ?>" class="elemailer-template-thumbnail">

									<img style="width: 100%;" class="<?php echo esc_attr($image_position); ?>" src="<?php echo esc_attr($img_url); ?>" alt="<?php echo esc_attr(get_the_title($post)); ?>">

								</div>
							<?php endif; ?>
						</div>
					</div>

				<?php endforeach; ?>
			</div>
		</div>
<?php
	}
}

<?php

namespace Elemailer\Integrations\Elementor\Widgets;

defined('ABSPATH') || exit;

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Utils;

use \Elemailer\Helpers\Util;

/**
 * button widget class for registering button widget
 *
 * @author elEmailer 
 * @since 1.0.0
 */
class Elemailer_Widget_Button extends Widget_Base
{
	public function get_name()
	{
		return 'elemailer-button';
	}

	public function get_title()
	{
		return esc_html__('Button', 'elemailer');
	}

	public function get_icon()
	{
		return 'eicon-button';
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
		return ['void', 'template', 'button'];
	}

	protected function register_controls()
	{

		$this->start_controls_section(
			'section_button',
			[
				'label' => __('Button', 'elemailer'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'text',
			[
				'label' => __('Text', 'elemailer'),
				'type' => Controls_Manager::TEXT,
				'default' => __('Click here', 'elemailer'),
				'placeholder' => __('Click here', 'elemailer'),
			]
		);

		$this->add_control(
			'link',
			[
				'label' => __('Link', 'elemailer'),
				'type' => Controls_Manager::URL,
				'description' => __('You must put a valid link with protocol ( http/http/wwww) as otherwise in your email the button will simply be empty in some mail clients. You can also use shortcode that will output a link'),
				'placeholder' => __('https://your-link.com', 'elemailer'),
				'options' => [
					'url',
					'is_external',
					'nofollow',
				],
				'default' => [
					'url' => 'https://elemailer.com',
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
					'justify' => [
						'title' => __('Justified', 'elemailer'),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'default' => 'left',
				'toggle' => true,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'style_button',
			[
				'label' => __('Button Style', 'elemailer'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'button_padding',
			[
				'label' => __('Padding (px)', 'elemailer'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'default' => [
					'unit' => 'px',
					'isLinked' => false,
					'top' => '12',
					'right' => '25',
					'bottom' => '12',
					'left' => '25',
				]
			]
		);

		$this->add_control(
			'border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'elemailer' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'separator' => 'after',
				'selectors' => [
					'{{WRAPPER}} a,{{WRAPPER}} span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'important_note',
			[
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				'raw' => esc_html__( 'Note: Outlook ( specially older windows outlook app ) has issue with button rendering and with few controls for this widget. The below contol tries to solve some of them but it may not work as you expect it to in the end though. In our tests we found things working fine without these controls in newer versions of the app.', 'elemailer' ),
				'content_classes' => 'elementor-control-field-description',
				'separator' => 'before',

			]
		);

		$this->add_control(
			'o_height',
			[
				'label' => esc_html__( 'Outlook Height(px)', 'elemailer' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 5,
				'max' => 300,
				'step' => 5,
				'default' => 50,
			]
		);

		$this->add_control(
			'o_width',
			[
				'label' => esc_html__( 'Outlook Width(px)', 'elemailer' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 5,
				'max' => 600,
				'step' => 5,
				'default' => 300,
			]
		);
		
		$this->add_control(
			'o_border_radious',
			[
				'label' => esc_html__( 'Outlook border/Arc radius(%)', 'elemailer' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'description' => __('End of outlook controls. Outlook controls will not reflect anything in preview. You need to check in your outlook client (mainly windows outlook app) itself to see how it looks if you want.', 'elemailer'),
				'min' => 0,
				'max' => 200,
				'step' => 5,
				'default' => 300,
			]
		);

		$this->add_control(
			'hr',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);


		$this->add_control(
			'font_size',
			[
				'label' => __('(Deprecated)Font Size (px)', 'elemailer'),
				'selectors' => [
					'{{WRAPPER}} a,{{WRAPPER}} span' => 'font-size: {{SIZE}}{{UNIT}}',
				],
				'separator' => 'before',
				'description' => __('Please use the Typography control below as this will be remove in the future', 'elemailer'),
				'classes' => 'elementor-panel-alert elementor-panel-alert-danger',
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => 'px',
					'size' => '16',
				],
				'size_units' => ['px'],
				'condition' => [
					'font_size[size]!' => '16',
				],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 100,
					],

				],
			]
		);

		// font options as per https://www.cssfontstack.com/
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'b_typography',
				'global' => [
					'active' => false,
				],
				'selector' => '{{WRAPPER}} a,{{WRAPPER}} span',
				'seperator'=> 'default',
				'fields_options' => [
					'__all' => [
						'responsive' => false,
					],
					'font_family' => [
						'selectors' => [
							'{{WRAPPER}} a,{{WRAPPER}} span' => 'font-family: {{VALUE}}',
						],
						'description' => __('These are Websafe fonts with fallback font-family in place. But for the other property below do check in your mail clinets if they work as CSS support is limited in Mail Clients', 'elemailer'),
					],	
		        ],
			]
		);

		$this->add_control(
			'hr2',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

		$this->start_controls_tabs( 'tabs_button_style' );

			$this->start_controls_tab(
				'tab_button_normal',
				[
					'label' => esc_html__( 'Normal', 'elementor' ),
				]
			);

				$this->add_control(
					'color',
					[
						'label' => __('Color', 'elemailer'),
						'type' => Controls_Manager::COLOR,
						'default' => '#fff',
						'dynamic' => [
							'active' => false,
						],
						'global' => [
							'active' => false,
						],

					]
				);

				$this->add_control(
					'bg_color',
					[
						'label' => __('Background', 'elemailer'),
						'type' => Controls_Manager::COLOR,
						'default' => '#61CE70',
						'dynamic' => [
							'active' => false,
						],
						'global' => [
							'active' => false,
						],

					]
				);

			$this->end_controls_tab();

			$this->start_controls_tab(
				'tab_button_hover',
				[
					'label' => esc_html__( 'Hover', 'elementor' ),
				]
			);

				$this->add_control(
					'color_h',
					[
						'label' => __('Color', 'elemailer'),
						'type' => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} a:hover,{{WRAPPER}} span:hover' => 'color: {{VALUE}}!important',
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
					'bg_color_h',
					[
						'label' => __('Background', 'elemailer'),
						'type' => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} a:hover,{{WRAPPER}} span:hover' => 'background: {{VALUE}}!important',
						],
						'dynamic' => [
							'active' => false,
						],
						'global' => [
							'active' => false,
						],

					]
				);

			$this->end_controls_tab();
		
		$this->end_controls_tab();

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
		$email_button_url = isset($settings['link']['url']) ? $settings['link']['url'] : '';
		$open_in_new_tab= (!empty( $settings['link']['is_external']) ) ? 'target="_blank"':'';
		$nofollow= (!empty( $settings['link']['nofollow']) ) ? ' rel="nofollow"' : '';
		
		$email_button_url = do_shortcode($email_button_url);
		$email_button_text = ($settings['text'] != '') ? $settings['text'] : '';
		$alignment = ($settings['text_align'] != '') ? $settings['text_align'] : 'left';
		$has_link=false;
		//$has_link = ((strpos($email_button_url, 'https://') !== false) ? true : ((strpos($email_button_url, 'http://') !== false) ? true : false));
		//forcing has_link check because sometimes there are dymacin content. 
		if(!empty($email_button_url) && $email_button_url !='#' ) {
			$has_link=true;
		}

		$button_styles = 'display:inline-block;-webkit-text-size-adjust:none;';
		$button_styles .= 'color:' . (($settings['color'] != '') ? $settings['color'] : '#fff') . ';';
		$button_styles .= 'background-color:' . (($settings['bg_color'] != '') ? $settings['bg_color'] : '#6EC1E4') . ';';
		$button_styles .= 'padding:' . (($settings['button_padding']['top'] != '') ? $settings['button_padding']['top'] . 'px ' . $settings['button_padding']['right'] . 'px ' . $settings['button_padding']['bottom'] . 'px ' . $settings['button_padding']['left'] . 'px;' : '12px 25px 12px 25px;');
		$button_styles .= (($alignment == 'justify') ? 'width: 100%; text-align: center;padding-left:0px;padding-right:0px;' : '');

		$advance_style = 'background: ' . (($settings['advance_background_type'] == 'color') ? (($settings['advance_background_color'] != '') ? $settings['advance_background_color'] . ';' : '#0000;') : 'url("' . esc_url($settings['advance_background_image']['url']) . '") no-repeat fixed center;');
		$advance_style .= ' margin: ' . (($settings['advance_margin']['top'] != '') ? $settings['advance_margin']['top'] . 'px ' . $settings['advance_margin']['right'] . 'px ' . $settings['advance_margin']['bottom'] . 'px ' . $settings['advance_margin']['left'] . 'px;' : '0px 0px 0px 0px;');
		$advance_style .= ' padding: ' . (($settings['advance_padding']['top'] != '') ? $settings['advance_padding']['top'] . 'px ' . $settings['advance_padding']['right'] . 'px ' . $settings['advance_padding']['bottom'] . 'px ' . $settings['advance_padding']['left'] . 'px;' : '0px 0px 0px 0px;');

?>

		<div class="email-template-button-wrapper" style="text-align: <?php echo esc_attr($alignment); ?>; <?php echo esc_attr($advance_style); ?>">
			<?php
			/**
			 * anchor tag replaced by span for avoiding design break in mail client.
			 * mail client remove anchor tag with blank href.
			 */

			echo '<!--[if mso]>
					  <v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" rel="noopener" '.$open_in_new_tab.' href="' . $email_button_url . '" style="height:'.$settings['o_height'].'px;v-text-anchor:middle;width:'.$settings['o_width'].'px;" arcsize="'.$settings['o_border_radious'].'%" stroke="f" fillcolor="'.(($settings['bg_color'] != '') ? $settings['bg_color'] : '#6EC1E4').'">
						<w:anchorlock/>
						<center>
					<![endif]-->';
			$button_markup_start = $has_link ? '<a '.$open_in_new_tab. $nofollow.' style="' . esc_attr($button_styles) . '" href="' . $email_button_url . '" class="void-email-deafult-btn">' : '<span style="' . esc_attr($button_styles) . ';">';
			$button_markup_end = $has_link ? '</a>' : '</span>';

			echo Util::kses($button_markup_start);
			echo esc_html($email_button_text);
			echo Util::kses($button_markup_end);

			echo '<!--[if mso]>
					</center>
					</v:roundrect>
				<![endif]-->';

			?>
		</div>

<?php
	}
}

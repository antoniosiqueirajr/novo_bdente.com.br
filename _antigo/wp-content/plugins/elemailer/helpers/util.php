<?php

namespace Elemailer\Helpers;

defined('ABSPATH') || exit;

use \Elemailer\App\Settings\Action as Settings_Action;

require_once __DIR__ . '/vendor/autoload.php';

use TijsVerkoyen\CssToInlineStyles\CssToInlineStyles;

/**
 * Global helper class
 * used to make some verious type method
 * 
 * @author elEmailer
 * @since 1.0.0
 */
class Util
{

	/**
	 * Get void template builder older version if has any.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public static function old_version()
	{
		$info = get_option('elemailer_info');
		$version = isset($info['version']) ? $info['version'] : '';
		return '' == $version ? -1 : $version;
	}

	/**
	 * custom wp_kses function with parameters for escaping easily
	 *
	 * @param [string] $raw
	 * @return void
	 * @since 1.0.0
	 */
	public static function kses($raw)
	{

		$allowed_tags = array(
			'a'								 => array(
				'class'	 => array(),
				'href'	 => array(),
				'rel'	 => array(),
				'title'	 => array(),
				'target' => array(),
				'style'  => array(),
			),
			'abbr'							 => array(
				'title' => array(),
				'style' => array(),
			),
			'b'								 => array(),
			'blockquote'					 => array(
				'cite'  => array(),
				'style' => array(),
			),
			'cite'							 => array(
				'title' => array(),
				'style' => array(),
			),
			'code'							 => array(),
			'del'							 => array(
				'datetime'	 => array(),
				'title'		 => array(),
				'style' 	 => array(),
			),
			'dd'							 => array(),
			'div'							 => array(
				'class'	 => array(),
				'title'	 => array(),
				'style'	 => array(),
			),
			'dl'							 => array(),
			'dt'							 => array(),
			'em'							 => array(),
			'h1'							 => array(
				'class' => array(),
				'style' => array(),
			),
			'h2'							 => array(
				'class' => array(),
				'style' => array(),
			),
			'h3'							 => array(
				'class' => array(),
				'style' => array(),
			),
			'h4'							 => array(
				'class' => array(),
				'style' => array(),
			),
			'h5'							 => array(
				'class' => array(),
				'style' => array(),
			),
			'h6'							 => array(
				'class' => array(),
				'style' => array(),
			),
			'i'								 => array(
				'class' => array(),
				'style' => array(),
			),
			'img'							 => array(
				'alt'	 => array(),
				'class'	 => array(),
				'height' => array(),
				'src'	 => array(),
				'width'	 => array(),
				'style'  => array(),
			),
			'li'							 => array(
				'class' => array(),
				'style' => array(),
			),
			'ol'							 => array(
				'class' => array(),
				'style' => array(),
			),
			'p'								 => array(
				'class' => array(),
				'style' => array(),
			),
			'q'								 => array(
				'cite'	 => array(),
				'title'	 => array(),
				'style'	 => array(),
			),
			'span'							 => array(
				'class'	 => array(),
				'title'	 => array(),
				'style'	 => array(),
			),
			'iframe'						 => array(
				'width'			 => array(),
				'height'		 => array(),
				'scrolling'		 => array(),
				'frameborder'	 => array(),
				'allow'			 => array(),
				'src'			 => array(),
				'style' 		 => array(),
			),
			'strike'						 => array(),
			'br'							 => array(),
			'strong'						 => array(),
			'data-wow-duration'				 => array(),
			'data-wow-delay'				 => array(),
			'data-wallpaper-options'		 => array(),
			'data-stellar-background-ratio'	 => array(),
			'ul'							 => array(
				'class' => array(),
				'style' => array(),
			),
		);

		// add whitelist css property 'display' in wp_kses function
		add_filter('safe_style_css', function ($styles) {
			$styles[] = 'display';
			return $styles;
		});

		if (function_exists('wp_kses')) { // WP is here
			return wp_kses($raw, $allowed_tags);
		} else {
			return $raw;
		}
	}

	/**
	 * get client ip function
	 *
	 * @return string[ip]
	 * @since 1.0.0
	 */
	public static function get_client_ip()
	{
		$server_ip_keys = [
			'HTTP_CLIENT_IP',
			'HTTP_X_FORWARDED_FOR',
			'HTTP_X_FORWARDED',
			'HTTP_X_CLUSTER_CLIENT_IP',
			'HTTP_FORWARDED_FOR',
			'HTTP_FORWARDED',
			'REMOTE_ADDR',
		];

		foreach ($server_ip_keys as $key) {
			if (isset($_SERVER[$key]) && filter_var($_SERVER[$key], FILTER_VALIDATE_IP)) {
				return $_SERVER[$key];
			}
		}

		// Fallback local ip.
		return '127.0.0.1';
	}

	/**
	 * render elementor content by using content id function
	 *
	 * @param int[id] $content_id
	 * @param boolean $style
	 *
	 * @return string
	 * @since 1.0.0
	 */
	public static function render_elementor_content($content_id, $style = false)
	{
		$elementor_instance = \Elementor\Plugin::instance();
		return $elementor_instance->frontend->get_builder_content_for_display($content_id, $style);
	}

	/**
	 * dynamically add url param function
	 * mainly used to overcome permalink structure
	 *
	 * @param string[url] $url
	 * @param string[key] $key
	 * @param string[value] $value
	 * @return void
	 * @since 1.0.0
	 */
	public static function add_param_url($url, $key, $value)
	{

		$url = preg_replace('/(.*)(?|&)' . $key . '=[^&]+?(&)(.*)/i', '$1$2$4', $url . '&');
		$url = substr($url, 0, -1);

		if (strpos($url, '?') === false) {
			return ($url . '?' . $key . '=' . $value);
		} else {
			return ($url . '&' . $key . '=' . $value);
		}
	}

	/**
	 * get all post type
	 * includes wp raw post types and all cpt
	 * used for selecting post type in post widgets
	 *
	 * @return void
	 * @since 1.0.0
	 */
	public static function get_all_post_type()
	{
		$args = array(
			'public'	=> 'true',
		);
		$post_types = get_post_types($args, 'objects');
		$return_types = [];

		foreach ($post_types  as $post_type) {
			//remove unnecessary post types
			if ($post_type->name == 'elementor_library' || $post_type->name == 'attachment') {
				continue;
			}
			// set readable name and slug
			$return_types[$post_type->name] = $post_type->labels->singular_name;
		}
		return $return_types;
	}

	/**
	 * get all image size function 
	 * used for selecting image size in post widgets
	 *
	 * @return void
	 * @since 1.0.0
	 */
	public static function get_all_image_sizes()
	{
		$sizes = [];

		$all_image_sizes = wp_get_registered_image_subsizes();

		foreach ($all_image_sizes as $key => $value) {
			$sizes[$key] = ucwords(str_replace('_', ' ', $key)) . ' - ' . $value['width'] . ' x ' . $value['height'];
		}

		$sizes['full'] = 'Full';

		return $sizes;
	}

	/**
	 * minify css function, write to a file after minified
	 * used for minifying css for sending it to the mail client
	 *
	 * @param string[path] $read_file_path
	 * @param string[path] $write_file_path
	 * @return void
	 * @since 1.0.0
	 */
	public static function minify_css($read_file_path, $write_file_path)
	{
		$source = file_get_contents($read_file_path);
		$css = '<style>';
		$css .= str_replace('; ', ';', str_replace(' }', '}', str_replace('{ ', '{', str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), "", preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $source)))));
		$destination = file_put_contents($write_file_path, $css);
	}

	/**
	 * process email template's dynamic style for sending into email function
	 *
	 * @param integer[number] $template_id
	 *
	 * @return string[css] <style>'.$css.'</style>
	 * @since 1.0.0
	 */
	public static function get_template_styles($template_id)
	{
		$raw_string = self::render_elementor_content($template_id, true);

		$split = preg_split("/<\/style>/", $raw_string);

		$css = (isset($split[0]) ? $split[0] : '');
		/**
		 * remove starting style tag '<style>' to merge this style with other style
		 * replace '.elementor-element.' with '.' for overcome prefixing issue with outlook
		 * replace '}}' with '}' for avoiding extra closing bracket of media query.
		 */
		$css = str_replace(['<style>', '.elementor-element.', '}}'], ['', '.', '}'], $css);

		// remove media query for supporting this style to mail client outlook, yandex
		$css = preg_replace('/@media( )*\((max|min)-width:( )*[0-9]*px\)( )*(and( )*\((max|min)-width:( )*[0-9]*px\)( )*)?{/', '', $css);

		return $css . '</style>';
	}

	/**
	 * process email template into html for sending as email function
	 *
	 * @param integer[number] $template_id
	 *
	 * @return string[html] $data_html
	 * @since 1.0.0
	 */
	public static function get_template_content($template_id)
	{

		$raw_string = self::render_elementor_content($template_id, true);

		$split = preg_split("/<\/style>/", $raw_string);

		$raw_body = str_replace((isset($split[0]) ? $split[0] : '') . '</style>', '', $raw_string);

		return ltrim($raw_body);
	}

	/**
	 * build html email template function after rendering shortcode data from form submission
	 *
	 * @param integer[number] $template_id
	 * @param string[html] $email_content
	 * @return string[html] $data_html
	 * @since 1.0.0
	 * elemailer-send-template class was used to make sure we can force css with it as needed specially body css controls. we may consider removing it in future if we find no usecase since now we added body class as well
	 */
	public static function get_email_html_template($template_id, $email_content, $tracking_token = null)
	{
		$email_content = str_replace(['<section', '</section>', 'elemailer_table'], ['<div', '</div>', 'table'], $email_content);
		$email_content= \Elemailer\Integrations\Elementor\Widgets\Base::elemailer_internal_smart_tag_parser('', $email_content, false );

		ob_start();
?>

		<!doctype html>
		<html>

		<head>
			<meta name="viewport" content="width=device-width" />
			<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
			<?php include ELE_MAILER_PLUGIN_DIR . 'app/form-template/view/default-elementor-style.php'; ?>
			<?php echo self::get_template_styles($template_id); ?>
		</head>
		
		<body class="elementor-page-<?php echo $template_id; ?> elemailer-send-template">  
		<!--[if mso]>
			<center>
				 <table class="outlook-special" width="100%">
				 	<tr>
				 		<td align="center" style="padding:0px;margin:0px;" width="600">

				 			<table class="el-con-started" width="100%" style="border:0; border-collapse:collapse; border-spacing:0; max-width:600px;">
				 				<tr>
				 					<td style="padding:0px;margin:0px;>
		<![endif]-->

			<?php echo $email_content; ?>
			<?php
			if($tracking_token != null){
				$rest_url = rest_url('elemailer/v1/emails/track_mail/ol');
				$rest_url = self::add_param_url($rest_url, 'track', $tracking_token.'.gif');
				echo '<img style="display: none;" width="0" height="0" src="'.$rest_url.'" alt="tracking-token">';
			}
			?>

		<!--[if mso]>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</center>
		<![endif]--> 

		</body>

		</html>

	<?php
		$data_html = ob_get_contents();
		ob_end_clean();

		$cssToInlineStyles = new CssToInlineStyles();

		// output
		$output = $cssToInlineStyles->convert( $data_html );

		return $output;
	}

	/**
	 * double opt in confirmation email html template build function
	 *
	 * @param string[url] $end_point
	 * @return string[html]
	 * @since 1.0.0
	 * @since 4.0- we removed elementor-page- echo $template_id; since this is not using elemailer template at the moment and was causing php warning. 
	 */

	
	public static function get_confirmation_email_template($end_point)
	{
		$global_settings = Settings_Action::instance()->get_global_settings();
		$email_content = (isset($global_settings['opt_in_mail_content']) ? $global_settings['opt_in_mail_content'] : '');
		$email_content = str_replace(['[activation_link]', '[/activation_link]', "\n"], ['<a href="' . $end_point . '">', '</a>', "<br>"], $email_content);
		ob_start();
	?>

		<!doctype html>
		<html>

		<head>
			<meta name="viewport" content="width=device-width" />
			<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		</head>

		<body class="elemailer-send-template">
			<?php echo $email_content; ?>
		</body>

		</html>

<?php
		$data_html = ob_get_contents();
		ob_end_clean();

		$cssToInlineStyles = new CssToInlineStyles();

		// output
		$output = $cssToInlineStyles->convert( $data_html );

		return $output;
	}
}

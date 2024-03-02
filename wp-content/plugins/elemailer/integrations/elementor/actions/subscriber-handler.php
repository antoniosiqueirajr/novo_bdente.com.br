<?php

namespace Elemailer\Integrations\Elementor\Actions;

defined('ABSPATH') || exit;

use \Elemailer\App\Lists\Action as Lists_Action;
use \Elementor\Controls_Manager;
use \ElementorPro\Modules\Forms\Classes\Action_Base;
use \ElementorPro\Modules\Forms\Classes\Ajax_Handler;

use \Elemailer\App\Subscribers\Action as Subscribers_Action;
use \Elemailer\App\Settings\Action as Settings_Action;
use \Elemailer\Lib\Database\DB;

/**
 * Class Subscriber handler
 * Custom elementor form action after submit to add a subsciber to
 * add subscribers to the list from elementor form submission
 */
class Subscriber_Handler extends Action_Base
{
	/**
	 * Get Name
	 *
	 * Return the action name
	 *
	 * @access public
	 * @return string
	 */
	public function get_name()
	{
		return 'elemailer-subscribers';
	}

	/**
	 * Get Label
	 *
	 * Returns the action label
	 *
	 * @access public
	 * @return string
	 */
	public function get_label()
	{
		return __('Elemailer Subscribers', 'elemailer');
	}

	/**
	 * Run
	 *
	 * Runs the action after submit
	 *
	 * @access public
	 * @param \ElementorPro\Modules\Forms\Classes\Form_Record $record
	 * @param \ElementorPro\Modules\Forms\Classes\Ajax_Handler $ajax_handler
	 */
	public function run($record, $ajax_handler)
	{
		$settings = $record->get('form_settings');

		//  Make sure that there is a Subscriber_Handler list ID
		if (empty($settings['elemailer_subscribers_list'])) {
			return;
		}

		// Make sure that there is a Subscriber_Handler Email field ID
		// which is required by Subscriber_Handler API to subsribe a user
		if (empty($settings['elemailer_email_field'])) {
			return;
		}

		// Get sumitetd Form data
		$raw_fields = $record->get('fields');

		// Normalize the Form Data
		$fields = [];
		foreach ($raw_fields as $id => $field) {
			$fields[$id] = $field['value'];
		}

		// Make sure that the user emtered an email
		// which is required by Subscriber_Handler API to subsribe a user
		if (empty($fields[$settings['elemailer_email_field']])) {
			return;
		}

		$global_settings = Settings_Action::instance()->get_global_settings();

		$elemailer_data = [
			'first-name' => !empty($fields[$settings['elemailer_first_name']]) ? $fields[$settings['elemailer_first_name']] : '',
			'last-name' => !empty($fields[$settings['elemailer_last_name']]) ? $fields[$settings['elemailer_last_name']] : '',
			'email' => ($fields[$settings['elemailer_email_field']] != '') ? $fields[$settings['elemailer_email_field']] : '',
			'status' => (isset($global_settings['enable_mail_opt_in']) && ($global_settings['enable_mail_opt_in'] == 'yes')) ? 'unconfirmed' : 'subscribed',
			'subscribed_ip' => \ElementorPro\Core\Utils::get_client_ip(),
			'link_token' => md5(($fields[$settings['elemailer_email_field']] != '') ? $fields[$settings['elemailer_email_field']] : ''),
			'source' => 'form',
			'list_id' => (isset($settings['elemailer_subscribers_list'])) ? $settings['elemailer_subscribers_list'] : [],
		];

		$response = Subscribers_Action::instance()->store(0, $elemailer_data, 'elemailer-3rd-party');
		$ajax_handler->add_response_data('elemailer_response', $response);

	}

	/**
	 * Register Settings Section
	 *
	 * Registers the Action controls
	 *
	 * @access public
	 * @param \Elementor\Widget_Base $widget
	 */
	public function register_settings_section($widget)
	{
		$widget->start_controls_section(
			'section_elemailer_subscribers',
			[
				'label' => __('Elemailer Subscribers', 'elemailer'),
				'condition' => [
					'submit_actions' => $this->get_name(),
				],
			]
		);

		$widget->add_control(
			'elemailer_subscribers_list',
			[
				'label' => __('Subscriber List', 'elemailer'),
				'type' => Controls_Manager::SELECT2,
				'multiple' => true,
				'label_block' => true,
				'options' => Lists_Action::instance()->format_lists_for_option(),
			]
		);

		$widget->add_control(
			'elemailer_email_field',
			[
				'label' => __('Email Field ID', 'elemailer'),
				'type' => Controls_Manager::TEXT,
				'placeholder' => 'email',
			]
		);

		$widget->add_control(
			'elemailer_first_name',
			[
				'label' => __('First Name Field ID', 'elemailer'),
				'type' => Controls_Manager::TEXT,
				'placeholder' => 'fname',

			]
		);

		$widget->add_control(
			'elemailer_last_name',
			[
				'label' => __('Last Name Field ID', 'elemailer'),
				'type' => Controls_Manager::TEXT,
				'placeholder' => 'lname',

			]
		);

		$widget->add_control(
			'elemailer_s_help',
			[
				
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				'raw' => __( '<a target="_blank" href="https://elemailer.com/help/add-subscriber-through-elementor-pro-form-widget/">Need help?</a>', 'elemailer' ),
				'content_classes' => 'your-class',
			]
		);


		$widget->end_controls_section();
	}

	/**
	 * On Export
	 *
	 * Clears form settings on export
	 * @access Public
	 * @param array $element
	 */
	public function on_export($element)
	{
		unset($element['elemailer_first_name'],
		$element['elemailer_last_name'],
		$element['elemailer_email_field'],
		$element['elemailer_subscribers_list']);
	}
}

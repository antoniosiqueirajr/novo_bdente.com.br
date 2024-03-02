<?php

namespace Elemailer\Lib\Database;

defined('ABSPATH') || exit;

/**
 * table creation on database class for initialization
 * 
 * @author elEmailer
 * @since 1.0.0
 */
class Create_table
{

	use \Elemailer\Traits\Singleton;

	/**
	 * initialization for creating table on database function
	 *
	 * @return void
	 * @since 1.0.0
	 */
	public function init()
	{
		global $elemailer_db_version;
		$elemailer_db_version = '1.0.0';
		$this->create_subscribers_table();
		$this->create_lists_table();
		$this->create_subscribers_lists_table();
		$this->create_scheduler_tasks_table();
		$this->create_tracking_table();
	}

	/**
	 * create subscriber table function
	 *
	 * @return void
	 * @since 1.0.0
	 */
	public function create_subscribers_table()
	{
		global $wpdb;
		global $elemailer_db_version;
		$posts = $wpdb->prefix . 'posts';
		$table_name = $wpdb->prefix . 'elemailer_subscribers';
		$engine_query = $wpdb->get_var("SELECT ENGINE FROM information_schema.TABLES WHERE TABLE_SCHEMA = '$wpdb->dbname' AND TABLE_NAME = '$posts'");
		$charset_collate = $wpdb->get_charset_collate();

		$sql = "CREATE TABLE IF NOT EXISTS $table_name (
						`id` bigint NOT NULL AUTO_INCREMENT PRIMARY KEY,
						`wp_user_id` bigint NULL,
						`is_woocommerce_user` int NOT NULL,
						`first_name` varchar(255) NULL,
						`last_name` varchar(255) NULL,
						`email` varchar(150) NOT NULL,
						`status` varchar(12) NOT NULL,
						`subscribed_ip` varchar(45) NULL,
						`confirmed_ip` varchar(45) NULL,
						`confirmed_at` timestamp NULL,
						`source` enum('cf7','form','imported','administrator', 'wordpress_user', 'woocommerce_user', 'woocommerce_checkout', 'unknown') NOT NULL,
						`link_token` char(32) NULL,
						`created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
						`updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
					) ENGINE= $engine_query $charset_collate;";

		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta($sql);

		add_option('elemailer_db_version', $elemailer_db_version);
	}

	/**
	 * create lists table function
	 *
	 * @return void
	 * @since 1.0.0
	 */
	public function create_lists_table()
	{
		global $wpdb;
		global $elemailer_db_version;
		$posts = $wpdb->prefix . 'posts';
		$table_name = $wpdb->prefix . 'elemailer_lists';
		$engine_query = $wpdb->get_var("SELECT ENGINE FROM information_schema.TABLES WHERE TABLE_SCHEMA = '$wpdb->dbname' AND TABLE_NAME = '$posts'");
		$charset_collate = $wpdb->get_charset_collate();

		$sql = "CREATE TABLE IF NOT EXISTS $table_name (
						`id` bigint NOT NULL AUTO_INCREMENT PRIMARY KEY,
						`name` varchar(255) NOT NULL,
						`type` varchar(90) NOT NULL,
						`description` varchar(255) NULL,
						`status` char(10) NOT NULL DEFAULT 'published',
						`created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
						`updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
					) ENGINE= $engine_query $charset_collate;";

		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta($sql);

		add_option('elemailer_db_version', $elemailer_db_version);
	}

	/**
	 * create subscribers and lists relation table function
	 *
	 * @return void
	 * @since 1.0.0
	 */
	public function create_subscribers_lists_table()
	{
		global $wpdb;
		global $elemailer_db_version;

		$table_name = $wpdb->prefix . 'elemailer_subscribers_lists';
		$posts = $wpdb->prefix . 'posts';
		$subscribers = $wpdb->prefix . 'elemailer_subscribers';
		$lists = $wpdb->prefix . 'elemailer_lists';
		$engine_query = $wpdb->get_var("SELECT ENGINE FROM information_schema.TABLES WHERE TABLE_SCHEMA = '$wpdb->dbname' AND TABLE_NAME = '$posts'");
		$charset_collate = $wpdb->get_charset_collate();

		$sql = "CREATE TABLE IF NOT EXISTS $table_name (
						`id` bigint NOT NULL AUTO_INCREMENT PRIMARY KEY,
						`subscriber_id` bigint NOT NULL,
						FOREIGN KEY (`subscriber_id`) REFERENCES `{$subscribers}` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
						`list_id` bigint NOT NULL,
						FOREIGN KEY (`list_id`) REFERENCES `{$lists}` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
						`status` char(15) NOT NULL DEFAULT 'subscribed',
						`created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
						`updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
					) ENGINE= $engine_query $charset_collate;";

		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta($sql);

		add_option('elemailer_db_version', $elemailer_db_version);
	}

	/**
	 * create schedule information store table function
	 *
	 * @return void
	 * @since 1.0.0
	 */
	public function create_scheduler_tasks_table()
	{
		global $wpdb;
		global $elemailer_db_version;

		$table_name = $wpdb->prefix . 'elemailer_scheduler_tasks';

		$posts = $wpdb->prefix . 'posts';
		$engine_query = $wpdb->get_var("SELECT ENGINE FROM information_schema.TABLES WHERE TABLE_SCHEMA = '$wpdb->dbname' AND TABLE_NAME = '$posts'");
		$charset_collate = $wpdb->get_charset_collate();

		$sql = "CREATE TABLE IF NOT EXISTS $table_name (
						`id` bigint NOT NULL AUTO_INCREMENT PRIMARY KEY,
						`post_id` bigint(20) unsigned NOT NULL,
						FOREIGN KEY (`post_id`) REFERENCES `{$posts}` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
						`post_term` char(50) NOT NULL,
						`status` char(15) NOT NULL DEFAULT 'assign',
						`created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
						`updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
					) ENGINE= $engine_query $charset_collate;";

		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta($sql);

		add_option('elemailer_db_version', $elemailer_db_version);
	}

	/**
	 * create email tracking info table function
	 *
	 * @return void
	 * @since 1.0.0
	 */
	public function create_tracking_table()
	{
		global $wpdb;
		global $elemailer_db_version;
		
		$table_name = $wpdb->prefix . 'elemailer_tracking_mail';

		$subscribers = $wpdb->prefix . 'elemailer_subscribers';
		$lists = $wpdb->prefix . 'elemailer_lists';
		$posts = $wpdb->prefix . 'posts';
		$engine_query = $wpdb->get_var("SELECT ENGINE FROM information_schema.TABLES WHERE TABLE_SCHEMA = '$wpdb->dbname' AND TABLE_NAME = '$posts'");
		$charset_collate = $wpdb->get_charset_collate();

		$sql = "CREATE TABLE IF NOT EXISTS $table_name (
						`id` bigint NOT NULL AUTO_INCREMENT PRIMARY KEY,
						`subscriber_id` bigint NOT NULL,
						FOREIGN KEY (`subscriber_id`) REFERENCES `{$subscribers}` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
						`post_id` bigint(20) unsigned NOT NULL,
						FOREIGN KEY (`post_id`) REFERENCES `{$posts}` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
						-- `list_id` bigint NOT NULL,
						-- FOREIGN KEY (`list_id`) REFERENCES `{$lists}` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
						`subscriber_type` char(20) NULL DEFAULT 'subscriber',
						`mail_sent` int NULL DEFAULT 0,
						`mail_open` int NULL DEFAULT 0,
						`mail_click` int NULL DEFAULT 0,
						`token` char(32) NOT NULL,
						`created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
						`updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
					) ENGINE= $engine_query $charset_collate";

		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta($sql);

		add_option('elemailer_db_version', $elemailer_db_version);
	}
}

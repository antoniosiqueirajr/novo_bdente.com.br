<?php

namespace Elemailer\App\Emails;

defined('ABSPATH') || exit;

/**
 * Custom post type register class
 * register post type for email template
 *
 * @author elEmailer 
 * @since 1.0.0
 */
class Cpt extends \Elemailer\Core\Cpt
{
    /**
     * get post type function
     *
     * @return string
     * @since 1.0.0
     */
    public function post_type()
    {
        return 'em-emails-template';
    }

    /**
     * templete settings fields get function
     * used for sanitizing templete settings during create/ update template
     *
     * @return array
     * @since 1.0.0
     */
    public function get_template_settings_fields()
    {

        return [

            'template_name' => [
                'name' => 'template_name',
            ],
            'template_subject' => [
                'name' => 'template_subject',
            ],
            'elemailer_category' => [
                'name' => 'elemailer_category',
            ],
            'sender_name' => [
                'name' => 'sender_name',
            ],
            'sender_email' => [
                'name' => 'sender_email',
            ],
            'reply_to_name' => [
                'name' => 'reply_to_name',
            ],
            'reply_to_email' => [
                'name' => 'reply_to_email',
            ],
            'list_id' => [
                'name' => 'list_id',
            ],
            'schedule_it' => [
                'name' => 'schedule_it',
            ],
            'ele_statistics' => [
                'name' => 'ele_statistics',
            ],
            'nl_start_date' => [
                'name' => 'nl_start_date',
            ],
            'nl_start_time' => [
                'name' => 'nl_start_time',
            ],
            'wm_event_of_send' => [
                'name' => 'wm_event_of_send',
            ],
            'wm_user_type' => [
                'name' => 'wm_user_type',
            ],
            'pn_start_date' => [
                'name' => 'pn_start_date',
            ],
            'pn_start_time' => [
                'name' => 'pn_start_time',
            ],
            'pn_frequency' => [
                'name' => 'pn_frequency',
            ],
            'email_status' => [
                'name' => 'email_status',
            ],
            'elemailer_wc_email_type' => [
                'name' => 'elemailer_wc_email_type',
            ],
            'elemailer_wc_email_where_apply' => [
                'name' => 'elemailer_wc_email_where_apply',
            ],
            'elemailer_wc_product' => [
                'name' => 'elemailer_wc_product',
            ],
            'elemailer_wc_category' => [
                'name' => 'elemailer_wc_category',
            ],
        ];
    }

    /**
     * configure post type function
     *
     * @return array $args
     * @since 1.0.0
     */
    public function post_args()
    {
        $labels = array(
            'name'                  => esc_html_x('Emails', 'Post Type General Name', 'elemailer'),
            'singular_name'         => esc_html_x('Email', 'Post Type Singular Name', 'elemailer'),
            'menu_name'             => esc_html__('Email', 'elemailer'),
            'name_admin_bar'        => esc_html__('Email', 'elemailer'),
            'archives'              => esc_html__('Email Archives', 'elemailer'),
            'attributes'            => esc_html__('Email Attributes', 'elemailer'),
            'parent_item_colon'     => esc_html__('Parent Item:', 'elemailer'),
            'all_items'             => esc_html__('Emails', 'elemailer'),
            'add_new_item'          => esc_html__('Add New Email', 'elemailer'),
            'add_new'               => esc_html__('Add New', 'elemailer'),
            'new_item'              => esc_html__('New Email', 'elemailer'),
            'edit_item'             => esc_html__('Edit Email', 'elemailer'),
            'update_item'           => esc_html__('Update Email', 'elemailer'),
            'view_item'             => esc_html__('View Email', 'elemailer'),
            'view_items'            => esc_html__('View Emails', 'elemailer'),
            'search_items'          => esc_html__('Search Emails', 'elemailer'),
            'not_found'             => esc_html__('Not found', 'elemailer'),
            'not_found_in_trash'    => esc_html__('Not found in Trash', 'elemailer'),
            'featured_image'        => esc_html__('Featured Image', 'elemailer'),
            'set_featured_image'    => esc_html__('Set featured image', 'elemailer'),
            'remove_featured_image' => esc_html__('Remove featured image', 'elemailer'),
            'use_featured_image'    => esc_html__('Use as featured image', 'elemailer'),
            'insert_into_item'      => esc_html__('Insert into form', 'elemailer'),
            'uploaded_to_this_item' => esc_html__('Uploaded to this form', 'elemailer'),
            'items_list'            => esc_html__('Emails list', 'elemailer'),
            'items_list_navigation' => esc_html__('Emails list navigation', 'elemailer'),
            'filter_items_list'     => esc_html__('Filter froms list', 'elemailer'),
        );
        $rewrite = array(
            'slug'                  => 'em-emails-template',
            'with_front'            => true,
            'pages'                 => false,
            'feeds'                 => false,
        );
        $args = array(
            'label'                 => esc_html__('Emails', 'elemailer'),
            'description'           => esc_html__('elemailer emails create', 'elemailer'),
            'labels'                => $labels,
            'supports'              => array('title', 'elementor', 'permalink'),
            'hierarchical'          => true,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => false,
            'menu_icon'             => 'dashicons-email-alt',
            'menu_position'         => 5,
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => false,
            'can_export'            => true,
            'has_archive'           => false,
            'publicly_queryable'    => true,
            'rewrite'               => $rewrite,
            'query_var'             => true,
            'exclude_from_search'   => true,
            'publicly_queryable'    => true,
            'capability_type'       => 'page',
            'show_in_rest'          => false,
            'rest_base'             => $this->post_type(),
        );

        return $args;
    }

    /**
     * register post type function
     * flush rewrites after regsiter cpt function
     *
     * @return void
     * @since 1.0.0
     */
    public function flush_rewrites()
    {
        $name = $this->post_type();
        $args = $this->post_args();
        register_post_type($name, $args);
        flush_rewrite_rules();
    }
}

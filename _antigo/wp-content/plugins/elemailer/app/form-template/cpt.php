<?php

namespace Elemailer\App\Form_Template;

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
     */
    public function post_type()
    {
        return 'em-form-template';
    }

    /**
     * templete settings fields get function
     * used for sanitizing templete settings during create/ update template
     *
     * @return void
     * @since 1.0.0
     */
    public function get_template_settings_fields()
    {

        return [

            'title' => [
                'name' => 'title',
            ],
            'subject' => [
                'name' => 'subject',
            ],
            'emailTo' => [
                'name' => 'emailTo',
            ],
            'emailFrom' => [
                'name' => 'emailFrom',
            ],
            'emailReplyTo' => [
                'name' => 'emailReplyTo',
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
            'name'                  => esc_html_x('Form Templates', 'Post Type General Name', 'elemailer'),
            'singular_name'         => esc_html_x('Form Template', 'Post Type Singular Name', 'elemailer'),
            'menu_name'             => esc_html__('Form Template', 'elemailer'),
            'name_admin_bar'        => esc_html__('Form Template', 'elemailer'),
            'archives'              => esc_html__('Form Template Archives', 'elemailer'),
            'attributes'            => esc_html__('Form Template Attributes', 'elemailer'),
            'parent_item_colon'     => esc_html__('Parent Item:', 'elemailer'),
            'all_items'             => esc_html__('Form Templates', 'elemailer'),
            'add_new_item'          => esc_html__('Add New Form Template', 'elemailer'),
            'add_new'               => esc_html__('Add New', 'elemailer'),
            'new_item'              => esc_html__('New Form Template', 'elemailer'),
            'edit_item'             => esc_html__('Edit Form Template', 'elemailer'),
            'update_item'           => esc_html__('Update Form Template', 'elemailer'),
            'view_item'             => esc_html__('View Form Template', 'elemailer'),
            'view_items'            => esc_html__('View Form Templates', 'elemailer'),
            'search_items'          => esc_html__('Search Form Templates', 'elemailer'),
            'not_found'             => esc_html__('Not found', 'elemailer'),
            'not_found_in_trash'    => esc_html__('Not found in Trash', 'elemailer'),
            'featured_image'        => esc_html__('Featured Image', 'elemailer'),
            'set_featured_image'    => esc_html__('Set featured image', 'elemailer'),
            'remove_featured_image' => esc_html__('Remove featured image', 'elemailer'),
            'use_featured_image'    => esc_html__('Use as featured image', 'elemailer'),
            'insert_into_item'      => esc_html__('Insert into form', 'elemailer'),
            'uploaded_to_this_item' => esc_html__('Uploaded to this form', 'elemailer'),
            'items_list'            => esc_html__('Form Templates list', 'elemailer'),
            'items_list_navigation' => esc_html__('Form Templates list navigation', 'elemailer'),
            'filter_items_list'     => esc_html__('Filter froms list', 'elemailer'),
        );
        $rewrite = array(
            'slug'                  => 'em-form-template',
            'with_front'            => true,
            'pages'                 => false,
            'feeds'                 => false,
        );
        $args = array(
            'label'                 => esc_html__('Form Templates', 'elemailer'),
            'description'           => esc_html__('elemailer form template create', 'elemailer'),
            'labels'                => $labels,
            'supports'              => array('title', 'editor', 'elementor', 'permalink'),
            'hierarchical'          => true,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => 'elemailer-menu',
            'menu_icon'             => 'dashicons-welcome-write-blog',
            'menu_position'         => 5,
            'show_in_admin_bar'     => false,
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
     */
    public function flush_rewrites()
    {
        $name = $this->post_type();
        $args = $this->post_args();
        register_post_type($name, $args);
        flush_rewrite_rules();
    }
}

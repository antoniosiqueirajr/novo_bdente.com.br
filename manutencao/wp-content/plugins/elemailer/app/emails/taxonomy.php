<?php

namespace Elemailer\App\Emails;

defined('ABSPATH') || exit;

/**
 * custom taxonomy register class
 * register taxonomy for email template
 *
 * @author elEmailer 
 * @since 1.0.0
 */
class Taxonomy extends \Elemailer\Core\Taxonomy
{


    /**
     * get taxonomy name function
     *
     * @return string
     * @since 1.0.0
     */
    public function taxonomy_name()
    {
        return 'email_type';
    }

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
     * configure taxonomy function
     *
     * @return array $args
     * @since 1.0.0
     */
    public function taxonomy_args()
    {
        $labels = array(
            'name'              => _x('Email Types', 'taxonomy general name', 'elemailer'),
            'singular_name'     => _x('Email Type', 'taxonomy singular name', 'elemailer'),
            'search_items'      => __('Search Email Types', 'elemailer'),
            'all_items'         => __('All Email Types', 'elemailer'),
            'parent_item'       => __('Parent Email Type', 'elemailer'),
            'parent_item_colon' => __('Parent Email Type:', 'elemailer'),
            'edit_item'         => __('Edit Email Type', 'elemailer'),
            'update_item'       => __('Update Email Type', 'elemailer'),
            'add_new_item'      => __('Add New Email Type', 'elemailer'),
            'new_item_name'     => __('New Email Type Name', 'elemailer'),
            'menu_name'         => __('Email Type', 'elemailer'),
        );

        $args = array(
            'hierarchical'      => true,
            'labels'            => $labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array('slug' => 'email_type'),
        );

        return $args;
    }

    /**
     * register taxonomy function
     * flush rewrites after regsiter taxonomy in cpt function
     *
     * @return void
     * @since 1.0.0
     */
    public function flush_rewrites()
    {
        $name = $this->taxonomy_name();
        $post_type = $this->post_type();
        $args = $this->taxonomy_args();
        register_taxonomy($name, $post_type, $args);
        flush_rewrite_rules();
    }

    /**
     * add default term under this taxonomy for email post type function
     *
     * @return void
     * @since 1.0.0
     */
    public function add_default_terms_for_emails()
    {
        add_action('init', function () {
            $emails_taxonomies = array(
                'email_type'     => array(
                    'terms'         => array('Newsletter', 'WelcomeEmail', 'PostNotification', 'WooCommerceEmail'),
                    'singular_name' => 'Email Type'
                ),
            );
            foreach ($emails_taxonomies as $taxonomy_name => $taxonomy_data) {

                if (0 === count(get_terms($taxonomy_name))) {

                    foreach ($taxonomy_data['terms'] as $term) {

                        wp_insert_term($term, $taxonomy_name);
                    }
                }
            }
        });
    }
}

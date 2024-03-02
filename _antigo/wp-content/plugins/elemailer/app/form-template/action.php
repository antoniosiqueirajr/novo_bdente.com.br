<?php

namespace Elemailer\App\Form_Template;

defined('ABSPATH') || exit;

/**
 * template create/ update setting related class
 * also used for getting templete settings
 * 
 * @author elEmailer
 * @since 1.0.0
 */
class Action
{
    use \Elemailer\Traits\Singleton;

    private $response;
    private $template_id;
    private $submitted_data;
    private $post_type;
    private $template_setting_fields;

    private $key_template_setting;

    /**
     * initializing some property constructor function
     *
     * @return void
     * @since 1.0.0
     */
    public function __construct()
    {
        $this->response = [
            'status' => 0,
            'error' => [
                esc_html('Something went wrong!')
            ],
            'data' => [
                'message' => '',
            ],
        ];

        $this->key_template_setting = 'elemailer__template_setting';

        $this->post_type = Base::instance()->template->post_type();
        // get settings name for sanitize input
        $this->template_setting_fields = Base::instance()->template->get_template_settings_fields();
    }

    /**
     * modal create/update decision maker function
     *
     * @param int[post_id] $template_id
     * @param array $submitted_data
     *
     * @return array $response
     * @since 1.0.0
     */
    public function store($template_id, $submitted_data)
    {
        if (!current_user_can('manage_options')) {
            return;
        }

        $this->template_id = $template_id;
        $this->sanitize($submitted_data);

        // id 0 for new creation sent from frontend
        if ($this->template_id == '0') {
            $this->insert();
        } else {
            $this->update();
        }

        return $this->response;
    }

    /**
     * create template function
     *
     * @return void
     * @since 1.0.0
     */
    public function insert()
    {
        if (!current_user_can('manage_options')) {
            return;
        }

        $defaults = array(
            'post_title' => ($this->submitted_data['title']) ? $this->submitted_data['title'] : 'Form template # ' . time(),
            'post_status' => 'publish',
            'post_type' => $this->post_type,
        );
        $this->template_id = wp_insert_post($defaults);

        update_post_meta($this->template_id, $this->key_template_setting, $this->submitted_data);
        update_post_meta($this->template_id, '_wp_page_template', 'elementor_canvas');

        $this->response['status'] = 1;
        $this->response['data'] = [
            'id' => $this->template_id,
            'message' => esc_html__('Your template is created', 'elemailer'),
            'stored_data' => $this->submitted_data,
            'template_id' => $this->template_id,
        ];
    }

    /**
     * update template function
     *
     * @return void
     * @since 1.0.0
     */
    public function update()
    {
        if (!current_user_can('manage_options')) {
            return;
        }

        if (isset($this->submitted_data['title'])) {
            $update_post = array(
                'ID'           => $this->template_id,
                'post_title'   => ($this->submitted_data['title']) ? $this->submitted_data['title'] : 'Form template # ' . time(),
            );
            wp_update_post($update_post);
        }

        update_post_meta($this->template_id, $this->key_template_setting, $this->submitted_data);
        update_post_meta($this->template_id, '_wp_page_template', 'elementor_canvas');

        $this->response['status'] = 1;
        $this->response['data'] = [
            'id' => $this->template_id,
            'message' => esc_html__('Your template setting is updated.', 'elemailer'),
            'updated_data' => $this->submitted_data,
            'template_id' => $this->template_id,
        ];
    }

    /**
     * template settings sanitize function
     *
     * @param array $submitted_data
     * @param array $fields
     *
     * @return array $this->submitted_data;
     * @since 1.0.0
     */
    public function sanitize($submitted_data, $fields = null)
    {

        if ($fields == null) {
            $fields = $this->template_setting_fields;
        }

        foreach ($submitted_data as $key => $value) {

            if (isset($fields[$key])) {
                $this->submitted_data[$key] = $value;
            }
        }

        return $this->submitted_data;
    }

    /**
     * get template settings function
     *
     * @param int[post_id] $template_id
     *
     * @return array $settings
     * @since 1.0.0
     */
    public function get_template_setting($template_id)
    {
        $this->template_id = $template_id;

        $post = get_post($this->template_id);

        if (!is_object($post)) {
            return null;
        }

        if (!property_exists($post, 'ID')) {
            return null;
        }

        $settings = get_post_meta($post->ID, $this->key_template_setting,  true);
        $settings = (is_array($settings) ? $settings : []);
        $settings['title'] = $post->post_title;

        return $settings;
    }

    /**
     * all template get function
     * used to show all templete in form widget for selecting
     *
     * @return array $form_templates
     * @since 1.0.0
     */
    public function get_all_template()
    {

        $form_templates = [];

        $posts = get_posts([
            'post_type' => $this->post_type,
            'post_status' => 'publish',
            'numberposts' => -1,
            'order'    => 'DESC',
        ]);

        foreach ($posts as $post) {
            $form_templates[$post->ID] = $post->post_title;
        }

        wp_reset_postdata();

        return $form_templates;
    }
}

<?php

namespace Elemailer\App\Emails;

defined('ABSPATH') || exit;

use \Elemailer\App\Settings\Action as Settings_Action;
use \Elemailer\Lib\Database\DB;

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
    private $id;
    private $email_settings;
    private $post_type;
    private $taxonomy;
    private $template_setting_fields;

    private $key_email_subject;
    private $key_email_setting;

    private $global_settings;

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

        $this->key_email_setting = 'elemailer__emails_setting';
        $this->key_email_subject = 'elemailer__emails_subject';

        $this->post_type = Base::instance()->emails->post_type();
        $this->taxonomy = Base::instance()->taxonomy->taxonomy_name();
        // get settings name for sanitize input
        $this->template_setting_fields = Base::instance()->emails->get_template_settings_fields();

        $this->global_settings = Settings_Action::instance()->get_global_settings();
    }

    /**
     * email create/update decision maker function
     *
     * @param int[post_id] $id
     * @param array $email_settings
     *
     * @return array $response
     * @since 1.0.0
     */
    public function store($id, $email_settings)
    {
        if (!current_user_can('manage_options')) {
            return;
        }

        $this->id = $id;
        $this->sanitize($email_settings);

        // id 0 for new creation sent from frontend
        if ($this->id == '0') {
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
            'post_title' => ($this->email_settings['template_name']) ? $this->email_settings['template_name'] : 'Email template # ' . time(),
            'post_status' => 'publish',
            'post_type' => $this->post_type,
        );
        $this->id = wp_insert_post($defaults);

        wp_set_object_terms($this->id, $this->email_settings['elemailer_category'], $this->taxonomy);

        update_post_meta($this->id, $this->key_email_subject, (isset($this->email_settings['template_subject']) ? $this->email_settings['template_subject'] : ''));
        update_post_meta($this->id, '_wp_page_template', 'elementor_canvas');
        update_post_meta($this->id, 'elemailer_wc_email_type', (isset($this->email_settings['elemailer_wc_email_type']) ? $this->email_settings['elemailer_wc_email_type'] : ''));
        update_post_meta($this->id, 'elemailer_wc_email_where_apply', (isset($this->email_settings['elemailer_wc_email_where_apply']) ? $this->email_settings['elemailer_wc_email_where_apply'] : ''));
        update_post_meta($this->id, 'elemailer_wc_product', (isset($this->email_settings['elemailer_wc_product']) ? $this->email_settings['elemailer_wc_product'] : ''));
        update_post_meta($this->id, 'elemailer_wc_category', (isset($this->email_settings['elemailer_wc_category']) ? $this->email_settings['elemailer_wc_category'] : ''));

        $this->response['status'] = 1;
        $this->response['data'] = [
            'id' => $this->id,
            'message' => esc_html__('Your template is created', 'elemailer'),
            'stored_data' => $this->email_settings,
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

        if (isset($this->email_settings['template_name'])) {
            $update_post = array(
                'ID'           => $this->id,
                'post_title'   => ($this->email_settings['template_name']) ? $this->email_settings['template_name'] : 'Email template # ' . time(),
            );
            wp_update_post($update_post);
        }

        update_post_meta($this->id, $this->key_email_subject, (isset($this->email_settings['template_subject']) ? $this->email_settings['template_subject'] : ''));
        update_post_meta($this->id, '_wp_page_template', 'elementor_canvas');
        update_post_meta($this->id, 'elemailer_wc_email_type', (isset($this->email_settings['elemailer_wc_email_type']) ? $this->email_settings['elemailer_wc_email_type'] : ''));
        update_post_meta($this->id, 'elemailer_wc_email_where_apply', (isset($this->email_settings['elemailer_wc_email_where_apply']) ? $this->email_settings['elemailer_wc_email_where_apply'] : ''));
        update_post_meta($this->id, 'elemailer_wc_product', (isset($this->email_settings['elemailer_wc_product']) ? $this->email_settings['elemailer_wc_product'] : ''));
        update_post_meta($this->id, 'elemailer_wc_category', (isset($this->email_settings['elemailer_wc_category']) ? $this->email_settings['elemailer_wc_category'] : ''));

        $this->response['status'] = 1;
        $this->response['data'] = [
            'id' => $this->id,
            'message' => esc_html__('Your template setting is updated.', 'elemailer'),
            'updated_data' => $this->email_settings,
        ];
    }

    /**
     * template settings sanitize function
     *
     * @param array $email_settings
     * @param array $fields
     *
     * @return array $this->email_settings
     * @since 1.0.0
     */
    public function sanitize($email_settings, $fields = null)
    {

        if ($fields == null) {
            $fields = $this->template_setting_fields;
        }

        foreach ($email_settings as $key => $value) {

            if (isset($fields[$key])) {
                $this->email_settings[$key] = $value;
            }
        }

        return $this->email_settings;
    }

    /**
     * update template settings for curresponding emails function
     *
     * @param int[post_id] $id
     * @param array[email_settings] $email_settings
     * @return array[operation_status] $this->response
     * @since 1.0.0
     */
    public function settings_update($id, $email_settings)
    {
        if (!current_user_can('manage_options')) {
            return;
        }

        $status = (isset($email_settings['status']) ? $email_settings['status'] : 'save');

        $this->id = $id;
        $this->sanitize($email_settings);

        $this->email_settings['email_status'] = (($status == 'sent') ? 'schedule' : 'draft');

        $before_filter = $this->email_settings;

        $term = $this->get_term_by_id($this->id);

        $this->filter_schedule_time_by_email_type($term);

        update_post_meta($this->id, $this->key_email_setting, $this->email_settings);

        if ($status == 'sent' && ( isset($this->email_settings['schedule_it'] ) || $term == 'newsletter') ) {
            $cron_store_status = $this->cron_job_info_store($term, $this->id);
        } else if ($status == 'sent' && !isset($this->email_settings['schedule_it'])) {
            switch ($term) {
                case 'postnotification':
                    $cron_store_status = $this->cron_job_info_store($term, $this->id);
                    break;
                case 'welcomeemail':
                    $cron_store_status = $this->cron_job_info_store($term, $this->id);
                    break;
                default:
            }
        }

        $this->response['status'] = 1;
        $this->response['data'] = [
            'id' => $this->id,
            'message' => esc_html__('Your emails setting is updated.', 'elemailer'),
            'before_filter_data' => $before_filter,
            'updated_data' => $this->email_settings,
            'term' => $term,
            'cron_status' => $status,
        ];

        return $this->response;
    }

    /**
     * update specific selected settings for curresponding emails function
     *
     * @param int[post_id] $id
     * @param array[updated_settings] $updated_settings
     * @return int[operation_status] $status
     * @since 1.0.0
     */
    public function update_specific_settings($id, $updated_settings)
    {
        $old_settings = $this->get_template_setting($id);

        $new_settings = array_merge($old_settings, $updated_settings);

        $status = update_post_meta($id, $this->key_email_setting, $new_settings);

        return $status;
    }

    /**
     * store cron job info function
     * This function will be used when use schedule emails template
     *
     * @param string[term_slug] $type
     * @param int[post_id] $id
     * @return int[operation_status] $status
     * @since 1.0.0
     */
    public function cron_job_info_store($type, $id = null)
    {
        if ($id != null) {
            $this->id = $id;
        }

        $data = [
            'post_id' => $this->id,
            'post_term' => $type,
            'status' => 'assign',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        $format = [
            '%d',
            '%s',
            '%s',
            '%s',
            '%s',
        ];

        $exist = DB::get_all_data_with_single_condition('elemailer_scheduler_tasks', 'post_id', $this->id);

        $status = false;

        if (empty($exist)) {
            $status = DB::insert('elemailer_scheduler_tasks', $data, $format);
        }

        return $status;
    }

    /**
     * get template settings function
     *
     * @param integer[number] $id
     *
     * @return array $settings
     * @since 1.0.0
     */
    public function get_template_setting($id)
    {
        $this->id = $id;

        $post = get_post($this->id);

        if (!is_object($post)) {
            return null;
        }

        if (!property_exists($post, 'ID')) {
            return null;
        }

        $settings = get_post_meta($post->ID, $this->key_email_setting,  true);
        $settings = (is_array($settings) ? $settings : []);

        return $settings;
    }

    /**
     * get subject of emails template function
     *
     * @param int[post_id] $id
     * @return string[email_subject] $subject
     * @since 1.0.0
     */
    public function get_template_subject($id)
    {
        $this->id = $id;

        $post = get_post($this->id);

        if (!is_object($post)) {
            return null;
        }

        if (!property_exists($post, 'ID')) {
            return null;
        }

        $subject = get_post_meta($post->ID, $this->key_email_subject,  true);

        return $subject;
    }

    /**
     * delete email by id function
     *
     * @param int[post_id] $id
     * @return array[operation_status] $this->response
     * @since 1.0.0
     */
    public function delete($id)
    {
        if (!current_user_can('manage_options')) {
            return;
        }

        $this->id = $id;

        $this->response['term'] = $this->get_term_by_id($this->id);

        $status = wp_delete_post($this->id, true);

        if ($status) {
            $this->response['status'] = 1;
            $this->response['data'] = [
                'id' => $this->id,
                'message' => esc_html__('Your emails is deleted.', 'elemailer'),
            ];
        } else {
            $this->response['status'] = 0;
            $this->response['data'] = [
                'id' => $this->id,
                'message' => esc_html__('Your emails is not deleted.', 'elemailer'),
            ];
        }

        return $this->response;
    }

    /**
     * change status like move trash, move published, duplicate function
     *
     * @param int[post_id] $id
     * @param array[settings] $email_settings
     * @return array[operation_status] $this->response
     * @since 1.0.0
     */
    public function change_status($id, $email_settings)
    {
        if (!current_user_can('manage_options')) {
            return;
        }

        $this->id = $id;

        if ($email_settings['status'] == 'trash') {
            $status = wp_trash_post($this->id);
        } else if ($email_settings['status'] == 'duplicate') {
            $status = $this->duplicate($this->id);
        } else {
            $status = wp_update_post(['ID' => $this->id, 'post_status' => 'publish']);
        }

        if ($status) {
            $this->response['status'] = 1;
            $this->response['data'] = [
                'id' => $this->id,
                'message' => esc_html__('Your email\'s status is changed.', 'elemailer'),
            ];
        } else {
            $this->response['status'] = 0;
            $this->response['data'] = [
                'id' => $this->id,
                'message' => esc_html__('Your email\'s status is not changed.', 'elemailer'),
            ];
        }

        $this->response['term'] = $this->get_term_by_id($this->id);

        return $this->response;
    }

    /**
     * change status like move to trash, published, duplicate function
     *
     * @param string[change_status] $status
     * @param array[selected_post_id] $selected
     * @return array[operation_status] $this->response
     * @since 1.0.0
     */
    public function change_status_multiple($status, $selected)
    {
        $this->response['term'] = $this->get_term_by_id(isset($selected[0]) ? $selected[0] : '');

        foreach ($selected as $select) {
            if ($status == 'delete') {
                $this->delete($select);
            } else {
                $this->change_status($select, ['status' => $status]);
            }
        }

        if ($status) {
            $this->response['status'] = 1;
            $this->response['data']['message'] = esc_html__('Successfully deleted multiple', 'elemailer');
            $this->response['error'] = '';
        } else {
            $this->response['status'] = 0;
            $this->response['data']['message'] = '';
            $this->response['error'] = esc_html__('Not deleted from the database. Try again. multiple', 'elemailer');
        }

        return $this->response;
    }

    /**
     * get all published emails function
     *
     * @param array[data_table_query] $query
     * @param string[term_slug] $type
     * @return array
     * @since 1.0.0
     */
    public function get_all_published_emails($query, $type)
    {
        return $this->get_emails_data_table($query, $type, false);
    }

    /**
     * get all trash emails function
     *
     * @param array[data_table_query] $query
     * @param string[term_slug] $type
     * @return array
     * @since 1.0.0
     */
    public function get_all_trash_emails($query, $type)
    {
        return $this->get_emails_data_table($query, $type, true);
    }

    /**
     * change status like move to trash, published, duplicate function
     *
     * @param array[data_table_query] $query_params
     * @param string[term_slug] $type
     * @param boolean $is_trash
     * @return array[data_for_data_table]
     * @since 1.0.0
     */
    public function get_emails_data_table($query_params, $type, $is_trash)
    {
        $status = (($is_trash) ? 'trash' : 'publish');

        // sort by detect array for datatable
        $columns = [
            0 => 'id',
            1 => 'post_title',
            2 => 'subject',
            3 => 'status',
            4 => 'list',
            5 => 'schedule_it',
            6 => 'post_date',
            7 => 'action',
        ];

        $draw = $query_params['draw'];
        $start = $query_params['start'];
        $lengh = $query_params['length'];
        $order= ( empty($query_params['eorderdir']) ) ? 'DESC' : $query_params['eorderdir']; // ASC or DESC 
        
        $order_by_meta_key='';
         // in which column , we modify it this way as we want to allow sorting with list id too which is by clicking 4th column
        if(!empty($query_params['eordercolumn'])){
            
            if($query_params['eordercolumn']==2){ // if it's a List column sorting sort with id
                 $order_by = 'meta_value';
                 $order_by_meta_key= 'elemailer__emails_subject';
            }else{
                 $order_by = $columns[$query_params['eordercolumn']];
            }

        }else{
            $order_by=$columns[0];
        }

        $search_value = ( !empty($query_params['esearchvalue']) ) ? $query_params['esearchvalue'] : '';

        // get posts args with datatable params
        $args = [
            'post_type' => $this->post_type,
            'post_status' => $status,
            'posts_per_page' => $lengh,
            'offset' => $start,
            'order'    => $order,
            'orderby'    => $order_by,
            'meta_type' => 'CHAR',
            'meta_key' => $order_by_meta_key,
            'tax_query' => [
                [
                    'taxonomy' => $this->taxonomy,
                    'field' => 'slug',
                    'terms' => [$type],
                ],
            ],
        ];

        // get posts args for showing total number of posts
        $cnt_args = [
            'post_type' => $this->post_type,
            'post_status' => $status,
            'posts_per_page' => -1,
            'order'    => $order,
            'orderby'    => $order_by,
            'tax_query' => [
                [
                    'taxonomy' => $this->taxonomy,
                    'field' => 'slug',
                    'terms' => [$type],
                ],
            ],
        ];

        // get posts args change for searching
        if (!empty($search_value)) {

            $search_value = sanitize_text_field($search_value);

            $args = [
                'post_type' => $this->post_type,
                's' => $search_value,
                'post_status' => $status,
                'posts_per_page' => $lengh,
                'offset' => $start,
                'order'    => $order,
                'orderby'    => $order_by,
                'tax_query' => [
                    [
                        'taxonomy' => $this->taxonomy,
                        'field' => 'slug',
                        'terms' => [$type],
                    ],
                ],
            ];

            $cnt_args = [
                'post_type' => $this->post_type,
                's' => $search_value,
                'post_status' => $status,
                'posts_per_page' => -1,
                'order'    => $order,
                'orderby'    => $order_by,
                'tax_query' => [
                    [
                        'taxonomy' => $this->taxonomy,
                        'field' => 'slug',
                        'terms' => [$type],
                    ],
                ],
            ];
        }

        // get posts with datatable params
        $posts = get_posts($args);

        // get total number of posts
        $cnt_posts = get_posts($cnt_args);

        $emails = [];

        // format posts for showing in datatable with every relational data
        foreach ($posts as $key => $post) {

            $settings = $this->get_template_setting($post->ID);

            $emails[$key]['id'] = $post->ID;
            $emails[$key]['post_title'] = $post->post_title;
            $emails[$key]['subject'] = $this->get_template_subject($post->ID);
            $emails[$key]['status'] = isset($settings['email_status']) ? $settings['email_status'] : '';

            $lists_id = (isset($settings['list_id']) ? $settings['list_id'] : []);
            $list_names = [];

            // get lists for this email
            foreach ($lists_id as $k => $v) {
                $lists = \Elemailer\Lib\Database\DB::get_all_data_with_single_condition('elemailer_lists', 'id', $v);
                $list_names[] = isset($lists[0]['name']) ? $lists[0]['name'] : '';
            }

            // send differect data for welcome email
            if ($type == 'welcomeemail') {
                $emails[$key]['lists'] = isset($settings['wm_event_of_send']) ? $settings['wm_event_of_send'] : '';
                $emails[$key]['set_on'] = isset($settings['wm_user_type']) ? $settings['wm_user_type'] : '';
                if ($emails[$key]['lists'] == 'new-subscriber') {
                    $emails[$key]['set_on'] = '<b>' . (is_array($list_names) ? implode('<br>', $list_names) : '') . '</b>';
                }
            } else {
                // this general data format for datatable of emails
                $emails[$key]['lists'] = '<b>' . (is_array($list_names) ? implode('<br>', $list_names) : '') . '</b>';

                $schedule_it = $this->get_schedule_time($type, $settings);
                $emails[$key]['set_on'] = '<span>' . str_replace(['&', '=', '+', '%3A'], ['</span><br><span>', ': ', ' ', ':'], http_build_query($schedule_it)) . '</span>';
            }

            if ($type == 'woocommerceemail') {
                $elemailer_wc_email_type = get_post_meta( $post->ID, 'elemailer_wc_email_type',  true);
                
                $elemailer_wc_email_where_apply = get_post_meta( $post->ID, 'elemailer_wc_email_where_apply',  true);

                $emails[$key]['appliedon'] = 'Global';

                if($elemailer_wc_email_where_apply=='product'){
                    
                    $elemailer_wc_product = get_post_meta( $post->ID, 'elemailer_wc_product',  true);
                    if(in_array('1', $elemailer_wc_product)){
                        // we need to check why 1 was used meaning all product option was used to being with and optimize it
                        $emails[$key]['appliedon'] = 'All Products';
                    
                    }else{

                        $emails[$key]['appliedon'] = 'Product<br>ID:  '.implode(",",$elemailer_wc_product); 

                        $product_array=array();
                        foreach ($elemailer_wc_product as $id){
                            
                            $product_array[]= ' <div class="eltooltip in_wc_data_table">'.$id.'
                                        <div class="top">
                                            <p>'.get_the_title( $id ).'</p>
                                            <i></i>
                                        </div>
                                    </div>';
                        }

                        $emails[$key]['appliedon'] = 'Product<br>ID:  '.implode(",",$product_array); 
                    
                    }

                }elseif($elemailer_wc_email_where_apply=='category'){

                    $elemailer_wc_category = get_post_meta( $post->ID, 'elemailer_wc_category',  true);

                    if(in_array('1', $elemailer_wc_category)){
                        // we need to check why 1 was used meaning all category option was used to being with and optimize it
                        $emails[$key]['appliedon'] = __('All Categories','elemailer');

                    }
                    else{

                        $term_array=array();
                        foreach ($elemailer_wc_category as $id){

                            $term=get_term_by( 'id', $id, 'product_cat' );
                            
                            $term_array[]= ' <div class="eltooltip in_wc_data_table">'.$id.'
                                        <div class="top">
                                            <p>'.$term->name.'</p>
                                            <i></i>
                                        </div>
                                    </div>';
                        }

                        $emails[$key]['appliedon'] = 'Category<br>ID:  '.implode(",",$term_array); 
                   
                    }

                }elseif($elemailer_wc_email_where_apply!='global'){
                    
                    $emails[$key]['appliedon'] = __('None','elemailer');

                }

                $emails[$key]['lists'] = isset( elemailer_get_wc_email_types()[$elemailer_wc_email_type] ) ? elemailer_get_wc_email_types()[$elemailer_wc_email_type] : '';

                $recipient = explode( '-', $elemailer_wc_email_type );
                $recipient = in_array( 'admin', $recipient, true ) ? __( 'Admin', 'elemailer' ) : __( 'Customer', 'elemailer' );
                $emails[$key]['recipient'] = $recipient;
            }

            // Replaced empty set on info during schedule it is not turned on and email type is not welcome email.
            if (!isset($settings['schedule_it']) && $type != 'welcomeemail') {
                $emails[$key]['set_on'] = esc_html__('Not Scheduled', 'elemailer');
            }

            $emails[$key]['shortcode'] = '[elemailer:id="' . $post->ID . '"]';

            $emails[$key]['post_date'] = $post->post_date;
        }

        wp_reset_postdata();

        return [
            'draw' => $draw,
            'recordsTotal' => count($cnt_posts),
            'recordsFiltered' => count($cnt_posts),
            'data' => $emails,
        ];
    }

    /**
     * filter schedule time by email type function
     * this function remove extra input for specific email type
     * 
     * @param string[term_slug] $type
     * @return void
     * @since 1.0.0
     */
    public function filter_schedule_time_by_email_type($type)
    {
        switch ($type) {
            case 'newsletter':
                unset($this->email_settings['pn_start_date']);
                unset($this->email_settings['pn_start_time']);
                unset($this->email_settings['pn_frequency']);
                unset($this->email_settings['wm_event_of_send']);
                unset($this->email_settings['wm_user_type']);
                break;
            case 'postnotification':
                unset($this->email_settings['nl_start_date']);
                unset($this->email_settings['nl_start_time']);
                unset($this->email_settings['wm_event_of_send']);
                unset($this->email_settings['wm_user_type']);
                break;
            case 'welcomeemail':
                unset($this->email_settings['nl_start_date']);
                unset($this->email_settings['nl_start_time']);
                unset($this->email_settings['pn_start_date']);
                unset($this->email_settings['pn_start_time']);
                unset($this->email_settings['pn_frequency']);
                break;
            default:
        }
    }

    /**
     * get schedule by email type function
     * this function format schedule time data from stored settings of email
     * 
     * @param string[term_slug] $type
     * @return array[time_schedule] $schedule
     * @since 1.0.0
     */
    public function get_schedule_time($type, $settings)
    {
        $schedule = [];
        switch ($type) {
            case 'newsletter':
                $schedule['start_date'] = (isset($settings['nl_start_date']) ? $settings['nl_start_date'] : '');
                $schedule['start_time'] = (isset($settings['nl_start_time']) ? $settings['nl_start_time'] : '');
                break;
            case 'postnotification':
                $schedule['start_date'] = (isset($settings['pn_start_date']) ? $settings['pn_start_date'] : '');
                $schedule['start_time'] = (isset($settings['pn_start_time']) ? $settings['pn_start_time'] : '');
                $schedule['frequency'] = (isset($settings['pn_frequency']) ? $settings['pn_frequency'] : '');
                break;
            case 'welcomeemail':
                $schedule['trigger_event'] = (isset($settings['wm_event_of_send']) ? $settings['wm_event_of_send'] : '');
                $schedule['delay_type'] = (isset($settings['wm_user_type']) ? $settings['wm_user_type'] : '');
                break;
            default:
        }
        return $schedule;
    }

    /**
     * create duplicate email template or post function
     *
     * @param int[old_post_id] $post_id
     * @return int[new_post_id] $new_post_id
     * @since 1.0.0
     */
    public function duplicate($post_id)
    {
        $title   = get_the_title($post_id);
        $oldpost = get_post($post_id);
        $post    = array(
            'post_title' => $title,
            'post_status' => 'publish',
            'post_type' => $oldpost->post_type,
            'post_author' => $oldpost->post_author,
        );

        $new_post_id = wp_insert_post($post);

        $term_slug = $this->get_term_by_id($post_id);

        wp_set_object_terms($new_post_id, $term_slug, $this->taxonomy);

        // copy postmeta
        $settings = $this->get_template_setting($post_id);
        //$subject = $this->get_template_subject($post_id);

        //$elementor_data = get_post_meta($post_id, '_elementor_data', true);
        //$elementor_control_usage = get_post_meta($post_id, '_elementor_controls_usage', true);

        // Copy post metadata // we use this to copy everything related to our post meta
        $data = get_post_custom($post_id);
        foreach ( $data as $key => $values) {
          foreach ($values as $value) {

            // it is important to unserialize data to avoid conflicts. wp_slash is need to make sure all unicode is also duplicated properly ref: https://developer.wordpress.org/reference/functions/update_post_meta/

            add_post_meta( $new_post_id, $key, wp_slash(maybe_unserialize( $value ) ) );
            
          }
        }

        // replace email status at initial stage during clone
        $settings['email_status'] = 'draft';
        update_post_meta($new_post_id, $this->key_email_setting, $settings);
        // update_post_meta($new_post_id, $this->key_email_subject, $subject);
        // update_post_meta($new_post_id, '_wp_page_template', 'elementor_canvas');
        // update_post_meta($new_post_id, '_elementor_data', $elementor_data);
        // update_post_meta($new_post_id, '_elementor_controls_usage', $elementor_control_usage);

        return $new_post_id;
    }

    /**
     * get term by post id function
     *
     * @param int[post_id] $id
     * @return string[term_slug] $term
     * @since 1.0.0
     */
    public function get_term_by_id($id)
    {
        $term = '';

        $terms = get_the_terms($id, $this->taxonomy);
        $term = (isset($terms[0]) ? $terms[0]->slug : '');

        return $term;
    }

    /**
     * get all users capabilities for assign welcome email function
     *
     * @return array[capabilities]
     * @since 1.0.0
     */
    public function get_all_capabilities()
    {
        global $wp_roles;
        $roles = $wp_roles->roles;
        return array_keys($roles);
    }

    /**
     * tracking related info update function
     *
     * @param string[event_type] $event
     * @param array[information] $params
     * @return int/boolean $status
     * @since 1.0.0
     */
    public function track_mail($event, $params)
    {
        $token = $params['track'];
        $token = rtrim($token, '.gif');
        $data = DB::get_all_data_with_single_condition('elemailer_tracking_mail', 'token', $token);
        
        if(empty($data)) return 0; //so that no fatal error is generated going after this if token doesn't match

        $data = isset($data[0]) ? $data[0] : [];
        switch($event){
            case 'ol':
                $open = $data['mail_open'] + 1;
                $status = DB::update('elemailer_tracking_mail', ['mail_open' => $open], ['id' => $data['id']], ['%d'], ['%d']);
                break;
            default:
        }
        return $status;
    }

    /**
     * datatable data call function
     *
     * @param int[type] $id
     * @param array[type] $query_params
     *
     * @return array
     * @since 1.0.0
     */
    public function get_stats_datatable($id, $query_params)
    {
        return DB::get_stats_data_from_db($id, $query_params);
    }
}

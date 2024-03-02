<?php

namespace Elemailer\Lib\Database;

defined('ABSPATH') || exit;

/**
 * database query builder class for initialization
 * 
 * @author elEmailer
 * @since 1.0.0
 * additional updates done by soykot here
 */
class DB
{

    /**
     * insert function by table
     *
     * @param [string] $table_name
     * @param [array] $data
     * @param [array] $format
     * @return int $insert_id
     * @since 1.0.0
     */
    public static function insert($table_name, $data, $format)
    {
        global $wpdb;
        $table = $wpdb->prefix . $table_name;

        $wpdb->insert($table, $data, $format);
        $insert_id = $wpdb->insert_id;

        return $insert_id;
    }

    /**
     * update function by table with condition
     *
     * @param [string] $table_name
     * @param [array] $data
     * @param [array] $condition
     * @param array $format
     * @param array $condition_format
     * @return boolean $status
     * @since 1.0.0
     */
    public static function update($table_name, $data, $condition, $format, $condition_format)
    {
        global $wpdb;
        $table = $wpdb->prefix . $table_name;

        $status = $wpdb->update($table, $data, $condition, $format, $condition_format);

        return $status;
    }

    /**
     * delete function by table with condition
     *
     * @param [string] $table_name
     * @param [array] $condition
     * @param [array] $format
     * @return boolean $status
     * @since 1.0.0
     */
    public static function delete($table_name, $condition, $format)
    {
        global $wpdb;
        $table = $wpdb->prefix . $table_name;

        $status = $wpdb->delete($table, $condition, $format);

        return $status;
    }

    /**
     * get all data with condtion function
     *
     * @param [string] $table_name
     * @param [string] $column_name
     * @param [string, int, time] $column_value
     * @return array $result
     * @since 1.0.0
     */
    public static function get_all_data_with_single_condition($table_name, $column_name, $column_value)
    {
        global $wpdb;
        $table = $wpdb->prefix . $table_name;

        $query = $wpdb->prepare("SELECT * FROM `{$table}` WHERE `{$column_name}` = %s ORDER BY `id` DESC", $column_value);

        $result = $wpdb->get_results($query, ARRAY_A);

        return $result;
    }

    /**
     * Get all data for wc email
     * 
     * @since 1.0.7
     *
     * @param [string] $term
     *
     * @return obj $result
     */
    public static function get_all_data_for_wc_email( $term, $template_type )
    {
        $args = [
            'post_type'   => 'em-emails-template',
            'post_status' => 'publish',
            'orderby'     => 'ID',
            'numberposts' => -1,
            'order'       => 'DESC',
            'meta_query' => [
                'relation' => 'AND', /* @since 4.0 to fix draft emails being sent-compare with meta key elemailer__emails_setting */

                [
                    'key'     => 'elemailer_wc_email_type',
                    'value'   => $template_type,
                    'compare' => '='
                ],  
                [
                    'key'     => 'elemailer__emails_setting',
                    'value'   => '"email_status";s:5:"draft"',
                    'compare' => 'NOT LIKE',

                ],
            ],
            'tax_query'   => [
                [
                    'taxonomy' => 'email_type',
                    'field' => 'slug',
                    'terms' => [$term],
                ],
            ],
        ];

        return get_posts( $args );
    }

    /**
     * get all data from a table function
     *
     * @param string[table_name] $table_name
     * @param array[column_name=>column_value] $condition
     * this param support (!) in key which means not equal 'column!' => 'value' means column != value
     * @return array $result
     * @since 1.0.0
     */
    public static function get_all_data_table_with_various_condition($table_name, $condition = null)
    {
        global $wpdb;
        $table = $wpdb->prefix . $table_name;

        if ($condition != null) {
            $query = self::format_query($table, $condition);
        } else {
            $query = "SELECT * FROM `{$table}` ORDER BY `id` DESC";
        }

        $result = $wpdb->get_results($query, ARRAY_A);

        return $result;
    }

    /**
     * format perameter with mysql query function
     *
     * @param string[table_name] $table_name
     * @param array[query_condition] $condition
     * @return string[MySQL_query] $query
     * @since 1.0.0
     */
    public static function format_query($table_name, $condition)
    {
        $query = "SELECT * FROM `{$table_name}`";
        $i = 0;
        foreach ($condition as $key => $value) {
            $status = substr($key, -1);
            $string = rtrim($key, '!');
            $operator = (($status == '!') ? '!=' : '=');

            if ($i == 0) {
                $query .= " WHERE `{$string}` {$operator} '{$value}'";
            } else if ($i > 0) {
                $query .= " AND `{$string}` {$operator} '{$value}'";
            }
            $i++;
        }
        $query .= " ORDER BY `id` DESC";

        return $query;
    }

    /**
     * get subscribers list with condition function
     * condition takes key => value array
     *
     * @param string[table_name] $condition_table
     * @param string[column_name] $condition_column
     * @param string[operator] $operator
     * @param string[checking_value] $value
     * @return array $result
     * @since 1.0.0
     */
    public static function get_subscribers_lists_with_condition($condition_table, $condition_column, $operator, $value)
    {
        global $wpdb;
        $subscribers = $wpdb->prefix . 'elemailer_subscribers';
        $lists = $wpdb->prefix . 'elemailer_lists';
        $subscribers_lists = $wpdb->prefix . 'elemailer_subscribers_lists';

        $condition_table = $wpdb->prefix . $condition_table;
        $condition_column = "`{$condition_table}`.`{$condition_column}`";

        $query = "SELECT `{$subscribers}`.`id` as subscribers_id, `wp_user_id`, `is_woocommerce_user`, `first_name`, `last_name`, `email`, `{$subscribers}`.`status` as subscribers_status, `subscribed_ip`, `confirmed_ip`, `confirmed_at`, `source`, `link_token`, `{$subscribers}`.`created_at` as subscribers_created_at, `{$subscribers}`.`updated_at` as subscribers_updated_at, `{$lists}`.`id` as lists_id, `name`, `type`, `description`, `{$lists}`.`status` as lists_status, `{$lists}`.`created_at` as lists_created_at, `{$lists}`.`updated_at` as lists_updated_at, `{$subscribers_lists}`.`id` as subscribers_lists_id, `subscriber_id`, `list_id`, `{$subscribers_lists}`.`status` as subscribers_lists_status, `{$subscribers_lists}`.`created_at` as subscribers_lists_created_at, `{$subscribers_lists}`.`updated_at` as subscribers_lists_updated_at FROM `{$subscribers}`, `{$lists}`, `{$subscribers_lists}` WHERE `{$subscribers}`.`id` = `{$subscribers_lists}`.`subscriber_id` AND `{$subscribers_lists}`.`list_id` = `{$lists}`.`id` AND {$condition_column} {$operator} {$value}  ORDER BY {$condition_column} DESC";

        $result = $wpdb->get_results($query, ARRAY_A);
        return $result;
    }
    /**
     * get subscribers list with condition function
     * condition takes key => value array
     *
     * @param string[table_name] $condition_table
     * @param string[column_name] $condition_column
     * @param string[operator] $operator
     * @param string[checking_value] $value
     * @return array $result
     * @since 4.0.16
     */
    public static function get_subscribers_lists_with_conditions( $conditions )
    {
        global $wpdb;
        $subscribers = $wpdb->prefix . 'elemailer_subscribers';
        $lists = $wpdb->prefix . 'elemailer_lists';
        $subscribers_lists = $wpdb->prefix . 'elemailer_subscribers_lists';

        $conditions_sql = array();

        foreach ($conditions as $condition) {
            $condition_table = $wpdb->prefix . $condition['table'];
            $condition_column = "`{$condition_table}`.`{$condition['column']}`";
            $operator = $condition['operator'];
            $value = $condition['value'];
            $conditions_sql[] = "{$condition_column} {$operator} {$value}";
        }

        $conditions_combined = implode(' AND ', $conditions_sql);

        $query = "SELECT `{$subscribers}`.`id` as subscribers_id, `wp_user_id`, `is_woocommerce_user`, `first_name`, `last_name`, `email`, `{$subscribers}`.`status` as subscribers_status, `subscribed_ip`, `confirmed_ip`, `confirmed_at`, `source`, `link_token`, `{$subscribers}`.`created_at` as subscribers_created_at, `{$subscribers}`.`updated_at` as subscribers_updated_at, `{$lists}`.`id` as lists_id, `name`, `type`, `description`, `{$lists}`.`status` as lists_status, `{$lists}`.`created_at` as lists_created_at, `{$lists}`.`updated_at` as lists_updated_at, `{$subscribers_lists}`.`id` as subscribers_lists_id, `subscriber_id`, `list_id`, `{$subscribers_lists}`.`status` as subscribers_lists_status, `{$subscribers_lists}`.`created_at` as subscribers_lists_created_at, `{$subscribers_lists}`.`updated_at` as subscribers_lists_updated_at FROM `{$subscribers}`, `{$lists}`, `{$subscribers_lists}` WHERE `{$subscribers}`.`id` = `{$subscribers_lists}`.`subscriber_id` AND `{$subscribers_lists}`.`list_id` = `{$lists}`.`id` AND {$conditions_combined} ORDER BY {$condition_column} DESC";

        $result = $wpdb->get_results($query, ARRAY_A);

        return $result;
    }


    /**
     * count data with condition function
     *
     * @param string[table_name] $table_name
     * @param string[column_name] $column_name
     * @param string[value] $value
     *
     * @return array $result
     * @since 1.0.0
     */
    public static function count_with_condition($table_name, $column_name, $value = null)
    {
        global $wpdb;
        $table = $wpdb->prefix . $table_name;

        if ($value != null) {

            $status = substr($column_name, -1);
            $column = rtrim($column_name, '!');
            $operator = (($status == '!') ? '!=' : '=');

            $query = $wpdb->prepare("SELECT Count({$column}) as total FROM {$table} WHERE {$column} {$operator} %s", $value);
        } else {
            $query = "SELECT Count({$column_name}) as total FROM {$table}";
        }

        $result = $wpdb->get_results($query, ARRAY_A);

        return (isset($result[0]) ? $result[0] : '');
    }

    /**
     * lists data process for data table function
     *
     * @param array[url_param] $query_params
     * @param boolean[true/false] $is_trash
     * @return array
     * @since 1.0.0
     */
    public static function get_lists_for_data_table($query_params, $is_trash)
    {
        $operator = (($is_trash) ? '=' : '!=');

        // get data table query args
        $columns = [
            0 => 'id',
            1 => 'name',
            2 => 'type',
            3 => 'description',
            4 => 'subscribed',
            5 => 'unsubscribed',
            6 => 'total',
            7 => 'created_at',
            8 => 'action',
        ];

        $draw = $query_params['draw'];
        $start = $query_params['start'];
        $lengh = $query_params['length'];
                
        $order= ( empty($query_params['eorderdir']) ) ? 'DESC' : $query_params['eorderdir']; // ASC or DESC 
        
        $order_by = ( empty($query_params['eordercolumn']) ) ? $columns[0] : $columns[$query_params['eordercolumn']];  // in which column

        $search_value = $query_params['esearchvalue'];

        global $wpdb;
        $lists = $wpdb->prefix . 'elemailer_lists';
        $subscribers_lists = $wpdb->prefix . 'elemailer_subscribers_lists';

        // create query for paged data
        $query = $wpdb->prepare(
                                "SELECT `{$lists}`.`id`, 
                                        `name`, 
                                        `description`,
                                        `type` ,
                                        SUM(`{$subscribers_lists}`.`status`='subscribed') as `subscribed`, 
                                        SUM(`{$subscribers_lists}`.`status`!='subscribed') as `unsubscribed`, 
                                        COUNT(`{$subscribers_lists}`.`list_id`) as `total`, 
                                        `{$lists}`.`created_at` 
                                FROM `{$lists}` 

                                LEFT JOIN `{$subscribers_lists}` 
                                        ON `{$lists}`.`id` = `{$subscribers_lists}`.`list_id`  
                                WHERE `{$lists}`.`status` {$operator} %s 
                                GROUP BY `{$lists}`.`id` 
                                ORDER BY `{$order_by}` {$order} 
                                LIMIT %d OFFSET %d", 'trash', $lengh, $start);

        $cnt_query = $wpdb->prepare(
                                    "SELECT COUNT(DISTINCT(`{$lists}`.`id`)) as `total`, 
                                            `{$lists}`.`id`
                                    FROM `{$lists}` 
                                    LEFT JOIN `{$subscribers_lists}` 
                                    ON `{$lists}`.`id` = `{$subscribers_lists}`.`list_id`  
                                    WHERE `{$lists}`.`status` {$operator} %s ORDER BY `{$order_by}` {$order}", 'trash');

        // search query
        if (!empty($search_value)) {
            $search_value = sanitize_text_field($search_value);
            $search = '%' . $wpdb->esc_like($search_value) . '%';

            // create query for get data according to search value
            $query = $wpdb->prepare(
                                    "SELECT `{$lists}`.`id`, 
                                            `name`, 
                                            `description`,
                                             `type` , 
                                            SUM(`{$subscribers_lists}`.`status`='subscribed') as `subscribed`, 
                                            SUM(`{$subscribers_lists}`.`status`!='subscribed') as `unsubscribed`, 
                                            COUNT(`{$subscribers_lists}`.`list_id`) as `total`, 
                                            `{$lists}`.`created_at` 
                                    FROM `{$lists}` 

                                    LEFT JOIN `{$subscribers_lists}` 
                                            ON `{$lists}`.`id` = `{$subscribers_lists}`.`list_id`  
                                    WHERE `{$lists}`.`status` {$operator} %s 
                                            AND (`name` LIKE %s 
                                                OR `{$lists}`.`id` LIKE %s 
                                                OR `description` LIKE %s
                                                OR CAST(`{$lists}`.`created_at` AS CHAR) LIKE %s 
                                                ) 
                                    GROUP BY `{$lists}`.`id` 
                                    ORDER BY `{$order_by}` {$order} 
                                    LIMIT %d OFFSET %d", 'trash', $search, $search, $search, $search, $lengh, $start);
            $cnt_query = $wpdb->prepare(
                                        "SELECT COUNT(DISTINCT(`{$lists}`.`id`)) as `total`, 
                                            `{$lists}`.`id`
                                        FROM `{$lists}` 
                                        LEFT JOIN `{$subscribers_lists}` 
                                        ON `{$lists}`.`id` = `{$subscribers_lists}`.`list_id`  
                                        WHERE `{$lists}`.`status` {$operator} %s 
                                            AND (`name` LIKE %s 
                                                OR `{$lists}`.`id` LIKE %s 
                                                OR `description` LIKE %s 
                                                OR CAST(`{$lists}`.`created_at` AS CHAR) LIKE %s ) 
                                        ORDER BY `{$order_by}` {$order}", 'trash', $search, $search, $search, $search);

        }

        $results = $wpdb->get_results($query, ARRAY_A);

        $total = $wpdb->get_results($cnt_query, ARRAY_A);

        $count = isset($total[0]['total']) ? $total[0]['total'] : 0;
        
        return [
            'draw' => $draw,
            'recordsTotal' => $count,
            'recordsFiltered' => $count,
            'data' => is_array($results) ? $results : [],
        ];
    }

    /**
     * subscribers data process for data table function
     * Get list of subscribers on datatables -> admin.php?page=elemailer-subscribers
     * @param array[url_param] $query_params
     * @param boolean[true/false] $is_trash
     * @return array
     * @since 1.0.0
     */
    public static function get_subscribers_for_data_table($query_params, $is_trash)
    {
        $operator = (($is_trash) ? '=' : '!=');

        // get data table query args
        $columns = [
            0 => 'id',
            1 => 'email',
            2 => 'first_name',
            3 => 'last_name',
            4 => 'list',
            5 => 'status',
            6 => 'userstatus',
            7 => 'created_at',
            8 => 'action',
        ];

        $draw = $query_params['draw'];
        $start = $query_params['start'];
        $lengh = $query_params['length'];
        
        $order= ( empty($query_params['eorderdir']) ) ? 'DESC' : $query_params['eorderdir']; // ASC or DESC 
        
        // in which column , we modify it this way as we want to allow sorting with list id too which is by clicking 4th column
        if(!empty($query_params['eordercolumn'])){

            if($query_params['eordercolumn']==4){
                 $order_by = 'list_id';
            }else{
                 $order_by = $columns[$query_params['eordercolumn']];
            }

        }else{
            $order_by=$columns[0];
        }
        
        $search_value = $query_params['esearchvalue'];

        $list_id = $query_params['list_id'];

        global $wpdb;
        $subscribers = $wpdb->prefix . 'elemailer_subscribers';
        $subscribers_lists = $wpdb->prefix . 'elemailer_subscribers_lists';
        $lists = $wpdb->prefix . 'elemailer_lists';

        // create query for paged data

        if (empty($list_id)) {
        $query = $wpdb->prepare(
                                "SELECT `{$subscribers}`.`id`, 
                                    `{$subscribers}`.`email`, 
                                    `{$subscribers}`.`first_name`, 
                                    `{$subscribers}`.`last_name`, 
                                    GROUP_CONCAT(`{$lists}`.`name` SEPARATOR'<br>') as `lists`,
                                    GROUP_CONCAT(`{$subscribers_lists}`.`status` SEPARATOR'<br>') as `status`, 
                                    `{$subscribers}`.`status` as `userstatus`,
                                    `{$subscribers}`.`created_at` 
                                FROM `{$subscribers}` 
                                
                                LEFT JOIN `{$subscribers_lists}` ON `{$subscribers}`.`id` = `{$subscribers_lists}`.`subscriber_id`
                                LEFT JOIN `{$lists}` ON `{$subscribers_lists}`.`list_id` = `{$lists}`.`id` 
                                
                                WHERE `{$subscribers}`.`status` {$operator} %s 
                                
                                GROUP BY `{$subscribers}`.`id` 
                                
                                ORDER BY `{$order_by}` {$order} 
                                
                                LIMIT %d OFFSET %d", 'trash', $lengh, $start
                        );
        
        //needed because the above query will not all records
        $original_total = $wpdb->prepare("SELECT COUNT(*) FROM `{$subscribers}` WHERE `{$subscribers}`.`status` {$operator} %s",'trash');
        $table_total = $wpdb->prepare("SELECT COUNT(*) FROM `{$subscribers}`");

            // search query
            if (!empty($search_value)) {
                $search_value = sanitize_text_field($search_value);
                $search = '%' . $wpdb->esc_like($search_value) . '%';
    
                // create query for get data according to search value
                $query = $wpdb->prepare(
                                        "SELECT `{$subscribers}`.`id`, 
                                                `{$subscribers}`.`email`, 
                                                `{$subscribers}`.`first_name`, 
                                                `{$subscribers}`.`last_name`, 
                                                GROUP_CONCAT(`{$lists}`.`name` SEPARATOR'<br>') as `lists`,
                                                GROUP_CONCAT(`{$subscribers_lists}`.`status` SEPARATOR'<br>') as `status`,
                                                `{$subscribers}`.`status` as `userstatus`, 
                                                `{$subscribers}`.`created_at` 
                                        FROM `{$subscribers}` 
                                        LEFT JOIN `{$subscribers_lists}` ON `{$subscribers}`.`id` = `{$subscribers_lists}`.`subscriber_id` 
                                        LEFT JOIN `{$lists}` ON `{$subscribers_lists}`.`list_id` = `{$lists}`.`id` 

                                        WHERE `{$subscribers}`.`status` {$operator} %s 
                                            AND (`{$subscribers}`.`email` LIKE %s 
                                                    OR `{$subscribers}`.`first_name` LIKE %s 
                                                    OR `{$subscribers}`.`last_name` LIKE %s 
                                                    OR `{$subscribers}`.`status` LIKE %s 
                                                    OR `{$subscribers_lists}`.`status` LIKE %s 
                                                    OR `{$lists}`.`name` LIKE %s 
                                                    OR CAST(`{$subscribers}`.`created_at` AS CHAR) LIKE %s 
                                                ) 
                                        GROUP BY `{$subscribers}`.`id` 
                                        
                                        ORDER BY `{$order_by}` {$order} 

                                        LIMIT %d OFFSET %d", 'trash', $search, $search,$search,$search, $search, $search, $search, $lengh, $start);
    
                // create query for all data count according to search value

                $original_total = $wpdb->prepare(
                                        "SELECT COUNT(*) as `total`
                                        FROM `{$subscribers}` 
                                        LEFT JOIN `{$subscribers_lists}` ON `{$subscribers}`.`id` = `{$subscribers_lists}`.`subscriber_id` 
                                        LEFT JOIN `{$lists}` ON `{$subscribers_lists}`.`list_id` = `{$lists}`.`id` 

                                        WHERE `{$subscribers}`.`status` {$operator} %s 
                                            AND (`{$subscribers}`.`email` LIKE %s 
                                                    OR `{$subscribers}`.`first_name` LIKE %s 
                                                    OR `{$subscribers}`.`last_name` LIKE %s 
                                                    OR `{$subscribers}`.`status` LIKE %s 
                                                    OR `{$subscribers_lists}`.`status` LIKE %s 
                                                    OR `{$lists}`.`name` LIKE %s 
                                                    OR CAST(`{$subscribers}`.`created_at` AS CHAR) LIKE %s 
                                                )", 'trash', $search, $search,$search,$search, $search, $search, $search);
                
            }
            
        }

        // list wise subscriber show here the query can be different and not be using join because the subscribers has a list for sure
        else{

            // create query for get data according to list
            $query = $wpdb->prepare(
                                    "SELECT `{$subscribers}`.`id`, 
                                            `{$subscribers}`.`email`, 
                                            `{$subscribers}`.`first_name`, 
                                            `{$subscribers}`.`last_name`, 
                                            `{$lists}`.`name` as `lists`,
                                            `{$subscribers_lists}`.`status`,  
                                            `{$subscribers}`.`status` as `userstatus`, 
                                            `{$subscribers}`.`created_at` 

                                    FROM `{$subscribers}`, `{$lists}`, `{$subscribers_lists}` 

                                    WHERE `{$subscribers}`.`id` = `{$subscribers_lists}`.`subscriber_id` 
                                        AND `{$subscribers_lists}`.`list_id` = `{$lists}`.`id` 
                                        AND `{$lists}`.`id` = $list_id 
                                        AND `{$subscribers}`.`status` {$operator} %s 

                                    ORDER BY `{$order_by}` {$order} 

                                    LIMIT %d OFFSET %d", 'trash', $lengh, $start);
            
            $original_total = $wpdb->prepare("SELECT COUNT(*) FROM `{$subscribers}`, `{$subscribers_lists}` WHERE `{$subscribers}`.`id` = `{$subscribers_lists}`.`subscriber_id` AND `{$subscribers_lists}`.`list_id` = $list_id AND `{$subscribers}`.`status` {$operator} %s",'trash');
            $table_total = $wpdb->prepare("SELECT COUNT(*) FROM `{$subscribers}`, `{$subscribers_lists}` WHERE `{$subscribers}`.`id` = `{$subscribers_lists}`.`subscriber_id` AND `{$subscribers_lists}`.`list_id` = $list_id");

            // create query for all data count according to list

            // search query lise wise
            if (!empty($search_value)) {
                $search_value = sanitize_text_field($search_value);
                $search = '%' . $wpdb->esc_like($search_value) . '%';

                // create query for get data according to search value list wise
                $query = $wpdb->prepare(
                                        "SELECT `{$subscribers}`.`id`, 
                                                `{$subscribers}`.`email`, 
                                                `{$subscribers}`.`first_name`, 
                                                `{$subscribers}`.`last_name`, 
                                                `{$lists}`.`name` as `lists`,
                                                `{$subscribers_lists}`.`status`,
                                                `{$subscribers}`.`status` as `userstatus`,
                                                `{$subscribers}`.`created_at` 
                                        
                                        FROM `{$subscribers}`, `{$lists}`, `{$subscribers_lists}` 

                                        WHERE `{$subscribers}`.`id` = `{$subscribers_lists}`.`subscriber_id` 
                                            AND `{$subscribers_lists}`.`list_id` = `{$lists}`.`id` 
                                            AND `{$lists}`.`id` = $list_id 
                                            AND `{$subscribers}`.`status` {$operator} %s 
                                            AND (`{$subscribers}`.`email` LIKE %s 
                                                    OR `{$subscribers}`.`first_name` LIKE %s 
                                                    OR `{$subscribers}`.`last_name` LIKE %s 
                                                    OR `{$subscribers}`.`status` LIKE %s 
                                                    OR `{$subscribers_lists}`.`status` LIKE %s 
                                                    OR CAST(`{$subscribers}`.`created_at` AS CHAR) LIKE %s ) 
                                        
                                        ORDER BY `{$order_by}` {$order} 

                                        LIMIT %d OFFSET %d", 'trash', $search, $search, $search, $search, $search,$search, $lengh, $start);
                
                // create query for all data count according to search value list wise

                $original_total = $wpdb->prepare(
                                        "SELECT COUNT(*) as `total`
                                    
                                        FROM `{$subscribers}`, `{$lists}`, `{$subscribers_lists}` 

                                        WHERE `{$subscribers}`.`id` = `{$subscribers_lists}`.`subscriber_id` 
                                            AND `{$subscribers_lists}`.`list_id` = `{$lists}`.`id` 
                                            AND `{$lists}`.`id` = $list_id 
                                            AND `{$subscribers}`.`status` {$operator} %s 
                                            AND (`{$subscribers}`.`email` LIKE %s 
                                                    OR `{$subscribers}`.`first_name` LIKE %s 
                                                    OR `{$subscribers}`.`last_name` LIKE %s 
                                                    OR `{$subscribers}`.`status` LIKE %s 
                                                    OR `{$subscribers_lists}`.`status` LIKE %s 
                                                    OR CAST(`{$subscribers}`.`created_at` AS CHAR) LIKE %s )", 'trash', $search, $search, $search, $search, $search,$search);

            }
        }
        
        $results = $wpdb->get_results($query, ARRAY_A);
        
        $results = is_array($results) ? $results : [];
        // added by soykot
        $original_total = $wpdb->get_var($original_total); //Counting total number of rows trash condition
        $table_total = $wpdb->get_var($table_total); //Counting total number of rows in the subscriber table
        
        return [
            'draw' => $draw,
            'recordsTotal' => $original_total,
            'recordsFiltered' => $original_total, // total number of rows for pagination
            'trashTotal'=> $table_total-$original_total,
            'data' => $results,
            //'depucker' => $xoriginal_total,
        ];
    }

    /**
     * total data count for stats mail function
     *
     * @param int[type] $email_id
     *
     * @return array
     * @since 1.0.0
     */
    public static function get_stats_total_data($email_id)
    {
        global $wpdb;
        $subscribers = $wpdb->prefix . 'elemailer_subscribers';
        $track_mail = $wpdb->prefix . 'elemailer_tracking_mail';
        
        $sent_query = $wpdb->prepare("SELECT COUNT(`{$track_mail}`.`mail_sent`) as total FROM `{$track_mail}` WHERE `{$track_mail}`.`post_id` = %s AND `{$track_mail}`.`mail_sent` > %d", $email_id, 0);
        $total_sent = $wpdb->get_results($sent_query, ARRAY_A);
        
        $open_query = $wpdb->prepare("SELECT COUNT(`{$track_mail}`.`mail_sent`) as total FROM `{$track_mail}` WHERE `{$track_mail}`.`post_id` = %s AND `{$track_mail}`.`mail_open` > %d", $email_id, 0);
        $total_open = $wpdb->get_results($open_query, ARRAY_A);

        return [
            'sent' => isset($total_sent[0]['total'])? $total_sent[0]['total']: '',
            'open' => isset($total_open[0]['total'])? $total_open[0]['total']: '',
        ];

    }

    /**
     * datatable data for stats mail function
     *
     * @param int[type] $id
     * @param array[type] $query_params
     *
     * @return array
     * @since 1.0.0
     */
    public static function get_stats_data_from_db($id, $query_params)
    {
        // get data table query args
        $columns = [
            0 => 'email',
            1 => 'mail_sent',
            2 => 'mail_open',
            3 => 'created_at',
        ];

        $draw = $query_params['draw'];
        $start = $query_params['start'];
        $lengh = $query_params['length'];

        $order= ( empty($query_params['eorderdir']) ) ? 'DESC' : $query_params['eorderdir']; // ASC or DESC 
        
        $order_by = ( empty($query_params['eordercolumn']) ) ? $columns[0] : $columns[$query_params['eordercolumn']];  // in which column

        $search_value = $query_params['esearchvalue'];

        
        global $wpdb;
        $subscribers = $wpdb->prefix . 'elemailer_subscribers';
        $tracking = $wpdb->prefix . 'elemailer_tracking_mail';

        $order_by_table_name = ($query_params['eordercolumn'] == 0)? $subscribers: $tracking;

        $query = $wpdb->prepare("SELECT `{$subscribers}`.`email`, `{$tracking}`.`mail_sent`, `{$tracking}`.`mail_open`, `{$tracking}`.`created_at` FROM `{$tracking}`, `{$subscribers}` WHERE `{$tracking}`.`subscriber_id` = `{$subscribers}`.`id` AND `{$tracking}`.`post_id` = %d ORDER BY `{$order_by_table_name}`.`{$order_by}` {$order} LIMIT %d OFFSET %d", $id, $lengh, $start);

        $cnt_query = $wpdb->prepare("SELECT COUNT(`{$subscribers}`.`email`) as %s, `{$subscribers}`.`email`, `{$tracking}`.`mail_sent`, `{$tracking}`.`mail_open`, `{$tracking}`.`created_at` FROM `{$tracking}`, `{$subscribers}` WHERE `{$tracking}`.`subscriber_id` = `{$subscribers}`.`id` AND `{$tracking}`.`post_id` = %d ORDER BY `{$order_by_table_name}`.`{$order_by}` {$order}", 'total', $id);

        if(!empty($search_value)){
            $search_value = sanitize_text_field($search_value);
            $search = '%' . $wpdb->esc_like($search_value) . '%';

            $query = $wpdb->prepare("SELECT `{$subscribers}`.`email`, 
                                            `{$tracking}`.`mail_sent`, 
                                            `{$tracking}`.`mail_open`, 
                                            `{$tracking}`.`created_at` 
                                    FROM `{$tracking}`, `{$subscribers}` 
                                    WHERE `{$tracking}`.`subscriber_id` = `{$subscribers}`.`id` 
                                    AND `{$tracking}`.`post_id` = %d 
                                    AND ( `{$subscribers}`.`email` LIKE %s 
                                        OR `{$tracking}`.`mail_sent` LIKE %s 
                                        OR `{$tracking}`.`mail_open` LIKE %s 
                                        OR CAST(`{$tracking}`.`created_at` AS CHAR) LIKE %s ) 
                                    ORDER BY `{$order_by_table_name}`.`{$order_by}` {$order} 
                                    LIMIT %d OFFSET %d", $id, $search, $search, $search, $search, $lengh, $start);

            $cnt_query = $wpdb->prepare("SELECT COUNT(`{$subscribers}`.`email`) as %s, 
                                            `{$subscribers}`.`email`, 
                                            `{$tracking}`.`mail_sent`, 
                                            `{$tracking}`.`mail_open`, 
                                            `{$tracking}`.`created_at` 
                                        FROM `{$tracking}`, 
                                             `{$subscribers}`
                                        WHERE `{$tracking}`.`subscriber_id` = `{$subscribers}`.`id` 
                                            AND `{$tracking}`.`post_id` = %d 
                                            AND ( `{$subscribers}`.`email` LIKE %s 
                                                OR `{$tracking}`.`mail_sent` LIKE %s 
                                                OR `{$tracking}`.`mail_open` LIKE %s 
                                                OR CAST(`{$tracking}`.`created_at` AS CHAR) LIKE %s ) 
                                        ORDER BY `{$order_by_table_name}`.`{$order_by}` {$order}", 'total', $id, $search, $search, $search, $search);
        }

        $results = $wpdb->get_results($query, ARRAY_A);

        $results = is_array($results) ? $results : [];

        $total = $wpdb->get_results($cnt_query, ARRAY_A);

        $count = isset($total[0]['total']) ? $total[0]['total'] : 0;

        return [
            'draw' => $draw,
            'recordsTotal' => $count,
            'recordsFiltered' => $count,
            'data' => $results,
        ];

    }
}

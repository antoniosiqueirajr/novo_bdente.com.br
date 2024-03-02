<?php

namespace Elemailer\App\Lists;

defined('ABSPATH') || exit;

use \Elemailer\App\Settings\Action as Settings_Action;
use \Elemailer\Lib\Database\DB;

/**
 * lits create/ update setting related class
 * also used for getting lists settings
 * 
 * @author elEmailer
 * @since 1.0.0
 */
class Action
{
    use \Elemailer\Traits\Singleton;

    private $response;
    private $id;
    private $submitted_data;

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

        $this->global_settings = Settings_Action::instance()->get_global_settings();
    }

    /**
     * lits create/update decision maker function
     *
     * @param int[db_id] $id
     * @param array[info] $submitted_data
     *
     * @return array $response
     * @since 1.0.0
     */
    public function store($id, $submitted_data)
    {
        if (!current_user_can('manage_options')) {
            return;
        }

        $this->id = $id;
        $this->submitted_data = $submitted_data;

        // id 0 for new creation sent from frontend
        if ($this->id == 0) {
            $this->insert();
        } else {
            $this->update();
        }

        return $this->response;
    }

    /**
     * create list function
     *
     * @return void
     * @since 1.0.0
     * Add default support for public list since 3.x
     */
    public function insert()
    {
        $data = [
            'name' => isset($this->submitted_data['list-name']) ? $this->submitted_data['list-name'] : '',
            'description' => isset($this->submitted_data['list-description']) ? $this->submitted_data['list-description'] : '',
            'type' => isset($this->submitted_data['list-type']) ? $this->submitted_data['list-type'] : 'default',
            'status' => 'published',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ];

        $format = [
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
        ];

        $status = DB::insert('elemailer_lists', $data, $format);

        if ($status) {
            $this->response['status'] = 1;
            $this->response['data']['message'] = esc_html__('Successfully added', 'elemailer');
            $this->response['error'] = '';
        } else {
            $this->response['status'] = 0;
            $this->response['data']['message'] = '';
            $this->response['error'] = esc_html__('Not inserted in the database. Try again.', 'elemailer');
        }
    }

    /**
     * update list function
     *
     * @return void
     * @since 1.0.0
     */
    public function update()
    {
        $data = [
            'name' => isset($this->submitted_data['list-name']) ? $this->submitted_data['list-name'] : '',
            'description' => isset($this->submitted_data['list-description']) ? $this->submitted_data['list-description'] : '',
            'type' => isset($this->submitted_data['list-type']) ? $this->submitted_data['list-type'] : '',
            'updated_at' => date("Y-m-d H:i:s"),
        ];

        $format = [
            '%s',
            '%s',
            '%s',
            '%s',
        ];

        $condition = [
            'id' => $this->id,
        ];

        $condition_format = [
            '%d',
        ];

        $status = DB::update('elemailer_lists', $data, $condition, $format, $condition_format);

        if ($status) {
            $this->response['status'] = 1;
            $this->response['data']['message'] = esc_html__('Successfully Updated', 'elemailer');
            $this->response['error'] = '';
        } else {
            $this->response['status'] = 0;
            $this->response['data']['message'] = '';
            $this->response['error'] = esc_html__('Not Updated in the database. Try again.', 'elemailer');
        }
    }

    /**
     * list delete function by id
     *
     * @param int $id
     * @return array[operation_status] $this->response
     * @since 1.0.0
     */
    public function delete($id)
    {
        if (!current_user_can('manage_options')) {
            return;
        }

        $this->id = $id;

        $condition = [
            'id' => $this->id,
        ];

        $format = [
            '%d',
        ];

        // delete list
        $status = DB::delete('elemailer_lists', $condition, $format);

        if ($status) {
            $this->response['status'] = 1;
            $this->response['data']['message'] = esc_html__('Successfully deleted', 'elemailer');
            $this->response['error'] = '';
        } else {
            $this->response['status'] = 0;
            $this->response['data']['message'] = '';
            $this->response['error'] = esc_html__('Not deleted from the database. Try again.', 'elemailer');
        }

        return $this->response;
    }

    /**
     * list status change function by id
     *
     * @param int $id
     * @param array $submitted_data
     * @return array[operation_status] $this->response
     * @since 1.0.0
     */
    public function change_status($id, $submitted_data)
    {
        if (!current_user_can('manage_options')) {
            return;
        }

        $this->id = $id;

        // check change status and prepare data for udpate
        if ($submitted_data['status'] == 'trash') {
            $data = [
                'status' => 'trash',
                'updated_at' => date('y-m-d H:i:s'),
            ];
        } else {
            $data = [
                'status' => 'published',
                'updated_at' => date('y-m-d H:i:s'),
            ];
        }

        $format = [
            '%s',
            '%s',
        ];

        $condition = [
            'id' => $this->id,
        ];

        $condition_format = [
            '%d',
        ];

        $status = DB::update('elemailer_lists', $data, $condition, $format, $condition_format);

        if ($status) {
            $this->response['status'] = 1;
            $this->response['data']['message'] = esc_html__('Successfully deleted', 'elemailer');
            $this->response['error'] = '';
        } else {
            $this->response['status'] = 0;
            $this->response['data']['message'] = '';
            $this->response['error'] = esc_html__('Not deleted from the database. Try again.', 'elemailer');
        }

        return $this->response;
    }

    /**
     * multiple marked lists status change function
     *
     * @param string[status] $status
     * @param array[selected_ids] $selected
     * @return array[operation_status] $this->response
     * @since 1.0.0
     */
    public function change_status_multiple($status, $selected)
    {
        foreach ($selected as $select) {
            // call delete function during delete
            if ($status == 'delete') {
                $this->delete($select);
            } else {
                // call change function for changing status
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
     * get all published lists function
     *
     * @return array
     * @since 1.0.0
     */
    public function get_all_published_list($query)
    {
        return DB::get_lists_for_data_table($query, false);
    }

    /**
     * get all trashed lists function
     *
     * @return array
     * @since 1.0.0
     */
    public function get_all_trash_list($query)
    {
        return DB::get_lists_for_data_table($query, true);
    }

    /**
     * format lists data for select option id => name function
     *
     * @param [array] $lists
     * @return array $formated_lists
     * @since 1.0.0
     */
    public function format_lists_for_option($lists = null)
    {
        $formated_lists = [];

        $condition = [
            'status' => 'published',
        ];

        $tmp_lists = $lists = DB::get_all_data_table_with_various_condition('elemailer_lists', $condition);

        if ($lists != null) {
            $tmp_lists = $lists;
        }

        foreach ($tmp_lists as $key => $value) {
            $formated_lists[$value['id']] = $value['name'];
        }

        return $formated_lists;
    }

     /**
     * format lists data  with extra option public/private for select option id => type 
     *
     * @param [array] $lists
     * @return array $formated_lists
     * @since 3.3
     */
    public function format_lists_for_option_and_type($lists = null)
    {
        $formated_lists = [];

        $condition = [
            'status' => 'published',
        ];

        $tmp_lists = $lists = DB::get_all_data_table_with_various_condition('elemailer_lists', $condition);

        if ($lists != null) {
            $tmp_lists = $lists;
        }

        foreach ($tmp_lists as $key => $value) {
            $formated_lists[$value['id']] = $value['type'];
        }

        return $formated_lists;
    }
}

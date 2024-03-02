<?php

namespace Elemailer\App\Lists;

defined('ABSPATH') || exit;

/**
 * rest api initialization class
 * is this class every method will be a rest api
 * 
 * @author elEmailer
 * @since 1.0.0
 */
class Api extends \Elemailer\Core\Api
{
    /**
     * rest api prefix and parameter set function
     *
     * @return void
     * @since 1.0.0
     */
    public function config()
    {
        $this->prefix = 'lists';
        $this->param  = "/(?P<id>\w+)";
    }

    /**
     * create/update lists rest api callback function
     * make a rest api with method
     *
     * @return array
     * @since 1.0.0
     */
    public function post_update()
    {
        $id = $this->request['id'];
        $submitted_data = $this->request->get_params();

        $status = Action::instance()->store($id, $submitted_data);

        $admin_url = admin_url('admin.php');

        $status['redirect_url'] = $admin_url . '?page=elemailer-lists&action=list';

        return $status;
    }

    /**
     * delete lists rest api callback function
     * make a rest api with method
     *
     * @return array
     * @since 1.0.0
     */
    public function post_delete()
    {
        $id = $this->request['id'];

        return Action::instance()->delete($id);
    }

    /**
     * change status of lists rest api callback function
     * make a rest api with method
     *
     * @return array
     * @since 1.0.0
     */
    public function post_change_status()
    {
        $id = $this->request['id'];
        $submitted_data = $this->request->get_params();

        return Action::instance()->change_status($id, $submitted_data);
    }

    /**
     * multiple marked lists change status rest api callback function
     * make a rest api with method
     *
     * @return array
     * @since 1.0.0
     */
    public function post_change_status_multiple()
    {
        $status = $this->request['id'];
        $submitted_data = $this->request->get_params();
        $selected = (isset($submitted_data['selected']) ? $submitted_data['selected'] : []);
        return Action::instance()->change_status_multiple($status, $selected);
    }

    /**
     * get all published lists rest api callback function
     * make a rest api with method
     *
     * @return array
     * @since 1.0.0
     */
    public function get_get_all_list()
    {
        $id = $this->request['id'];
        $query = $this->request->get_params();

        return Action::instance()->get_all_published_list($query);
    }

    /**
     * get all trashed lists rest api callback function
     * make a rest api with method
     *
     * @return array
     * @since 1.0.0
     */
    public function get_get_trash_list()
    {
        $id = $this->request['id'];
        $query = $this->request->get_params();

        return Action::instance()->get_all_trash_list($query);
    }
}

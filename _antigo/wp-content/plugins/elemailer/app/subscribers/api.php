<?php

namespace Elemailer\App\Subscribers;

defined('ABSPATH') || exit;

use \Elemailer\Helpers\Util;

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
        $this->prefix = 'subscribers';
        $this->param  = "/(?P<id>\w+)";
    }

    /**
     * create/ update subscriber info rest api callback function
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

        $status['redirect_url'] = $admin_url . '?page=elemailer-subscribers&action=list';

        return $status;
    }

    /**
     * delete subscriber rest api callback function
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
     * change subscriber status rest api callback function
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
     * change multiple marked subscriber status rest api callback function
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
     * get all published subscribers rest api callback function
     * make a rest api with this method
     *
     * @return void
     * @since 1.0.0
     */
    public function get_get_all_subscribers()
    {
        $id = $this->request['id'];
        $query = $this->request->get_params();

        return Action::instance()->get_all_published_subscribers($query);
    }

    /**
     * get all trashed subscribers rest api callback function
     * make a rest api with this method
     *
     * @return void
     * @since 1.0.0
     */
    public function get_get_trash_subscribers()
    {
        $id = $this->request['id'];
        $query = $this->request->get_params();

        return Action::instance()->get_all_trash_subscribers($query);
    }
}

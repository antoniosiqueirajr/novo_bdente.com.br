<?php

namespace Elemailer\App\Emails;

defined('ABSPATH') || exit;

/**
 * rest api initialization class
 * is this class every method will a rest api
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
        $this->prefix = 'emails';
        $this->param  = "/(?P<id>\w+)";
    }

    /**
     * create/update email template rest api callback function
     * make a rest api with method
     *
     * @return array
     * @since 1.0.0
     */
    public function post_update()
    {
        $id = $this->request['id'];
        $submitted_data = $this->request->get_params();

        return Action::instance()->store($id, $submitted_data);
    }

    /**
     * create/update email settings rest api callback function
     * make a rest api with method
     *
     * @return array
     * @since 1.0.0
     */
    public function post_settings_update()
    {
        $id = $this->request['id'];
        $submitted_data = $this->request->get_params();

        return Action::instance()->settings_update($id, $submitted_data);
    }

    /**
     * delete email template rest api callback function
     * make a rest api with method
     *
     * @return array
     * @since 1.0.0
     */
    public function post_delete()
    {
        $id = $this->request['id'];
        $submitted_data = $this->request->get_params();

        return Action::instance()->delete($id);
    }

    /**
     * change email template status rest api callback function
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
     * marked email template status change rest api callback function
     * make a rest api with method
     * 
     * @return array
     * @since 1.0.0
     */
    public function post_change_status_multiple(){
        $status = $this->request['id'];
        $submitted_data = $this->request->get_params();
        $selected = (isset($submitted_data['selected'])? $submitted_data['selected']: []);
        return Action::instance()->change_status_multiple($status, $selected);
    }

    /**
     * get all email rest api callback function
     * make a rest api with method
     *
     * @return array
     * @since 1.0.0
     */
    public function get_get_all_emails()
    {
        $type = $this->request['id'];
        $query = $this->request->get_params();

        return Action::instance()->get_all_published_emails($query, $type);
    }

    /**
     * get trash email rest api callback function
     * make a rest api with method
     *
     * @return array
     * @since 1.0.0
     */
    public function get_get_trash_emails()
    {
        $type = $this->request['id'];
        $query = $this->request->get_params();
        
        return Action::instance()->get_all_trash_emails($query, $type);
    }

    /**
     * update track mail info rest api callback function
     * make a rest api with method
     *
     * @return int
     * @since 1.0.0
     */
    public function get_track_mail(){
        $event = $this->request['id'];
        $params = $this->request->get_params();

        return Action::instance()->track_mail($event, $params);
    }

    /**
     * call datatable data for showing stats data function
     *
     * @return array
     * @since 1.0.0
     */
    public function get_stats_data()
    {
        $id = $this->request['id'];
        $params = $this->request->get_params();
        return Action::instance()->get_stats_datatable($id, $params);
    }
}
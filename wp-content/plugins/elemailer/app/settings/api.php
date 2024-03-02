<?php

namespace Elemailer\App\Settings;

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
        $this->prefix = 'settings';
        $this->param  = "/(?P<id>\w+)";
    }

    /**
     * store/ update global settings rest api callback function
     * make a rest api with method
     *
     * @return array
     * @since 1.0.0
     */
    public function post_insert()
    {
        $action = $this->request['id'];
        $settings_data = $this->request->get_params();

        return Action::instance()->store($action, $settings_data);
    }

    /**
     * get permalink for redirection pages rest api callback function
     * currently used for global settings previews pages show
     *
     * @return string[url]
     * @since 1.0.0
     */
    public function get_preview_page_link()
    {
        $id = $this->request['id'];
        $params = $this->request->get_params();

        return Action::instance()->get_page_permalink($id, $params);
    }
}

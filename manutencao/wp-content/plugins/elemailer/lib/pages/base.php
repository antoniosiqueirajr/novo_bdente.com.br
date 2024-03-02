<?php

namespace Elemailer\Lib\Pages;

defined('ABSPATH') || exit;

/**
 * elemailer_page related base class for initialization
 * 
 * @author elEmailer
 * @since 1.0.0
 */
class Base
{

    use \Elemailer\Traits\Singleton;

    /**
     * initialization of elemailer_page related everything function
     *
     * @return void
     * @since 1.0.0
     */
    public function init()
    {
        $params = $this->get_params();
        Action::instance()->show_specific_page($params);
    }

    /**
     * get all url params function
     *
     * @return array
     * @since 1.0.0
     */
    public function get_params()
    {
        global $wp;
        $current_url = home_url(add_query_arg(array($_GET), $wp->request));
        parse_str(parse_url($current_url, PHP_URL_QUERY), $url_params);
        return $url_params;
    }

    /**
     * get current screen url function
     *
     * @return string
     * @since 1.0.0
     */
    public function get_current_url($id)
    {
        if ($id == 'elemailer_page') {
            return add_query_arg(array($_GET), home_url());
        } else {
            return add_query_arg(array($_GET), get_permalink($id));
        }


    }
}

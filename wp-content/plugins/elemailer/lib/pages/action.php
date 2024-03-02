<?php

namespace Elemailer\Lib\Pages;

defined('ABSPATH') || exit;

/**
 * elemailer_page related action class for handling everything related on page
 *  
 * @author elEmailer
 * @since 1.0.0
 */
class Action
{

    use \Elemailer\Traits\Singleton;

    private $url_params;

    /**
     * show specific page decider function
     *
     * @param array[type] $args
     *
     * @return void
     * @since 1.0.0
     */
    public function show_specific_page($args)
    {
        $this->url_params = $args;
        // theme template with our plugin template for elemailer_page
        // fix added @since v1.8 for solving issue with different kind of homepages when used elemailer page option in settings. 
        if(isset($this->url_params['elemailer_route'])){
			add_filter('template_include', [$this, 'elemailer_page_template'],99);
		}else{
			add_filter('frontpage_template', [$this, 'elemailer_page_template']);
		}
        
    }

    /**
     * show specific page template for elemailer_page function
     *
     * @param string[type] $template
     *
     * @return string
     * @since 1.0.0
     */
    public function elemailer_page_template($template)
    {
        // elemailer_page check and page type check
        if(isset($this->url_params['elemailer_page']) && $this->url_params['elemailer_page'] == 'subscriptions'){
            $folder = dirname( __FILE__ ) . '/subscribers';
            if(isset($this->url_params['elemailer_status']) && $this->url_params['elemailer_status'] == 'user_confirmation'){
                if(isset($this->url_params['action']) && ($this->url_params['action'] == 'subscribed') && isset($this->url_params['data'])){
                    // call subscribed page
                    return $folder. '/subscribed.php';
                }else if (isset($this->url_params['action']) && ($this->url_params['action'] == 'manage_subscription') && isset($this->url_params['data'])){
                    // call manage subscribtion page
                    return $folder. '/manage-subscription.php';
                }
            }
        }else if (isset($this->url_params['elemailer_page']) && $this->url_params['elemailer_page'] == 'unsubscriptions'){
            $folder = dirname( __FILE__ ) . '/unsubscribers';
            if(isset($this->url_params['elemailer_status']) && $this->url_params['elemailer_status'] == 'user_confirmation'){
                if(isset($this->url_params['action']) && ($this->url_params['action'] == 'unsubscribe') && isset($this->url_params['data'])){
                    // call subscribed page
                    return $folder. '/unsubscribed.php';
                }else if (isset($this->url_params['action']) && ($this->url_params['action'] == 'manage_unsubscription') && isset($this->url_params['data'])){
                    // call manage subscribtion page
                    return $folder. '/manage-unsubscription.php';
                }
            }
        }else{
            return $template;
        }

    }
}

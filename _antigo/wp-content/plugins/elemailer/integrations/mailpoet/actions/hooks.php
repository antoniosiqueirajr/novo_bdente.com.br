<?php

namespace Elemailer\Integrations\Mailpoet\Actions;

defined('ABSPATH') || exit;

/**
 * mailpoet hooks related class
 *
 * @author elEmailer 
 * @since 1.0.0
 */
class Hooks
{
    use \Elemailer\Traits\Singleton;

    /**
     * inilial class for mailpoet hooks function
     *
     * @return void
     * @since 1.0.0
     */
    public function init()
    {
        // filter to override mailpoet template with our own
        add_filter('mailpoet_newsletter_shortcode', [$this, 'custom_shortcode'], 10, 5);
    }

    /**
     * custom shortcode for mailpoet to override mailpoet template function
     *
     * @param string[shortcode] $shortcode
     * @param [type] $newsletter
     * @param [type] $subscriber
     * @param [type] $queue
     * @param [type] $newsletter_body
     * @return string[html] $html
     * @since 1.0.0
     */
    public function custom_shortcode($shortcode, $newsletter, $subscriber, $queue, $newsletter_body)
    {

        $status = preg_match_all('(\[elemailer:id="[0-9]+"])', $shortcode, $data, PREG_SET_ORDER);
        $match = isset($data[0][0]) ? $data[0][0] : false;
        $id = rtrim(ltrim($match, '[elemailer:id="'), '"]');

        // always return the shortcode if it doesn't match your own!
        if (!$status) return $shortcode;

        $void_email_template_body = \Elemailer\Helpers\Util::get_template_content($id);
        $html = \Elemailer\Helpers\Util::get_email_html_template($id, $void_email_template_body);

        return $html;
    }
}

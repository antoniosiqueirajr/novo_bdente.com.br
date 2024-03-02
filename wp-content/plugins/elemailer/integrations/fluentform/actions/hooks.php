<?php

namespace Elemailer\Integrations\Fluentform\Actions;
use FluentForm\App\Services\FormBuilder\ShortCodeParser;

defined('ABSPATH') || exit;

/**
 * Fluent form hooks related class
 * We will add section in page and also replace Fluent form email content with our html rendered content
 * @author elEmailer 
 * @since x.x.x
 */
class Hooks {

    use \Elemailer\Traits\Singleton;

    /**
     * Inilial class for Fluent form hooks function
     *  
     * @return void
     * @since x.x.x
     */
    public function init() {
        add_filter( 'fluentform_email_body', [ $this, 'modify_email_body' ], 99, 4 );
    }

    /**
     * Modify email body
     *  
     * @return void
     * @since x.x.x
     */
    public function modify_email_body( $emailBody, $notification, $submittedData, $form ) {
        $status = preg_match_all('(\[elemailer:id="[0-9]+"])', $emailBody, $data, PREG_SET_ORDER);

        if ( ! $status ) return $emailBody; // return earyl if not our shortcode
        
        $id = isset($data[0][0]) ? $data[0][0] : false;
        $id = (int) filter_var($id , FILTER_SANITIZE_NUMBER_INT); // new got our template id

        $message = \Elemailer\Helpers\Util::get_template_content( $id );
        $message = \Elemailer\Helpers\Util::get_email_html_template( $id, $message );

         $message = ShortCodeParser::parse(
                $message,
                0,
                $submittedData,
                $form,
                false,
                true
            );
        return $message;
    }

}

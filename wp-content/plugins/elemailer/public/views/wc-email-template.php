<?php

// Store the order to be used in the widget
if ( isset( $order ) ) {
    $_REQUEST['order'] = $order;
}

$html = \Elemailer\Helpers\Util::get_template_content($_REQUEST['template_id']);
$html = \Elemailer\Helpers\Util::get_email_html_template($_REQUEST['template_id'], $html);

echo $html;
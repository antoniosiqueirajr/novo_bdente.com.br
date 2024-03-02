<?php
get_header();
$url_params = Elemailer\Lib\Pages\Base::instance()->get_params();

$action = (isset($url_params['action']) ? $url_params['action'] : '');
$token = (isset($url_params['data']) ? $url_params['data'] : '');
?>

<div id="primary" class="content-area primary">
    <main id="main" class="site-main">
        <div class="elemailer-page-wrapper">
            <h2><?php esc_html_e( 'Unsubscription Successful!', 'elemailer' ); ?></h2>
            <p><?php esc_html_e( 'You have successfully unsubscribed from the deselected list(s).', 'elemailer' ); ?></p>
        </div>
    </main>
</div>

<?php get_footer(); ?>
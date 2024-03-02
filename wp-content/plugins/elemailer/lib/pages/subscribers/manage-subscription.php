<?php
get_header();

$url_params = Elemailer\Lib\Pages\Base::instance()->get_params();
// DD($url_params);

$action = (isset($url_params['action']) ? $url_params['action'] : '');
$token = (isset($url_params['data']) ? $url_params['data'] : '');

//$status = \Elemailer\App\Subscribers\Action::instance()->confirm_subscribtion($action, $token);
$status = 'none';

?>
<div id="primary" class="content-area primary">
    <main id="main" class="site-main">
        <div class="elemailer-page-wrapper">
            <h2><?php echo esc_html_e('Manage your subscriptions.', 'elemailer'); ?></h2>
            <?php echo do_shortcode("[elemailer_manage_subscription_page]"); ?>
        </div>
    </main>
</div>

<?php get_footer(); ?>
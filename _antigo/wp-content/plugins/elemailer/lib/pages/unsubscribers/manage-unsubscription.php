<?php get_header(); ?>

<div id="primary" class="content-area primary">
    <main id="main" class="site-main">
        <div class="elemailer-page-wrapper">
            <h2><?php esc_html_e( 'Unsubscribe', 'elemailer' ); ?></h2>
            <p><?php esc_html_e( 'Deselect List(s) to unsubscribe your Email.', 'elemailer' ); ?></p>
            <?php echo do_shortcode("[elemailer_unsubscribe_page]");?>
        </div>
    </main>
</div>

<?php get_footer(); ?>
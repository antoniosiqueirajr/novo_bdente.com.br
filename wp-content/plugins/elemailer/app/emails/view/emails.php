<div class="wrap">
    
    <?php
    use \Elemailer\App\Emails\Action as Emails_Action;
    $dashboad = get_dashboard_url();
    $create = $dashboad.'admin.php?page=elemailer-emails&action=create';
    ?>
    <div class="elemailer-dashboard-head">
        <h1><?php esc_html_e('Emails:', 'elemailer'); ?></h1>
        <a class="edh-btn" href="<?php echo esc_url($create); ?>"><?php esc_html_e('Add New', 'elemailer'); ?></a>
    </div>

    <?php

        $action = isset($_GET['action'])? $_GET['action']: 'list';
        $page = isset($_GET['page'])? $_GET['page']: '';
        $templ_id = isset($_GET['email_id'])? $_GET['email_id']: '';
        $opt_val = get_option( 'elemailer_cron_starter' . $templ_id );
        $email_type = Emails_Action::instance()->get_term_by_id($templ_id);
        // conditional template call
        if( $page == 'elemailer-emails' && $action == 'create'){
            include 'template-parts/create-mail.php';
        }else if( $page == 'elemailer-emails' && $action == 'pause'){
            if( $opt_val == 0 ){
                //pause cron
                update_option('elemailer_cron_starter' . $templ_id, 2 );
            }else if( $opt_val == 3 ){
                //resume/restart cron
                update_option('elemailer_cron_starter' . $templ_id, 1 );
            }
            //wp_redirect( admin_url() . 'admin.php?page=elemailer-emails' );
            wp_redirect( wp_get_referer() .'#'.$email_type );
        }else if( $page == 'elemailer-emails' && $action == 'stop'){
            //stop cron
            update_option('elemailer_cron_starter' . $templ_id, 4 );
            //include 'template-parts/list-mail.php';
            wp_redirect( wp_get_referer() .'#'.$email_type );
        }else if( $page == 'elemailer-emails' && $action == 'stats'){
            include 'template-parts/stats-mail.php';
        }else if( $page == 'elemailer-emails' && $action == 'list'){
            include 'template-parts/list-mail.php';
        }

    ?>
</div>
<div class="wrap">
    
    <?php
    $dashboad = get_dashboard_url();
    $create = $dashboad.'admin.php?page=elemailer-lists&action=create';
    ?>
    <div class="elemailer-dashboard-head">
        <h1><?php esc_html_e('Lists:', 'elemailer'); ?></h1>
        <a class="edh-btn" href="<?php echo esc_url($create); ?>"><?php esc_html_e('Add New', 'elemailer'); ?></a>
    </div>

    <?php

        $action = isset($_GET['action'])? $_GET['action']: 'list';
        $page = isset($_GET['page'])? $_GET['page']: '';

        // conditional template call
        if( $page == 'elemailer-lists' && $action == 'create'){
            include 'template-parts/create-lists.php';
        }else if( $page == 'elemailer-lists' && $action == 'list'){
            include 'template-parts/list-lists.php';
        }

    ?>
</div>
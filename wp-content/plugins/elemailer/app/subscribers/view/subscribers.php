<div class="wrap">

    <?php
    $dashboad = get_dashboard_url();
    $create = $dashboad . 'admin.php?page=elemailer-subscribers&action=create';
    $import = $dashboad . 'admin.php?page=elemailer-subscribers&action=create&import=true';
    ?>
    <div class="elemailer-dashboard-head">
        <h1><?php esc_html_e('Subscribers:', 'elemailer'); ?></h1>
        <a class="edh-btn" href="<?php echo esc_url($create); ?>"><?php esc_html_e('Add New', 'elemailer'); ?></a>
        <a class="edh-btn" href="<?php echo esc_url($import); ?>"><?php esc_html_e('Import', 'elemailer'); ?></a>
    </div>

    <?php

    $action = isset($_GET['action']) ? $_GET['action'] : 'list';
    $page = isset($_GET['page']) ? $_GET['page'] : '';

    // conditional template call
    if ($page == 'elemailer-subscribers' && $action == 'create') {
        include 'template-parts/create-subscribers.php';
    } else if ($page == 'elemailer-subscribers' && $action == 'list') {
        include 'template-parts/list-subscribers.php';
    }

    ?>
</div>
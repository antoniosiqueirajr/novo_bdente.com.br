<div class="wrap elemail-wrap">
    <div class="preloader" style="background-image: url(<?php echo ELE_MAILER_PLUGIN_PUBLIC . '/assets/img/step-loader.gif' ?>);"></div>
    <div class="elemail-list-area">
        <div class="ela-nav-tab">
            <ul>
                <li class="newsletter-tab active"><a href="#newsletter"><?php esc_html_e('Newsletter', 'elemailer'); ?></a></li>
                <li class="welcomeemail-tab"><a href="#welcomeemail"><?php esc_html_e('Welcome Email', 'elemailer'); ?></a></li>
                <li class="postnotification-tab"><a href="#postnotification"><?php esc_html_e('Post Notification', 'elemailer'); ?></a></li>
                <?php if ( elemailer_has_woocommerce() ) : ?>
                    <li class="woocommerceemail-tab"><a href="#woocommerceemail"><?php esc_html_e('WooCommerce Email', 'elemailer'); ?></a></li>
                <?php endif; ?>
            </ul>
        </div>
        <div class="ela-tab-content">
            <div id="newsletter" class="elat-content-box">
                <div class="ele-data-table-area">
                    <div class="elat-filter-nav">
                        <ul class="elat-filter-btn">
                            <li><a href="#all" id="eleNewsLetterAll" class="allEleList"><?php esc_html_e('All', 'elemailer'); ?><span class="count"></span></a></li>
                            <li><a href="#trash" id="eleNewsLetterTrash" class="trashNav"><?php esc_html_e('Trash', 'elemailer'); ?><span class="count"></span></a></li>
                            <li>
                                <div class="moveTrashSelected hide">
                                    <a href="#delete" class="moveToTrash"><?php esc_html_e('Trash', 'elemailer'); ?></a>
                                </div>
                            </li>
                            <li>
                                <div class="deleteSelected hide">
                                    <a href="#" class="deleteSelected"><?php esc_html_e('Delete', 'elemailer'); ?></a>
                                </div>
                            </li>
                            <li>
                                <div class="moveToPublishedSelected hide">
                                    <a href="#" class="moveToPublished"><?php esc_html_e('Restore', 'elemailer'); ?></a>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="etable-area">
                        <span class="check_all_header">
                            <input class="allCheckBtn" type="checkbox" name="allCheckBtn" id="">
                        </span>
                        <table class="elelist_dataTable" id="newsletter_dataTable" class="display" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th class="pointer_events_none"><?php esc_html_e('', 'elemailer'); ?></th>
                                    <th><?php esc_html_e('Email Title', 'elemailer'); ?></th>
                                    <th><?php esc_html_e('Subject', 'elemailer'); ?></th>
                                    <th><?php esc_html_e('Status', 'elemailer'); ?></th>
                                    <th><?php esc_html_e('Lists', 'elemailer'); ?></th>
                                    <th><?php esc_html_e('Set On', 'elemailer'); ?></th>
                                    <th><?php esc_html_e('Shortcode', 'elemailer'); ?></th>
                                    <th><?php esc_html_e('Created At', 'elemailer'); ?></th>
                                    <!-- <th><?php esc_html_e('Action', 'elemailer'); ?></th> -->
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th class="pointer_events_none"><?php esc_html_e('', 'elemailer'); ?></th>
                                    <th><?php esc_html_e('Email Title', 'elemailer'); ?></th>
                                    <th><?php esc_html_e('Subject', 'elemailer'); ?></th>
                                    <th><?php esc_html_e('Status', 'elemailer'); ?></th>
                                    <th><?php esc_html_e('Lists', 'elemailer'); ?></th>
                                    <th><?php esc_html_e('Set On', 'elemailer'); ?></th>
                                    <th><?php esc_html_e('Shortcode', 'elemailer'); ?></th>
                                    <th><?php esc_html_e('Created At', 'elemailer'); ?></th>
                                    <!-- <th><?php esc_html_e('Action', 'elemailer'); ?></th> -->
                                </tr>
                            </tfoot>
                        </table>
                        <span class="check_all_footer">
                            <input class="allCheckBtn" type="checkbox" name="" id="">
                        </span>
                    </div>
                </div>
            </div>
            <div id="welcomeemail" class="elat-content-box hide">
                <div class="ele-data-table-area">
                    <div class="elat-filter-nav">
                        <ul class="elat-filter-btn">
                            <li><a href="#all" id="eleWelcomeEmailAll" class="allEleList"><?php esc_html_e('All', 'elemailer'); ?><span class="count"></span></a></li>
                            <li><a href="#trash" id="eleWelcomeEmailTrash" class="trashNav"><?php esc_html_e('Trash', 'elemailer'); ?><span class="count"></span></a></li>
                            <li>
                                <div class="moveTrashSelected hide">
                                    <a href="#delete" class="moveToTrash"><?php esc_html_e('Trash', 'elemailer'); ?></a>
                                </div>
                            </li>
                            <li>
                                <div class="deleteSelected hide">
                                    <a href="#" class="deleteSelected"><?php esc_html_e('Delete', 'elemailer'); ?></a>
                                </div>
                            </li>
                            <li>
                                <div class="moveToPublishedSelected hide">
                                    <a href="#" class="moveToPublished"><?php esc_html_e('Restore', 'elemailer'); ?></a>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="etable-area">
                        <span class="check_all_header">
                            <input class="allCheckBtn" type="checkbox" name="allCheckBtn" id="">
                        </span>
                        <table class="elelist_dataTable" id="welcomeemail_dataTable" class="display" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th><?php esc_html_e('ID', 'elemailer'); ?></th>
                                    <th><?php esc_html_e('Email Title', 'elemailer'); ?></th>
                                    <th><?php esc_html_e('Subject', 'elemailer'); ?></th>
                                    <th><?php esc_html_e('Status', 'elemailer'); ?></th>
                                    <th><?php esc_html_e('Event', 'elemailer'); ?></th>
                                    <th><?php esc_html_e('Type/ Lists', 'elemailer'); ?></th>
                                    <th><?php esc_html_e('Shortcode', 'elemailer'); ?></th>
                                    <th><?php esc_html_e('Created At', 'elemailer'); ?></th>
                                    <!-- <th><?php esc_html_e('Action', 'elemailer'); ?></th> -->
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th><?php esc_html_e('ID', 'elemailer'); ?></th>
                                    <th><?php esc_html_e('Email Title', 'elemailer'); ?></th>
                                    <th><?php esc_html_e('Subject', 'elemailer'); ?></th>
                                    <th><?php esc_html_e('Status', 'elemailer'); ?></th>
                                    <th><?php esc_html_e('Event', 'elemailer'); ?></th>
                                    <th><?php esc_html_e('Type/ Lists', 'elemailer'); ?></th>
                                    <th><?php esc_html_e('Shortcode', 'elemailer'); ?></th>
                                    <th><?php esc_html_e('Created At', 'elemailer'); ?></th>
                                    <!-- <th><?php esc_html_e('Action', 'elemailer'); ?></th> -->
                                </tr>
                            </tfoot>
                        </table>
                        <span class="check_all_footer">
                            <input class="allCheckBtn" type="checkbox" name="" id="">
                        </span>
                    </div>
                </div>
            </div>
            <div id="postnotification" class="elat-content-box hide">
                <div class="ele-data-table-area">
                    <div class="elat-filter-nav">
                        <ul class="elat-filter-btn">
                            <li><a href="#all" id="elePostNotificationAll" class="allEleList"><?php esc_html_e('All', 'elemailer'); ?><span class="count"></span></a></li>
                            <li><a href="#trash" id="elePostNotificationTrash" class="trashNav"><?php esc_html_e('Trash', 'elemailer'); ?><span class="count"></span></a></li>
                            <li>
                                <div class="moveTrashSelected hide">
                                    <a href="#delete" class="moveToTrash"><?php esc_html_e('Trash', 'elemailer'); ?></a>
                                </div>
                            </li>
                            <li>
                                <div class="deleteSelected hide">
                                    <a href="#" class="deleteSelected"><?php esc_html_e('Delete', 'elemailer'); ?></a>
                                </div>
                            </li>
                            <li>
                                <div class="moveToPublishedSelected hide">
                                    <a href="#" class="moveToPublished"><?php esc_html_e('Restore', 'elemailer'); ?></a>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="etable-area">
                        <span class="check_all_header">
                            <input class="allCheckBtn" type="checkbox" name="allCheckBtn" id="">
                        </span>
                        <table class="elelist_dataTable" id="postnotification_dataTable" class="display" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th><?php esc_html_e('ID', 'elemailer'); ?></th>
                                    <th><?php esc_html_e('Email Title', 'elemailer'); ?></th>
                                    <th><?php esc_html_e('Subject', 'elemailer'); ?></th>
                                    <th><?php esc_html_e('Status', 'elemailer'); ?></th>
                                    <th><?php esc_html_e('Lists', 'elemailer'); ?></th>
                                    <th><?php esc_html_e('Set On', 'elemailer'); ?></th>
                                    <th><?php esc_html_e('Shortcode', 'elemailer'); ?></th>
                                    <th><?php esc_html_e('Created At', 'elemailer'); ?></th>
                                    <!-- <th><?php esc_html_e('Action', 'elemailer'); ?></th> -->
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th><?php esc_html_e('ID', 'elemailer'); ?></th>
                                    <th><?php esc_html_e('Email Title', 'elemailer'); ?></th>
                                    <th><?php esc_html_e('Subject', 'elemailer'); ?></th>
                                    <th><?php esc_html_e('Status', 'elemailer'); ?></th>
                                    <th><?php esc_html_e('Lists', 'elemailer'); ?></th>
                                    <th><?php esc_html_e('Set On', 'elemailer'); ?></th>
                                    <th><?php esc_html_e('Shortcode', 'elemailer'); ?></th>
                                    <th><?php esc_html_e('Created At', 'elemailer'); ?></th>
                                    <!-- <th><?php esc_html_e('Action', 'elemailer'); ?></th> -->
                                </tr>
                            </tfoot>
                        </table>
                        <span class="check_all_footer">
                            <input class="allCheckBtn" type="checkbox" name="" id="">
                        </span>
                    </div>
                </div>
            </div>
            <?php if ( elemailer_has_woocommerce() ) : ?>
                <div id="woocommerceemail" class="elat-content-box hide">
                    <div class="ele-data-table-area">
                        <div class="elat-filter-nav">
                            <ul class="elat-filter-btn">
                                <li><a href="#all" id="elewoocommerceemailAll" class="allEleList"><?php esc_html_e('All', 'elemailer'); ?><span class="count"></span></a></li>
                                <li><a href="#trash" id="elewoocommerceemailTrash" class="trashNav"><?php esc_html_e('Trash', 'elemailer'); ?><span class="count"></span></a></li>
                                <li>
                                    <div class="moveTrashSelected hide">
                                        <a href="#delete" class="moveToTrash"><?php esc_html_e('Trash', 'elemailer'); ?></a>
                                    </div>
                                </li>
                                <li>
                                    <div class="deleteSelected hide">
                                        <a href="#" class="deleteSelected"><?php esc_html_e('Delete', 'elemailer'); ?></a>
                                    </div>
                                </li>
                                <li>
                                    <div class="moveToPublishedSelected hide">
                                        <a href="#" class="moveToPublished"><?php esc_html_e('Restore', 'elemailer'); ?></a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="etable-area">
                            <span class="check_all_header">
                                <input class="allCheckBtn" type="checkbox" name="allCheckBtn" id="">
                            </span>
                            <table class="display elelist_dataTable" id="woocommerceemail_dataTable" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th data-priority="1"><?php esc_html_e('ID', 'elemailer'); ?></th>
                                        <th data-priority="1"><?php esc_html_e('Template Title', 'elemailer'); ?></th>
                                        <th data-priority="1"><?php esc_html_e('Email Subject', 'elemailer'); ?></th>
                                        <th data-priority="1"><?php esc_html_e('Status', 'elemailer'); ?></th>
                                        <th data-priority="1"><?php esc_html_e('Email', 'elemailer'); ?></th>
                                        <th data-priority="1"><?php esc_html_e('Recipient', 'elemailer'); ?></th>
                                        <th data-priority="1"><?php esc_html_e('Condition', 'elemailer'); ?></th>
                                        <th class="none" data-priority="2"><?php esc_html_e('Shortcode', 'elemailer'); ?></th>
                                        <th data-priority="1"><?php esc_html_e('Created At', 'elemailer'); ?></th>
                                        <!-- <th><?php esc_html_e('Action', 'elemailer'); ?></th> -->
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th><?php esc_html_e('ID', 'elemailer'); ?></th>
                                        <th><?php esc_html_e('Template Title', 'elemailer'); ?></th>
                                        <th><?php esc_html_e('Email Subject', 'elemailer'); ?></th>
                                        <th><?php esc_html_e('Status', 'elemailer'); ?></th>
                                        <th><?php esc_html_e('Email', 'elemailer'); ?></th>
                                        <th><?php esc_html_e('Recipient', 'elemailer'); ?></th>
                                        <th><?php esc_html_e('Condition', 'elemailer'); ?></th>
                                        <th><?php esc_html_e('Shortcode', 'elemailer'); ?></th>
                                        <th><?php esc_html_e('Created At', 'elemailer'); ?></th>
                                        <!-- <th><?php esc_html_e('Action', 'elemailer'); ?></th> -->
                                    </tr>
                                </tfoot>
                            </table>
                            <span class="check_all_footer">
                                <input class="allCheckBtn" type="checkbox" name="" id="">
                            </span>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
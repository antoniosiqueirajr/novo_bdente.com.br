<?php 
$list_id = '';
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['list_id'])) {
    $list_id = $_GET['list_id'];
}

?>
<div class="wrap elemail-wrap">
    <div class="elemail-list-area">
        <div class="ela-tab-content">
            <div class="ele-data-table-area">
                <div class="elat-filter-nav">
                    <ul class="elat-filter-btn">
                        <li><a href="#all" id="eleListAll" class="allEleList"><?php esc_html_e('All', 'elemailer'); ?><span class="count"></span></a></li>
                        <li><a href="#trash" id="eleListTrash" class="trashNav"><?php esc_html_e('Trash', 'elemailer'); ?><span class="count"></span></a></li>
                        <li>
                            <div class="moveTrashSelected hide">
                                <a href="#" class="moveToTrash"><?php esc_html_e('Trash', 'elemailer'); ?></a>
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
                    <table data-list_id="<?php echo esc_attr($list_id); ?>" class="elelist_dataTable" id="list_dataTable" class="display" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th><?php esc_html_e('', 'elemailer'); ?></th>
                                <th><?php esc_html_e('Email', 'elemailer'); ?></th>
                                <th><?php esc_html_e('First Name', 'elemailer'); ?></th>
                                <th><?php esc_html_e('Last Name', 'elemailer'); ?></th>
                                <th><?php esc_html_e('List', 'elemailer'); ?></th>
                                <th><?php esc_html_e('List Status', 'elemailer'); ?></th>
                                <th><?php esc_html_e('Internal Status', 'elemailer'); ?>
                                    <div class="eltooltip">?
                                        <div class="top">
                                            <p><?php esc_html_e('This is the status that you set when you create a subscriber manually, import, add via forms for example & Double opt-in status. If a Subscriber is subscribed atleast in one list the status reflects it. This is independent from your lists subscription status. If a subscriber removes themselves from all of the lists the status will become Unsubscribed', 'elemailer'); ?></p>
                                            <i></i>
                                        </div>
                                    </div>
                                </th>
                                <th><?php esc_html_e('Created At', 'elemailer'); ?></th>
                            </tr>
                        </thead>
                        
                        <tfoot>
                            <tr>
                                <th><?php esc_html_e('', 'elemailer'); ?></th>
                                <th><?php esc_html_e('Email', 'elemailer'); ?></th>
                                <th><?php esc_html_e('First Name', 'elemailer'); ?></th>
                                <th><?php esc_html_e('Last Name', 'elemailer'); ?></th>
                                <th><?php esc_html_e('List', 'elemailer'); ?></th>
                                <th><?php esc_html_e('List Status', 'elemailer'); ?></th>
                                <th><?php esc_html_e('Internal Status', 'elemailer'); ?></th>
                                <th><?php esc_html_e('Created At', 'elemailer'); ?></th>
                            </tr>
                        </tfoot>
                    </table>
                    <span class="check_all_footer">
                        <input class="allCheckBtn" type="checkbox" name="" id="">
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
<?php

function sebpo_popsearch_list()
{

    ?>
    <div class="wrap">
        <h2>Pop Search Phrases <a href="<?php echo admin_url('admin.php?page=sebpo_pop_search_create'); ?>"
                                  class="page-title-action">Add New Phrase</a></h2>
        <br/>
        <?php
        global $wpdb;

        $table_name = $wpdb->prefix . "pop_search";

        $rows = $wpdb->get_results('SELECT * from '. $table_name);

        ?>
        <table class="wp-list-table widefat fixed striped posts display"  id="pop_search_list" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <!--                <th class="manage-column ss-list-width">ID</th>-->
                    <th class="manage-column ss-list-width">Phrases</th>
                    <th class="manage-column ss-list-width">Is Active</th>
                    <th>Actions</th>
                </tr>

            </thead>

            <tbody>
            <?php foreach ($rows as $row) {
                $pop_search_id = $row->pop_search_id;
                if (isset($_POST['delete'])) {
                    $wpdb->query($wpdb->prepare("DELETE FROM $table_name WHERE pop_search_id = %s", $pop_search_id));
                } ?>
                <tr>
                    <td class="manage-column ss-list-width"><?php echo $row->kw_phrase; ?></td>
                    <td class="manage-column ss-list-width"><?php if ($row->pop_search_is_active) echo "YES"; else echo "NO"; ?></td>
                    <td>
                        <a href="<?php echo admin_url('admin.php?page=sebpo_pop_search_update&pop_search_id=' . $row->pop_search_id); ?>"
                           class="button button-primary">Update</a>
                        <a href="<?php echo admin_url('admin.php?page=sebpo_pop_search_delete&pop_search_id=' . $row->pop_search_id); ?>"
                           class="button button-secondary">Delete</a>
                    </td>

                </tr>
            <?php } ?>
            </tbody>
            <tfoot>
            <tr>
                <!--                <th class="manage-column ss-list-width">ID</th>-->
                <th class="manage-column ss-list-width">Phrases</th>
                <th class="manage-column ss-list-width">Is Active</th>
                <th class="manage-column ss-list-width">Actions</th>
            </tr>
            </tfoot>

        </table>
    </div>
<?php
}
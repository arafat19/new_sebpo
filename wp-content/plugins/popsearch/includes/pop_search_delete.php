<?php

function sebpo_pop_search_delete() {
    global $wpdb;
    $table_name = $wpdb->prefix . "pop_search";
    $pop_search_id = $_GET["pop_search_id"];


//delete
    if (isset($_POST['delete'])) {
        $wpdb->query($wpdb->prepare("DELETE FROM $table_name WHERE pop_search_id = %s", $pop_search_id));
    } else {//selecting value to update	
        $phrases = $wpdb->get_results($wpdb->prepare("SELECT kw_phrase, pop_search_is_active from $table_name where pop_search_id=%s", $pop_search_id));
        foreach ($phrases as $s) {
            $kw_phrase = $s->kw_phrase;
            $is_active = $s->pop_search_is_active;
        }
    }
    ?>
<!--    <link type="text/css" href="--><?php //echo WP_PLUGIN_URL; ?><!--/popsearch/css/style-admin.css" rel="stylesheet" />-->
    <div class="wrap">
        <h2>Delete Pop Search Phrase</h2>

        <?php if ($_POST['delete']) { ?>
            <div class="updated"><p>Selected Phrase is deleted</p></div>
            <a href="<?php echo admin_url('admin.php?page=sebpo_popsearch_list') ?>">&laquo; Back to Phrases List</a>

        <?php }
        else { ?>
            <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>"  id="create_phrase">
                <table class="form-table">
                    <tr class="form-field form-required">
                        <th scope="row"><label for="kw_phrase"><?php _e('KW Phrase'); ?></label></th>
                        <td><input type="text" name="kw_phrase" value="<?php echo $kw_phrase; ?>"  disabled="disabled"/></td>
                    </tr>
                    <tr>
                        <th class="ss-th-width">Is Active</th>
                        <td><input type="checkbox" id="is_active" class="ss-field-width" name="is_active" value="1" <?php echo ($is_active == 1 ? 'checked' : '');?> disabled="disabled"/></td>
                    </tr>
                </table>
                <p class="submit"><input type='submit' name="delete" value='Confirm Delete' class='button button-primary'/></p>
                <!--                <input type='submit' name="delete" value='Delete' class='button' onclick="return confirm('&iquest;Est&aacute;Do you really ?')">-->
            </form>
        <?php } ?>

    </div>
<?php
}
<?php

function sebpo_pop_search_update() {
    global $wpdb;
    $table_name = $wpdb->prefix . "pop_search";
    $pop_search_id = $_GET["pop_search_id"];
    $kw_phrase = $_POST["kw_phrase"];
    $is_active = $_POST["is_active"];
//update
    if (isset($_POST['update'])) {
        $wpdb->update(
            $table_name, //table
            array('kw_phrase' => $kw_phrase, 'pop_search_is_active' => $is_active), //data
            array('pop_search_id' => $pop_search_id), //where
            array('%s'), //data format
            array('%s') //where format
        );
    }
    else {//selecting value to update
        $phrases = $wpdb->get_results($wpdb->prepare("SELECT kw_phrase, pop_search_is_active from $table_name where pop_search_id=%s", $pop_search_id));
        foreach ($phrases as $s) {
            $kw_phrase = $s->kw_phrase;
            $is_active = $s->pop_search_is_active;
        }
    }
    ?>
<!--    <link type="text/css" href="--><?php //echo WP_PLUGIN_URL; ?><!--/popsearch/css/style-admin.css" rel="stylesheet" />-->
    <div class="wrap">
        <h2>Update Pop Search Phrase <a href="<?php echo admin_url( 'admin.php?page=sebpo_pop_search_create' ); ?>" class="page-title-action">Add New Phrase</a></h2>

        <?php if ($_POST['update']) { ?>
            <div class="updated"><p>Selected Phrase is updated</p></div>
            <a href="<?php echo admin_url('admin.php?page=sebpo_popsearch_list') ?>">&laquo; Back to Phrases list</a>

        <?php } else { ?>
            <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>"  id="create_phrase">
                <table class="form-table">
                    <tr class="form-field form-required">
                        <th scope="row"><label for="kw_phrase"><?php _e('KW Phrase'); ?></label></th>
                        <td><input type="text" name="kw_phrase" value="<?php echo $kw_phrase; ?>" class="ss-field-width" aria-required="true" required="required"/></td>
                    </tr>
                    <tr>
                        <th class="ss-th-width">Is Active</th>
                        <td><input type="checkbox" id="is_active" class="ss-field-width" name="is_active" value="1" <?php echo ($is_active == 1 ? 'checked' : '');?>/></td>
                    </tr>
                </table>
                <p class="submit"><input type="submit" name="update" id="create" class="button button-primary" value="Update"></p>
            </form>
        <?php } ?>

    </div>
<?php
}
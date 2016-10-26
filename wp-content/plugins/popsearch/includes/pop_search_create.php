<?php
function sebpo_pop_search_create() {
    $kw_phrase = $_POST["kw_phrase"];
    $is_active = $_POST["is_active"];


    //insert
    if (isset($_POST['create'])) {
        global $wpdb;
        $table_name = $wpdb->prefix . "pop_search";
        if($is_active == NULL){
            $is_active = 0;
        }

        if($kw_phrase == ''){
            $error_message ="There has been an error. Please give a Phrase.";
        } else{
            $wpdb->insert(
                $table_name, //table
                array('kw_phrase' => $kw_phrase, 'pop_search_is_active' => $is_active), //data
                array('%s', '%s') //data format
            );
            $success_message ="Pop Search Phrase Created";
        }


        //var_dump($wpdb);

    }
    ?>
<!--    <link type="text/css" href="--><?php //echo WP_PLUGIN_URL; ?><!--/popsearch/css/style-admin.css" rel="stylesheet" />-->
    <div class="wrap">
        <h2>Add New Pop Search Phrase </h2>
        <?php if (isset($success_message)): ?><div class="updated"><p><?php echo $success_message; ?></p></div><?php endif; ?>
        <?php if (isset($error_message)): ?><div class="error"><p><?php echo $error_message; ?></p></div><?php endif; ?>
        <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>"id="create_phrase">
            <table class="form-table">
                <tr class="form-field">
                    <th scope="row"><label for="kw_phrase"><?php _e('KW Phrase'); ?></label></th>
                    <td><input type="text" name="kw_phrase" value="<?php echo $kw_phrase; ?>"/></td>
                </tr>
                <tr class="form-field">
                    <th class="ss-th-width">Is Active</th>
                    <td><input type="checkbox" id="is_active" class="ss-field-width" name="is_active" value="1"/></td>
                </tr>
            </table>
            <p class="submit"><input type="submit" name="create" id="create" class="button button-primary" value="Add New Phrase"></p>
        </form>
    </div>
    <?php
}
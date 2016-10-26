<?php
/**
 *
 * @package   popsearch
 * @author    Md Ibrahim Arafat <arafat0112358@gmail.com>
 * @copyright 2016 Md Ibrahim Arafat
 *
 * @wordpress-plugin
 * Plugin Name:            Pop Search
 * Plugin URI:            https://www.sebpo.com
 * Description:        Popular Search or pop search is a plugin for sebpo. It is a popular keyword directory for internal search engine for ServicEngine BPO.
 * Version:            1.0.10
 * Author:            Creative Team
 * Author URI:        https://www.sebpo.com
 * Text Domain:
 * License:
 * License URI:
 */

/* register activation and deactivation hooks */
register_activation_hook(__FILE__, 'install_pop_search');
register_deactivation_hook(__FILE__, 'uninstall_pop_search');


function pop_search_frontend_scripts_and_styles()
{
    if ($_GET["page"] == "sebpo_popsearch_list") {
        if (wp_script_is('jquery', 'registered'))
            wp_enqueue_script('jquery');
        else {
            wp_register_script('jquery', plugins_url('/js/jquery-1.12.3.js', __FILE__), array('jquery'), '1.12.3', true);
            wp_enqueue_script('jquery');
        }

        wp_register_script('jquery-dataTables-min-js', plugins_url('/js/jquery.dataTables.min.js', __FILE__), array('jquery'), '1.10.12', true);
        wp_enqueue_script('jquery-dataTables-min-js');

        wp_register_script('custom-js', plugins_url('/js/custom.js', __FILE__), array('jquery'), '1.0.0', true);
        wp_enqueue_script('custom-js');

        wp_register_style('jquery-dataTables-min-css', plugins_url('/css/jquery.dataTables.min.css', __FILE__));
        wp_enqueue_style('jquery-dataTables-min-css');

    }
    if ($_GET["page"] == "sebpo_pop_search_create" || $_GET["page"] == "sebpo_pop_search_update" || $_GET["page"] == "sebpo_pop_search_delete") {
        if (wp_script_is('jquery', 'registered'))
            wp_enqueue_script('jquery');
        else {
            wp_register_script('jquery', plugins_url('/js/jquery-1.12.3.js', __FILE__), array('jquery'), '1.12.3', true);
            wp_enqueue_script('jquery');
        }

        wp_register_style('style-admin-css', plugins_url('/css/style-admin.css', __FILE__));
        wp_enqueue_style('style-admin-css');
    }


}

add_action('admin_enqueue_scripts', 'pop_search_frontend_scripts_and_styles');
//menu items
add_action('admin_menu', 'sebpo_popsearch_modify_menu');


function sebpo_popsearch_modify_menu()
{

     if( current_user_can('edit_others_posts') ) {
    // if (current_user_can('edit_post') ) {
        //this is the main item for the menu
        add_menu_page('Plugin page title', //page title
            'Pop Search', //menu title
            'manage_options', //capabilities
            'sebpo_popsearch_list', //menu slug
            'sebpo_popsearch_list', //function
            'dashicons-search'
        );

        //this is the main item for the menu
        add_submenu_page('sebpo_popsearch_list', //parent slug
            'All Phrases', //menu title
            'All Phrases', //page title
            'manage_options', //capabilities
            'sebpo_popsearch_list', //menu slug
            'sebpo_popsearch_list' //function
        );

        //this is a submenu
        add_submenu_page('sebpo_popsearch_list', //parent slug
            'Add New Pop Search Phrase', //page title
            'Add New Phrase', //menu title
            'manage_options', //capability
            'sebpo_pop_search_create', //menu slug
            'sebpo_pop_search_create'); //function

        //this submenu is HIDDEN, however, we need to add it anyways
        add_submenu_page(null, //parent slug
            'Update Pop Search Phrase', //page title
            'Update', //menu title
            'manage_options', //capability
            'sebpo_pop_search_update', //menu slug
            'sebpo_pop_search_update'); //function

        //this submenu is HIDDEN, however, we need to add it anyways
        add_submenu_page(null, //parent slug
            'Delete Pop Search Phrase', //page title
            'Delete', //menu title
            'manage_options', //capability
            'sebpo_pop_search_delete', //menu slug
            'sebpo_pop_search_delete'); //function
    }
}

function install_pop_search()
{
    global $wpdb;
    global $pop_search_db_version;

    //Pop search pop_search table

    $pop_search_table = $wpdb->prefix . "pop_search";

    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE " . $pop_search_table . "(
            pop_search_id bigint(30) NOT NULL AUTO_INCREMENT,
            pop_search_is_active int(10) DEFAULT '0' NOT NULL,
            kw_phrase varchar(100) NOT NULL,
            UNIQUE KEY pop_search_id (pop_search_id)
    ) $charset_collate;";

    if (!function_exists('dbDelta')) {
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    }

    dbDelta($sql);


    add_option("pop_search_db_version", $pop_search_db_version);

    /*add_role('my_plugin_role', 'My Plugin Role', array(
        'manage_my_plugin' => true, // plugin specific capability
        'read' => true // core capability
    ));
    // add plugin capabilities for some standard roles
    $roles = array('administrator', 'editor', 'author');
    $roles_obj = new WP_Roles();
    foreach ($roles as $role_name) {
        $roles_obj->add_cap($role_name, 'manage_my_plugin' );
    }*/
}

function uninstall_pop_search()
{
    global $wpdb;
    //Pop search pop_search table

    $pop_search_table = $wpdb->prefix . "pop_search";

    $wpdb->query('DROP TABLE IF EXISTS ' . $pop_search_table);

    /*remove_role( 'my_plugin_role' );
    $roles = array('administrator', 'editor', 'author');
    $roles_obj = new WP_Roles();
    foreach ($roles as $role_name) {
        $roles_obj->remove_cap($role_name, 'manage_my_plugin' );
    }*/

}


define('ROOTDIR', plugin_dir_path(__FILE__));
require_once(ROOTDIR . 'includes/pop_search_list.php');
require_once(ROOTDIR . 'includes/pop_search_create.php');
require_once(ROOTDIR . 'includes/pop_search_update.php');
require_once(ROOTDIR . 'includes/pop_search_delete.php');


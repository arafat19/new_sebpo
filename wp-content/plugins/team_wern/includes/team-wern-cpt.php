<?php
/**
 * Registers a new post type
 * @uses $wp_post_types Inserts new post type object into the list
 *
 * @param string  Post type key, must not exceed 20 characters
 * @param array|string  See optional args description above.
 * @return object|WP_Error the registered post type object, or an error object
 */
function sebpo_teamwern() {
    $labels = array(
        'name'               => _x( 'Team', 'teamwern' ),
        'singular_name'      => _x( 'Team', 'teamwern' ),
        'menu_name'          => _x( 'Team', 'admin menu', 'teamwern' ),
        'name_admin_bar'     => _x( 'Team', 'add new on admin bar', 'teamwern' ),
        'add_new'            => _x( 'Add New Team', 'teamwern', 'teamwern' ),
        'add_new_item'       => __( 'Add New Team', 'teamwern' ),
        'new_item'           => __( 'New Team', 'teamwern' ),
        'edit_item'          => __( 'Edit Team', 'teamwern' ),
        'view_item'          => __( 'View Team', 'teamwern' ),
        'all_items'          => __( 'All Team', 'teamwern' ),
        'search_items'       => __( 'Search Team', 'teamwern' ),
        'parent_item_colon'  => __( 'Parent Team:', 'teamwern' ),
        'not_found'          => __( 'No Team found.', 'teamwern' ),
        'not_found_in_trash' => __( 'No Team found in Trash.', 'teamwern' ),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => false,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'team-member' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 6,
        'menu_icon'          => 'dashicons-universal-access',
        'supports'           => array( 'title', 'editor', '')
    );
    register_post_type( 'teamwern', $args );
}

add_action( 'init', 'sebpo_teamwern' );

// Register Theme Features (feature image for masterclass)

if ( ! function_exists('sebpo_team_theme_support') ) {

    function sebpo_team_theme_support()  {
        // Add theme support for Featured Images
//		add_theme_support( 'post-thumbnails', array( 'teamwern' ) );
    }

    // Hook into the 'after_setup_theme' action
    add_action( 'after_setup_theme', 'sebpo_team_theme_support' );
}
<?php
/**
 * Adds a box to the main column on the Post and Page edit screens.
 */
function team_wern_add_meta_box() {

    add_meta_box(
        'team_wern_sectionid',
        __( "Member Extra Info" , 'teamwern' ),
        'team_wern_meta_box_callback',
        'teamwern'
    );
}
add_action( 'add_meta_boxes', 'team_wern_add_meta_box' );

/**
 * Prints the box content.
 *
 * @param WP_Post $post The object for the current post/page.
 */
function team_wern_meta_box_callback( $post ) {

    // Add an nonce field so we can check for it later.
    wp_nonce_field( 'team_wern_meta_box', 'team_wern_meta_box_nonce' );

    /*
     * Use get_post_meta() to retrieve an existing value
     * from the database and use the value for the form.
     */
    $member_designation = get_post_meta( $post->ID, 'member_designation', true );
    $member_email = get_post_meta( $post->ID, 'member_email', true );
    echo '<p>';
    echo '<label for="team_wern_designation_field">';
    _e( 'Designation', 'teamwarn' );
    echo '</label> ';
    echo '<input type="text" id="member_designation" name="member_designation" value="' . esc_attr( $member_designation ) . '" size="25" />';
    echo '</p>';
    echo '<p>';
    echo '<label for="team_wern_email_field" style="width: 75px;float: left;">';
    _e( 'E-mail', 'teamwarn' );
    echo '</label> ';
    echo '<input type="text" id="member-email" name="member_email" value="' . esc_attr( $member_email ) . '" size="25" />';
    echo '</p>';
}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function team_wern_save_meta_box_data( $post_id ) {

    /*
     * We need to verify this came from our screen and with proper authorization,
     * because the save_post action can be triggered at other times.
     */

    // Check if our nonce is set.
    if ( ! isset( $_POST['team_wern_meta_box_nonce'] ) ) {
        return;
    }

    // Verify that the nonce is valid.
    if ( ! wp_verify_nonce( $_POST['team_wern_meta_box_nonce'], 'team_wern_meta_box' ) ) {
        return;
    }

    // If this is an autosave, our form has not been submitted, so we don't want to do anything.
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    // Check the user's permissions.
    if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {

        if ( ! current_user_can( 'edit_page', $post_id ) ) {
            return;
        }

    } else {

        if ( ! current_user_can( 'edit_post', $post_id ) ) {
            return;
        }
    }

    /* OK, it's safe for us to save the data now. */

    // Make sure that it is set.
    if ( isset( $_POST['member_designation'] ) ) {
        // Sanitize user input.
        $member_designation = sanitize_text_field( $_POST['member_designation'] );
        // Update the meta field in the database.
        update_post_meta( $post_id, 'member_designation', $member_designation );
    }

    // Make sure that it is set.
    if (isset( $_POST['member_email'] ) ) {

        // Sanitize user input.
        $member_email = sanitize_text_field( $_POST['member_email'] );
        // Update the meta field in the database.
        update_post_meta( $post_id, 'member_email', $member_email );
    }

}
add_action( 'save_post', 'team_wern_save_meta_box_data' );




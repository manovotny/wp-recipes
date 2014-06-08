<?php
/**
 * @package WP_Recipe
 * @author Michael Novotny <manovotny@gmail.com>
 */

add_action( 'add_meta_boxes_recipe', 'wp_recipe_add_description_meta_box' );
add_action( 'save_post', 'wp_recipe_save_description_meta_box' );

/**
 * Adds description meta box.
 */
function wp_recipe_add_description_meta_box() {

    $wp_recipe = WP_Recipe::get_instance();
    $wp_recipe_description = WP_Recipe_Description::get_instance();

    add_meta_box(
        $wp_recipe_description->get_slug(),
        'Description',
        'wp_recipe_display_description_meta_box',
        $wp_recipe->get_post_type(),
        'normal',
        'high'
    );

}

/**
 * Displays description meta box.
 */
function wp_recipe_display_description_meta_box() {

    global $post;

    $wp_recipe_description = WP_Recipe_Description::get_instance();

    wp_nonce_field( $wp_recipe_description->get_slug(), $wp_recipe_description->get_nonce() );

    $description = get_post_meta( $post->ID, $wp_recipe_description->get_slug(), true );

    $settings = array(
        'drag_drop_upload'  => true,
        'textarea_rows'     => 3
    );

    wp_editor( $description, $wp_recipe_description->get_id(), $settings );

}

/**
 * Saves description.
 *
 * @param string $post_id Post id.
 */
function wp_recipe_save_description_meta_box( $post_id ) {

    $wp_recipe = WP_Recipe::get_instance();

    if ( empty( $_POST ) || $wp_recipe->get_post_type() !== $_POST[ 'post_type' ] ) {

        return;

    }

    $wp_recipe_description = WP_Recipe_Description::get_instance();

    if ( $wp_recipe->can_user_save( $post_id, $wp_recipe_description->get_slug(), $wp_recipe_description->get_nonce() ) ) {

        update_post_meta( $post_id, $wp_recipe_description->get_slug(), $_POST[ $wp_recipe_description->get_id() ] );

    }

}
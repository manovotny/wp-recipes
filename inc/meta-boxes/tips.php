<?php
/**
 * @package WP_Recipe
 * @author Michael Novotny <manovotny@gmail.com>
 */

add_action( 'add_meta_boxes_recipe', 'wp_recipe_add_tips_meta_box' );
add_action( 'save_post', 'wp_recipe_save_tips_meta_box' );

/**
 * Adds tips meta box.
 */
function wp_recipe_add_tips_meta_box() {

    add_meta_box(
        'wp-recipe-tips',
        'Tips',
        'wp_recipe_display_tips_meta_box',
        'recipe',
        'normal',
        'high'
    );

}

/**
 * Displays tips meta box.
 */
function wp_recipe_display_tips_meta_box() {

    global $post;

    wp_nonce_field( 'wp-recipe-tips', 'wp-recipe-tips-nonce' );

    $tips = get_post_meta( $post->ID, 'wp-recipe-tips', true );

    $settings = array(
        'drag_drop_upload'  => true,
        'textarea_rows'     => 3
    );

    wp_editor( $tips, 'wp_recipe_tips', $settings );

}

/**
 * Saves tips.
 *
 * @param string $post_id Post id.
 */
function wp_recipe_save_tips_meta_box( $post_id ) {

    if ( empty( $_POST ) || 'recipe' !== $_POST[ 'post_type' ] ) {

        return;

    }

    $wp_recipe = WP_Recipe::get_instance();

    if ( $wp_recipe->can_user_save( $post_id, 'wp-recipe-tips', 'wp-recipe-tips-nonce' ) ) {

        update_post_meta( $post_id, 'wp-recipe-tips', $_POST[ 'wp_recipe_tips' ] );

    }

}
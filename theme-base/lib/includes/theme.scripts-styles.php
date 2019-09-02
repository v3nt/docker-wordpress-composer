<?php
/**
 * Scripts & Styles
 *
 * @package Base
 */

/**
 * Enqueue scripts and styles.
 */
function enqueue_scripts() {
    wp_enqueue_style( 'theme-base-style', get_template_directory_uri() . '/assets/css/style.min.css' );
    wp_enqueue_script( 'theme-base-scripts', get_template_directory_uri() . '/assets/js/main.js', array(),'1.0', true );
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}

add_action( 'wp_enqueue_scripts', 'enqueue_scripts' );

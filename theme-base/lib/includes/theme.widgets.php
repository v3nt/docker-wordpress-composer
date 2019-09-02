<?php
/**
 * Widget Functions
 *
 * @package Base
 */

// Add theme support for selective refresh for widgets.
add_theme_support( 'customize-selective-refresh-widgets' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function widgets_init() {
    register_sidebar( array(
        'name'          => esc_html__( 'Sidebar', 'bulmapress' ),
        'id'            => 'sidebar-1',
        'description'   => esc_html__( 'Add widgets here.', 'bulmapress' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s column is-one-third">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title is-bold">',
        'after_title'   => '</h2>',
    ) );
}
add_action( 'widgets_init', 'widgets_init' );

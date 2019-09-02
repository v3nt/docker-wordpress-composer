<?php

show_admin_bar(false);

global $allowedtags;
unset($allowedtags['cite']);
unset($allowedtags['q']);
unset($allowedtags['del']);
unset($allowedtags['abbr']);
unset($allowedtags['acronym']);

remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'wp_shortlink_wp_head');
remove_action('wp_head', 'rest_output_link_wp_head');
remove_action( 'wp_head', 'wp_oembed_add_discovery_links');
remove_action('set_comment_cookies', 'wp_set_comment_cookies');

add_action('init', 'RemoveFeedEndPoint', 99);
add_action('wp_head', 'removeFeedFromHead', 1);
add_action('do_feed_rdf', 'redirectFeeToHome', 1);
add_action('do_feed_rss', 'redirectFeeToHome', 1);
add_action('do_feed_rss2', 'redirectFeeToHome', 1);
add_action('do_feed_atom', 'redirectFeeToHome', 1);

add_filter('emoji_svg_url', '__return_false');
add_filter('feed_links_show_comments_feed', '__return_false');

register_activation_hook(__FILE__, 'wpse33072_activation' );

// Remove all actions related to emojis
function RemoveEmojiWP() {
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    add_filter('tiny_mce_plugins', 'disable_emojicons_tinymce');
}
add_action('init', 'RemoveEmojiWP');


function disable_emojicons_tinymce( $plugins ) {
    return (is_array($plugins)) ? array_diff($plugins, array('wpemoji')) : array();
}

function removeFeedFromHead() {
    remove_action('wp_head', 'feed_links', 2);
    remove_action('wp_head', 'feed_links_extra', 3);
}

function RemoveFeedEndPoint() {
    global $wp_rewrite;
    $wp_rewrite->feeds = array();
}

function redirectFeeToHome() {
    wp_redirect( home_url(), 302 );
    exit();
}

function wpse33072_activation() {
    RemoveFeedEndPoint();
    flush_rewrite_rules();
}
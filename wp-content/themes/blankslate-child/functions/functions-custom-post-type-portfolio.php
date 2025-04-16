<?php
/**
 * 
 * Custom post type for Portfolio 2025-03-18 17:00
 * 
 */
// Register Custom Post Type: Portfolio
function create_custom_post_type() {
    register_post_type('portfolio', array(
        'labels' => array(
            'name'          => __('Portfolio', 'blankslate-child'),
            'singular_name' => __('Portfolio Item', 'blankslate-child')
        ),
        'public'        => true,
        'has_archive'   => true,
        'rewrite'       => array('slug' => 'portfolio'),
        'supports'      => array('title', 'editor', 'thumbnail', 'excerpt'),
        'menu_icon'     => 'dashicons-format-gallery'
    ));
}
add_action('init', 'create_custom_post_type');

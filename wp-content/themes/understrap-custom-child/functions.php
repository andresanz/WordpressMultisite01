<?php
function understrap_child_enqueue_styles() {
    wp_enqueue_style( 'understrap-styles', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'understrap-child-styles', get_stylesheet_directory_uri() . '/style.css', array('understrap-styles'), '1.0.0' );
}
add_action( 'wp_enqueue_scripts', 'understrap_child_enqueue_styles' );

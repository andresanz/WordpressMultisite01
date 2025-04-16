<?php
/**
 * Functions for Twenty Twenty-Five Child Theme
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Enqueue parent and child theme styles
 */
function twentytwentyfive_child_enqueue_styles() {
    // Load parent theme styles
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');

    // Load child theme styles
    wp_enqueue_style('child-style', get_stylesheet_directory_uri() . '/style.css', array('parent-style'), wp_get_theme()->get('Version'));

    // Load additional custom styles
    wp_enqueue_style('custom-style', get_stylesheet_directory_uri() . '/assets/css/custom.css', array('child-style'), wp_get_theme()->get('Version'));

    // Load custom JavaScript
    wp_enqueue_script('custom-js', get_stylesheet_directory_uri() . '/assets/js/custom.js', array('jquery'), wp_get_theme()->get('Version'), true);
}
add_action('wp_enqueue_scripts', 'twentytwentyfive_child_enqueue_styles');


/**
 * Show templates in page comments
 */
function show_template_hierarchy_in_comment() {
    if (is_user_logged_in()) { // Show only for logged-in users
        global $template;
        
        $hierarchy = debug_backtrace();
        $used_templates = [];

        foreach ($hierarchy as $trace) {
            if (isset($trace['file']) && strpos($trace['file'], get_template_directory()) !== false) {
                $file_path = str_replace(get_template_directory(), '', $trace['file']);
                if (!in_array($file_path, $used_templates)) {
                    $used_templates[] = $file_path;
                }
            }
        }

        echo "\n<!-- Template Used: " . esc_html($template) . " -->\n";

        if (!empty($used_templates)) {
            echo "<!-- Additional Template Files: " . esc_html(implode(', ', $used_templates)) . " -->\n";
        }
    }
}
add_action('wp_footer', 'show_template_hierarchy_in_comment');

/**
 * Register a Custom Navigation Menu
 */
function twentytwentyfive_child_register_menus() {
    register_nav_menus(array(
        'primary_menu' => __('Primary Menu', 'twentytwentyfive-child'),
    ));
}
add_action('after_setup_theme', 'twentytwentyfive_child_register_menus');


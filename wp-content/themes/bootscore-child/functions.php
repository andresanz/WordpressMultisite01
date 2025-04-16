<?php

/**
 * @package Bootscore Child
 *
 * @version 6.0.0
 */


// Exit if accessed directly
defined('ABSPATH') || exit;


/**
 * Enqueue scripts and styles
 */
add_action('wp_enqueue_scripts', 'bootscore_child_enqueue_styles');
function bootscore_child_enqueue_styles() {

  // Compiled main.css
  $modified_bootscoreChildCss = date('YmdHi', filemtime(get_stylesheet_directory() . '/assets/css/main.css'));
  wp_enqueue_style('main', get_stylesheet_directory_uri() . '/assets/css/main.css', array('parent-style'), $modified_bootscoreChildCss);

  // style.css
  wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
  
  // custom.js
  // Get modification time. Enqueue file with modification date to prevent browser from loading cached scripts when file content changes. 
  $modificated_CustomJS = date('YmdHi', filemtime(get_stylesheet_directory() . '/assets/js/custom.js'));
  wp_enqueue_script('custom-js', get_stylesheet_directory_uri() . '/assets/js/custom.js', array('jquery'), $modificated_CustomJS, false, true);
}

function show_template_hierarchy_in_comment() {
    if (is_user_logged_in()) { // Show only for logged-in users
        global $template;
        
        // Ensure the template path is correctly formatted
        $template_path = str_replace(get_theme_root(), '', $template);

        // Get backtrace to find included template parts
        $hierarchy = debug_backtrace();
        $used_templates = [];

        foreach ($hierarchy as $trace) {
            if (isset($trace['file'])) {
                $file = str_replace(get_theme_root(), '', $trace['file']);

                // Exclude duplicate entries and the main template itself
                if (!in_array($file, $used_templates) && $file !== $template_path) {
                    $used_templates[] = $file;
                }
            }
        }

        echo "\n<!-- Template Used: " . esc_html($template_path) . " -->\n";

        if (!empty($used_templates)) {
            echo "<!-- Additional Template Files:\n";
            foreach ($used_templates as $file) {
                echo "    " . esc_html($file) . ",\n";
            }
            echo "-->\n";
        }
    }
}
add_action('wp_footer', 'show_template_hierarchy_in_comment');


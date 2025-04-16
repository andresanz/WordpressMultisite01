<?php
/**
 * Plugin Name: Custom Background Images per Page
 * Description: Allows setting a custom background image for each page or post.
 * Version: 1.0
 */

function add_custom_bg_image_manual() {
    if (is_single() || is_page() || is_home()) {
        global $post;
        
        // Get the custom background image
        $bg_image = get_post_meta($post->ID, 'custom_bg_image', true);
        
        // If it's the blog index (Home), get the "Posts Page" background instead
        if (is_home()) {
            $posts_page_id = get_option('page_for_posts');
            if ($posts_page_id) {
                $bg_image = get_post_meta($posts_page_id, 'custom_bg_image', true);
            }
        }

        // Output the background CSS if an image is set
        if ($bg_image) {
            echo "<style>
                body {
                    background: url('$bg_image') no-repeat center center fixed;
                    background-size: cover;
                }
            </style>";
        }
    }
}
add_action('wp_head', 'add_custom_bg_image_manual');
<?php
/**
 * Random Category Shortcode
 * Usage: [random-category text="Click here"]
 */

// Shortcode to display a link to a random category
function random_category_link_shortcode($atts) {
    $atts = shortcode_atts([
        'text' => 'Click here',
    ], $atts, 'random-category');

    // Retrieve all categories that aren't empty
    $categories = get_categories(['hide_empty' => true]);

    if (empty($categories)) {
        return '';
    }

    // Select a random category
    $random_category = $categories[array_rand($categories)];

    // Generate the category link
    $category_link = get_category_link($random_category->term_id);

    // Return a simple inline link (no extra formatting)
    return '<a href="' . esc_url($category_link) . '">' . esc_html($atts['text']) . '</a>';
}

// Register the shortcode with WordPress
add_shortcode('random-category', 'random_category_link_shortcode');
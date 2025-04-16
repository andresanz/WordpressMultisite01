<?php
/**
 * Shortcode: Display a random local image from a predefined list
 * Usage: [local-random-image width="600" height="400" alt="Random Image"]
 */

function local_random_image_shortcode($atts) {
    $atts = shortcode_atts([
        'width'  => '600',
        'height' => '400',
        'alt'    => 'Random Image',
    ], $atts, 'local-random-image');

    // List your uploaded images here
    $images = [
        'https://art.ngfiles.com/images/2532000/2532420_idontfail_random-stuff.jpg',
        'https://randomcategory.com/wp-content/uploads/sites/2/2025/03/thumb_sam-jets-1.png',
        'https://randomcategory.com/wp-content/uploads/sites/2/2025/03/thumb_noah-jets-1.png',
        // Add more images as needed
    ];

    // Check if images are available
    if (empty($images)) {
        return 'No images available.';
    }

    // Select a random image
    $random_image = $images[array_rand($images)];

    // Return the image HTML
    return sprintf(
        '<img src="%s" width="%s" height="%s" alt="%s" style="max-width:100%%;height:auto;">',
        esc_url($random_image),
        esc_attr($atts['width']),
        esc_attr($atts['height']),
        esc_attr($atts['alt'])
    );
}

add_shortcode('local-random-image', 'local_random_image_shortcode');
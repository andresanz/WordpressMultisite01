<?php
/**
 * Ultra-Simple Email Obfuscator
 * Just adds a simple shortcode for email obfuscation
 * Use the shortcode: [email address="example@domain.com" text="Contact Me" class="my-button"]
 */

// Simple email shortcode that uses the built-in antispambot() function
function simple_email_shortcode($atts) {
    // Extract attributes
    $atts = shortcode_atts(array(
        'address' => '',
        'text' => '',
        'class' => '',
    ), $atts);
    
    // Return empty if no email provided
    if (empty($atts['address'])) {
        return '';
    }
    
    // Get values
    $email = $atts['address'];
    $text = !empty($atts['text']) ? $atts['text'] : $email;
    $class = !empty($atts['class']) ? ' class="' . esc_attr($atts['class']) . '"' : '';
    
    // Use WordPress's built-in antispambot function for encoding
    $encoded_email = antispambot($email);
    
    // Create the link
    return '<a href="mailto:' . $encoded_email . '"' . $class . '>' . $text . '</a>';
}

// Register the shortcode
add_shortcode('email', 'simple_email_shortcode');
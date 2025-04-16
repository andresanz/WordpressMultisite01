<?php
function global_favicon_from_theme() {
    $favicon_path = get_stylesheet_directory_uri() . '/favicon';

/* 2025-04-03 This is the favicon folder in the child theme */

    echo '<link rel="apple-touch-icon" sizes="180x180" href="' . esc_url($favicon_path . '/apple-touch-icon.png') . '" />';
    echo '<link rel="icon" type="image/png" sizes="32x32" href="' . esc_url($favicon_path . '/favicon-32x32.png') . '" />';
    echo '<link rel="icon" type="image/png" sizes="16x16" href="' . esc_url($favicon_path . '/favicon-16x16.png') . '" />';
    echo '<link rel="shortcut icon" href="' . esc_url($favicon_path . '/favicon.ico') . '" />';
    echo '<link rel="manifest" href="' . esc_url($favicon_path . '/site.webmanifest') . '" />';
}
add_action('wp_head', 'global_favicon_from_theme');
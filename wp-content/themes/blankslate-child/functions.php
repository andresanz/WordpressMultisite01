<?php
/**
 * Enqueue Parent & Child Styles
 */
function blankslate_child_enqueue_styles() {
    // Parent theme style
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');

    // Child theme style (depends on parent)
    wp_enqueue_style('child-style', get_stylesheet_uri(), array('parent-style'), wp_get_theme()->get('Version'));

    // Load Google Fonts
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Work+Sans:wght@100;200;300;400;500;600;700;800;900&family=Source+Sans+Pro:wght@200;300;400;500;600;700;900&display=swap', array(), false);
}
add_action('wp_enqueue_scripts', 'blankslate_child_enqueue_styles');

/**
 * Enqueue Custom Scripts
 */
function enqueue_custom_scripts() {
    wp_enqueue_script('custom-accordion', get_stylesheet_directory_uri() . '/custom.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');

/**
 * Enqueue FontAwesome
 */
function enqueue_fontawesome() {
    wp_enqueue_style('fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css');
}
add_action('wp_enqueue_scripts', 'enqueue_fontawesome');

/**
 * Theme Setup (Register Menus, Theme Supports)
 */
function blankslate_child_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('automatic-feed-links');
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));

    // Register navigation menus
    register_nav_menus(array(
        'primary'      => __('Primary Menu', 'blankslate-child'),
        'footer-menu'  => __('Footer Menu', 'blankslate-child'),
    ));
    
    // Register a custom image size for the post list
    add_image_size('post-list-small', 250, 9999, false);
}
add_action('after_setup_theme', 'blankslate_child_setup');

/**
 * Register Sidebar Widgets
 */
function blankslate_child_widgets_init() {
    if (!function_exists('register_sidebar')) return;

    register_sidebar(array(
        'name'          => __('Main Sidebar', 'blankslate-child'),
        'id'            => 'sidebar-1',
        'description'   => __('Add widgets here to appear in sidebar.', 'blankslate-child'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));

    register_sidebar(array(
        'name'          => __('Footer Widgets', 'blankslate-child'),
        'id'            => 'footer-widgets',
        'description'   => __('Add widgets here to appear in footer.', 'blankslate-child'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));
}
add_action('widgets_init', 'blankslate_child_widgets_init');

/**
 * Debug: Show Template Hierarchy in Source Code (for logged-in users)
 */
function show_template_hierarchy_in_comment() {
    if (is_user_logged_in()) {
        global $template;
        echo "\n<!-- Template Used: " . esc_html($template) . " -->\n";
    }
}
add_action('wp_footer', 'show_template_hierarchy_in_comment');


/**
 * Shortcode: Admin Only Comments
 * to add to PHP Files use: 
 *      echo do_shortcode('[admincomments]This comment is only visible to logged-in users.[/admincomments]');
 * else:
 *      use [admincomments]This comment is only visible to logged-in users.[/admincomments]
 */
function admin_only_comments_shortcode($atts, $content = null) {
    return is_user_logged_in() ? '<!-- ' . esc_html($content) . ' -->' : '';
}
add_shortcode('admincomments', 'admin_only_comments_shortcode');

/**
 * Disable Comments by Default
 */
function disable_comments_by_default($data) {
    if ($data['post_type'] == 'post' || $data['post_type'] == 'page') {
        $data['comment_status'] = 'closed';
    }
    return $data;
}
add_filter('wp_insert_post_data', 'disable_comments_by_default');

/**
 * Enqueue Lightbox Scripts
 */
function add_lightbox_scripts() {
    wp_enqueue_script('jquery');
    wp_enqueue_script('fancybox', 'https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js', array('jquery'), null, true);
    wp_enqueue_style('fancybox-css', 'https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css');
}
add_action('wp_enqueue_scripts', 'add_lightbox_scripts');

/**
 * Include Custom Functionality Files
 */
require_once get_stylesheet_directory() . '/functions/functions-random-category.php';
require_once get_stylesheet_directory() . '/functions/functions-random-image.php';
require_once get_stylesheet_directory() . '/functions/functions-google-analytics.php';
require_once get_stylesheet_directory() . '/functions/functions-custom-background-images-per-page.php';
require_once get_stylesheet_directory() . '/functions/functions-custom-fields-redirect.php';
require_once get_stylesheet_directory() . '/functions/functions-obsfucate-email.php';
require_once get_stylesheet_directory() . '/functions/functions-favicon.php';
require_once get_stylesheet_directory() . '/functions/functions-recent-posts.php';
/** require_once get_stylesheet_directory() . '/functions/functions-heic-to-png.php'; */
/** require_once get_stylesheet_directory() . '/functions/functions-custom-post-type.php'; */

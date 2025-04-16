<?php
/**
 * Theme Name: Twenty Twenty-Five Child
 * Theme URI: https://wordpress.org/themes/twentytwentyfive/
 * Description: A customized child theme for Twenty Twenty-Five with Open Sans font and cornsilk as secondary color
 * Author: Your Name
 * Author URI: https://yourwebsite.com
 * Template: twentytwentyfive
 * Version: 1.0.0
 * Text Domain: twentytwentyfive-child
 */

// Enqueue parent theme stylesheet
function twentytwentyfive_child_enqueue_styles() {
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('child-style', get_stylesheet_directory_uri() . '/style.css', array('parent-style'));
    
    // Enqueue Open Sans from Google Fonts
    wp_enqueue_style('open-sans', 'https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700;800&display=swap');
    
    // Enqueue custom styles based on selected style
    $selected_style = get_option('twentytwentyfive_child_style', 'default');
    if ($selected_style != 'default') {
        wp_enqueue_style('custom-style', get_stylesheet_directory_uri() . '/styles/' . $selected_style . '.css', array('child-style'));
    }
}
add_action('wp_enqueue_scripts', 'twentytwentyfive_child_enqueue_styles');

// Add custom CSS variables to override parent theme
function twentytwentyfive_child_custom_css_variables() {
    ?>
    <style>
        :root {
            --wp--preset--font-family--system-font: 'Open Sans', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif;
            --wp--preset--color--secondary: cornsilk;
            
            /* Setting Open Sans as primary font */
            --wp--preset--font-family--primary: 'Open Sans', sans-serif;
        }
    </style>
    <?php
}
add_action('wp_head', 'twentytwentyfive_child_custom_css_variables', 99);

// Add Theme Options Page
function twentytwentyfive_child_theme_options_page() {
    add_menu_page(
        'Theme Styles', 
        'Theme Styles', 
        'manage_options', 
        'theme-styles', 
        'twentytwentyfive_child_theme_options_page_html', 
        'dashicons-art', 
        60
    );
}
add_action('admin_menu', 'twentytwentyfive_child_theme_options_page');

// Theme Options Page HTML
function twentytwentyfive_child_theme_options_page_html() {
    // Check user capabilities
    if (!current_user_can('manage_options')) {
        return;
    }
    
    // Save settings if form is submitted
    if (isset($_POST['submit'])) {
        update_option('twentytwentyfive_child_style', sanitize_text_field($_POST['style']));
        echo '<div class="notice notice-success is-dismissible"><p>Style settings saved!</p></div>';
    }
    
    // Get current style setting
    $current_style = get_option('twentytwentyfive_child_style', 'default');
    
    // Available styles
    $styles = array(
        'default' => 'Default Style',
        'light' => 'Light Style',
        'dark' => 'Dark Style',
        'colorful' => 'Colorful Style'
    );
    
    ?>
    <div class="wrap">
        <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
        <form method="post">
            <table class="form-table">
                <tr>
                    <th scope="row">Select Theme Style</th>
                    <td>
                        <select name="style">
                            <?php foreach ($styles as $value => $label) : ?>
                                <option value="<?php echo esc_attr($value); ?>" <?php selected($current_style, $value); ?>>
                                    <?php echo esc_html($label); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                </tr>
            </table>
            <?php submit_button('Save Settings'); ?>
        </form>
    </div>
    <?php
}

// Register a block pattern category for our custom patterns
function twentytwentyfive_child_register_block_pattern_category() {
    register_block_pattern_category(
        'twentytwentyfive-child',
        array('label' => __('Twenty Twenty-Five Child', 'twentytwentyfive-child'))
    );
}
add_action('init', 'twentytwentyfive_child_register_block_pattern_category');

// Register custom block patterns
function twentytwentyfive_child_register_block_patterns() {
    register_block_pattern(
        'twentytwentyfive-child/featured-content',
        array(
            'title'       => __('Featured Content with Open Sans', 'twentytwentyfive-child'),
            'description' => __('A featured content section with Open Sans font styling', 'twentytwentyfive-child'),
            'categories'  => array('twentytwentyfive-child'),
            'content'     => '<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|50","right":"var:preset|spacing|50","bottom":"var:preset|spacing|50","left":"var:preset|spacing|50"}},"backgroundColor":"secondary"},"layout":{"type":"constrained"}} -->
<div class="wp-block-group has-secondary-background-color has-background" style="padding-top:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--50)">
    <!-- wp:heading {"style":{"typography":{"fontFamily":"var:preset|font-family|primary"}}} -->
    <h2 class="wp-block-heading" style="font-family:var(--wp--preset--font-family--primary)">Featured Content</h2>
    <!-- /wp:heading -->
    
    <!-- wp:paragraph {"style":{"typography":{"fontFamily":"var:preset|font-family|primary"}}} -->
    <p style="font-family:var(--wp--preset--font-family--primary)">This is a featured content section with Open Sans styling and cornsilk background.</p>
    <!-- /wp:paragraph -->
    
    <!-- wp:buttons -->
    <div class="wp-block-buttons">
        <!-- wp:button -->
        <div class="wp-block-button"><a class="wp-block-button__link wp-element-button">Learn More</a></div>
        <!-- /wp:button -->
    </div>
    <!-- /wp:buttons -->
</div>
<!-- /wp:group -->',
        )
    );
}
add_action('init', 'twentytwentyfive_child_register_block_patterns');

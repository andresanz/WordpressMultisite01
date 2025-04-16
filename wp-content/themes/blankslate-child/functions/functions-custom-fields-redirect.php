<?php
/**
 * Redirects the current page to a specified URL with optional delay
 *
 * @param string $url      The URL to redirect to
 * @param int    $delay    Optional delay in seconds (default: 0, immediate redirect)
 * @return void
 */
function redirect_to_url($url, $delay = 0) {
    // Validate URL
    if (empty($url) || !filter_var($url, FILTER_VALIDATE_URL)) {
        return;
    }
    
    // Sanitize delay (must be a non-negative integer)
    $delay = max(0, intval($delay));
    
    // For immediate redirect
    if ($delay === 0) {
        // Use wp_safe_redirect instead of wp_redirect for better security
        wp_safe_redirect($url);
        exit;
    } else {
        // For delayed redirect, we need to ensure this runs at the right time
        // Using wp_footer instead of wp_head to ensure it's the last thing loaded
        add_action('wp_footer', function() use ($url, $delay) {
            ?>
            <!-- Delayed redirect to <?php echo esc_url($url); ?> after <?php echo $delay; ?> seconds -->
            <meta http-equiv="refresh" content="<?php echo esc_attr($delay); ?>; url=<?php echo esc_url($url); ?>">
            <script type="text/javascript">
                document.addEventListener('DOMContentLoaded', function() {
                    setTimeout(function() { 
                        window.location.href = "<?php echo esc_js($url); ?>"; 
                    }, <?php echo $delay * 1000; ?>);
                });
            </script>
            <?php
        }, 999); // High priority number to ensure it runs last
    }
}

/**
 * Shortcode version of the redirect function
 * 
 * Usage examples in post/page content:
 * 1. [redirect url="https://example.com"]
 * 2. [redirect url="https://example.com" delay="5"]
 *
 * @param array $atts Shortcode attributes
 * @return string Empty string (shortcode doesn't output content)
 */
function redirect_shortcode($atts) {
    $atts = shortcode_atts(
        array(
            'url'   => '',
            'delay' => 0,
        ),
        $atts,
        'redirect'
    );
    
    if (!empty($atts['url'])) {
        redirect_to_url($atts['url'], $atts['delay']);
    }
    
    return ''; // Return empty string as this shortcode doesn't output content
}
add_shortcode('redirect', 'redirect_shortcode');

/**
 * Register a template redirect hook to handle redirects earlier in the WordPress loading process
 * This ensures the redirect works even if the theme doesn't call wp_head or wp_footer
 */
function handle_early_redirects() {
    // Check if there's a redirect parameter in the URL
    $redirect_url = isset($_GET['redirect_to']) ? $_GET['redirect_to'] : '';
    $redirect_delay = isset($_GET['delay']) ? intval($_GET['delay']) : 0;
    
    if (!empty($redirect_url)) {
        redirect_to_url($redirect_url, $redirect_delay);
    }
}
add_action('template_redirect', 'handle_early_redirects', 1);
<?php
/**
 * Custom Google Analytics implementation for WordPress Multisite
 * Loads different GA codes based on the site URL
 */
function custom_google_analytics_tracking() {
    // Get current site URL and ensure consistency by removing trailing slashes
    $current_url = untrailingslashit(home_url());
    
    // Define analytics tracking codes for each site
    $analytics_codes = array(
        'https://914.io' => 'G-S8TE2TFPDW',
        'https://randomcategory.com' => 'G-Y2DEMKQNQR',
        'https://andresanz.com' => 'G-ZMHRWTT18V',
        'https://lowcountrydead.com' => 'G-ZBW01GYB1S',
        // Add more sites as needed
    );
    
    // Default tracking code (optional)
    $default_code = 'G-ZMHRWTT18V';
    
    // Debug output to help troubleshoot
    // error_log('Current URL: ' . $current_url);
    
    // Determine which tracking code to use
    $tracking_code = $default_code; // Start with default
    
    foreach ($analytics_codes as $site_url => $code) {
        // Standardize the comparison URL
        $site_url = untrailingslashit($site_url);
        
        if ($current_url == $site_url) {
            $tracking_code = $code;
            break;
        }
    }
    
    // Only output code if we have a tracking ID
    if ($tracking_code) {
        ?>
        <!-- Google tag (gtag.js) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo esc_attr($tracking_code); ?>"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());
          gtag('config', '<?php echo esc_attr($tracking_code); ?>');
        </script>
        <?php
    }
}

// Hook the function to wp_head to add it to every page
add_action('wp_head', 'custom_google_analytics_tracking');
<?php
// Get the current domain
$current_domain = parse_url(get_site_url(), PHP_URL_HOST);

// Get the current subdirectory (if any)
$request_uri = trim($_SERVER['REQUEST_URI'], '/');
$subdir = explode('/', $request_uri)[0];

// Debugging output to check detected domain and subdirectory
// // echo "<p>DEBUG: Domain - " . $current_domain . "</p>";
// echo "<p>DEBUG: Subdirectory - " . $subdir . "</p>";

// Define per-site and per-subdirectory HTML content
$custom_content = [
    'example.com' => '<h2>Welcome to Example</h2><p>Example.com main content.</p>',
    'randomcategory.com' => '<h2>Welcome to Random Category</h2><p>Custom content for Random Category site.</p>',
];

$custom_subdir_content = [
    'randomcategory.com/blog' => '<h2>Random Category Blog</h2><p>Custom content for the Blog subdirectory.</p>',
    'example.com/shop' => '<h2>Welcome to Example Shop</h2><p>Exclusive content for the Shop section.</p>',
];

// Default message
$default_content = '<h2>Welcome!</h2><p>This is the default content.</p>';

// Generate the key to check for subdirectory-based content
$domain_subdir_key = $current_domain . '/' . $subdir;

// Output content based on subdirectory first, then domain
if (isset($custom_subdir_content[$domain_subdir_key])) {
    echo $custom_subdir_content[$domain_subdir_key];
} elseif (isset($custom_content[$current_domain])) {
    echo $custom_content[$current_domain];
} else {
    echo "<p>No custom content found for this domain or subdirectory.</p>";
}
?>

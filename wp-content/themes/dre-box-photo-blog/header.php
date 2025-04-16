<?php
/**
 * The header template
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<?php get_template_part('navbar'); ?>

<header class="container mt-3">
    <?php if (function_exists('yoast_breadcrumb')) {
        yoast_breadcrumb('<p id="breadcrumbs">', '</p>');
    } ?>
</header>

<!-- Editable HTML Section (Ensuring Child Theme Directory is Used) -->
<div class="container site-content-container">
    <?php include get_stylesheet_directory() . '/custom-content.php'; ?>
</div>

<?php
/**
 * Custom Header with Dynamic Menu for Twenty Twenty-Five Child Theme
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

<nav class="navbar">
    <div class="navbar-container">
        <a href="<?php echo home_url(); ?>" class="navbar-brand"><?php bloginfo('name'); ?></a>

        <?php
        wp_nav_menu(array(
            'theme_location' => 'primary_menu',
            'menu_class'     => 'navbar-menu',
            'container'      => false,
            'fallback_cb'    => 'wp_page_menu', // Show a fallback menu if no menu is set
        ));
        ?>
    </div>
</nav>

<!-- Original Theme Header -->
<?php get_template_part('template-parts/header/site-header'); ?>

<?php
$menu = wp_nav_menu(array(
    'theme_location' => 'primary_menu',
    'echo'           => false // Prevents direct output
));
if (empty($menu)) {
    echo "<!-- No menu found -->";
} else {
    echo "<!-- Menu loaded -->";
}
?>



<nav class="navbar">
    <div class="navbar-container">
        <a href="<?php echo home_url(); ?>" class="navbar-brand"><?php bloginfo('name'); ?></a>

        <?php
        wp_nav_menu(array(
            'theme_location' => 'primary_menu',
            'menu_class'     => 'navbar-menu',
            'container'      => false,
            'fallback_cb'    => 'wp_page_menu', // Show a fallback menu if no menu is set
        ));
        ?>
    </div>
</nav>
<?php
/**
 * The header for our theme
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <div id="wrapper" class="hfeed">
        <header id="header" role="banner">
            <div class="header-inner container">
                <div id="branding">
                    <a href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_html(get_bloginfo('name')); ?>" rel="home">
                        <?php echo esc_html(get_bloginfo('name')); ?>
                    </a>
                    <div id="site-description"><?php bloginfo('description'); ?></div>
                </div>
                
                <!-- Mobile & Desktop Navigation -->
                
                    
                    <!-- WordPress Menu -->
                    <div id="menu-wrapper">
                        <?php
                            wp_nav_menu(array(
                                'theme_location' => 'primary',
                                'menu_class' => 'menu',
                                'container' => 'ul',
                                'menu_id' => 'menu',
                            ));
                        ?>
                    
            </div>
        </header>
        
        <div id="container">
<?php
/**
 * Template for displaying single portfolio items
 */
get_header();
?>
<main id="content" role="main">
    <div class="container">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('portfolio-item'); ?>>
                <header class="header">
                    <h1 class="entry-title"><?php the_title(); ?></h1>
                </header>
                
                <?php if (has_post_thumbnail()) : ?>
                    <div class="portfolio-image">
                        <?php the_post_thumbnail('full'); ?>
                    </div>
                <?php endif; ?>
                
                <div class="entry-content">
                    <?php the_content(); ?>
                </div>
                
                <footer class="entry-footer">
                    <?php 
                    // Display portfolio metadata or taxonomies if needed
                    ?>
                </footer>
            </article>
            
            <nav id="nav-single" class="navigation">
                <div class="nav-previous"><?php previous_post_link('%link', '<span class="meta-nav">&larr;</span> %title'); ?></div>
                <div class="nav-next"><?php next_post_link('%link', '%title <span class="meta-nav">&rarr;</span>'); ?></div>
            </nav>
        <?php endwhile; endif; ?>
    </div>
</main>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
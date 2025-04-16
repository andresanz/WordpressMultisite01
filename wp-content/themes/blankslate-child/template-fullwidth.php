<?php
/**
 * Template Name: Full Width
 * Description: A full-width template with no sidebar on any screen size
 */

get_header(); ?>

<main id="content" class="full-width-content">
    <div class="container">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="header">
                    <h1 class="entry-title"><?php the_title(); ?></h1>
                </header>
                <div class="entry-content">
                    <?php the_content(); ?>
                    <?php wp_link_pages(array('before' => '<div class="page-links">' . __('Pages:', 'blankslate-child'), 'after' => '</div>')); ?>
                </div>
            </article>
        <?php endwhile; endif; ?>
    </div>
</main>

<style>
    /* Force full width */
    .full-width-content {
        width: 100%;
        max-width: 100%;
    }

    /* Optional: remove padding/margins if container has any */
    .container {
        padding: 0;
        margin: 0 auto;
    }
</style>

<?php get_footer(); ?>
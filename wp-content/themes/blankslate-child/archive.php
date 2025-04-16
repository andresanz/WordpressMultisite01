<?php get_header(); ?>

<header class="header">
    <h1 class="entry-title" itemprop="name">Archive: <?php the_archive_title(); ?></h1>
    <div class="archive-meta" itemprop="description">
        <?php 
        $description = get_the_archive_description();
        if (!empty($description)) {
            echo esc_html($description);
        }
        ?>
    </div>
</header>

    <div class="posts-container">
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
                <?php get_template_part('template-parts/content', 'post'); ?>
            <?php endwhile; ?>

            <?php the_posts_pagination(); ?>
        <?php else : ?>
            <p><?php _e('No posts found.', 'blankslate-child'); ?></p>
        <?php endif; ?>
    </div>

    <?php /* get_template_part('nav', 'below'); */ ?>
    <?php get_footer(); ?>
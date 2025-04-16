<?php
/**
 * Main template file
 */
get_header();
?>
<main id="content" role="main">



<div class="posts-container">
    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
            <?php get_template_part('template-parts/content', 'post'); ?>
        <?php endwhile; ?>
        
        <?php the_posts_pagination(); ?>
        
    <?php else : ?>
        <p><?php _e('No posts found.', 'your-theme-textdomain'); ?></p>
    <?php endif; ?>


</div>
</main>
<?php get_sidebar(); ?>

<?php get_footer(); ?>
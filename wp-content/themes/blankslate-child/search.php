<?php get_header(); ?>
<?php if ( have_posts() ) : ?>
<header class="header">
<h1 class="entry-title" itemprop="name"><?php printf( esc_html__( 'Search Results for: %s', 'blankslate' ), get_search_query() ); ?></h1>
</header>
<?php while ( have_posts() ) : the_post(); ?>
<?php get_template_part( 'entry' ); ?>
<?php endwhile; ?>
<?php get_template_part( 'nav', 'below' ); ?>
<?php else : ?>
<article id="post-0" class="post no-results not-found">
<header class="header">
<h1 class="entry-title" itemprop="name"><?php esc_html_e( 'Nothing Found', 'blankslate' ); ?></h1>
</header>
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
</article>

<?php get_search_form(); ?>
<?php endif; ?>
<?php get_footer(); ?>
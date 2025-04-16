<?php
/**
 * Page Template
 */
get_header();
?>

<main id="content" role="main">
    <div class="container">
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>

                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                    <?php if (!is_front_page()) : // Hide header if it's the front page ?>
                        <header class="page-header">
                            <h1 class="entry-title"><?php the_title(); ?></h1>
                        </header>
                    <?php endif; ?>

                    <div class="entry-content">

                        <?php if (has_post_thumbnail() && !is_front_page()) : // Hide thumbnail if front page ?>
                            <div class="entry-thumbnail">
                                <?php the_post_thumbnail('full', ['loading' => 'lazy']); ?>
                            </div>
                        <?php endif; ?>

                        <?php
                        // Add a wrapper div ONLY if it's the homepage
                        if (is_front_page()) : 
                        ?>
                            <div class="recent-posts-grid">
                                <?php the_content(); ?>
                            </div>
                        <?php else : ?>
                            <?php the_content(); ?>
                        <?php endif; ?>

                        <?php
                        wp_link_pages(array(
                            'before' => '<div class="page-links"><span class="page-links-title">' . __('Pages:', 'blankslate-child') . '</span>',
                            'after'  => '</div>',
                            'link_before' => '<span>',
                            'link_after' => '</span>',
                        ));
                        ?>

                    </div><!-- .entry-content -->

                </article><!-- #post-## -->

                <?php
                if (comments_open() && !post_password_required()) {
                    comments_template();
                }
                ?>

            <?php endwhile; ?>
        <?php endif; ?>
    </div><!-- .container -->
</main>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
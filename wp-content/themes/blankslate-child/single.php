<?php
/**
 * Single post template
 */
get_header();
?>

<main id="content" role="main">
    <div class="container">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="header">

                <?php get_template_part('template-parts/content', 'post'); ?>

                </header>
                <div class="entry-content">
                    
            

                    <?php the_content(); ?>
                    <?php wp_link_pages(); ?>
                </div>
                
                
            </article>
            <?php comments_template(); ?>
        <?php endwhile; endif; ?>
        
        <nav id="nav-single" class="navigation">
    <div class="nav-previous"><?php previous_post_link('%link', '<span class="meta-nav"><i class="fa-solid fa-caret-left"></i></i></span> %title'); ?></div>
    <div class="nav-next"><?php next_post_link('%link', '%title <span class="meta-nav"><i class="fa-solid fa-caret-right"></i></span>'); ?></div>
</nav>
    </div>
</main>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
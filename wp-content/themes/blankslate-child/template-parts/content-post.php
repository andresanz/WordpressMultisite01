<article id="post-<?php the_ID(); ?>" <?php post_class('post-item'); ?>>
    <div class="post-layout">
        <?php if (is_single()) : ?>
            <!-- Single post layout - title and meta at the top -->
            <div class="post-header">
                <h2 class="entry-title">
                    <?php the_title(); ?>
                </h2>
                
                <div class="entry-meta">
                    <?php echo get_the_date(); ?> 
                    <!-- by <?php the_author(); ?> -->
                    
                    <!-- Categories -->
                    <?php if (has_category()) : ?>
                        <span class="post-categories">
                            <span class="meta-separator">|</span>
                            <span class="meta-title">Categories:</span>
                            <?php the_category(', '); ?>
                        </span>
                    <?php endif; ?>
                    
                    <!-- Tags -->
                    <?php if (has_tag()) : ?>
                        <span class="post-tags">
                            <span class="meta-separator">|</span>
                            <span class="meta-title">Tags:</span>
                            <?php the_tags('', ', ', ''); ?>
                        </span>
                    <?php endif; ?>

                    <!-- next/prev for single posts -->
                    <span class="post-navigation">
                        <span class="meta-separator">|</span>
                        <?php previous_post_link('%link', '<span><i class="fa-solid fa-caret-left"></i></span>'); ?>
                        <?php next_post_link('%link', '<span><i class="fa-solid fa-caret-right"></i></span>'); ?>
                    </span>
                </div>
            </div>
        <?php else : ?>
            <!-- Archive/index layout - two columns with thumbnail left, content right -->
            <div class="post-columns">
                <!-- Featured Image Section (left) -->
                <div class="post-thumbnail">
                    <a href="<?php the_permalink(); ?>">
                        <?php 
                        if (has_post_thumbnail()) {
                            the_post_thumbnail('medium');
                        } else { 
                            $placeholder_url = "https://placehold.co/200x150?text=No+Image";
                        ?>
                            <img src="<?php echo esc_url($placeholder_url); ?>" alt="Placeholder Image">
                        <?php } ?>
                    </a>
                </div>

                <!-- Content column (right) - contains title, meta, and excerpt -->
                <div class="post-content">
                    <!-- Title -->
                    <h2 class="entry-title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h2>
                    
                    <!-- Meta information -->
                    <div class="entry-meta">
                        <?php echo get_the_date(); ?> 
                        
                        <!-- Categories -->
                        <?php if (has_category()) : ?>
                            <span class="post-categories">
                                <span class="meta-separator">|</span>
                                <span class="meta-title">Categories:</span>
                                <?php the_category(', '); ?>
                            </span>
                        <?php endif; ?>
                        
                        <!-- Tags -->
                        <?php if (has_tag()) : ?>
                            <span class="post-tags">
                                <span class="meta-separator">|</span>
                                <span class="meta-title">Tags:</span>
                                <?php the_tags('', ', ', ''); ?>
                            </span>
                        <?php endif; ?>
                    </div>
                    
                    <!-- Post Excerpt -->
                    <a href="<?php the_permalink(); ?>" class="entry-excerpt-link">
                        <div class="entry-excerpt">
                            <?php 
                            $excerpt = get_the_excerpt();
                            if (empty($excerpt)) {
                                echo '<p>' . wp_trim_words(get_the_content(), 30, ' <i class="fa-solid fa-angle-right"></i>') . '</p>';
                            } else {
                                echo wp_trim_words(get_the_excerpt(), 30, ' <i class="fa-solid fa-angle-right"></i>'); 
                            }
                            ?>
                        </div>
                    </a>
                </div>
            </div>
        <?php endif; ?>
    </div>
</article>
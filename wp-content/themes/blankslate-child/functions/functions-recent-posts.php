<?php

function lrecentposts_shortcode($atts) {
    $atts = shortcode_atts(array(
        '0' => 3,              // number of posts
        '1' => 'randomcategory.com'              // domain(s), e.g. getlocal.help or multiple like domain1.com,domain2.com
    ), $atts);

    $num_posts = intval($atts[0]);
    $domains_raw = trim($atts[1]);

    $selected_blogs = [];

    if (!empty($domains_raw)) {
        $wanted_domains = array_map('trim', explode(',', $domains_raw));
        $all_sites = get_sites(['public' => 1]);

        foreach ($all_sites as $site) {
            $url = get_site_url($site->blog_id);
            $domain = parse_url($url, PHP_URL_HOST);

            if (in_array($domain, $wanted_domains)) {
                $selected_blogs[] = $site;
            }
        }
    } else {
        // Use all public blogs by default
        $selected_blogs = get_sites(['public' => 1]);
    }

    $all_posts = [];

    foreach ($selected_blogs as $site) {
        switch_to_blog($site->blog_id);

        $posts = get_posts([
            'numberposts' => $num_posts,
            'post_status' => 'publish',
            'post_type'   => 'post'
        ]);

        foreach ($posts as $post) {
            $post->blog_id = $site->blog_id;
            $post->blogname = get_bloginfo('name');
            $post->permalink = get_permalink($post->ID);
            $post->has_thumb = has_post_thumbnail($post->ID);
            $post->thumb = $post->has_thumb ? get_the_post_thumbnail($post->ID, 'medium') : null;
            $post->date = get_the_date('', $post->ID);
            $post->excerpt = get_the_excerpt($post->ID);
            $all_posts[] = $post;
        }

        restore_current_blog();
    }

    usort($all_posts, fn($a, $b) => strtotime($b->post_date) - strtotime($a->post_date));
    $all_posts = array_slice($all_posts, 0, $num_posts);

    ob_start();

    foreach ($all_posts as $post) {
        switch_to_blog($post->blog_id);
        ?>
        <article id="post-<?php echo esc_attr($post->ID); ?>" class="post-item">
            <div class="post-layout">
                <div class="post-columns">
                    <div class="post-thumbnail">
                        <a href="<?php echo esc_url($post->permalink); ?>">
                            <?php 
                            if ($post->has_thumb) {
                                echo $post->thumb;
                            } else {
                                echo '<img src="https://placehold.co/200x150?text=No+Image" alt="Placeholder">';
                            }
                            ?>
                        </a>
                    </div>
                    <div class="post-content">
                        <h2>
                            <a href="<?php echo esc_url($post->permalink); ?>"><?php echo esc_html(get_the_title($post->ID)); ?></a>
                        </h2>
                        <div class="entry-meta">
                            <?php echo esc_html($post->date); ?>
                            <?php
                            $categories = get_the_category($post->ID);
                            if (!empty($categories)) : ?>
                                <span class="post-categories">
                                    <span class="meta-separator">|</span>
                                    <span class="meta-title">Categories:</span>
                                    <?php
                                    $cats = [];
                                    foreach ($categories as $cat) {
                                        $cats[] = '<a href="' . esc_url(get_category_link($cat->term_id)) . '">' . esc_html($cat->name) . '</a>';
                                    }
                                    echo implode(', ', $cats);
                                    ?>
                                </span>
                            <?php endif; ?>
                        </div>
                        <a href="<?php echo esc_url($post->permalink); ?>" class="entry-excerpt-link">
                            <div class="entry-excerpt">
                                <p style="color: red; font-size: .9em !important;"><?php echo wp_trim_words($post->excerpt ?: get_post_field('post_content', $post->ID), 30, ' <i class="fa-solid fa-angle-right"></i>'); ?></p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </article>
        <?php
        restore_current_blog();
    }

    return ob_get_clean();
}
add_shortcode('lrecentposts', 'lrecentposts_shortcode');
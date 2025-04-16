<?php
/**
 * Template Name: Centered Shortcode (Bare)
 */
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php the_title(); ?></title>
  <?php wp_head(); ?>
  <style>
    html, body {
      height: 100%;
      margin: 0;
    }

    .center-shortcode-container {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      text-align: center;
      padding: 1rem;
    }
  </style>
</head>
<body <?php body_class(); ?>>
  <div class="center-shortcode-container">
    <div>
      <?php
        while ( have_posts() ) : the_post();
          the_content();
        endwhile;
      ?>
    </div>
  </div>
  <?php wp_footer(); ?>
</body>
</html>
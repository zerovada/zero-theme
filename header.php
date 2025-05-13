<?php
// header.php
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<header class="site-header">
  <div class="site-branding">
    <?php if ( has_custom_logo() ) : ?>
      <?php the_custom_logo(); ?>
    <?php else : ?>
      <a class="site-title" href="<?php echo esc_url( home_url() ); ?>">
        <?php bloginfo( 'name' ); ?>
      </a>
    <?php endif; ?>

    <?php if ( get_bloginfo( 'description' ) ) : ?>
      <p class="site-tagline"><?php bloginfo( 'description' ); ?></p>
    <?php endif; ?>
  </div>

  <nav class="site-nav" aria-label="<?php esc_attr_e( 'Primary Menu', 'zero' ); ?>">
    <?php
    wp_nav_menu( [
      'theme_location' => 'primary',
      'menu_class'     => 'menu',
      'container'      => false,
    ] );
    ?>
  </nav>
</header>

<main class="site-content">

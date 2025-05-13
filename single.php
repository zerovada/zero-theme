<?php
// single.php
get_header();
if ( have_posts() ) :
  while ( have_posts() ) : the_post();
    ?><article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
      <header class="entry-header">
        <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
      </header>
      <div class="entry-content">
        <?php the_content(); ?>
        <?php
        wp_link_pages( [
          'before' => '<nav class="page-links">' . esc_html__( 'Pages:', 'zero' ),
          'after'  => '</nav>',
        ] );
        ?>
      </div>
      <footer class="entry-footer">
        <?php zero_post_meta(); ?>
      </footer>
    </article><?php
    if ( comments_open() || get_comments_number() ) {
      comments_template();
    }
  endwhile;
endif;
get_footer();

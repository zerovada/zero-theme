<?php
// archive.php
get_header();
if ( have_posts() ) :
  ?><header class="archive-header">
    <h1 class="archive-title">
      <?php the_archive_title(); ?>
    </h1>
    <div class="archive-description">
      <?php the_archive_description(); ?>
    </div>
  </header><?php
  while ( have_posts() ) : the_post();
    get_template_part( 'template-parts/content', get_post_type() );
  endwhile;
  the_posts_pagination();
else :
  get_template_part( 'template-parts/content', 'none' );
endif;
get_footer();

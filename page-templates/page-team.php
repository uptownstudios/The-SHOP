<?php
/*
Template Name: Team Page
*/
get_header();

$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
$args = array( 'post_type' => 'team', 'posts_per_page' => 3, 'paged' => $paged );
$loop = new WP_Query( $args );
?>

<?php get_template_part( 'template-parts/title-bar' ); ?>

<div id="page-full-width" role="main">

<?php do_action( 'foundationpress_before_content' ); ?>
  <article <?php post_class('main-content bs-isotope-wrapper') ?> id="post-<?php the_ID(); ?>">
      <?php do_action( 'foundationpress_page_before_entry_content' ); ?>
      <div class="entry-content bs-isotope">
          <?php the_content(); ?>
          <?php get_template_part( 'template-parts/content','team' ); ?>
      </div>
  </article>
  <?php if ($loop->max_num_pages > 1) { // check if the max number of pages is greater than 1  ?>
    <nav class="prev-next-posts">
      <div class="prev-posts-link">
        <?php echo get_next_posts_link( '&laquo; Older Posts', $loop->max_num_pages ); // display older posts link ?>
      </div>
      <div class="next-posts-link">
        <?php echo get_previous_posts_link( 'Newer Posts &raquo;' ); // display newer posts link ?>
      </div>
    </nav>
  <?php } ?>

<?php do_action( 'foundationpress_after_content' ); ?>

</div>

<?php get_footer();

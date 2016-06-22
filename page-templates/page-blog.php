<?php
/*
Template Name: Blog Page
*/
get_header(); ?>

<?php get_template_part( 'template-parts/title-bar' ); ?>

<div id="page-full-width" role="main">

<?php do_action( 'foundationpress_before_content' ); ?>
  <article <?php post_class('main-content') ?> id="post-<?php the_ID(); ?>">
      <?php do_action( 'foundationpress_page_before_entry_content' ); ?>
      <div class="entry-content">
          <?php the_content(); ?>
          <?php get_template_part( 'template-parts/content','blog' ); ?>
      </div>
  </article>

<?php do_action( 'foundationpress_after_content' ); ?>

</div>

<?php get_footer();

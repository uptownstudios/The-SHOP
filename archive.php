<?php
/**
 * The template for displaying archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each one. For example, tag.php (Tag archives),
 * category.php (Category archives), author.php (Author archives), etc.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

get_header(); ?>

<?php get_template_part( 'template-parts/archive-title-bar' ); ?>

<div id="page" class="archives-wrapper max-width-sixteen-hundred no-sidebar" role="main">
	<article class="main-content">
	<div class="entry-content bs-isotope">
	<?php if ( have_posts() ) : ?>

		<?php /* Start the Loop */ ?>
		<?php while ( have_posts() ) : the_post(); ?>
			<?php get_template_part( 'template-parts/content', get_post_format() ); ?>
		<?php endwhile; ?>

		<?php else : ?>
			<?php get_template_part( 'template-parts/content', 'none' ); ?>

		<?php endif; // End have_posts() check. ?>

	</article>
</div>
<nav class="prev-next-posts">
	<div class="prev-posts-link">
		<?php echo get_next_posts_link( '&laquo; Older Posts', $loop->max_num_pages ); // display older posts link ?>
	</div>
	<div class="next-posts-link">
		<?php echo get_previous_posts_link( 'Newer Posts &raquo;' ); // display newer posts link ?>
	</div>
</nav>

<?php get_footer();

<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

get_header(); ?>

<?php get_template_part( 'template-parts/portfolio-title-bar' ); ?>

<div id="single-post" class="page-full-width max-width-sixteen-hundred no-sidebar" role="main">

<?php do_action( 'foundationpress_before_content' ); ?>
<?php while ( have_posts() ) : the_post(); ?>
	<article <?php post_class('main-content') ?> id="post-<?php the_ID(); ?>">
		<?php do_action( 'foundationpress_post_before_entry_content' ); ?>
		<div class="entry-content">

		<?php
			$description = get_field('photo_portfolio_description');
			$photocategory = get_field('photo_portfolio_category');
			$photodate = get_field('date_of_photo_shoot');
			$gallery = get_field('photo_portfolio_images', false, false);
			$videosource = get_field('photo_portfolio_video_source');
		?>
			<div class="portfolio-wrap">
				<div class="portfolio-main-image">
					<?php if(get_field('photo_portfolio_images')) : ?>
					<div class="portfolio-gallery">
						<?php
							$shortcode = '[gallery ids="' . implode(',', $gallery) . '" columns="4" size="thumbnail"]';
							echo do_shortcode( $shortcode );
						?>
					</div>
					<?php endif; ?>
					<?php if(get_field('photo_portfolio_video_source')) : ?>
						<?php echo $videosource; ?>
					<?php endif; ?>
				</div>
				<div class="portfolio-description">
					<div class="portfolio-description-inner">
						<?php if($description) { ?>
						<h2>Project Overview</h2>
						<p><strong>Date of shoot:</strong> <?php echo $photodate; ?></p>
						<?php echo $description; ?>
						<?php } ?>

						<?php $posttags = get_the_tags(); if ($posttags) { ?>
						<div class="the-tags">
							<?php foreach($posttags as $tag) {
							  echo '<a href="' . get_bloginfo('url') . '/tag/'  . $tag->slug . '"><span class="tag">#' . $tag->slug . '</a></span>';
							} ?>
						</div>
						<?php } ?>
					</div>
				</div>
			</div>

		</div>

		<nav id="nav-single" class="nav-single">
			<div class="nav-single-inner">
				<span class="nav-previous"><?php next_post_link( '%link', '<span class="meta-nav">' . _x( '&laquo;', 'Previous post link', 'wp-forge' ) . '</span> %title' ); ?></span>
				<span class="nav-next"><?php previous_post_link( '%link', '%title <span class="meta-nav">' . _x( '&raquo;', 'Next post link', 'wp-forge' ) . '</span>' ); ?></span>
			</div>
		</nav><!-- .nav-single -->
		<?php do_action( 'foundationpress_post_before_comments' ); ?>
		<?php comments_template(); ?>
		<?php do_action( 'foundationpress_post_after_comments' ); ?>
	</article>
<?php endwhile;?>

<?php do_action( 'foundationpress_after_content' ); ?>
</div>
<?php get_footer();

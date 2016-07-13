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
			$description = get_field('bs_portfolio_description');
			$mainimg = get_field('bs_portfolio_main_image');
			$mainvid = get_field('bs_portfolio_main_video');
			$gallery = get_field('bs_portfolio_gallery', false, false);
			$imgorvid = get_field('bs_image_or_video');
		?>
			<div class="portfolio-wrap">
				<div class="portfolio-main-image">
					<?php if($imageorvid == 'image') {?>
					<img src="<?php echo $mainimg['url']; ?>" alt="<?php echo $mainimg['alt']; ?>" />
					<?php } else { echo $mainvid;	} ?>
				</div>
				<div class="portfolio-description">
					<div class="portfolio-description-inner">
						<h2>Project Overview</h2>
						<?php echo $description; ?>

						<?php	if( have_rows('bs_portfolio_mbs') ): ?>

							<div class="portfolio-buttons-wrapper">

							<?php while ( have_rows('bs_portfolio_mbs') ) : the_row();
								$mbt = get_sub_field('bs_portfolio_mbt');
								$mbu = get_sub_field('bs_portfolio_mbu');
							?>

								<a class="bs-btn bs-btn-red" href="<?php echo $mbu; ?>" target="_blank" title="<?php echo $mbt; ?>"><?php echo $mbt; ?></a>

							<?php endwhile; ?>

							</div>

						<?php endif; ?>

						<?php if($gallery) { ?>
						<div class="clearfix clear"></div>
						<div class="portfolio-gallery">
							<h3>Project Gallery</h3>
							<?php
								$shortcode = '[gallery ids="' . implode(',', $gallery) . '" columns="4" size="thumbnail"]';
								echo do_shortcode( $shortcode );
							?>
						</div>
						<?php } ?>
						<?php $posttags = get_the_tags(); if ($posttags) { ?>
						<div class="the-tags">
							<?php foreach($posttags as $tag) {
							  echo '<a href="' . get_bloginfo('url') . '/tag/'  . $tag->slug . '"><span class="tag">#' . $tag->name . '</a></span>';
							} ?>
						</div>
						<?php } ?>
					</div>
				</div>
			</div>

		</div>

		<nav id="nav-single" class="nav-single">
			<div class="nav-single-inner">
				<span class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&laquo;', 'Previous post link', 'wp-forge' ) . '</span> %title' ); ?></span>
				<span class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&raquo;', 'Next post link', 'wp-forge' ) . '</span>' ); ?></span>
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

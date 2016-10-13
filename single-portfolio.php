<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

get_header(); ?>

<div id="single-post" class="page-full-width max-width-eleven-seventy no-sidebar" role="main">

<?php do_action( 'foundationpress_before_content' ); ?>
<?php while ( have_posts() ) : the_post(); ?>
	<article <?php post_class('main-content') ?> id="post-<?php the_ID(); ?>">
		<?php do_action( 'foundationpress_post_before_entry_content' ); ?>
		<div class="entry-content">

		<?php
			$teaser = get_field('project_teaser');
			$description = get_field('project_desciption');
			$gallery = get_field('project_images');
			$estcost = get_field('project_estimated_cost');

			$tax_impact = 'portfolio-impact';
			$tax_impact_terms = get_terms($tax_impact);
			$all_impact_terms;
			$filter_impact_text = '';

      $tax_cat = 'portfolio-cat';
      $tax_cat_terms = get_terms($tax_cat);
      $all_cat_terms;
      $filter_cat_text = '';

			$tax_status = 'portfolio-status';
			$tax_status_terms = get_terms($tax_status);
			$all_status_terms;
			$filter_status_text = '';
		?>
			<div class="portfolio-wrap">
				<div class="portfolio-meta-info">
					<div class="portfolio-meta-chunk areas-of-impact">
						<h3>Areas of Impact</h3>
						<ul>
							<?php $impact_terms = get_the_terms( $post->ID , 'portfolio-impact' ); if ( $impact_terms ) { foreach ( $impact_terms as $impact_term ) { echo '<li class="impact"><span>' . $impact_term->name . '</span></li>'; } } ?>
						</ul>
					</div>
					<div class="portfolio-meta-chunk cat-status-cost">
						<?php $cat_terms = get_the_terms( $post->ID , 'portfolio-cat' ); if ( $cat_terms ) { ?><p><strong>Category</strong> <?php foreach ( $cat_terms as $cat_term ) { echo '<span class="category">' . $cat_term->name . '</span>'; } ?></p><?php } ?>
						<?php $status_terms = get_the_terms( $post->ID , 'portfolio-status' ); if ( $status_terms ) { ?><p><strong>Status</strong> <?php foreach ( $status_terms as $status_term ) { echo '<span class="status">' . $status_term->name . '</span>'; } ?></p><?php } ?>
						<?php if($estcost) {?><p><strong>Estimated Cost</strong> <?php echo $estcost; ?></p><?php } ?>
					</div>
					<?php if( have_rows('project_int_partners') ): ?>
					<div class="portfolio-meta-chunk internal-partners">
						<h3>Internal Partners</h3>
						<ul>
							<?php while( have_rows('project_int_partners') ): the_row();
								$name = get_sub_field('project_int_partner');
								$url = get_sub_field('project_int_partner_url');
							?>
							<li>
								<?php if($url): ?>
								<a href="<?php echo $url; ?>">
								<?php endif; ?>
								<?php echo $name; ?>
								<?php if($url): ?>
								</a>
								<?php endif; ?>
							</li>
							<?php endwhile; ?>
						</ul>
					</div>
					<?php endif; ?>

					<?php if( have_rows('project_ext_partners') ): ?>
					<div class="portfolio-meta-chunk external-partners">
						<h3>External Partners</h3>
						<ul>
							<?php while( have_rows('project_ext_partners') ): the_row();
								$name = get_sub_field('project_ext_partner');
								$url = get_sub_field('project_ext_partner_url');
							?>
							<li>
								<?php if($url): ?>
								<a href="<?php echo $url; ?>">
								<?php endif; ?>
								<?php echo $name; ?>
								<?php if($url): ?>
								</a>
								<?php endif; ?>
							</li>
							<?php endwhile; ?>
						</ul>
					</div>
					<?php endif; ?>

					<div class="portfolio-meta-chunk project-successes">
						<h3>Successes</h3>
						<?php if( have_rows('project_successes') ): ?>
						<ul>
							<?php while( have_rows('project_successes') ): the_row();
								$success = get_sub_field('project_success');
							?>
							<li>
								<?php echo $success; ?>
							</li>
							<?php endwhile; ?>
						</ul>
						<?php else: ?>
						<ul>
							<li class="tbd">TBD</li>
						</ul>
						<?php endif; ?>
					</div>

					<div class="portfolio-meta-chunk project-failures">
						<h3>Successes</h3>
						<?php if( have_rows('project_failures') ): ?>
						<ul>
							<?php while( have_rows('project_failures') ): the_row();
								$failure = get_sub_field('project_failure');
							?>
							<li>
								<?php echo $failure; ?>
							</li>
							<?php endwhile; ?>
						</ul>
						<?php else: ?>
						<ul>
							<li class="tbd">TBD</li>
						</ul>
						<?php endif; ?>
					</div>
				</div>
				<div class="portfolio-description">
					<div class="portfolio-description-inner">
						<header><h1 class="entry-title"><span class="pre-title">Project</span><?php the_title(); ?></h1></header>

						<div class="portfolio-teaser">
							<?php echo $teaser; ?>
						</div>

						<?php if( $gallery ): ?>
						<div class="portfolio-gallery">
					    <div id="gallery" class="bs-carousel">
				        <?php foreach( $gallery as $image ): ?>
		            <div>
	                <a class="swipebox" href="<?php echo $image['url']; ?>" title="<?php echo $image['title']; ?>" rel="gallery-1">
	                  <img src="<?php echo $image['sizes']['large']; ?>" alt="<?php echo $image['alt']; ?>" />
	                </a>
		            </div>
				        <?php endforeach; ?>
					    </div>
						</div>
						<?php endif; ?>

						<div class="portfolio-content">
							<?php echo $description; ?>
						</div>

					</div>
					<nav id="nav-single" class="nav-single">
						<div class="nav-single-inner">
							<span class="nav-previous"><?php next_post_link( '%link', '<span class="meta-nav">' . _x( '&laquo;', 'Previous post link', 'wp-forge' ) . '</span> %title' ); ?></span>
							<span class="nav-next"><?php previous_post_link( '%link', '%title <span class="meta-nav">' . _x( '&raquo;', 'Next post link', 'wp-forge' ) . '</span>' ); ?></span>
						</div>
					</nav><!-- .nav-single -->
				</div>
			</div>

		</div>

		<!-- <?php do_action( 'foundationpress_post_before_comments' ); ?>
		<?php comments_template(); ?>
		<?php do_action( 'foundationpress_post_after_comments' ); ?> -->
	</article>
<?php endwhile;?>

<?php do_action( 'foundationpress_after_content' ); ?>
</div>
<?php get_footer();

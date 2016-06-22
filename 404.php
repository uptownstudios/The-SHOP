<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

get_header(); ?>

<?php get_template_part( 'template-parts/404-title-bar' ); ?>

<div id="four-o-four-wrapper" class="row">
	<div class="small-12 large-8 columns" role="main">

		<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
			<header>
				<h1 class="entry-title"><?php _e( 'Oops...oh well!', 'foundationpress' ); ?></h1>
			</header>
			<div class="entry-content">
				<div class="error">
					<p class="bottom"><?php _e( 'The page you are looking cannot be fond. It might have been removed, had its name changed, or is temporarily unavailable.', 'foundationpress' ); ?></p>
				</div>
				<p><?php _e( 'Please try the following:', 'foundationpress' ); ?></p>
				<ul>
					<li><?php _e( 'Check your spelling, dummy!', 'foundationpress' ); ?></li>
					<li><?php printf( __( 'Return to the <a href="%s">home page</a>', 'foundationpress' ), home_url() ); ?></li>
					<li><?php _e( 'Click the <a href="javascript:history.back()">Back</a> button', 'foundationpress' ); ?></li>
				</ul>
			</div>
		</article>

	</div>
	<?php get_sidebar(); ?>
</div>
<?php get_footer();

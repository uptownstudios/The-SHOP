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
	<div class="small-12 large-4 columns">
		<img src="<?php bloginfo('url'); ?>/wp-content/uploads/2016/08/404-01.svg" style="border: 1px solid #e1e1e1; border-radius: 100%;" />
	</div>
	<div class="small-12 large-8 columns" role="main">

		<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
			<header>
				<h1 class="entry-title"><?php _e( 'Ah man!', 'foundationpress' ); ?></h1>
			</header>
			<div class="entry-content">
				<div class="error">
					<p class="bottom"><?php _e( 'The page you are looking cannot be found. It might have been removed, had its name changed, or is temporarily unavailable.', 'foundationpress' ); ?></p>
				</div>
				<h3><?php _e( 'Please try the following', 'foundationpress' ); ?></h3>
				<ul>
					<li><?php _e( 'Check your spelling, ya dunce!', 'foundationpress' ); ?></li>
					<li><?php printf( __( 'Return to the <a href="%s">home page</a>', 'foundationpress' ), home_url() ); ?></li>
					<li><?php _e( 'Click the <a href="javascript:history.back()">Back</a> button', 'foundationpress' ); ?></li>
				</ul>
				<p><?php _e( 'Even though you couldn&rsquo;t find what you were looking for, we do have other great stuff to look at. Below is a list of our latest posts: ', 'wp-forge' ); ?></p>
					<div class="row fourohfour-recent-posts">
						<ul class="small-12 large-4 columns">
						<?php
							$recent_posts = wp_get_recent_posts(array('post_status' => 'publish', 'numberposts' => 3));
							foreach( $recent_posts as $recent ){
								echo '<li><a href="' . get_permalink($recent["ID"]) . '">' .   $recent["post_title"].'</a> </li> ';
							}
						?>
						</ul>
						<ul class="small-12 large-4 columns">
						<?php
							$recent_posts = wp_get_recent_posts(array('post_status' => 'publish', 'numberposts' => 3, 'offset' => 3));
							foreach( $recent_posts as $recent ){
								echo '<li><a href="' . get_permalink($recent["ID"]) . '">' .   $recent["post_title"].'</a> </li> ';
							}
						?>
						</ul>
						<ul class="small-12 large-4 columns">
						<?php
							$recent_posts = wp_get_recent_posts(array('post_status' => 'publish', 'numberposts' => 3, 'offset' => 6));
							foreach( $recent_posts as $recent ){
								echo '<li><a href="' . get_permalink($recent["ID"]) . '">' .   $recent["post_title"].'</a> </li> ';
							}
						?>
						</ul>
					</div>
			</div>
		</article>

	</div>
</div>
<?php get_footer();

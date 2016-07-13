<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */
global $post;
?>

<div id="post-<?php the_ID(); ?>" <?php post_class('blogpost-entry bs-isotope-item'); ?>>

	<article id="post-<?php the_ID(); ?>" <?php post_class('index-card'); ?>>
		<div class="entry-content">
			<?php if ( has_post_thumbnail() ) { ?>
			<div class="blog-page-featured-image">
				<figure><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a></figure>
			</div>
			<?php } ?>
			<div class="blog-page-title-excerpt">
				<h3><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
				<p class="author-date">Published on <?php the_date(); ?></p>
				<?php the_excerpt(); ?>
				<p class="post-type"><?php if ( get_post_type( get_the_ID() ) == 'post' ) { ?>Blog Post<?php } ?><?php if ( get_post_type( get_the_ID() ) == 'portfolio' ) { ?>Portfolio Item<?php } ?><?php if ( get_post_type( get_the_ID() ) == 'event' ) { ?>Event<?php } ?></p>
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">Read More &raquo;</a>
			</div>
		</div>
	</article>
</div>

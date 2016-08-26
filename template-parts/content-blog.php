<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
$args = array( 'post_type' => 'post', 'posts_per_page' => 18, 'status' => 'published', 'paged' => $paged );
$loop = new WP_Query( $args );

?>
			<?php if ( $loop->have_posts()) : while ( $loop->have_posts()) : $loop->the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class('index-card bs-isotope-item'); ?>>
					<div class="entry-content">
						<?php
							$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
							$image = $image[0];
							$imageSrcSet = wp_get_attachment_image_srcset( get_post_thumbnail_id( $post->ID ), 'full' );
							$imagealt = get_post_meta( get_post_thumbnail_id( $post->ID ), '_wp_attachment_image_alt', true );
							if( empty($imagealt)) {
								$imagealt = get_the_title() . ' Featured Image';
							}
						?>
						<?php if ( has_post_thumbnail() ) { ?>
						<div class="blog-page-featured-image">
							<figure><a href="<?php the_permalink(); ?>"><img alt="<?php echo $imagealt; ?>" data-sizes="auto" data-src="<?php echo $image; ?>" data-srcset="<?php echo $imageSrcSet; ?>" class="lazyload" /><noscript><img src="<?php echo $image; ?>" alt="<?php echo $imagealt; ?>" /></noscript></a></figure>
						</div>
						<span class="avatar alt-avatar"><?php echo get_avatar( get_the_author_meta( 'ID' ), 100 ); ?></span>
						<?php } ?>
						<div class="blog-page-title-excerpt">
							<h3 <?php if ( has_post_thumbnail() ) { ?>class="alt-avatar-title"<?php } ?>><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
							<p class="author-date">Published on <?php the_date(); ?></p>
							<p class="author-byline"><?php if ( !has_post_thumbnail() ) { ?><span class="avatar"><?php echo get_avatar( get_the_author_meta( 'ID' ), 100 ); ?></span><?php } ?><span class="byline">By <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' )); ?>" title=""><?php the_author_meta( 'display_name', $author_id ); ?></a></span>
							<?php the_excerpt(); ?></p>
							<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">Read More &raquo;</a>
						</div>
					</div>
				</article>
			<?php endwhile; endif; ?>
			<div class="clear"></div>

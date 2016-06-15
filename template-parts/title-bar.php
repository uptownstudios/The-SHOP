<?php
	// If a feature image is set, get the id, so it can be injected as a css background property
	if ( has_post_thumbnail( $post->ID ) ) :
		$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
		$image = $image[0];
		$bg_repeat = get_field('bs_background_repeat');
		$bg_color = get_field('bs_background_color');
		$bg_custom_size = get_field('bs_background_custom_size');
		$bg_choose_size = get_field('bs_background_size');
		$title_color = get_field('bs_title_color');
		if($bg_choose_size != 'custom') {
			$bg_size = get_field('bs_background_size');
		} else {
			$bg_size = $bg_custom_size;
		}
?>
	<header id="featured-hero" role="banner" style="background-image: url('<?php echo $image ?>'); background-repeat: <?php echo $bg_repeat; ?>; background-color: <?php echo $bg_color; ?>; background-size: <?php echo $bg_size; ?>;">
		<h1 class="entry-title <?php if($title_color == 'dark') {?> dark<?php } ?>"><span><?php the_title(); ?></span></h1>
	</header>
	<div id="init-header-change"></div>
<?php endif;

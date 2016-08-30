<?php
	// If a feature image is set, get the id, so it can be injected as a css background property
	$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
	$image = $image[0];
?>
	<header id="featured-hero" role="banner">
		<h1 class="entry-title"><span class="entry-title-inner"><?php the_title(); ?></span></h1>
	</header>
	<div id="init-header-change"></div>

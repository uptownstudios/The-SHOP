<?php
	global $post;
	$author_id = $post->post_author;
	$date_published = $post->the_date;
?>

	<header id="featured-hero" class="service-featured-hero" role="banner" style="background-image: url('<?php bloginfo('url'); ?>/wp-content/uploads/2016/06/tie-fighter-wing02.svg'); background-repeat: repeat; background-color: #a8c9e9; background-size: 290px;">
		<h1 class="entry-title dark"><span class="entry-title-inner"><?php the_title(); ?></span></h1>
	</header>
	<div id="init-header-change"></div>

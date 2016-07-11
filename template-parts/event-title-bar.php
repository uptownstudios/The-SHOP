<?php
	global $post;
	$EM_Event = em_get_event($post->ID, 'post_id');
?>

	<header id="featured-hero" class="single-featured-hero" role="banner" style="background-image: url('<?php bloginfo('url'); ?>/wp-content/uploads/2016/06/tie-fighter-wing02.svg'); background-repeat: repeat; background-color: #a8c9e9; background-size: 290px;">
		<h1 class="entry-title dark"><span class="entry-title-inner"><?php the_title(); ?></span><p class="entry-meta"><span class="author-name author-date"><strong><?php echo $EM_Event->output('#_EVENTDATES'); ?> | <?php echo $EM_Event->output('#_EVENTTIMES'); ?></strong></span></p></h1>
	</header>
	<?php echo do_shortcode('[bs_social_share]'); ?>
	<div id="init-header-change"></div>

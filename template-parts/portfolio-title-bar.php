<?php
	global $post;
	$author_id = $post->post_author;
	$date_published = $post->the_date;
	$tax_terms = get_the_terms( $post->ID , 'portfolio-cat' );
?>

	<header id="featured-hero" class="single-featured-hero" role="banner" style="background-image: url('<?php bloginfo('url'); ?>/wp-content/uploads/2016/06/tie-fighter-wing02.svg'); background-repeat: repeat; background-color: #a8c9e9; background-size: 290px;">
		<h1 class="entry-title dark"><span class="entry-title-inner"><?php the_title(); ?></span><p class="entry-meta"><span class="title-bar-meta"><?php foreach ($tax_terms as $tax_term) { echo '<span class="term-name">' . $tax_term->name . '</span>'; } ?></span></p></h1>
	</header>
	<?php echo do_shortcode('[bs_social_share]'); ?>
	<div id="init-header-change"></div>

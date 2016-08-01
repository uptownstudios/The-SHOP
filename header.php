<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "container" div.
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

?>
<!doctype html>
<!--[if IE 9]>    <html class="no-js ie9 oldie" <?php language_attributes(); ?> "> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js" <?php language_attributes(); ?> > <!--<![endif]-->
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
		<?php wp_head(); ?>
		<script src="https://use.typekit.net/uax4yzt.js"></script>
		<script>try{Typekit.load({ async: true });}catch(e){}</script>
		<link rel="preconnect" href="https://www.youtube.com/watch?v=ZKdHGG_0GJc">
	</head>
	<body <?php body_class(); ?>>
		<div id="preloader" style="position: fixed; left: 0; top: 0; z-index: 9999999; width: 100%; height: 100%; overflow: visible; background: #FFF;"><img src="<?php bloginfo('url'); ?>/wp-content/uploads/2016/05/logo-color.svg" class="preloader-logo"></div>
		<script>window.fbAsyncInit = function() { FB.init({ appId: '237010259984812', xfbml: true, version: 'v2.5' }); };
    (function(d, s, id){ var js, fjs = d.getElementsByTagName(s)[0]; if (d.getElementById(id)) {return;}
        js = d.createElement(s); js.id = id; js.src = "//connect.facebook.net/en_US/sdk.js"; fjs.parentNode.insertBefore(js, fjs); } (document, 'script', 'facebook-jssdk'));
    function fb_share() { FB.ui({ method: 'share', href: '<?php the_permalink(); ?>' },
        function(response) { if (response && !response.error_code) {
              // window.location = "http://imintohire.org/thank-you-for-sharing-on-facebook/"
            } else { } }); }
    </script>

    <div id="fb-root"></div>
    <script>(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.0";
    fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
    <?php function customFShare() {
        $like_results = file_get_contents('http://graph.facebook.com/'. get_permalink());
        $like_array = json_decode($like_results, true);
        $like_count =  $like_array['shares'];
        return ($like_count ) ? $like_count : "0";
    } ?>

	<?php do_action( 'foundationpress_after_body' ); ?>

	<?php if ( get_theme_mod( 'wpt_mobile_menu_layout' ) == 'offcanvas' ) : ?>
	<div class="off-canvas-wrapper">
		<div class="off-canvas-wrapper-inner" data-off-canvas-wrapper>
		<?php get_template_part( 'template-parts/mobile-off-canvas' ); ?>
	<?php endif; ?>

	<?php do_action( 'foundationpress_layout_start' ); ?>

	<header id="masthead" class="site-header" role="banner">
		<!-- <div class="logo-wrapper hide-for-small-only">
			<?php if ( function_exists( 'the_custom_logo' ) ) { the_custom_logo(); } ?>
		</div> -->
		<div class="title-bar" data-responsive-toggle="site-navigation">
			<div class="title-bar-title">
				<?php if ( function_exists( 'the_custom_logo' ) ) { the_custom_logo(); } ?>
			</div>
			<button class="menu-icon" type="button" data-toggle="mobile-menu"></button>
		</div>

		<nav id="site-navigation" class="main-navigation top-bar" role="navigation">
			<div class="top-bar-left">
				<ul class="menu">
					<li class="home"><?php if ( function_exists( 'the_custom_logo' ) ) { the_custom_logo(); } ?></li>
				</ul>
			</div>
			<div class="top-bar-right">
				<div class="top-bar-social">
					<?php get_template_part('template-parts/social-media'); ?>
				</div>
				<?php foundationpress_top_bar_r(); ?>

				<?php if ( ! get_theme_mod( 'wpt_mobile_menu_layout' ) || get_theme_mod( 'wpt_mobile_menu_layout' ) == 'topbar' ) : ?>
					<?php get_template_part( 'template-parts/mobile-top-bar' ); ?>
				<?php endif; ?>
			</div>
		</nav>
	</header>

	<section class="container">
		<?php do_action( 'foundationpress_after_header' );

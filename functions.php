<?php
/**
 * Author: Ole Fredrik Lie
 * URL: http://olefredrik.com
 *
 * FoundationPress functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

/** Various clean up functions */
require_once( 'library/cleanup.php' );

/** Required for Foundation to work properly */
require_once( 'library/foundation.php' );

/** Register all navigation menus */
require_once( 'library/navigation.php' );

/** Add menu walkers for top-bar and off-canvas */
require_once( 'library/menu-walkers.php' );

/** Create widget areas in sidebar and footer */
require_once( 'library/widget-areas.php' );

/** Return entry meta information for posts */
require_once( 'library/entry-meta.php' );

/** Enqueue scripts */
require_once( 'library/enqueue-scripts.php' );

/** Add theme support */
require_once( 'library/theme-support.php' );

/** Add Nav Options to Customer */
require_once( 'library/custom-nav.php' );

/** Change WP's sticky post class */
require_once( 'library/sticky-posts.php' );

/** Configure responsive image sizes */
require_once( 'library/responsive-images.php' );

/** If your site requires protocol relative url's for theme assets, uncomment the line below */
// require_once( 'library/protocol-relative-theme-assets.php' );

// Add WP 4.5 Custom Logo Support in Customizer
function theme_prefix_setup() {
    add_theme_support( 'custom-logo' );
}
add_action( 'after_setup_theme', 'theme_prefix_setup' );


// Current Year Shortcode
function bs_current_year() {
	$year = date('Y');
	return $year;
}
add_shortcode('year','bs_current_year');


// Allow the upload of SVG graphics to Media Library
function cc_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');


// Add 'mobile' to body class on mobile device
function my_body_classes($c) {
    wp_is_mobile() ? $c[] = 'mobile' : null;
    return $c;
}
add_filter('body_class','my_body_classes');


// PORTFOLIO CUSTOM POST TYPE
function my_custom_post_current_portfolio() {
	$labels = array(
		'name'               => _x( 'Portfolio', 'post type general name' ),
		'singular_name'      => _x( 'Portfolio', 'post type singular name' ),
		'add_new'            => _x( 'Add New Item', 'portfolio' ),
		'add_new_item'       => __( 'Add New Item' ),
		'edit_item'          => __( 'Edit Portfolio Item' ),
		'new_item'           => __( 'New Portfolio Item' ),
		'all_items'          => __( 'All Portfolio Items' ),
		'view_item'          => __( 'View Portfolio Item' ),
		'search_items'       => __( 'Search Portfolio' ),
		'not_found'          => __( 'No portfolio items found' ),
		'not_found_in_trash' => __( 'No portfolio items found in the Trash' ),
		'parent_item_colon'  => '',
		'menu_name'          => 'Portfolio'
	);
	$args = array(
		'labels'        	     => $labels,
		'description'   	     => 'Holds our portfolio and portfolio specific data',
		'capablility_type' 	   => 'post',
		'public'        	     => true,
		'menu_position' 	     => 5,
    'taxonomies'           => array( 'post_tag' ),
		'supports'      	     => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments', 'custom-fields', ),
		//'register_meta_box_cb' => 'add_project_metaboxes',
		'has_archive'   	     => true,
    'menu_icon'            => 'dashicons-schedule',
	);
	register_post_type( 'portfolio', $args );
}
add_action( 'init', 'my_custom_post_current_portfolio' );

//Add new image size for Projects featured image
if ( function_exists( 'add_image_size' ) ) {
	add_image_size( 'portfolio', 500, 500, true ); //(cropped)
}

function my_taxonomies_portfolio() {
	$labels = array(
		'name'              => _x( 'Categories', 'taxonomy general name' ),
		'singular_name'     => _x( 'Category', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Categories' ),
		'all_items'         => __( 'All Categories' ),
		'parent_item'       => __( 'Parent Category' ),
		'parent_item_colon' => __( 'Parent Category:' ),
		'edit_item'         => __( 'Edit Category' ),
		'update_item'       => __( 'Update Category' ),
		'add_new_item'      => __( 'Add New Category' ),
		'new_item_name'     => __( 'New Category' ),
		'menu_name'         => __( 'Categories' ),
	);
	$args = array(
		'labels' => $labels,
		'hierarchical' => true,
		'show_ui' => true,
		'query_var' => true,
		'show_admin_column' => true,
	);
	register_taxonomy( 'portfolio-cat', 'portfolio', $args );
}
add_action( 'init', 'my_taxonomies_portfolio', 0 );


// SERVICES CUSTOM POST TYPE
function my_custom_post_current_services() {
	$labels = array(
		'name'               => _x( 'Services', 'post type general name' ),
		'singular_name'      => _x( 'Service', 'post type singular name' ),
		'add_new'            => _x( 'Add New Item', 'service' ),
		'add_new_item'       => __( 'Add New Item' ),
		'edit_item'          => __( 'Edit Service Item' ),
		'new_item'           => __( 'New Service Item' ),
		'all_items'          => __( 'All Service Items' ),
		'view_item'          => __( 'View Service Item' ),
		'search_items'       => __( 'Search Service' ),
		'not_found'          => __( 'No services items found' ),
		'not_found_in_trash' => __( 'No services items found in the Trash' ),
		'parent_item_colon'  => '',
		'menu_name'          => 'Services'
	);
	$args = array(
		'labels'        	     => $labels,
		'description'   	     => 'Holds our services and service specific data',
		'capablility_type' 	   => 'post',
		'public'        	     => true,
		'menu_position' 	     => 5,
    'taxonomies'           => array( 'post_tag' ),
		'supports'      	     => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments', 'custom-fields', ),
		//'register_meta_box_cb' => 'add_project_metaboxes',
		'has_archive'   	     => true,
    'menu_icon'            => 'dashicons-list-view',
	);
	register_post_type( 'service', $args );
}
add_action( 'init', 'my_custom_post_current_services' );

//Add new image size for Service featured image
if ( function_exists( 'add_image_size' ) ) {
	add_image_size( 'service', 500, 500, true ); //(cropped)
}


// Customizer Additions
if ( ! function_exists( 'newuptown_customize_register' ) ) {
function newuptown_customize_register( $wp_customize ) {
  // Create custom panels
  // Add Social Media Section
  $wp_customize->add_section( 'social-media' , array(
    'title' => __( 'Social Media', '_s' ),
    'priority' => 30,
    'description' => __( 'Enter the URL to your account for each service for the icon to appear in the header.', '_s' )
  ) );

  // Add Facebook Setting
  $wp_customize->add_setting( 'facebook' , array( 'default' => '' ));
  $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'facebook', array(
      'label' => __( 'Facebook', '_s' ),
      'section' => 'social-media',
      'settings' => 'facebook',
  ) ) );

  // Add Twitter Setting
  $wp_customize->add_setting( 'twitter' , array( 'default' => '' ));
  $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'twitter', array(
      'label' => __( 'Twitter', '_s' ),
      'section' => 'social-media',
      'settings' => 'twitter',
  ) ) );

  // Add LinkedIn Setting
  $wp_customize->add_setting( 'linkedin' , array( 'default' => '' ));
  $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'linkedin', array(
      'label' => __( 'LinkedIn', '_s' ),
      'section' => 'social-media',
      'settings' => 'linkedin',
  ) ) );

  // Add Instagram Setting
  $wp_customize->add_setting( 'instagram' , array( 'default' => '' ));
  $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'instagram', array(
      'label' => __( 'Instagram', '_s' ),
      'section' => 'social-media',
      'settings' => 'instagram',
  ) ) );

  // Add YouTube Setting
  $wp_customize->add_setting( 'youtube' , array( 'default' => '' ));
  $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'youtube', array(
      'label' => __( 'YouTube', '_s' ),
      'section' => 'social-media',
      'settings' => 'youtube',
  ) ) );

  // Add Pinterest Setting
  $wp_customize->add_setting( 'pinterest' , array( 'default' => '' ));
  $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'pinterest', array(
      'label' => __( 'Pinterest', '_s' ),
      'section' => 'social-media',
      'settings' => 'pinterest',
  ) ) );

  // Add Vimeo Setting
  $wp_customize->add_setting( 'vimeo' , array( 'default' => '' ));
  $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'vimeo', array(
      'label' => __( 'Vimeo', '_s' ),
      'section' => 'social-media',
      'settings' => 'vimeo',
  ) ) );

  // Add RSS Setting
  $wp_customize->add_setting( 'rss' , array( 'default' => '' ));
  $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'rss', array(
      'label' => __( 'RSS', '_s' ),
      'section' => 'social-media',
      'settings' => 'rss',
  ) ) );

  // Add Copyright Section
  $wp_customize->add_section( 'copyright-text' , array(
    'title' => __( 'Copyright Text', '_s' ),
    'priority' => 1000,
    'description' => __( 'Enter the copyright text to appear at the bottom of the page. Do not include the copyright symbol or the year as these are added automatically to the beginning of this line.', '_s' )
  ) );

  // Add Copyright Text Field
  $wp_customize->add_setting( 'copyright' , array( 'default' => '' ) );
  $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'copyright', array(
      'label' => __( 'Copyright', '_s' ),
      'section' => 'copyright-text',
      'settings' => 'copyright',
  ) ) );

}

add_action( 'customize_register', 'newuptown_customize_register' );
}


// Shortcodes in widget
add_filter('widget_text', 'do_shortcode');


// Social Media Links Shortcode
add_shortcode( 'bs_social_urls', 'bs_social_urls_shortcode' );
function bs_social_urls_shortcode( $atts ) {
    extract( shortcode_atts( array(
      'align' => '',
      'color' => ''
    ), $atts ) );
    ob_start(); ?>

    <ul class="social-media-wrapper <?php echo $align; ?> <?php echo $color; ?>">
      <?php if( get_theme_mod('facebook')): ?><li class="facebook"><a href="<?php echo get_theme_mod('facebook','default'); ?>"><i class="fa fa-facebook"></i></a></li><?php endif; ?>
      <?php if( get_theme_mod('twitter')): ?><li class="twitter"><a href="<?php echo get_theme_mod('twitter','default'); ?>"><i class="fa fa-twitter"></i></a></li><?php endif; ?>
      <?php if( get_theme_mod('linkedin')): ?><li class="linkedin"><a href="<?php echo get_theme_mod('linkedin','default'); ?>"><i class="fa fa-linkedin"></i></a></li><?php endif; ?>
      <?php if( get_theme_mod('instagram')): ?><li class="instagram"><a href="<?php echo get_theme_mod('instagram','default'); ?>"><i class="fa fa-instagram"></i></a></li><?php endif; ?>
      <?php if( get_theme_mod('youtube')): ?><li class="youtube"><a href="<?php echo get_theme_mod('youtube','default'); ?>"><i class="fa fa-youtube-play"></i></a></li><?php endif; ?>
      <?php if( get_theme_mod('pinterest')): ?><li class="pinterest"><a href="<?php echo get_theme_mod('pinterest','default'); ?>"><i class="fa fa-pinterest"></i></a></li><?php endif; ?>
      <?php if( get_theme_mod('vimeo')): ?><li class="vimeo"><a href="<?php echo get_theme_mod('vimeo','default'); ?>"><i class="fa fa-vimeo"></i></a></li><?php endif; ?>
      <?php if( get_theme_mod('rss')): ?><li class="rss"><a href="<?php echo get_theme_mod('rss','default'); ?>"><i class="fa fa-rss"></i></a></li><?php endif; ?>
    </ul>

    <?php $bs_social_variable = ob_get_clean();
    return $bs_social_variable;
}

// Instagram Feed Shortcode
// add_action( 'wp_enqueue_scripts', 'register_instafeed_script' );
// function register_instafeed_script() {
  // wp_register_script('instafeed', get_template_directory_uri() . '/assets/javascript/instafeed.js', array('jquery'), '1.0', true );
// }
function bs_instagram_feed( $atts ) {
  extract( shortcode_atts(array(), $atts) );
  ob_start(); ?>

  <div id="instafeed"></div>

  <?php
    wp_enqueue_script( 'instafeed', get_template_directory_uri() . '/assets/javascript/instafeed.js', array('jquery'), '1.0', true );
    $bs_ig_feed_variable = ob_get_clean();
    return $bs_ig_feed_variable;
}
add_shortcode( 'bs_ig_feed', 'bs_instagram_feed' );


// Custom Excerpt
function bs_exceprt_more( $more ) {
  return ' ...';
}
add_filter( 'excerpt_more', 'bs_exceprt_more' );

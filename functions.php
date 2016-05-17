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

}

add_action( 'customize_register', 'newuptown_customize_register' );
}

<?php
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
		'rewrite'							 => array('slug' => 'project'),
	);
	register_post_type( 'portfolio', $args );
}
add_action( 'init', 'my_custom_post_current_portfolio' );

//Add new image size for Projects featured image
if ( function_exists( 'add_image_size' ) ) {
	add_image_size( 'portfolio', 500, 500, true ); //(cropped)
}

// Category Taxonomy
function portfolio_tax_category() {
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
add_action( 'init', 'portfolio_tax_category', 0 );

// Impact Taxonomy
function portfolio_tax_impact() {
	$labels = array(
		'name'              => _x( 'Areas of Impact', 'taxonomy general name' ),
		'singular_name'     => _x( 'Impact', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Areas of Impact' ),
		'all_items'         => __( 'All Areas of Impact' ),
		'parent_item'       => __( 'Parent Area of Impact' ),
		'parent_item_colon' => __( 'Parent Area of Impact:' ),
		'edit_item'         => __( 'Edit Area of Impact' ),
		'update_item'       => __( 'Update Area of Impact' ),
		'add_new_item'      => __( 'Add New Area of Impact' ),
		'new_item_name'     => __( 'New Area of Impact' ),
		'menu_name'         => __( 'Impact' ),
	);
	$args = array(
		'labels' => $labels,
		'hierarchical' => true,
		'show_ui' => true,
		'query_var' => true,
		'show_admin_column' => true,
	);
	register_taxonomy( 'portfolio-impact', 'portfolio', $args );
}
add_action( 'init', 'portfolio_tax_impact', 0 );

// Status Taxonomy
function portfolio_tax_status() {
	$labels = array(
		'name'              => _x( 'Status', 'taxonomy general name' ),
		'singular_name'     => _x( 'Status', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Status' ),
		'all_items'         => __( 'All Status' ),
		'parent_item'       => __( 'Parent Status' ),
		'parent_item_colon' => __( 'Parent Status:' ),
		'edit_item'         => __( 'Edit Status' ),
		'update_item'       => __( 'Update Status' ),
		'add_new_item'      => __( 'Add New Status' ),
		'new_item_name'     => __( 'New Status' ),
		'menu_name'         => __( 'Status' ),
	);
	$args = array(
		'labels' => $labels,
		'hierarchical' => true,
		'show_ui' => true,
		'query_var' => true,
		'show_admin_column' => true,
	);
	register_taxonomy( 'portfolio-status', 'portfolio', $args );
}
add_action( 'init', 'portfolio_tax_status', 0 );

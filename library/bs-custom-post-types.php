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


// TEAM MEMBERS CUSTOM POST TYPE
function my_custom_post_team() {
	$labels = array(
		'name'               => _x( 'Team Members', 'post type general name' ),
		'singular_name'      => _x( 'Team Member', 'post type singular name' ),
		'add_new'            => _x( 'Add New Team Member', 'team' ),
		'add_new_item'       => __( 'Add New Team Member' ),
		'edit_item'          => __( 'Edit Team Member' ),
		'new_item'           => __( 'New Team Member' ),
		'all_items'          => __( 'All Team Members' ),
		'view_item'          => __( 'View Team Member' ),
		'search_items'       => __( 'Search Team Members' ),
		'not_found'          => __( 'No Team Members found' ),
		'not_found_in_trash' => __( 'No Team Members found in the Trash' ),
		'parent_item_colon'  => '',
		'menu_name'          => 'Team Members'
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
    'menu_icon'            => 'dashicons-groups',
	);
	register_post_type( 'team', $args );
}
add_action( 'init', 'my_custom_post_team' );

//Add new image size for Team Members featured image
if ( function_exists( 'add_image_size' ) ) {
	add_image_size( 'team', 500, 500, true ); //(cropped)
}

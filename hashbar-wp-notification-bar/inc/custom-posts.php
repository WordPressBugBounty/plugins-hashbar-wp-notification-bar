<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/*=======================================================
*    Register Post type
* =======================================================*/
function hashbar_wpnb_custom_posts() {
	global $hashbar_gutenberg_enable;
	// Notification bars
	$labels = array(
		'name'                  => _x( 'Notification bars', 'Post Type General Name', 'hashbar-wp-notification-bar' ),
		'singular_name'         => _x( 'Notification bar', 'Post Type Singular Name', 'hashbar-wp-notification-bar' ),
		'menu_name'             => __( 'HashBars', 'hashbar-wp-notification-bar' ),
		'name_admin_bar'        => __( 'hashbar', 'hashbar-wp-notification-bar' ),
		'archives'              => __( 'Notification Archives', 'hashbar-wp-notification-bar' ),
		'parent_item_colon'     => __( 'Parent Notification:', 'hashbar-wp-notification-bar' ),
		'all_items'             => __( 'All Notifications', 'hashbar-wp-notification-bar' ),
		'add_new_item'          => __( 'Add New Notification', 'hashbar-wp-notification-bar' ),
		'add_new'               => __( 'Add New Notification', 'hashbar-wp-notification-bar' ),
		'new_item'              => __( 'New Notification', 'hashbar-wp-notification-bar' ),
		'edit_item'             => __( 'Edit Notification', 'hashbar-wp-notification-bar' ),
		'update_item'           => __( 'Update Notification', 'hashbar-wp-notification-bar' ),
		'view_item'             => __( 'View Notification', 'hashbar-wp-notification-bar' ),
		'search_items'          => __( 'Search Notification', 'hashbar-wp-notification-bar' ),
		'not_found'             => __( 'Not found', 'hashbar-wp-notification-bar' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'hashbar-wp-notification-bar' ),
		'featured_image'        => __( 'Featured Image', 'hashbar-wp-notification-bar' ),
		'set_featured_image'    => __( 'Set featured image', 'hashbar-wp-notification-bar' ),
		'remove_featured_image' => __( 'Remove featured image', 'hashbar-wp-notification-bar' ),
		'use_featured_image'    => __( 'Use as featured image', 'hashbar-wp-notification-bar' ),
		'insert_into_item'      => __( 'Insert into item', 'hashbar-wp-notification-bar' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'hashbar-wp-notification-bar' ),
		'items_list'            => __( 'Notifications list', 'hashbar-wp-notification-bar' ),
		'items_list_navigation' => __( 'Notifications list navigation', 'hashbar-wp-notification-bar' ),
		'filter_items_list'     => __( 'Filter items list', 'hashbar-wp-notification-bar' ),
	);
	$args = array(
		'label'                 => __( 'Notification bar', 'hashbar-wp-notification-bar' ),
		'labels'                => $labels,
		'supports'              => array('title','editor', 'revisions'),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => false,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-format-status',
		'show_in_rest'       	=> $hashbar_gutenberg_enable,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,		
		'exclude_from_search'   => true,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
	);
	register_post_type( 'wphash_ntf_bar', $args );
	
}
add_action( 'init', 'hashbar_wpnb_custom_posts');
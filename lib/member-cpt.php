<?php

// Register Custom Post Type
function bulldogcontractor_member() {

	$labels = array(
		'name'                  => _x( 'Members', 'Post Type General Name', 'bulldogcontractor' ),
		'singular_name'         => _x( 'Member', 'Post Type Singular Name', 'bulldogcontractor' ),
		'menu_name'             => __( 'Members', 'bulldogcontractor' ),
		'name_admin_bar'        => __( 'Member', 'bulldogcontractor' ),
		'archives'              => __( 'Member Archives', 'bulldogcontractor' ),
		'parent_item_colon'     => __( 'Parent Member:', 'bulldogcontractor' ),
		'all_items'             => __( 'All Members', 'bulldogcontractor' ),
		'add_new_item'          => __( 'Add New Member', 'bulldogcontractor' ),
		'add_new'               => __( 'Add New', 'bulldogcontractor' ),
		'new_item'              => __( 'New Member', 'bulldogcontractor' ),
		'edit_item'             => __( 'Edit Member', 'bulldogcontractor' ),
		'update_item'           => __( 'Update Member', 'bulldogcontractor' ),
		'view_item'             => __( 'View Member', 'bulldogcontractor' ),
		'search_items'          => __( 'Search Member', 'bulldogcontractor' ),
		'not_found'             => __( 'Not found', 'bulldogcontractor' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'bulldogcontractor' ),
		'featured_image'        => __( 'Featured Image', 'bulldogcontractor' ),
		'set_featured_image'    => __( 'Set featured image', 'bulldogcontractor' ),
		'remove_featured_image' => __( 'Remove featured image', 'bulldogcontractor' ),
		'use_featured_image'    => __( 'Use as featured image', 'bulldogcontractor' ),
		'insert_into_item'      => __( 'Insert into Member', 'bulldogcontractor' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Member', 'bulldogcontractor' ),
		'items_list'            => __( 'Members list', 'bulldogcontractor' ),
		'items_list_navigation' => __( 'Members list navigation', 'bulldogcontractor' ),
		'filter_items_list'     => __( 'Filter Members list', 'bulldogcontractor' ),
	);
	$rewrite = array(
		'slug'                  => 'team',
		'with_front'            => true,
		'pages'                 => true,
		'feeds'                 => true,
	);
	$args = array(
		'label'                 => __( 'Member', 'bulldogcontractor' ),
		'description'           => __( 'Our Team Member', 'bulldogcontractor' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'excerpt', 'thumbnail', 'custom-fields', ),
		'taxonomies'            => array( 'category', 'post_tag' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-admin-users',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'rewrite'               => $rewrite,
		'capability_type'       => 'page',
	);
	register_post_type( 'bulldogcontractor_mm', $args );

}
add_action( 'init', 'bulldogcontractor_member', 0 );

// Metabox for Member
function bulldogcontractor_member_metabox() {
	add_meta_box('bulldogcontractor_member_info', 'Additional Member Information', 'bulldogcontractor_member_info_callback', 'bulldogcontractor_mm', 'side', 'default');
}
add_action( 'add_meta_boxes', 'bulldogcontractor_member_metabox' );

function bulldogcontractor_member_info_callback() {
	global $post;
	
	// Get the location data if its already been entered
	$position = get_post_meta($post->ID, 'bulldogcontractor_member_position', true);
	$location = get_post_meta($post->ID, 'bulldogcontractor_member_location', true);
	
	// Echo out the field
	echo '<label for="bulldogcontractor_member_position"><strong>Company Position:</strong></label>';
	echo '<input type="text" name="bulldogcontractor_member_position" value="' . $position  . '" class="widefat" />';
	echo '<label for="bulldogcontractor_member_location"><strong>Company Location:</strong></label>';
	echo '<input type="text" name="bulldogcontractor_member_location" value="' . $location  . '" class="widefat" />';
}

function bulldogcontractor_member_info_save_meta($post_id, $post) {
	
	// Is the user allowed to edit the post or page?
	if ( !current_user_can( 'edit_post', $post->ID ))
		return $post->ID;
	
	// OK, were authenticated we need to find and save the data
	// We'll put it into an array to make it easier to loop though.
	
	$member_meta['bulldogcontractor_member_position'] = isset($_POST['bulldogcontractor_member_position']) ? $_POST['bulldogcontractor_member_position'] : '';
	$member_meta['bulldogcontractor_member_location'] = isset($_POST['bulldogcontractor_member_location']) ? $_POST['bulldogcontractor_member_location'] : '';
	
	foreach ($member_meta as $key => $value) {
		
		if( $post->post_type == 'revision' ) return;
		
		$value = implode(',', (array)$value);
		
		if(get_post_meta($post->ID, $key, FALSE)) {
			update_post_meta($post->ID, $key, $value);
		} else {
			add_post_meta($post->ID, $key, $value);
		}
		
		if(!$value) delete_post_meta($post->ID, $key);
	}
}
add_action('save_post', 'bulldogcontractor_member_info_save_meta', 1, 2);

// Position Columns
add_action( 'manage_edit-bulldogcontractor_mm_columns' , 'member_info_columns', 10, 2 );
add_action( 'manage_bulldogcontractor_mm_posts_custom_column', 'member_info_columns_data', 10, 2 );
add_filter( 'manage_edit-bulldogcontractor_mm_sortable_columns', 'member_info_columns_data_sortable' );

function member_info_columns( $columns ) {
	$columns = array(
		'cb' => '<input type="checkbox" />',
		'title' => __( 'Member' ),
		'position' => __( 'Position' ),
		'location' => __( 'Location' ),
		'profile_image' => __( 'Profile Image' ),
		'date' => __( 'Date' )
	);
	return $columns;
}

function member_info_columns_data( $column, $post_id ) {
	global $post;
	
	switch( $column ) {
		case 'position':
			echo get_post_meta( $post_id, 'bulldogcontractor_member_position', true ); 
			break;
	}
	
	switch( $column ) {
		case 'location':
			echo get_post_meta( $post_id, 'bulldogcontractor_member_location', true ); 
			break;
	}
	
	switch( $column ) {
		case 'profile_image':
			$post_featured_image = bd_get_featured_image($post_id);
			if ($post_featured_image) {
				echo '<img src="' . $post_featured_image . '" width="60"/>';
			}
			else {
				echo 'No Profile image';
			}
		break;
	}
}

function member_info_columns_data_sortable( $columns ) {
	
	$columns['position'] = 'position';
	$columns['profile_image'] = 'profile_image';
	$columns['location'] = 'location';
	
	return $columns;
}
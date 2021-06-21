<?php

// Register Custom Post Type
function bulldogcontractor_projects() {

	$labels = array(
		'name'                  => _x( 'Projects', 'Post Type General Name', 'bulldogcontractor' ),
		'singular_name'         => _x( 'Project', 'Post Type Singular Name', 'bulldogcontractor' ),
		'menu_name'             => __( 'Projects', 'bulldogcontractor' ),
		'name_admin_bar'        => __( 'Project', 'bulldogcontractor' ),
		'archives'              => __( 'Project Archives', 'bulldogcontractor' ),
		'parent_item_colon'     => __( 'Parent Project:', 'bulldogcontractor' ),
		'all_items'             => __( 'All Projects', 'bulldogcontractor' ),
		'add_new_item'          => __( 'Add New Project', 'bulldogcontractor' ),
		'add_new'               => __( 'Add New', 'bulldogcontractor' ),
		'new_item'              => __( 'New Project', 'bulldogcontractor' ),
		'edit_item'             => __( 'Edit Project', 'bulldogcontractor' ),
		'update_item'           => __( 'Update Project', 'bulldogcontractor' ),
		'view_item'             => __( 'View Project', 'bulldogcontractor' ),
		'search_items'          => __( 'Search Project', 'bulldogcontractor' ),
		'not_found'             => __( 'Not found', 'bulldogcontractor' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'bulldogcontractor' ),
		'featured_image'        => __( 'Featured Image', 'bulldogcontractor' ),
		'set_featured_image'    => __( 'Set featured image', 'bulldogcontractor' ),
		'remove_featured_image' => __( 'Remove featured image', 'bulldogcontractor' ),
		'use_featured_image'    => __( 'Use as featured image', 'bulldogcontractor' ),
		'insert_into_item'      => __( 'Insert into Project', 'bulldogcontractor' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Project', 'bulldogcontractor' ),
		'items_list'            => __( 'Projects list', 'bulldogcontractor' ),
		'items_list_navigation' => __( 'Projects list navigation', 'bulldogcontractor' ),
		'filter_items_list'     => __( 'Filter Projects list', 'bulldogcontractor' ),
	);
	$rewrite = array(
		'slug'                  => 'project',
		'with_front'            => true,
		'pages'                 => true,
		'feeds'                 => true,
	);
	$args = array(
		'label'                 => __( 'Project', 'bulldogcontractor' ),
		'description'           => __( 'Project of Bulldog Contractor, LLC', 'bulldogcontractor' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'excerpt', 'thumbnail', 'comments', 'custom-fields', ),
		'taxonomies'            => array( 'category', 'post_tag' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-hammer',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'rewrite'               => $rewrite,
		'capability_type'       => 'post',
	);
	register_post_type( 'bulldogcontractor_pr', $args );

}
add_action( 'init', 'bulldogcontractor_projects', 0 );


add_action( 'manage_edit-bulldogcontractor_pr_columns' , 'project_columns', 10, 2 );

function project_columns( $columns ) {
	$columns = array(
		'cb' => '<input type="checkbox" />',
		'featured_image' => __( 'Featured Image' ),
		'title' => __( 'Project Name' ),
		'location' => __( 'Project Location' ),		
		'date' => __( 'Date' ),
	);
	return $columns;
}


add_filter('manage_bulldogcontractor_pr_posts_columns', 'bd_columns_head');
add_action('manage_bulldogcontractor_pr_posts_custom_column', 'bd_columns_content', 10, 2);

// GET FEATURED IMAGE
function bd_get_featured_image($post_ID) {
    $post_thumbnail_id = get_post_thumbnail_id($post_ID);
    if ($post_thumbnail_id) {
        $post_thumbnail_img = wp_get_attachment_image_src($post_thumbnail_id, 'thumbnail');
        return $post_thumbnail_img[0];
    }
}

// ADD NEW COLUMN
function bd_columns_head($defaults) {
    $defaults['featured_image'] = 'Featured Image';
	$defaults['location'] = 'Location';
    return $defaults;
}
 
// SHOW THE FEATURED IMAGE
function bd_columns_content($column_name, $post_ID) {
    if ($column_name == 'featured_image') {
        $post_featured_image = bd_get_featured_image($post_ID);
        if ($post_featured_image) {
            echo '<img src="' . $post_featured_image . '" width="150"/>';
        }
    }
	
	if ($column_name == 'location') {
        echo get_post_meta( $post_ID, 'bulldogcontractor_project_location', true );
    }
}

/*
*	@Project Metabox
*/

// Metabox for Member
function bulldogcontractor_project_metabox() {
	add_meta_box('bulldogcontractor_project_info', 'Additional Information', 'bulldogcontractor_project_info_callback', 'bulldogcontractor_pr', 'side', 'default');
}
add_action( 'add_meta_boxes', 'bulldogcontractor_project_metabox' );

function bulldogcontractor_project_info_callback() {
	global $post;
	
	// Get the location data if its already been entered
	$location = get_post_meta($post->ID, 'bulldogcontractor_project_location', true);
	
	// Echo out the field
	echo '<label for="bulldogcontractor_project_location"><strong>Project Location:</strong></label>';
	echo '<input type="text" name="bulldogcontractor_project_location" value="' . $location  . '" class="widefat" />';
}

function bulldogcontractor_project_info_save_meta($post_id, $post) {
	
	// Is the user allowed to edit the post or page?
	if ( !current_user_can( 'edit_post', $post->ID ))
		return $post->ID;
	
	// OK, were authenticated we need to find and save the data
	// We'll put it into an array to make it easier to loop though.
	
	$project_meta['bulldogcontractor_project_location'] = isset( $_POST['bulldogcontractor_project_location'] ) ? $_POST['bulldogcontractor_project_location'] : '';
	
	foreach ($project_meta as $key => $value) {
		
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
add_action('save_post', 'bulldogcontractor_project_info_save_meta', 1, 2);
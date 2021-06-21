<?php
/**
* Template Name: Project
* Description: Used as a page template to display our Projects
*/

remove_action( 'genesis_loop', 'genesis_do_loop' );
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );
add_action( 'genesis_loop', 'bulldog_project_loop' );
add_action( 'genesis_before_loop', 'bulldogcontractor_top_text' );
add_action( 'genesis_after_loop', 'bulldogcontractor_bottom_text' );

function bulldog_project_loop() {

	$args = array(
		'post_type' 	=> 'bulldogcontractor_pr',
		'orderby'       => 'post_date',
		'order'         => 'DESC',
		'showposts' 	=> -1,
	);

	$loop = new WP_Query( $args );
	if( $loop->have_posts() ) {

		$count = 1;

		// loop through posts
		while( $loop->have_posts() ): $loop->the_post(); 

		if ( $count % 4 == 1 ) {
			echo '<div class="one-fourth first project-wrapper">';
		}

		else {
			echo '<div class="one-fourth project-wrapper">';
		}
			$thumb_img = get_post( get_post_thumbnail_id() );
			
			echo '<div class="project-image"><a href="' . get_permalink() . '" title="' . get_the_title() . '">';
				if ( has_post_thumbnail() ) {
					
					echo get_the_post_thumbnail( get_the_ID() , 'project-thumb');
					
				
				} else {
					echo '<img src="' . get_stylesheet_directory_uri() . '/images/default.jpg" alt="default" title="default" />';
				}
			echo '</a><span>' . $thumb_img->post_title . '</span></div>';
			echo '<h4 class="project-name"><a href="' . get_permalink() . '" title="' . get_the_title() . '">' . get_the_title() . '</a><span>' . get_post_meta( get_the_ID(), 'bulldogcontractor_project_location', true ) . '</span></h4>';
		echo '</div>';

		$count++;

		endwhile;
	}

	wp_reset_postdata();

}

function bulldogcontractor_top_text( $post ) {
	$top_text = get_post_meta( get_the_ID(), 'top_page_text', true );
	
	if ( empty($top_text) ) return;

	echo '<div class="top-text">'.$top_text.'</div>';	
	
}

function bulldogcontractor_bottom_text( $post ) {
	$bottom_text = get_post_meta( get_the_ID(), 'bottom_page_text', true );
	
	if ( empty($bottom_text) ) return;

	echo '<div class="clearfix"></div><div class="bottom-text">'.$bottom_text.'</div>';	
}

genesis();

?>

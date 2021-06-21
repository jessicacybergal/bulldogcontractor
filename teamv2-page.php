<?php
/**
* Template Name: Our Team V2 Template
* Description: Used as a page template to display our team child pages
*/

remove_action('genesis_loop', 'genesis_do_loop');
add_action('genesis_loop', 'our_team_loop');
remove_action( 'genesis_entry_footer', 'genesis_post_meta' );
remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );

//************  Member loop ************ 
function our_team_loop() {

  global $post;
  
  /*
  * @Loop For Owner
  ******/
  
	// WP_Query arguments
	$args = array (
		'post_type'              => array( 'bulldogcontractor_mm' ),
		'post_status'            => array( 'publish' ),
		'order'                  => 'ASC',
		'orderby'                => 'id',
		'meta_query'             => array(
			array(
				'key'       => 'bulldogcontractor_member_position',
				'value'     => array ( 'President', 'Vice President' ),
			),
		),
	);

	// The Query
	$owner_query = new WP_Query( $args );

	// The Loop
	if ( $owner_query->have_posts() ) :
		echo '<h2 class="member-section-title">'. __('Owner','bulldogcontractor'). '</h2>';
		
		while ( $owner_query->have_posts() ) :
			$owner_query->the_post();
			?>
			<div class="member-wrap">
				<div class="one-sixth first">
					<?php 
						if ( has_post_thumbnail() ) { the_post_thumbnail('member-thumb', array( 'class' => 'alignleft' ) ); }
						else { echo '<img src="http://placehold.it/120x160?text=Photo">';}
					?>
				</div>
				<div class="five-sixths">
					<h4 class="member-name"><?php the_title(); ?></h4>
					<p class="member-position"><span class="dashicons dashicons-businessman"></span> <?php echo get_post_meta( get_the_ID(), 'bulldogcontractor_member_position', true ); ?></p>				
					<div class="member-bio" id="member-<?php echo get_the_ID(); ?>"><?php the_content(); ?></div>			
				</div>
			</div>
			<?php 
		endwhile;
	endif;

	// Restore original Post Data
	wp_reset_postdata();
	
	/*
  * @Loop Minnesota Production
  ******/
  
  // WP_Query arguments
	$args = array (
		'post_type'              => array( 'bulldogcontractor_mm' ),
		'post_status'            => array( 'publish' ),
		'order'                  => 'ASC',
		'orderby'                => 'id',
		'meta_query'             => array(
			array(
				'key'       => 'bulldogcontractor_member_position',
				'value'     => array ( 'Production' ),
			),
			array(
				'relation' => 'AND',
				array(
					'key'     => 'bulldogcontractor_member_location',
					'value'   => 'Minnesota',
					'compare' => '='
				),
			),
		),
	);

	// The Query
	$owner_query = new WP_Query( $args );

	// The Loop
	if ( $owner_query->have_posts() ) :
		echo '<h2 class="member-section-title">'. __('Production - Minnesota','bulldogcontractor'). '</h2>';
		while ( $owner_query->have_posts() ) :
			$owner_query->the_post();
			?>
			<div class="member-wrap">
				<div class="one-sixth first">
					<?php 
						if ( has_post_thumbnail() ) { the_post_thumbnail('member-thumb', array( 'class' => 'alignleft' ) ); }
						else { echo '<img src="http://placehold.it/120x160?text=Photo">';}
					?>
				</div>
				<div class="five-sixths">
					<h4 class="member-name"><?php the_title(); ?></h4>
					<p class="member-position"><span class="dashicons dashicons-businessman"></span> <?php echo get_post_meta( get_the_ID(), 'bulldogcontractor_member_position', true ); ?></p>				
					<div class="member-bio" id="member-<?php echo get_the_ID(); ?>" style="display:none;"><?php the_content(); ?></div>
					<p><span onclick="jQuery('#member-<?php echo get_the_ID(); ?>').slideToggle('slow');" class="toggle-clicker tClicker">Read Bio</span></p>				
				</div>
			</div>
			<?php 
		endwhile;
	endif;

	// Restore original Post Data
	wp_reset_postdata();
	
	/*
  * @Loop Production - Colorado
  ******/
	
	
	  // WP_Query arguments
	$args = array (
		'post_type'              => array( 'bulldogcontractor_mm' ),
		'post_status'            => array( 'publish' ),
		'order'                  => 'ASC',
		'orderby'                => 'id',
		'meta_query'             => array(
			array(
				'key'       => 'bulldogcontractor_member_position',
				'value'     => array ( 'Production', 'Operation Manager' ),
			),
			array(
				'relation' => 'AND',
				array(
					'key'     => 'bulldogcontractor_member_location',
					'value'   => 'Colorado',
					'compare' => '='
				),
			),
		),
	);

	// The Query
	$owner_query = new WP_Query( $args );

	// The Loop
	if ( $owner_query->have_posts() ) :
		echo '<h2 class="member-section-title">'. __('Production - Colorado','bulldogcontractor'). '</h2>';
		while ( $owner_query->have_posts() ) :
			$owner_query->the_post();
			?>
			<div class="member-wrap">
				<div class="one-sixth first">
					<?php 
						if ( has_post_thumbnail() ) { the_post_thumbnail('member-thumb', array( 'class' => 'alignleft' ) ); }
						else { echo '<img src="http://placehold.it/120x160?text=Photo">';}
					?>
				</div>
				<div class="five-sixths">
					<h4 class="member-name"><?php the_title(); ?></h4>
					<p class="member-position"><span class="dashicons dashicons-businessman"></span> <?php echo get_post_meta( get_the_ID(), 'bulldogcontractor_member_position', true ); ?></p>				
					<div class="member-bio" id="member-<?php echo get_the_ID(); ?>" style="display:none;"><?php the_content(); ?></div>
					<p><span onclick="jQuery('#member-<?php echo get_the_ID(); ?>').slideToggle('slow');" class="toggle-clicker tClicker">Read Bio</span></p>				
				</div>
			</div>
			<?php 
		endwhile;
	endif;

	// Restore original Post Data
	wp_reset_postdata();
	
	
	/*
  * @Loop Sales - Minnesota
  ******/
	
	
	  // WP_Query arguments
	$args = array (
		'post_type'              => array( 'bulldogcontractor_mm' ),
		'post_status'            => array( 'publish' ),
		'order'                  => 'ASC',
		'orderby'                => 'id',
		'meta_query'             => array(
			array(
				'key'       => 'bulldogcontractor_member_position',
				'value'     => array ( 'Sales', 'Sales Representative' ),
			),
			array(
				'relation' => 'AND',
				array(
					'key'     => 'bulldogcontractor_member_location',
					'value'   => 'Minnesota',
					'compare' => '='
				),
			),
		),
	);

	// The Query
	$owner_query = new WP_Query( $args );

	// The Loop
	if ( $owner_query->have_posts() ) :
		echo '<h2 class="member-section-title">'. __('Sales - Minnesota','bulldogcontractor'). '</h2>';
		while ( $owner_query->have_posts() ) :
			$owner_query->the_post();
			?>
			<div class="member-wrap">
				<div class="one-sixth first">
					<?php 
						if ( has_post_thumbnail() ) { the_post_thumbnail('member-thumb', array( 'class' => 'alignleft' ) ); }
						else { echo '<img src="http://placehold.it/120x160?text=Photo">';}
					?>
				</div>
				<div class="five-sixths">
					<h4 class="member-name"><?php the_title(); ?></h4>
					<p class="member-position"><span class="dashicons dashicons-businessman"></span> <?php echo get_post_meta( get_the_ID(), 'bulldogcontractor_member_position', true ); ?></p>				
					<div class="member-bio" id="member-<?php echo get_the_ID(); ?>" style="display:none;"><?php the_content(); ?></div>
					<p><span onclick="jQuery('#member-<?php echo get_the_ID(); ?>').slideToggle('slow');" class="toggle-clicker tClicker">Read Bio</span></p>				
				</div>
			</div>
			<?php 
		endwhile;
	endif;

	// Restore original Post Data
	wp_reset_postdata();
	
	/*
  * @Loop Sales - Colorado
  ******/
	
	
	  // WP_Query arguments
	$args = array (
		'post_type'              => array( 'bulldogcontractor_mm' ),
		'post_status'            => array( 'publish' ),
		'order'                  => 'ASC',
		'orderby'                => 'id',
		'meta_query'             => array(
			array(
				'key'       => 'bulldogcontractor_member_position',
				'value'     => array ( 'Sales', 'Sales Representative' ),
			),
			array(
				'relation' => 'AND',
				array(
					'key'     => 'bulldogcontractor_member_location',
					'value'   => 'Colorado',
					'compare' => '='
				),
			),
		),
	);

	// The Query
	$owner_query = new WP_Query( $args );

	// The Loop
	if ( $owner_query->have_posts() ) :
		echo '<h2 class="member-section-title">'. __('Sales - Colorado','bulldogcontractor'). '</h2>';
		while ( $owner_query->have_posts() ) :
			$owner_query->the_post();
			?>
			<div class="member-wrap">
				<div class="one-sixth first">
					<?php 
						if ( has_post_thumbnail() ) { the_post_thumbnail('member-thumb', array( 'class' => 'alignleft' ) ); }
						else { echo '<img src="http://placehold.it/120x160?text=Photo">';}
					?>
				</div>
				<div class="five-sixths">
					<h4 class="member-name"><?php the_title(); ?></h4>
					<p class="member-position"><span class="dashicons dashicons-businessman"></span> <?php echo get_post_meta( get_the_ID(), 'bulldogcontractor_member_position', true ); ?></p>				
					<div class="member-bio" id="member-<?php echo get_the_ID(); ?>" style="display:none;"><?php the_content(); ?></div>
					<p><span onclick="jQuery('#member-<?php echo get_the_ID(); ?>').slideToggle('slow');" class="toggle-clicker tClicker">Read Bio</span></p>				
				</div>
			</div>
			<?php 
		endwhile;
	endif;

	// Restore original Post Data
	wp_reset_postdata();
	
	/*
  * @Loop Sales - Colorado
  ******/
	
	
	  // WP_Query arguments
	$args = array (
		'post_type'              => array( 'bulldogcontractor_mm' ),
		'post_status'            => array( 'publish' ),
		'order'                  => 'ASC',
		'orderby'                => 'id',
		'meta_query'             => array(
			array(
				'key'       => 'bulldogcontractor_member_position',
				'value'     => array ( 'Office' ),
			),
		),
	);

	// The Query
	$owner_query = new WP_Query( $args );

	// The Loop
	if ( $owner_query->have_posts() ) :
		echo '<h2 class="member-section-title">'. __('Office','bulldogcontractor'). '</h2>';
		while ( $owner_query->have_posts() ) :
			$owner_query->the_post();
			?>
			<div class="member-wrap">
				<div class="one-sixth first">
					<?php 
						if ( has_post_thumbnail() ) { the_post_thumbnail('member-thumb', array( 'class' => 'alignleft' ) ); }
						else { echo '<img src="http://placehold.it/120x160?text=Photo">';}
					?>
				</div>
				<div class="five-sixths">
					<h4 class="member-name"><?php the_title(); ?></h4>
					<p class="member-position"><span class="dashicons dashicons-businessman"></span> <?php echo get_post_meta( get_the_ID(), 'bulldogcontractor_member_position', true ); ?></p>				
					<div class="member-bio" id="member-<?php echo get_the_ID(); ?>" style="display:none;"><?php the_content(); ?></div>
					<p><span onclick="jQuery('#member-<?php echo get_the_ID(); ?>').slideToggle('slow');" class="toggle-clicker tClicker">Read Bio</span></p>				
				</div>
			</div>
			<?php 
		endwhile;
	endif;

	// Restore original Post Data
	wp_reset_postdata();

}


//************ Genesis **************
genesis();

?>

<?php
/**
* Template Name: Our Team Template
* Description: Used as a page template to display our team child pages
*/

remove_action('genesis_loop', 'genesis_do_loop');
add_action('genesis_loop', 'our_team_loop');
remove_action( 'genesis_entry_footer', 'genesis_post_meta' );
remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
add_action('genesis_entry_content','bulldogcontractor_position', 9);

//************  Member loop ************ 
function our_team_loop() {

  global $paged;

  $args = array(
    'post_type' => 'bulldogcontractor_mm',
    'orderby' => 'date',
	  'order'   => 'ASC',
    'showposts' => -1,
  );

  genesis_custom_loop( $args );

}

//************  Add the member company position ************ 
function bulldogcontractor_position() {
  $position = esc_attr( genesis_get_custom_field( 'bulldogcontractor_member_position' ) );

  echo '<p class="position"><span class="dashicons dashicons-businessman"></span> '.$position.'</p>';
}

//************ Genesis **************
genesis();

?>

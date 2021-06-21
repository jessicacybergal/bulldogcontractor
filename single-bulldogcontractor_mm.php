<?php

add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );
remove_action( 'genesis_entry_footer', 'genesis_post_meta' );
remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
add_action('genesis_entry_content','bulldogcontractor_position', 9);

// Add the member company position
function bulldogcontractor_position() {
  $position = esc_attr( genesis_get_custom_field( 'bulldogcontractor_member_position' ) );

  echo '<p class="position"><span class="dashicons dashicons-businessman"></span> '.$position.'</p>';
}


genesis();
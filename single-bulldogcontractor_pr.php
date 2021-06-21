<?php

add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );
remove_action( 'genesis_entry_footer', 'genesis_post_meta' );
remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );

// Add Images from Metabox.io
function bd_before_content() {
    $images = rwmb_meta( 'bd-image_advanced_970iaqetygj', array( 'size' => 'project-inner-thumb' ) );
    if ( $images ) {
        printf('<div class="project-images-grid">');
        foreach ( $images as $image ) {
            echo '<a href="', $image['full_url'], '" data-fancybox="project-image"><img src="', $image['url'], '"></a>';
        }
        printf('</div>');
    }
    
}
add_action('genesis_before_entry_content','bd_before_content');

genesis();
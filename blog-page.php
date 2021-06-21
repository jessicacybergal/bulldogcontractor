<?php
/**
* Template Name: Recent News
* Description: Used as a page template to display our Projects
*/

add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );
remove_action( 'genesis_entry_footer', 'genesis_post_meta' );

/** Replace the standard loop with our custom loop */
remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_loop', 'bd_recent_news_loop' );
 
function bd_recent_news_loop() {
	
	echo '<div class="recent-header">';
	echo '<h1 class="entry-title">'. get_the_title() .'</h1>';
	echo '<div class="entry-content">';
		the_content();
	echo '</div></div><div class="entry-wrapper">';
 
    // WP_Query arguments
        $args = array (
        	'post_type'              => array( 'post' ),
        	'post_status'            => array( 'publish' ),
        	'posts_per_page'         => '6',
        	'ignore_sticky_posts'    => true,
        	'order'                  => 'ASC',
        	'orderby'                => 'date',
        );

        // The Query
        $recent_query = new WP_Query( $args );

        // The Loop
        if ( $recent_query->have_posts() ) {
        	while ( $recent_query->have_posts() ) {
        		$recent_query->the_post();
        		// do something ?>
            <div class="recent-item-entry" id="recent-item-<?php the_ID(); ?>" <?php post_class(); ?>>
              <div class="recent-item-image">
                <?php if ( has_post_thumbnail() ) : ?>
                   <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                       <?php the_post_thumbnail('recent-home-thumb'); ?>
                   </a>
                <?php endif; ?>
              </div>
              <div class="recent-item-meta"><span><?php the_time('m-j-Y') ?></span></div>
              <div class="recent-item-content">
                <h4 class="recent-item-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h4>
                <div class="recent-item-text"><?php echo apply_filters('the_content', substr(get_the_content(), 0, 140) ); ?></div>
              </div>
            </div>
        	<?php }
        } else {
        	// no posts found
          echo '<p>No post yet.</p>';
        }

        // Restore original Post Data
        wp_reset_postdata();
	
	echo '</div>';
 
}

function bd_recent_news_class($classes) {
	$classes[] = 'recent-news-template';
	
	return $classes;
}
add_filter('body_class','bd_recent_news_class');

genesis();
<?php

add_action('genesis_meta','bulldogcontractor_home_meta');

function bulldogcontractor_home_meta() {
  add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );
  add_filter( 'body_class','bulldogcontractor_home_class');
  remove_action( 'genesis_loop', 'genesis_do_loop');
  add_action( 'genesis_loop', 'bulldogcontractor_home_loop');
}

function bulldogcontractor_home_class($classes) {
  $classes[] = 'bulldogcontractor-home';
  return $classes;
}

function bulldogcontractor_home_loop() {

  // Home featured
  if (is_active_sidebar('home-featured')) {
    echo '<div class="home-featured"><div class="wrap">';
      genesis_widget_area(
        'home-featured',
        array(
          'before' => '<div class="home-featured-widget"><div class="widget-wrap">',
          'after' => '</div></div>',
        )
      );
    echo '</div></div>';
  }

  // Home projects
  if (is_active_sidebar('home-projects')) {
    echo '<div class="home-projects"><div class="wrap">';
      genesis_widget_area(
        'home-projects',
        array(
          'before' => '<div class="home-projects-widget"><div class="widget-wrap">',
          'after' => '</div></div>',
        )
      );

      $args = array (
      	'post_type'              => array( 'bulldogcontractor_pr' ),
      	'post_status'            => array( 'publish' ),
      	'posts_per_page'         => '8',
        'showposts'              => '8',
      	'ignore_sticky_posts'    => true,
      	'order'                  => 'DESC',
      	'orderby'                => 'date',
      );


      // Start of project slider
      $project_slider = new WP_Query( $args );

      if ( $project_slider->have_posts() ) {
        printf('<div class="project-slider">');
        
        while ( $project_slider->have_posts() ) {
            $project_slider->the_post();
            if ( has_post_thumbnail() ) : ?>
              <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="project-slider-item">
                  <?php the_post_thumbnail('project-full'); ?>
                  <span class="project-slider-item-caption"><?php the_title(); ?><br><?php echo get_post_meta( get_the_ID(), 'bulldogcontractor_project_location', true ); ?></span>
              </a>
            <?php endif;
        }
        wp_reset_postdata();

        printf('</div>');
      }      

      // Start of project thumbnails
      echo '<div class="projects-wrapper">';

      $project_query = new WP_Query( $args );

      if ( $project_query->have_posts() ) {
       	while ( $project_query->have_posts() ) {
      		$project_query->the_post();
          echo '<div class="project-item">';
            if ( has_post_thumbnail() ) : ?>
               <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="project-url">
                   <?php the_post_thumbnail('project-home-thumb'); ?>
               </a>
            <?php endif; ?>
              <p class="project-name"><?php the_title(); ?><br><?php echo get_post_meta( get_the_ID(), 'bulldogcontractor_project_location', true ); ?></p>
            <?php
          echo '</div>';
        }
        
        wp_reset_postdata();

      } else {
      	echo '<p>No Project yet.</p>';
      }     

    echo '</div>';
	
	$projects_archive = esc_url( genesis_get_option('bulldogcontractor-projects-url', 'bulldogcontractor-settings') );
	
	echo '<a href="'.$projects_archive.'" title="Bulldog Contractor Projects" class="button">' . __('Click Here To See More Projects') . '</a>';

    echo '</div></div>';
  }


  // Home services
  if (is_active_sidebar('home-services')) {
    echo '<div class="home-services"><div class="wrap">';
      genesis_widget_area(
        'home-services',
        array(
          'before' => '<div class="home-services-widget"><div class="widget-wrap">',
          'after' => '</div></div>',
        )
      );
      echo '<div class="service-page">';
        genesis_widget_area(
          'home-service-page',
          array(
            'before' => '<div class="home-service-page-widget"><div class="widget-wrap">',
            'after' => '</div></div>',
          )
        );
      echo '</div>';
    echo '</div></div>';
  }

  // Home columns
  if (is_active_sidebar('home-columns')) {
    echo '<div class="home-columns"><div class="wrap">';
      genesis_widget_area(
        'home-columns',
        array(
          'before' => '<div class="home-columns-widget"><div class="widget-wrap">',
          'after' => '</div></div>',
        )
      );
    echo '</div></div>';
  }

  // Home recent
  if (is_active_sidebar('home-recent')) {
    echo '<div class="home-recent"><div class="wrap">';
      genesis_widget_area(
        'home-recent',
        array(
          'before' => '<div class="home-recent-widget"><div class="widget-wrap">',
          'after' => '</div></div>',
        )
      );

      echo '<div class="recent-item-wrap">';

        // WP_Query arguments
        $args = array (
        	'post_type'              => array( 'post' ),
        	'post_status'            => array( 'publish' ),
        	'nopaging'               => false,
        	'posts_per_page'         => '3',
        	'ignore_sticky_posts'    => true,
        	'order'                  => 'DESC',
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
    echo '</div></div>';
  }

  // Home Credentials
  if (is_active_sidebar('home-credentials')) {
    echo '<div class="home-credentials"><div class="wrap">';
      genesis_widget_area(
        'home-credentials',
        array(
          'before' => '<div class="home-credentials-widget"><div class="widget-wrap">',
          'after' => '</div></div>',
        )
      );
    echo '</div></div>';
  }

  // Home products
  if (is_active_sidebar('home-products')) {
    echo '<div class="home-products"><div class="wrap">';
      genesis_widget_area(
        'home-products',
        array(
          'before' => '<div class="home-products-widget"><div class="widget-wrap">',
          'after' => '</div></div>',
        )
      );
    echo '</div></div>';
  }

}

genesis();

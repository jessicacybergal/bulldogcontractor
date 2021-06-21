<?php
//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );
include_once( CHILD_DIR . '/lib/settings.php');
include_once( CHILD_DIR . '/lib/project-cpt.php');
include_once( CHILD_DIR . '/lib/member-cpt.php');

//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'Bulldog Contractor' );
define( 'CHILD_THEME_URL', 'http://webpagesthatsell.com/' );
define( 'CHILD_THEME_VERSION', '1.0.0' );

//* Enqueue Google Fonts
add_action( 'wp_enqueue_scripts', 'bulldogcontractor_assets' );
function bulldogcontractor_assets() {
	wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Lato:400,700|Roboto+Condensed:300,400,700', array(), CHILD_THEME_VERSION );
	wp_enqueue_script( 'bulldogcontractor-menu', get_stylesheet_directory_uri() . '/lib/menu.js', array('jquery'), CHILD_THEME_VERSION, TRUE );
	wp_enqueue_style( 'dashicons' );

	wp_deregister_style( 'font-awesome' );
	wp_register_style( 'font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.6.2/css/font-awesome.min.css', false, '4.6.2', 'all' );
	wp_enqueue_style( 'font-awesome' );

	wp_enqueue_style(
		'fancybox',
		'https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css',
		[],
		'3.5.7'
	);

	wp_enqueue_script(
		'fancybox',
		'https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js',
		['jquery'],
		'3.5.7'
	);

	wp_add_inline_script( 
		'fancybox',
		'jQuery(\'[data-fancybox="project-img"]\').fancybox({
			buttons : [ 
				\'slideShow\',
				\'fullScreen\',
				\'close\'
			  ],
			thumbs : {
			  autoStart : true
			}
		  });'
	);


	wp_enqueue_style(
		'slick',
		'//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.css',
		[],
		'1.8.1'
	);

	wp_enqueue_style(
		'slick-theme',
		'//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.min.css',
		['slick'],
		'1.8.1'
	);

	wp_enqueue_script(
		'slick',
		'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js',
		['jquery'],
		'1.8.1'
	);

	wp_add_inline_script( 
		'slick',
		'jQuery(document).ready(function(){ jQuery(\'.project-slider\').slick({autoplay: true,autoplaySpeed: 5000,});});'
	);
}

//* Add HTML5 markup structure
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );

//* Add Accessibility support
add_theme_support( 'genesis-accessibility', array( 'headings', 'drop-down-menu',  'search-form', 'skip-links', 'rems' ) );

//* Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

//* Add support for custom background
add_theme_support( 'custom-background' );

//* Add support for 3-column footer widgets
add_theme_support( 'genesis-footer-widgets', 3 );

//* Unregister layout
genesis_unregister_layout( 'sidebar-content' );
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );
genesis_unregister_layout( 'sidebar-content-sidebar' );

//* Unregister secondary navigation menu
add_theme_support( 'genesis-menus', array( 'primary' => __( 'Primary Navigation Menu', 'genesis' ) ) );

// Top Marquee Text
function bulldogcontractor_marquee_text() {
// 	$marquee_text = genesis_get_option('bulldogcontractor-marquee-text', 'bulldogcontractor-settings');
	
// 	if ( !empty($marquee_text ) )
// 		echo '<div class="top-bar"><div class="wrap"><p class="site-tagline">'.do_shortcode($marquee_text).'</p></div></div>';
		echo '<div class="top-bar"><div class="wrap"><p class="site-tagline">'; //.do_shortcode('[hsas-shortcode group="GROUP1" speed="10" direction="left" gap="50"]').
		echo do_shortcode('[horizontal-scrolling group="GROUP1" speed="1" direction="left" gap="30"]');
		echo '</p></div></div>';
}
// add_action('genesis_before_header','bulldogcontractor_marquee_text');

// Register widgets
genesis_register_sidebar( array(
	'id'		=> 'home-featured',
	'name'		=> __( 'Home - Featured', 'bulldogcontractor' ),
	'description'	=> __( 'This is the widget area for Home Feature.', 'bulldogcontractor' ),
) );
genesis_register_sidebar( array(
	'id'		=> 'home-projects',
	'name'		=> __( 'Home - Projects', 'bulldogcontractor' ),
	'description'	=> __( 'This is the widget area for Home Projects.', 'bulldogcontractor' ),
) );
genesis_register_sidebar( array(
	'id'		=> 'home-services',
	'name'		=> __( 'Home - Services', 'bulldogcontractor' ),
	'description'	=> __( 'This is the widget area for Home Services.', 'bulldogcontractor' ),
) );
genesis_register_sidebar( array(
	'id'		=> 'home-service-page',
	'name'		=> __( 'Home - Service Page', 'bulldogcontractor' ),
	'description'	=> __( 'This is the widget area for Home Service Page.', 'bulldogcontractor' ),
) );
genesis_register_sidebar( array(
	'id'		=> 'home-columns',
	'name'		=> __( 'Home - Columns', 'bulldogcontractor' ),
	'description'	=> __( 'This is the widget area for Home Columns.', 'bulldogcontractor' ),
) );
genesis_register_sidebar( array(
	'id'		=> 'home-recent',
	'name'		=> __( 'Home - Recent News', 'bulldogcontractor' ),
	'description'	=> __( 'This is the widget area for Home Recent News.', 'bulldogcontractor' ),
) );
genesis_register_sidebar( array(
	'id'		=> 'home-credentials',
	'name'		=> __( 'Home - Credentials', 'bulldogcontractor' ),
	'description'	=> __( 'This is the widget area for Home Credentials.', 'bulldogcontractor' ),
) );
genesis_register_sidebar( array(
	'id'		=> 'home-products',
	'name'		=> __( 'Home - Products', 'bulldogcontractor' ),
	'description'	=> __( 'This is the widget area for Home Products.', 'bulldogcontractor' ),
) );

// add image size
add_image_size( 'project-home-thumb', 220, 180, true );
add_image_size( 'recent-home-thumb', 300, 300, true );
add_image_size( 'member-thumb', 120, 160, true );
add_image_size( 'post-thumb', 640, 200, true );
add_image_size( 'project-thumb', 222, 166, true );
add_image_size( 'project-full', 960, 540, true );
add_image_size( 'project-inner-thumb', 470, 353, true );

// Remove layout, navigation & sidebars
genesis_unregister_layout( 'sidebar-content' );
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );
genesis_unregister_layout( 'sidebar-content-sidebar' );
unregister_sidebar( 'sidebar-alt' );
unregister_sidebar( 'header-right' );
add_theme_support( 'genesis-menus', array( 'primary' => __( 'Primary Navigation Menu', 'genesis' ) ) );

// Nav menu social
function bulldogcontractor_menu_social( $menu, $args ) {
	if ( 'primary' !== $args->theme_location )
		return $menu;

	$menu .= '<li class="menu-item"><div class="nav-social">
	<a href="' . genesis_get_option('bulldogcontractor-facebook', 'bulldogcontractor-settings') . '" title="Facebook" target="_blank"><span class="icon-facebook"></span></a>
	<a href="' . genesis_get_option('bulldogcontractor-linkedin', 'bulldogcontractor-settings') . '" title="Linkedin" target="_blank"><span class="icon-linkedin"></span></a>
	<a href="' . genesis_get_option('bulldogcontractor-googleplus', 'bulldogcontractor-settings') . '" title="Google+" target="_blank"><span class="icon-gplus"></span></a>
	<a href="' . genesis_get_option('bulldogcontractor-youtube', 'bulldogcontractor-settings') . '" title="Youtube" target="_blank"><span class="icon-youtube"></span></a>
	<a href="' . genesis_get_option('bulldogcontractor-yelp', 'bulldogcontractor-settings') . '" title="Yelp" target="_blank"><span class="icon-yelp"></span></a>
	</div></li>';


	return $menu;
}
add_filter( 'wp_nav_menu_items', 'bulldogcontractor_menu_social', 10, 2 );

// Header phone
function bulldogcontractor_header_phone() {
	$phonemn = genesis_get_option('bulldogcontractor-mnphone', 'bulldogcontractor-settings');
	$phoneco = genesis_get_option('bulldogcontractor-cophone', 'bulldogcontractor-settings');
	$phonetx = genesis_get_option('bulldogcontractor-txphone', 'bulldogcontractor-settings');

	if (!empty($phonemn) || !empty($phoneco)) {
		echo '<div class="header-phone"><ul>';
			if (!empty($phonemn)) {
				echo '<li class="mnphone"><small>Minnesota</small><br /><strong>'.$phonemn.'</strong></li>';
			}
			if (!empty($phoneco)) {
				echo '<li class="cophone"><small>Colorado</small><br /><strong>'.$phoneco.'</strong></li>';
			}
			if (!empty($phoneco)) {
				echo '<li class="txphone"><small>Texas</small><br /><strong>'.$phonetx.'</strong></li>';
			}
		echo '</ul></div>';
	}
}

function bulldogcontractor_header_phone_tollfree() {

	$phonetf = genesis_get_option('bulldogcontractor-tfphone', 'bulldogcontractor-settings');
	$bclocations = genesis_get_option('bulldogcontractor-locations', 'bulldogcontractor-settings');

	if (!empty($phonetf) && !empty($bclocations) ) {
		// echo '<p class="branch-location">'.$bclocations.'</p>';
		echo '<p class="toll-free"><span class="num">'.$phonetf.'</span></p>';
	}

}
add_action('genesis_header_right','bulldogcontractor_header_phone_tollfree');

// Tagline
function bulldogcontractor_tagline() {
	$tagline = genesis_get_option('bulldogcontractor-tagline', 'bulldogcontractor-settings');

	if (!empty($tagline))
		echo '<p class="site-tagline">'.$tagline.'</p>';
}
add_action('genesis_header_right','bulldogcontractor_tagline');

// SOcial shortcode
function bulldogcontractor_social_shortcode( $atts, $content = null ) {
	$bc_fb = genesis_get_option('bulldogcontractor-facebook', 'bulldogcontractor-settings');
	$bc_li = genesis_get_option('bulldogcontractor-linkedin', 'bulldogcontractor-settings');
	$bc_gp = genesis_get_option('bulldogcontractor-googleplus', 'bulldogcontractor-settings');
	$bc_yt = genesis_get_option('bulldogcontractor-youtube', 'bulldogcontractor-settings');
	$bc_yp = genesis_get_option('bulldogcontractor-yelp', 'bulldogcontractor-settings');

	$social = '
	<ul class="social-shortcode">
		<li><a href="'.$bc_fb.'" title="Facebook" target="_blank"><span class="icon-facebook"></a></li>
		<li><a href="'.$bc_li.'" title="Linkedin" target="_blank"><span class="icon-linkedin"></a></li>
		<li><a href="'.$bc_gp.'" title="Google+" target="_blank"><span class="icon-gplus"></a></li>
		<li><a href="'.$bc_yt.'" title="Youtube" target="_blank"><span class="icon-youtube"></a></li>
		<li><a href="'.$bc_yp.'" title="Yelp" target="_blank"><span class="icon-yelp"></a></li>
	</ul>

	';

	return $social;
}
add_shortcode( 'bc-social', 'bulldogcontractor_social_shortcode' );

add_filter('widget_text', 'do_shortcode');


add_action( 'genesis_entry_header', 'featured_post_image', 8 );
function featured_post_image() {
	global $post;

	if ( is_page() || 'bulldogcontractor_pr' == get_post_type() )
		return;

	if ( 'bulldogcontractor_mm' == get_post_type() ){
		$img = genesis_get_image( array( 'format' => 'html', 'size' => 'member-thumb', 'attr' => array( 'class' => 'post-image alignleft' ) ) );
		printf( '<a href="%s" title="%s">%s</a>', get_permalink(), the_title_attribute( 'echo=0' ), $img );
	}
	else {
		$img = genesis_get_image( array( 'format' => 'html', 'size' => 'post-thumb', 'attr' => array( 'class' => 'post-image aligncenter' ) ) );
		printf( '<a href="%s" title="%s">%s</a>', get_permalink(), the_title_attribute( 'echo=0' ), $img );
	}
}


// Footer
remove_action( 'genesis_footer', 'genesis_do_footer' );
add_action( 'genesis_footer', 'bulldogcontractor_custom_footer' );
function bulldogcontractor_custom_footer() {
	?>
	<p>&copy; Copyright <?php echo date('Y'); ?> &middot; <a href="<?php echo get_bloginfo('url'); ?>" title="<?php echo get_bloginfo('name'); ?>"><?php echo get_bloginfo('name'); ?></a> &middot; All Rights Reserved.</p>
<p style="margin-top: 10px"><a href="<?php echo get_bloginfo('url'); ?>/terms-and-conditions">Terms and Conditions</a> | <a href="<?php echo get_bloginfo('url'); ?>/privacy-policy">Privacy Policy</a> | <a href="<?php echo get_bloginfo('url'); ?>/cookie-policy">Cookie Policy</a></p>
	<?php
}

// Phone shortcode
function bc_phone_numbers( $atts ) {
	$phonemn = genesis_get_option('bulldogcontractor-mnphone', 'bulldogcontractor-settings');
	$phoneco = genesis_get_option('bulldogcontractor-cophone', 'bulldogcontractor-settings');
	$phonetx = genesis_get_option('bulldogcontractor-txphone', 'bulldogcontractor-settings');

	extract( shortcode_atts( array( 'location' => '', ), $atts ) );

	if ( $location == 'colorado') {
		$output = '<span>Colorado: '.$phoneco.'</span>';
	}
	elseif ( $location == 'minnesota' ) {
		$output = '<span>Minnesota: '.$phonemn.'</span>';
	}
	elseif ( $location == 'texas' ) {
		$output = '<span>Texas: '.$phonetx.'</span>';
	}
	else {
		$output = '<span>No phone number for this location.</span>';
	}

	return $output;

}
add_shortcode( 'phone', 'bc_phone_numbers' );

add_filter('widget_text','do_shortcode');
add_filter( 'the_content', 'do_shortcode', 11 );

// Flush rewrite rules for custom post types.
add_action( 'after_switch_theme', 'flush_rewrite_rules' );


add_filter( 'rwmb_meta_boxes', 'bd_register_meta_boxes' );

function bd_register_meta_boxes( $meta_boxes ) {
    $prefix = 'bd-';

    $meta_boxes[] = [
        'title'      => esc_html__( 'Project Images', 'bulldogcontractorsllc' ),
        'id'         => 'project_images',
        'post_types' => ['bulldogcontractor_pr'],
        'context'    => 'normal',
        'priority'   => 'high',
        'fields'     => [
            [
                'type'       => 'image_advanced',
                'id'         => $prefix . 'image_advanced_970iaqetygj',
                'name'       => esc_html__( 'Image Advanced', 'bulldogcontractorsllc' ),
                'max_status' => false,
            ],
        ],
    ];

    return $meta_boxes;
}
<?php
//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );
include_once( CHILD_DIR . '/lib/default.php' );
include_once( CHILD_DIR . '/lib/setting.php' );

//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'Law Drive Theme' );
define( 'CHILD_THEME_URL', 'http://www.lawdrive.com/' );
define( 'CHILD_THEME_VERSION', '2.2.2' );

//* Enqueue Google Fonts
add_action( 'wp_enqueue_scripts', 'law_drive_assets' );
function law_drive_assets() {
	wp_enqueue_style( 'font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css', array(), '4.5.0' );
	wp_enqueue_script( 'responsive-menu', get_stylesheet_directory_uri() . '/lib/menu.js', array( 'jquery' ), CHILD_THEME_VERSION, true );
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

remove_action( 'genesis_before_loop', 'genesis_do_taxonomy_title_description', 15);


//* woocommerce

function themeprefix_cpt_layout() {
	global $woocommerce;
	$post_type = get_post_type();
	
	
    if( $post_type == 'product' ) {
        echo 'full-width-content';
    }
}
add_action( 'genesis_footer', 'themeprefix_cpt_layout' );

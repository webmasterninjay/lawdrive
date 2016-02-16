<?php

//* Advance Theme Setting Defaults
add_filter( 'genesis_theme_settings_defaults', 'law_drive_theme_defaults' );
function law_drive_theme_defaults( $defaults ) {

	$defaults['blog_title']                = 'image';
	$defaults['blog_cat_num']              = 5;
	$defaults['content_archive']           = 'full';
	$defaults['content_archive_limit']     = 200;
	$defaults['content_archive_thumbnail'] = 1;
	$defaults['image_size'] 			   = 'thumbnail';
	$defaults['image_alignment'] 			   = 'alignright';
	$defaults['posts_nav']                 = 'numeric';
	$defaults['site_layout']               = 'content-sidebar';

	return $defaults;

}

//* Advance Theme Setup
add_action( 'after_switch_theme', 'law_drive_theme_setting_defaults' );
function law_drive_theme_setting_defaults() {

	if( function_exists( 'genesis_update_settings' ) ) {

		genesis_update_settings( array(
			'blog_title'              => 'image',
			'blog_cat_num'              => 5,
			'content_archive'           => 'full',
			'content_archive_limit'     => 200,
			'content_archive_thumbnail' => 1,
			'image_size'				=> 'thumbnail',
			'image_alignment'				=> 'alignright',
			'posts_nav'                 => 'numeric',
			'site_layout'               => 'content-sidebar',
		) );

	} else {

		_genesis_update_settings( array(
			'blog_title'				=> 'image',
			'blog_cat_num'              => 5,
			'content_archive'           => 'full',
			'content_archive_limit'     => 200,
			'content_archive_thumbnail' => 1,
			'image_size'				=> 'thumbnail',
			'image_alignment'				=> 'alignright',
			'posts_nav'                 => 'numeric',
			'site_layout'               => 'content-sidebar',
		) );

	}

	update_option( 'posts_per_page', 5 );



}

//* Advance Theme Setup
add_action( 'after_setup_theme', 'law_drive_theme_settings' );
function law_drive_theme_settings() {

	//* Unregister sidebar/content layout setting
	genesis_unregister_layout( 'sidebar-content' );

	//* Unregister content/sidebar/sidebar layout setting
	genesis_unregister_layout( 'content-sidebar-sidebar' );

	//* Unregister sidebar/sidebar/content layout setting
	genesis_unregister_layout( 'sidebar-sidebar-content' );

	//* Unregister sidebar/content/sidebar layout setting
	genesis_unregister_layout( 'sidebar-content-sidebar' );

	//* Unregister sidebar alt
	unregister_sidebar('sidebar-alt');

  //* reposition main menu
  remove_action('genesis_after_header','genesis_do_subnav');
  add_action('genesis_before_footer', 'genesis_do_subnav', 5);

	add_filter( 'widget_text', 'do_shortcode');

}

//* Register after post widget area
genesis_register_sidebar( array(
	'id'            => 'law-drive-home-slider',
	'name'          => __( 'Home - Slider', 'lawdrive' ),
	'description'   => __( 'This is a widget area that can be placed on home slider section.', 'lawdrive' ),
) );

// Disable admin bar
add_filter('show_admin_bar', '__return_false');

// Footer social media
function lawdrive_footer_social() {
	$ld_facebook= esc_url( genesis_get_option('lawdrive-facebook', 'lawdrive-settings') );
	$ld_twitter = esc_url( genesis_get_option('lawdrive-twitter', 'lawdrive-settings') );
	$ld_linkedin = esc_url( genesis_get_option('lawdrive-linkedin', 'lawdrive-settings') );
	echo '<div class="footer-social"><div class="wrap"><ul>';
		echo '<li>Follow us</li>';
		echo '<li class="social-facebook"><a href="'.$ld_facebook.'" title="Facebook"><i class="fa fa-facebook-square"></i></a></li>';
		echo '<li class="social-twitter"><a href="'.$ld_twitter.'" title="Twitter"><i class="fa fa-twitter-square"></i></a></li>';
		echo '<li class="social-linkedin"><a href="'.$ld_linkedin.'" title="Linkedin"><i class="fa fa-linkedin-square"></i></a></li>';
	echo '</ul></div></div>';
}
add_action('genesis_before_footer','lawdrive_footer_social');

// Footer copyright
function lawdrive_copyright() {
	$name = get_bloginfo('name');
	$site = get_bloginfo('url');
	$date = date('Y');
	echo '<p>&copy; Copyright '.$date.' &middot; <a href="'.$site.'" title="'.$name.'">'.$name.'</a> &middot; All Rights Reserved.</p>';
}
remove_action( 'genesis_footer', 'genesis_do_footer' );
add_action( 'genesis_footer', 'lawdrive_copyright' );

// Add feature image on post and page
add_action( 'genesis_entry_content', 'lawdrive_post_image', 8);
function lawdrive_post_image() {
  if ( !is_singular( array( 'post', 'page' ) ))  return;
    the_post_thumbnail('medium', array('class' => 'alignleft')); //you can use medium, large or a custom size
}


// remove post meta
remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );

//* Remove the entry meta in the entry footer (requires HTML5 theme support)
remove_action( 'genesis_entry_footer', 'genesis_post_meta' );

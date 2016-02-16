<?php
/**
* Template Name: Our Team Template
* Description: Used as a page template to display our team child pages
*/

remove_action('genesis_loop', 'genesis_do_loop');
add_action('genesis_loop', 'our_team_loop');

function our_team_loop() {

  global $paged;

  $args = array(
    'post_type' => 'page',
    'post_parent' => 9,
    'orderby' => 'date',
	  'order'   => 'ASC',
    'posts_per_page' => 10
  );

  genesis_custom_loop( $args );

}

function lawdrive_position() {
  $position = esc_attr( genesis_get_custom_field( 'position' ) );

  echo '<p class="position"><i class="fa fa-suitcase"></i> '.$position.'</p>';
}
add_action('genesis_entry_content','lawdrive_position', 9);

remove_action( 'genesis_entry_content', 'genesis_do_post_image', 8 );
add_action( 'genesis_entry_header', 'genesis_do_post_image', 1 );

genesis();

 ?>

<?php
/*
* Template Name: Homepage
*/

add_action('genesis_meta','law_drive_home');

function law_drive_home() {
  add_action('genesis_after_header','law_drive_home_slider');
}

function law_drive_home_slider() {
  echo '<div class="home-slider"><div class="wrap">';
  genesis_widget_area( 'law-drive-home-slider', array( 'before' => '<div class="home-slider-widget widget-area">', 'after' => '</div>' ));
  echo '</div></div>';
}

genesis(); ?>

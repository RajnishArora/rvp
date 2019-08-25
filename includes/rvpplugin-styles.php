<?php


// Load CSS on the frontend
function rvpplugin_frontend_styles() {

  wp_enqueue_style(
    'rvpplugin-slick',RVPPLUGIN_URL . 'slick/slick.css', [], time()
  );
  wp_enqueue_style(
    'rvpplugin-slick-theme',RVPPLUGIN_URL . 'slick/slick-theme.css', [], time()
  );
  wp_enqueue_style(
    'rvpplugin-frontend', RVPPLUGIN_URL . 'frontend/css/rvpplugin-frontend-style.css', [], time()
  );

}
add_action( 'wp_enqueue_scripts', 'rvpplugin_frontend_styles', 100 );

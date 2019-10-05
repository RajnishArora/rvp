<?php

// Load JS on all admin pages
function rvpplugin_admin_scripts() {

  wp_enqueue_script(
    'rvpplugin-admin', RVPPLUGIN_URL . 'admin/js/rvpplugin-admin.js', ['jquery'],  time()
  );

}
add_action( 'admin_enqueue_scripts', 'rvpplugin_admin_scripts', 100 );


// Load JS on the frontend
function rvpplugin_frontend_scripts() {

  wp_register_script(
    'rvpplugin-slick', RVPPLUGIN_URL . 'slick/slick.js', [], time(),true
  );
  wp_register_script(
    'rvpplugin-frontend', RVPPLUGIN_URL . 'frontend/js/rvpplugin-frontend.js', [], time(),true
  );

//  if( is_single() ){
    wp_enqueue_script('rvpplugin-slick');
    wp_enqueue_script('rvpplugin-frontend');

    $opt = get_option( 'rvpplugin_settings' );
    $slides_to_view =  $opt['slides_to_show'] ;
    if ($slides_to_view == '' || $slides_to_view <= 0 ){
        $slides_to_view = '3';
    }

    $rvp_arr = array(
      'slides_to_show' => $slides_to_view
    );
    wp_localize_script('rvpplugin-frontend', 'rvpplugin_data',$rvp_arr);

//  }

}
add_action( 'wp_enqueue_scripts', 'rvpplugin_frontend_scripts', 100 );

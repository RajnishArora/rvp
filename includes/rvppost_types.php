<?php

if( !class_exists('rvp_create_cpt')){

class rvp_create_cpt{

  public function __construct()
  {
  }  //constructor

   public function create_cpt() {
    //  Post Type

    $show_checkbox = false;

/*
      $options = get_option( 'rvpplugin_settings' );
      $show_checkbox = esc_html( $options['show_checkbox'] );
      if ( $show_checkbox == '1' ) {
          $show_checkbox = true;
      } else {
          $show_checkbox = false;
      }
*/
        if( !post_type_exists('rvp') ){
                register_post_type('rvp', array(
                      'supports' => array('title'),
                      'public' => true,
                      'show_ui' => true,
                      'show_in_menu'  => $show_checkbox,
                      'labels' => array(
                        'name' => 'Rvps',
                        'add_new_item' => 'Add New Product',
                        'all_items' => 'All Products',
                        'singular_name' => 'Rvp'
                      ),
                      'menu_icon' => 'dashicons-visibility'
               ));

        }// if post_type_exists
    } //create_cpt ends
  } // class rvp_create_cpt ends
}

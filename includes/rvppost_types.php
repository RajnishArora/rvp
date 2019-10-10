<?php

if( !class_exists('rvp_create_cpt')){

class rvp_create_cpt{

  public function __construct()
  {
  }  //constructor

   public function create_cpt() {
    //  Post Type

    // this variable controls whether to shoe in dashboard
    $show_checkbox = false;

        if( !post_type_exists('rvp') ){
                register_post_type('rvp', array(
                      'supports' => array('title'),
                      'public' => true,
                      'show_ui' => true,
                      'show_in_menu'  => $show_checkbox,
                      'labels' => array(
                        'name' => _x('Rvps','post type general name','rvpplugin'),
                        'singular_name' => _x('Rvp','post type singular name','rvpplugin'),
                        'add_new_item' => __('Add New Product','rvpplugin'),
                        'all_items' => __('All Products','rvpplugin')

                      ),
                      'menu_icon' => 'dashicons-visibility'
               ));

        }// if post_type_exists
    } //create_cpt ends
  } // class rvp_create_cpt ends
}

<?php

add_action('init', array(new rvp_create_cpt , 'create_cpt' ) );
$rvp_meta_box_object = new rvp_create_metabox;
add_action( 'admin_init', array($rvp_meta_box_object , 'add_rvp_meta_box') );
add_action('save_post', array($rvp_meta_box_object , 'save_viewed_products_custom_fields') );


add_action('wp', array(new rvp_create_list() , 'rvp_create_view_list' ) );
// using wp hook is fired last so it is used for is_product() function as init is fired beforehand and is_product() fails

$options = get_option('rvpplugin_settings');
$rvp_view_object = new rvp_view_list;

$single_checkbox = '0';
$shop_checkbox = '0';
$cart_checkbox = '0';

  if( isset( $options['single_checkbox'] )  ){
      $single_checkbox = esc_html( $options['single_checkbox'] );
  }
  if( $single_checkbox == '1' ){
      add_action( 'woocommerce_after_single_product_summary', array( $rvp_view_object, 'rvp_view_single'  ),21 );
  }

  if( isset( $options['shop_checkbox'] )  ){
      $shop_checkbox = esc_html( $options['shop_checkbox'] );
  }
  if( $shop_checkbox == '1' ){
      add_action( 'woocommerce_after_shop_loop', array( $rvp_view_object, 'rvp_view_single'  ) );
  }

  if( isset( $options['cart_checkbox'] )  ){
    $cart_checkbox = esc_html( $options['cart_checkbox'] );
  }
  if( $cart_checkbox == '1' ){
      add_action( 'woocommerce_after_cart', array( $rvp_view_object, 'rvp_view_single'  ) );
  }

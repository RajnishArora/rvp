<?php

function rvpplugin_settings_page_markup()
{
  // Double check user capabilities
  if ( !current_user_can('manage_options') ) {
      return;
  }
  include( RVPPLUGIN_DIR . 'templates/admin/settings-page.php');
}

function rvpplugin_settings_pages()
{
  add_menu_page(
    __( 'Recently Viewed Products Plugin', 'rvpplugin' ),   //page title
    __( 'Recently Viewed Products', 'rvpplugin' ), //menu title
    'manage_options',
    'rvpplugin',
    'rvpplugin_settings_page_markup',
    'dashicons-visibility',
    100
  );

}
add_action( 'admin_menu', 'rvpplugin_settings_pages' );

// Add a link to your settings page in your plugin
function rvpplugin_add_settings_link( $links ) {
    $settings_link = '<a href="admin.php?page=rvpplugin">' . __( 'Settings', 'rvpplugin'  ) . '</a>';
    array_push( $links, $settings_link );
  	return $links;
}
$filter_name = "plugin_action_links_" . plugin_basename( __FILE__ );
add_filter( $filter_name, 'rvpplugin_add_settings_link' );

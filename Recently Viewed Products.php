<?php
/*
Plugin Name: Recently Viewed Products
Plugin URI: https://github.com/rajnisharora/rvp
Description: Plugin to view recently viewed products in Woocommerce e-store
Version: 1.0.0
Contributors: rajarora795
Author: Rajnish Arora
Author URI:
License: GPLv2 or later
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: rvpplugin
Domain Path:  /languages
*/

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
  die("Not allowed to access directly");
}

if ( !in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
  die("Please install WooCommerce & try again");
}
// Define plugin paths and URLs

//$options = get_option( 'rvpplugin_settings' );

define( 'RVPPLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'RVPPLUGIN_DIR', plugin_dir_path( __FILE__ ) );


// Create Settings Fields
include( plugin_dir_path( __FILE__ ) . 'includes/rvpplugin-settings-fields.php');

// Create Plugin Admin Menus and Setting Pages
include( plugin_dir_path( __FILE__ ) . 'includes/rvpplugin-styles.php');
include( plugin_dir_path( __FILE__ ) . 'includes/rvpplugin-scripts.php');

include( plugin_dir_path( __FILE__ ) . 'includes/rvpplugin-menus.php');


// create a new custom post type rvp for storing ids
include( plugin_dir_path( __FILE__ ) . 'includes/rvppost_types.php');
include( plugin_dir_path( __FILE__ ) . 'includes/rvpclass_create_metabox.php');
include( plugin_dir_path( __FILE__ ) . 'includes/rvpclass_create_list.php');
include( plugin_dir_path( __FILE__ ) . 'includes/rvpclass_view_list.php');
include( plugin_dir_path( __FILE__ ) . 'includes/rvp_actions.php');
include( plugin_dir_path( __FILE__ ) . 'shortcodes/rvp_shortcodes_view.php');

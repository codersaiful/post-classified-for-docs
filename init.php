<?php

/**
 * Plugin Name: AAA WP Post Classfied for making Docs
 * Plugin URI: #
 * Description: To display all post based on a shortcode [WPPCD_Post cats='123,322']
 * Author: Saiful Islam
 * Author URI: https://profiles.wordpress.org/codersaiful/#content-plugins
 * 
 * Version: 1.0.0
 * Requires at least:    4.0.0
 * Tested up to:         5.8
 * WC requires at least: 4.0
 * WC tested up to:      5.6.2
 */

use TierPricingTable\Integrations\Plugins\WCPA;

if ( !defined( 'ABSPATH' ) ) {
    die();
}

if ( !defined( 'WPPCD_VERSION' ) ) {
    define( 'WPPCD_VERSION', '1.0.0');
}
if( !defined( 'WPPCD_CAPABILITY' ) ){
    $wppcd_addons_capability = apply_filters( 'wppcd_addons_menu_capability', 'manage_woocommerce' );
    define( 'WPPCD_CAPABILITY', $wppcd_addons_capability );
}

if ( !defined( 'WPPCD_NAME' ) ) {
    define( 'WPPCD_NAME', 'UltraAddons - Addons Plugin');
}

if ( !defined( 'WPPCD_BASE_NAME' ) ) {
    define( 'WPPCD_BASE_NAME', plugin_basename( __FILE__ ) );
}

if ( !defined( 'WPPCD_MENU_SLUG' ) ) {
    define( 'WPPCD_MENU_SLUG', 'UltraAddons-addons' );
}
if( !defined( 'WPPCD_PLUGIN' ) ){
    define( 'WPPCD_PLUGIN', 'UltraAddons-addons/init.php' );
}


if ( !defined( 'WPPCD_BASE_URL' ) ) {
    define( "WPPCD_BASE_URL", plugins_url() . '/'. plugin_basename( dirname( __FILE__ ) ) . '/' );
}

if ( !defined( 'WPPCD_BASE_DIR' ) ) {
    define( "WPPCD_BASE_DIR", str_replace( '\\', '/', dirname( __FILE__ ) ) );
}

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

include_once WPPCD_BASE_DIR . '/app/shortcode.php';

add_shortcode('WPPCD_Post',['WPPCD\Shortcode','init']);

//Including File
include_once WPPCD_BASE_DIR . '/includes/load-scripts.php';
include_once WPPCD_BASE_DIR . '/includes/functions.php';
include_once WPPCD_BASE_DIR . '/includes/action-hook.php';


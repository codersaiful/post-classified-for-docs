<?php

/**
 * Plugin Name: Post Classfied for making Documentation, Site map, POST List
 * Plugin URI: https://github.com/codersaiful/post-classified-for-docs
 * Description: To display all post based on a shortcode [WPPCD_Post taxs='123,322']. User able to display any type custom post. Even any type taxonomy. Such: category,tags etc.
 * Author: Saiful Islam
 * Author URI: https://profiles.wordpress.org/codersaiful/#content-plugins
 * 
 * Version: 1.1
 * Requires at least:    4.0.0
 * Tested up to:         5.8.2
 * WC requires at least: 4.0
 * WC tested up to:      5.6.2
 * 
 * *********************
 * SHORTCODE EXAMPLE: 
 * 
 * [WPPCD_Post taxs='123,322']
 * 
 * [WPPCD_Post]
 * 
 * [WPPCD_Post post_type='product']
 * 
 * [WPPCD_Post post_type='product' term_name='product_tag']
 * 
 * [WPPCD_Post taxs='12,34,56,67' post_type='product' term_name='product_tag' term_link='off' posts_per_page='10']
 * 
 * *********************
 * OTHERS INFORMATION and LINKS:
 * Plugin WP URL: https://wordpress.org/plugins/post-classified-for-docs/
 * *********************
 * Text Domain: wppcd
 */


if ( !defined( 'ABSPATH' ) ) {
    die();
}

if ( !defined( 'WPPCD_VERSION' ) ) {
    define( 'WPPCD_VERSION', '1.1.0');
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
    define( 'WPPCD_MENU_SLUG', 'post-classified-for-docs' );
}
if( !defined( 'WPPCD_PLUGIN' ) ){
    define( 'WPPCD_PLUGIN', 'post-classified-for-docs/init.php' );
}


if ( !defined( 'WPPCD_BASE_URL' ) ) {
    define( "WPPCD_BASE_URL", plugins_url() . '/'. plugin_basename( dirname( __FILE__ ) ) . '/' );
}

if ( !defined( 'WPPCD_BASE_DIR' ) ) {
    define( "WPPCD_BASE_DIR", str_replace( '\\', '/', dirname( __FILE__ ) ) );
}

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

//Including File
include_once WPPCD_BASE_DIR . '/includes/load-scripts.php';
include_once WPPCD_BASE_DIR . '/includes/functions.php';

include_once WPPCD_BASE_DIR . '/app/shortcode.php';

add_shortcode('WPPCD_Post',['WPPCD\Shortcode','init']);



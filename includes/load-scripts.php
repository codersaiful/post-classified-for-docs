<?php

if( !function_exists( 'wppcd_enqueue_scripts' ) ){

    /**
     * Enqueueing required css and js file.
     * For FrontEnd perpose
     *
     * @return void
     */
    function wppcd_enqueue_scripts(){
        wp_enqueue_style( 'wppcd-style', WPPCD_BASE_URL . 'assets/css/style.css', array(), '1.0.0', 'all' );
        wp_enqueue_script( 'jquery' );

        /**
         * It has called to populate WPPCD_DATA to front-end, It wil be need
         * for other developer
         * 
         * @since 1.0
         */
        wp_enqueue_script( 'wppcd-script', WPPCD_BASE_URL . 'assets/js/scripts.js', array( 'jquery','wpt-custom-js' ), '1.0.0', true );

        $ajax_url = admin_url( 'admin-ajax.php' );
        $WPPCD_DATA = array( 
            'ajaxurl'   => $ajax_url,
            'ajax_url'  => $ajax_url,
            'site_url'  => site_url(),
            'checkout_url' => function_exists( 'wc_get_checkout_url' ) ? wc_get_checkout_url() : false,
            'cart_url' => function_exists( 'wc_get_cart_url' ) ? wc_get_cart_url() : false,
            );
        wp_localize_script( 'wppcd-script', 'WPPCD_DATA', $WPPCD_DATA );
    }
}
add_action( 'wp_enqueue_scripts', 'wppcd_enqueue_scripts' );

if( !function_exists( 'wppcd_admin_enqueue_scripts' ) ){

    /**
     * Enquequing important file for Dashboard
     * 
     * @since 1.0.0
     *
     * @return void
     */
    function wppcd_admin_enqueue_scripts( ) {

        wp_enqueue_style( 'wppcd-admin', WPPCD_BASE_URL . 'assets/css/admin-style.css', array(), '1.0.0', 'all' );
    }
}
add_action( 'admin_enqueue_scripts', 'wppcd_admin_enqueue_scripts' );
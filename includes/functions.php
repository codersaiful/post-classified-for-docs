<?php

/**
 * Here is a Sample Function with Action Hook
 * If you want to add anyone, Please copy and paste and change function name
 * And Use
 */
if( !function_exists( 'wppcd_addons_sample_function' ) ){
   function wppcd_addons_sample_function() {
 
   }
}
add_filter( 'filter_hook_name', 'wppcd_addons_sample_function' );

/**
 * Start Writing your script for action or Filter.
 * Normally write Filter here, for action, an another file name action-hook.php file is available to this same directory
 * 
 */

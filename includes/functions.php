<?php
if( ! function_exists('dd') ){

    /**
     * Dumps the given values in a human-readable format.
     * 
     * ***************************
     * FOR DEVELOPMENT AND DEBUG PERPOSE
     * ***************************
     *
     * This function accepts a variable number of arguments and
     * outputs each value using `var_dump()` wrapped in `<pre>` tags
     * for improved readability. It only processes non-empty arrays.
     *
     * @param mixed ...$vals Variable number of arguments to be dumped.
     */
	function dd( ...$vals){
		if( ! empty($vals) && is_array($vals) ){
			foreach($vals as $val ){
				echo "<pre>";
				var_dump($val);
				echo "</pre>";
			}
		}
	}
}
/**
 * Getting Plugins current version
 * 
 * We would like to use this specially on  enquequ function when need version
 *
 * @since 1.0.0
 * @return void
 */
function wppcd_get_version(){
   return '1.0';
}

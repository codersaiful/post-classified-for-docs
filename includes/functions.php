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
	function dd(...$vals) {
      $backtrace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 1)[0];
      $file = $backtrace['file'] ?? 'Unknown file';
      $line = $backtrace['line'] ?? 'Unknown line';
      echo '<div style="background: #e1e1e1;border-left: 3px solid #888;padding: 15px;margin: 15px 0;font-family: monospace;border-radius: 6px;overflow-x: auto;">';
      echo '<div style="margin-bottom: 10px;color: #3F51B5;">';
      echo "🛠️ <strong>File:</strong> <span style='color:#8d8d8d;'>$file</span> on line <span style='color:#4b4b4b;'>$line</span>";
      echo '</div>';
      foreach ($vals as $val) {
         ob_start();
         var_dump($val);
         $output = ob_get_clean();
         // HTML entities
         echo '<pre style="color: #777777;background: #ffffff9c;">' . htmlspecialchars($output) . '</pre>';
      }
      echo '</div>';
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

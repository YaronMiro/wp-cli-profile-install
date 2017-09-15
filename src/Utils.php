<?php

namespace YaronMiro\WpProfile;

use WP_CLI;

/**
 * The Utilities that do NOT depend on any class.
 *
 */
 class Utils {

   /**
    * Making sure this is a static class
    */
   private function __construct() {}


   /**
    * Collect all keys from a any array including a multidimensional array.
    *
    * @param array $array
    *   The target array.
    * @return array
    *  The target array keys
    *
    */
   public static function get_array_keys(array $array) {
     $keys = array();

     foreach ($array as $key => $value) {

       // In case it's a numeric key then we can skip it.
       if ( is_int( $key ) ) {
         continue;
       }

       $keys[] = $key;

       // Use recursive in case the array is multidimensional.
       if (is_array($value)) {
         $keys = array_merge($keys, self::get_array_keys($value));
       }
     }

     return $keys;
   }

}

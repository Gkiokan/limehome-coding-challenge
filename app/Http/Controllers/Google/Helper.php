<?php

namespace App\Http\Controllers\Google;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Helper extends Controller
{

      public static function buildURL($uri = '', $args=[], $default=[]){

          // mege custom args
          if( !empty($default) && is_array($default) )
          $args = array_merge($default, $args);

          // build query string
          $params = http_build_query($args);

          // merge strings
          $url = $uri . $params;

          return $url;
      }



}

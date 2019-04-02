<?php

namespace App\Http\Controllers\Google;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Photo extends Controller
{
    protected $url = "https://maps.googleapis.com/maps/api/place/photo?";
    public $ref = "";
    public $key = "";
    public $photoURL = "";

    public $args = [
        'photoreference'  => '',
        'sensor'          => false,
        'maxheight'       => 1080,
        'maxwidth'        => 1920,
        'key'             => ''
    ];

    public function __construct($ref='', $args=[]){
        $this->key = env('GOOGLE_PLACES_API_KEY', null);
        $this->ref = $ref;

        $params = array_merge($this->args, [
          'photoreference' => $ref,
          'key'            => $this->key
        ]);

        $this->photoURL = Helper::buildURL($this->url, $params);
    }


    public static function getURL($ref='', $args=[]){
        $p = new self($ref, $args);
        $url = $p->photoURL;

        return $url;
    }


    public static function getURLFromPlace($place=false){
        if(!$place && !is_object($place)) return 'NO_PLACE_OBJECT';

        // the straight hirarchy for photo ref
        // $place->photos[0]->photo_reference

        // validate we have at least one object in array
        if( count($place->photos) == 0 ) return "NO_PHOTOS_FOUND_AT_PHOTOS[0]";

        $ref = $place->photos[0]->photo_reference;
        $url = self::getURL($ref);

        return $url;
    }

}

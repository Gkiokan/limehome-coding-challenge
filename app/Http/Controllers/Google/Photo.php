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


    /*
        getURL
        ---------
        Shortcut static method for nice and clean handling URL request for image.
        This generates the final image URI based on the reference value.
        $ref is used to be the Photo Refrence ID
        $args can be any valid param as of: https://developers.google.com/places/web-service/photos
    */
    public static function getURL($ref='', $args=[]){
        $p = new self($ref, $args);
        $url = $p->photoURL;

        return $url;
    }


    /*
        getFirstURLFromPlace
        ------------------------
        Just mapping the first photo item in the Place Object.
        This can save just a chunk of time, when all Objects may have only one item
        in photos, so we don't need to iterate though the photos array.
    */
    public static function getFirstURLFromPlace($place=false){
        if(!$place && !is_object($place)) return 'NO_PLACE_OBJECT';

        // the straight hirarchy for photo ref
        // $place->photos[0]->photo_reference

        // validate we have at least one object in array
        if( count($place->photos) == 0 ) return "NO_PHOTOS_FOUND_AT_PHOTOS[0]";

        $ref = $place->photos[0]->photo_reference;
        $url = self::getURL($ref);

        return $url;
    }


    /*
        getURLFromPhoto
        -----------------
        Foreach Photo Object it will get the URL for it.
        Use it as a helper method for each photo Object.
    */
    public static function getURLFromPhoto($photo=false){
        if(!$photo && !is_object($photo)) return "NO_PHOTO_OBJECT";

        if( !$photo->photo_reference ) return "NO_PHOTO_REF_FOUND";

        $ref = $photo->photo_reference;
        $url = self::getURL($ref);

        return $url;
    }



    /*
        mapAllPhotosURLInPlace
        -------------------------
        This function maps the photo array of the Google places to
        a final image URL which can be directly used. Due the fact, that google
        allows multiple Photos to be here, we loop though the photos array and
        update the Object and return the mapped state.
    */
    public static function mapAllPhotosURLInPlace($place=null){
        if(!$place) return "NOTHING?";

        if(is_array($place->photos))
        foreach($place->photos as $x => $photo):
          $place->photos[$x]->url = self::getURLFromPhoto($photo);
        endforeach;

        return $place;
    }

}

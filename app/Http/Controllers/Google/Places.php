<?php

namespace App\Http\Controllers\Google;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Places extends Controller
{
    protected $api    = 'https://maps.googleapis.com/maps/api/place/nearbysearch/json?';

    public $requestURL = '';
    public $response   = null;
    public $places     = [];
    public $markers    = [];

    public static $AutoMapPlacesMarkers = true;
    public static $AutoMapPhotoURLs = true;

    public $defaultParameter = [
        'location'  => null, // '48.11104280000001,11.5491273',
        'radius'    => null, // 1500
        'type'      => null, // https://developers.google.com/places/web-service/supported_types
        'key'       => null, // Google API Key / AIzaSyCfWwZlZ6DvTqAzQhgdro8EUI0MyzU3Ztg
    ];

    public $mergedParameter = [];


    public function __construct($args=[]){
        // settup auth params
        $this->defaultParameter['key'] = env('GOOGLE_PLACES_API_KEY', null);

        // merge params
        $this->mergedParameter = array_merge($this->defaultParameter, $args);

        // build the URL with the params
        $this->requestURL = Helper::buildURL($this->api, $this->mergedParameter);
    }


    /*
        getResponse
        -------------
        Handles the Places API Request and returns the response.
        Furthermore it maps the places and markers directly whenever
        the flag self::$AutoMapPlacesMarkers is set.
    */
    public function getResponse(){
        // simplest way of handling requests in php
        // could be done with guzzle for deepter Error handling and stuff
        $this->response = $response = json_decode( file_get_contents($this->requestURL) );


        // Modify Photo Image URL
        if(self::$AutoMapPhotoURLs):
            if(is_array($this->places))
            foreach($this->places as $place)
                $place = $this->mapAllPhotosURLInPlace($place);
        endif;

        // Create public Objects to get them later with the getters
        if(self::$AutoMapPlacesMarkers):
            $this->mapPlaces();
            $this->mapMarkers();
        endif;

        // in any case, just return the response
        return $response;
    }


    /*
        mapPlaces
        -----------------------------------------------
        Get the places out of the response and put it in the Class,
        so we can get it easy with $class->getPlaces()
    */
    public function mapPlaces(){
        if(!$this->response) return "NO_RESPONSE_FOUND";

        if($this->response->results):
            $this->places = $this->response->results;

            // if any validation would be needen,
            // this is a good place to loop though the results
        endif;

        return $this->places;
    }


    /*
        mapAllPhotosURLInPlace
        -------------------------
        This function maps the photo array of the Google places to
        a final image URL which can be directly used. Due the fact, that google
        allows multiple Photos to be here, we loop though the photos array and
        update the Object and return the mapped state.
    */
    public function mapAllPhotosURLInPlace($place=null){
        if(!$place) return;
        $x=0;

        if(is_array($place->photos))
        foreach($place->photos as $photo)
          $photo->url = Photo::getURLFromPlace($place);

        return $place;
    }


    /*
        mapMarkers
        -----------------------------------------------
        Mapping Markers out of the Places.
        This method is intentionally created for creating an specific
        array of Objects for the Markers to be build on the Map
    */
    public function mapMarkers(){
        if(!$this->response->results) return "NO_PLACES_FOUND";

        $patchedMarkers = [];

        if( is_array($this->response->results))
        foreach($this->response->results as $place):
            $temp = [];
            // $temp['place'] = $place;
            $temp['name']            = $place->name;
            $temp['location']['lat'] = $place->geometry->location->lat;
            $temp['location']['lng'] = $place->geometry->location->lng;
            $temp['photos']          = $place->photos;

            // Alternatively you could map specific Images just targeting the markers
            // $temp['photo']['url']    = Photo::getURLFromPlace($place);
            // $temp['photo']['ref']  = $place->photos[0]->photo_reference;

            $patchedMarkers[] = $temp;
        endforeach;

        $this->markers = $patchedMarkers;

        return $this->markers;
    }


    /*
        simple getter
    */
    public function getPlaces(){
        return $this->places;
    }

    public function getMarkers(){
        return $this->markers;
    }

}

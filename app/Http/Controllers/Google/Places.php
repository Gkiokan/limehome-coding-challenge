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


    public function getResponse(){
        // simplest way of handling requests in php
        // could be done with guzzle for deepter Error handling and stuff
        $this->response = $response = json_decode( file_get_contents($this->requestURL) );

        if(self::$AutoMapPlacesMarkers):
            $this->mapPlaces();
            $this->mapMarkers();
        endif;

        return $response;
    }


    public function getPlaces(){
        return $this->places;
    }

    public function getMarkers(){
        return $this->markers;
    }


    public function mapPlaces(){
        if(!$this->response) return "NO_RESPONSE_FOUND";

        if($this->response->results):
            $this->places = $this->response->results;
        endif;

        return $this->places;
    }


    public function mapMarkers(){
        if(!$this->response->results) return "NO_PLACES_FOUND";

        $patchedMarkers = [];

        if( is_array($this->response->results))
        foreach($this->response->results as $place):
            $temp = [];
            $temp['position']['lat'] = $place->geometry->location->lat;
            $temp['position']['lng'] = $place->geometry->location->lng;

            $patchedMarkers[] = $temp;
        endforeach;

        $this->markers = $patchedMarkers;

        return $this->markers;
    }

}

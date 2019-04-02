<?php

namespace App\Http\Controllers\Google;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Places extends Controller
{
    protected $api    = 'https://maps.googleapis.com/maps/api/place/nearbysearch/json?';

    public $requestURL = '';
    public $response   = null;

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


    public function getNearBy(){
        // simplest way of handling requests in php
        // could be done with guzzle for deepter Error handling and stuff
        $this->response = $response = json_decode( file_get_contents($this->requestURL) );

        return $response;
    }

}

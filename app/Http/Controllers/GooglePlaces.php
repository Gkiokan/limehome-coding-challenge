<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GooglePlaces extends Controller
{

    public function index(Request $request){
        // specify Places API Parameters here as an array
        // https://developers.google.com/places/web-service/search#PlaceSearchRequests
        $args = [
            'location'  => '48.11104280000001,11.5491273',
            'radius'    => 1500
        ];

        $gp = new Google\Places($args);

        $response = $gp->getResponse();
        $markers  = $gp->getMarkers();
        $places   = $gp->getPlaces();

        return response()->json([
            'response'  => $response,
            'places'    => $places,
            'markers'   => $markers,
        ]);
    }


    public function doSomethingWithPlaces($places, $skip = false){
        if($skip) return $places;

        if( is_array($places))
        foreach($places as $place):

        endforeach;

        return $places;
    }

}

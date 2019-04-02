<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GooglePlaces extends Controller
{

    public function index(){
        $args = [
            'location'  => '48.11104280000001,11.5491273',
            'radius'    => 1500
        ];

        $gp = new Google\Places($args);

        $places = $gp->getNearBy();

        return response()->json($places);
    }


    public function doSomethingWithPlacesAsArray($places, $skip = false){
        if($skip) return $places;

        if( is_array($places))
        foreach($places as $place):

        endforeach;

        return $places;
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Test extends Controller
{

    public function index(){
        $args = [
            'location'  => '48.11104280000001,11.5491273',
            'radius'    => 1500
        ];

        $gp = new Google\Places($args);

        $places = $gp->getNearBy();

        dd($gp);
        
        return response()->json($places);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\BookingRequest;

class Booking extends Controller
{

    // secure the store method for auth user's only
    // just another way instead of doing it in the router
    public function __construct(){
        $this->middleware('auth')->only('store');
    }


    // Create the Booking enty
    public function store(BookingRequest $request, $id=null){

        if(!$id) return response()->json([
            'error' => 'NO_PLACE_ID_FOUND'
        ], 422);



        return response()->json($request->all(), 200);
    }

}

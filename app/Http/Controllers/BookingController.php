<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\BookingRequest;
use Auth;
use App\User;
use App\Booking;

class BookingController extends Controller
{

    // secure the store method for auth user's only
    // just another way instead of doing it in the router
    public function __construct(){
        // $this->middleware('auth')->only('store');
    }


    // Create the Booking enty
    public function store(Request $request, $id=null){

        if(!$id) return response()->json([
            'error' => 'NO_PLACE_ID_FOUND'
        ], 422);

        $booking = Booking::create([
            'name'  => 'PropertyTestName ' . rand(2000,9999),
            'user_id' => 1,
        ]);

        return response()->json([
          'booking' => $booking,
          'request' => $request->all(),
        ], 200);
    }

}

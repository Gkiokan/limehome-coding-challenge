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
    public function store(BookingRequest $request, $id=null){

        if(!$id) return response()->json([
            'error' => 'NO_PLACE_ID_FOUND'
        ], 422);

        $booking = Booking::create($request->all());

        return response()->json([
          'booking' => $booking,
          'request' => $request->all(),
        ], 200);
    }


    // get all bookings
    public function all(){
        $bookings = Booking::with('user')->get();
        return response()->json($bookings, 200);
    }


    // get all bookings from a User
    public function allBookingsByUser($user=null){
        $user = User::find($user);

        if(!$user) return response()->json([
            'error' => 'NO_USER_FOUND'
        ], 404);

        $bookings = $user->bookings()->get();

        return response()->json([
            'user'  => $user,
            'bookings'  => $bookings,
        ], 200);
    }

}

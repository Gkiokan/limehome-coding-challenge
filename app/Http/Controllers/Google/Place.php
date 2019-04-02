<?php

namespace App\Http\Controllers\Google;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Place extends Controller
{
    protected $url = "https://maps.googleapis.com/maps/api/place/details/json?";
    public $id = '';
    public $key = '';
    public $placeURL = '';
    public $response = null;

    public $args = [
        'placeid'  => '',
        'key'      => ''
    ];

    public function __construct($id='', $args=[]){
        $this->key = env('GOOGLE_PLACES_API_KEY', null);
        $this->id  = $id;

        $params = array_merge($this->args, [
          'placeid' => $this->id,
          'key'     => $this->key
        ]);

        $this->placeURL = Helper::buildURL($this->url, $params);
    }


    public function getResponse(){
        $this->response = json_decode( file_get_contents($this->placeURL) );

        return $this->response;
    }


}

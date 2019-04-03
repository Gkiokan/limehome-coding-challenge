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


    // get Response and map the photos to url
    public function getResponse(){
        $this->response = json_decode( file_get_contents($this->placeURL) );

        $this->mapPhotos();
        $this->modifyData();

        return $this->response;
    }


    // map the response with all the url codes, love the recursivly
    // usability of Photo Class here, less code, more effective
    public function mapPhotos(){
        if(is_array($this->response->result->photos))
        $this->response->result = Photo::mapAllPhotosURLInPlace($this->response->result);
    }

    // Modify some data
    // sometimes, we are just faster when we handle the mod in the backend.
    // like excluding reviews, or parsing adresses correctly
    public function modifyData(){

        // mod adress
        if(isset($this->response->result->formatted_address)):
          $adress = $this->response->result->formatted_address;
          $this->response->result->formatted_address_html = str_ireplace(",", "<br>", $adress);
        endif;

        // mod opening hours
        if(isset($this->response->result->opening_hours)):
          $opening_hours = $this->response->result->opening_hours->weekday_text;
          $this->response->result->opening_hours->formatted_weekday_text_html = join('<br>', $opening_hours);
        endif;

        // delete reviews
        unset($this->response->result->reviews);
    }
}

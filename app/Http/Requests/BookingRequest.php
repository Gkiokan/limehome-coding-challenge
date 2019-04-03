<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class BookingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_id'   => 'required',

            'name'    => 'required',
            'adress'  => 'required',
            'city'    => 'required',
            'phone'   => 'required',

            'place_id'  => 'required',
            'plus_code' => 'required',
        ];
    }
}

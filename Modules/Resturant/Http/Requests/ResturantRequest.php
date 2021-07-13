<?php

namespace Modules\Resturant\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResturantRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'plan_id' =>'required',
            'city_id' =>'required',
            'type'=>'required',
            //'price_delivery'=>'required',
            // 'icon'=>'required',
            // 'image'=>'required',
            'lat'=>'required',
            'lng'=>'required',
            'closed'=>'required',
            // 'min'=>'required',
            'en.price'=>'required',
            'ar.price'=>'required',
            'en.name' =>'required',
            'ar.name'=>'required',
            'en.offer' =>'required',
            'ar.offer'=>'required',
            //'en.mins' =>'required',
            //'ar.mins'=>'required',
            'en.terms'=>'required',
            'ar.terms'=>'required'
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}

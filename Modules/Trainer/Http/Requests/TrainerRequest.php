<?php

namespace Modules\Trainer\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TrainerRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //'plan_id' =>'required',
            //'type'=>'required',
            //'city_id' =>'required',
           // 'price'=>'required',
            // 'image'=>'required',
            //'nationality_id' =>'required',
           // 'age'=>'required',
           // 'lat'=>'required',
           // 'lng'=>'required',
           // 'available_time'=>'required',
            'en.name' =>'required',
            'ar.name'=>'required',
           // 'en.about'=>'required',
           // 'ar.about'=>'required',
           // 'en.level' =>'required',
           // 'ar.level'=>'required',
            //'en.currency' =>'required',
           // 'ar.currency'=>'required',
           // 'en.class' =>'required',
           // 'ar.class'=>'required',
           // 'en.terms'=>'required',
            //'ar.terms'=>'required'
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

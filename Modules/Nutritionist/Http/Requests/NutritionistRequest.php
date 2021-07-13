<?php

namespace Modules\Nutritionist\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NutritionistRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
           // 'plan_id' =>'required',
           // 'city_id' =>'required',
           // 'nationality_id' =>'required',
           // 'type'=>'required',
            //'price'=>'required',
            // 'image'=>'required',
           // 'age'=>'required',
            //'available_time'=>'required',
            //'lat'=>'required',
            //'lng'=>'required',
            'en.name' =>'required',
            'ar.name'=>'required',
            //'en.about' =>'required',
            //'ar.about'=>'required',
            //'en.level' =>'required',
            //'ar.level'=>'required',
            //'en.currency' =>'required',
            //'ar.currency'=>'required',
            //'en.class' =>'required',
            //'ar.class'=>'required',
            //'en.terms'=>'required',
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

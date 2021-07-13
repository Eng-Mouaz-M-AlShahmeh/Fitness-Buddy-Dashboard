<?php

namespace Modules\Meal\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MealRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'en.name' =>'required',
            'ar.name'=>'required',
            'en.currency' =>'required',
            'ar.currency'=>'required',
            'en.calorie' =>'required',
            'ar.calorie'=>'required',
            'en.desc' =>'required',
            'ar.desc'=>'required',
            'resturant_id' =>'required',
            // 'branch_id'=>'required',
            'cat_id' =>'required',
            'image' =>'required',
            'calories' =>'required',
            'price_before' =>'required',
            'price_after' =>'required',
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

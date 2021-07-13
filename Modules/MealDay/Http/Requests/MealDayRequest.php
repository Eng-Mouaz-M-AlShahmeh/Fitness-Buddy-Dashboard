<?php

namespace Modules\MealDay\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MealDayRequest extends FormRequest
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
            'price' =>'required',
            'number'=>'required',
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

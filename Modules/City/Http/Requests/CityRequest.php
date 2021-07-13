<?php

namespace Modules\City\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CityRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

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

        ];
    }

    public function messages()
    {
        return [
            'en.name.required'=>'لم يتم ادخال اسم البلد بالانجليزية',
            'ar.name.required'=>'لم يتم ادخال اسم البلد بالعربي',
        ];
    }
}

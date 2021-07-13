<?php

namespace Modules\Modifier\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ModifierRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'en.modifier' =>'required',
            'ar.modifier'=>'required',

        ];
    }

    public function messages()
    {
        return [
            'en.modifier.required'=>'لم يتم ادخال اسم الاضافة بالانجليزية',
            'ar.modifier.required'=>'لم يتم ادخال اسم الاضافة بالعربي',
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

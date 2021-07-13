<?php

namespace Modules\Department\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DepartmentsRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'ar.title'=>'required',
            'en.title'=>'required',
            'ar.name'=>'required',
            'en.name'=>'required',
        ];
    }
    public function messages(){
        return[
            'ar.title.required'=>'insert title of department in arabic',
            'en.title.required'=>'insert title of department in english',
            'ar.name.required'=>'insert department name in arabic',
            'en.name.required'=>'insert department name in english',

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

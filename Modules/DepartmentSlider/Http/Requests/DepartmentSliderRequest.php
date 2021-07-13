<?php

namespace Modules\DepartmentSlider\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DepartmentSliderRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
       return [
            'dept_id'=>'required',
            'slider'=>'required',
            'en.desc'=>'required',
            'ar.desc'=>'required',
            'en.title'=>'required',
            'ar.title'=>'required',
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

<?php

namespace Modules\Settings\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingsRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'ar.privacy'=>'required',
            'en.privacy'=>'required',
            'ar.about'=>'required',
            'en.about'=>'required',
            'ar.name'=>'required',
            'en.name'=>'required',
            'logo'=>'required',
        ];
    }
    public function messages(){
        return[
            'ar.privacy.required'=>'enter privacy in arabic',
            'en.privacy.required'=>'enter privacy in english',
            'ar.about.required'=>'enter about us in arabic',
            'en.about.required'=>'enter about us in english',
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

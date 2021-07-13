<?php

namespace Modules\FitnessClub\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FitnessClubRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'city_id' =>'required',
            'type'=>'required',
            // 'logo'=>'required',
            // 'image'=>'required',
            'lat'=>'required',
            'lng'=>'required',
            'en.name' =>'required',
            'ar.name'=>'required',
            'en.desc' =>'required',
            'ar.desc'=>'required',
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

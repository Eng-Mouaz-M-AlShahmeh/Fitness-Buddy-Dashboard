<?php

namespace Modules\TrainerSlider\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TrainerSliderRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'trainer_id'=>'required',
            'image'=>'required',
            'ar.title'=>'required',
            'en.title'=>'required',
            'ar.description'=>'required',
            'en.description'=>'required',
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

<?php

namespace Modules\TrainerVideo\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TrainerVideoRequest extends FormRequest
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
            'ar.name'=>'required',
            'en.name'=>'required',
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

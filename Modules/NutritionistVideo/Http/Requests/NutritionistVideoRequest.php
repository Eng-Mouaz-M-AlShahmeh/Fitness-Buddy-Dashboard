<?php

namespace Modules\NutritionistVideo\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NutritionistVideoRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nutritionist_id'=>'required',
            'image'=> 'required',
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

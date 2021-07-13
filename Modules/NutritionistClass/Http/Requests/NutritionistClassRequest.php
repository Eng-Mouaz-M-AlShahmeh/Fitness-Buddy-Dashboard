<?php

namespace Modules\NutritionistClass\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NutritionistClassRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'class_id'=>'required',
            'nutritionist_id'=>'required'
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

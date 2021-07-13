<?php

namespace Modules\NutritionistLanguage\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NutritionistLanguageRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'language_id'=>'required',
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

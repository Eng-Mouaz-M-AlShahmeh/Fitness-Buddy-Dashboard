<?php

namespace Modules\MealIngredient\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MealIngredientRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'meal_id'=>'required',
            'calorie'=>'required',
            'ar.ingredient'=>'required',
            'en.ingredient'=>'required',
            'ar.calories'=>'required',
            'en.calories'=>'required',
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

<?php

namespace Modules\ClubSlider\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClubSliderRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'club_id'=>'required',
            'image'=>'required',
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

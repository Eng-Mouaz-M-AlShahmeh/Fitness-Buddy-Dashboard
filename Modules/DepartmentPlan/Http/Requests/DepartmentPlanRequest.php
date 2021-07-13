<?php

namespace Modules\DepartmentPlan\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DepartmentPlanRequest extends FormRequest
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
            'plan_id'=>'required'
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

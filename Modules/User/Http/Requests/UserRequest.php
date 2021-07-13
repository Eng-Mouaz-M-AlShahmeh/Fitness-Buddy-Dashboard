<?php

namespace Modules\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            
            'name' =>'required',
            'email'=>'required|unique:users,email',
            'mobile' =>'required|unique:users,mobile',
            'password'=>'required',
            //'image'=>'required',
            //'length' =>'required',
            //'weight'=>'required',
            //'age'=>'required',
            
        ];
    }
    
    
    
    public function messages(){
        return[
            'name.required'=>'insert name of user',
            'email.required'=>'insert email of user',
            'mobile.required'=>'insert mobile of user',
            'password.required'=>'insert password',
            //'image.required'=>'insert image of user',
            //'length.required'=>'insert length of user',
            //'weight.required'=>'insert weight of user',
            //'age.required'=>'insert Date of Birth  of user',

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

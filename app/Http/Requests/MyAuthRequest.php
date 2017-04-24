<?php

namespace App\Http\Requests;


class MyAuthRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
           'login' => 'required|exists:users,login,id_user_role,6',
           'password' => 'required'
        ];
    }


    public function messages()
    {
        return [
            'login.required' => trans('welcome.61'),
            'password.required' => trans('welcome.62'),
            'login.exists'  => trans('welcome.63'),
        ];
    }
}

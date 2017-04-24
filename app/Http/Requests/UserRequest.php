<?php

namespace App\Http\Requests;

class UserRequest extends Request
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
            'fio' => 'required',
            'uchZav' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'fio.required' => trans('welcome.65'),
            'uchZav.required'  => trans('welcome.65'),
        ];
    }
}

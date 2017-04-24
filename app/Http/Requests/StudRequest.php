<?php

namespace App\Http\Requests;

class StudRequest extends Request
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
            'first_name' => 'required',
            'last_name' => 'required',
            'num' => 'required|numeric',
            'liter' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => trans('welcome.65'),
            'last_name.required'  => trans('welcome.65'),
            'num.required'  => trans('welcome.65'),
            'num.numeric'  => trans('welcome.65'),
            'liter.required'  => trans('welcome.65')
        ];
    }
}

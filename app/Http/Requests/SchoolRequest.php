<?php

namespace App\Http\Requests;

class SchoolRequest extends Request
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'obl' => 'required',
            'raion' => 'required',
            'name_rus' => 'required',
            'name_kaz' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'obl.required' => trans('welcome.65'),
            'raion.required'  => trans('welcome.65'),
            'name_rus.required'  => trans('welcome.65'),
            'name_kaz.required'  => trans('welcome.65')
        ];
    }
}

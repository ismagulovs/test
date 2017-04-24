<?php

namespace App\Http\Requests;


class PeriodRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'identifier' => 'required|alpha_dash',
            'lang' => 'required|numeric',
            'class' => 'required',
            'num' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'identifier.required' => trans('welcome.65'),
            'identifier.alpha_dash' => 'Поле должно содержать буквы, цифры, знаки подчёркивания (_) и дефисы (-)',
            'num.required'  => trans('welcome.66'),
            'lang.required'  => trans('welcome.65'),
            'lang.numeric'  => trans('welcome.65'),
            'class.required'=> 'Не выбран класс для добавления в поток!',
        ];
    }
}

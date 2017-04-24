<?php

namespace App\Http\Controllers;


use App\Http\Requests\UserRequest;
use App\Models\UserRestrict;
use App\Models\Users;
use Session;

class UserController extends Controller
{
    public function update(UserRequest $request){
        UserRestrict::where('id_user', session('id_user'))
            ->update(['id_test_org' => $request->input('uchZav')]);

        Users::where('id', session('id_user'))
            ->update(['username' => $request->input('fio')]);

        session(['user' => session('id_user')]);
        Session::forget('login');
        Session::forget('id_user');
        Session::forget('obls');
        return redirect('/home');

    }

    public function kassa24(){
        if(session('id_user') and session('login')){
            return view('auth.kassa');
        }else{
            return redirect('/login');
        }

          //  ->withErrors('недостаточно попыток тестирования')
           // ->withInput();
    }
}

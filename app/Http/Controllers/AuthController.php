<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\MyAuthRequest;
use App\Models\Users;
use Illuminate\Support\Facades\DB;


class AuthController extends Controller {

//    public function __construct(Guard $auth, User $user)
//    {
//        $this->user = $user;
//        $this->auth = $auth;
//
//        $this->middleware('guest', ['except' => ['getLogout']]);
//    }


    public function getLogin(){
        return view('auth.login');
    }

    public function postLogin(MyAuthRequest $request){
        $user = Users::where('login', $request->input('login'))->select('id', 'login', 'username', 'id_user_role',
            'id_test_org', 'id_user_ppent', 'password')
            ->leftJoin('user_restrict', 'id', '=', 'user_restrict.id_user')->first();
        if($user->password == $request->input('password') and $user->id_user_role == 6){
            if($user->id_test_org == 0 and $user->id_user_ppent == 666){
                $obl = DB::table('spr_obl')->orderBy('id')->get();
                $obls[0] = "область";
                foreach($obl as $item){
                    $obls[$item->id] = $item->name_rus;
                }
                session(['obls'=>$obls]);
                session(['login' => $user->login]);
                session(['id_user' => $user->id]);
                return redirect('/update/kassa24');
               // return view('auth.kassa', ['login'=>$user->login, 'obls' => $obls]);
            }else{
                session(['user' => $user->id]);
            }
            return redirect('/home');
        }else{
            return redirect('/login')
                ->withErrors(['pass' => trans('welcome.64')])
                ->withInput();
        }
    }


    public function getLogout(){
        session()->put('user', null);

     //  dd(session()->all());
       return view('auth.login');
    }

}
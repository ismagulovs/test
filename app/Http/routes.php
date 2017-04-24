<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::group(['middleware' => 'lang'], function () {
    Route::get('/', function () {
        //return view('welcome');
        return redirect('/home');
    });

    Route::group(['middleware' => 'myauth'], function () {

        Route::get('/home', 'HomeController@index');

        Route::get('/student', 'HomeController@studentsList');

        Route::resource('/students', 'StudController');

        Route::resource('/period', 'PeriodController');

        Route::resource('/classes', 'ClassController');

        Route::get('/student/{id}/delete', ['as' => 'student.delete', 'uses' => 'StudController@destroy']);

        Route::get('/period/{id}/delete', ['as' => 'period.delete', 'https' => true, 'uses' => 'PeriodController@destroy']);

        Route::post('/class_flash', 'ClassController@class_flash');

        Route::post('/class/add', 'ClassController@addClass');

        Route::get('/classes/{class}/add', 'ClassController@ShowAddClassStudent');

        Route::post('/cntTry', function(){
            if(Request::ajax()){
                $userTryQuery = DB::table('user_restrict')->select('count_try')->where('id_user', session('user'))->first();
                $studTryQuery = DB::table('student_test')->select(DB::raw('count(*) as cnt, id_user'))
                    ->where('id_user', session('user'))
                    ->groupBy('id_user')
                    ->first();

                $userTryQuery->count_try == null or $userTryQuery == null ? $userTry = 0 : $userTry = $userTryQuery->count_try;

                if($studTryQuery == null){
                    $studTry = 0;
                }else{
                    $studTryQuery->cnt == null ? $studTry = 0 : $studTry = $studTryQuery->cnt;
                }

                $cntTry = $userTry-$studTry;
                return response()->json([
                    'userTry' => $userTry,
                    'studTry' => $studTry,
                    'cntTry' => $cntTry
                ]);
            }
        });


        Route::post('/getStudentClass', function(){
            if(Request::ajax()){
                $num_class = Request::input('n');
                $liter_class = Request::input('l');
                $res = students($num_class, $liter_class);
                return View::make('post', array('students' => $res));

            }
        });

        Route::get('/pr1/{test_period}', 'PrintController@pr1');
        Route::get('/pr3/{test_period}', 'PrintController@pr3');
        Route::get('/pr2/{id}', 'PrintController@pr2');

    });



    Route::get('/login', 'AuthController@getLogin');
    Route::post('/login', 'AuthController@postLogin');
    Route::get('/logout', 'AuthController@getLogout');

    Route::get('setlocale/{locale}', function ($locale) {
        App::setLocale($locale);
        session(['lang' => $locale]);
        return redirect()->back();
    });

    Route::post('/onObl', function(){
        $id = Request::input('id');
        $raion = DB::table('spr_raion')->where('id_obl', $id)->get();
        $html = '<option selected="selected" value="">район</option>';
        foreach($raion as $item){
            $html .= '<option value="'.$item->id_obl.'|'.$item->id_raion.'">'.$item->name_rus.'</option>';
        }
        return $html;
    });

    Route::post('/onRaion', function(){
        $id = explode("|", Request::input('id'));
        $raion = DB::table('test_org')->where('id_obl', $id[0])->where('id_raion', $id[1])->get();
        if($raion == null){
            $html = '<select class="form-control text-right" name="uchZav"><option value="">нет учебного заведения в списке</option></select>';
        }else{
            $html = '<select class="form-control text-right" name="uchZav"><option selected="selected" value="">учебное заведение...</option>';
            foreach($raion as $item){
                $html .= '<option value="'.$item->id.'">'.$item->name_rus.'</option>';
            }
            $html .= '</select>';
        }
        return $html;
    });

    Route::post('/update_kassa_user', 'UserController@update');

    Route::get('/update/kassa24', 'UserController@kassa24');

    Route::post('/addSchool', 'AddSchoolController@add');
});


function students($n, $l){
    $students = DB::select("select s.id, s.iin, s.lastname, s.firstname, s.patronymic, s.email
                    from student s
                    where s.num_class = $n and s.liter_class = '$l' and s.id_test_org = ".session('testOrg')."
                     order by s.lastname");
    return $students;
}
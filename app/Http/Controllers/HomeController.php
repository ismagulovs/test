<?php

namespace App\Http\Controllers;

use App\Models\UserRestrict;
use App\Models\TestOrg;
use App\Models\Users;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $user = Users::where('id', session('user'))->first();
        $userRestrict = UserRestrict::where('id_user', $user->id)->first();
        session(['testOrg' => $userRestrict->id_test_org]);
        $testOrg = TestOrg::where('id', $userRestrict->id_test_org)->first();
        $userTry = DB::table('user_restrict')->select('count_try')->where('id_user', session('user'))->first();
        $studTry = DB::table('student_test')->select(DB::raw('count(*) as cnt, id_user'))
            ->where('id_user', session('user'))
            ->groupBy('id_user')
            ->first();
        if($studTry == null){
            $isStudTry = 0;
        }else{
            $isStudTry = $studTry->cnt;
        }
        return view('page', ['user' => $user, 'userR' => $userRestrict, 'testOrg' => $testOrg, 'userTry'=>$userTry->count_try, 'studTry'=> $isStudTry]);
    }

//    public function studentsList()
//    {
//       $students = DB::select("select s.id, s.iin, s.lastname, s.firstname, s.patronymic, s.email,
//                                sum(CASE WHEN st.id_test_status = 3 THEN 1 ELSE 0 END) AS end_test,
//                                sum(CASE WHEN st.id_test_status = 0 THEN 1 ELSE 0 END) AS active_test,
//                                sum(CASE WHEN st.id_test_status = 1 THEN 1 ELSE 0 END) AS start_test
//                                 from student s
//                                    left join student_test st on st.id_student = s.id
//                                where s.id_test_org = ".session('testOrg')."
//                                group by s.id, s.iin, s.lastname, s.firstname, s.patronymic, s.email");
//       return view('studentList', ['students' => $students]);
//    }
}

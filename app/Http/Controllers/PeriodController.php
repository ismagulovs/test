<?php

namespace App\Http\Controllers;

use App\Http\Requests\PeriodRequest;
use App\Models\StudentTest;
use Illuminate\Support\Facades\DB;

class PeriodController extends Controller
{
    public function index(){
        $periods = DB::select("select st.test_period, s.num_class, s.liter_class
                                 from student_test st
                                    left join student s on s.id = st.id_student
                                where st.id_user = ".session('user')." and not st.test_period is null
                                group by st.test_period, s.num_class, s.liter_class
                                ");
        return view('period/periodList', ['periods'=>$periods]);
    }

    public function show($textPeriod)
    {
        $periods = DB::select("select st.id as id_test, s.id, s.iin,s.lastname, s.firstname, s.patronymic, s.email,
                                    s.num_class, s.liter_class,
                                    st.id as id_period, st.test_pass, st.id_test_status
                                    from student s
                                        inner join student_test st on st.id_student = s.id
                                    where st.test_period = '$textPeriod' and st.id_user = ".session('user')." 
                                    order by s.lastname");
        return view('period/periodShow', ['periods'=>$periods, 'title'=>$textPeriod]);
    }

    public function create(){
        $qClasses = DB::select("select s.liter_class, s.num_class from student s
                            where s.id_test_org = ".session('testOrg')." and s.liter_class is not null and s.num_class is not null
                            group by s.liter_class, s.num_class");
        if($qClasses == null){
            return redirect('/period');
        }else{
            foreach($qClasses as $classes){
                $class[$classes->num_class.'|'.$classes->liter_class]=$classes->num_class.$classes->liter_class;
            }

        }

        return view('period/createPeriod', ['classes'=>$class]);
    }


    public function store(PeriodRequest $request){
        $allId = $request->input('num');
        $test_peiod = $request->input('identifier');
        $test_lang = $request->input('lang');
		$unique = DB::table('student_test')
		->where('id_user', session('user'))
		->where('test_period', $test_peiod)
		->select(DB::raw('count(*) as cnt'))->first();
		if($unique->cnt > 0){
		     return redirect('/period/create')
                        ->withErrors('Данное название потока уже существует')
                        ->withInput();
		}
        $count_try = DB::table('user_restrict')->select('count_try')->where('id_user', session('user'))->first();

        $try = DB::table('student_test')->select(DB::raw('count(*) as cnt, id_user'))
            ->where('id_user', session('user'))
            ->groupBy('id_user')
            ->first();
        $cnt_aT = $count_try->count_try;
        if($try == null){
            $cnt_xT = 0;
        }else{
            $cnt_xT = $try->cnt;
        }
		
        $isTry = $cnt_aT - $cnt_xT;
	
        if(strlen($allId) == 1){
            if($isTry > 1) {
                $pass = str_random(5);
                $studentTest = new StudentTest();
                $studentTest->id_student = $allId;
                $studentTest->test_pass = $pass;
                $studentTest->test_id_lang = $test_lang;
                $studentTest->id_user = session('user');
                $studentTest->test_period = $test_peiod;
                $studentTest->save();
            }else{
                    return redirect('/period/create')
                        ->withErrors('Недостаточно попыток тестирования')
                        ->withInput();
            }
        }else{
            $arrId = explode("|", $allId);
            if($isTry >= count($arrId)) {
                for ($i = 0; $i < count($arrId); $i++) {
                    $pass = str_random(5);
                    $studentTest = new StudentTest();
                    $studentTest->id_student = $arrId[$i];
                    $studentTest->test_pass = $pass;
                    $studentTest->test_id_lang = $test_lang;
                    $studentTest->id_user = session('user');
                    $studentTest->test_period = $test_peiod;
                    $studentTest->save();
                }
            }else{
                return redirect('/period/create')
                    ->withErrors('недостаточно попыток тестирования')
                    ->withInput();
            }
        }
        //$pass = str_random(5);
        return redirect('/period');
    }


    public function destroy($id)
    {
        StudentTest::where('id', $id)->delete();
        return redirect()->back();
    }

}

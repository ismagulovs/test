<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudRequest;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClassController extends Controller
{
    public function index(){
        $classes = DB::select("select s.num_class, s.liter_class, count(*),
          
        sum(case when st.start_test_period = 0 or st.start_test_period is null then 0 else 1 end) AS start_test_period,
        sum(case when st.end_test_period = 0  or st.end_test_period is null then 0 else 1 end) AS end_test_period,
        sum(case when st.active_test_period = 0 or st.active_test_period is null then 0 else 1 end) AS active_test_period
        from student s
            left join (select id_student,   
                    sum(case when id_test_status = 3 and test_period is not null and id_user = ".session('user')." then 1 else 0 end) as end_test_period,
                    sum(case when id_test_status = 0 and test_period is not null and id_user = ".session('user')." then 1 else 0 end) as active_test_period,
                    sum(case when id_test_status = 1 and test_period is not null and id_user = ".session('user')." then 1 else 0 end) as start_test_period
                    from student_test
					where id_user = ".session('user')."
                    group by id_student) st on st.id_student = s.id
        where s.id_test_org = ".session('testOrg')."
        group by s.num_class, s.liter_class
        order by 1");
        return view('class/classesList', ['classes'=>$classes]);
    }

    public function show($class)
    {
        $arrClass = explode("-", $class);
        $num = $arrClass[0];
        $liter = $arrClass[1];

        $students = DB::select("select s.id, s.iin, s.lastname, s.firstname, s.patronymic, s.email,
                            
                    sum(case when id_test_status = 3 and test_period is not null and id_user = ".session('user')." then 1 else 0 end) as end_test_period,
                    sum(case when id_test_status = 0 and test_period is not null and id_user = ".session('user')." then 1 else 0 end) as active_test_period,
                    sum(case when id_test_status = 1 and test_period is not null and id_user = ".session('user')." then 1 else 0 end) as start_test_period
                    from student s
                        left join student_test st on s.id = id_student
                    where s.num_class = $num and s.liter_class = '$liter' and s.id_test_org = ".session('testOrg')." 
                    group by s.id, s.iin, s.lastname, s.firstname, s.patronymic, s.email ");
        //dd($students);
        return view('class/classShow', ['students'=>$students, 'num'=>$num, 'liter' => $liter]);
    }

    public function create(){
        $n = [8 => 8,9 => 9,10 => 10,11 => 11];
        $l = ['а' => 'а','ә' => 'ә','б' => 'б','в' => 'в','г' => 'г','ғ' => 'ғ','д' => 'д',
            'е' => 'е','ё' => 'ё','ж' => 'ж','з' => 'з','и' => 'и','к' => 'к','қ' => 'қ',
            'л' => 'л','м' => 'м','н' => 'н','ң' => 'ң','о' => 'о','ө' => 'ө','п' => 'п',
            'р' => 'р','с' => 'с','т' => 'т','у' => 'у','ұ' => 'ұ','ү' => 'ү','ф' => 'ф',
            'х' => 'х','һ' => 'һ','ц' => 'ц','ч' => 'ч','ш' => 'ш','щ' => 'щ','ы' => 'ы',
            'і' => 'і','э' => 'э','ю' => 'ю','я' => 'я'];
        $class = ['num'=>$n, 'liter'=>$l];

        return view('class/createClass', ['class'=>$class]);

    }

    public function class_flash(Request $request){

        $this->validate($request, [
            'num' => 'required',
            'liter' => 'required',]
        );

        $num = $request->input('num');
        $liter = $request->input('liter');

        return redirect('/classes/'.$num.'-'.$liter.'/add');
    }

    public function addClass(StudRequest $request){


        while(!isset($isIIN)){
            $temp = session('testOrg');
            for ($i = 0; $i < 8; $i++) {
                $temp .= rand(0, 9);
            }
            $res_tmp = DB::table('student')->where('iin', '=', $temp)->get();
            if($res_tmp == null){
                $isIIN = $temp;
            }
        }


        $student = new Student();
        $student->lastname = $request->input('last_name');
        $student->firstname = $request->input('first_name');
        $student->patronymic = $request->input('patronymic');
       // $student->email = $request->input('email');
       // $student->iin = $request->input('iin');
        $student->iin = $isIIN;
        $student->num_class = $request->input('num');
        $student->liter_class = $request->input('liter');
        $student->id_test_org = session('testOrg');
        $student->save();
        $num = $request->input('num');
        $liter = $request->input('liter');

//        $students = DB::table('student')
//            ->where(['num_class' => $liter, 'liter_class'=>$num, 'id_test_org'=>session('testOrg')]);

        return redirect('/classes/'.$num.'-'.$liter.'/add');
    }

    public function ShowAddClassStudent($class){
        $arrClass = explode("-", $class);
        $num = $arrClass[0];
        $liter = $arrClass[1];
        $l = ['а' => 'а','ә' => 'ә','б' => 'б','в' => 'в','г' => 'г','ғ' => 'ғ','д' => 'д',
            'е' => 'е','ё' => 'ё','ж' => 'ж','з' => 'з','и' => 'и','к' => 'к','қ' => 'қ',
            'л' => 'л','м' => 'м','н' => 'н','ң' => 'ң','о' => 'о','ө' => 'ө','п' => 'п',
            'р' => 'р','с' => 'с','т' => 'т','у' => 'у','ұ' => 'ұ','ү' => 'ү','ф' => 'ф',
            'х' => 'х','һ' => 'һ','ц' => 'ц','ч' => 'ч','ш' => 'ш','щ' => 'щ','ы' => 'ы',
            'і' => 'і','э' => 'э','ю' => 'ю','я' => 'я'];
        if(in_array($liter, $l)){
            $students = DB::select("select *
                                 from student st
                                where st.num_class = $num and st.liter_class = '$liter' and st.id_test_org = ".session('testOrg'));

            return view('class/createStudentToClass', ['numClass' => $num, 'literClass' => $liter, 'students'=>$students]);
        }else{
            return redirect()->back();
        }


    }
}

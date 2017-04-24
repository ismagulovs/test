<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudRequest;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Item;

class StudController extends Controller
{
    public function index(){
        $students = DB::select("select s.id, s.iin, s.lastname, s.firstname, s.patronymic, s.num_class, s.liter_class,
                                sum(CASE WHEN st.id_test_status = 3 and st.id_user =".session('user')." THEN 1 ELSE 0 END) AS end_test,
                                sum(CASE WHEN st.id_test_status = 0 and st.id_user =".session('user')." THEN 1 ELSE 0 END) AS active_test,
                                sum(CASE WHEN st.id_test_status = 1 and st.id_user =".session('user')." THEN 1 ELSE 0 END) AS start_test
                                 from student s
                                    left join student_test st on st.id_student = s.id and st.test_period is not null
                                where s.id_test_org = ".session('testOrg')." 
                                group by s.id, s.iin, s.lastname, s.firstname, s.patronymic, s.email");
        return view('student/studentList', ['students'=>$students]);
    }

    public function show($idStudent)
    {
        $studentTests = DB::select("select s.lastname, s.firstname, s.patronymic, s.iin, s.num_class, s.liter_class,
                                   st.id as id_test, st.id_test_status, st.test_start_date_time, st.test_finish_date_time,
                                    st.test_pass, st.test_period, st.last_ping_date_time
                                     from student s
                                        left join student_test st on st.id_student = s.id and st.test_period is not null
                                    where s.id = $idStudent and s.id_test_org = ".session('testOrg')."
                                    and st.id_user =".session('user'));
        return view('student/studentShow', ['studentTests'=>$studentTests]);
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
        return view('student/createStudent', ['class'=>$class]);
    }

    public function store(StudRequest $request){



            $temp = "";
            for ($i = 0; $i < 8; $i++) {
                $temp .= rand(0, 9);
            }
            $isIIN = DB::table('student')->where('iin', '=', $temp)->get();
         dd($isIIN);


        $student = new Student();
        $student->lastname = $request->input('last_name');
        $student->firstname = $request->input('first_name');
        $student->patronymic = $request->input('patronymic');
        $student->iin = $request->input('iin');
        $student->num_class = $request->input('num');
        $student->liter_class = $request->input('liter');
        $student->id_test_org = session('testOrg');
        $student->save();

        return redirect('/students');
    }

    public function destroy($id)
    {
        Student::where('id', $id)->delete();
        return redirect()->back();

    }


}

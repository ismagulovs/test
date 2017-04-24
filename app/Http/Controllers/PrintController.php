<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\DB;

class PrintController extends Controller
{


    public function pr2($id){
        $ved_sub1 = DB::select("select * from fn_card($id) where ord = 1");
        $ved_sub2 = DB::select("select * from fn_card($id) where ord = 2");

        $stud = DB::table('student_test')
            ->Join('student',  'student.id', '=', 'student_test.id_student')
            ->Join('test_org', 'test_org.id', '=', 'student.id_test_org')
            ->select('student.lastname', 'student.firstname', 'student.patronymic', 'student.num_class',
            'student.liter_class', 'test_org.name_rus', 'test_org.name_kaz')
            ->where('student_test.id', $id)
            ->where('student_test.id_user', session('user'))
            ->first();


        foreach($ved_sub1 as $key => $item){
            $sub1=$item->subject_name_rus;
            $answers_arr_sub1[$item->num_quest]=$item->ans_chars;
            $ball_arr_sub1[$item->num_quest]=$item->question_ball;
        }
        foreach($ved_sub2 as $key => $item){
            $sub2=$item->subject_name_rus;
            $answers_arr_sub2[$item->num_quest]=$item->ans_chars;
            $ball_arr_sub2[$item->num_quest]=$item->question_ball;
        }


        $pdf = PDF::loadView('print/pr2', array('sub1' => $sub1, 'sub2' => $sub2,  'stud' => $stud,
            'answers_arr_sub2'=>$answers_arr_sub2, 'answers_arr_sub1'=>$answers_arr_sub1,
            'ball_arr_sub1'=>$ball_arr_sub1, 'ball_arr_sub2'=>$ball_arr_sub2))->setPaper('a4', 'landscape');
        return $pdf->download('КА_'.$id.'.pdf');

    }


    public function pr3($test_period)
    {
        $class = DB::table('student_test')
            ->leftJoin('student', 'student.id', '=', 'student_test.id_student')
            ->leftJoin('test_org', 'test_org.id', '=', 'student.id_test_org')
            ->leftJoin('spr_obl', 'spr_obl.id', '=', 'test_org.id_obl')
            ->leftJoin('spr_raion', function ($join) {
                $join->on('spr_raion.id_raion', '=', 'test_org.id_raion')->on('spr_raion.id_obl', '=', 'test_org.id_obl');
            })
            ->select('student.num_class', 'student.liter_class', 'test_org.name_rus', 'spr_obl.name_rus as obl', 'spr_raion.name_rus as raion')
            ->groupBy('student.num_class', 'student.liter_class', 'test_org.name_rus', 'spr_obl.name_rus', 'spr_raion.name_rus')
            ->where('student_test.test_period', $test_period)
            ->where('student_test.id_user', session('user'))
            ->first();

        $student_tests = DB::select("select st.id, s.lastname, s.firstname, s.patronymic,
                                         sts1.ball as ball1, sts1.name_rus as name_rus1,
                                         sts2.ball as ball2, sts2.name_rus as name_rus2
                                         from student_test st
                                            left join student s on s.id = st.id_student
                                            left join (select sb.id_student_test, sb.ord, sj.name_kaz, sj.name_rus, sb.ball
                                                        from student_test_subject sb
                                                            inner join spr_subject sj on sj.id = sb.id_subject
                                                        where sb.is_enabled = 1 and sb.ord = 1) sts1 on sts1.id_student_test = st.id

                                            left join (select sb.id_student_test, sb.ord, sj.name_kaz, sj.name_rus, sb.ball
                                                        from student_test_subject sb
                                                            inner join spr_subject sj on sj.id = sb.id_subject
                                                        where sb.is_enabled = 1 and sb.ord = 2) sts2 on sts2.id_student_test = st.id
                                         where st.test_period = '$test_period' and st.id_user = ".session('user'));

        $date = date("d.m.Y");
        $pdf = PDF::loadView('print/pr3', array('studentTests' => $student_tests, 'x' => $class, 'date'=>$date))->setPaper('a4', 'landscape');
        return $pdf->download('ved_'.$test_period.'.pdf');
    }

    public function pr1($test_period)
    {
        $student_tests = DB::select("select st.test_pass, s.iin, s.lastname, s.firstname, s.patronymic, s.num_class,
                                      s.liter_class,
                                        case when st.test_id_lang = 1 then 'казахский' else 'русский' end as lang
                                        from student_test st
                                            inner join student s on s.id = st.id_student
                                        where st.test_period = '$test_period' and st.id_user = ".session('user'));
       // dd($test_period);
        $pdf = PDF::loadView('print/pr1', array('studentTests' => $student_tests , 'title' => $test_period))->setPaper('a4', 'landscape');
        return $pdf->download('passwd_'.$test_period.'.pdf');
    }

}

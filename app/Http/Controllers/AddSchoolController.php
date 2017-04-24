<?php

namespace App\Http\Controllers;

use App\Http\Requests\SchoolRequest;
use App\Models\TestOrg;

class AddSchoolController extends Controller
{
    public function add(SchoolRequest $request){
        $name_rus = $request->input('name_rus');
        $name_kaz = $request->input('name_kaz');
        $id_obl = $request->input('obl');
        $id_raion = $request->input('raion');
        $raion = explode('|',$id_raion);
        $id_raion = $raion[1];
        $testOrg = new TestOrg();
        $testOrg->name_kaz = $name_kaz;
        $testOrg->name_rus = $name_rus;
        $testOrg->id_obl = $id_obl;
        $testOrg->id_raion = $id_raion;
        $testOrg->save();
        return redirect()->back()->with('status', 'ok');
    }
}

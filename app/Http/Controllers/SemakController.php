<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BorangLesen;
use App\Models\BorangLesenTumbuhan;

class SemakController extends Controller
{
    public function index(){
        return view('status_permohonan');
    }

    public function postGetInfo(){
        //dd(request()->all());

        //Find latest permohonan
        $ic_number = request('p_data');
        $lesen_memburu = BorangLesen::where('no_kp',$ic_number)->where('tarikh_permohonan','<>',null)
        ->orderBy('tarikh_permohonan','desc')->first();
        $lesen_tumbuhan = BorangLesenTumbuhan::where('no_kp',$ic_number)->where('tarikh_permohonan','<>',null)
        ->orderBy('tarikh_permohonan','desc')->first();

        return response()->json(array('lesen_memburu'=>$lesen_memburu,'lesen_tumbuhan'=>$lesen_tumbuhan));
    }
}

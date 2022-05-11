<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\PejabatPembayaran;

class GeneralController extends Controller
{
    public function postUpdatePejabatPembayaran(Request $request){
         //dd($request->all());
         $pejabat_pembayaran_id = $request->pejabat_pembayaran_id;
         $input_value = $request->input_value;

         if ($pejabat_pembayaran_id) {
             //Edit existing
             DB::table('pejabat_pembayaran')
                 ->where('id', $pejabat_pembayaran_id)
                 ->update(array('pejabat' => $input_value));
         } else {
             //New data
             DB::table('pejabat_pembayaran')->insert(
                 array('pejabat' => $input_value)
             );
         }

         $result = PejabatPembayaran::orderBy('pejabat', 'ASC')->get();

         return response()->json($result);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\ResitAm;
use Illuminate\Support\Facades\Auth;
use DB;
use Carbon\Carbon;
use App\Models\FailPermitPeniaga;
use App\Models\BorangPermitPeniagaDaging;
use App\Models\BorangPermitPeniagaHaiwan;
use App\Models\BorangPermitPeniagaTumbuhan;
use App\Models\JenisPerniagaanHaiwan;
use App\Models\JenisPerniagaanDaging;
use App\Models\PejabatPembayaran;
use App\GeneralClass\PermitLicenseNumber;

class PermitPeniagaController extends Controller
{
    public function index(){
        $pejabat = PejabatPembayaran::orderBy('pejabat','ASC')->get();
        return view('peniaga.index', compact('pejabat'));
    }

    public function loadBorangPeniaga(){
        //dd(request()->all());
        $pejabat = PejabatPembayaran::orderBy('pejabat','ASC')->get();
        switch (request()->type) {
            case 'Permit Peniaga Haiwan':
                $borang = collect($this->BorangView("borang_permit_peniaga_haiwan"));
                break;
            case 'Permit Peniaga Daging':
                $borang = collect($this->BorangView("borang_permit_peniaga_daging"));
                break;
            case 'Permit Peniaga Tumbuhan':
                $borang = collect($this->BorangView("borang_permit_peniaga_tumbuhan"));
                break;
            default:
                $borang = collect($this->BorangView("borang_permit_peniaga_haiwan"));
                break;
        }

        //dd($borang);

        if(Auth::user()->role == 'client'){
            $result = $borang->where('created_by','=',Auth::user()->id);
        }else{
            $result = $borang->where('id', '>', 0);
        }

        return response()->json(array('result' => $result));
    }

    private function BorangView($tableName){
        $result = DB::select(DB::raw("SELECT
            $tableName.*,
            resit_am.no_resit,
            resit_am.tarikh_resit,
            resit_am.jumlah_rm,
            resit_am.pejabat_pembayaran_id,
            resit_am.no_lesen,
            resit_am.permit_type_id,
            resit_am.permit_id,
            status_borang.`status` AS status_borang,
            disahkan.`name` AS disahkan_oleh_nama,
            ditolak.`name` AS ditolak_oleh_nama,
            diluluskan.`name` AS diluluskan_oleh_nama,
            dikembalikan.`name` AS dikembalikan_oleh_nama
            FROM
            $tableName
            LEFT JOIN resit_am ON $tableName.resit_am_id = resit_am.id
            LEFT JOIN users AS disahkan ON $tableName.disahkan_oleh = disahkan.id
            LEFT JOIN users AS ditolak ON $tableName.ditolak_oleh = ditolak.id
            LEFT JOIN users AS diluluskan ON $tableName.diluluskan_oleh = diluluskan.id
            LEFT JOIN users AS dikembalikan ON $tableName.dikembalikan_oleh = dikembalikan.id
            LEFT JOIN status_borang ON $tableName.status_borang_id = status_borang.id"));
        return $result;
    }

    public function new($type){
        switch ($type) {
            case 'haiwan':
                $jenis_perniagaan = JenisPerniagaanHaiwan::all();
                return view('peniaga.new_haiwan', compact('jenis_perniagaan'));
                break;
            case 'daging':
                $jenis_perniagaan = JenisPerniagaanDaging::all();
                return view('peniaga.new_daging', compact('jenis_perniagaan'));
            case 'tumbuhan':
                return view('peniaga.new_tumbuhan');
            default:
                return view('peniaga.index');
                break;
        }
    }

    public function postSubmitPeniagaHaiwan(){
        //dd(request()->all());

        $tarikh_akhir = (request('tarikh_akhir_serah_simpan')) ? Carbon::createFromFormat('d/m/Y', request('tarikh_akhir_serah_simpan'))->format('Y-m-d') : null;

        //Insert new data
        $borang_id = DB::table('borang_permit_peniaga_haiwan')->insertGetId(
            [
                'created_by'=>Auth::user()->id,
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
                'nama'=>request('nama'),
                'alamat'=>request('alamat'),
                'no_kp'=>request('no_kp'),
                'no_tel_hp'=>request('no_tel'),
                'alamat_premis'=>request('alamat_premis'),
                'jumlah_pekerja'=>request('jumlah_pekerja'),
                'jenis_perniagaan_haiwan_id'=>request('jenis_perniagaan_id'),
                'jenis_haiwan_hasil'=>request('jenis_haiwan'),
                'butir_lesen_permit_terdahulu'=>request('butir_lesen_permit_terdahulu'),
                'tarikh_akhir_serah_simpan'=>$tarikh_akhir,
                'tarikh_permohonan'=>Carbon::now(),
                'status_borang_id'=>2,
        ]);

        //Save attachment. check if contain file
        if(request()->hasFile('salinan_penyata')){
            $file = request()->file('salinan_penyata');

            foreach($file as $f){
                $fileNameWithExt = $f->getClientOriginalName();
                $fileNameOnly = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                $extensionOnly = $f->getClientOriginalExtension();
                $fileNameToStore = $fileNameOnly.'_'.time().'.'.$extensionOnly;
                $fileSizeKB = round(($f->getSize())/1000,2);

                $path = $f->storeAs('public/failpermitpeniaga', $fileNameToStore);

                //Save file path to DB
                $rec = new FailPermitPeniaga;
                $rec->borang_id = $borang_id;
                $rec->type = "Permit Peniaga Haiwan";
                $rec->file_name = $path;
                $rec->file_size = $fileSizeKB;
                $rec->original_name = $fileNameOnly.'.'.$extensionOnly;
                $rec->created_at = Carbon::now();
                $rec->updated_at = Carbon::now();
                $rec->save();
            }
        }

        return response()->json(array('result'=>'success','borang_id'=>$borang_id));
    }

    public function postUpdatePeniagaHaiwan(){
        //dd(request()->all());

        $tarikh_akhir = (request('tarikh_akhir_serah_simpan')) ? Carbon::createFromFormat('d/m/Y', request('tarikh_akhir_serah_simpan'))->format('Y-m-d') : null;

        //Insert new data
        DB::table('borang_permit_peniaga_haiwan')->where('id',request('borangId'))->update(array(
            'created_by'=>Auth::user()->id,
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now(),
            'nama'=>request('nama'),
            'alamat'=>request('alamat'),
            'no_kp'=>request('no_kp'),
            'no_tel_hp'=>request('no_tel'),
            'alamat_premis'=>request('alamat_premis'),
            'jumlah_pekerja'=>request('jumlah_pekerja'),
            'jenis_perniagaan_haiwan_id'=>request('jenis_perniagaan_id'),
            'jenis_haiwan_hasil'=>request('jenis_haiwan'),
            'butir_lesen_permit_terdahulu'=>request('butir_lesen_permit_terdahulu'),
            'tarikh_akhir_serah_simpan'=>$tarikh_akhir,
            'tarikh_permohonan'=>Carbon::now(),
            'status_borang_id'=>2,
            'dikembalikan_oleh'=>null,
            'sebab_dikembalikan'=>null,
        ));

        //Save attachment. check if contain file
        if(request()->hasFile('salinan_penyata')){
            $file = request()->file('salinan_penyata');

            foreach($file as $f){
                $fileNameWithExt = $f->getClientOriginalName();
                $fileNameOnly = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                $extensionOnly = $f->getClientOriginalExtension();
                $fileNameToStore = $fileNameOnly.'_'.time().'.'.$extensionOnly;
                $fileSizeKB = round(($f->getSize())/1000,2);

                $path = $f->storeAs('public/failpermitpeniaga', $fileNameToStore);

                //Save file path to DB
                $rec = new FailPermitPeniaga;
                $rec->borang_id = $borang_id;
                $rec->type = "Permit Peniaga Haiwan";
                $rec->file_name = $path;
                $rec->file_size = $fileSizeKB;
                $rec->original_name = $fileNameOnly.'.'.$extensionOnly;
                $rec->created_at = Carbon::now();
                $rec->updated_at = Carbon::now();
                $rec->save();
            }
        }

        return response()->json(array('result'=>'success','borang_id'=>request('borangId')));
    }

    public function postSubmitPeniagaDaging(){
        // dd(request()->all());

        //Insert new data
        $borang_id = DB::table('borang_permit_peniaga_daging')->insertGetId(
            [
                'created_by'=>Auth::user()->id,
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
                'nama'=>request('nama'),
                'alamat'=>request('alamat'),
                'no_kp'=>request('no_kp'),
                'no_tel_hp'=>request('no_tel'),
                'alamat_premis'=>request('alamat_premis'),
                'jumlah_pekerja'=>request('jumlah_pekerja'),
                'jenis_perniagaan_daging_id'=>request('jenis_perniagaan_id'),
                'jenis_daging_didagang'=>request('jenis_daging_didagang'),
                'butir_lesen_permit_terdahulu'=>request('butir_lesen_permit_terdahulu'),
                'butir_lesen_permit_lain'=>request('butir_lesen_permit_lain'),
                'tarikh_permohonan'=>Carbon::now(),
                'status_borang_id'=>2,
        ]);

        return response()->json(array('result'=>'success','borang_id'=>$borang_id));
    }

    public function postUpdatePeniagaDaging(){
        // dd(request()->all());

        //Insert new data
        DB::table('borang_permit_peniaga_daging')->where('id',request('borangId'))->update(array(
                'created_by'=>Auth::user()->id,
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
                'nama'=>request('nama'),
                'alamat'=>request('alamat'),
                'no_kp'=>request('no_kp'),
                'no_tel_hp'=>request('no_tel'),
                'alamat_premis'=>request('alamat_premis'),
                'jumlah_pekerja'=>request('jumlah_pekerja'),
                'jenis_perniagaan_daging_id'=>request('jenis_perniagaan_id'),
                'jenis_daging_didagang'=>request('jenis_daging_didagang'),
                'butir_lesen_permit_terdahulu'=>request('butir_lesen_permit_terdahulu'),
                'butir_lesen_permit_lain'=>request('butir_lesen_permit_lain'),
                'tarikh_permohonan'=>Carbon::now(),
                'status_borang_id'=>2,
                'dikembalikan_oleh'=>null,
            'sebab_dikembalikan'=>null,
        ));

        return response()->json(array('result'=>'success','borang_id'=>request('borangId')));
    }

    public function postSubmitPeniagaTumbuhan(){
        //dd(request()->all());

        $tarikh_akhir = (request('tarikh_penyata_terakhir')) ? Carbon::createFromFormat('d/m/Y', request('tarikh_penyata_terakhir'))->format('Y-m-d') : null;

        //Insert new data
        $borang_id = DB::table('borang_permit_peniaga_tumbuhan')->insertGetId(
            [
                'created_by'=>Auth::user()->id,
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
                'nama'=>request('nama'),
                'alamat'=>request('alamat'),
                'no_kp'=>request('no_kp'),
                'no_tel_hp'=>request('no_tel'),
                'alamat_premis'=>request('alamat_premis'),
                'jumlah_pekerja'=>request('jumlah_pekerja'),
                'jenis_tumbuhan_diniaga'=>request('jenis_tumbuhan_diniaga'),
                'butir_lesen_permit_terdahulu'=>request('butir_lesen_permit_terdahulu'),
                'tarikh_penyata_terakhir'=>$tarikh_akhir,
                'tarikh_permohonan'=>Carbon::now(),
                'status_borang_id'=>2,
        ]);

        //Save attachment. check if contain file
        if(request()->hasFile('salinan_penyata')){
            $file = request()->file('salinan_penyata');

            foreach($file as $f){
                $fileNameWithExt = $f->getClientOriginalName();
                $fileNameOnly = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                $extensionOnly = $f->getClientOriginalExtension();
                $fileNameToStore = $fileNameOnly.'_'.time().'.'.$extensionOnly;
                $fileSizeKB = round(($f->getSize())/1000,2);

                $path = $f->storeAs('public/failpermitpeniaga', $fileNameToStore);

                //Save file path to DB
                $rec = new FailPermitPeniaga;
                $rec->borang_id = $borang_id;
                $rec->type = "Permit Peniaga Tumbuhan";
                $rec->file_name = $path;
                $rec->file_size = $fileSizeKB;
                $rec->original_name = $fileNameOnly.'.'.$extensionOnly;
                $rec->created_at = Carbon::now();
                $rec->updated_at = Carbon::now();
                $rec->save();
            }
        }

        return response()->json(array('result'=>'success','borang_id'=>$borang_id));
    }

    public function postUpdatePeniagaTumbuhan(){
        // dd(request()->all());

        $tarikh_akhir = (request('tarikh_penyata_terakhir')) ? Carbon::createFromFormat('d/m/Y', request('tarikh_penyata_terakhir'))->format('Y-m-d') : null;

        //Insert new data
        DB::table('borang_permit_peniaga_tumbuhan')->where('id',request('borangId'))->update(array(
                'created_by'=>Auth::user()->id,
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
                'nama'=>request('nama'),
                'alamat'=>request('alamat'),
                'no_kp'=>request('no_kp'),
                'no_tel_hp'=>request('no_tel'),
                'alamat_premis'=>request('alamat_premis'),
                'jumlah_pekerja'=>request('jumlah_pekerja'),
                'jenis_tumbuhan_diniaga'=>request('jenis_tumbuhan_diniaga'),
                'butir_lesen_permit_terdahulu'=>request('butir_lesen_permit_terdahulu'),
                'tarikh_penyata_terakhir'=>$tarikh_akhir,
                'tarikh_permohonan'=>Carbon::now(),
                'status_borang_id'=>2,
                'dikembalikan_oleh'=>null,
            'sebab_dikembalikan'=>null,
        ));

        //Save attachment. check if contain file
        if(request()->hasFile('salinan_penyata')){
            $file = request()->file('salinan_penyata');

            foreach($file as $f){
                $fileNameWithExt = $f->getClientOriginalName();
                $fileNameOnly = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                $extensionOnly = $f->getClientOriginalExtension();
                $fileNameToStore = $fileNameOnly.'_'.time().'.'.$extensionOnly;
                $fileSizeKB = round(($f->getSize())/1000,2);

                $path = $f->storeAs('public/failpermitpeniaga', $fileNameToStore);

                //Save file path to DB
                $rec = new FailPermitPeniaga;
                $rec->borang_id = $borang_id;
                $rec->type = "Permit Peniaga Tumbuhan";
                $rec->file_name = $path;
                $rec->file_size = $fileSizeKB;
                $rec->original_name = $fileNameOnly.'.'.$extensionOnly;
                $rec->created_at = Carbon::now();
                $rec->updated_at = Carbon::now();
                $rec->save();
            }
        }

        return response()->json(array('result'=>'success','borang_id'=>request('borang_id')));
    }

    public function postDeleteBorang(){
        // dd(request()->all());
        switch (request("type")) {
            case 'haiwan':
                //Delete borang only. Don't delete all attachment and files
                $rec = BorangPermitPeniagaHaiwan::find(request("borang_id"));
                $rec->delete();
                $borang = collect($this->BorangView("borang_permit_peniaga_haiwan"));
                break;
            case 'daging':
                $rec = BorangPermitPeniagaDaging::find(request("borang_id"));
                $rec->delete();
                $borang = collect($this->BorangView("borang_permit_peniaga_daging"));
                break;
            case 'tumbuhan':
                $rec = BorangPermitPeniagaTumbuhan::find(request("borang_id"));
                $rec->delete();
                $borang = collect($this->BorangView("borang_permit_peniaga_tumbuhan"));
                break;
            default:
                $borang = collect($this->BorangView("borang_permit_peniaga_haiwan"));
                break;
        }

        if(Auth::user()->role == 'client'){
            $result = $borang->where('created_by','=',Auth::user()->id);
        }else{
            $result = $borang->where('id', '>', 0);
        }

        return response()->json(array('result' => $result));
    }

    public function view($type, $id){
        // return "type:".$type." id:".$id;

        switch ($type) {
            case 'haiwan':
                $data = collect($this->BorangView("borang_permit_peniaga_haiwan"));
                $jenis_perniagaan = JenisPerniagaanHaiwan::all();
                $fileType = "Permit Peniaga Haiwan";
                $viewType = "view_haiwan";
                break;
            case 'daging':
                $data = collect($this->BorangView("borang_permit_peniaga_daging"));
                $jenis_perniagaan = JenisPerniagaanDaging::all();
                $fileType = "Permit Peniaga Daging";
                $viewType = "view_daging";
                break;
            case 'tumbuhan':
                $data = collect($this->BorangView("borang_permit_peniaga_tumbuhan"));
                $jenis_perniagaan = '';
                $fileType = "Permit Peniaga Tumbuhan";
                $viewType = "view_tumbuhan";
                break;
            default:
                break;
        }

        $borang = $data->where('id','=',$id)->first();
        if($type == 'haiwan'){
            $selected_jenis_perniagaan = DB::table('jenis_perniagaan_haiwan')->where('id',$borang->jenis_perniagaan_haiwan_id)->first();
        }elseif ($type == 'daging'){
            $selected_jenis_perniagaan = DB::table('jenis_perniagaan_daging')->where('id',$borang->jenis_perniagaan_daging_id)->first();
        }else{
            $selected_jenis_perniagaan = '';
        }

        $status_borang = DB::table("status_borang")->where('id',$borang->status_borang_id)->first();
        $fail_permit_perniagaan = FailPermitPeniaga::where('borang_id',$id)->where('type',$fileType)->get();
        return view('peniaga.'.$viewType, compact('borang','status_borang','fail_permit_perniagaan', 'jenis_perniagaan', 'selected_jenis_perniagaan'));
    }

    public function downloadPermitFile($type, $filename = '')
    {
        $file_path = storage_path() . "/app/public/failpermitpeniaga/" . $filename;
        $headers = array(
            'Content-Disposition: attachment; filename=' . $filename,
        );

        if (file_exists($file_path)) {
            return \Response::download($file_path, $filename, $headers);
        } else {
            exit('Requested file does not exist on our server!');
        }
    }

    //Fail attachment dalam borang permit
    public function deletePermitFile($type, $id){
        $rec = FailPermitPeniaga::find($id);
        $borangID = $rec->borang_id;
        $permit_url = "/permit/peniaga/view/".$type."/".$borangID;

        //delete from disk storage
        Storage::delete($rec->file_name);

        //delete from database
        $rec->delete();

        return redirect($permit_url);
    }

    public function postReturn(){
        // dd(request()->borang_id);
        $table = "";
        switch (request('borangType')) {
            case 'haiwan':
                $table = "borang_permit_peniaga_haiwan";
                $rec = BorangPermitPeniagaHaiwan::find(request('borang_id'));
                break;
            case 'daging':
                $table = "borang_permit_peniaga_daging";
                $rec = BorangPermitPeniagaDaging::find(request('borang_id'));
                break;
            case 'tumbuhan':
                $table = "borang_permit_peniaga_tumbuhan";
                $rec = BorangPermitPeniagaTumbuhan::find(request('borang_id'));
                break;
            default:
                break;
        }


        $rec->tarikh_dikembalikan = Carbon::now();
        $rec->dikembalikan_oleh = Auth::user()->id;
        $rec->sebab_dikembalikan = request('return_remark');
        $rec->status_borang_id = 3; //return status
        $rec->save();
        return response()->json("success");
    }

    public function postUpdateResitAm(){
        // dd(request()->all());

        $table = "borang_permit_peniaga_haiwan";
        switch (request('borangType')) {
            case 'haiwan':
                $permitTypeId = 4;
                $table = "borang_permit_peniaga_haiwan";
                $permitCategory = 1;
                break;
            case 'daging':
                $permitTypeId = 8;
                $table = "borang_permit_peniaga_daging";
                $permitCategory = 2;
                break;
            case 'tumbuhan':
                $permitTypeId = 9;
                $table = "borang_permit_peniaga_tumbuhan";
                $permitCategory = 3;
                break;
            default:
                break;
        }

        $permitNumber = "";
        if(request('no_permit')){
            $permitNumber = request('no_permit');
        }else{
            $kod = PejabatPembayaran::where('id','=',request('pejabat_pembayaran_id'))->first();
            $permitNumber = PermitLicenseNumber::GenerateLicenseNumber($kod->kod, "3", $permitCategory, "4", request('borang_id_resitam'));
        }

        $tarikh_resit = request('tarikh_resit');
        $tarikh_resit_formatted = (($tarikh_resit) ? Carbon::createFromFormat('d/m/Y',$tarikh_resit)->format('Y-m-d') : null);

        $tarikh_berkuatkuasa = null;
        $result = DB::table($table)->select('tarikh_berkuatkuasa','tarikh_diluluskan')->where('id',request('borang_id_resitam'))->first();
        if($result){
            if($result->tarikh_diluluskan){
                $tarikh_berkuatkuasa = $result->tarikh_diluluskan;
                $tarikh_tamat = date('Y-m-d', strtotime($result->tarikh_diluluskan. ' + '.request('tempoh_permit').' years'));

                DB::table($table)
                    ->where('id',request('borang_id_resitam'))
                    ->update(
                        [
                            'tarikh_berkuatkuasa'=>$tarikh_berkuatkuasa,
                            'tarikh_tamat_tempoh'=>$tarikh_tamat,
                            'tempoh_permit_lesen'=>request('tempoh_permit'),
                        ]
                    );
            }
        }



        if(request('resit_am_id')){//update
            $rec = ResitAm::find(request()->resit_am_id);
            $rec->no_resit = request('no_resit');
            $rec->tarikh_resit = $tarikh_resit_formatted;
            $rec->jumlah_rm = request('jumlah_rm');
            $rec->pejabat_pembayaran_id = request('pejabat_pembayaran_id');
            $rec->permit_type_id = $permitTypeId;
            $rec->permit_id = request('borang_id_resitam');
            $rec->no_lesen = $permitNumber;
            $rec->save();
        }else{//insert
            $rec = new ResitAm;
            $rec->no_resit = request('no_resit');
            $rec->tarikh_resit = $tarikh_resit_formatted;
            $rec->jumlah_rm = request('jumlah_rm');
            $rec->pejabat_pembayaran_id = request('pejabat_pembayaran_id');
            $rec->permit_type_id = $permitTypeId;
            $rec->permit_id = request('borang_id_resitam');
            $rec->no_lesen = $permitNumber;
            $rec->save();

            $resit_id = DB::getPdo()->lastInsertId();

            DB::table($table)
            ->where('id', request()->borang_id_resitam)
            ->update(array(
                'resit_am_id' => $resit_id,
            ));
        }

        $borang = collect($this->BorangView($table));
        if(Auth::user()->role == 'client'){
            $result = $borang->where('created_by','=',Auth::user()->id);
        }else{
            $result = $borang->where('id', '>', 0);
        }

        return response()->json(array('result' => $result));
    }

    public function postSahkanBorang(){
        //dd(request()->all());
        $table = "";
        switch (request('borangType')) {
            case 'haiwan':
                $table = "borang_permit_peniaga_haiwan";
                break;
            case 'daging':
                $table = "borang_permit_peniaga_daging";
                break;
            case 'tumbuhan':
                $table = "borang_permit_peniaga_tumbuhan";
                break;
            default:
                break;
        }

        if(request('borang_id')){
            DB::table($table)
            ->where('id', request()->borang_id)
            ->update(array(
                'status_borang_id' => 4,
                'disahkan_oleh' => Auth::user()->id,
                'tarikh_disahkan' => Carbon::now(),
            ));
            return response()->json(array('result' => 'success'));
        }else{
            return response()->json(array('result' => 'error'));
        }
    }

    public function postApprove(){
        //dd(request()->all());
        $table = "";
        switch (request('borangType')) {
            case 'haiwan':
                $table = "borang_permit_peniaga_haiwan";
                break;
            case 'daging':
                $table = "borang_permit_peniaga_daging";
                break;
            case 'tumbuhan':
                $table = "borang_permit_peniaga_tumbuhan";
                break;
            default:
                break;
        }

        if(request('borang_id')){
            DB::table($table)
            ->where('id', request()->borang_id)
            ->update(array(
                'status_borang_id' => 5,
                'diluluskan_oleh' => Auth::user()->id,
                'tarikh_diluluskan' => Carbon::now(),
                'tarikh_berkuatkuasa' => Carbon::now(),
                'ditolak_oleh' => null,
                'tarikh_ditolak' => null,
            ));
            return response()->json(array('result' => 'success'));
        }else{
            return response()->json(array('result' => 'error'));
        }
    }

    public function postReject(){
        //dd(request()->all());
        $table = "";
        switch (request('borangType')) {
            case 'haiwan':
                $table = "borang_permit_peniaga_haiwan";
                break;
            case 'daging':
                $table = "borang_permit_peniaga_daging";
                break;
            case 'tumbuhan':
                $table = "borang_permit_peniaga_tumbuhan";
                break;
            default:
                break;
        }

        if(request('borang_id')){
            DB::table($table)
            ->where('id', request()->borang_id)
            ->update(array(
                'status_borang_id' => 6,
                'diluluskan_oleh' => null,
                'tarikh_diluluskan' => null,
                'tarikh_berkuatkuasa' => null,
                'ditolak_oleh' => Auth::user()->id,
                'tarikh_ditolak' => Carbon::now(),
            ));
            return response()->json(array('result' => 'success'));
        }else{
            return response()->json(array('result' => 'error'));
        }
    }

    public function postRenewPermit(){
        // dd(request()->all());
        //Clear related fields
        switch (request('type')) {
            case 'haiwan':
                $table = 'borang_permit_peniaga_haiwan';
                break;
            case 'daging':
                $table = 'borang_permit_peniaga_daging';
                break;
            case 'tumbuhan':
                $table = 'borang_permit_peniaga_tumbuhan';
                break;
            default:
                $table = "";
                break;
        }

        if($table != ""){
            DB::table($table)
            ->where('id', request()->permit_id)
            ->update(array(
                'tarikh_berkuatkuasa' => null,
                'tarikh_tamat_tempoh' => null,
                'diluluskan_oleh' => null,
                'tarikh_diluluskan' =>null,
                'permit_file_id' => null,
                'resit_am_id' => null,
                'status_borang_id' => 8,
                'renewal' => 1,
            ));

            $borang = collect($this->BorangView($table));
            if(Auth::user()->role == 'client'){
                $result = $borang->where('created_by','=',Auth::user()->id);
            }else{
                $result = $borang->where('id', '>', 0);
            }

            return response()->json(array('result' => $result));
        }else{
            return "<h3>Unable to renew permit. An error occur!</h3>";
        }
    }
}

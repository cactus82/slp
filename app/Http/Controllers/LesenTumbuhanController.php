<?php

namespace App\Http\Controllers;

use App\Models\BorangLesenTumbuhan;
//use App\BorangTumbuhanView;
use App\Models\SpesiesDipohonTumbuhan;
use App\Models\KaedahUlasan;
use App\Models\KeputusanUjian;
use App\Models\ResitAm;
use App\Models\SenaraiKawasan;
use App\Models\PejabatPembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\DaerahMemburuMemungut;
use App\Models\PejabatPungutanLesen;
use App\GeneralClass\PermitLicenseNumber;

class LesenTumbuhanController extends Controller
{
    public function index(){
        /* if (Auth::user()->role == 'admin') {
            return view('tumbuhan.lesen');
        } elseif (Auth::user()->role == 'normal') {
            return view('tumbuhan.lesen');
        } elseif (Auth::user()->role == 'client') {
            return view('tumbuhan.lesen');
        } else {
            return view('auth.login');
        } */

        if(Auth::check()){
            $pejabat = PejabatPembayaran::orderBy('pejabat','ASC')->get();
            return view('tumbuhan.lesen',compact('pejabat'));
        }else{
            return view('auth.login');
        }
    }

    public function loadLesenDatatable(){
        $borang = collect($this->BorangTumbuhanView());
        if(Auth::user()->role == 'client'){
            $result = $borang->where('created_by','=',Auth::user()->id);
        }else{
            $result = $borang->where('id', '>', 0);
        }

        return response()->json(array('result' => $result));
    }

    private function BorangTumbuhanView(){
        $result = DB::select(DB::raw("SELECT
            `borang_lesen_tumbuhan`.`id` AS `id`,
            `borang_lesen_tumbuhan`.`jenis_lesen` AS `jenis_lesen`,
            `borang_lesen_tumbuhan`.`nama_pemohon` AS `nama_pemohon`,
            `borang_lesen_tumbuhan`.`no_kp` AS `no_kp`,
            `borang_lesen_tumbuhan`.`no_tel_rumah` AS `no_tel_rumah`,
            `borang_lesen_tumbuhan`.`no_tel_hp` AS `no_tel_hp`,
            `borang_lesen_tumbuhan`.`penduduk_sabah` AS `penduduk_sabah`,
            `borang_lesen_tumbuhan`.`alamat_kediaman` AS `alamat_kediaman`,
            `borang_lesen_tumbuhan`.`nama_penuh_pemungut` AS `nama_penuh_pemungut`,
            `borang_lesen_tumbuhan`.`no_kp_pemungut` AS `no_kp_pemungut`,
            `borang_lesen_tumbuhan`.`tarikh_permohonan` AS `tarikh_permohonan`,
            `borang_lesen_tumbuhan`.`status_borang_id` AS `status_borang_id`,
            `borang_lesen_tumbuhan`.`keputusan_ujian_id` AS `keputusan_ujian_id`,
            `borang_lesen_tumbuhan`.`ulasan_jhl` AS `ulasan_jhl`,
            `borang_lesen_tumbuhan`.`tarikh_ulasan_dipohon` AS `tarikh_ulasan_dipohon`,
            `borang_lesen_tumbuhan`.`tarikh_ulasan_diterima` AS `tarikh_ulasan_diterima`,
            `borang_lesen_tumbuhan`.`kaedah_ulasan_id` AS `kaedah_ulasan_id`,
            `borang_lesen_tumbuhan`.`komen` AS `komen`,
            `borang_lesen_tumbuhan`.`created_by` AS `created_by`,
            `borang_lesen_tumbuhan`.`created_at` AS `created_at`,
            `borang_lesen_tumbuhan`.`updated_at` AS `updated_at`,
            `status_borang`.`status` AS `status_borang`,
            `keputusan_ujian`.`keputusan` AS `keputusan_ujian`,
            `kaedah_mendapat_ulasan`.`kaedah` AS `kaedah_ulasan`,
            `borang_lesen_tumbuhan`.`disahkan_oleh` AS `disahkan_oleh_id`,
            `disahkan`.`name` AS `disahkan_oleh_nama`,
            `borang_lesen_tumbuhan`.`tarikh_disahkan` AS `tarikh_disahkan`,
            `borang_lesen_tumbuhan`.`diluluskan_oleh` AS `diluluskan_oleh_id`,
            `diluluskan`.`name` AS `diluluskan_oleh_nama`,
            `borang_lesen_tumbuhan`.`tarikh_diluluskan` AS `tarikh_diluluskan`,
            `borang_lesen_tumbuhan`.`ditolak_oleh` AS `ditolak_oleh_id`,
            `ditolak`.`name` AS `ditolak_oleh_nama`,
            `borang_lesen_tumbuhan`.`tarikh_ditolak` AS `tarikh_ditolak`,
            `borang_lesen_tumbuhan`.`dikembalikan_oleh` AS `dikembalikan_oleh_id`,
            `dikembalikan`.`name` AS `dikembalikan_oleh_nama`,
            `borang_lesen_tumbuhan`.`tarikh_dikembalikan` AS `tarikh_dikembalikan`,
            `borang_lesen_tumbuhan`.`resit_am_id` AS `resit_am_id`,
            `borang_lesen_tumbuhan`.`nombor_lesen`,
            `resit_am`.`no_resit` AS `no_resit`,
            `resit_am`.`no_lesen`,
            `resit_am`.`tarikh_resit` AS `tarikh_resit`,
            `resit_am`.`jumlah_rm` AS `jumlah_rm`,
            `resit_am`.`pejabat_pembayaran_id` AS `pejabat_pembayaran_id`,
            `daerah_memburu_memungut`.daerah AS `daerah_memungut`,
            `borang_lesen_tumbuhan`.`daerah_memungut_id`,
            `borang_lesen_tumbuhan`.`pejabat_lesen_id`,
            `pejabat_pungutan_lesen`.`nama_pejabat` AS `pejabat_lesen`,
            `borang_lesen_tumbuhan`.`sebab_dikembalikan`,
            `borang_lesen_tumbuhan`.`tempoh_permit_lesen`
        FROM
            `borang_lesen_tumbuhan`
            LEFT JOIN `status_borang` ON `borang_lesen_tumbuhan`.`status_borang_id` = `status_borang`.`id`
            LEFT JOIN `keputusan_ujian` ON `borang_lesen_tumbuhan`.`keputusan_ujian_id` = `keputusan_ujian`.`id`
            LEFT JOIN `kaedah_mendapat_ulasan` ON `borang_lesen_tumbuhan`.`kaedah_ulasan_id` = `kaedah_mendapat_ulasan`.`id`
            LEFT JOIN `users` `disahkan` ON `borang_lesen_tumbuhan`.`disahkan_oleh` = `disahkan`.`id`
            LEFT JOIN `users` `diluluskan` ON `borang_lesen_tumbuhan`.`diluluskan_oleh` = `diluluskan`.`id`
            LEFT JOIN `users` `ditolak` ON `borang_lesen_tumbuhan`.`ditolak_oleh` = `ditolak`.`id`
            LEFT JOIN `users` `dikembalikan` ON `borang_lesen_tumbuhan`.`dikembalikan_oleh` = `dikembalikan`.`id`
            LEFT JOIN `resit_am` ON `borang_lesen_tumbuhan`.`resit_am_id` = `resit_am`.`id`
            LEFT JOIN `daerah_memburu_memungut` ON `borang_lesen_tumbuhan`.`daerah_memungut_id` = `daerah_memburu_memungut`.id
            LEFT JOIN `pejabat_pungutan_lesen` ON `borang_lesen_tumbuhan`.`pejabat_lesen_id` = `pejabat_pungutan_lesen`.id;"));
        return $result;
    }

    public function lesenBaru(){
        $kaedah_ulasan = KaedahUlasan::all();
        $keputusan_ujian = KeputusanUjian::all();
        $daerah_memungut = DaerahMemburuMemungut::orderBy('daerah','ASC')->get();
        $pejabat_lesen = PejabatPungutanLesen::orderBy('nama_pejabat','ASC')->get();

        return view('tumbuhan.new_lesen',compact('kaedah_ulasan','keputusan_ujian','daerah_memungut','pejabat_lesen'));
    }

    //New Record
    public function postSaveSubmitNew(){
        //dd(request()->all());

        //Format date to sql insert format yyyy-mm-dd
        $tarikh_ulasan_dipohon = (request('tarikh_ulasan_dipohon')) ? Carbon::createFromFormat('d/m/Y', request('tarikh_ulasan_dipohon'))->format('Y-m-d') : null;
        $tarikh_ulasan_diterima = (request('tarikh_ulasan_diterima')) ? Carbon::createFromFormat('d/m/Y', request('tarikh_ulasan_diterima'))->format('Y-m-d') : null;


        $rec = new BorangLesenTumbuhan;
        $rec->jenis_lesen = request()->jenis_lesen;
        $rec->nama_pemohon = request()->nama_penuh;
        $rec->no_kp = request()->no_kp;
        $rec->no_tel_rumah = request()->no_tel_r;
        $rec->no_tel_hp = request()->no_tel_hp;
        $rec->penduduk_sabah = request()->penduduk_sabah;
        $rec->alamat_kediaman = request()->alamat_kediaman;
        $rec->nama_penuh_pemungut = request()->nama_pemungut;
        $rec->no_kp_pemungut = request()->no_kp_pemungut;

        //For admin and normal user
        $rec->keputusan_ujian_id = request('keputusan_ujian_id');
        $rec->ulasan_jhl = request('ulasan_jhl');
        $rec->tarikh_ulasan_dipohon = $tarikh_ulasan_dipohon;
        $rec->tarikh_ulasan_diterima = $tarikh_ulasan_diterima;
        //$rec->kaedah_ulasan_id = request('kaedah_ulasan_id');
        $rec->komen = request('komen');

        //If entered by admin or normal user, use 1 = Input Pegawai
        if(Auth::user()->role=='client'){
            $rec->status_borang_id = 2; //Permohonan baru
        }else{
            $rec->status_borang_id = 1;//Input pegawai
        }

        $rec->created_by = Auth::user()->id;

        $rec->daerah_memungut_id = request('daerah_memungut_id');
        $rec->pejabat_lesen_id = request('pejabat_lesen_id');

        $rec->tarikh_permohonan = Carbon::now();
        $rec->save();

        $borangID = DB::getPdo()->lastInsertId();

        return response()->json(array('result'=>'success','borang_id'=>$borangID));
    }

    //New Record - Draft
    public function postSaveDraftNew(){
        //dd(request()->all());

        //Format date to sql insert format yyyy-mm-dd
        $tarikh_ulasan_dipohon = (request('tarikh_ulasan_dipohon')) ? Carbon::createFromFormat('d/m/Y', request('tarikh_ulasan_dipohon'))->format('Y-m-d') : null;
        $tarikh_ulasan_diterima = (request('tarikh_ulasan_diterima')) ? Carbon::createFromFormat('d/m/Y', request('tarikh_ulasan_diterima'))->format('Y-m-d') : null;


        $rec = new BorangLesenTumbuhan;
        $rec->jenis_lesen = request()->jenis_lesen;
        $rec->nama_pemohon = request()->nama_penuh;
        $rec->no_kp = request()->no_kp;
        $rec->no_tel_rumah = request()->no_tel_r;
        $rec->no_tel_hp = request()->no_tel_hp;
        $rec->penduduk_sabah = request()->penduduk_sabah;
        $rec->alamat_kediaman = request()->alamat_kediaman;
        $rec->nama_penuh_pemungut = request()->nama_pemungut;
        $rec->no_kp_pemungut = request()->no_kp_pemungut;

        //For admin and normal user
        $rec->keputusan_ujian_id = request('keputusan_ujian_id');
        $rec->ulasan_jhl = request('ulasan_jhl');
        $rec->tarikh_ulasan_dipohon = $tarikh_ulasan_dipohon;
        $rec->tarikh_ulasan_diterima = $tarikh_ulasan_diterima;
        //$rec->kaedah_ulasan_id = request('kaedah_ulasan_id');
        $rec->komen = request('komen');
        $rec->status_borang_id = 7;

        $rec->daerah_memungut_id = request('daerah_memungut_id');
        $rec->pejabat_lesen_id = request('pejabat_lesen_id');

        $rec->created_by = Auth::user()->id;

        $rec->save();

        $borangID = DB::getPdo()->lastInsertId();

        return response()->json(array('result'=>'success','borang_id'=>$borangID));
    }

    //Edit Record
    public function postSaveSubmit(){
        //dd(request()->all());

        //Format date to sql insert format yyyy-mm-dd
        $tarikh_ulasan_dipohon = (request('tarikh_ulasan_dipohon')) ? Carbon::createFromFormat('d/m/Y', request('tarikh_ulasan_dipohon'))->format('Y-m-d') : null;
        $tarikh_ulasan_diterima = (request('tarikh_ulasan_diterima')) ? Carbon::createFromFormat('d/m/Y', request('tarikh_ulasan_diterima'))->format('Y-m-d') : null;


        if(request()->borang_id){
            DB::table('borang_lesen_tumbuhan')
            ->where('id', request()->borang_id)
            ->update(array(
                'jenis_lesen' => request()->jenis_lesen,
                'nama_pemohon' => request()->nama_penuh,
                'no_kp' => request()->no_kp,
                'no_tel_rumah' => request()->no_tel_r,
                'no_tel_hp' => request()->no_tel_hp,
                'penduduk_sabah' => request()->penduduk_sabah,
                'alamat_kediaman' => request()->alamat_kediaman,
                'nama_penuh_pemungut' => request()->nama_pemungut,
                'no_kp_pemungut' => request()->no_kp_pemungut,
                "keputusan_ujian_id" => request('keputusan_ujian_id'),
                "ulasan_jhl" => request('ulasan_jhl'),
                "tarikh_ulasan_dipohon" => $tarikh_ulasan_dipohon,
                "tarikh_ulasan_diterima" => $tarikh_ulasan_diterima,
                //"kaedah_ulasan_id" => request('kaedah_ulasan_id'),
                "komen" => request('komen'),
                "updated_at" => Carbon::now(),
                "tarikh_permohonan" => Carbon::now(),
                "daerah_memungut_id" => request('daerah_memungut_id'),
                "pejabat_lesen_id" => request('pejabat_lesen_id'),
            ));

            //=========================================
            //Update status borang based on role
            //=========================================
            $statusBorang = "";
            if(Auth::user()->role=='super admin'||Auth::user()->role=='admin'||Auth::user()->role=='normal'){
                $statusBorang = 1; //Input Pegawai
            }else if(Auth::user()->role=='client'){
                $statusBorang = 2; //Dalam Proses
            }

            DB::table('borang_lesen_tumbuhan')
            ->where('id', request()->borang_id)
            ->update(array(
                'status_borang_id' => $statusBorang,
                'dikembalikan_oleh' => null,
                'tarikh_dikembalikan' => null,
                'sebab_dikembalikan' => null,
            ));
        }
        return response()->json(array('result'=>'success'));
    }

    //Edit Record - Draft
    public function postSaveDraft(){
        //dd(request()->all());

        //Format date to sql insert format yyyy-mm-dd
        $tarikh_ulasan_dipohon = (request('tarikh_ulasan_dipohon')) ? Carbon::createFromFormat('d/m/Y', request('tarikh_ulasan_dipohon'))->format('Y-m-d') : null;
        $tarikh_ulasan_diterima = (request('tarikh_ulasan_diterima')) ? Carbon::createFromFormat('d/m/Y', request('tarikh_ulasan_diterima'))->format('Y-m-d') : null;


        if(request()->borang_id){
            DB::table('borang_lesen_tumbuhan')
            ->where('id', request()->borang_id)
            ->update(array(
                'jenis_lesen' => request()->jenis_lesen,
                'nama_pemohon' => request()->nama_penuh,
                'no_kp' => request()->no_kp,
                'no_tel_rumah' => request()->no_tel_r,
                'no_tel_hp' => request()->no_tel_hp,
                'penduduk_sabah' => request()->penduduk_sabah,
                'alamat_kediaman' => request()->alamat_kediaman,
                'nama_penuh_pemungut' => request()->nama_pemungut,
                'no_kp_pemungut' => request()->no_kp_pemungut,
                "keputusan_ujian_id" => request('keputusan_ujian_id'),
                "ulasan_jhl" => request('ulasan_jhl'),
                "tarikh_ulasan_dipohon" => $tarikh_ulasan_dipohon,
                "tarikh_ulasan_diterima" => $tarikh_ulasan_diterima,
                //"kaedah_ulasan_id" => request('kaedah_ulasan_id'),
                "komen" => request('komen'),
                "updated_at" => Carbon::now(),
                'status_borang_id' => 7,
                "daerah_memungut_id" => request('daerah_memungut_id'),
                "pejabat_lesen_id" => request('pejabat_lesen_id'),
            ));
        }
        return response()->json(array('result'=>'success'));
    }

    public function postSaveSpeciesDipohon(){
        //dd(request()->all());

        //Save spesies buruan (no 12)
        foreach(request('spc') as $item){
            if(is_null($item['id']) && $item['spesies']){//insert
                $rec = new SpesiesDipohonTumbuhan;
                $rec->borang_id = request('borang_id');
                $rec->spesies = $item['spesies'];
                $rec->bilangan = $item['bilangan'];
                $rec->kawasan = $item['kawasan'];
                $rec->save();
            }else if($item['spesies']){//update
                $rec = SpesiesDipohonTumbuhan::find($item['id']);
                $rec->spesies = $item['spesies'];
                $rec->bilangan = $item['bilangan'];
                $rec->kawasan = $item['kawasan'];
                $rec->save();
            }

        }

        $spesies_dipohon = DB::table("spesies_dipohon")->where('borang_id', request('borang_id'))->get();

        return response()->json(array('result'=>'success','spesies1'=>$spesies_dipohon));
    }

    public function viewEditLesen($id){
        $borangs = collect($this->BorangTumbuhanView());
        $borang = $borangs->where('id', $id)->first();
        $spesies_dipohon = DB::table("spesies_dipohon_tumbuhan")->where('borang_id', $id)->get();
        $kaedah_ulasan = KaedahUlasan::all();
        $keputusan_ujian = KeputusanUjian::all();
        $daerah_memungut = DaerahMemburuMemungut::orderBy('daerah','ASC')->get();
        $pejabat_lesen = PejabatPungutanLesen::orderBy('nama_pejabat','ASC')->get();
        $borang_id = $id;

        //dd($borang);

        return view('tumbuhan.view_lesen', compact('borang', 'spesies_dipohon', 'borang_id',
        'kaedah_ulasan', 'keputusan_ujian','daerah_memungut', 'pejabat_lesen'));
    }

    public function postDeleteLesen(){
        //dd(request()->all());

        //Delete all
        DB::table('borang_lesen_tumbuhan')->where('id', '=', request('borang_id'))->delete();
        DB::table('spesies_dipohon_tumbuhan')->where('borang_id', '=', request('borang_id'))->delete();

        $result = $this->BorangTumbuhanView();
        return response()->json(array('result' => $result));
    }

    public function postSahkan(){
        //dd(request()->all());
        if(request('borang_id')){
            DB::table('borang_lesen_tumbuhan')
            ->where('id', request()->borang_id)
            ->update(array(
                'status_borang_id' => 4,
                'disahkan_oleh' => Auth::user()->id,
                'tarikh_disahkan' => Carbon::now(),
                "keputusan_ujian_id" => request('keputusan_ujian_id'),
                "ulasan_jhl" => request('ulasan_jhl'),
                "tarikh_ulasan_dipohon" => Carbon::now(),
                //"kaedah_ulasan_id" => request('kaedah_ulasan_id'),
                "komen" => request('komen'),
            ));
            return response()->json(array('result' => 'success'));
        }else{
            return response()->json(array('result' => 'error'));
        }
    }

    public function postKembalikan(){
        //dd(request()->all());
        if(request('borang_id')){
            DB::table('borang_lesen_tumbuhan')
            ->where('id', request()->borang_id)
            ->update(array(
                'status_borang_id' => 3,
                'dikembalikan_oleh' => Auth::user()->id,
                'tarikh_dikembalikan' => Carbon::now(),
                'sebab_dikembalikan' => request('return_remark'),
            ));
            return response()->json(array('result' => 'success'));
        }else{
            return response()->json(array('result' => 'error'));
        }
    }

    public function postApprove(){
        //dd(request()->all());
        if(request('borang_id')){
            DB::table('borang_lesen_tumbuhan')
            ->where('id', request()->borang_id)
            ->update(array(
                'status_borang_id' => 5,
                'diluluskan_oleh' => Auth::user()->id,
                'tarikh_diluluskan' => Carbon::now(),
                'ditolak_oleh' => null,
                'tarikh_ditolak' => null,
                "keputusan_ujian_id" => request('keputusan_ujian_id'),
                "ulasan_jhl" => request('ulasan_jhl'),
                "tarikh_ulasan_diterima" => Carbon::now(),
                //"kaedah_ulasan_id" => request('kaedah_ulasan_id'),
                "komen" => request('komen'),
            ));
            return response()->json(array('result' => 'success'));
        }else{
            return response()->json(array('result' => 'error'));
        }
    }

    public function postReject(){
        //dd(request()->all());
        if(request('borang_id')){
            DB::table('borang_lesen_tumbuhan')
            ->where('id', request()->borang_id)
            ->update(array(
                'status_borang_id' => 6,
                'ditolak_oleh' => Auth::user()->id,
                'tarikh_ditolak' => Carbon::now(),
                'diluluskan_oleh' => null,
                'tarikh_diluluskan' => null,
            ));
            return response()->json(array('result' => 'success'));
        }else{
            return response()->json(array('result' => 'error'));
        }
    }

    public function postUpdateResitAm(){
        //dd(request()->all());
        $lesenNumber = "";
        if(request('no_lesen')){
            $lesenNumber = request('no_lesen');
        }else{
            $kod = PejabatPembayaran::where('id','=',request('pejabat_pembayaran_id'))->first();
            $lesenNumber = PermitLicenseNumber::GenerateLicenseNumber($kod->kod, "5", "1", "2", request('borang_id_resitam'));
        }

        $tarikh_resit = request('tarikh_resit');
        $tarikh_resit_formatted = (($tarikh_resit) ? Carbon::createFromFormat('d/m/Y',$tarikh_resit)->format('Y-m-d') : null);

        $tarikh_berkuatkuasa = null;
        $result = DB::table("borang_lesen_tumbuhan")->select('tarikh_berkuatkuasa','tarikh_diluluskan')->where('id',request('borang_id_resitam'))->first();
        if($result){
            if($result->tarikh_diluluskan){
                $tarikh_berkuatkuasa = $result->tarikh_diluluskan;
                $tarikh_tamat = date('Y-m-d', strtotime($result->tarikh_diluluskan. ' + '.request('tempoh_lesen').' years'));

                DB::table('borang_lesen_tumbuhan')
                    ->where('id',request('borang_id_resitam'))
                    ->update(
                        [
                            'tarikh_berkuatkuasa'=>$tarikh_berkuatkuasa,
                            'tarikh_tamat_tempoh'=>$tarikh_tamat,
                            'tempoh_permit_lesen'=>request('tempoh_lesen'),
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
            $rec->permit_type_id = 2;
            $rec->permit_id = request('borang_id_resitam');
            $rec->no_lesen = $lesenNumber;
            $rec->save();
        }else{//insert
            $rec = new ResitAm;
            $rec->no_resit = request('no_resit');
            $rec->tarikh_resit = $tarikh_resit_formatted;
            $rec->jumlah_rm = request('jumlah_rm');
            $rec->pejabat_pembayaran_id = request('pejabat_pembayaran_id');
            $rec->permit_type_id = 2;
            $rec->permit_id = request('borang_id_resitam');
            $rec->no_lesen = $lesenNumber;
            $rec->save();

            $resit_id = DB::getPdo()->lastInsertId();

            DB::table('borang_lesen_tumbuhan')
            ->where('id', request()->borang_id_resitam)
            ->update(array(
                'resit_am_id' => $resit_id,
            ));
        }

        $borang = collect($this->BorangTumbuhanView());
        if(Auth::user()->role == 'client'){
            $result = $borang->where('created_by','=',Auth::user()->id);
        }else{
            $result = $borang->where('id', '>', 0);
        }

        return response()->json(array('result' => $result));
    }

    public function postCheckKawasan(){
        $rec = SenaraiKawasan::where('nama_kawasan', 'like', '%' . request('nama_kawasan') . '%')->where('memungut_dibenarkan','=',0)->get();

        if($rec->count() > 0){
            $result="fail";
        }else{
            $result="success";
        }
        return response(array('result'=>$result));
    }

    public function postDeleteSpesies(){
        //dd(request()->all());
        $rec = SpesiesDipohonTumbuhan::find(request('delete_id'));
            $rec->delete();

        $spesies_dipohon = DB::table("spesies_dipohon_tumbuhan")->where('borang_id', request('borang_id'))->get();

        return response()->json(array('result'=>'success','spesies1'=>$spesies_dipohon));
    }

    public function postRenewPermit(){
        // dd(request()->all());
        //Clear related fields
        DB::table('borang_lesen_tumbuhan')
            ->where('id', request()->permit_id)
            ->update(array(
                'tarikh_berkuatkuasa' => null,
                'tarikh_tamat_tempoh' => null,
                'diluluskan_oleh' => null,
                'tarikh_diluluskan' =>null,
                // 'permit_file_id' => null,
                'resit_am_id' => null,
                'status_borang_id' => 8,
                'renewal' => 1,
            ));

        $borang = collect($this->BorangTumbuhanView());
        if(Auth::user()->role == 'client'){
            $result = $borang->where('created_by','=',Auth::user()->id);
        }else{
            $result = $borang->where('id', '>', 0);
        }

        return response()->json(array('result' => $result));
    }

}

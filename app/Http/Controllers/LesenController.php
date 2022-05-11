<?php

namespace App\Http\Controllers;

use App\Models\BorangLesen;
//use App\Models\BorangView;
use App\Models\SpesiesDipohon;
use App\Models\SpesiesKomersil;
use App\Models\SoalanEPHL;
use App\Models\KaedahUlasan;
use App\Models\KeputusanUjian;
use App\Models\ResitAm;
use App\Models\SenaraiKawasan;
use App\Models\PejabatPembayaran;
use App\Models\HidupanLiar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\DaerahMemburuMemungut;
use App\Models\PejabatPungutanLesen;
use App\Models\ButiranSenjataApi;
use App\GeneralClass\PermitLicenseNumber;

class LesenController extends Controller
{
    public function index(){
        if(Auth::check()){
            $pejabat = PejabatPembayaran::orderBy('pejabat','ASC')->get();
            return view('memburu.lesen',compact('pejabat'));
        }else{
            return view('auth.login');
        }
    }

    public function loadLesenDatatable(){
        $borang = collect($this->BorangView());
        if(Auth::user()->role == 'client'){
            $result = $borang->where('created_by','=',Auth::user()->id);
        }else{
            $result = $borang->where('id', '>', 0);
        }

        return response()->json(array('result' => $result));
    }

    private function BorangView(){
        $result = DB::select(DB::raw("SELECT
        `borang_lesen`.`id` AS `id`,
        `borang_lesen`.`jenis_lesen` AS `jenis_lesen`,
        `borang_lesen`.`kawasan_memburu` AS `kawasan_memburu`,
        `borang_lesen`.`tarikh_mula_memburu`,
        `borang_lesen`.`tarikh_tamat_memburu`,
        `borang_lesen`.`nama_pemohon` AS `nama_pemohon`,
        `borang_lesen`.`no_kp` AS `no_kp`,
        `borang_lesen`.`no_tel_rumah` AS `no_tel_rumah`,
        `borang_lesen`.`no_tel_hp` AS `no_tel_hp`,
        `borang_lesen`.`no_pendaftaran_kereta` AS `no_pendaftaran_kereta`,
        `borang_lesen`.`penduduk_sabah` AS `penduduk_sabah`,
        `borang_lesen`.`alamat_kediaman` AS `alamat_kediaman`,
        `borang_lesen`.`nama_teman_1` AS `nama_teman_1`,
        `borang_lesen`.`no_kp_teman_1` AS `no_kp_teman_1`,
        `borang_lesen`.`nama_teman_2` AS `nama_teman_2`,
        `borang_lesen`.`no_kp_teman_2` AS `no_kp_teman_2`,
        `borang_lesen`.`nama_teman_3` AS `nama_teman_3`,
        `borang_lesen`.`no_kp_teman_3` AS `no_kp_teman_3`,
        `borang_lesen`.`nama_teman_4` AS `nama_teman_4`,
        `borang_lesen`.`no_kp_teman_4` AS `no_kp_teman_4`,
        `borang_lesen`.`buatan_senjata_api` AS `buatan_senjata_api`,
        `borang_lesen`.`ukuran_garis_pusat` AS `ukuran_garis_pusat`,
        `borang_lesen`.`serial_senjata_api` AS `serial_senjata_api`,
        `borang_lesen`.`no_lesen_senjata_api` AS `no_lesen_senjata_api`,
        `borang_lesen`.`tarikh_pengeluaran_senjata_api` AS `tarikh_pengeluaran_senjata_api`,
        `borang_lesen`.`tempat_pengeluaran_senjata_api` AS `tempat_pengeluaran_senjata_api`,
        `borang_lesen`.`syarat_lesen_senjata_api` AS `syarat_lesen_senjata_api`,
        `borang_lesen`.`tarikh_permohonan` AS `tarikh_permohonan`,
        `borang_lesen`.`tarikh_diperiksa` AS `tarikh_diperiksa`,
        `borang_lesen`.`diperiksa_oleh_id` AS `diperiksa_oleh_id`,
        `borang_lesen`.`ulasan_pemeriksa` AS `ulasan_pemeriksa`,
        `borang_lesen`.`tarikh_disemak_kaw_memburu` AS `tarikh_disemak_kaw_memburu`,
        `borang_lesen`.`disemak_oleh_id` AS `disemak_oleh_id`,
        `borang_lesen`.`tarikh_ephl_dinilai` AS `tarikh_ephl_dinilai`,
        `borang_lesen`.`dinilai_oleh_id` AS `dinilai_oleh_id`,
        `borang_lesen`.`tarikh_bil_haiwan_tempoh_memburu` AS `tarikh_bil_haiwan_tempoh_memburu`,
        `borang_lesen`.`diperiksa_bil_haiwan_tempoh_id` AS `diperiksa_bil_haiwan_tempoh_id`,
        `borang_lesen`.`status_kelulusan` AS `status_kelulusan`,
        `borang_lesen`.`diluluskan_id` AS `diluluskan_id`,
        `borang_lesen`.`soalan_ephl_id` AS `soalan_ephl_id`,
        `borang_lesen`.`jawapan_soalan_ephl` AS `jawapan_soalan_ephl`,
        `borang_lesen`.`status_borang_id` AS `status_borang_id`,
        `borang_lesen`.`return_remark` AS `return_remark`,
        `borang_lesen`.`keputusan_ujian_id` AS `keputusan_ujian_id`,
        `borang_lesen`.`ulasan_jhl` AS `ulasan_jhl`,
        `borang_lesen`.`tarikh_ulasan_dipohon` AS `tarikh_ulasan_dipohon`,
        `borang_lesen`.`tarikh_ulasan_diterima` AS `tarikh_ulasan_diterima`,
        `borang_lesen`.`kaedah_ulasan_id` AS `kaedah_ulasan_id`,
        `borang_lesen`.`komen` AS `komen`,
        `borang_lesen`.`created_by` AS `created_by`,
        `borang_lesen`.`created_at` AS `created_at`,
        `borang_lesen`.`updated_at` AS `updated_at`,
        `soalan_ephl`.`soalan_ephl` AS `soalan_ephl`,
        `soalan_ephl`.`jawapan` AS `jawapan_ephl`,
        `borang_lesen`.`no_lesen_senjata_teman1` AS `no_lesen_senjata_teman1`,
        `borang_lesen`.`no_lesen_senjata_teman2` AS `no_lesen_senjata_teman2`,
        `borang_lesen`.`no_lesen_senjata_teman3` AS `no_lesen_senjata_teman3`,
        `borang_lesen`.`no_lesen_senjata_teman4` AS `no_lesen_senjata_teman4`,
        `status_borang`.`status` AS `status_borang`,
        `borang_lesen`.`diluluskan_oleh` AS `diluluskan_oleh_id`,
        `diluluskan`.`name` AS `diluluskan_oleh_nama`,
        `borang_lesen`.`tarikh_diluluskan` AS `tarikh_diluluskan`,
        `borang_lesen`.`ditolak_oleh` AS `ditolak_oleh_id`,
        `ditolak`.`name` AS `ditolak_oleh_nama`,
        `borang_lesen`.`tarikh_ditolak` AS `tarikh_ditolak`,
        `borang_lesen`.`dikembalikan_oleh` AS `dikembalikan_oleh_id`,
        `dikembalikan`.`name` AS `dikembalikan_oleh_nama`,
        `borang_lesen`.`tarikh_dikembalikan` AS `tarikh_dikembalikan`,
        `borang_lesen`.`sebab_dikembalikan`,
        `borang_lesen`.`disahkan_oleh` AS `disahkan_oleh_id`,
        `disahkan`.`name` AS `disahkan_oleh_nama`,
        `borang_lesen`.`tarikh_disahkan` AS `tarikh_disahkan`,
        `borang_lesen`.`resit_am_id` AS `resit_am_id`,
        `borang_lesen`.`nombor_lesen`,
        `resit_am`.`no_resit` AS `no_resit`,
        `resit_am`.`tarikh_resit` AS `tarikh_resit`,
        `resit_am`.`jumlah_rm` AS `jumlah_rm`,
        `resit_am`.`pejabat_pembayaran_id` AS `pejabat_pembayaran_id`,
        `resit_am`.`no_lesen` AS `nombor_lesen`,
        daerah_memburu_memungut.daerah AS `daerah_memungut`,
        borang_lesen.daerah_memburu_id,
        `borang_lesen`.pejabat_lesen_id,
        pejabat_pungutan_lesen.nama_pejabat AS `pejabat_lesen`,
        `borang_lesen`.kawasan_ditangkap,
        `borang_lesen`.tempoh_permit_lesen
    FROM
        `borang_lesen`
        LEFT JOIN `soalan_ephl` ON `borang_lesen`.`soalan_ephl_id` = `soalan_ephl`.`id`
        LEFT JOIN `status_borang` ON `borang_lesen`.`status_borang_id` = `status_borang`.`id`
        LEFT JOIN `users` `diluluskan` ON `borang_lesen`.`diluluskan_oleh` = `diluluskan`.`id`
        LEFT JOIN `users` `ditolak` ON `borang_lesen`.`ditolak_oleh` = `ditolak`.`id`
        LEFT JOIN `users` `dikembalikan` ON `borang_lesen`.`dikembalikan_oleh` = `dikembalikan`.`id`
        LEFT JOIN `users` `disahkan` ON `borang_lesen`.`disahkan_oleh` = `disahkan`.`id`
        LEFT JOIN `resit_am` ON `borang_lesen`.`resit_am_id` = `resit_am`.`id`
        LEFT JOIN `daerah_memburu_memungut` ON borang_lesen.daerah_memburu_id = daerah_memburu_memungut.id
        LEFT JOIN `pejabat_pungutan_lesen` ON borang_lesen.pejabat_lesen_id = pejabat_pungutan_lesen.id;"));

    return $result;
    }

    public function viewEditLesen($id){
        //$borang = DB::table("borang_view")->where('id', $id)->first();
        $borangs = collect($this->BorangView());
        $borang = $borangs->where('id', '=', $id)->first();

        $spesies_dipohon = DB::table("spesies_dipohon")->where('borang_id', $id)->get();
        $spesies_komersil = DB::table("spesies_komersil")->where('borang_id', $id)->get();
        $kaedah_ulasan = KaedahUlasan::all();
        $keputusan_ujian = KeputusanUjian::all();
        $soalan_ephl = SoalanEPHL::all();
        $hidupan_liar = HidupanLiar::orderBy('NAMA_TEMPATAN','ASC')->get();
        $daerah_memburu = DaerahMemburuMemungut::orderBy('daerah','ASC')->get();
        $pejabat_lesen = PejabatPungutanLesen::orderBy('nama_pejabat','ASC')->get();
        $borang_id = $id;

        //dd($borang);

        return view('memburu.view_lesen', compact('borang', 'spesies_dipohon', 'spesies_komersil', 'borang_id',
        'kaedah_ulasan', 'keputusan_ujian', 'soalan_ephl', 'hidupan_liar', 'daerah_memburu', 'pejabat_lesen'));
    }

    //Edit Record
    public function postSaveSubmit(){
        //dd(request()->all());

        //Tempoh sah memburu (extract)
        $tempoh_memburu = str_replace(' ','',request('tempoh_memburu'));
        $tempoh = explode("-",$tempoh_memburu);
        // $mula_memburu = str_replace("/","-",$tempoh[0]);
        // $tamat_memburu = str_replace("/","-",$tempoh[1]);
        $mula_memburu = Carbon::createFromFormat('d/m/Y', $tempoh[0])->format('Y-m-d');
        $tamat_memburu = Carbon::createFromFormat('d/m/Y', $tempoh[1])->format('Y-m-d');

        //Format date to sql insert format yyyy-mm-dd
        $tarikh_ulasan_dipohon = (request('tarikh_ulasan_dipohon')) ? Carbon::createFromFormat('d/m/Y', request('tarikh_ulasan_dipohon'))->format('Y-m-d') : null;
        $tarikh_ulasan_diterima = (request('tarikh_ulasan_diterima')) ? Carbon::createFromFormat('d/m/Y', request('tarikh_ulasan_diterima'))->format('Y-m-d') : null;
        $tarikh_pengeluaran = (request('tarikh_pengeluaran')) ? Carbon::createFromFormat('d/m/Y', request('tarikh_pengeluaran'))->format('Y-m-d') : null;

        if(request()->borang_id){
            DB::table('borang_lesen')
            ->where('id', request()->borang_id)
            ->update(array(
                'jenis_lesen' => request()->jenis_lesen,
                'kawasan_memburu' => request('kawasan_memburu'),
                'tarikh_mula_memburu' => $mula_memburu,
                'tarikh_tamat_memburu' => $tamat_memburu,
                'nama_pemohon' => request()->nama_penuh,
                'no_kp' => request()->no_kp,
                'no_tel_rumah' => request()->no_tel_r,
                'no_tel_hp' => request()->no_tel_hp,
                'no_pendaftaran_kereta' => request()->penduduk_sabah,
                'penduduk_sabah' => request()->penduduk_sabah,
                'alamat_kediaman' => request()->alamat_kediaman,
                'nama_teman_1' => request()->nama_teman_1,
                'no_kp_teman_1' => request()->no_kp_1,
                'no_lesen_senjata_teman1' => request('no_lesen_senjata_teman1'),
                'nama_teman_2' => request()->nama_teman_2,
                'no_kp_teman_2' => request()->no_kp_2,
                'no_lesen_senjata_teman2' => request('no_lesen_senjata_teman2'),
                'nama_teman_3' => request()->nama_teman_3,
                'no_kp_teman_3' => request()->no_kp_3,
                'no_lesen_senjata_teman3' => request('no_lesen_senjata_teman3'),
                'nama_teman_4' => request()->nama_teman_4,
                'no_kp_teman_4' => request()->no_kp_4,
                'no_lesen_senjata_teman4' => request('no_lesen_senjata_teman4'),
                'buatan_senjata_api' => request()->buatan,
                'ukuran_garis_pusat' => request()->ukuran_garis_pusat,
                'serial_senjata_api' => request()->serial,
                'no_lesen_senjata_api' => request()->no_lesen_senjata,
                'tarikh_pengeluaran_senjata_api' => $tarikh_pengeluaran,
                'tempat_pengeluaran_senjata_api' => request()->tempat_pengeluaran,
                'syarat_lesen_senjata_api' => request()->syarat_lesen_senjata,
                'soalan_ephl_id' => request('soalan_ephl_id'),
                'jawapan_soalan_ephl' => request('jawapan_ephl'),
                "keputusan_ujian_id" => request('keputusan_ujian_id'),
                "ulasan_jhl" => request('ulasan_jhl'),
                "tarikh_ulasan_dipohon" => $tarikh_ulasan_dipohon,
                "tarikh_ulasan_diterima" => $tarikh_ulasan_diterima,
                //"kaedah_ulasan_id" => request('kaedah_ulasan_id'),
                "komen" => request('komen'),
                "tarikh_permohonan" => Carbon::now(),
                "daerah_memburu_id" => request('daerah_memburu_id'),
                "pejabat_lesen_id" => request('pejabat_lesen_id'),
                "kawasan_ditangkap" => request('kawasan_ditangkap'),
                //'status_borang_id' => 2,
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

            //===========================================
            //Insert or Update Butiran Senjata Api table
            //===========================================
            if(Auth::user()->role == 'client'){
                //1. Get User ID for applicant first
                $user_id = DB::table('users')->select('id')->where('ic_number',request('no_kp'))->first();

                //2. Insert or Update butiran senjata api table
                DB::table('butiran_senjata_api')
                ->updateOrInsert(
                    ['user_id' => $user_id->id],
                    ['user_id' => $user_id->id,
                    'no_lesen_senjata_api' => request()->no_lesen_senjata, 'tarikh_pengeluaran' => $tarikh_pengeluaran,
                    'tempat_pengeluaran' => request()->tempat_pengeluaran, 'buatan' => request()->buatan,
                    'ukuran_garis_pusat' => request()->ukuran_garis_pusat, 'no_serial' => request()->serial
                    ]
                );
            }

            DB::table('borang_lesen')
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

    //Edit Record - save as draft
    public function postSaveDraft(){
        //dd(request()->all());

        //Tempoh sah memburu (extract)
        $tempoh_memburu = str_replace(' ','',request('tempoh_memburu'));
        $tempoh = explode("-",$tempoh_memburu);
        // $mula_memburu = str_replace("/","-",$tempoh[0]);
        // $tamat_memburu = str_replace("/","-",$tempoh[1]);

        $mula_memburu = Carbon::createFromFormat('d/m/Y', $tempoh[0])->format('Y-m-d');
        $tamat_memburu = Carbon::createFromFormat('d/m/Y', $tempoh[1])->format('Y-m-d');

        //Format date to sql insert format yyyy-mm-dd
        $tarikh_ulasan_dipohon = (request('tarikh_ulasan_dipohon')) ? Carbon::createFromFormat('d/m/Y', request('tarikh_ulasan_dipohon'))->format('Y-m-d') : null;
        $tarikh_ulasan_diterima = (request('tarikh_ulasan_diterima')) ? Carbon::createFromFormat('d/m/Y', request('tarikh_ulasan_diterima'))->format('Y-m-d') : null;
        $tarikh_pengeluaran = (request('tarikh_pengeluaran')) ? Carbon::createFromFormat('d/m/Y', request('tarikh_pengeluaran'))->format('Y-m-d') : null;

        if(request()->borang_id){
            DB::table('borang_lesen')
            ->where('id', request()->borang_id)
            ->update(array(
                'jenis_lesen' => request()->jenis_lesen,
                'kawasan_memburu' => request('kawasan_memburu'),
                'tarikh_mula_memburu' => $mula_memburu,
                'tarikh_tamat_memburu' => $tamat_memburu,
                'nama_pemohon' => request()->nama_penuh,
                'no_kp' => request()->no_kp,
                'no_tel_rumah' => request()->no_tel_r,
                'no_tel_hp' => request()->no_tel_hp,
                'no_pendaftaran_kereta' => request()->penduduk_sabah,
                'penduduk_sabah' => request()->penduduk_sabah,
                'alamat_kediaman' => request()->alamat_kediaman,
                'nama_teman_1' => request()->nama_teman_1,
                'no_kp_teman_1' => request()->no_kp_1,
                'no_lesen_senjata_teman1' => request('no_lesen_senjata_teman1'),
                'nama_teman_2' => request()->nama_teman_2,
                'no_kp_teman_2' => request()->no_kp_2,
                'no_lesen_senjata_teman2' => request('no_lesen_senjata_teman2'),
                'nama_teman_3' => request()->nama_teman_3,
                'no_kp_teman_3' => request()->no_kp_3,
                'no_lesen_senjata_teman3' => request('no_lesen_senjata_teman3'),
                'nama_teman_4' => request()->nama_teman_4,
                'no_kp_teman_4' => request()->no_kp_4,
                'no_lesen_senjata_teman4' => request('no_lesen_senjata_teman4'),
                'buatan_senjata_api' => request()->buatan,
                'ukuran_garis_pusat' => request()->ukuran_garis_pusat,
                'serial_senjata_api' => request()->serial,
                'no_lesen_senjata_api' => request()->no_lesen_senjata,
                'tarikh_pengeluaran_senjata_api' => $tarikh_pengeluaran,
                'tempat_pengeluaran_senjata_api' => request()->tempat_pengeluaran,
                'syarat_lesen_senjata_api' => request()->syarat_lesen_senjata,
                'soalan_ephl_id' => request('soalan_ephl_id'),
                'jawapan_soalan_ephl' => request('jawapan_ephl'),
                "keputusan_ujian_id" => request('keputusan_ujian_id'),
                "ulasan_jhl" => request('ulasan_jhl'),
                "tarikh_ulasan_dipohon" => $tarikh_ulasan_dipohon,
                "tarikh_ulasan_diterima" => $tarikh_ulasan_diterima,
                //"kaedah_ulasan_id" => request('kaedah_ulasan_id'),
                "komen" => request('komen'),
                "daerah_memburu_id" => request('daerah_memburu_id'),
                "pejabat_lesen_id" => request('pejabat_lesen_id'),
                "kawasan_ditangkap" => request('kawasan_ditangkap'),
                'status_borang_id' => 7,
            ));

            //===========================================
            //Insert or Update Butiran Senjata Api table
            //===========================================
            if(Auth::user()->role == 'client'){
                //1. Get User ID for applicant first
                $user_id = DB::table('users')->select('id')->where('ic_number',request('no_kp'))->first();

                //2. Insert or Update butiran senjata api table
                DB::table('butiran_senjata_api')
                ->updateOrInsert(
                    ['user_id' => $user_id->id],
                    ['user_id' => $user_id->id,
                    'no_lesen_senjata_api' => request()->no_lesen_senjata, 'tarikh_pengeluaran' => $tarikh_pengeluaran,
                    'tempat_pengeluaran' => request()->tempat_pengeluaran, 'buatan' => request()->buatan,
                    'ukuran_garis_pusat' => request()->ukuran_garis_pusat, 'no_serial' => request()->serial
                    ]
                );
            }

        }
        return response()->json(array('result'=>'success'));
    }

    //New Record
    public function postSaveSubmitNew(){
        //dd(request()->all());

        //Tempoh sah memburu (extract)
        $tempoh_memburu = str_replace(' ','',request('tempoh_memburu'));
        $tempoh = explode("-",$tempoh_memburu);
        // $mula_memburu = str_replace("/","-",$tempoh[0]);
        // $tamat_memburu = str_replace("/","-",$tempoh[1]);

        $mula_memburu = Carbon::createFromFormat('d/m/Y', $tempoh[0])->format('Y-m-d');
        $tamat_memburu = Carbon::createFromFormat('d/m/Y', $tempoh[1])->format('Y-m-d');

        //Format date to sql insert format yyyy-mm-dd
        $tarikh_ulasan_dipohon = (request('tarikh_ulasan_dipohon')) ? Carbon::createFromFormat('d/m/Y', request('tarikh_ulasan_dipohon'))->format('Y-m-d') : null;
        $tarikh_ulasan_diterima = (request('tarikh_ulasan_diterima')) ? Carbon::createFromFormat('d/m/Y', request('tarikh_ulasan_diterima'))->format('Y-m-d') : null;
        $tarikh_pengeluaran = (request('tarikh_pengeluaran')) ? Carbon::createFromFormat('d/m/Y', request('tarikh_pengeluaran'))->format('Y-m-d') : null;

        $rec = new BorangLesen;
        $rec->jenis_lesen = request()->jenis_lesen;
        $rec->kawasan_memburu = request()->kawasan_memburu;
        $rec->tarikh_mula_memburu = $mula_memburu;
        $rec->tarikh_tamat_memburu = $tamat_memburu;
        $rec->nama_pemohon = request()->nama_penuh;
        $rec->no_kp = request()->no_kp;
        $rec->no_tel_rumah = request()->no_tel_r;
        $rec->no_tel_hp = request()->no_tel_hp;
        $rec->no_pendaftaran_kereta = request()->no_pendaftaran_kereta;
        $rec->penduduk_sabah = request()->penduduk_sabah;
        $rec->alamat_kediaman = request()->alamat_kediaman;
        $rec->nama_teman_1 = request()->nama_teman_1;
        $rec->no_kp_teman_1 = request()->no_kp_1;
        $rec->no_lesen_senjata_teman1 = request('no_lesen_senjata_teman1');
        $rec->nama_teman_2 = request()->nama_teman_2;
        $rec->no_kp_teman_2 = request()->no_kp_2;
        $rec->no_lesen_senjata_teman2 = request('no_lesen_senjata_teman2');
        $rec->nama_teman_3 = request()->nama_teman_3;
        $rec->no_kp_teman_3 = request()->no_kp_3;
        $rec->no_lesen_senjata_teman3 = request('no_lesen_senjata_teman3');
        $rec->nama_teman_4 = request()->nama_teman_4;
        $rec->no_kp_teman_4 = request()->no_kp_4;
        $rec->no_lesen_senjata_teman4 = request('no_lesen_senjata_teman4');
        $rec->buatan_senjata_api = request()->buatan;
        $rec->ukuran_garis_pusat = request()->ukuran_garis_pusat;
        $rec->serial_senjata_api = request()->serial;
        $rec->no_lesen_senjata_api = request()->no_lesen_senjata;
        $rec->tarikh_pengeluaran_senjata_api = $tarikh_pengeluaran;
        $rec->tempat_pengeluaran_senjata_api = request()->tempat_pengeluaran;
        $rec->syarat_lesen_senjata_api = request()->syarat_lesen_senjata;
        $rec->soalan_ephl_id = request('soalan_ephl_id');
        $rec->jawapan_soalan_ephl = request('jawapan_ephl');

        //Only for admin and normal user
        $rec->keputusan_ujian_id = request('keputusan_ujian_id');
        $rec->ulasan_jhl = request('ulasan_jhl');
        $rec->tarikh_ulasan_dipohon = $tarikh_ulasan_dipohon;
        $rec->tarikh_ulasan_diterima = $tarikh_ulasan_diterima;
        //$rec->kaedah_ulasan_id = request('kaedah_ulasan_id');
        $rec->komen = request('komen');

        //If entered by admin or normal user, use 1 = Input Pegawai
        if(Auth::user()->role=='client'){
            $rec->status_borang_id = 2; //Permohonan baru (JIKA PERMOHONAN BARU OLEH CLIENT)
        }else{
            $rec->status_borang_id = 1;//Input pegawai
        }

        $rec->created_by = Auth::user()->id;

        $rec->tarikh_permohonan = Carbon::now();
        $rec->daerah_memburu_id = request('daerah_memburu_id');
        $rec->pejabat_lesen_id = request('pejabat_lesen_id');
        $rec->kawasan_ditangkap = request('kawasan_ditangkap');
        $rec->save();

        $borangID = DB::getPdo()->lastInsertId();


            //===========================================
            //Insert or Update Butiran Senjata Api table
            //===========================================
            if(Auth::user()->role == 'client'){
                //1. Get User ID for applicant first
                $user_id = DB::table('users')->select('id')->where('ic_number',request('no_kp'))->first();

                //2. Insert or Update butiran senjata api table
                DB::table('butiran_senjata_api')
                ->updateOrInsert(
                    ['user_id' => $user_id->id],
                    ['user_id' => $user_id->id,
                    'no_lesen_senjata_api' => request()->no_lesen_senjata, 'tarikh_pengeluaran' => $tarikh_pengeluaran,
                    'tempat_pengeluaran' => request()->tempat_pengeluaran, 'buatan' => request()->buatan,
                    'ukuran_garis_pusat' => request()->ukuran_garis_pusat, 'no_serial' => request()->serial
                    ]
                );
            }

        return response()->json(array('result'=>'success','borang_id'=>$borangID));
    }

    //New Record -Draft
    public function postSaveDraftNew(){
        //dd(request()->all());

        //Tempoh sah memburu (extract)
        $tempoh_memburu = str_replace(' ','',request('tempoh_memburu'));
        $tempoh = explode("-",$tempoh_memburu);
        //$mula_memburu = str_replace("/","-",$tempoh[0]);
        //$tamat_memburu = str_replace("/","-",$tempoh[1]);

        $mula_memburu = Carbon::createFromFormat('d/m/Y', $mula_memburu)->format('Y-m-d');
        $tamat_memburu = Carbon::createFromFormat('d/m/Y', $tamat_memburu)->format('Y-m-d');

        //Format date to sql insert format yyyy-mm-dd
        $tarikh_ulasan_dipohon = (request('tarikh_ulasan_dipohon')) ? Carbon::createFromFormat('d/m/Y', request('tarikh_ulasan_dipohon'))->format('Y-m-d') : null;
        $tarikh_ulasan_diterima = (request('tarikh_ulasan_diterima')) ? Carbon::createFromFormat('d/m/Y', request('tarikh_ulasan_diterima'))->format('Y-m-d') : null;
        $tarikh_pengeluaran = (request('tarikh_pengeluaran')) ? Carbon::createFromFormat('d/m/Y', request('tarikh_pengeluaran'))->format('Y-m-d') : null;

        $rec = new BorangLesen;
        $rec->jenis_lesen = request()->jenis_lesen;
        $rec->kawasan_memburu = request()->kawasan_memburu;
        $rec->tarikh_mula_memburu = $mula_memburu;
        $rec->tarikh_tamat_memburu = $tamat_memburu;
        $rec->nama_pemohon = request()->nama_penuh;
        $rec->no_kp = request()->no_kp;
        $rec->no_tel_rumah = request()->no_tel_r;
        $rec->no_tel_hp = request()->no_tel_hp;
        $rec->no_pendaftaran_kereta = request()->no_pendaftaran_kereta;
        $rec->penduduk_sabah = request()->penduduk_sabah;
        $rec->alamat_kediaman = request()->alamat_kediaman;
        $rec->nama_teman_1 = request()->nama_teman_1;
        $rec->no_kp_teman_1 = request()->no_kp_1;
        $rec->no_lesen_senjata_teman1 = request('no_lesen_senjata_teman1');
        $rec->nama_teman_2 = request()->nama_teman_2;
        $rec->no_kp_teman_2 = request()->no_kp_2;
        $rec->no_lesen_senjata_teman2 = request('no_lesen_senjata_teman2');
        $rec->nama_teman_3 = request()->nama_teman_3;
        $rec->no_kp_teman_3 = request()->no_kp_3;
        $rec->no_lesen_senjata_teman3 = request('no_lesen_senjata_teman3');
        $rec->nama_teman_4 = request()->nama_teman_4;
        $rec->no_kp_teman_4 = request()->no_kp_4;
        $rec->no_lesen_senjata_teman4 = request('no_lesen_senjata_teman4');
        $rec->buatan_senjata_api = request()->buatan;
        $rec->ukuran_garis_pusat = request()->ukuran_garis_pusat;
        $rec->serial_senjata_api = request()->serial;
        $rec->no_lesen_senjata_api = request()->no_lesen_senjata;
        $rec->tarikh_pengeluaran_senjata_api = $tarikh_pengeluaran;
        $rec->tempat_pengeluaran_senjata_api = request()->tempat_pengeluaran;
        $rec->syarat_lesen_senjata_api = request()->syarat_lesen_senjata;
        $rec->soalan_ephl_id = request('soalan_ephl_id');
        $rec->jawapan_soalan_ephl = request('jawapan_ephl');

        //Only for admin and normal user
        $rec->keputusan_ujian_id = request('keputusan_ujian_id');
        $rec->ulasan_jhl = request('ulasan_jhl');
        $rec->tarikh_ulasan_dipohon = $tarikh_ulasan_dipohon;
        $rec->tarikh_ulasan_diterima = $tarikh_ulasan_diterima;
        //$rec->kaedah_ulasan_id = request('kaedah_ulasan_id');
        $rec->komen = request('komen');

        $rec->status_borang_id = 7;//Draft

        $rec->created_by = Auth::user()->id;

        $rec->daerah_memburu_id = request('daerah_memburu_id');
        $rec->pejabat_lesen_id = request('pejabat_lesen_id');
        $rec->kawasan_ditangkap = request('kawasan_ditangkap');

        $rec->save();

        $borangID = DB::getPdo()->lastInsertId();

            //===========================================
            //Insert or Update Butiran Senjata Api table
            //===========================================
            if(Auth::user()->role == 'client'){
                //1. Get User ID for applicant first
                $user_id = DB::table('users')->select('id')->where('ic_number',request('no_kp'))->first();

                //2. Insert or Update butiran senjata api table
                DB::table('butiran_senjata_api')
                ->updateOrInsert(
                    ['user_id' => $user_id->id],
                    ['user_id' => $user_id->id,
                    'no_lesen_senjata_api' => request()->no_lesen_senjata, 'tarikh_pengeluaran' => $tarikh_pengeluaran,
                    'tempat_pengeluaran' => request()->tempat_pengeluaran, 'buatan' => request()->buatan,
                    'ukuran_garis_pusat' => request()->ukuran_garis_pusat, 'no_serial' => request()->serial
                    ]
                );
            }

        return response()->json(array('result'=>'success','borang_id'=>$borangID));
    }

    public function postSaveSpeciesBuruan(){
        //dd(request()->all());

        //Save spesies buruan (no 12)
        foreach(request('spc') as $item){
            if(is_null($item['id']) && $item['spesies']){//insert
                $rec = new SpesiesDipohon;
                $rec->borang_id = request('borang_id');
                $rec->spesies = $item['spesies'];
                $rec->bilangan = $item['bilangan'];
                $rec->kawasan = $item['kawasan'];
                $rec->save();
            }else if($item['spesies']){//update
                $rec = SpesiesDipohon::find($item['id']);
                $rec->spesies = $item['spesies'];
                $rec->bilangan = $item['bilangan'];
                $rec->kawasan = $item['kawasan'];
                $rec->save();
            }

        }

        //Save spesies komersil (no 13)
        foreach(request('spc_komersil') as $item2){
            if(is_null($item2['id']) && $item2['spesies']){//insert
                $rec = new SpesiesKomersil;
                $rec->borang_id = request('borang_id');
                $rec->spesies = $item2['spesies'];
                $rec->bilangan_angka_perkataan = $item2['bilangan'];//angka dan perkataan
                $rec->cara_tangkapan = $item2['cara_tangkapan'];
                $rec->bilangan_peluru_digunakan = $item2['bil_peluru'];
                $rec->save();
            }else if($item2['spesies']){//update
                $rec = SpesiesKomersil::find($item2['id']);
                $rec->spesies = $item2['spesies'];//error: Creating default object from empty value
                $rec->bilangan_angka_perkataan = $item2['bilangan'];//angka dan perkataan
                $rec->cara_tangkapan = $item2['cara_tangkapan'];
                $rec->bilangan_peluru_digunakan = $item2['bil_peluru'];
                $rec->save();
            }
        }


        $spesies_dipohon = DB::table("spesies_dipohon")->where('borang_id', request('borang_id'))->get();
        $spesies_komersil = DB::table("spesies_komersil")->where('borang_id', request('borang_id'))->get();

        //dd($spesies_komersil);

        return response()->json(array('result'=>'success','spesies1'=>$spesies_dipohon,'spesies2'=>$spesies_komersil));
    }

    public function postDeleteSpesies(){
        //dd(request()->all());
        if(request('species_table')=='tblSpesies12'){
            $rec = SpesiesDipohon::find(request('delete_id'));
            $rec->delete();
        }else if(request('species_table')=='tblSpesies13'){
            $rec = SpesiesKomersil::find(request('delete_id'));
            $rec->delete();
        }

        $spesies_dipohon = DB::table("spesies_dipohon")->where('borang_id', request('borang_id'))->get();
        $spesies_komersil = DB::table("spesies_komersil")->where('borang_id', request('borang_id'))->get();

        return response()->json(array('result'=>'success','spesies1'=>$spesies_dipohon,'spesies2'=>$spesies_komersil));
    }

    public function lesenBaru(){

        $soalan_ephl = SoalanEPHL::all();
        $kaedah_ulasan = KaedahUlasan::all();
        $keputusan_ujian = KeputusanUjian::all();
        $hidupan_liar = HidupanLiar::orderBy('NAMA_TEMPATAN','ASC')->get();
        $daerah_memburu = DaerahMemburuMemungut::orderBy('daerah','ASC')->get();
        $pejabat_lesen = PejabatPungutanLesen::orderBy('nama_pejabat','ASC')->get();
        $butiran_senjata = DB::table('butiran_senjata_api')->where('user_id',Auth::user()->id)->first();
        $randomPosition = 0;

        if(Auth::user()->role=='client'){$randomPosition=rand(1,9);}

        return view('memburu.new_lesen',compact('soalan_ephl','kaedah_ulasan','keputusan_ujian',
        'randomPosition','daerah_memburu','pejabat_lesen','hidupan_liar','butiran_senjata'));
        //use hashids = https://github.com/ElfSundae/laravel-hashid
    }

    public function postDeleteLesen(){
        //dd(request()->all());

        //Delete all
        DB::table('borang_lesen')->where('id', '=', request('borang_id'))->delete();
        DB::table('spesies_dipohon')->where('borang_id', '=', request('borang_id'))->delete();
        DB::table('spesies_komersil')->where('borang_id', '=', request('borang_id'))->delete();

        $borang = collect($this->BorangView());
        if(Auth::user()->role == 'client'){
            $result = $borang->where('created_by','=',Auth::user()->id);
        }else{
            $result = $borang->where('id', '>', 0);
        }

        return response()->json(array('result' => $result));
    }

    public function postSahkan(){
        //dd(request()->all());
        if(request('borang_id')){
            DB::table('borang_lesen')
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
        // dd(request()->all());
        if(request('borang_id')){
            DB::table('borang_lesen')
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
            DB::table('borang_lesen')
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
            DB::table('borang_lesen')
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
        $permitNumber = "";
        if(request('no_lesen')){
            $permitNumber = request('no_lesen');
        }else{
            $kod = PejabatPembayaran::where('id','=',request('pejabat_pembayaran_id'))->first();
            $permitNumber = PermitLicenseNumber::GenerateLicenseNumber($kod->kod, "5", "1", "1", request('borang_id_resitam'));
        }

        $tarikh_resit = request('tarikh_resit');
        $tarikh_resit_formatted = (($tarikh_resit) ? Carbon::createFromFormat('d/m/Y',$tarikh_resit)->format('Y-m-d') : null);

        $tarikh_berkuatkuasa = null;
        $result = DB::table("borang_lesen")->select('tarikh_berkuatkuasa','tarikh_diluluskan')->where('id',request('borang_id_resitam'))->first();
        if($result){

            if($result->tarikh_diluluskan){
                $tarikh_berkuatkuasa = $result->tarikh_diluluskan;
                $tarikh_tamat = date('Y-m-d', strtotime($result->tarikh_diluluskan. ' + '.request('tempoh_permit').' years'));

                DB::table('borang_lesen')
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
            $rec->permit_type_id = 1;
            $rec->permit_id = request('borang_id_resitam');
            $rec->no_lesen = $permitNumber;
            $rec->save();
        }else{//insert
            $rec = new ResitAm;
            $rec->no_resit = request('no_resit');
            $rec->tarikh_resit = $tarikh_resit_formatted;
            $rec->jumlah_rm = request('jumlah_rm');
            $rec->pejabat_pembayaran_id = request('pejabat_pembayaran_id');
            $rec->permit_type_id = 1;
            $rec->permit_id = request('borang_id_resitam');
            $rec->no_lesen = $permitNumber;
            $rec->save();

            $resit_id = DB::getPdo()->lastInsertId();

            DB::table('borang_lesen')
            ->where('id', request()->borang_id_resitam)
            ->update(array(
                'resit_am_id' => $resit_id,
            ));
        }

        $borang = collect($this->BorangView());
        if(Auth::user()->role == 'client'){
            $result = $borang->where('created_by','=',Auth::user()->id);
        }else{
            $result = $borang->where('id', '>', 0);
        }

        return response()->json(array('result' => $result));
    }

    public function postCheckKawasan(){
        $rec = SenaraiKawasan::where('nama_kawasan', 'like', '%' . request('nama_kawasan') . '%')->where('memburu_dibenarkan','=',0)->get();

        if($rec->count() > 0){
            $result="fail";
        }else{
            $result="success";
        }
        return response(array('result'=>$result));
    }

    public function postRenewPermit(){
        //dd(request()->all());
        //Clear related fields
        DB::table('borang_lesen')
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

        $borang = collect($this->BorangView());
        if(Auth::user()->role == 'client'){
            $result = $borang->where('created_by','=',Auth::user()->id);
        }else{
            $result = $borang->where('id', '>', 0);
        }

        return response()->json(array('result' => $result));
    }

}

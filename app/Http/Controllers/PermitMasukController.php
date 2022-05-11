<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\JenisDibawaMasuk;
use App\Models\HidupanLiar;
use App\Models\SenaraiDibawaMasuk;
use App\Models\FailPermitBawaMasuk;
use App\Models\BorangPermitBawaMasuk;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use App\Models\PejabatPembayaran;
use App\GeneralClass\PermitLicenseNumber;
use App\Models\ResitAm;

class PermitMasukController extends Controller
{
    public function index(){
        $pejabat = PejabatPembayaran::orderBy('pejabat','ASC')->get();
        return view('membawa_masuk.index', compact('pejabat'));
    }

    public function loadBorang(){
        //dd(request()->all());
        $borang = collect($this->BorangView());

        if(Auth::user()->role == 'client'){
            $result = $borang->where('created_by','=',Auth::user()->id);
        }else{
            $result = $borang->where('id', '>', 0);
        }

        return response()->json(array('result' => $result));
    }

    public function new(){
        $negara = Country::all();
        $jenis = JenisDibawaMasuk::all();
        $spesis = HidupanLiar::select('ID','NAMA_TEMPATAN')->get();
        return view('membawa_masuk.new', compact('negara','jenis','spesis'));
    }

    public function view($id){
        $borang = collect($this->BorangView());
        $data = $borang->where('id', '=', $id)->first();
        $jenis = JenisDibawaMasuk::all();
        // $senarai_dibawa = SenaraiDibawaMasuk::where('borang_id',$id)->get();
        $senarai_dibawa = DB::select(DB::raw("
        SELECT s.*,j.jenis AS jenis_dibawa_masuk, t.NAMA_TEMPATAN AS spesis FROM senarai_dibawa_masuk AS s
        LEFT JOIN jenis_dibawa_masuk AS j ON j.id = s.jenis_dibawa_masuk_id
        LEFT JOIN hidupan_liar AS t ON t.ID = s.spesis_id
        WHERE borang_id=?
        "),[$id]);
        $negara = Country::all();
        $spesis = HidupanLiar::select('ID','NAMA_TEMPATAN')->get();
        $status_borang = DB::table("status_borang")->where('id',$data->status_borang_id)->first();

        return view('membawa_masuk.view', compact('data',
        'jenis', 'senarai_dibawa', 'negara','spesis','status_borang'));
    }

    private function BorangView(){
        $result = DB::select(DB::raw("
        SELECT
            b.*,
            medium_penghantaran.`medium` AS medium_penghantaran,
            countries.`name` AS negara_asal,
            jenis_dibawa_masuk.jenis AS jenis_dibawa_masuk,
            resit_am.no_resit,
            resit_am.tarikh_resit,
            resit_am.jumlah_rm,
            resit_am.pejabat_pembayaran_id,
            resit_am.no_lesen,
            resit_am.permit_type_id,
            resit_am.permit_id,
            status_borang.status AS status_borang,
            disahkan.`name` AS disahkan_oleh_nama,
            ditolak.`name` AS ditolak_oleh_nama,
            diluluskan.`name` AS diluluskan_oleh_nama,
            dikembalikan.`name` AS dikembalikan_oleh_nama
        FROM
            borang_permit_bawa_masuk AS b
            LEFT JOIN resit_am ON b.resit_am_id = resit_am.id
            LEFT JOIN medium_penghantaran ON b.medium_penghantaran_id = medium_penghantaran.id
            LEFT JOIN countries ON b.negara_asal_id = countries.id
            LEFT JOIN jenis_dibawa_masuk ON b.jenis_dibawa_masuk_id = jenis_dibawa_masuk.id
            LEFT JOIN status_borang ON status_borang.id = b.status_borang_id
            LEFT JOIN users AS disahkan ON b.disahkan_oleh = disahkan.id
            LEFT JOIN users AS ditolak ON b.ditolak_oleh = ditolak.id
            LEFT JOIN users AS diluluskan ON b.diluluskan_oleh = diluluskan.id
            LEFT JOIN users AS dikembalikan ON b.dikembalikan_oleh = dikembalikan.id
        "));
        return $result;
    }

    public function postSubmit(){
        // dd(request()->all());

        //Insert new data
        $borang_id = DB::table('borang_permit_bawa_masuk')->insertGetId(
            [
                'created_by'=>Auth::user()->id,
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
                'nama'=>request('nama'),
                'alamat'=>request('alamat'),
                'no_kp'=>request('no_kp'),
                'no_tel_hp'=>request('no_tel'),
                'tujuan_dibawa_masuk'=>request('tujuan_dibawa_masuk'),
                'negara_asal_id'=>request('negara_asal_id'),
                'medium_penghantaran_id'=>request('medium_penghantaran'),
                'medium_penghantaran_remark'=>request('medium_penghantaran_remark'),
                'jenis_dibawa_masuk_id'=>request('jenis_dibawa_masuk_id'),
                'tarikh_permohonan'=>Carbon::now(),
                'status_borang_id'=>2,
            ]
        );

        //Save senarai barang
        $senaraiBarang = json_decode(request('senaraiBarang'));
        foreach($senaraiBarang as $item){
            //Save each item example: $item->spesis
            $jenis_id = DB::table('jenis_dibawa_masuk')->select('id')->where('jenis',$item->jenis)->first();
            $spesis_id = DB::table('hidupan_liar')->select('ID AS id')->where('NAMA_TEMPATAN',$item->spesis)->first();

            $rec = new SenaraiDibawaMasuk;
            $rec->borang_id = $borang_id;
            $rec->jenis_dibawa_masuk_id = ($jenis_id) ? $jenis_id->id : null;
            $rec->spesis_id = ($spesis_id) ? $spesis_id->id : null;
            $rec->bilangan = $item->bilangan;
            $rec->save();

        }

        return response()->json(array('result'=>'success','borang_id'=>$borang_id));
    }

    public function postUpdate(){
        // dd(request()->all());

        //Insert new data
        DB::table('borang_permit_bawa_masuk')->where('id',request('borangId'))->update(array(
            'updated_at'=>Carbon::now(),
            'nama'=>request('nama'),
            'alamat'=>request('alamat'),
            'no_kp'=>request('no_kp'),
            'no_tel_hp'=>request('no_tel'),
            'tujuan_dibawa_masuk'=>request('tujuan_dibawa_masuk'),
            'negara_asal_id'=>request('negara_asal_id'),
            'medium_penghantaran_id'=>request('medium_penghantaran'),
            'medium_penghantaran_remark'=>request('medium_penghantaran_remark'),
            'jenis_dibawa_masuk_id'=>request('jenis_dibawa_masuk_id'),
            'tarikh_permohonan'=>Carbon::now(),
            'status_borang_id'=>2,
            'dikembalikan_oleh'=>null,
            'sebab_dikembalikan'=>null,
        ));

        //Save senarai barang
        $senaraiBarang = json_decode(request('senaraiBarang'));
        foreach($senaraiBarang as $item){
            //Save each item example: $item->spesis
            $jenis_id = DB::table('jenis_dibawa_masuk')->select('id')->where('jenis',$item->jenis)->first();
            $spesis_id = DB::table('hidupan_liar')->select('ID AS id')->where('NAMA_TEMPATAN',$item->spesis)->first();

            if($item->barangId){
                $rec = SenaraiDibawaMasuk::find($item->barangId);
                $rec->borang_id = request('borangId');
                $rec->jenis_dibawa_masuk_id = ($jenis_id) ? $jenis_id->id : null;
                $rec->spesis_id = ($spesis_id) ? $spesis_id->id : null;
                $rec->bilangan = $item->bilangan;
                $rec->save();
            }else {
                $rec = new SenaraiDibawaMasuk;
                $rec->borang_id = request('borangId');
                $rec->jenis_dibawa_masuk_id = ($jenis_id) ? $jenis_id->id : null;
                $rec->spesis_id = ($spesis_id) ? $spesis_id->id : null;
                $rec->bilangan = $item->bilangan;
                $rec->save();
            }

        }

        return response()->json(array('result'=>'success','borang_id'=>request('borangId')));
    }

    public function postDeleteSpesis(){
        //dd(request()->all());
        if(request('senarai_id')){
            $rec = SenaraiDibawaMasuk::find(request('senarai_id'));
            $rec->delete();
        }
        return response()->json(array('result'=>'success'));
    }


    public function postDeleteBorang(){
        $rec = BorangPermitBawaMasuk::find(request("borang_id"));
        $rec->delete();
        $borang = collect($this->BorangView());

        if(Auth::user()->role == 'client'){
            $result = $borang->where('created_by','=',Auth::user()->id);
        }else{
            $result = $borang->where('id', '>', 0);
        }

        return response()->json(array('result' => $result));
    }

    public function postReturn(){
        //dd(request()->all());
        $rec = BorangPermitBawaMasuk::find(request('borang_id'));
        $rec->tarikh_dikembalikan = Carbon::now();
        $rec->dikembalikan_oleh = Auth::user()->id;
        $rec->sebab_dikembalikan = request('return_remark');
        $rec->status_borang_id = 3; //return status
        $rec->save();
        return response()->json("success");
    }

    public function postUpdateResitAm(){
        // dd(request()->all());
        $permitNumber = "";
        if(request('no_permit')){
            $permitNumber = request('no_permit');
        }else{
            $kod = PejabatPembayaran::where('id','=',request('pejabat_pembayaran_id'))->first();
            $permitNumber = PermitLicenseNumber::GenerateLicenseNumber($kod->kod, "3", "1", "6", request('borang_id_resitam'));
        }

        $tarikh_resit = request('tarikh_resit');
        $tarikh_resit_formatted = (($tarikh_resit) ? Carbon::createFromFormat('d/m/Y',$tarikh_resit)->format('Y-m-d') : null);

        $tarikh_berkuatkuasa = null;
        $result = DB::table("borang_permit_bawa_masuk")->select('tarikh_berkuatkuasa','tarikh_diluluskan')->where('id',request('borang_id_resitam'))->first();
        if($result){
            if($result->tarikh_diluluskan){
                $tarikh_berkuatkuasa = $result->tarikh_diluluskan;
                $tarikh_tamat = date('Y-m-d', strtotime($result->tarikh_diluluskan. ' + '.request('tempoh_permit').' years'));

                DB::table('borang_permit_bawa_masuk')
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
            $rec->permit_type_id = 6;
            $rec->permit_id = request('borang_id_resitam');
            $rec->no_lesen = $permitNumber;
            $rec->save();
        }else{//insert
            $rec = new ResitAm;
            $rec->no_resit = request('no_resit');
            $rec->tarikh_resit = $tarikh_resit_formatted;
            $rec->jumlah_rm = request('jumlah_rm');
            $rec->pejabat_pembayaran_id = request('pejabat_pembayaran_id');
            $rec->permit_type_id = 6;
            $rec->permit_id = request('borang_id_resitam');
            $rec->no_lesen = $permitNumber;
            $rec->save();

            $resit_id = DB::getPdo()->lastInsertId();

            DB::table('borang_permit_bawa_masuk')
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

    public function postSahkanBorang(){
        //dd(request()->all());
        if(request('borang_id')){
            DB::table('borang_permit_bawa_masuk')
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
        if(request('borang_id')){
            DB::table('borang_permit_bawa_masuk')
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
        if(request('borang_id')){
            DB::table('borang_permit_bawa_masuk')
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
        //dd(request()->all());
        //Clear related fields
        DB::table('borang_permit_bawa_masuk')
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

        $borang = collect($this->BorangView());
        if(Auth::user()->role == 'client'){
            $result = $borang->where('created_by','=',Auth::user()->id);
        }else{
            $result = $borang->where('id', '>', 0);
        }

        return response()->json(array('result' => $result));
    }
}

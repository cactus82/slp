<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HidupanLiar;
use App\Models\SalinanSijilKesihatan;
use App\Models\SenaraiSpesisTawanan;
use App\Models\BorangPermitHaiwanTawanan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use App\Models\PejabatPembayaran;
use App\GeneralClass\PermitLicenseNumber;
use App\Models\ResitAm;

class PermitTawananController extends Controller
{
    public function index(){
        $pejabat = PejabatPembayaran::orderBy('pejabat','ASC')->get();
        return view('tawanan.index', compact('pejabat'));
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
        $spesis = HidupanLiar::select('ID','NAMA_TEMPATAN')->get();
        return view('tawanan.new', compact('spesis'));
    }

    public function view($id){
        $borang = collect($this->BorangView());
        $data = $borang->where('id', '=', $id)->first();
        $salinan_sijil_kesihatan = SalinanSijilKesihatan::where('borang_id',$id)->get();
        // $senarai_spesis = SenaraiSpesisTawanan::where('borang_id',$id)->get();
        $senarai_spesis = DB::select(DB::raw("
        SELECT s.*,t.NAMA_TEMPATAN AS spesis FROM senarai_spesis_tawanan AS s
        LEFT JOIN hidupan_liar AS t ON t.ID = s.spesis_id
        WHERE borang_id=?
        "),[$id]);
        $spesis = HidupanLiar::select('ID','NAMA_TEMPATAN')->get();
        $status_borang = DB::table("status_borang")->where('id',$data->status_borang_id)->first();

        return view('tawanan.view', compact('data','salinan_sijil_kesihatan',
        'senarai_spesis','spesis','status_borang'));
    }

    private function BorangView(){
        $result = DB::select(DB::raw("
        SELECT
                b.*,
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
                borang_permit_haiwan_tawanan AS b
                LEFT JOIN resit_am ON b.resit_am_id = resit_am.id
                LEFT JOIN users AS disahkan ON b.disahkan_oleh = disahkan.id
                LEFT JOIN users AS ditolak ON b.ditolak_oleh = ditolak.id
                LEFT JOIN users AS diluluskan ON b.diluluskan_oleh = diluluskan.id
                LEFT JOIN users AS dikembalikan ON b.dikembalikan_oleh = dikembalikan.id
                LEFT JOIN status_borang ON status_borang.id = b.status_borang_id
        "));
        return $result;
    }

    public function postSubmit(){
        // dd(request()->all());

        //Insert new data
        $borang_id = DB::table('borang_permit_haiwan_tawanan')->insertGetId(
            [
                'created_by'=>Auth::user()->id,
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
                'nama'=>request('nama'),
                'no_tel_hp'=>request('no_tel'),
                'alamat'=>request('alamat'),
                'butir_permit_tawanan_lain'=>request('butir_permit_lain'),
                'butir_ringkas_pengaturan'=>request('butir_pengaturan_penyimpanan'),
                'butir_ringkas_diet'=>request('butir_diet'),
                'tarikh_permohonan'=>Carbon::now(),
                'status_borang_id'=>2,
            ]
        );

        //Save senarai spesis
        $senaraiSpesis = json_decode(request('senaraiSpesis'));
        foreach($senaraiSpesis as $item){
            //Save each item example: $item->spesis
            $spesis_id = DB::table('hidupan_liar')->select('ID AS id')->where('NAMA_TEMPATAN',$item->spesis)->first();

            $rec = new SenaraiSpesisTawanan;
            $rec->borang_id = $borang_id;
            $rec->spesis_id = ($spesis_id) ? $spesis_id->id : null;
            $rec->bilangan = $item->bilangan;
            $rec->created_at = Carbon::now();
            $rec->save();

        }


        //Save attachment. check if contain file
        if(request()->hasFile('salinan_sijil_kesihatan')){
            $file = request()->file('salinan_sijil_kesihatan');

            foreach($file as $f){
                $fileNameWithExt = $f->getClientOriginalName();
                $fileNameOnly = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                $extensionOnly = $f->getClientOriginalExtension();
                $fileNameToStore = $fileNameOnly.'_'.time().'.'.$extensionOnly;
                $fileSizeKB = round(($f->getSize())/1000,2);

                $path = $f->storeAs('public/failpermithaiwantawanan', $fileNameToStore);

                //Save file path to DB
                $rec = new SalinanSijilKesihatan;
                $rec->borang_id = $borang_id;
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

    public function postUpdate(){
        // dd(request()->all());

        //Insert new data
        DB::table('borang_permit_haiwan_tawanan')->where('id',request('borangId'))->update(array(
            'updated_at'=>Carbon::now(),
            'nama'=>request('nama'),
            'no_tel_hp'=>request('no_tel'),
            'alamat'=>request('alamat'),
            'butir_permit_tawanan_lain'=>request('butir_permit_lain'),
            'butir_ringkas_pengaturan'=>request('butir_pengaturan_penyimpanan'),
            'butir_ringkas_diet'=>request('butir_diet'),
            'tarikh_permohonan'=>Carbon::now(),
            'dikembalikan_oleh'=>null,
            'sebab_dikembalikan'=>null,
            'status_borang_id'=>2,));

        //Save senarai spesis
        $senaraiSpesis = json_decode(request('senaraiSpesis'));
        foreach($senaraiSpesis as $item){
            //Save each item example: $item->spesis
            $spesis_id = DB::table('hidupan_liar')->select('ID AS id')->where('NAMA_TEMPATAN',$item->spesis)->first();

            if ($item->spesisId) {
                $rec = SenaraiSpesisTawanan::find($item->spesisId);
                $rec->borang_id = request('borangId');
                $rec->spesis_id = ($spesis_id) ? $spesis_id->id : null;
                $rec->bilangan = $item->bilangan;
                $rec->save();
            } else {
                $rec = new SenaraiSpesisTawanan;
                $rec->borang_id = request('borangId');
                $rec->spesis_id = ($spesis_id) ? $spesis_id->id : null;
                $rec->bilangan = $item->bilangan;
                $rec->save();
            }
        }


        //Save attachment. check if contain file
        if(request()->hasFile('salinan_sijil_kesihatan')){
            $file = request()->file('salinan_sijil_kesihatan');

            foreach($file as $f){
                $fileNameWithExt = $f->getClientOriginalName();
                $fileNameOnly = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                $extensionOnly = $f->getClientOriginalExtension();
                $fileNameToStore = $fileNameOnly.'_'.time().'.'.$extensionOnly;
                $fileSizeKB = round(($f->getSize())/1000,2);

                $path = $f->storeAs('public/failpermithaiwantawanan', $fileNameToStore);

                //Save file path to DB
                $rec = new SalinanSijilKesihatan;
                $rec->borang_id = request('borangId');
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

    public function postDeleteSpesis(){
        //dd(request()->all());
        if(request('senarai_id')){
            $rec = SenaraiSpesisTawanan::find(request('senarai_id'));
            $rec->delete();
        }
        return response()->json(array('result'=>'success'));
    }

    public function downloadSalinanSijilKesihatan($filename = ''){
        //dd($filename);
        $file_path = storage_path() . "/app/public/failpermithaiwantawanan/" . $filename;
        $headers = array(
            'Content-Disposition: attachment; filename=' . $filename,
        );

        if (file_exists($file_path)) {
            return \Response::download($file_path, $filename, $headers);
        } else {
            exit('Requested file does not exist on our server!');
        }
    }

    public function deleteSalinanSijilKesihatan($id){

        $rec = SalinanSijilKesihatan::find($id);
        $borangID = $rec->borang_id;
        $permit_url = "/permit/haiwantawanan/view/".$borangID;

        //delete from disk storage
        Storage::delete($rec->file_name);

        //delete from database
        $rec->delete();

        return redirect($permit_url);
    }

    public function postDeleteBorang(){
        $rec = BorangPermitHaiwanTawanan::find(request("borang_id"));
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
        // dd(request()->all());
        $rec = BorangPermitHaiwanTawanan::find(request('borang_id'));
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
            $permitNumber = PermitLicenseNumber::GenerateLicenseNumber($kod->kod, "3", "1", "7", request('borang_id_resitam'));
        }

        $tarikh_resit = request('tarikh_resit');
        $tarikh_resit_formatted = (($tarikh_resit) ? Carbon::createFromFormat('d/m/Y',$tarikh_resit)->format('Y-m-d') : null);

        $tarikh_berkuatkuasa = null;
        $result = DB::table("borang_permit_haiwan_tawanan")->select('tarikh_berkuatkuasa','tarikh_diluluskan')->where('id',request('borang_id_resitam'))->first();
        if($result){
            if($result->tarikh_diluluskan){
                $tarikh_berkuatkuasa = $result->tarikh_diluluskan;
                $tarikh_tamat = date('Y-m-d', strtotime($result->tarikh_diluluskan. ' + '.request('tempoh_permit').' years'));

                DB::table('borang_permit_haiwan_tawanan')
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
            $rec->permit_type_id = 7;
            $rec->permit_id = request('borang_id_resitam');
            $rec->no_lesen = $permitNumber;
            $rec->save();
        }else{//insert
            $rec = new ResitAm;
            $rec->no_resit = request('no_resit');
            $rec->tarikh_resit = $tarikh_resit_formatted;
            $rec->jumlah_rm = request('jumlah_rm');
            $rec->pejabat_pembayaran_id = request('pejabat_pembayaran_id');
            $rec->permit_type_id = 7;
            $rec->permit_id = request('borang_id_resitam');
            $rec->no_lesen = $permitNumber;
            $rec->save();

            $resit_id = DB::getPdo()->lastInsertId();

            DB::table('borang_permit_haiwan_tawanan')
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
            DB::table('borang_permit_haiwan_tawanan')
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
            DB::table('borang_permit_haiwan_tawanan')
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
            DB::table('borang_permit_haiwan_tawanan')
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
        DB::table('borang_permit_haiwan_tawanan')
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

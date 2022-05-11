<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use Carbon\Carbon;
use App\Models\FailPermitPenternakan;
use App\Models\HidupanLiar;
use Illuminate\Support\Facades\Storage;
use App\Models\ResitAm;
use App\Models\FailPermit;
use App\Models\BorangPermitPenternakan;
use App\GeneralClass\PermitLicenseNumber;
use App\Models\PejabatPembayaran;
use App\Models\LaporanSiteInspection;
use App\Models\Daerah;

class PermitPenternakanController extends Controller
{
    public function index(){
        $pejabat = PejabatPembayaran::orderBy('pejabat','ASC')->get();
        return view('permit_penternakan.index', compact('pejabat'));
    }

    public function loadPermitDatatable(){
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
        borang_permit_penternakan.id,
        borang_permit_penternakan.updated_at,
        borang_permit_penternakan.nama_penuh,
        borang_permit_penternakan.no_kp,
        borang_permit_penternakan.jenis_permit,
        resit_am.no_resit,
        borang_permit_penternakan.resit_am_id,
        status_borang.`status` AS `status_borang`,
        resit_am.jumlah_rm,
        resit_am.no_lesen,
        resit_am.tarikh_resit,
        resit_am.pejabat_pembayaran_id AS pejabat_pembayaran_id,
        borang_permit_penternakan.permit_file_id,
        borang_permit_penternakan.nombor_permit,
        borang_permit_penternakan.renewal,
        borang_permit_penternakan.status_borang_id,
        borang_permit_penternakan.created_by,
        borang_permit_penternakan.sebab_dikembalikan,
        borang_permit_penternakan.tempoh_permit_lesen
    FROM
        borang_permit_penternakan
        LEFT JOIN resit_am ON borang_permit_penternakan.resit_am_id = resit_am.id
        LEFT JOIN status_borang ON borang_permit_penternakan.status_borang_id = status_borang.id"));

        return $result;
    }

    public function permohonan_baru(){
        $hidupan_liar = HidupanLiar::orderBy('NAMA_TEMPATAN','ASC')->get();
        $daerah = Daerah::orderBy('daerah','ASC')->get();
        return view('permit_penternakan.new_permit',compact('hidupan_liar','daerah'));
    }

    public function postSubmitPermit(){
        //dd(request()->all());

        //Insert new data
        $borang_id = DB::table('borang_permit_penternakan')->insertGetId(
            [
                'created_by'=>Auth::user()->id,
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
                'jenis_permit'=>request('jenis_permit'),
                'nama_penuh'=>request('nama_penuh'),
                'no_kp'=>request('no_kp'),
                'no_tel'=>request('no_tel'),
                'alamat_kediaman'=>request('alamat_kediaman'),
                'butir_lesen_permit'=>request('butir_permit_lain'),
                'alamat_penternakan_penanaman'=>request('alamat_penternakan'),
                'saiz_kawasan'=>request('saiz'),
                'deskripsi_bangunan'=>request('deskripsi_bangunan'),
                'butir_peraturan'=>request('butir_peraturan'),
                'butir_stok'=>request('butir_stok'),
                'butir_diet'=>request('butir_diet'),
                'salinan_ramalan'=>request('salinan_ramalan'),
                'status_borang_id'=>2,

        ]);

        //Save attachment
        //check if contain file
        if(request()->hasFile('petaFile')){
            $file = request()->file('petaFile');

            foreach($file as $f){
                $fileNameWithExt = $f->getClientOriginalName();
                $fileNameOnly = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                $extensionOnly = $f->getClientOriginalExtension();
                $fileNameToStore = $fileNameOnly.'_'.time().'.'.$extensionOnly;
                $fileSizeKB = round(($f->getSize())/1000,2);

                $path = $f->storeAs('public/failpermitpenternakan', $fileNameToStore);

                //Save file path to DB
                $rec = new FailPermitPenternakan;
                $rec->borang_id = $borang_id;
                $rec->file_name = $path;
                $rec->file_size = $fileSizeKB;
                $rec->original_name = $fileNameOnly.'.'.$extensionOnly;
                $rec->save();
            }
        }

        return response()->json(array('result'=>'success','borang_id'=>$borang_id));
    }

    public function downloadPermitFile($filename = '')
    {
        $file_path = storage_path() . "/app/public/failpermitpenternakan/" . $filename;
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
    public function deletePermitFile($id){
        $rec = FailPermitPenternakan::find($id);
        $borangID = $rec->borang_id;
        $permit_url = "/permit/penternakan/view/".$borangID;

        //delete from disk storage
        Storage::delete($rec->file_name);

        //delete from database
        $rec->delete();

        return redirect($permit_url);
    }

    public function postSaveSpesis(){
        //dd(request()->all());

        //Insert new Butir-Butir Haiwan or Tumbuhan
        foreach(request('spesis') as $item){
            if(is_null($item['id']) && $item['spesis']){//insert
                DB::table('butir_haiwan_tumbuhan')->insert([
                    [
                        'borang_permit_penternakan_id'=>request('borang_id'),
                        'spesis'=>$item['spesis'],
                        'bilangan_kuantiti'=>$item['bilangan'],
                    ]
                ]);
            }else if($item['spesis']){//update
                DB::table('butir_haiwan_tumbuhan')->where('id',$item['id'])->update([
                    [
                        'borang_permit_penternakan_id'=>request('borang_id'),
                        'spesis'=>$item['spesis'],
                        'bilangan_kuantiti'=>$item['bilangan'],
                    ]
                ]);
            }

        }

        return response()->json(array('result'=>'success'));
    }

    private function BorangPermitView(){
        $result = DB::select(DB::raw("SELECT
            borang_permit_penternakan.*,
            disahkan.`name` AS disahkan_oleh_nama,
            ditolak.`name` AS ditolak_oleh_nama,
            diluluskan.`name` AS diluluskan_oleh_nama,
            dikembalikan.`name` AS dikembalikan_oleh_nama
        FROM
            borang_permit_penternakan
            LEFT JOIN users AS disahkan ON borang_permit_penternakan.disahkan_oleh = disahkan.id
            LEFT JOIN users AS ditolak ON borang_permit_penternakan.ditolak_oleh = ditolak.id
            LEFT JOIN users AS diluluskan ON borang_permit_penternakan.diluluskan_oleh = diluluskan.id
            LEFT JOIN users AS dikembalikan ON borang_permit_penternakan.dikembalikan_oleh = dikembalikan.id
        ORDER BY
            borang_permit_penternakan.id DESC;"));
        return $result;
    }

    public function viewEditPermit($id){
        $borangs = collect($this->BorangPermitView());
        $borang = $borangs->where('id','=',$id)->first();

        $status_borang = DB::table("status_borang")->where('id',$borang->status_borang_id)->first();
        $spesies_dipohon = DB::table("butir_haiwan_tumbuhan")->where('borang_permit_penternakan_id', $id)->get();
        $hidupan_liar = HidupanLiar::orderBy('NAMA_TEMPATAN','ASC')->get();
        $fail_permit_penternakan = FailPermitPenternakan::where('borang_id',$id)->get();
        $laporan_site_inspection = LaporanSiteInspection::where('borang_id',$id)->get();

        $borang_id = $id;

        $daerah = Daerah::orderby('daerah','ASC')->get();

        // dd($borang);

        return view('permit_penternakan.view_permit', compact('borang','status_borang', 'spesies_dipohon', 'borang_id', 'hidupan_liar', 'fail_permit_penternakan', 'laporan_site_inspection','daerah'));
    }

    public function postLoadSpesies(){
        //dd(request()->all());
        $spesies = DB::table("butir_haiwan_tumbuhan")->where('borang_permit_penternakan_id',request('borang_id'))->get();

        return response()->json(array('spesies'=>$spesies));
    }

    public function postSahkanBorang(){
        // dd(request()->all());
        if(request('borang_id2')){
            DB::table('borang_permit_penternakan')
            ->where('id', request()->borang_id2)
            ->update(array(
                'status_borang_id' => 4,
                'disahkan_oleh' => Auth::user()->id,
                'tarikh_disahkan' => Carbon::now(),
            ));

            //check if contain file
            if(request()->hasFile('laporan_site_inspection')){
                $file = request()->file('laporan_site_inspection');

                foreach($file as $f){
                    $fileNameWithExt = $f->getClientOriginalName();
                    $fileNameOnly = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                    $extensionOnly = $f->getClientOriginalExtension();
                    $fileNameToStore = $fileNameOnly.'_'.time().'.'.$extensionOnly;
                    $fileSizeKB = round(($f->getSize())/1000,2);

                    $path = $f->storeAs('public/failpermitpenternakan', $fileNameToStore);

                    //Save file path to DB
                    $rec = new LaporanSiteInspection;
                    $rec->borang_id = request('borang_id2');
                    $rec->file_name = $path;
                    $rec->file_size = $fileSizeKB;
                    $rec->original_name = $fileNameOnly.'.'.$extensionOnly;
                    $rec->save();
                }
            }

            return response()->json(array('result' => 'success'));
        }else{
            return response()->json(array('result' => 'error'));
        }
    }

    public function postKembaliBorang(){
        //dd(request()->all());
        if(request('borang_id')){
            DB::table('borang_permit_penternakan')
            ->where('id', request()->borang_id)
            ->update(array(
                'status_borang_id' => 3,
                'dikembalikan_oleh' => Auth::user()->id,
                'sebab_dikembalikan' => request('return_remark'),
                'tarikh_dikembalikan' => Carbon::now(),
            ));
            return response()->json(array('result' => 'success'));
        }else{
            return response()->json(array('result' => 'error'));
        }
    }

    public function postSubmitPermitSemula(){
        //dd(request()->all());

        //Insert new data
        DB::table('borang_permit_penternakan')->where('id',request('borang_id'))->update(
            [
                'updated_at'=>Carbon::now(),
                'jenis_permit'=>request('jenis_permit'),
                'nama_penuh'=>request('nama_penuh'),
                'no_kp'=>request('no_kp'),
                'no_tel'=>request('no_tel'),
                'alamat_kediaman'=>request('alamat_kediaman'),
                'butir_lesen_permit'=>request('butir_permit_lain'),
                'alamat_penternakan_penanaman'=>request('alamat_penternakan'),
                'saiz_kawasan'=>request('saiz'),
                'deskripsi_bangunan'=>request('deskripsi_bangunan'),
                'butir_peraturan'=>request('butir_peraturan'),
                'butir_stok'=>request('butir_stok'),
                'butir_diet'=>request('butir_diet'),
                'salinan_ramalan'=>request('salinan_ramalan'),
                'status_borang_id'=>2,
                'dikembalikan_oleh'=>null,
                'tarikh_dikembalikan'=>null,
                'sebab_dikembalikan'=>null,
        ]);

        //Save attachment
        //check if contain file
        if(request()->hasFile('petaFile')){
            $file = request()->file('petaFile');

            foreach($file as $f){
                $fileNameWithExt = $f->getClientOriginalName();
                $fileNameOnly = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                $extensionOnly = $f->getClientOriginalExtension();
                $fileNameToStore = $fileNameOnly.'_'.time().'.'.$extensionOnly;
                $fileSizeKB = round(($f->getSize())/1000,2);

                $path = $f->storeAs('public/failpermitpenternakan', $fileNameToStore);

                //Save file path to DB
                $rec = new FailPermitPenternakan;
                $rec->borang_id = request('borang_id');
                $rec->file_name = $path;
                $rec->file_size = $fileSizeKB;
                $rec->original_name = $fileNameOnly.'.'.$extensionOnly;
                $rec->save();
            }
        }

        return response()->json(array('result'=>'success','borang_id'=>request('borang_id')));
    }

    public function postApprove(){
        //dd(request()->all());
        if(request('borang_id')){
            DB::table('borang_permit_penternakan')
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
            DB::table('borang_permit_penternakan')
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

    public function postUpdateResitAm(){
        // dd(request()->all());
        $permitNumber = "";
        if(request('no_permit')){
            $permitNumber = request('no_permit');
        }else{
            $kod = PejabatPembayaran::where('id','=',request('pejabat_pembayaran_id'))->first();
            $permitNumber = PermitLicenseNumber::GenerateLicenseNumber($kod->kod, "3", "1", "3", request('borang_id_resitam'));
        }

        $tarikh_resit = request('tarikh_resit');
        $tarikh_resit_formatted = (($tarikh_resit) ? Carbon::createFromFormat('d/m/Y',$tarikh_resit)->format('Y-m-d') : null);

        $tarikh_berkuatkuasa = null;
        $result = DB::table("borang_permit_penternakan")->select('tarikh_berkuatkuasa','tarikh_diluluskan')->where('id',request('borang_id_resitam'))->first();
        if($result){

            if($result->tarikh_diluluskan){
                $tarikh_berkuatkuasa = $result->tarikh_diluluskan;
                $tarikh_tamat = date('Y-m-d', strtotime($result->tarikh_diluluskan. ' + '.request('tempoh_permit').' years'));

                DB::table('borang_permit_penternakan')
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
            $rec->permit_type_id = 3;
            $rec->permit_id = request('borang_id_resitam');
            $rec->no_lesen = $permitNumber;
            $rec->save();
        }else{//insert
            $rec = new ResitAm;
            $rec->no_resit = request('no_resit');
            $rec->tarikh_resit = $tarikh_resit_formatted;
            $rec->jumlah_rm = request('jumlah_rm');
            $rec->pejabat_pembayaran_id = request('pejabat_pembayaran_id');
            $rec->permit_type_id = 3;
            $rec->permit_id = request('borang_id_resitam');
            $rec->no_lesen = $permitNumber;
            $rec->save();

            $resit_id = DB::getPdo()->lastInsertId();

            DB::table('borang_permit_penternakan')
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

    public function postUploadPermitFile(){
        // dd(request()->all());

        if(request()->hasFile('permitFile')){
            $file = request()->file('permitFile');

            foreach($file as $f){
                $fileNameWithExt = $f->getClientOriginalName();
                $fileNameOnly = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                $extensionOnly = $f->getClientOriginalExtension();
                $fileNameToStore = $fileNameOnly.'_'.time().'.'.$extensionOnly;
                $fileSizeKB = round(($f->getSize())/1000,2);

                $path = $f->storeAs('public/permit', $fileNameToStore);

                //Save file path to DB
                $rec = new FailPermit;
                $rec->borang_id = request('borang_id_permit');
                $rec->file_name = $path;
                $rec->file_size = $fileSizeKB;
                $rec->original_name = $fileNameOnly.'.'.$extensionOnly;
                $rec->save();

                $permit_id = DB::getPdo()->lastInsertId();

                DB::statement("UPDATE borang_permit_penternakan SET permit_file_id=? WHERE id=?",[$permit_id,request('borang_id_permit')]);
            }
        }

        $borang = collect($this->BorangView());
        if(Auth::user()->role == 'client'){
            $result = $borang->where('created_by','=',Auth::user()->id);
        }else{
            $result = $borang->where('id', '>', 0);
        }

        return response()->json(array('result' => $result));
    }

    //Note: Not to be confused with deletePermitFile function. this one is for the approve permit file
    public function deleteUserPermitFile(){
        //dd(request()->all());
        $rec = FailPermit::find(request('file_id'));

        //delete from disk storage
        Storage::delete($rec->file_name);

        //delete from database
        $rec->delete();

        DB::table('borang_permit_penternakan')->where('permit_file_id',request('file_id'))->update(['permit_file_id'=>null]);

        $borang = collect($this->BorangView());
        if(Auth::user()->role == 'client'){
            $result = $borang->where('created_by','=',Auth::user()->id);
        }else{
            $result = $borang->where('id', '>', 0);
        }

        return response()->json(array('result' => $result));
    }

    public function downloadFile($file_id = ''){
        ini_set('memory_limit','1048M');
        $result = DB::table('fail_permit')->where('id',$file_id)->first();
        $filename = pathinfo($result->file_name);

        $file_path = storage_path() . "/app/public/permit/" . $filename['basename'];
        $headers = array(
            'Content-Disposition: attachment; filename=' . $filename['basename'],
        );

        if (file_exists($file_path)) {
            return \Response::download($file_path, $filename['basename'], $headers);
        } else {
            exit('Requested file does not exist on our server!');
        }
    }

    public function postRenewPermit(){
        //dd(request()->all());
        //Clear related fields
        DB::table('borang_permit_penternakan')
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

    public function postDeletePermit(){
        //dd(request()->all());

        //Delete borang only. Don't delete all attachment and files
        $rec = BorangPermitPenternakan::find(request("borang_id"));
        $rec->delete();

        $borang = collect($this->BorangView());
        if(Auth::user()->role == 'client'){
            $result = $borang->where('created_by','=',Auth::user()->id);
        }else{
            $result = $borang->where('id', '>', 0);
        }

        return response()->json(array('result' => $result));
    }

    public function downloadLaporanSite($file_id = ''){
        // dd($file_id);
        ini_set('memory_limit','1048M');
        $result = DB::table('laporan_site_inspection')->where('id',$file_id)->first();
        $filename = pathinfo($result->file_name);

        $file_path = storage_path() . "/app/public/permitpenternakan/" . $filename['basename'];
        $headers = array(
            'Content-Disposition: attachment; filename=' . $filename['basename'],
        );

        if (file_exists($file_path)) {
            return \Response::download($file_path, $filename['basename'], $headers);
        } else {
            exit('Requested file does not exist on our server!');
        }
    }

    public function deleteLaporanSite($id){
        //dd($id);
        $rec = LaporanSiteInspection::find($id);
        $borangID = $rec->borang_id;
        $permit_url = "/permit/penternakan/view/".$borangID;

        //delete from disk storage
        Storage::delete($rec->file_name);

        //delete from database
        $rec->delete();

        return redirect($permit_url);
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\Models\BorangPermitPenternakan;
use App\Models\BorangPermitPeniagaDaging;
use App\Models\BorangPermitPeniagaHaiwan;
use App\Models\BorangPermitPeniagaTumbuhan;
use App\Models\BorangPermitBawaKeluar;
use App\Models\BorangPermitBawaMasuk;
use App\Models\BorangPermitHaiwanTawanan;
use App\Models\BorangLesen;
use App\Models\BorangLesenTumbuhan;
use App\Models\ResitAm;
use App\Models\ButirHaiwanTumbuhan;
use Carbon\Carbon;
use DB;

class PDFController extends Controller
{

    public function generatePDF(){
        $data = [
            'title' => 'Welcome to SLP V2',
            'date' => date('m/d/Y')
        ];

        $pdf = PDF::loadView('mypdf', $data);

        return $pdf->download('mypdftest.pdf');
    }

    public function generatePdfPenternakanPenanaman($id){
        $arr = explode('&',$id);
        $permitId = $arr[0];
        $resitAmId = $arr[1];

        // dd($arr);

        $borang = BorangPermitPenternakan::find($permitId);
        $resit = ResitAm::where('id',$resitAmId)->first();
        $listHaiwanTumbuhan = ButirHaiwanTumbuhan::where('borang_permit_penternakan_id',$permitId)->get();
        $tarikhResit = Carbon::createFromFormat('Y-m-d', $resit->tarikh_resit)->format('d/m/Y');

        // dd($borang);
        $data = [
            'nama' => $borang->nama_penuh,
            'ic' => $borang->no_kp,
            'alamat' => $borang->alamat_kediaman,
            'no_tel' => $borang->no_tel,
            'jenis' => $borang->jenis_permit,
            'alamat_penternakan_penanaman' => $borang->alamat_penternakan_penanaman,
            'jumlah_rm' => $resit->jumlah_rm,
            'tarikh_resit' => $tarikhResit,
            'no_permit' => $resit->no_lesen,
            'sah_sehingga' => Carbon::createFromFormat('Y-m-d', $borang->tarikh_tamat_tempoh)->format('d/m/Y'),
            'list' => $listHaiwanTumbuhan,
        ];

        // dd($borang->all());

        $pdf = PDF::loadView('permit_pdf.penternakan_penanaman', $data);

        return $pdf->stream('permit_'.time().'.pdf');

    }

    public function generatePdfPeniaga($type,$id){
        // dd("Type: $type ID: $id");

        $arr = explode('&', $id);
        $permitId = $arr[0];
        $resitAmId = $arr[1];

        switch ($type) {
            case 'haiwan':
                $borang = BorangPermitPeniagaHaiwan::find($permitId);
                break;
            case 'daging':
                $borang = BorangPermitPeniagaDaging::find($permitId);
                break;
            case 'tumbuhan':
                $borang = BorangPermitPeniagaTumbuhan::find($permitId);
                break;
            default:
                echo "<h3>Error generating permit file. Please consult system administrator!</h3>";
                return;
                break;
        }

        $resit = ResitAm::where('id',$resitAmId)->first();
        $tarikhLulus = Carbon::createFromFormat('Y-m-d', $resit->tarikh_resit)->format('d/m/Y');

        // dd($borang);
        $data = [
            'nama' => $borang->nama,
            'ic' => $borang->no_kp,
            'alamat_pemohon' => $borang->alamat,
            'alamat_premis' => $borang->alamat_premis,
            'tarikh_diluluskan' => $tarikhLulus,
            'no_permit' => $resit->no_lesen,
        ];

        // dd($data);

        switch ($type) {
            case 'haiwan':
                $pdf = PDF::loadView('permit_pdf.perniagaan_haiwan', $data);
                break;
            case 'daging':
                $pdf = PDF::loadView('permit_pdf.perniagaan_daging', $data);
                break;
            case 'tumbuhan':
                $pdf = PDF::loadView('permit_pdf.perniagaan_tumbuhan', $data);
                break;
            default:
                echo "<h3>Error generating permit file. Please consult system administrator!</h3>";
                return;
                break;
        }

        return $pdf->stream('permit_'.time().'.pdf');
    }

    public function generatePdfBawaKeluar($id){
        $arr = explode('&',$id);
        $permitId = $arr[0];
        $resitAmId = $arr[1];

        // dd($arr);

        $borang = BorangPermitBawaKeluar::find($permitId);
        $resit = ResitAm::where('id',$resitAmId)->first();
        $listBawaKeluarHidup = DB::select(DB::raw("SELECT
            s.id,
            s.borang_id,
            hidupan_liar.NAMA_TEMPATAN AS spesis,
            s.bilangan,
            s.berat,
            s.tanda,
            j.jenis
        FROM
            senarai_dibawa_keluar AS s
            LEFT JOIN hidupan_liar ON s.spesis_id = hidupan_liar.ID
            LEFT JOIN jenis_dibawa_keluar AS j ON s.jenis_dibawa_keluar_id = j.id
        WHERE
            s.jenis_dibawa_keluar_id IN (1,3) AND s.borang_id=$permitId"));
        $listBawaKeluarHasil = DB::select(DB::raw("SELECT
            s.id,
            s.borang_id,
            hidupan_liar.NAMA_TEMPATAN AS spesis,
            s.bilangan,
            s.berat,
            s.tanda,
            j.jenis
        FROM
            senarai_dibawa_keluar AS s
            LEFT JOIN hidupan_liar ON s.spesis_id = hidupan_liar.ID
            LEFT JOIN jenis_dibawa_keluar AS j ON s.jenis_dibawa_keluar_id = j.id
        WHERE
            s.jenis_dibawa_keluar_id IN (2,4) AND s.borang_id=$permitId"));

        $tarikhResit = Carbon::createFromFormat('Y-m-d', $resit->tarikh_resit)->format('d/m/Y');

        // dd($borang->all());
        $data = [
            'nama' => $borang->nama,
            'ic' => $borang->no_kp,
            'alamat' => $borang->alamat,
            'no_tel' => $borang->no_tel_hp,
            'jumlah_rm' => $resit->jumlah_rm,
            'tarikh_resit' => $tarikhResit,
            'no_permit' => $resit->no_lesen,
            'sah_sehingga' => Carbon::createFromFormat('Y-m-d H:i:s', $borang->tarikh_tamat_tempoh)->format('d/m/Y'),
            'listHidup' => $listBawaKeluarHidup,
            'listHasil' => $listBawaKeluarHasil,
        ];

        // dd($data);

        $pdf = PDF::loadView('permit_pdf.permit_bawa_keluar', $data);

        return $pdf->stream('permit_'.time().'.pdf');
    }

    public function generatePdfBawaMasuk($id){
        $arr = explode('&',$id);
        $permitId = $arr[0];
        $resitAmId = $arr[1];

        // dd($arr);

        $borang = BorangPermitBawaMasuk::find($permitId);
        $resit = ResitAm::where('id',$resitAmId)->first();
        $listBawaMasukHidup = DB::select(DB::raw("SELECT
            s.id,
            s.borang_id,
            hidupan_liar.NAMA_TEMPATAN AS spesis,
            s.bilangan,
            j.jenis
        FROM
            senarai_dibawa_masuk AS s
            LEFT JOIN hidupan_liar ON s.spesis_id = hidupan_liar.ID
            LEFT JOIN jenis_dibawa_masuk AS j ON s.jenis_dibawa_masuk_id = j.id
        WHERE
            s.jenis_dibawa_masuk_id IN (1,3) AND s.borang_id=$permitId"));
        $listBawaMasukHasil = DB::select(DB::raw("SELECT
            s.id,
            s.borang_id,
            hidupan_liar.NAMA_TEMPATAN AS spesis,
            s.bilangan,
            j.jenis
        FROM
        senarai_dibawa_masuk AS s
            LEFT JOIN hidupan_liar ON s.spesis_id = hidupan_liar.ID
            LEFT JOIN jenis_dibawa_masuk AS j ON s.jenis_dibawa_masuk_id = j.id
        WHERE
            s.jenis_dibawa_masuk_id IN (2,4) AND s.borang_id=$permitId"));

        $tarikhResit = Carbon::createFromFormat('Y-m-d', $resit->tarikh_resit)->format('d/m/Y');

        // dd($borang);
        $data = [
            'nama' => $borang->nama,
            'ic' => $borang->no_kp,
            'alamat' => $borang->alamat,
            'no_tel' => $borang->no_tel_hp,
            'jumlah_rm' => $resit->jumlah_rm,
            'tarikh_resit' => $tarikhResit,
            'no_permit' => $resit->no_lesen,
            'sah_sehingga' => Carbon::createFromFormat('Y-m-d H:i:s', $borang->tarikh_tamat_tempoh)->format('d/m/Y'),
            'listHidup' => $listBawaMasukHidup,
            'listHasil' => $listBawaMasukHasil,
        ];

        // dd($data);

        $pdf = PDF::loadView('permit_pdf.permit_bawa_masuk', $data);

        return $pdf->stream('permit_'.time().'.pdf');
    }

    public function generatePdfTawanan($id){
        $arr = explode('&',$id);
        $permitId = $arr[0];
        $resitAmId = $arr[1];

        // dd($arr);

        $borang = BorangPermitHaiwanTawanan::find($permitId);
        $resit = ResitAm::where('id',$resitAmId)->first();
        $listTawanan = DB::select(DB::raw("SELECT
            s.id,
            s.borang_id,
            hidupan_liar.NAMA_TEMPATAN AS haiwan,
            hidupan_liar.NAMA_SAINTIFIK AS spesis,
            s.bilangan
        FROM
            senarai_spesis_tawanan AS s
            LEFT JOIN hidupan_liar ON s.spesis_id = hidupan_liar.ID
        WHERE
            s.borang_id = $permitId"));

        $tarikhResit = Carbon::createFromFormat('Y-m-d', $resit->tarikh_resit)->format('d/m/Y');

        // dd($borang);
        $data = [
            'nama' => $borang->nama,
            'ic' => $borang->no_kp,
            'alamat' => $borang->alamat,
            'no_tel' => $borang->no_tel_hp,
            'jumlah_rm' => $resit->jumlah_rm,
            'tarikh_resit' => $tarikhResit,
            'no_permit' => $resit->no_lesen,
            'sah_sehingga' => Carbon::createFromFormat('Y-m-d H:i:s', $borang->tarikh_tamat_tempoh)->format('d/m/Y'),
            'list' => $listTawanan,
        ];

        // dd($data);

        $pdf = PDF::loadView('permit_pdf.permit_tawanan', $data);

        return $pdf->stream('permit_'.time().'.pdf');
    }

    public function generatePdfMemburu($id){
        $arr = explode('&',$id);
        $permitId = $arr[0];
        $resitAmId = $arr[1];

        // dd($arr);

        $borang = BorangLesen::find($permitId);
        $resit = ResitAm::where('id',$resitAmId)->first();
        $list = DB::select(DB::raw("SELECT
            s.id,
            s.borang_id,
            s.spesies AS spesis,
            s.kawasan,
            s.bilangan
        FROM
            spesies_dipohon AS s
        WHERE
            s.borang_id = $permitId"));
        $listKomersil = DB::select(DB::raw("SELECT
        s.id,
        s.borang_id,
        s.spesies AS spesis,
        s.kawasan,
        s.bilangan_angka_perkataan,
        s.cara_tangkapan
    FROM
        spesies_komersil AS s
    WHERE
        s.borang_id = $permitId"));

        $tarikhResit = Carbon::createFromFormat('Y-m-d', $resit->tarikh_resit)->format('d/m/Y');

        // dd($borang);


        // dd($data);
        if ($borang->jenis_lesen == 'komersil') {
            $data = [
                'nama' => $borang->nama_pemohon,
                'ic' => $borang->no_kp,
                'alamat' => $borang->alamat_kediaman,
                'no_tel' => $borang->no_tel_hp,
                'nombor_kereta' => $borang->no_pendaftaran_kereta,
                'nama_teman1' => $borang->nama_teman_1,
                'nokp_teman1' => $borang->no_kp_teman_1,
                'nama_teman2' => $borang->nama_teman_2,
                'nokp_teman2' => $borang->no_kp_teman_2,
                'nama_teman3' => $borang->nama_teman_3,
                'nokp_teman3' => $borang->no_kp_teman_3,
                'nama_teman4' => $borang->nama_teman_4,
                'nokp_teman4' => $borang->no_kp_teman_4,
                'jumlah_rm' => $resit->jumlah_rm,
                'tarikh_resit' => $tarikhResit,
                'no_permit' => $resit->no_lesen,
                'sah_sehingga' => Carbon::createFromFormat('Y-m-d H:i:s', $borang->tarikh_tamat_tempoh)->format('d/m/Y'),
                'list' => $list,
            ];
            $pdf = PDF::loadView('permit_pdf.lesen_komersil', $data);
        } else {
            $data = [
                'nama' => $borang->nama_pemohon,
                'ic' => $borang->no_kp,
                'alamat' => $borang->alamat_kediaman,
                'no_tel' => $borang->no_tel_hp,
                'jumlah_rm' => $resit->jumlah_rm,
                'tarikh_resit' => $tarikhResit,
                'no_permit' => $resit->no_lesen,
                'sah_sehingga' => Carbon::createFromFormat('Y-m-d H:i:s', $borang->tarikh_tamat_tempoh)->format('d/m/Y'),
                'list' => $list,
            ];
            $pdf = PDF::loadView('permit_pdf.lesen_sukan', $data);
        }

        return $pdf->stream('permit_'.time().'.pdf');
    }

    public function generatePdfTumbuhan($id){
        $arr = explode('&',$id);
        $permitId = $arr[0];
        $resitAmId = $arr[1];

        // dd($arr);

        $borang = BorangLesenTumbuhan::find($permitId);
        $resit = ResitAm::where('id',$resitAmId)->first();
        $list = DB::select(DB::raw("SELECT
            s.id,
            s.borang_id,
            s.spesies AS spesis,
            s.kawasan,
            s.bilangan
        FROM
            spesies_dipohon_tumbuhan AS s
        WHERE
            s.borang_id = $permitId"));

        $tarikhResit = Carbon::createFromFormat('Y-m-d', $resit->tarikh_resit)->format('d/m/Y');

        $data = [
            'nama' => $borang->nama_pemohon,
            'ic' => $borang->no_kp,
            'alamat' => $borang->alamat_kediaman,
            'no_tel' => $borang->no_tel_hp,
            'jumlah_rm' => $resit->jumlah_rm,
            'tarikh_resit' => $tarikhResit,
            'no_permit' => $resit->no_lesen,
            'sah_sehingga' => Carbon::createFromFormat('Y-m-d H:i:s', $borang->tarikh_tamat_tempoh)->format('d/m/Y'),
            'list' => $list,
        ];
        $pdf = PDF::loadView('permit_pdf.lesen_tumbuhan', $data);

        return $pdf->stream('permit_'.time().'.pdf');
    }
}

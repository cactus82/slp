<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\SoalanEPHL;

class SoalanEphlSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['soalan_ephl'=>'Nyatakan kaedah memburu yang dibenarkan dibawah EPHL 1997.', 'jawapan'=>'Menggunakan senjata api yang dilesenkan.', 'created_at'=>Carbon::now()],
            ['soalan_ephl'=>'Adakah anda dibenarkan untuk memburu di kawasan yang tidak dinyatakan dalam lesen?', 'jawapan'=>'Tidak', 'created_at'=>Carbon::now()],
            ['soalan_ephl'=>'Siapakah yang dibenarkan memburu dibawah lesen memburu yang dikeluarkan?', 'jawapan'=>'Pemegang lesen dan teman pemburu yang disenaraikan dalam lesen memburu.', 'created_at'=>Carbon::now()],
            ['soalan_ephl'=>'Berapakah rakan berburu dibenarkan bagi satu lesen memburu?', 'jawapan'=>'4', 'created_at'=>Carbon::now()],
            ['soalan_ephl'=>'Berapakah had umur minimum yang dibenarkan sebagai rakan berburu?', 'jawapan'=>'18 tahun', 'created_at'=>Carbon::now()],
            ['soalan_ephl'=>'Adakah lesen memburu boleh dipindah milik?', 'jawapan'=>'Tidak', 'created_at'=>Carbon::now()],
            ['soalan_ephl'=>'Bilakah lesen memburu dan lesen memungut dikira telah tamat?', 'jawapan'=>'Telah melepasi tarikh tamat tempoh atau telah mencapai kuota yang dibenarkan.', 'created_at'=>Carbon::now()],
            ['soalan_ephl'=>'Apakah borang-borang yang perlu diisi dan dihantar ke JHL setelah lesen memburu tamat?', 'jawapan'=>'Borang 5(Peraturan 28)Buku Daftar Binatang Terbunuh, Cedera dan Ditangkap, Borang 6(Peraturan 28) Kad Peluru dan Borang 7(Peraturan 28)Banci Hidupan Liar Sebelum Tamat Tempoh Memburu.', 'created_at'=>Carbon::now()],
            ['soalan_ephl'=>'Adakah lesen memburu memberi kebenaran untuk memasukki kawasan tanah persendirian?', 'jawapan'=>'Tidak', 'created_at'=>Carbon::now()],
        ];

        SoalanEPHL::insert($data);
    }
}

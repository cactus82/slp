<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\KeputusanUjian;
use Carbon\Carbon;

class KeputusanUjianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['keputusan'=>'Lulus','created_at'=>Carbon::now()],
            ['keputusan'=>'Gagal','created_at'=>Carbon::now()],
            ['keputusan'=>'Dalam Proses','created_at'=>Carbon::now()],
        ];

        KeputusanUjian::insert($data);
    }
}

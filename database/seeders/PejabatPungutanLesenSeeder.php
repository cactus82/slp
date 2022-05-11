<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PejabatPungutanLesen;
use Carbon\Carbon;

class PejabatPungutanLesenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['nama_pejabat'=>'JHL Tawau','created_at'=>Carbon::now()],
            ['nama_pejabat'=>'JHL Kota Kinabalu','created_at'=>Carbon::now()],
            ['nama_pejabat'=>'JHL Lahad Datu','created_at'=>Carbon::now()],
            ['nama_pejabat'=>'JHL Sandakan','created_at'=>Carbon::now()],
            ['nama_pejabat'=>'JHL Keningau','created_at'=>Carbon::now()],
            ['nama_pejabat'=>'JHL Beufort','created_at'=>Carbon::now()],
            ['nama_pejabat'=>'JHL Kinabatangan','created_at'=>Carbon::now()],
            ['nama_pejabat'=>'JHL Putatan','created_at'=>Carbon::now()],
        ];

        PejabatPungutanLesen::insert($data);
    }
}

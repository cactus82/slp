<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PejabatPembayaran;
use Carbon\Carbon;

class PejabatPembayaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['pejabat'=>'JHL Tawau','kod'=>'TWU','created_at'=>Carbon::now()],
            ['pejabat'=>'JHL Kota Kinabalu','kod'=>'KK','created_at'=>Carbon::now()],
            ['pejabat'=>'JHL Lahad Datu','kod'=>'LDU','created_at'=>Carbon::now()],
            ['pejabat'=>'JHL Sandakan','kod'=>'SDK','created_at'=>Carbon::now()],
            ['pejabat'=>'JHL Keningau','kod'=>'KGU','created_at'=>Carbon::now()],
            ['pejabat'=>'JHL Beufort','kod'=>'BEU','created_at'=>Carbon::now()],
            ['pejabat'=>'JHL Kinabatangan','kod'=>'KBT','created_at'=>Carbon::now()],
            ['pejabat'=>'JHL Putatan','kod'=>'PTN','created_at'=>Carbon::now()],
        ];

        PejabatPembayaran::insert($data);
    }
}

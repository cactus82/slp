<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pejabat;
use Carbon\Carbon;

class PejabatTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['pejabat' => 'Kota Kinabalu', 'kod'=>'KK', 'created_at' => Carbon::now()],
            ['pejabat' => 'Kinabatangan', 'kod'=>'KBT', 'created_at' => Carbon::now()],
            ['pejabat' => 'Keningau', 'kod'=>'KGU', 'created_at' => Carbon::now()],
            ['pejabat' => 'Lahad Datu', 'kod'=>'LDU', 'created_at' => Carbon::now()],
            ['pejabat' => 'Sandakan', 'kod'=>'SDK', 'created_at' => Carbon::now()],
            ['pejabat' => 'Tabin', 'kod'=>'TBN', 'created_at' => Carbon::now()],
            ['pejabat' => 'Tawau', 'kod'=>'TWU', 'created_at' => Carbon::now()],
            ['pejabat' => 'Pantai Barat', 'kod'=>'PB', 'created_at' => Carbon::now()],
            ['pejabat' => 'Beufort', 'kod'=>'BEU', 'created_at' => Carbon::now()],
            ['pejabat' => 'Putatan', 'kod'=>'PTN', 'created_at' => Carbon::now()],
        ];

        Pejabat::insert($data);
    }
}

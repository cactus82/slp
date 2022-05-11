<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DaerahMemburuMemungut;
use Carbon\Carbon;

class DaerahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['daerah' => 'Kota Marudu', 'created_at' => Carbon::now()],
            ['daerah' => 'Kudat', 'created_at' => Carbon::now()],
            ['daerah' => 'Pitas', 'created_at' => Carbon::now()],
            ['daerah' => 'Kota Belud', 'created_at' => Carbon::now()],
            ['daerah' => 'Kota Kinabalu', 'created_at' => Carbon::now()],
            ['daerah' => 'Papar', 'created_at' => Carbon::now()],
            ['daerah' => 'Penampang', 'created_at' => Carbon::now()],
            ['daerah' => 'Putatan', 'created_at' => Carbon::now()],
            ['daerah' => 'Ranau', 'created_at' => Carbon::now()],
            ['daerah' => 'Tuaran', 'created_at' => Carbon::now()],
            ['daerah' => 'Beufort', 'created_at' => Carbon::now()],
            ['daerah' => 'Keningau', 'created_at' => Carbon::now()],
            ['daerah' => 'Kuala Penyu', 'created_at' => Carbon::now()],
            ['daerah' => 'Nabawan', 'created_at' => Carbon::now()],
            ['daerah' => 'Sipitang', 'created_at' => Carbon::now()],
            ['daerah' => 'Tambunan', 'created_at' => Carbon::now()],
            ['daerah' => 'Tenom', 'created_at' => Carbon::now()],
            ['daerah' => 'Beluran', 'created_at' => Carbon::now()],
            ['daerah' => 'Kinabatangan', 'created_at' => Carbon::now()],
            ['daerah' => 'Sandakan', 'created_at' => Carbon::now()],
            ['daerah' => 'Telupid', 'created_at' => Carbon::now()],
            ['daerah' => 'Tongod', 'created_at' => Carbon::now()],
            ['daerah' => 'Kalabakan', 'created_at' => Carbon::now()],
            ['daerah' => 'Kunak', 'created_at' => Carbon::now()],
            ['daerah' => 'Lahad Datu', 'created_at' => Carbon::now()],
            ['daerah' => 'Semporna', 'created_at' => Carbon::now()],
            ['daerah' => 'Tawau', 'created_at' => Carbon::now()],
        ];

        DaerahMemburuMemungut::insert($data);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JenisPerniagaanHaiwan;
use Carbon\Carbon;

class JenisPerniagaanHaiwanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['jenis' => 'Restoran', 'created_at' => Carbon::now()],
            ['jenis' => 'Berdagang (Jual Beli)', 'created_at' => Carbon::now()],
            ['jenis' => 'Export / Import', 'created_at' => Carbon::now()],
        ];

        JenisPerniagaanHaiwan::insert($data);
    }
}

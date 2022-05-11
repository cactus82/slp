<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JenisDibawaMasuk;
use Carbon\Carbon;

class JenisDibawaMasukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['jenis' => 'Haiwan', 'created_at' => Carbon::now()],
            ['jenis' => 'Hasil Haiwan', 'created_at' => Carbon::now()],
            ['jenis' => 'Tumbuhan', 'created_at' => Carbon::now()],
            ['jenis' => 'Hasil Tumbuhan', 'created_at' => Carbon::now()],
        ];

        JenisDibawaMasuk::insert($data);
    }
}

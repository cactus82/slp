<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JenisDibawaKeluar;
use Carbon\Carbon;

class JenisDibawaKeluarSeeder extends Seeder
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

        JenisDibawaKeluar::insert($data);
    }
}

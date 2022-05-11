<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JenisPerniagaanDaging;
use Carbon\Carbon;

class JenisPerniagaanDagingSeeder extends Seeder
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
            ['jenis' => 'Daging Mentah', 'created_at' => Carbon::now()],
        ];

        JenisPerniagaanDaging::insert($data);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PermitType;
use Carbon\Carbon;

class PermitTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['permit_type' => 'Lesen Memburu', 'created_at' => Carbon::now()],
            ['permit_type' => 'Lesen Memungut', 'created_at' => Carbon::now()],
            ['permit_type' => 'Permit Penternakan', 'created_at' => Carbon::now()],
            ['permit_type' => 'Permit Peniaga Haiwan', 'created_at' => Carbon::now()],
            ['permit_type' => 'Permit Membawa Keluar', 'created_at' => Carbon::now()],
            ['permit_type' => 'Permit Membawa Masuk', 'created_at' => Carbon::now()],
            ['permit_type' => 'Permit Haiwan Tawanan', 'created_at' => Carbon::now()],
            ['permit_type' => 'Permit Peniaga Daging', 'created_at' => Carbon::now()],
            ['permit_type' => 'Permit Peniaga Tumbuhan', 'created_at' => Carbon::now()],
        ];

        PermitType::insert($data);
    }
}

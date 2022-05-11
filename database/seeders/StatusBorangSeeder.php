<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StatusBorang;
use Carbon\Carbon;

class StatusBorangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['id'=>1, 'status'=>'Input Pegawai', 'created_at'=>Carbon::now()],
            ['id'=>2, 'status'=>'Permohonan Baru', 'created_at'=>Carbon::now()],
            ['id'=>3, 'status'=>'Dikembalikan', 'created_at'=>Carbon::now()],
            ['id'=>4, 'status'=>'Disahkan', 'created_at'=>Carbon::now()],
            ['id'=>5, 'status'=>'Berjaya', 'created_at'=>Carbon::now()],
            ['id'=>6, 'status'=>'Tidak Berjaya', 'created_at'=>Carbon::now()],
            ['id'=>7, 'status'=>'Draft', 'created_at'=>Carbon::now()],
        ];

        StatusBorang::insert($data);
    }
}

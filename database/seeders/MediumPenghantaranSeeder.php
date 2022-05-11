<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MediumPenghantaran;
use Carbon\Carbon;

class MediumPenghantaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['medium'=>'Dibawa oleh individu','created_at'=>Carbon::now()],
            ['medium'=>'Melalui syarikat pengangkutan darat','created_at'=>Carbon::now()],
            ['medium'=>'Melalui syarikat penerbangan','created_at'=>Carbon::now()],
            ['medium'=>'Melalui kurier','created_at'=>Carbon::now()],
            ['medium'=>'Melalui syarikat perkapalan laut','created_at'=>Carbon::now()],
        ];

        MediumPenghantaran::insert($data);
    }
}

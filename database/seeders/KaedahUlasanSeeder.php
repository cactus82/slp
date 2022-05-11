<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\KaedahUlasan;
use Carbon\Carbon;

class KaedahUlasanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['kaedah'=>'Panggilan Telefon','created_at'=>Carbon::now()],
            ['kaedah'=>'fax','created_at'=>Carbon::now()],
            ['kaedah'=>'Aplikasi Mesej (SMS,WhatsApp,dll)','created_at'=>Carbon::now()],
            ['kaedah'=>'Emel','created_at'=>Carbon::now()],
            ['kaedah'=>'Lain-lain','created_at'=>Carbon::now()],
        ];

        KaedahUlasan::insert($data);
    }
}

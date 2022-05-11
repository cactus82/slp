<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(KaedahUlasanSeeder::class);
        $this->call(KeputusanUjianSeeder::class);
        $this->call(PejabatPembayaranSeeder::class);
        $this->call(PejabatPungutanLesenSeeder::class);
        $this->call(SoalanEphlSeeder::class);
        $this->call(StatusBorangSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(DaerahSeeder::class);
    }
}

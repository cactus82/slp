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
        $this->call(CountrySeeder::class);
        $this->call(DaerahSeeder::class);
        $this->call(JenisDibawaKeluarSeeder::class);
        $this->call(JenisDibawaMasukSeeder::class);
        $this->call(JenisPerniagaanDagingSeeder::class);
        $this->call(JenisPerniagaanHaiwanSeeder::class);
        $this->call(KaedahUlasanSeeder::class);
        $this->call(KeputusanUjianSeeder::class);
        $this->call(MediumPenghantaranSeeder::class);
        $this->call(PejabatPembayaranSeeder::class);
        $this->call(PejabatPungutanLesenSeeder::class);
        $this->call(PejabatTableSeeder::class);
        $this->call(PermitTypeSeeder::class);
        $this->call(SoalanEphlSeeder::class);
        $this->call(StatusBorangSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(HidupanLiarSeeder::class);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
               'name'=>'Admin',
               'ic_number'=>'12345',
               'email'=>'admin@slp.com',
               'password'=> bcrypt('admin123'),
               'role'=>'super admin'
            ],
        ];

        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}

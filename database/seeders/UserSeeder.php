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
            [
                'name'=>'Normal',
                'ic_number'=>'23456',
                'email'=>'normal@slp.com',
                'password'=> bcrypt('normal123'),
                'role'=>'normal'
            ],
            [
                'name'=>'Client',
                'ic_number'=>'34567',
                'email'=>'client@slp.com',
                'password'=> bcrypt('client123'),
                'role'=>'client'
            ],
        ];

        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}

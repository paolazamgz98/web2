<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();

        $users = array(
            ['name' => 'Paola', 'email' => 'pao.zzamora98@gmail.com', 'password' => Hash::make('paola'), 'mobile_phone' => '3312435643', 'admin' => true ],
            ['name' => 'Paola', 'email' => 'paola@gmail.com', 'password' => Hash::make('paola'), 'mobile_phone' => '3312435643', 'admin' => false ],

        );

        DB::table('users')->insert($users);
    }
}

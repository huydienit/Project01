<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class AdtechCoreUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('adtech_core_users')->insert([
            'email'      => 'ninhgio@gmail.com',
            'password'   => Hash::make('123456'),
            'first_name' => 'Ninh',
            'last_name'  => 'Nguyen Hoang',
            'salt'       => 'jAV',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            'activated'  => 1,
            'status'     => 1,
            'permission_locked'=> 1
        ]);

        DB::table('adtech_core_users')->insert([
            'email'      => 'electric@gmail.com',
            'password'   => Hash::make('123456'),
            'first_name' => 'Electric',
            'last_name'  => '',
            'salt'       => 'jAV',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            'activated'  => 1,
            'status'     => 1,
            'permission_locked'=> 0
        ]);
    }
}

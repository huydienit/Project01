<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class AdtechCoreRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('adtech_core_roles')->insert([
            'id' => 1,
            'name' => 'Super Administrator',
            'permission_locked' => 1,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            'status' => 1,
        ]);

        DB::table('adtech_core_roles')->insert([
            'id' => 2,
            'name' => 'Administrator',
            'permission_locked' => 0,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            'status' => 1,
        ]);

        DB::table('adtech_core_roles')->insert([
            'id' => 3,
            'name' => 'User',
            'permission_locked' => 0,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            'status' => 1,
        ]);
    }
}

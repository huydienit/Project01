<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class AdtechCoreUsersRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('adtech_core_users_role')->insert([
            'user_id'    => 1,
            'role_id'    => 1,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);

        DB::table('adtech_core_users_role')->insert([
            'user_id'    => 2,
            'role_id'    => 2,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
    }
}

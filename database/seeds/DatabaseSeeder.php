<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$this->call(UsersTableSeeder::class);
        $this->call(AdtechCoreUsersTableSeeder::class);
        $this->call(AdtechCoreRolesTableSeeder::class);
        $this->call(AdtechCoreAclTableSeeder::class);
        $this->call(AdtechCoreUsersRoleTableSeeder::class);
    }
}

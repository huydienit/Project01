<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdtechCoreUsersRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adtech_core_users_role', function (Blueprint $table) {
            $table->integer('user_id', false, true);
            $table->integer('role_id', false, true);
            $table->timestamps();

            //$table->foreign('user_id', 'fk_user_id')->references('user_id')->on('adtech_core_users');
            //$table->foreign('role_id', 'fk_role_id')->references('role_id')->on('adtech_core_roles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('adtech_core_users_role');
    }
}

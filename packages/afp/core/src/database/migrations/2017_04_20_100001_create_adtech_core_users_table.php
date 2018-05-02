<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdtechCoreUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adtech_core_users', function (Blueprint $table) {
            $table->increments('user_id');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('first_name', 255);
            $table->string('last_name', 255);
            $table->string('salt', 3);
            $table->tinyInteger('status')->default(1)->comment('-1: xoa, 0: dong, 1: mo');
            $table->integer('activated');
            $table->rememberToken();
            $table->timestamps();
            $table->tinyInteger('permission_locked');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('adtech_core_users');
    }
}

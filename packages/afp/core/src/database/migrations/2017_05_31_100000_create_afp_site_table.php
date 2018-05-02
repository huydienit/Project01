<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAfpSiteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('afp_site', function (Blueprint $table) {
            $table->increments('site_id');
            $table->integer('user_id', false, true);
            $table->string('sitename')->unique();
            $table->foreign('user_id')->references('user_id')->on('adtech_core_users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('afp_site');
    }
}

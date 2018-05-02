<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAfpPaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('afp_payment', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id', false, true);
            $table->integer('site_id', false, true);
            $table->date('begin');
            $table->date('end');
            $table->integer('money')->default(0);
            $table->integer('status')->default(0)->comment('0:chua thanh toan, 1:da thanh toan');
            $table->foreign('user_id')->references('user_id')->on('adtech_core_users');
            $table->foreign('site_id')->references('site_id')->on('afp_site');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}

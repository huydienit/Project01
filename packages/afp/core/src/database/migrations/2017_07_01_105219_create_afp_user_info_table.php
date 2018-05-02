<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAfpUserInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('afp_user_info', function (Blueprint $table) {
            $table->integer('user_id', false, true)->index();
            $table->integer('type')->default(2)->comment('0: ca nhan, 1: cong ty');
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('address');
            $table->string('bank_name');
            $table->string('branch_name');
            $table->string('stk');
            $table->string('cmt');
            $table->string('email_cc');
            $table->string('manager_name');
            $table->string('website');
            $table->string('sohopdong');
            $table->string('masothue');
            $table->integer('status')->default(0)->comment('0: dky, 1: xac nhan');
            $table->timestamps();
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
        //
    }
}

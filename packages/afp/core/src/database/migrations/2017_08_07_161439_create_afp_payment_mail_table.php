<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAfpPaymentMailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('afp_payment_mail', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email');
            $table->integer('type')->default(1)->comment('1: cc, 2: bcc');
            $table->integer('status')->default(0)->comment('-1: xóa, 0: đóng, 1: mở');
            $table->text('note');
            $table->text('note_pub');
            $table->timestamps();
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

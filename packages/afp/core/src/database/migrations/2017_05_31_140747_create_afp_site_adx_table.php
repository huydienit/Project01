<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAfpSiteAdxTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('afp_site_adx', function (Blueprint $table) {
            $table->integer('site_id', false, true)->index();
            $table->integer('price_sale')->default(68);
            $table->integer('status')->default(0)->comment('-1: xoa, 0: dong, 1: mo, 2: dky');
            $table->timestamps();
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
        Schema::dropIfExists('g_afp_site_adx');
    }
}

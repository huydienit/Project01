<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAfpReportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('afp_report', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('zonecpc_id', false, true);
            $table->integer('site_id', false, true);
            $table->integer('totalclick')->default(0);
            $table->integer('realclick')->default(0);
            $table->integer('impression')->default(0);
            $table->integer('pageview')->default(0);
            $table->date('date');
            $table->integer('money')->default(0);
            $table->integer('price')->default(0);
            $table->foreign('zonecpc_id')->references('zonecpc_id')->on('afp_zone_cpc');
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

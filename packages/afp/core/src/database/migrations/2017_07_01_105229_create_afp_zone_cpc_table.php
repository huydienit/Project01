<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAfpZoneCpcTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('afp_zone_cpc', function (Blueprint $table) {
            $table->increments('zonecpc_id');
            $table->integer('site_id', false, true);
            $table->integer('box_format_id', false, true);
            $table->integer('zone_template_id', false, true);
            $table->string('name');
            $table->string('notes');
            $table->integer('hidden_label')->default(0)->comment('0:ko dau, 1: dau');
            $table->integer('status')->default(1)->comment('-1: xoa, 0:dong, 1:mo');

            $table->foreign('site_id')->references('site_id')->on('afp_site');
            $table->foreign('box_format_id')->references('id')->on('afp_site_box_format');
            $table->foreign('zone_template_id')->references('id')->on('afp_site_zone_template');
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

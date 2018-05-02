<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAfpSiteInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('afp_site_info', function (Blueprint $table) {
            $table->integer('site_id', false, true)->index();
            $table->integer('site_status')->default(2)->comment('-1: xoa, 0: dong, 1: mo, 2: dky');
            $table->integer('category_id', false, true);
            $table->integer('price_sale')->default(1210);
            $table->integer('price_buy')->default(400);
            $table->string('tag_id');
            $table->integer('cpc_status')->default(1)->comment('0: dong, 1: mo');
            $table->integer('cpc_report')->default(1)->comment('0: dong, 1: mo');
            $table->integer('adx_status')->default(0)->comment('0: dong, 1: mo');
            $table->integer('adx_report')->default(0)->comment('0: dong, 1: mo');
            $table->integer('visits')->default(0);
            $table->integer('pageviews')->default(0);
            $table->string('file_ga');
            $table->timestamps();
            $table->foreign('category_id')->references('id')->on('afp_site_category');
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
        Schema::dropIfExists('g_afp_site_info');
    }
}

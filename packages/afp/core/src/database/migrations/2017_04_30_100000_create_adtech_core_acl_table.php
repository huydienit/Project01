<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdtechCoreAclTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adtech_core_acl', function (Blueprint $table) {
            $table->increments('acl_id');
            $table->integer('object_id', false, true);
            $table->enum('object_type', ['role', 'user', 'group']);
            $table->integer('allow')->nullable();
            $table->string('route_name')->nullable();
            $table->integer('route_name_crc')->nullable();
            $table->integer('created_user_id', false, true);
            $table->timestamp('created_at');
            $table->string('vendor', 255)->nullable();
            $table->string('package', 255)->nullable();
            $table->text('params')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('adtech_core_acl');
    }
}

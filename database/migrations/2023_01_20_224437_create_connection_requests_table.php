<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('connection_requests', function (Blueprint $table) {
            $table->ulid()->primary();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->text('ap_mac');
            $table->text('device_mac');
            $table->text('ssid');
            $table->text('useragent');
            $table->text('ip');
            $table->integer('code')->index();
            $table->unsignedTinyInteger('verified')->default(0);
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
        Schema::dropIfExists('connection_requests');
    }
};

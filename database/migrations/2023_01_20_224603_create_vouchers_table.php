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
        Schema::create('vouchers', function (Blueprint $table) {
            $table->ulid();
            $table->unsignedInteger('code')->unique();
            $table->unsignedBigInteger('voucher_group_id');
            $table->text('note')->nullable();
            $table->unsignedInteger('upload') ;
            $table->unsignedInteger('download') ;
            $table->unsignedInteger('limit') ;
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
        Schema::dropIfExists('vouchers');
    }
};

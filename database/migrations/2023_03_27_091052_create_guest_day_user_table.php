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
        Schema::create('guest_day_user', function (Blueprint $table) {
            $table->unsignedBigInteger('guest_day_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('host_id');
            $table->timestamps();

            $table->foreign('guest_day_id')->references('id')->on('guest_days')->cascadeOnDelete();
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('host_id')->references('id')->on('users')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('guest_day_user');
    }
};

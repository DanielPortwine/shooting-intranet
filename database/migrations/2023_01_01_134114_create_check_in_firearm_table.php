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
        Schema::create('check_in_firearm', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('check_in_id');
            $table->unsignedBigInteger('firearm_id');

            $table->foreign('check_in_id')->references('id')->on('check_ins')->cascadeOnDelete();
            $table->foreign('firearm_id')->references('id')->on('firearms')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('check_in_firearm');
    }
};

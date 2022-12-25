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
        Schema::create('target_type_scores', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('target_type_id');
            $table->string('score');
            $table->timestamps();

            $table->foreign('target_type_id')->references('id')->on('target_types')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('target_type_scores');
    }
};

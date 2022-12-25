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
        Schema::create('target_scores', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('target_id');
            $table->unsignedBigInteger('score_id');
            $table->timestamps();

            $table->foreign('target_id')->references('id')->on('targets')->cascadeOnDelete();
            $table->foreign('score_id')->references('id')->on('target_type_scores')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('target_scores');
    }
};

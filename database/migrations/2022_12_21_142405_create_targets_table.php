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
        Schema::create('targets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('visit_id')->nullable();
            $table->unsignedBigInteger('stage_id')->nullable();
            $table->unsignedBigInteger('type_id');
            $table->unsignedBigInteger('firearm_id')->nullable();
            $table->string('firearm_name')->nullable();
            $table->string('description')->nullable();
            $table->string('ammunition')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('visit_id')->references('id')->on('visits')->cascadeOnDelete();
            $table->foreign('stage_id')->references('id')->on('stages')->cascadeOnDelete();
            $table->foreign('type_id')->references('id')->on('target_types')->cascadeOnDelete();
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
        Schema::dropIfExists('targets');
    }
};

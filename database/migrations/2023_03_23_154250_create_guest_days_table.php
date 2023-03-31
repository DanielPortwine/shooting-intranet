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
        Schema::create('guest_days', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('title');
            $table->string('description')->nullable();
            $table->enum('status', ['active', 'cancelled'])->default('active');
            $table->unsignedBigInteger('recurring_guest_day_id')->nullable();
            $table->timestamps();

            $table->foreign('recurring_guest_day_id')->references('id')->on('recurring_guest_days')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('guest_days');
    }
};
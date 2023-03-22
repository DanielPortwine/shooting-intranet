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
        Schema::create('package_restrictions', function (Blueprint $table) {
            $table->unsignedBigInteger('package_id');
            $table->unsignedBigInteger('related_package_id');
            $table->enum('type', ['excluded', 'required']);

            $table->foreign('package_id')->references('id')->on('packages')->cascadeOnDelete();
            $table->foreign('related_package_id')->references('id')->on('packages')->cascadeOnDelete();
            $table->unique(['package_id', 'related_package_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('package_restrictions');
    }
};

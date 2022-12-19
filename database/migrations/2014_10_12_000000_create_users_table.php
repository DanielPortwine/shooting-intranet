<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('surname')->nullable();
            $table->string('forenames')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('home_phone')->nullable();
            $table->string('mobile_phone')->nullable();
            $table->string('address')->nullable();
            $table->string('previous_address')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('occupation')->nullable();
            $table->string('nationality')->nullable();
            $table->string('convictions')->nullable();
            $table->string('clubs')->nullable();
            $table->string('primary_club')->nullable();
            $table->string('membership_refused')->nullable();
            $table->string('qualifications')->nullable();
            $table->string('experience')->nullable();
            $table->string('fac_number')->nullable();
            $table->string('fac_force')->nullable();
            $table->date('fac_expiry')->nullable();
            $table->string('sgc_number')->nullable();
            $table->string('sgc_force')->nullable();
            $table->date('sgc_expiry')->nullable();
            $table->string('certificate_refused')->nullable();
            $table->string('certificate_prevented')->nullable();
            $table->string('identification_1')->nullable();
            $table->string('identification_2')->nullable();
            $table->string('members_known_to')->nullable();
            $table->string('member_sponsor')->nullable();
            $table->string('reference')->nullable();
            $table->boolean('section_21')->nullable();
            $table->string('signature')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->foreignId('current_connected_account_id')->nullable();
            $table->text('profile_photo_path')->nullable();
            $table->dateTime('approved_at')->nullable();
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
        Schema::dropIfExists('users');
    }
}

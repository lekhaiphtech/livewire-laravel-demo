<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('live_wire_user_infos', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->mediumText('address');
            $table->string('city');
            $table->string('country');
            $table->date('dob')->comment("User's date of birth");
            $table->date('dom')->nullable()
            ->comment("User's date of marriage. If he/she is married otherwise null meaning not yet married");
            $table->string('country_of_marriage')->nullable();
            $table->string('is_widow')->nullable();
            $table->string('is_previously_married')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('live_wire_user_infos');
    }
};

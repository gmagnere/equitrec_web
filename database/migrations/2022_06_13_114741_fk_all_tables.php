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
        Schema::table('championship_has_trials', function (Blueprint $table) {
            $table->foreign('id_trial')->references('id')->on('trials')->cascadeOnDelete();
            $table->foreign('id_championship')->references('id')->on('championships')->cascadeOnDelete();
        });

        Schema::table('evaluates', function (Blueprint $table) {
            $table->foreign('id_obstacle')->references('id')->on('obstacles')->cascadeOnDelete();
            $table->foreign('id_user')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('id_rider')->references('id')->on('riders')->cascadeOnDelete();
        });

        Schema::table('horses', function (Blueprint $table) {
            $table->foreign('id_rider')->references('id')->on('riders')->cascadeOnDelete();
        });

        Schema::table('riders', function (Blueprint $table) {
            $table->foreign('id_championship')->references('id')->on('championships')->cascadeOnDelete();
        });

        Schema::table('has_tech_levels', function (Blueprint $table) {
            $table->foreign('id_tech_level')->references('id')->on('tech_levels')->cascadeOnDelete();
            $table->foreign('id_obstacle')->references('id')->on('obstacles')->cascadeOnDelete();
        });

        Schema::table('obstacles', function (Blueprint $table) {
            $table->foreign('id_trial')->references('id')->on('trials')->cascadeOnDelete();
            $table->foreign('id_pace')->references('id')->on('paces')->cascadeOnDelete();
            $table->foreign('id_contract')->references('id')->on('contracts')->cascadeOnDelete();
            $table->foreign('id_penality')->references('id')->on('penalities')->cascadeOnDelete();
            $table->foreign('id_style')->references('id')->on('styles')->cascadeOnDelete();
        });

        Schema::table('grade_has_levels', function (Blueprint $table) {
            $table->foreign('id_grade')->references('id')->on('grades');
            $table->foreign('id_tech_level')->references('id')->on('tech_levels');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};

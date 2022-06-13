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
            $table->foreign('id_obstacle')->references('id')->on('obstacles');
            $table->foreign('id_championship')->references('id')->on('championships');
        });

        Schema::table('evaluates', function (Blueprint $table) {
            $table->foreign('id_obstacle')->references('id')->on('obstacles');
            $table->foreign('id_user')->references('id')->on('users');
            $table->foreign('id_rider')->references('id')->on('riders');
        });

        Schema::table('horses', function (Blueprint $table) {
            $table->foreign('id_rider')->references('id')->on('riders');
        });

        Schema::table('riders', function (Blueprint $table) {
            $table->foreign('id_championship')->references('id')->on('championships');
        });

        Schema::table('has_tech_levels', function (Blueprint $table) {
            $table->foreign('id_tech_level')->references('id')->on('tech_levels');
            $table->foreign('id_obstacle')->references('id')->on('obstacles');
        });

        Schema::table('obstacles', function (Blueprint $table) {
            $table->foreign('id_trial')->references('id')->on('trials');
            $table->foreign('id_pace')->references('id')->on('paces');
            $table->foreign('id_contract')->references('id')->on('contracts');
            $table->foreign('id_penality')->references('id')->on('penalities');
            $table->foreign('id_style')->references('id')->on('styles');
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

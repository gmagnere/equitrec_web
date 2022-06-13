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
        Schema::create('obstacles', function (Blueprint $table) {
            $table->id();
            $table->char('libelleObstacle', 50);
            $table->integer('noteMax')->unsigned();
            $table->integer('id_trial')->unsigned();
            $table->integer('id_pace')->unsigned();
            $table->integer('id_contract')->unsigned();
            $table->integer('id_penality')->unsigned();
            $table->integer('id_style')->unsigned();
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
        Schema::dropIfExists('obstacles');
    }
};

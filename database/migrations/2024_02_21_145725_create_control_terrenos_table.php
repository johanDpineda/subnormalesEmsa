<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateControlTerrenosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('control_terrenos', function (Blueprint $table) {
            $table->id();
            $table->string('code_macromedidor')->unique();
            $table->unsignedBigInteger('data_caminante_id')->nullable();
            $table->foreign('data_caminante_id')->references('id')->on('data_caminante');


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
        Schema::dropIfExists('control_terrenos');
    }
}

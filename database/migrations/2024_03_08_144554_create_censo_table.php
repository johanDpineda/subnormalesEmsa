<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCensoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('censo', function (Blueprint $table) {
            $table->id();


            $table->string('cedula_lider')->nullable();
            $table->string('area')->nullable();
            $table->date('fecha_censo')->nullable();

            $table->unsignedBigInteger('zona_subnormal_id')->nullable();
            $table->foreign('zona_subnormal_id')->references('id')->on('zona_subnormal');

            $table->unsignedBigInteger('municipalities_id')->nullable();
            $table->foreign('municipalities_id')->references('id')->on('municipalities');


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
        Schema::dropIfExists('censo');
    }
}

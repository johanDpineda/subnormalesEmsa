<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCodigosiecCensoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('codigosiec_censo', function (Blueprint $table) {
            $table->id();

            $table->string('codigo_siec');

            $table->unsignedBigInteger('censo_id')->nullable();
            $table->foreign('censo_id')->references('id')->on('censo');


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
        Schema::dropIfExists('codigosiec_censo');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActaRepresentanteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acta_representante', function (Blueprint $table) {
            $table->id();

            $table->string('file_name_actalider')->nullable();

            $table->unsignedBigInteger('zona_subnormal_id')->nullable();
            $table->foreign('zona_subnormal_id')->references('id')->on('zona_subnormal');
            $table->date('start_date')->nullable();


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
        Schema::dropIfExists('acta_representante');
    }
}

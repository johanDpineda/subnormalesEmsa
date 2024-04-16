<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentoCensoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documento_censo', function (Blueprint $table) {
            $table->id();


            $table->string('file_name_censo')->nullable();

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
        Schema::dropIfExists('documento_censo');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActaCodetesoreriaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acta_codetesoreria', function (Blueprint $table) {
            $table->id();

            $table->string('invoice_code');

            $table->unsignedBigInteger('zona_subnormal_id')->nullable();
            $table->foreign('zona_subnormal_id')->references('id')->on('zona_subnormal');

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
        Schema::dropIfExists('acta_codetesoreria');
    }
}

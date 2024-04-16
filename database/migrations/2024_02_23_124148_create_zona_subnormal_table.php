<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZonaSubnormalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zona_subnormal', function (Blueprint $table) {
            $table->id();
            $table->string('sector_name');
            $table->unsignedBigInteger('control_terrenos_id')->nullable();
            $table->foreign('control_terrenos_id')->references('id')->on('control_terrenos');
            $table->string('invoice_code')->nullable();
            $table->string('phone');
            $table->string('address');

            $table->unsignedBigInteger('municipios_zone_id')->nullable();
            $table->foreign('municipios_zone_id')->references('id')->on('municipalities');






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
        Schema::dropIfExists('zona_subnormal');
    }
}

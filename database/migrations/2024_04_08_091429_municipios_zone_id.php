<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MunicipiosZoneId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('zona_subnormal', function (Blueprint $table) {
            //

            $table->unsignedBigInteger('municipios_zone_id')->nullable();
            $table->foreign('municipios_zone_id')->references('id')->on('municipalities');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('zona_subnormal', function (Blueprint $table) {
            //
        });
    }
}

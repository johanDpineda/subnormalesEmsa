<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataCaminanteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_caminante', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->text('latitude');
            $table->text('longitude');
            $table->string('Cantidad_transformador');
            $table->string('Cantidad_usuario');
            $table->string('Observaciones');
            $table->unsignedBigInteger('network_status_id');
            $table->foreign('network_status_id')->references('id')->on('network_status');
            
            $table->unsignedBigInteger('role_id')->nullable();
            
            // Agregar la clave foránea que hace referencia al ID del rol del usuario en la tabla 'roles'
            $table->foreign('role_id')->references('id')->on('roles');
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
        Schema::dropIfExists('data_caminante');
    }
}

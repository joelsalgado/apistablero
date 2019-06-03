<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDireccionPrimaria extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('direccion_primaria', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('alumno_serial_id');
            $table->integer('alumno_id');
            $table->string('calle');
            $table->string('colonia');
            $table->integer('localidad_ids');
            $table->integer('codigo_postal');
            $table->string('entre_calle');
            $table->string('y_calle');
            $table->string('localidad');
            $table->integer('localidad_id');
            $table->string('municipio');
            $table->integer('municipio_id');
            $table->integer('entidad_federativa_id');
            $table->string('entidad_federativa');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}

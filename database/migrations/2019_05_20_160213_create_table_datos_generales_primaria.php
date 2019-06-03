<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDatosGeneralesPrimaria extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datos_generales_primaria', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('alumno_id');
            $table->integer('matricula');
            $table->string('nombre');
            $table->string('paterno');
            $table->string('materno');
            $table->string('sexo');
            $table->integer('nacionalidad_id');
            $table->string('nacionalidad');
            $table->integer('entidad_nacimiento_id');
            $table->string('entidad_nacimiento');
            $table->string('curp');
            $table->string('fincurp');
            $table->dateTime('fecha_nacimiento');
            $table->string('status');
            $table->string('observacion');
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

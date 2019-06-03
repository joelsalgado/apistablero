<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableAlumnosPrimaria extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumnos_primaria', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('grupo_id');
            $table->integer('alumno_id');
            $table->string('nombre');
            $table->integer('tipo_evaluacion');
            $table->float('promedio');
            $table->integer('faltas');
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

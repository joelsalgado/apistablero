<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableAlumnosSearch extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumnos_search', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('alumno_id');
            $table->string('nombre');
            $table->integer('ct_id');
            $table->string('clave');
            $table->string('escuela');
            $table->integer('grupo_id');
            $table->string('municipio');
            $table->string('localidad');
            $table->integer('nivel');
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

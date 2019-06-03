<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTutoPrimaria extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tutoprimaria', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('alumno_id');
            $table->integer('tuto_id');
            $table->string('nombre');
            $table->string('paterno');
            $table->string('materno');
            $table->string('parentesco_id');
            $table->string('nivel_academico_id');
            $table->string('nivel');
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

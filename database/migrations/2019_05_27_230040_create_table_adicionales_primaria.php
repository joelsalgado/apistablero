<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableAdicionalesPrimaria extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adicionales_primaria', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('alumno_id');
            $table->integer('alumno_serial_id');
            $table->integer('caracteristica_id');
            $table->integer('serial_car_id');
            $table->string('descripcion');
            $table->integer('colonia');
            $table->string('car_desc');
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

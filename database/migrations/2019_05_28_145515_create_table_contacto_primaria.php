<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableContactoPrimaria extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacto_primaria', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('alumno_id');
            $table->integer('alumno_serial_id');
            $table->integer('dato_web_id');
            $table->string('descripcion');
            $table->string('dato');
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

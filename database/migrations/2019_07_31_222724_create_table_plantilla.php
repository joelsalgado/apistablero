<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePlantilla extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plantilla', function (Blueprint $table) {
            $table->increments('id');
            $table->string('rfc');
            $table->string('nombre');
            $table->integer('cod_pago');
            $table->integer('uni');
            $table->string('sub_uni');
            $table->string('cat');
            $table->string('horas');
            $table->integer('plaza');
            $table->string('ct_clave');
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

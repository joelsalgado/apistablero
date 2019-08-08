<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableGeneralempleados extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general_empleados', function (Blueprint $table) {
            $table->increments('id');
            $table->string('rfc');
            $table->string('paterno');
            $table->string('materno');
            $table->string('nombre');
            $table->string('curp',20);
            $table->string('nss');
            $table->string('ent_nac');
            $table->string('sexo',10);
            $table->string('edo_civil');
            $table->string('niv_academico');
            $table->string('profesion');
            $table->integer('qna_ing_gob');
            $table->integer('qna_ing_sep');
            $table->string('cta_bancaria');
            $table->string('email');
            $table->string('cp',5);
            $table->string('estado');
            $table->string('municipio');
            $table->string('calle');
            $table->string('colonia');
            $table->string('exterior');
            $table->string('interior');
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

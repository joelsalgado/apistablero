<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCtsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('clave',12);
            $table->string('nombre',255);
            $table->string('modalidad',5);
            $table->string('tipo',30);
            $table->string('nivel',200);
            $table->string('descripcion',255);
            $table->integer('cve_mun');
            $table->string('nombre_mun',200);
            $table->integer('cve_loc');
            $table->string('localidad',200);
            $table->string('coordx',50);
            $table->string('coordy',50);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cts');
    }
}

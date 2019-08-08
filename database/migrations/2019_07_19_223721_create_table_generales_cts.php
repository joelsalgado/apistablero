<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableGeneralesCts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('generales_cts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('clave_ct');
            $table->string('nombre_ct');
            $table->string('domicilio');
            $table->string('entre_calle');
            $table->string('y_calle');
            $table->string('colonia');
            $table->integer('codigo_postal');
            $table->string('localidad');
            $table->string('municipio');
            $table->string('telefono');
            $table->string('extension');
            $table->string('fax');
            $table->string('email');
            $table->string('pagina_web');
            $table->string('serv_regional');
            $table->string('sector');
            $table->string('zona');
            $table->string('dep_adm');
            $table->string('dep_norm');
            $table->string('servicio');
            $table->string('sostenimiento');
            $table->string('director');
            $table->string('folio');
            $table->date('fecha_fun');
            $table->date('fecha_alta');
            $table->date('fecha_inic');
            $table->date('fecha_clau');
            $table->date('fecha_reap');
            $table->string('ultima_mod');

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

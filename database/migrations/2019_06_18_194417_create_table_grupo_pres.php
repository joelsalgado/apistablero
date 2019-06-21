<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableGrupoPres extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grupos_pres', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ct_id');
            $table->integer('grado_id');
            $table->integer('grupo_id');
            $table->integer('num_alu');
            $table->string('sexo',2 );
            $table->string('descripcion',5);
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

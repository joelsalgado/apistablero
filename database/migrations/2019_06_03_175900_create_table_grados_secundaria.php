<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableGradosSecundaria extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grados_secundaria', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ct_id');
            $table->integer('grado_id');
            $table->integer('grado');
            $table->integer('num_alu');
            $table->integer('turno_id');
            $table->string('turno');
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

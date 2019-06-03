<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableGradosPrimaria extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grados_primaria', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ct_id');
            $table->integer('num_alu');
            $table->integer('grado');
            $table->integer('grado_id');
            $table->string('status',2);
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

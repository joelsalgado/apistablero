<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableGradosPrescolar extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grados_prescolar', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ct_id');
            $table->integer('grado_id');
            $table->integer('grado');
            $table->integer('num_alu');
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

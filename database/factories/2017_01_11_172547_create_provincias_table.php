<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProvinciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('provincias', function (Blueprint $table) {
            Schema::enableForeignKeyConstraints();
            $table->increments('idprovincia');
            $table->string('nombre');
            $table->integer('idresponsable')->unsigned();
            $table->boolean('habilitado');
            $table->timestamps();
        });//
        Schema::table('provincias', function(Blueprint $table)
        {
            $table->foreign('idresponsable')->references('id')->on('usuarios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('provincias');
    }
}

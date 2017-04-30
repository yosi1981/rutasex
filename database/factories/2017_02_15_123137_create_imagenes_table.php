<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagenesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('imagenes', function (Blueprint $table) {
            Schema::enableForeignKeyConstraints();
            $table->increments('idimagen');
            $table->string('ficheroimagen');
            $table->string('titulo');            
            $table->integer('idusuario')->unsigned();
            $table->timestamps();
        });
        Schema::table('imagenes', function(Blueprint $table)
        {
            $table->foreign('idusuario')->references('id')->on('usuarios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        schema::drop('imagenes');
    }
}

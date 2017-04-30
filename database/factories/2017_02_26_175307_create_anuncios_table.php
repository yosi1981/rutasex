<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnunciosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anuncios', function (Blueprint $table) {
            Schema::enableForeignKeyConstraints();
            $table->increments('idanuncio');
            $table->string('titulo');
            $table->string('descripcion');
            $table->date('fechainicio');
            $table->date('fechafinal');
            $table->boolean('activo');
            $table->integer('idlocalidad')->unsigned();
            $table->integer('idusuario')->unsigned();
            $table->timestamps();
        }); //
        Schema::table('anuncios', function (Blueprint $table) {
            $table->foreign('idlocalidad')->references('idlocalidad')->on('localidades');
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
        Schema::drop('anuncios');
    }
}

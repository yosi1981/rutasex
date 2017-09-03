<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnunciosDiaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anunciosDia', function (Blueprint $table) {
            Schema::enableForeignKeyConstraints();
            $table->increments('idanuncioDia');
            $table->date('fecha');
            $table->integer('idanuncio')->unsigned();
            $table->integer('idlocalidad')->unsigned();
            $table->integer('idrespprov')->unsigned();
            $table->integer('idrespprovorigen')->unsigned();
            $table->double('numvisitas');

        }); //
        Schema::table('anunciosDia', function (Blueprint $table) {
            $table->foreign('idanuncio')->references('idanuncio')->on('anuncios');
            $table->foreign('idlocalidad')->references('idlocalidad')->on('localidades');
            $table->foreign('idrespprov')->references('id')->on('usuarios');
            $table->foreign('idrespprovorigen')->references('id')->on('usuarios');
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

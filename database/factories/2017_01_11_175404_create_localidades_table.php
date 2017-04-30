<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocalidadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('localidades', function (Blueprint $table) {
            Schema::enableForeignKeyConstraints();
            $table->increments('idlocalidad');
            $table->string('nombre');
            $table->integer('idprovincia')->unsigned();
            $table->timestamps();
        });
        Schema::table('localidades', function(Blueprint $table)
        {
            $table->foreign('idprovincia')->references('idprovincia')->on('provincias');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        schema::drop('localidades');
    }
}

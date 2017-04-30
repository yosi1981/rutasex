<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagos',function (blueprint $table)
        {
            $table->increments('id');
            $table->string('payerID',50);
            $table->string('paymentID',100);
            $table->integer('iduser')->unsigned();
            $table->date('fecha_pago');
            $table->integer('dias');
            $table->integer('precio');            
            $table->integer('total');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('pagos');
    }
}

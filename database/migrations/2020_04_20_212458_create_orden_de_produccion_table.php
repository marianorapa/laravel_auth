<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdenDeProduccionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orden_de_produccion', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->unsignedBigInteger('cliente');
            $table->unsignedBigInteger('producto');
            $table->float('cantidad');
            $table->float('saldo');
            $table->date('fecha_entrega');
            $table->float('precioxkilo');
            $table->Integer('destino');
            $table->unsignedBigInteger('estado');
            $table->foreign('cliente')->references('id_cliente')->on('granja');
            $table->foreign('producto')->references('id')->on('alimento');
            $table->foreign('destino')->references('id')->on('granja');
            $table->foreign('estado')->references('id')->on('estado_op');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orden_de_produccion');
    }
}

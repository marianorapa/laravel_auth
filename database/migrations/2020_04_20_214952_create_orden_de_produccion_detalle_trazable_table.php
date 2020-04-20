<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdenDeProduccionDetalleTrazableTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orden_de_produccion_detalle_trazable', function (Blueprint $table) {
            $table->unsignedBigInteger('id_op');
            $table->integer('nro_detalle');
            $table->unsignedBigInteger('cliente');
            $table->unsignedBigInteger('insumo');
            $table->integer('lote');
            $table->timestamps();
            $table->foreign('id_op')->references('id_op')->on('orden_de_produccion_detalle');
            $table->foreign('nro_detalle')->references('id')->on('orden_de_produccion_detalle');
            $table->foreign('cliente')->references('id_cliente')->on('lote_cliente');

            $table->foreign('insumo')->references('id_insumo')->on('lote_cliente');
            $table->foreign('lote')->references('nrolote')->on('lote_cliente');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orden_de_produccion_detalle_trazable');
    }
}

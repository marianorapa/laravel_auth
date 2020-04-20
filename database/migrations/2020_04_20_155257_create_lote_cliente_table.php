<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoteClienteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lote_cliente', function (Blueprint $table) {
            $table->unsignedBigInteger('id_cliente');//->primary();
            $table->unsignedBigInteger('id_insumo');//->primary();
            $table->Integer('nrolote');//->primary();
            $table->integer('saldo_real');
            $table->integer('saldo_disponible');
            $table->timestamps();
            $table->primary(['id_cliente','id_insumo','nrolote']);
            $table->foreign('id_cliente')->references('id')->on('cliente');
            $table->foreign('id_insumo')->references('id_insumo')->on('lote');
            $table->foreign('nrolote')->references('nrolote')->on('lote');
           
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lote_cliente');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventarioInsumoTrazableTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventario_insumo_trazable', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_id')->constrained('cliente');//parte de la PK
            $table->foreignId('lote_insumo_e_id')->constrained('lote_insumo_especifico');//parte de la PK
            $table->integer('saldo_real');
            $table->integer('saldo_disponible');
            $table->timestamps();
            $table->unique(['cliente_id','lote_insumo_e_id']);//PRIMARY KEY
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventario_insumo_trazable');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventarioInsumoNoTrazableTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventario_insumo_no_trazable', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_id')->constrained('cliente');//parte de la PK
            $table->foreignId('insumo_nt_id')->constrained('insumo_no_trazable');//parte de la PK
            $table->integer('saldo_real');
            $table->integer('saldo_disponible');
            $table->timestamps();
            $table->unique(['cliente_id','insumo_nt_id']);//PRIMARY KEY
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventario_insumo_no_trazable');
    }
}

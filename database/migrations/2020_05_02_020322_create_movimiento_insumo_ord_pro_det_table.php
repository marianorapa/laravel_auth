<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovimientoInsumoOrdProDetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movimiento_insumo_ord_pro_det', function (Blueprint $table) {
            $table->id();
            $table->foreignId('opd_id')->constrained('orden_de_produccion_detalle');
            $table->timestamps();
            $table->foreign('id')->references('id')->on('movimiento_insumo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movimiento_insumo_ord_pro_det');
    }
}

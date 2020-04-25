<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOpDetalleTrazableTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('op_detalle_trazable', function (Blueprint $table) {
            $table->id();
            $table->foreignId('op_detalle_id')->constrained('orden_de_produccion_detalle');
            $table->foreignId('lote_insumo_id')->constrained('inventario_insumo_trazable');
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
        Schema::dropIfExists('op_detalle_trazable');
    }
}

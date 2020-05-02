<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovimientoProductoOrdProTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movimiento_producto_ord_pro', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ord_pro_id')->constrained('orden_de_produccion');
            $table->timestamps();
            $table->foreign('id')->references('id')->on('movimiento_producto');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movimiento_producto_ord_pro');
    }
}

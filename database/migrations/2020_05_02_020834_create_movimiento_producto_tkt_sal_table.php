<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovimientoProductoTktSalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movimiento_producto_tkt_sal', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tkt_sal_id')->constrained('ticket_salida');
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
        Schema::dropIfExists('movimiento_producto_tkt_sal');
    }
}

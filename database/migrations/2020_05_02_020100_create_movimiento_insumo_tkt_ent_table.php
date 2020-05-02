<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovimientoInsumoTktEntTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movimiento_insumo_tkte', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ticket_id')->constrained('ticket_entrada');
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
        Schema::dropIfExists('movimiento_insumo_tkte');
    }
}

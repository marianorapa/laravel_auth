<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrestamoDevolucionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prestamo_devoluciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('prestamo_id')->constrained('prestamo_cliente');
            $table->foreignId('ticket_entrada_id')->constrained('ticket_entrada_insumo_no_trazable');
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
        Schema::dropIfExists('prestamo_devoluciones');
    }
}

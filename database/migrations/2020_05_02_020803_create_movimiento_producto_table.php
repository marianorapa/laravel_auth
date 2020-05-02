<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovimientoProductoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movimiento_producto', function (Blueprint $table) {
            $table->id();
            $table->foreignId('producto_id')->constrained('alimento');
            $table->integer('cantidad');
            $table->timestamps();
            $table->foreign('id')->references('id')->on('movimiento');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movimiento_producto');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovimientoCapacidadProductivaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movimiento_capacidad_productiva', function (Blueprint $table) {
            $table->id();
            $table->date('dia');
            $table->integer('cantidad');
            $table->foreignId('ord_pro_id')->constrained('orden_de_produccion');
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
        Schema::dropIfExists('movimiento_capacidad_productiva');
    }
}

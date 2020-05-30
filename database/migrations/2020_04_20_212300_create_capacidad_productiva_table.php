<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCapacidadProductivaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('capacidad_productiva', function (Blueprint $table) {
            $table->id();
            $table->integer('capacidad')->nullable(false);
            $table->date('fecha_desde')->nullable(false)->default(now());
            $table->date('fecha_hasta')->nullable();
            $table->foreignId('prioridad_id')->constrained('nivel_prioridad');
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
        Schema::dropIfExists('capacidad_productiva');
    }
}

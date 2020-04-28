<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInsumoEspecificoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('insumo_especifico', function (Blueprint $table) {
            $table->string('gtin')->primary();
            $table->string('descripcion');
            $table->foreignId('insumo_trazable_id')->constrained('insumo_trazable');
            $table->foreignId('proveedor_id')->constrained('proveedor');
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
        Schema::dropIfExists('insumo_especifico');
    }
}

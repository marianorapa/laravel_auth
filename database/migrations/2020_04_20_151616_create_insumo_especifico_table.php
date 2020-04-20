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
            $table->unsignedBigInteger('id_insumo');
            $table->string('descr');
            $table->unsignedBigInteger('id_proveedor');
            $table->timestamps();
            $table->foreign('id_insumo')->references('id')->on('insumo_trazable');
            $table->foreign('id_proveedor')->references('id')->on('proveedor');
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

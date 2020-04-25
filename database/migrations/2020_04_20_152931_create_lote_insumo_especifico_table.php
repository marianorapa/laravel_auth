<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoteInsumoEspecificoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lote_insumo_especifico', function (Blueprint $table) {
            $table->id();
            $table->string('insumo_especifico');//parte de la PK
            $table->integer('nro_lote')->unsigned();//parte de la PK
            $table->date('fecha_elaboracion');
            $table->date('fecha_vencimiento');
            $table->timestamps();
            $table->unique(['insumo_especifico','nro_lote']);//PRIMARY KEY
            $table->foreign('insumo_especifico')->references('gtin')->on('insumo_especifico');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lote_insumo_especifico');
    }
}

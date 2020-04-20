<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lote', function (Blueprint $table) {
            $table->integer('nrolote')->unsigned();
            $table->unsignedBigInteger('id_insumo');
            $table->date('fecha_elaboracion');
            $table->date('fecha_vencimiento');
            $table->timestamps();
            $table->primary(['nrolote','id_insumo']);
            $table->foreign('id_insumo')->references('id_insumo')->on('insumo_especifico');

            
        });
        DB::statement('ALTER TABLE lote MODIFY nrolote INTEGER NOT NULL AUTO_INCREMENT');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lote');
    }
}

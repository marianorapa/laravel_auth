<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormulaComposicionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('formula_composicion', function (Blueprint $table) {
            $table->unsignedBigInteger('id_alimento');
            $table->unsignedBigInteger('nro_formula');
            $table->unsignedBigInteger('id_insumo');
            $table->float('proporcion');
            $table->primary(['id_alimento','nro_formula','id_insumo']);
            $table->foreign('id_alimento')->references('id_alimento')->on('alimento_formula');
            $table->foreign('nro_formula')->references('id')->on('alimento_formula');
            $table->foreign('id_insumo')->references('id')->on('insumo');

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
        Schema::dropIfExists('formula_composicion');
    }
}

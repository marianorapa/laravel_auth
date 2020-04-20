<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlimentoFormulaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alimento_formula', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_alimento');
            $table->date('fecha_desde');
            $table->date('fecha_hasta');
            $table->timestamps();
            $table->foreign('id_alimento')->references('id')->on('alimento');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alimento_formula');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlimentoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alimento', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tipo');
            $table->unsignedBigInteger('cliente');
            $table->string('gtin');
            $table->timestamps();
            $table->foreign('tipo')->references('id')->on('alimento_tipo');
            $table->foreign('cliente')->references('id')->on('cliente');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alimento');
    }
}

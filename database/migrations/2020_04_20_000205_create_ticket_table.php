<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_hora');
            $table->unsignedBigInteger('id_transportista');
            $table->string('patente');
            $table->unsignedBigInteger('id_chofer');
            $table->unsignedBigInteger('bruto');
            $table->unsignedBigInteger('tara');
            $table->float('neto');
            $table->unsignedBigInteger('estado');
            $table->timestamps();
            $table->foreign('id_transportista')->references('id')->on('transportista');
            $table->foreign('id_chofer')->references('id')->on('chofer');
            $table->foreign('bruto')->references('id')->on('pesaje');
            $table->foreign('tara')->references('id')->on('pesaje');
            $table->foreign('estado')->references('id')->on('estado_ticket');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ticket');
    }
}

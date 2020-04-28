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
            //$table->date('fecha_hora');
            $table->foreignId('transportista_id')->constrained('transportista');
            $table->string('patente');
            $table->foreignId('chofer_id')->constrained('chofer');
            $table->foreignId('bruto')->constrained('pesaje');
            $table->foreignId('tara')->constrained('pesaje');
            $table->integer('neto');
            $table->foreignId('estado')->constrained('estado_ticket');
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
        Schema::dropIfExists('ticket');
    }
}
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketSalidaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_salida', function (Blueprint $table) {
            $table->id();
            $table->foreignId('op_id')->constrained('orden_de_produccion');
            $table->timestamps();
            $table->foreign('id')->references('id')->on('ticket');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ticket_salida');
    }
}

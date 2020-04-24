<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRemitoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('remito', function (Blueprint $table) {
            $table->id();
            $table->integer('punto_venta');
            $table->integer('numero');
            $table->foreignId('ticket_id')->constrained('ticket_salida');
            $table->string('cot');
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
        Schema::dropIfExists('remito');
    }
}

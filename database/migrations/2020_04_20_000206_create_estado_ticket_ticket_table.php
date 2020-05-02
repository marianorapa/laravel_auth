<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstadoTicketTicketTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estado_ticket_ticket', function (Blueprint $table) {
            $table->id();
            $table->foreignId('estado_id')->constrained('estado_ticket');//parte de la PK
            $table->foreignId('ticket_id')->constrained('ticket');//parte de la PK
            $table->foreignId('user_id')->constrained('users');
            $table->timestamps();
            $table->unique(['estado_id', 'ticket_id']);//PRIMARY KEY
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estado_ticket_ticket');
    }
}

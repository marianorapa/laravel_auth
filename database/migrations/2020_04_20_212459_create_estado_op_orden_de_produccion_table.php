<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstadoOpOrdenDeProduccionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estado_op_orden_de_produccion', function (Blueprint $table) {
            $table->id();
            $table->foreignId('estado_id')->constrained('estado_ord_pro');//parte de la PK
            $table->foreignId('ord_pro_id')->constrained('orden_de_produccion');//parte de la PK
            $table->foreignId('user_id')->constrained('users');
            $table->timestamps();
            $table->unique(['estado_id', 'ord_pro_id']);//PRIMARY KEY
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estado_op_orden_de_produccion');
    }
}

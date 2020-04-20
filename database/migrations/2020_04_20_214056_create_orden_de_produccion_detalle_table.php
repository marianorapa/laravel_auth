<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdenDeProduccionDetalleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orden_de_produccion_detalle', function (Blueprint $table) {
            $table->integer('id');
            $table->unsignedBigInteger('id_op');
            $table->float('cantidad');
            $table->timestamps();
            $table->foreign('id_op')->references('id')->on('orden_de_produccion');
            $table->primary(['id','id_op']);
        });
        DB::statement('ALTER TABLE orden_de_produccion_detalle MODIFY id INTEGER NOT NULL AUTO_INCREMENT');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orden_de_produccion_detalle');
    }
}

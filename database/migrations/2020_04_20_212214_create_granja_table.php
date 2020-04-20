<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGranjaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('granja', function (Blueprint $table) {
            $table->integer('id');
            $table->unsignedBigInteger('id_cliente');
            $table->string('descr');
            $table->unsignedBigInteger('domicilio');
            $table->timestamps();
            $table->foreign('id_cliente')->references('id')->on('cliente');
            $table->foreign('domicilio')->references('id')->on('domicilio');
            $table->primary(['id','id_cliente']);
        });
        DB::statement('ALTER TABLE granja MODIFY id INTEGER NOT NULL AUTO_INCREMENT');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('granja');
    }
}

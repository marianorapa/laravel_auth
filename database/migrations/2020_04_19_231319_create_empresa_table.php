<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpresaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresa', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tipo_documento_empresa');
            $table->integer('nro_documento_empresa');
            $table->string('denominacion');
            $table->unsignedBigInteger('domicilio_fiscal');
            $table->string('telefono_contacto_persona');
            $table->string('email');
            $table->timestamps();
            $table->foreign('tipo_documento_empresa')->references('id')->on('tipo_documento');
            $table->foreign('domicilio_fiscal')->references('id')->on('domicilio');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empresa');
    }
}

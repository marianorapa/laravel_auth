<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personas', function (Blueprint $table) {
            $table->id();
            $table->string('apellidos');
            $table->string('nombres');
            $table->string('tipoDoc');
            $table->string('nroDocumento');
            $table->string('descripcion');
            $table->string('domicilio');//en el doc esta como que todavia no sabemos si va como tabla, puede ser ina fk
            $table->date('fechaNacimiento');
            $table->string('telefono');
//            $table->boolean('activo');
            $table->softDeletes();
            $table->timestamps();
            $table->unique(['tipoDoc','nroDocumento']);
            //$table->foreign('tipodoc')->references('id')->on('tipo_documento');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personas');
    }
}

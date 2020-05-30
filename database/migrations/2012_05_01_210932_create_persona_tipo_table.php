<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonaTipoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persona_tipo', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tipo_documento_id')->constrained('tipo_documento');
            $table->string('nro_documento');
            $table->foreignId('domicilio_id')->unsigned()->nullable()->constrained('domicilio');
            $table->string('telefono')->nullable();
            $table->string('email')->nullable();
            $table->string('observaciones')->nullable();;
            $table->softDeletes();
            $table->timestamps();
            $table->unique(['tipo_documento_id','nro_documento']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('persona_tipo');
    }
}

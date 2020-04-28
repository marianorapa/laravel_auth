<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormulaComposicionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('formula_composicion', function (Blueprint $table) {
            $table->id();
            $table->foreignId('formula_id')->constrained('alimento_formula');//parte de la PK
            $table->foreignId('insumo_id')->constrained('insumo');//parte de la PK
            $table->decimal('proporcion',3,2)->comment('valor 0 y 1 que define el rango personalizable del precio')->nullable(false);
            $table->timestamps();
            $table->unique(['formula_id', 'insumo_id']);//PRIMARY KEY
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('formula_composicion');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrecioFasonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('precio_fason', function (Blueprint $table) {
            $table->id();
            $table->decimal('precio_por_kilo',15,2)->nullable(false);
            $table->decimal('variacion_admitida',3,2)->comment('valor 0 y 1 que define el rango personalizable del precio')->nullable(false);
            $table->date('fecha_desde')->nullable(false)->default(now());
            $table->date('fecha_hasta')->nullable();
            $table->foreignId('prioridad_id')->constrained('nivel_prioridad');
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
        Schema::dropIfExists('precio_fason');
    }
}

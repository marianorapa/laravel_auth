<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdenDeProduccionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orden_de_produccion', function (Blueprint $table) {
            $table->id();
            //$table->date('fecha');
            //$table->foreignId('cliente_id')->constrained('cliente');// ES REALMENTE NECESARIO??? EL ALIMENTO ES DE UN CLIENTE
            $table->foreignId('producto_id')->constrained('alimento');
            $table->integer('cantidad');
            $table->integer('saldo')->comment('cantidad - sum(ticket_salida)');
            $table->date('fecha_fabricacion');
            //$table->foreignId('capacidad_traza_id')->constrained('capacidad_productiva');
            $table->decimal('precio_venta_por_kilo',15,2);
            //$table->foreignId('precio_traza_id')->constrained('precio_fason');
            $table->foreignId('destino')->constrained('granja');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orden_de_produccion');
    }
}

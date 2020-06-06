<?php

use Illuminate\Database\Seeder;

class TipoMovimientoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $tipoMov = new \App\TipoMovimiento();
        $tipoMov->descripcion = "Ingreso de insumo";
        $tipoMov->save();

        $tipoMov = new \App\TipoMovimiento();
        $tipoMov->descripcion = "Consumo de insumo en OP";
        $tipoMov->save();

        $tipoMov = new \App\TipoMovimiento();
        $tipoMov->descripcion = "Finalización de OP";
        $tipoMov->save();

        $tipoMov = new \App\TipoMovimiento();
        $tipoMov->descripcion = "Restauración de insumo de OP anulada";
        $tipoMov->save();

        $tipoMov = new \App\TipoMovimiento();
        $tipoMov->descripcion = "Devolución de insumo";
        $tipoMov->save();

        $tipoMov = new \App\TipoMovimiento();
        $tipoMov->descripcion = "Finalización de salida";
        $tipoMov->save();

        $tipoMov = new \App\TipoMovimiento();
        $tipoMov->descripcion = "Reintegro por cancelación de préstamo";
        $tipoMov->save();
    }
}

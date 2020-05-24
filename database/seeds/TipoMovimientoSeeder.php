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

    }
}

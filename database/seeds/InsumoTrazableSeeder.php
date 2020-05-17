<?php

use Illuminate\Database\Seeder;

class InsumoTrazableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $insumo = new \App\Insumo();

        $insumo->descripcion = 'Acidificante';

        $insumo->save();

        $insumoTrazable = new \App\InsumoTrazable();
        $insumoTrazable->insumo()->associate($insumo);

        $insumoTrazable->save();


        $insumo = new \App\Insumo();

        $insumo->descripcion = 'Lactato de sodio';

        $insumo->save();

        $insumoTrazable = new \App\InsumoTrazable();
        $insumoTrazable->insumo()->associate($insumo);

        $insumoTrazable->save();
    }
}

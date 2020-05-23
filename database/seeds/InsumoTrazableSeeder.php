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
        $insumo->descripcion = 'Premix Cerdo Desarrollo';
        $insumo->save();
        $insumoTrazable = new \App\InsumoTrazable();
        $insumoTrazable->insumo()->associate($insumo);
        $insumoTrazable->save();



        $insumo = new \App\Insumo();
        $insumo->descripcion = 'Premix Cerdo Terminación';
        $insumo->save();
        $insumoTrazable = new \App\InsumoTrazable();
        $insumoTrazable->insumo()->associate($insumo);
        $insumoTrazable->save();



        $insumo = new \App\Insumo();
        $insumo->descripcion = 'Premix Pollos Fase 1';
        $insumo->save();
        $insumoTrazable = new \App\InsumoTrazable();
        $insumoTrazable->insumo()->associate($insumo);
        $insumoTrazable->save();



        $insumo = new \App\Insumo();
        $insumo->descripcion = 'Premix Pollos Fase 2';
        $insumo->save();
        $insumoTrazable = new \App\InsumoTrazable();
        $insumoTrazable->insumo()->associate($insumo);
        $insumoTrazable->save();



        $insumo = new \App\Insumo();
        $insumo->descripcion = 'Premix Pollos Fase 3';
        $insumo->save();
        $insumoTrazable = new \App\InsumoTrazable();
        $insumoTrazable->insumo()->associate($insumo);
        $insumoTrazable->save();



        $insumo = new \App\Insumo();
        $insumo->descripcion = 'Premix Pollos Fase 4';
        $insumo->save();
        $insumoTrazable = new \App\InsumoTrazable();
        $insumoTrazable->insumo()->associate($insumo);
        $insumoTrazable->save();



        $insumo = new \App\Insumo();
        $insumo->descripcion = 'Premix Pollos Fase 5';
        $insumo->save();
        $insumoTrazable = new \App\InsumoTrazable();
        $insumoTrazable->insumo()->associate($insumo);
        $insumoTrazable->save();



        $insumo = new \App\Insumo();
        $insumo->descripcion = 'Núcleo Vitamínico Ponedoras Fase 1';
        $insumo->save();
        $insumoTrazable = new \App\InsumoTrazable();
        $insumoTrazable->insumo()->associate($insumo);
        $insumoTrazable->save();



        $insumo = new \App\Insumo();
        $insumo->descripcion = 'Núcleo Vitamínico Ponedoras Fase 2';
        $insumo->save();
        $insumoTrazable = new \App\InsumoTrazable();
        $insumoTrazable->insumo()->associate($insumo);
        $insumoTrazable->save();



        $insumo = new \App\Insumo();
        $insumo->descripcion = 'Concentrado Lechera Iniciador';
        $insumo->save();
        $insumoTrazable = new \App\InsumoTrazable();
        $insumoTrazable->insumo()->associate($insumo);
        $insumoTrazable->save();



        $insumo = new \App\Insumo();
        $insumo->descripcion = 'Concentrado Lechera Recria';
        $insumo->save();
        $insumoTrazable = new \App\InsumoTrazable();
        $insumoTrazable->insumo()->associate($insumo);
        $insumoTrazable->save();



        $insumo = new \App\Insumo();
        $insumo->descripcion = 'Concentrado Lechera Terminador';
        $insumo->save();
        $insumoTrazable = new \App\InsumoTrazable();
        $insumoTrazable->insumo()->associate($insumo);
        $insumoTrazable->save();



        $insumo = new \App\Insumo();
        $insumo->descripcion = 'Premezcla Bovino Fase 1';
        $insumo->save();
        $insumoTrazable = new \App\InsumoTrazable();
        $insumoTrazable->insumo()->associate($insumo);
        $insumoTrazable->save();



        $insumo = new \App\Insumo();
        $insumo->descripcion = 'Premezcla Bovino Fase 2';
        $insumo->save();
        $insumoTrazable = new \App\InsumoTrazable();
        $insumoTrazable->insumo()->associate($insumo);
        $insumoTrazable->save();



        $insumo = new \App\Insumo();
        $insumo->descripcion = 'Premezcla Bovino Fase 3';
        $insumo->save();
        $insumoTrazable = new \App\InsumoTrazable();
        $insumoTrazable->insumo()->associate($insumo);
        $insumoTrazable->save();



        $insumo = new \App\Insumo();
        $insumo->descripcion = 'Premezcla Bovino Fase 4';
        $insumo->save();
        $insumoTrazable = new \App\InsumoTrazable();
        $insumoTrazable->insumo()->associate($insumo);
        $insumoTrazable->save();



        $insumo = new \App\Insumo();
        $insumo->descripcion = 'Premezcla Bovino Fase 5';
        $insumo->save();
        $insumoTrazable = new \App\InsumoTrazable();
        $insumoTrazable->insumo()->associate($insumo);
        $insumoTrazable->save();



        $insumo = new \App\Insumo();
        $insumo->descripcion = 'Acido Cítrico';
        $insumo->save();
        $insumoTrazable = new \App\InsumoTrazable();
        $insumoTrazable->insumo()->associate($insumo);
        $insumoTrazable->save();



        $insumo = new \App\Insumo();
        $insumo->descripcion = 'Acido Fumárico';
        $insumo->save();
        $insumoTrazable = new \App\InsumoTrazable();
        $insumoTrazable->insumo()->associate($insumo);
        $insumoTrazable->save();
    }
}

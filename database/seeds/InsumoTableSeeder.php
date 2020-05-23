<?php

use Illuminate\Database\Seeder;

class InsumoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //creo el insumo maiz
        $insumo1 = new \App\Insumo();

        $insumo1 ->descripcion = "Maíz";
        $insumo1->save();

        $insumo_no_trazable1 = new App\InsumoNoTrazable();
        $insumo_no_trazable1->insumo()->associate($insumo1);
        $insumo_no_trazable1->save();

        //creo el insumo expeller de soja
        $insumo2 = new \App\Insumo();

        $insumo2 ->descripcion = "Expeller de Soja";
        $insumo2->save();

        $insumo_no_trazable2 = new App\InsumoNoTrazable();
        $insumo_no_trazable2->insumo()->associate($insumo2);
        $insumo_no_trazable2->save();

        //creo el insumo harina de carne
        $insumo3 = new \App\Insumo();

        $insumo3 ->descripcion = "Harina de Carne";
        $insumo3->save();

        $insumo_no_trazable3 = new App\InsumoNoTrazable();
        $insumo_no_trazable3->insumo()->associate($insumo3);
        $insumo_no_trazable3->save();

        //creo el insumo soja desactivada
        $insumo4 = new \App\Insumo();

        $insumo4 ->descripcion = "Soja Desactivada";
        $insumo4->save();

        $insumo_no_trazable4 = new App\InsumoNoTrazable();
        $insumo_no_trazable4->insumo()->associate($insumo4);
        $insumo_no_trazable4->save();

        //creo el insumo conchilla
        $insumo5 = new \App\Insumo();

        $insumo5 ->descripcion = "Conchilla";
        $insumo5->save();

        $insumo_no_trazable5 = new App\InsumoNoTrazable();
        $insumo_no_trazable5->insumo()->associate($insumo5);
        $insumo_no_trazable5->save();

        //creo el insumo Aceite de Soja
        $insumo6 = new \App\Insumo();

        $insumo6 ->descripcion = "Aceite de Soja";
        $insumo6->save();

        $insumo_no_trazable6 = new App\InsumoNoTrazable();
        $insumo_no_trazable6->insumo()->associate($insumo6);
        $insumo_no_trazable6->save();
    }
}

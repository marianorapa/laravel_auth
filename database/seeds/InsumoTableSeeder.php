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

        $insumo1 ->descripcion = "Maiz";
        $insumo1->save();

        $insumo_no_trazable1 = new App\InsumoNoTrazable();
        $insumo_no_trazable1->insumo()->associate($insumo1);
        $insumo_no_trazable1->save();

        //creo el insumo trigo
        $insumo2 = new \App\Insumo();

        $insumo2 ->descripcion = "Trigo";
        $insumo2->save();

        $insumo_no_trazable2 = new App\InsumoNoTrazable();
        $insumo_no_trazable2->insumo()->associate($insumo2);
        $insumo_no_trazable2->save();

        //creo el insumo soja
        $insumo3 = new \App\Insumo();

        $insumo3 ->descripcion = "Soja";
        $insumo3->save();

        $insumo_no_trazable3 = new App\InsumoNoTrazable();
        $insumo_no_trazable3->insumo()->associate($insumo3);
        $insumo_no_trazable3->save();

        //creo el insumo quinoa
        $insumo4 = new \App\Insumo();

        $insumo4 ->descripcion = "Quinoa";
        $insumo4->save();

        $insumo_no_trazable4 = new App\InsumoNoTrazable();
        $insumo_no_trazable4->insumo()->associate($insumo4);
        $insumo_no_trazable4->save();
    }
}

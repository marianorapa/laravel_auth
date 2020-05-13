<?php

use App\InsumoNoTrazable;
use Illuminate\Database\Seeder;


class InsumoSeeder extends Seeder
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

        $insumo1 ->descripcion = "maiz";
        $insumo1->save();

        $insumo_no_trazable1 = new App\InsumoNoTrazable();
        $insumo_no_trazable1->id->associate($insumo1);
        $insumo_no_trazable1->save();

        //creo el insumo trigo
        $insumo2 = new \App\Insumo();

        $insumo2 ->descripcion = "trigo";
        $insumo2->save();

        $insumo_no_trazable2 = new App\InsumoNoTrazable();
        $insumo_no_trazable2->id->associate($insumo2);
        $insumo_no_trazable2->save();

        //creo el insumo soja
        $insumo3 = new \App\Insumo();

        $insumo3 ->descripcion = "soja";
        $insumo3->save();

        $insumo_no_trazable3 = new App\InsumoNoTrazable();
        $insumo_no_trazable3->id->associate($insumo3);
        $insumo_no_trazable3->save();

        //creo el insumo quinoa
        $insumo4 = new \App\Insumo();

        $insumo4 ->descripcion = "quinoa";
        $insumo4->save();

        $insumo_no_trazable4 = new App\InsumoNoTrazable();
        $insumo_no_trazable4->id->associate($insumo4);
        $insumo_no_trazable4->save();




    }
}

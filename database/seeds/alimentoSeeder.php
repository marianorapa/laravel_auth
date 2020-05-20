<?php

use App\alimentoTipo;
use Illuminate\Database\Seeder;

class alimentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //alimento para gallinas
        $at = alimentoTipo::findOrFail(1);
        $cliente = \App\Cliente::findOrFail(1);
        $alimento1 = new  \App\Alimento();
        $alimento1->descripcion = "Alimento para gallinas";
        $alimento1->alimentoTipo()->associate($at);
        $alimento1->cliente()->associate($cliente);
        $alimento1->save();


        //alimento para cerdos(no tengo idea, solo lo hago para probar)
        $at1 = alimentoTipo::findOrFail(2);
        $alimento2 = new  \App\Alimento();
        $alimento2->descripcion = "Alimento para cerdos";
        $alimento2->alimentoTipo()->associate($at1);
        $alimento2->cliente()->associate($cliente);
        $alimento2->save();


    }
}

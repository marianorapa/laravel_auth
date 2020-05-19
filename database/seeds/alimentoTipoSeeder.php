<?php

use Illuminate\Database\Seeder;

class alimentoTipoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //tipo de alimento Cereales(?
        $tipo1 = new \App\alimentoTipo();
        $tipo1->descripcion = "Cereal";
        $tipo1->save();

        //tipo de alimento Legumbres(????????
        $tipo2 = new \App\alimentoTipo();
        $tipo2->descripcion = "Legumbre";
        $tipo2->save();

    }
}

<?php

use Illuminate\Database\Seeder;

class AlimentoTipoTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('alimento_tipo')->delete();
        
        \DB::table('alimento_tipo')->insert(array (
            0 => 
            array (
                'id' => 1,
                'descripcion' => 'Porcinos',
                'created_at' => '2020-05-22 20:55:51',
                'updated_at' => '2020-05-22 20:55:51',
            ),
            1 => 
            array (
                'id' => 2,
                'descripcion' => 'Bovinos',
                'created_at' => '2020-05-22 20:55:51',
                'updated_at' => '2020-05-22 20:55:51',
            ),
            2 => 
            array (
                'id' => 3,
                'descripcion' => 'Avícolas',
                'created_at' => '2020-05-22 20:55:51',
                'updated_at' => '2020-05-22 20:55:51',
            ),
        ));
        
        
    }
}
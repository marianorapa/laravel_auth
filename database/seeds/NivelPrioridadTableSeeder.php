<?php

use Illuminate\Database\Seeder;

class NivelPrioridadTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('nivel_prioridad')->delete();
        
        \DB::table('nivel_prioridad')->insert(array (
            0 => 
            array (
                'id' => 1,
                'descripcion' => 'Prioridad Alta',
                'created_at' => '2020-05-23 05:19:08',
                'updated_at' => '2020-05-23 05:19:08',
            ),
            1 => 
            array (
                'id' => 2,
                'descripcion' => 'Prioridad Baja',
                'created_at' => '2020-05-23 05:19:08',
                'updated_at' => '2020-05-23 05:19:08',
            ),
        ));
        
        
    }
}
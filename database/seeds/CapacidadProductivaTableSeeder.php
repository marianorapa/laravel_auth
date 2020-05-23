<?php

use Illuminate\Database\Seeder;

class CapacidadProductivaTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('capacidad_productiva')->delete();
        
        \DB::table('capacidad_productiva')->insert(array (
            0 => 
            array (
                'id' => 1,
                'capacidad' => 135000,
                'fecha_desde' => '2011-05-23',
                'fecha_hasta' => NULL,
                'prioridad_id' => 1,
                'created_at' => '2020-05-23 05:25:45',
                'updated_at' => '2020-05-23 05:25:45',
            ),
            1 => 
            array (
                'id' => 2,
                'capacidad' => 70000,
                'fecha_desde' => '2013-05-10',
                'fecha_hasta' => '2013-05-10',
                'prioridad_id' => 2,
                'created_at' => '2020-05-23 05:25:45',
                'updated_at' => '2020-05-23 05:25:45',
            ),
            2 => 
            array (
                'id' => 3,
                'capacidad' => 270000,
                'fecha_desde' => '2015-06-23',
                'fecha_hasta' => NULL,
                'prioridad_id' => 1,
                'created_at' => '2020-05-23 05:25:45',
                'updated_at' => '2020-05-23 05:25:45',
            ),
        ));
        
        
    }
}
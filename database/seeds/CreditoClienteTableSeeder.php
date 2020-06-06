<?php

use Illuminate\Database\Seeder;

class CreditoClienteTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('credito_cliente')->delete();
        
        \DB::table('credito_cliente')->insert(array (
            0 => 
            array (
                'id' => 4,
                'cliente_id' => 1,
                'limite' => 0,
                'fecha_desde' => '2020-06-06',
                'fecha_hasta' => NULL,
                'created_at' => '2020-06-06 00:00:00',
                'updated_at' => '2020-06-06 00:00:00',
            ),
            1 => 
            array (
                'id' => 5,
                'cliente_id' => 2,
                'limite' => 0,
                'fecha_desde' => '2020-06-06',
                'fecha_hasta' => NULL,
                'created_at' => '2020-06-06 00:00:00',
                'updated_at' => '2020-06-06 00:00:00',
            ),
            2 => 
            array (
                'id' => 6,
                'cliente_id' => 7,
                'limite' => 0,
                'fecha_desde' => '2020-06-06',
                'fecha_hasta' => NULL,
                'created_at' => '2020-06-06 00:00:00',
                'updated_at' => '2020-06-06 00:00:00',
            ),
            3 => 
            array (
                'id' => 7,
                'cliente_id' => 8,
                'limite' => 0,
                'fecha_desde' => '2020-06-06',
                'fecha_hasta' => NULL,
                'created_at' => '2020-06-06 00:00:00',
                'updated_at' => '2020-06-06 00:00:00',
            ),
            4 => 
            array (
                'id' => 8,
                'cliente_id' => 9,
                'limite' => 0,
                'fecha_desde' => '2020-06-06',
                'fecha_hasta' => NULL,
                'created_at' => '2020-06-06 00:00:00',
                'updated_at' => '2020-06-06 00:00:00',
            ),
            5 => 
            array (
                'id' => 9,
                'cliente_id' => 10,
                'limite' => 0,
                'fecha_desde' => '2020-06-06',
                'fecha_hasta' => NULL,
                'created_at' => '2020-06-06 00:00:00',
                'updated_at' => '2020-06-06 00:00:00',
            ),
            6 => 
            array (
                'id' => 10,
                'cliente_id' => 11,
                'limite' => 0,
                'fecha_desde' => '2020-06-06',
                'fecha_hasta' => NULL,
                'created_at' => '2020-06-06 00:00:00',
                'updated_at' => '2020-06-06 00:00:00',
            ),
            7 => 
            array (
                'id' => 11,
                'cliente_id' => 12,
                'limite' => 0,
                'fecha_desde' => '2020-06-06',
                'fecha_hasta' => NULL,
                'created_at' => '2020-06-06 00:00:00',
                'updated_at' => '2020-06-06 00:00:00',
            ),
            8 => 
            array (
                'id' => 12,
                'cliente_id' => 13,
                'limite' => 0,
                'fecha_desde' => '2020-06-06',
                'fecha_hasta' => NULL,
                'created_at' => '2020-06-06 00:00:00',
                'updated_at' => '2020-06-06 00:00:00',
            ),
            9 => 
            array (
                'id' => 13,
                'cliente_id' => 14,
                'limite' => 0,
                'fecha_desde' => '2020-06-06',
                'fecha_hasta' => NULL,
                'created_at' => '2020-06-06 00:00:00',
                'updated_at' => '2020-06-06 00:00:00',
            ),
            10 => 
            array (
                'id' => 14,
                'cliente_id' => 15,
                'limite' => 0,
                'fecha_desde' => '2020-06-06',
                'fecha_hasta' => NULL,
                'created_at' => '2020-06-06 00:00:00',
                'updated_at' => '2020-06-06 00:00:00',
            ),
            11 => 
            array (
                'id' => 15,
                'cliente_id' => 16,
                'limite' => 0,
                'fecha_desde' => '2020-06-06',
                'fecha_hasta' => NULL,
                'created_at' => '2020-06-06 00:00:00',
                'updated_at' => '2020-06-06 00:00:00',
            ),
            12 => 
            array (
                'id' => 16,
                'cliente_id' => 17,
                'limite' => 0,
                'fecha_desde' => '2020-06-06',
                'fecha_hasta' => NULL,
                'created_at' => '2020-06-06 00:00:00',
                'updated_at' => '2020-06-06 00:00:00',
            ),
            13 => 
            array (
                'id' => 17,
                'cliente_id' => 18,
                'limite' => 0,
                'fecha_desde' => '2020-06-06',
                'fecha_hasta' => NULL,
                'created_at' => '2020-06-06 00:00:00',
                'updated_at' => '2020-06-06 00:00:00',
            ),
        ));
        
        
    }
}
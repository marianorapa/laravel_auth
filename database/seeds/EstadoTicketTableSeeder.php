<?php

use Illuminate\Database\Seeder;

class EstadoTicketTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('estado_ticket')->delete();
        
        \DB::table('estado_ticket')->insert(array (
            0 => 
            array (
                'id' => 1,
                'descripcion' => 'En proceso',
                'created_at' => '2020-05-23 04:15:07',
                'updated_at' => '2020-05-23 04:15:07',
            ),
            1 => 
            array (
                'id' => 2,
                'descripcion' => 'Anulado',
                'created_at' => '2020-05-23 04:15:07',
                'updated_at' => '2020-05-23 04:15:07',
            ),
            2 => 
            array (
                'id' => 3,
                'descripcion' => 'Finalizado',
                'created_at' => '2020-05-23 04:15:07',
                'updated_at' => '2020-05-23 04:15:07',
            ),
        ));
        
        
    }
}
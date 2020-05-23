<?php

use Illuminate\Database\Seeder;

class EstadoOrdProTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('estado_ord_pro')->delete();
        
        \DB::table('estado_ord_pro')->insert(array (
            0 => 
            array (
                'id' => 1,
                'descripcion' => 'Pendiente',
                'created_at' => '2020-05-23 04:15:07',
                'updated_at' => '2020-05-23 04:15:07',
            ),
            1 => 
            array (
                'id' => 2,
                'descripcion' => 'Anulada',
                'created_at' => '2020-05-23 04:15:07',
                'updated_at' => '2020-05-23 04:15:07',
            ),
            2 => 
            array (
                'id' => 3,
                'descripcion' => 'Finalizada',
                'created_at' => '2020-05-23 04:15:07',
                'updated_at' => '2020-05-23 04:15:07',
            ),
        ));
        
        
    }
}
<?php

use Illuminate\Database\Seeder;

class PrecioFasonTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('precio_fason')->delete();

        \DB::table('precio_fason')->insert(array (
            0 =>
            array (
                'id' => 1,
                'precio_por_tn' => '750',
                'variacion_admitida' => '0.05',
                'fecha_desde' => '2020-05-23',
                'fecha_hasta' => NULL,
                'prioridad_id' => 2,
                'created_at' => '2020-05-23 05:28:48',
                'updated_at' => '2020-05-23 05:28:48',
            ),
        ));


    }
}

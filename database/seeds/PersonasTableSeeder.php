<?php

use Illuminate\Database\Seeder;

class PersonasTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('personas')->delete();
        
        \DB::table('personas')->insert(array (
            0 => 
            array (
                'id' => 25,
                'apellidos' => 'Istrator',
                'nombres' => 'Admin',
                'fecha_nacimiento' => '1100-10-10',
                'created_at' => '2020-05-23 08:13:40',
                'updated_at' => '2020-05-23 08:13:40',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}
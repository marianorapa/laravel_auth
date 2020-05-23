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
                'fecha_nacimiento' => '1010-10-11',
                'created_at' => '2020-05-23 08:44:06',
                'updated_at' => '2020-05-23 08:44:06',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}
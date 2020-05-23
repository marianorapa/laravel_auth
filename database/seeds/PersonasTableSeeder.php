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
                'id' => 24,
                'apellidos' => 'Istrador',
                'nombres' => 'Admin',
                'fecha_nacimiento' => '1900-01-01',
                'created_at' => '2020-05-23 05:54:35',
                'updated_at' => '2020-05-23 05:54:35',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}
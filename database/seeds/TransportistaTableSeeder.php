<?php

use Illuminate\Database\Seeder;

class TransportistaTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('transportista')->delete();
        
        \DB::table('transportista')->insert(array (
            0 => 
            array (
                'id' => 3,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}
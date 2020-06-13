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
            1 => 
            array (
                'id' => 26,
                'created_at' => '2020-06-13 00:46:51',
                'updated_at' => '2020-06-13 00:46:51',
            ),
            2 => 
            array (
                'id' => 27,
                'created_at' => '2020-06-13 00:46:51',
                'updated_at' => '2020-06-13 00:46:51',
            ),
            3 => 
            array (
                'id' => 28,
                'created_at' => '2020-06-13 00:46:51',
                'updated_at' => '2020-06-13 00:46:51',
            ),
            4 => 
            array (
                'id' => 29,
                'created_at' => '2020-06-13 00:46:51',
                'updated_at' => '2020-06-13 00:46:51',
            ),
            5 => 
            array (
                'id' => 30,
                'created_at' => '2020-06-13 00:46:51',
                'updated_at' => '2020-06-13 00:46:51',
            ),
            6 => 
            array (
                'id' => 31,
                'created_at' => '2020-06-13 00:46:51',
                'updated_at' => '2020-06-13 00:46:51',
            ),
        ));
        
        
    }
}
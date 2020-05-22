<?php

use Illuminate\Database\Seeder;

class ProveedorTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('proveedor')->delete();
        
        \DB::table('proveedor')->insert(array (
            0 => 
            array (
                'id' => 4,
                'gln' => 'GLN42345436',
                'created_at' => '2020-05-21 03:45:49',
                'updated_at' => '2020-05-21 03:45:49',
            ),
            1 => 
            array (
                'id' => 5,
                'gln' => 'GLN55622311',
                'created_at' => '2020-05-21 03:45:49',
                'updated_at' => '2020-05-21 03:45:49',
            ),
            2 => 
            array (
                'id' => 19,
                'gln' => '7790019000001',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 20,
                'gln' => '7790438000002',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id' => 21,
                'gln' => '7790791000008',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'id' => 22,
                'gln' => '7790843000000',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            6 => 
            array (
                'id' => 23,
                'gln' => '7790934000001',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}
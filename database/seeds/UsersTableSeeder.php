<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 24,
                'username' => 'administrador',
                'password' => '$2y$10$0yNnm0RWABpSsv/ZsmHDHe65QZyMuhGYtkZQt.2uiw1DpPRSsJuWu',
                'descripcion' => 'Administrador',
                'deleted_at' => NULL,
                'remember_token' => NULL,
                'created_at' => '2020-05-23 05:54:36',
                'updated_at' => '2020-05-23 05:54:36',
            ),
        ));
        
        
    }
}
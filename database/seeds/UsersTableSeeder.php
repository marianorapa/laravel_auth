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
                'id' => 25,
                'username' => 'administrator',
                'password' => '$2y$10$Sq8gmi9/o/OCk.oPxvq81uhcUr8B8F6QdkBakGCBo81N0hLJpAp7y',
                'descripcion' => NULL,
                'deleted_at' => NULL,
                'remember_token' => NULL,
                'created_at' => '2020-05-23 08:13:40',
                'updated_at' => '2020-05-23 08:13:40',
            ),
        ));
        
        
    }
}
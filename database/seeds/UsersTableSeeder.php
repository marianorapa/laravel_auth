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
                'password' => '$2y$10$kZk1zcGsmKimoawSRyAayum/S7bz6m.wSoZzOZsWuhfU.HHYZUGrC',//admin01
                'descripcion' => NULL,
                'deleted_at' => NULL,
                'remember_token' => NULL,
                'created_at' => '2020-05-23 08:44:06',
                'updated_at' => '2020-05-23 08:44:06',
            ),
        ));


    }
}

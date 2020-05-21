<?php

use Illuminate\Database\Seeder;

class DomicilioTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('domicilio')->delete();
        
        \DB::table('domicilio')->insert(array (
            0 => 
            array (
                'id' => 1,
                'calle' => 'Mendez',
                'numero' => 1675,
                'piso' => NULL,
                'dpto' => NULL,
                'localidad_id' => 12881,
                'created_at' => '2020-05-21 03:45:49',
                'updated_at' => '2020-05-21 03:45:49',
            ),
            1 => 
            array (
                'id' => 2,
                'calle' => 'Calle',
                'numero' => 123,
                'piso' => NULL,
                'dpto' => NULL,
                'localidad_id' => 150,
                'created_at' => '2020-05-21 03:45:49',
                'updated_at' => '2020-05-21 03:45:49',
            ),
            2 => 
            array (
                'id' => 3,
                'calle' => 'Otra calle',
                'numero' => 321,
                'piso' => NULL,
                'dpto' => NULL,
                'localidad_id' => 350,
                'created_at' => '2020-05-21 03:45:49',
                'updated_at' => '2020-05-21 03:45:49',
            ),
            3 => 
            array (
                'id' => 4,
                'calle' => 'Aun Otra calle',
                'numero' => 32123,
                'piso' => NULL,
                'dpto' => NULL,
                'localidad_id' => 310,
                'created_at' => '2020-05-21 03:45:49',
                'updated_at' => '2020-05-21 03:45:49',
            ),
            4 => 
            array (
                'id' => 5,
                'calle' => 'San Martin',
                'numero' => 456,
                'piso' => NULL,
                'dpto' => NULL,
                'localidad_id' => 510,
                'created_at' => '2020-05-21 03:45:49',
                'updated_at' => '2020-05-21 03:45:49',
            ),
            5 => 
            array (
                'id' => 7,
                'calle' => 'NAZARRE',
                'numero' => 5250,
                'piso' => NULL,
                'dpto' => '301',
                'localidad_id' => 3058,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            6 => 
            array (
                'id' => 8,
                'calle' => 'LAVALLE',
                'numero' => 715,
                'piso' => '2',
                'dpto' => 'B',
                'localidad_id' => 3058,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            7 => 
            array (
                'id' => 9,
                'calle' => 'LA PAZ',
                'numero' => 49,
                'piso' => NULL,
                'dpto' => NULL,
                'localidad_id' => 14413,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            8 => 
            array (
                'id' => 10,
                'calle' => 'LUIS PASTEUR',
                'numero' => 1885,
                'piso' => NULL,
                'dpto' => NULL,
                'localidad_id' => 1744,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            9 => 
            array (
                'id' => 11,
                'calle' => 'LARREA',
                'numero' => 1234,
                'piso' => '7',
                'dpto' => 'B',
                'localidad_id' => 3058,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            10 => 
            array (
                'id' => 12,
                'calle' => 'RIVADAVIA AV.',
                'numero' => 2206,
                'piso' => '8',
                'dpto' => 'A',
                'localidad_id' => 3058,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            11 => 
            array (
                'id' => 13,
                'calle' => 'CANAPINO',
                'numero' => 1251,
                'piso' => NULL,
                'dpto' => NULL,
                'localidad_id' => 704,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            12 => 
            array (
                'id' => 14,
                'calle' => 'LAS HERAS GRAL AV.',
                'numero' => 2925,
                'piso' => '12',
                'dpto' => '59',
                'localidad_id' => 3058,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            13 => 
            array (
                'id' => 15,
                'calle' => 'LIBERTADOR DEL AV.',
                'numero' => 4852,
                'piso' => '9',
                'dpto' => 'C',
                'localidad_id' => 3058,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            14 => 
            array (
                'id' => 16,
                'calle' => 'JUNCAL',
                'numero' => 2028,
                'piso' => '3C',
                'dpto' => NULL,
                'localidad_id' => 3058,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            15 => 
            array (
                'id' => 17,
                'calle' => 'MOREAU DE JUSTO A.AV',
                'numero' => 550,
                'piso' => '2',
                'dpto' => NULL,
                'localidad_id' => 3058,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            16 => 
            array (
                'id' => 18,
                'calle' => 'LAPLACETTE',
                'numero' => 637,
                'piso' => NULL,
                'dpto' => NULL,
                'localidad_id' => 4578,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            17 => 
            array (
                'id' => 19,
                'calle' => 'SAN ANDRES Y BELGRANO',
                'numero' => 0,
                'piso' => NULL,
                'dpto' => NULL,
                'localidad_id' => 12881,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            18 => 
            array (
                'id' => 20,
                'calle' => 'D. PRATT',
                'numero' => 2507,
                'piso' => NULL,
                'dpto' => NULL,
                'localidad_id' => 14776,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            19 => 
            array (
                'id' => 21,
                'calle' => 'FELIX BALLESTER',
                'numero' => 614,
                'piso' => NULL,
                'dpto' => NULL,
                'localidad_id' => 3065,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            20 => 
            array (
                'id' => 22,
                'calle' => 'BV DE LOS POLACOS',
                'numero' => 6446,
                'piso' => NULL,
                'dpto' => NULL,
                'localidad_id' => 4060,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            21 => 
            array (
                'id' => 23,
                'calle' => 'CUARTEL IV',
                'numero' => 0,
                'piso' => NULL,
                'dpto' => NULL,
                'localidad_id' => 10959,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}
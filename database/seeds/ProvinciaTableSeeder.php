<?php

use Illuminate\Database\Seeder;

class ProvinciaTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('provincia')->delete();

        \DB::table('provincia')->insert(array (
            0 =>
            array (
                'id' => 1,
                'descr' => 'BUENOS AIRES'
            ),
            1 =>
            array (
                'id' => 2,
                'descr' => 'CATAMARCA'
            ),
            2 =>
            array (
                'id' => 3,
                'descr' => 'CÓRDOBA'
            ),
            3 =>
            array (
                'id' => 4,
                'descr' => 'CORRIENTES'
            ),
            4 =>
            array (
                'id' => 5,
                'descr' => 'ENTRE RIOS'
            ),
            5 =>
            array (
                'id' => 6,
                'descr' => 'JUJUY'
            ),
            6 =>
            array (
                'id' => 7,
                'descr' => 'MENDOZA'
            ),
            7 =>
            array (
                'id' => 8,
                'descr' => 'LA RIOJA'
            ),
            8 =>
            array (
                'id' => 9,
                'descr' => 'SALTA'
            ),
            9 =>
            array (
                'id' => 10,
                'descr' => 'SAN JUAN'
            ),
            10 =>
            array (
                'id' => 11,
                'descr' => 'SAN LUIS'
            ),
            11 =>
            array (
                'id' => 12,
                'descr' => 'SANTA FE'
            ),
            12 =>
            array (
                'id' => 13,
                'descr' => 'SANTIAGO DEL ESTERO'
            ),
            13 =>
            array (
                'id' => 14,
                'descr' => 'TUCUMÁN'
            ),
            14 =>
            array (
                'id' => 16,
                'descr' => 'CHACO'
            ),
            15 =>
            array (
                'id' => 17,
                'descr' => 'CHUBUT'
            ),
            16 =>
            array (
                'id' => 18,
                'descr' => 'FORMOSA'
            ),
            17 =>
            array (
                'id' => 19,
                'descr' => 'MISIONES'
            ),
            18 =>
            array (
                'id' => 20,
                'descr' => 'NEUQUÉN'
            ),
            19 =>
            array (
                'id' => 21,
                'descr' => 'LA PAMPA'
            ),
            20 =>
            array (
                'id' => 22,
                'descr' => 'RIO NEGRO'
            ),
            21 =>
            array (
                'id' => 23,
                'descr' => 'SANTA CRUZ'
            ),
            22 =>
            array (
                'id' => 24,
                'descr' => 'TIERRA DEL FUEGO'
            ),
            23 =>
            array (
                'id' => 25,
                'descr' => 'CIUDAD AUTÓNOMA BUENOS AIRES'
            ),
        ));


    }
}

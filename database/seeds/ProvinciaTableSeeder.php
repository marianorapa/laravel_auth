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
                'descripcion' => 'BUENOS AIRES'
            ),
            1 =>
            array (
                'id' => 2,
                'descripcion' => 'CATAMARCA'
            ),
            2 =>
            array (
                'id' => 3,
                'descripcion' => 'CÓRDOBA'
            ),
            3 =>
            array (
                'id' => 4,
                'descripcion' => 'CORRIENTES'
            ),
            4 =>
            array (
                'id' => 5,
                'descripcion' => 'ENTRE RIOS'
            ),
            5 =>
            array (
                'id' => 6,
                'descripcion' => 'JUJUY'
            ),
            6 =>
            array (
                'id' => 7,
                'descripcion' => 'MENDOZA'
            ),
            7 =>
            array (
                'id' => 8,
                'descripcion' => 'LA RIOJA'
            ),
            8 =>
            array (
                'id' => 9,
                'descripcion' => 'SALTA'
            ),
            9 =>
            array (
                'id' => 10,
                'descripcion' => 'SAN JUAN'
            ),
            10 =>
            array (
                'id' => 11,
                'descripcion' => 'SAN LUIS'
            ),
            11 =>
            array (
                'id' => 12,
                'descripcion' => 'SANTA FE'
            ),
            12 =>
            array (
                'id' => 13,
                'descripcion' => 'SANTIAGO DEL ESTERO'
            ),
            13 =>
            array (
                'id' => 14,
                'descripcion' => 'TUCUMÁN'
            ),
            14 =>
            array (
                'id' => 16,
                'descripcion' => 'CHACO'
            ),
            15 =>
            array (
                'id' => 17,
                'descripcion' => 'CHUBUT'
            ),
            16 =>
            array (
                'id' => 18,
                'descripcion' => 'FORMOSA'
            ),
            17 =>
            array (
                'id' => 19,
                'descripcion' => 'MISIONES'
            ),
            18 =>
            array (
                'id' => 20,
                'descripcion' => 'NEUQUÉN'
            ),
            19 =>
            array (
                'id' => 21,
                'descripcion' => 'LA PAMPA'
            ),
            20 =>
            array (
                'id' => 22,
                'descripcion' => 'RIO NEGRO'
            ),
            21 =>
            array (
                'id' => 23,
                'descripcion' => 'SANTA CRUZ'
            ),
            22 =>
            array (
                'id' => 24,
                'descripcion' => 'TIERRA DEL FUEGO'
            ),
            23 =>
            array (
                'id' => 25,
                'descripcion' => 'CIUDAD AUTÓNOMA BUENOS AIRES'
            ),
        ));


    }
}

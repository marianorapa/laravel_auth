<?php

use Illuminate\Database\Seeder;

class TipoDocumentoTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('tipo_documento')->delete();

        \DB::table('tipo_documento')->insert(array (
            0 =>
            array (
                'id' => 1,
                'descr' => 'CI Buenos Aires'
            ),
            1 =>
            array (
                'id' => 2,
                'descr' => 'CI Catamarca'
            ),
            2 =>
            array (
                'id' => 3,
                'descr' => 'CI Córdoba'
            ),
            3 =>
            array (
                'id' => 4,
                'descr' => 'CI Corrientes'
            ),
            4 =>
            array (
                'id' => 5,
                'descr' => 'CI Entre Ríos'
            ),
            5 =>
            array (
                'id' => 6,
                'descr' => 'CI Jujuy'
            ),
            6 =>
            array (
                'id' => 7,
                'descr' => 'CI Mendoza'
            ),
            7 =>
            array (
                'id' => 8,
                'descr' => 'CI La Rioja'
            ),
            8 =>
            array (
                'id' => 9,
                'descr' => 'CI Salta'
            ),
            9 =>
            array (
                'id' => 10,
                'descr' => 'CI San Juan'
            ),
            10 =>
            array (
                'id' => 11,
                'descr' => 'CI San Luis'
            ),
            11 =>
            array (
                'id' => 12,
                'descr' => 'CI Santa Fe'
            ),
            12 =>
            array (
                'id' => 13,
                'descr' => 'CI Santiago del Estero'
            ),
            13 =>
            array (
                'id' => 14,
                'descr' => 'CI Tucumán'
            ),
            14 =>
            array (
                'id' => 16,
                'descr' => 'CI Chaco'
            ),
            15 =>
            array (
                'id' => 17,
                'descr' => 'CI Chubut'
            ),
            16 =>
            array (
                'id' => 18,
                'descr' => 'CI Formosa'
            ),
            17 =>
            array (
                'id' => 19,
                'descr' => 'CI Misiones'
            ),
            18 =>
            array (
                'id' => 20,
                'descr' => 'CI Neuquén'
            ),
            19 =>
            array (
                'id' => 21,
                'descr' => 'CI La Pampa'
            ),
            20 =>
            array (
                'id' => 22,
                'descr' => 'CI Río Negro'
            ),
            21 =>
            array (
                'id' => 23,
                'descr' => 'CI Santa Cruz'
            ),
            22 =>
            array (
                'id' => 24,
                'descr' => 'CI Tierra del Fuego'
            ),
            23 =>
            array (
                'id' => 25,
                'descr' => 'CI Policía Federal'
            ),
            24 =>
            array (
                'id' => 80,
                'descr' => 'CUIT'
            ),
            25 =>
            array (
                'id' => 86,
                'descr' => 'CUIL'
            ),
            26 =>
            array (
                'id' => 87,
                'descr' => 'CDI'
            ),
            27 =>
            array (
                'id' => 89,
                'descr' => 'LE'
            ),
            28 =>
            array (
                'id' => 90,
                'descr' => 'LC'
            ),
            29 =>
            array (
                'id' => 91,
                'descr' => 'CI Extranjera'
            ),
            30 =>
            array (
                'id' => 92,
                'descr' => 'En trámite'
            ),
            31 =>
            array (
                'id' => 93,
                'descr' => 'Acta Nacimiento'
            ),
            32 =>
            array (
                'id' => 94,
                'descr' => 'Pasaporte'
            ),
            33 =>
            array (
                'id' => 95,
                'descr' => 'CI Bs. As. RNP'
            ),
            34 =>
            array (
                'id' => 96,
                'descr' => 'DNI'
            ),
            35 =>
            array (
                'id' => 99,
            'descr' => 'Doc. (otro)'
            ),
        ));


    }
}

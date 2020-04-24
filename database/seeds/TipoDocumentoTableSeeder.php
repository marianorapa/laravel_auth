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
                'descripcion' => 'CI Buenos Aires'
            ),
            1 =>
            array (
                'id' => 2,
                'descripcion' => 'CI Catamarca'
            ),
            2 =>
            array (
                'id' => 3,
                'descripcion' => 'CI Córdoba'
            ),
            3 =>
            array (
                'id' => 4,
                'descripcion' => 'CI Corrientes'
            ),
            4 =>
            array (
                'id' => 5,
                'descripcion' => 'CI Entre Ríos'
            ),
            5 =>
            array (
                'id' => 6,
                'descripcion' => 'CI Jujuy'
            ),
            6 =>
            array (
                'id' => 7,
                'descripcion' => 'CI Mendoza'
            ),
            7 =>
            array (
                'id' => 8,
                'descripcion' => 'CI La Rioja'
            ),
            8 =>
            array (
                'id' => 9,
                'descripcion' => 'CI Salta'
            ),
            9 =>
            array (
                'id' => 10,
                'descripcion' => 'CI San Juan'
            ),
            10 =>
            array (
                'id' => 11,
                'descripcion' => 'CI San Luis'
            ),
            11 =>
            array (
                'id' => 12,
                'descripcion' => 'CI Santa Fe'
            ),
            12 =>
            array (
                'id' => 13,
                'descripcion' => 'CI Santiago del Estero'
            ),
            13 =>
            array (
                'id' => 14,
                'descripcion' => 'CI Tucumán'
            ),
            14 =>
            array (
                'id' => 16,
                'descripcion' => 'CI Chaco'
            ),
            15 =>
            array (
                'id' => 17,
                'descripcion' => 'CI Chubut'
            ),
            16 =>
            array (
                'id' => 18,
                'descripcion' => 'CI Formosa'
            ),
            17 =>
            array (
                'id' => 19,
                'descripcion' => 'CI Misiones'
            ),
            18 =>
            array (
                'id' => 20,
                'descripcion' => 'CI Neuquén'
            ),
            19 =>
            array (
                'id' => 21,
                'descripcion' => 'CI La Pampa'
            ),
            20 =>
            array (
                'id' => 22,
                'descripcion' => 'CI Río Negro'
            ),
            21 =>
            array (
                'id' => 23,
                'descripcion' => 'CI Santa Cruz'
            ),
            22 =>
            array (
                'id' => 24,
                'descripcion' => 'CI Tierra del Fuego'
            ),
            23 =>
            array (
                'id' => 25,
                'descripcion' => 'CI Policía Federal'
            ),
            24 =>
            array (
                'id' => 80,
                'descripcion' => 'CUIT'
            ),
            25 =>
            array (
                'id' => 86,
                'descripcion' => 'CUIL'
            ),
            26 =>
            array (
                'id' => 87,
                'descripcion' => 'CDI'
            ),
            27 =>
            array (
                'id' => 89,
                'descripcion' => 'LE'
            ),
            28 =>
            array (
                'id' => 90,
                'descripcion' => 'LC'
            ),
            29 =>
            array (
                'id' => 91,
                'descripcion' => 'CI Extranjera'
            ),
            30 =>
            array (
                'id' => 92,
                'descripcion' => 'En trámite'
            ),
            31 =>
            array (
                'id' => 93,
                'descripcion' => 'Acta Nacimiento'
            ),
            32 =>
            array (
                'id' => 94,
                'descripcion' => 'Pasaporte'
            ),
            33 =>
            array (
                'id' => 95,
                'descripcion' => 'CI Bs. As. RNP'
            ),
            34 =>
            array (
                'id' => 96,
                'descripcion' => 'DNI'
            ),
            35 =>
            array (
                'id' => 99,
            'descripcion' => 'Doc. (otro)'
            ),
        ));


    }
}

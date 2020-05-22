<?php

use Illuminate\Database\Seeder;

class PersonaTipoTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('persona_tipo')->delete();
        
        \DB::table('persona_tipo')->insert(array (
            0 => 
            array (
                'id' => 1,
                'tipo_documento_id' => 80,
                'nro_documento' => '30-70950140-9',
                'domicilio_id' => 1,
                'telefono' => '+54 2325 443828',
                'email' => 'info@vilumar.com',
                'observaciones' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2020-05-21 03:45:49',
                'updated_at' => '2020-05-21 03:45:49',
            ),
            1 => 
            array (
                'id' => 2,
                'tipo_documento_id' => 80,
                'nro_documento' => '30-70234321-7',
                'domicilio_id' => 2,
                'telefono' => '01154342321',
                'email' => 'email@mail.com',
                'observaciones' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2020-05-21 03:45:49',
                'updated_at' => '2020-05-21 03:45:49',
            ),
            2 => 
            array (
                'id' => 3,
                'tipo_documento_id' => 80,
                'nro_documento' => '30-72123321-7',
                'domicilio_id' => 3,
                'telefono' => NULL,
                'email' => NULL,
                'observaciones' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2020-05-21 03:45:49',
                'updated_at' => '2020-05-21 03:45:49',
            ),
            3 => 
            array (
                'id' => 4,
                'tipo_documento_id' => 80,
                'nro_documento' => '30-74569321-7',
                'domicilio_id' => 4,
                'telefono' => NULL,
                'email' => NULL,
                'observaciones' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2020-05-21 03:45:49',
                'updated_at' => '2020-05-21 03:45:49',
            ),
            4 => 
            array (
                'id' => 5,
                'tipo_documento_id' => 80,
                'nro_documento' => '30-72135377-7',
                'domicilio_id' => 5,
                'telefono' => NULL,
                'email' => NULL,
                'observaciones' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2020-05-21 03:45:49',
                'updated_at' => '2020-05-21 03:45:49',
            ),
            5 => 
            array (
                'id' => 7,
                'tipo_documento_id' => 80,
                'nro_documento' => '30-57545330-5',
                'domicilio_id' => 7,
                'telefono' => NULL,
                'email' => NULL,
                'observaciones' => NULL,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            6 => 
            array (
                'id' => 8,
                'tipo_documento_id' => 80,
                'nro_documento' => '30-70856857-7',
                'domicilio_id' => 8,
                'telefono' => NULL,
                'email' => NULL,
                'observaciones' => NULL,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            7 => 
            array (
                'id' => 9,
                'tipo_documento_id' => 80,
                'nro_documento' => '30-70945381-1',
                'domicilio_id' => 9,
                'telefono' => '1147680401',
                'email' => 'juan_araoz85@hotmail.com',
                'observaciones' => 'ENCARGADO DEL CAMPO: 15566006',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            8 => 
            array (
                'id' => 10,
                'tipo_documento_id' => 80,
                'nro_documento' => '30-70964079-4',
                'domicilio_id' => 10,
                'telefono' => NULL,
                'email' => NULL,
                'observaciones' => NULL,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            9 => 
            array (
                'id' => 11,
                'tipo_documento_id' => 80,
                'nro_documento' => '30-71088181-9',
                'domicilio_id' => 11,
                'telefono' => NULL,
                'email' => NULL,
                'observaciones' => NULL,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            10 => 
            array (
                'id' => 12,
                'tipo_documento_id' => 80,
                'nro_documento' => '30-71417290-1',
                'domicilio_id' => 12,
                'telefono' => NULL,
                'email' => NULL,
                'observaciones' => NULL,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            11 => 
            array (
                'id' => 13,
                'tipo_documento_id' => 80,
                'nro_documento' => '30-71472455-6',
                'domicilio_id' => 13,
                'telefono' => NULL,
                'email' => NULL,
                'observaciones' => 'NATURAVE',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            12 => 
            array (
                'id' => 14,
                'tipo_documento_id' => 80,
                'nro_documento' => '30-71482036-9',
                'domicilio_id' => 14,
                'telefono' => NULL,
                'email' => NULL,
                'observaciones' => NULL,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            13 => 
            array (
                'id' => 15,
                'tipo_documento_id' => 80,
                'nro_documento' => '30-71507387-7',
                'domicilio_id' => 15,
                'telefono' => NULL,
                'email' => NULL,
                'observaciones' => NULL,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            14 => 
            array (
                'id' => 16,
                'tipo_documento_id' => 80,
                'nro_documento' => '30-71653473-8',
                'domicilio_id' => 16,
                'telefono' => NULL,
                'email' => NULL,
                'observaciones' => NULL,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            15 => 
            array (
                'id' => 17,
                'tipo_documento_id' => 80,
                'nro_documento' => '33-65719765-9',
                'domicilio_id' => 17,
                'telefono' => '1123626519',
                'email' => NULL,
                'observaciones' => 'MANUEL ORTEGA',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            16 => 
            array (
                'id' => 18,
                'tipo_documento_id' => 80,
                'nro_documento' => '33-71648272-9',
                'domicilio_id' => 18,
                'telefono' => NULL,
                'email' => NULL,
                'observaciones' => NULL,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            17 => 
            array (
                'id' => 19,
                'tipo_documento_id' => 80,
                'nro_documento' => '30-64267715-9',
                'domicilio_id' => 19,
                'telefono' => NULL,
                'email' => NULL,
                'observaciones' => NULL,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            18 => 
            array (
                'id' => 20,
                'tipo_documento_id' => 80,
                'nro_documento' => '30-70794361-7',
                'domicilio_id' => 20,
                'telefono' => NULL,
                'email' => NULL,
                'observaciones' => NULL,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            19 => 
            array (
                'id' => 21,
                'tipo_documento_id' => 80,
                'nro_documento' => '30-70844325-1',
                'domicilio_id' => 21,
                'telefono' => NULL,
                'email' => NULL,
                'observaciones' => NULL,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            20 => 
            array (
                'id' => 22,
                'tipo_documento_id' => 80,
                'nro_documento' => '30-57143824-7',
                'domicilio_id' => 22,
                'telefono' => NULL,
                'email' => NULL,
                'observaciones' => NULL,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            21 => 
            array (
                'id' => 23,
                'tipo_documento_id' => 80,
                'nro_documento' => '30-71195840-8',
                'domicilio_id' => 23,
                'telefono' => NULL,
                'email' => NULL,
                'observaciones' => NULL,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}
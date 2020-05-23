<?php

use Illuminate\Database\Seeder;

class AlimentoTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('alimento')->delete();
        
        \DB::table('alimento')->insert(array (
            0 => 
            array (
                'id' => 984,
                'descripcion' => 'TERMINADOR 3 LAS LILAS 16-10-18',
                'tipo' => 1,
                'cliente_id' => 17,
                'gtin' => NULL,
                'created_at' => '2020-05-22 20:55:51',
                'updated_at' => '2020-05-22 20:55:51',
            ),
            1 => 
            array (
                'id' => 1244,
                'descripcion' => 'RETIRO 5 LIZMAN',
                'tipo' => 3,
                'cliente_id' => 8,
                'gtin' => NULL,
                'created_at' => '2020-05-22 20:55:51',
                'updated_at' => '2020-05-22 20:55:51',
            ),
            2 => 
            array (
                'id' => 1246,
            'descripcion' => 'TERMINADOR 3 LA PASTORAL (HARINA)',
                'tipo' => 1,
                'cliente_id' => 9,
                'gtin' => NULL,
                'created_at' => '2020-05-22 20:55:51',
                'updated_at' => '2020-05-22 20:55:51',
            ),
            3 => 
            array (
                'id' => 1251,
                'descripcion' => 'FASE 2 VERANO LEPOULET',
                'tipo' => 3,
                'cliente_id' => 14,
                'gtin' => NULL,
                'created_at' => '2020-05-22 20:55:51',
                'updated_at' => '2020-05-22 20:55:51',
            ),
            4 => 
            array (
                'id' => 1252,
                'descripcion' => 'FASE 3 VERANO LEPOULET',
                'tipo' => 3,
                'cliente_id' => 14,
                'gtin' => NULL,
                'created_at' => '2020-05-22 20:55:51',
                'updated_at' => '2020-05-22 20:55:51',
            ),
            5 => 
            array (
                'id' => 1253,
                'descripcion' => 'FASE 4 VERANO LEPOULET',
                'tipo' => 3,
                'cliente_id' => 14,
                'gtin' => NULL,
                'created_at' => '2020-05-22 20:55:51',
                'updated_at' => '2020-05-22 20:55:51',
            ),
            6 => 
            array (
                'id' => 1254,
                'descripcion' => 'FASE 5 VERANO LEPOULET',
                'tipo' => 3,
                'cliente_id' => 14,
                'gtin' => NULL,
                'created_at' => '2020-05-22 20:55:51',
                'updated_at' => '2020-05-22 20:55:51',
            ),
            7 => 
            array (
                'id' => 1258,
                'descripcion' => 'DESARROLLO 2 LAS LILAS',
                'tipo' => 1,
                'cliente_id' => 17,
                'gtin' => NULL,
                'created_at' => '2020-05-22 20:55:51',
                'updated_at' => '2020-05-22 20:55:51',
            ),
            8 => 
            array (
                'id' => 1259,
                'descripcion' => 'TERMINADOR 1 ATB LAS LILAS',
                'tipo' => 1,
                'cliente_id' => 17,
                'gtin' => NULL,
                'created_at' => '2020-05-22 20:55:51',
                'updated_at' => '2020-05-22 20:55:51',
            ),
            9 => 
            array (
                'id' => 1286,
                'descripcion' => 'FASE 1 REGRINT VERANO 12-11',
                'tipo' => 2,
                'cliente_id' => 15,
                'gtin' => NULL,
                'created_at' => '2020-05-22 20:55:51',
                'updated_at' => '2020-05-22 20:55:51',
            ),
            10 => 
            array (
                'id' => 1287,
                'descripcion' => 'FASE 2 REGRINT VERANO 12-11',
                'tipo' => 2,
                'cliente_id' => 15,
                'gtin' => NULL,
                'created_at' => '2020-05-22 20:55:51',
                'updated_at' => '2020-05-22 20:55:51',
            ),
            11 => 
            array (
                'id' => 1288,
                'descripcion' => 'FASE 3 REGRINT VERANO 12-11',
                'tipo' => 2,
                'cliente_id' => 15,
                'gtin' => NULL,
                'created_at' => '2020-05-22 20:55:51',
                'updated_at' => '2020-05-22 20:55:51',
            ),
            12 => 
            array (
                'id' => 1289,
                'descripcion' => 'FASE 4 REGRINT VERANO 12-11 c/soj',
                'tipo' => 2,
                'cliente_id' => 15,
                'gtin' => NULL,
                'created_at' => '2020-05-22 20:55:51',
                'updated_at' => '2020-05-22 20:55:51',
            ),
            13 => 
            array (
                'id' => 1290,
                'descripcion' => 'FASE 5 REGRINT VERANO 12-11 c/soj',
                'tipo' => 2,
                'cliente_id' => 15,
                'gtin' => NULL,
                'created_at' => '2020-05-22 20:55:51',
                'updated_at' => '2020-05-22 20:55:51',
            ),
            14 => 
            array (
                'id' => 1294,
                'descripcion' => 'FASE 2 VERANO ALIGAFA 22-11',
                'tipo' => 2,
                'cliente_id' => 7,
                'gtin' => NULL,
                'created_at' => '2020-05-22 20:55:51',
                'updated_at' => '2020-05-22 20:55:51',
            ),
            15 => 
            array (
                'id' => 1295,
                'descripcion' => 'FASE 3 VERANO ALIGAFA 22-11',
                'tipo' => 2,
                'cliente_id' => 7,
                'gtin' => NULL,
                'created_at' => '2020-05-22 20:55:51',
                'updated_at' => '2020-05-22 20:55:51',
            ),
            16 => 
            array (
                'id' => 1296,
                'descripcion' => 'FASE 4 VERANO ALIGAFA 22-11',
                'tipo' => 2,
                'cliente_id' => 7,
                'gtin' => NULL,
                'created_at' => '2020-05-22 20:55:51',
                'updated_at' => '2020-05-22 20:55:51',
            ),
            17 => 
            array (
                'id' => 1297,
                'descripcion' => 'FASE 5 VERANO ALIGAFA 22-11',
                'tipo' => 2,
                'cliente_id' => 7,
                'gtin' => NULL,
                'created_at' => '2020-05-22 20:55:51',
                'updated_at' => '2020-05-22 20:55:51',
            ),
            18 => 
            array (
                'id' => 1300,
                'descripcion' => 'CRECIMIENTO 2 TGP 09-12',
                'tipo' => 1,
                'cliente_id' => 12,
                'gtin' => NULL,
                'created_at' => '2020-05-22 20:55:51',
                'updated_at' => '2020-05-22 20:55:51',
            ),
            19 => 
            array (
                'id' => 1301,
                'descripcion' => 'TERMINADOR 1 TGP 09-12',
                'tipo' => 1,
                'cliente_id' => 12,
                'gtin' => NULL,
                'created_at' => '2020-05-22 20:55:51',
                'updated_at' => '2020-05-22 20:55:51',
            ),
        ));
        
        
    }
}
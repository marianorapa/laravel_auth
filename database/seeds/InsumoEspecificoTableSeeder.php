<?php

use Illuminate\Database\Seeder;

class InsumoEspecificoTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('insumo_especifico')->delete();
        
        \DB::table('insumo_especifico')->insert(array (
            0 => 
            array (
                'gtin' => '7790019000070',
                'descripcion' => 'Premix Cerdo Desarrollo NUTREMAS S R L',
                'insumo_trazable_id' => 7,
                'proveedor_id' => 19,
                'created_at' => '2020-05-23 02:22:03',
                'updated_at' => '2020-05-23 02:22:03',
            ),
            1 => 
            array (
                'gtin' => '7790019000094',
                'descripcion' => 'Premix Cerdo Terminación NUTREMAS S R L',
                'insumo_trazable_id' => 8,
                'proveedor_id' => 19,
                'created_at' => '2020-05-23 02:22:03',
                'updated_at' => '2020-05-23 02:22:03',
            ),
            2 => 
            array (
                'gtin' => '7790438000026',
                'descripcion' => 'Premix Pollos Fase 5 CLADAN SA',
                'insumo_trazable_id' => 13,
                'proveedor_id' => 20,
                'created_at' => '2020-05-23 02:22:03',
                'updated_at' => '2020-05-23 02:22:03',
            ),
            3 => 
            array (
                'gtin' => '7790791000121',
                'descripcion' => 'Premix Pollos Fase 2 PRONUT  SRL',
                'insumo_trazable_id' => 10,
                'proveedor_id' => 21,
                'created_at' => '2020-05-23 02:22:03',
                'updated_at' => '2020-05-23 02:22:03',
            ),
            4 => 
            array (
                'gtin' => '7790791000336',
                'descripcion' => 'Premix Pollos Fase 3 PRONUT  SRL',
                'insumo_trazable_id' => 11,
                'proveedor_id' => 21,
                'created_at' => '2020-05-23 02:22:03',
                'updated_at' => '2020-05-23 02:22:03',
            ),
            5 => 
            array (
                'gtin' => '7790791000343',
                'descripcion' => 'Premix Pollos Fase 4 PRONUT  SRL',
                'insumo_trazable_id' => 12,
                'proveedor_id' => 21,
                'created_at' => '2020-05-23 02:22:03',
                'updated_at' => '2020-05-23 02:22:03',
            ),
            6 => 
            array (
                'gtin' => '7790791000350',
                'descripcion' => 'Premix Pollos Fase 5 PRONUT  SRL',
                'insumo_trazable_id' => 13,
                'proveedor_id' => 21,
                'created_at' => '2020-05-23 02:22:03',
                'updated_at' => '2020-05-23 02:22:03',
            ),
            7 => 
            array (
                'gtin' => '7790791000374',
                'descripcion' => 'Premezcla Bovino Fase 1 PRONUT  SRL',
                'insumo_trazable_id' => 19,
                'proveedor_id' => 21,
                'created_at' => '2020-05-23 02:22:03',
                'updated_at' => '2020-05-23 02:22:03',
            ),
            8 => 
            array (
                'gtin' => '7790791000381',
                'descripcion' => 'Premezcla Bovino Fase 2 PRONUT  SRL A',
                'insumo_trazable_id' => 20,
                'proveedor_id' => 21,
                'created_at' => '2020-05-23 02:22:03',
                'updated_at' => '2020-05-23 02:22:03',
            ),
            9 => 
            array (
                'gtin' => '7790791000398',
                'descripcion' => 'Premezcla Bovino Fase 2 PRONUT  SRL B',
                'insumo_trazable_id' => 20,
                'proveedor_id' => 21,
                'created_at' => '2020-05-23 02:22:03',
                'updated_at' => '2020-05-23 02:22:03',
            ),
            10 => 
            array (
                'gtin' => '7790791000404',
                'descripcion' => 'Premezcla Bovino Fase 3 PRONUT  SRL A',
                'insumo_trazable_id' => 21,
                'proveedor_id' => 21,
                'created_at' => '2020-05-23 02:22:03',
                'updated_at' => '2020-05-23 02:22:03',
            ),
            11 => 
            array (
                'gtin' => '7790791000411',
                'descripcion' => 'Premezcla Bovino Fase 3 PRONUT  SRL B',
                'insumo_trazable_id' => 21,
                'proveedor_id' => 21,
                'created_at' => '2020-05-23 02:22:03',
                'updated_at' => '2020-05-23 02:22:03',
            ),
            12 => 
            array (
                'gtin' => '7790791000435',
                'descripcion' => 'Premezcla Bovino Fase 4 PRONUT  SRL A',
                'insumo_trazable_id' => 22,
                'proveedor_id' => 21,
                'created_at' => '2020-05-23 02:22:03',
                'updated_at' => '2020-05-23 02:22:03',
            ),
            13 => 
            array (
                'gtin' => '7790791000510',
                'descripcion' => 'Premezcla Bovino Fase 4 PRONUT  SRL B',
                'insumo_trazable_id' => 22,
                'proveedor_id' => 21,
                'created_at' => '2020-05-23 02:22:03',
                'updated_at' => '2020-05-23 02:22:03',
            ),
            14 => 
            array (
                'gtin' => '7790791000541',
                'descripcion' => 'Premezcla Bovino Fase 5 PRONUT  SRL A',
                'insumo_trazable_id' => 23,
                'proveedor_id' => 21,
                'created_at' => '2020-05-23 02:22:03',
                'updated_at' => '2020-05-23 02:22:03',
            ),
            15 => 
            array (
                'gtin' => '7790791000558',
                'descripcion' => 'Premezcla Bovino Fase 5 PRONUT  SRL B',
                'insumo_trazable_id' => 23,
                'proveedor_id' => 21,
                'created_at' => '2020-05-23 02:22:03',
                'updated_at' => '2020-05-23 02:22:03',
            ),
            16 => 
            array (
                'gtin' => '7790843000055',
                'descripcion' => 'Premix Cerdo Desarrollo BIOFARMA S A',
                'insumo_trazable_id' => 7,
                'proveedor_id' => 22,
                'created_at' => '2020-05-23 02:22:03',
                'updated_at' => '2020-05-23 02:22:03',
            ),
            17 => 
            array (
                'gtin' => '7790843007009',
                'descripcion' => 'Premix Cerdo Terminación BIOFARMA S A P1',
                'insumo_trazable_id' => 8,
                'proveedor_id' => 22,
                'created_at' => '2020-05-23 02:22:03',
                'updated_at' => '2020-05-23 02:22:03',
            ),
            18 => 
            array (
                'gtin' => '7790843007016',
                'descripcion' => 'Premix Cerdo Terminación BIOFARMA S A P2',
                'insumo_trazable_id' => 8,
                'proveedor_id' => 22,
                'created_at' => '2020-05-23 02:22:03',
                'updated_at' => '2020-05-23 02:22:03',
            ),
            19 => 
            array (
                'gtin' => '7790843007023',
                'descripcion' => 'Premix Cerdo Terminación BIOFARMA S A P4',
                'insumo_trazable_id' => 8,
                'proveedor_id' => 22,
                'created_at' => '2020-05-23 02:22:03',
                'updated_at' => '2020-05-23 02:22:03',
            ),
            20 => 
            array (
                'gtin' => '7790843007030',
                'descripcion' => 'Premix Cerdo Terminación BIOFARMA S A P3',
                'insumo_trazable_id' => 8,
                'proveedor_id' => 22,
                'created_at' => '2020-05-23 02:22:03',
                'updated_at' => '2020-05-23 02:22:03',
            ),
            21 => 
            array (
                'gtin' => '7790934000025',
                'descripcion' => 'Premezcla Bovino Fase 2 HERLUDAMA S.A.',
                'insumo_trazable_id' => 20,
                'proveedor_id' => 23,
                'created_at' => '2020-05-23 02:22:03',
                'updated_at' => '2020-05-23 02:22:03',
            ),
            22 => 
            array (
                'gtin' => '7790934000032
',
                'descripcion' => 'Acido Cítrico HERLUDAMA S.A. P1
',
                'insumo_trazable_id' => 24,
                'proveedor_id' => 23,
                'created_at' => '2020-05-23 02:22:03',
                'updated_at' => '2020-05-23 02:22:03',
            ),
            23 => 
            array (
                'gtin' => '7790934000049',
                'descripcion' => 'Acido Cítrico HERLUDAMA S.A. P2',
                'insumo_trazable_id' => 24,
                'proveedor_id' => 23,
                'created_at' => '2020-05-23 02:22:03',
                'updated_at' => '2020-05-23 02:22:03',
            ),
            24 => 
            array (
                'gtin' => '7790934000087',
                'descripcion' => 'Acido Cítrico HERLUDAMA S.A. P3',
                'insumo_trazable_id' => 24,
                'proveedor_id' => 23,
                'created_at' => '2020-05-23 02:22:03',
                'updated_at' => '2020-05-23 02:22:03',
            ),
            25 => 
            array (
                'gtin' => '7790934000094',
                'descripcion' => 'Acido Cítrico HERLUDAMA S.A. P4',
                'insumo_trazable_id' => 24,
                'proveedor_id' => 23,
                'created_at' => '2020-05-23 02:22:03',
                'updated_at' => '2020-05-23 02:22:03',
            ),
        ));
        
        
    }
}
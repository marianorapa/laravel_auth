<?php

use Illuminate\Database\Seeder;

class EmpresaTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('empresa')->delete();
        
        \DB::table('empresa')->insert(array (
            0 => 
            array (
                'id' => 1,
                'denominacion' => 'VILUMAR S.A',
                'fecha_inicio_actividades' => '2003-11-10',
                'created_at' => '2020-05-21 03:45:49',
                'updated_at' => '2020-05-21 03:45:49',
            ),
            1 => 
            array (
                'id' => 2,
                'denominacion' => 'ACME SA',
                'fecha_inicio_actividades' => '1999-05-03',
                'created_at' => '2020-05-21 03:45:49',
                'updated_at' => '2020-05-21 03:45:49',
            ),
            2 => 
            array (
                'id' => 3,
                'denominacion' => 'TRANSPORTES SA',
                'fecha_inicio_actividades' => '1999-05-03',
                'created_at' => '2020-05-21 03:45:49',
                'updated_at' => '2020-05-21 03:45:49',
            ),
            3 => 
            array (
                'id' => 4,
                'denominacion' => 'PROVEEDOR SA',
                'fecha_inicio_actividades' => '2006-02-06',
                'created_at' => '2020-05-21 03:45:49',
                'updated_at' => '2020-05-21 03:45:49',
            ),
            4 => 
            array (
                'id' => 5,
                'denominacion' => 'FabricARG SRL',
                'fecha_inicio_actividades' => '2002-11-08',
                'created_at' => '2020-05-21 03:45:49',
                'updated_at' => '2020-05-21 03:45:49',
            ),
            5 => 
            array (
                'id' => 7,
                'denominacion' => 'ALIGAFA SA',
                'fecha_inicio_actividades' => '1973-09-25',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            6 => 
            array (
                'id' => 8,
                'denominacion' => 'LIZMAN SA',
                'fecha_inicio_actividades' => '2003-10-30',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            7 => 
            array (
                'id' => 9,
                'denominacion' => 'LA PASTORAL DEL PLATA S.A.',
                'fecha_inicio_actividades' => '2005-11-09',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            8 => 
            array (
                'id' => 10,
                'denominacion' => 'PRODUCTOS DE GRANJA LA LUISA SRL',
                'fecha_inicio_actividades' => '2006-05-02',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            9 => 
            array (
                'id' => 11,
                'denominacion' => 'GALLUS-GALLUS S.R.L.',
                'fecha_inicio_actividades' => '2009-01-27',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            10 => 
            array (
                'id' => 12,
                'denominacion' => 'THE GOOD PIG SA',
                'fecha_inicio_actividades' => '2013-07-31',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            11 => 
            array (
                'id' => 13,
                'denominacion' => 'CTS S.R.L.',
                'fecha_inicio_actividades' => '2014-09-25',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            12 => 
            array (
                'id' => 14,
                'denominacion' => 'LEPOULET SRL',
                'fecha_inicio_actividades' => '2014-12-10',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            13 => 
            array (
                'id' => 15,
                'denominacion' => 'REGRINT S.A.',
                'fecha_inicio_actividades' => '2015-10-02',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            14 => 
            array (
                'id' => 16,
                'denominacion' => 'SERVICIOS JGV',
                'fecha_inicio_actividades' => '2019-07-24',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            15 => 
            array (
                'id' => 17,
                'denominacion' => 'ESTANCIAS Y CABANA LAS LILAS SA',
                'fecha_inicio_actividades' => '1992-10-16',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            16 => 
            array (
                'id' => 18,
                'denominacion' => 'EL IMPERIO DEL POLLO',
                'fecha_inicio_actividades' => '2019-05-07',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            17 => 
            array (
                'id' => 19,
                'denominacion' => 'NUTREMAS S R L',
                'fecha_inicio_actividades' => '1990-10-16',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            18 => 
            array (
                'id' => 20,
                'denominacion' => 'CLADAN SA',
                'fecha_inicio_actividades' => '2002-03-21',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            19 => 
            array (
                'id' => 21,
                'denominacion' => 'PRONUT  SRL',
                'fecha_inicio_actividades' => '2003-07-15',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            20 => 
            array (
                'id' => 22,
                'denominacion' => 'BIOFARMA S A',
                'fecha_inicio_actividades' => '1979-03-15',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            21 => 
            array (
                'id' => 23,
                'denominacion' => 'HERLUDAMA S.A.',
                'fecha_inicio_actividades' => '2011-04-04',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            22 => 
            array (
                'id' => 26,
                'denominacion' => 'LERDA GUSTAVO',
                'fecha_inicio_actividades' => NULL,
                'created_at' => '2020-06-13 00:46:51',
                'updated_at' => '2020-06-13 00:46:51',
            ),
            23 => 
            array (
                'id' => 27,
                'denominacion' => 'LOPEZ NICOLAS',
                'fecha_inicio_actividades' => NULL,
                'created_at' => '2020-06-13 00:46:51',
                'updated_at' => '2020-06-13 00:46:51',
            ),
            24 => 
            array (
                'id' => 28,
                'denominacion' => 'TRAVERSO NESTOR TQD',
                'fecha_inicio_actividades' => NULL,
                'created_at' => '2020-06-13 00:46:51',
                'updated_at' => '2020-06-13 00:46:51',
            ),
            25 => 
            array (
                'id' => 29,
                'denominacion' => 'DIPAOLA FABIAN',
                'fecha_inicio_actividades' => NULL,
                'created_at' => '2020-06-13 00:46:51',
                'updated_at' => '2020-06-13 00:46:51',
            ),
            26 => 
            array (
                'id' => 30,
                'denominacion' => 'TOURNIE JUAN',
                'fecha_inicio_actividades' => NULL,
                'created_at' => '2020-06-13 00:46:51',
                'updated_at' => '2020-06-13 00:46:51',
            ),
            27 => 
            array (
                'id' => 31,
                'denominacion' => 'TRAVERZO CARLOS',
                'fecha_inicio_actividades' => NULL,
                'created_at' => '2020-06-13 00:46:51',
                'updated_at' => '2020-06-13 00:46:51',
            ),
        ));
        
        
    }
}
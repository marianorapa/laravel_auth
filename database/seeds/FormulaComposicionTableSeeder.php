<?php

use Illuminate\Database\Seeder;

class FormulaComposicionTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('formula_composicion')->delete();
        
        \DB::table('formula_composicion')->insert(array (
            0 => 
            array (
                'id' => 1,
                'formula_id' => 1,
                'insumo_id' => 1,
                'kilos_por_tonelada' => 675,
                'created_at' => '2020-05-22 21:30:10',
                'updated_at' => '2020-05-22 21:30:10',
            ),
            1 => 
            array (
                'id' => 2,
                'formula_id' => 1,
                'insumo_id' => 2,
                'kilos_por_tonelada' => 255,
                'created_at' => '2020-05-22 21:30:10',
                'updated_at' => '2020-05-22 21:30:10',
            ),
            2 => 
            array (
                'id' => 3,
                'formula_id' => 1,
                'insumo_id' => 6,
                'kilos_por_tonelada' => 10,
                'created_at' => '2020-05-22 21:30:10',
                'updated_at' => '2020-05-22 21:30:10',
            ),
            3 => 
            array (
                'id' => 4,
                'formula_id' => 1,
                'insumo_id' => 8,
                'kilos_por_tonelada' => 60,
                'created_at' => '2020-05-22 21:30:10',
                'updated_at' => '2020-05-22 21:30:10',
            ),
            4 => 
            array (
                'id' => 5,
                'formula_id' => 2,
                'insumo_id' => 1,
                'kilos_por_tonelada' => 638,
                'created_at' => '2020-05-22 21:30:10',
                'updated_at' => '2020-05-22 21:30:10',
            ),
            5 => 
            array (
                'id' => 6,
                'formula_id' => 2,
                'insumo_id' => 2,
                'kilos_por_tonelada' => 320,
                'created_at' => '2020-05-22 21:30:10',
                'updated_at' => '2020-05-22 21:30:10',
            ),
            6 => 
            array (
                'id' => 7,
                'formula_id' => 2,
                'insumo_id' => 3,
                'kilos_por_tonelada' => 28,
                'created_at' => '2020-05-22 21:30:10',
                'updated_at' => '2020-05-22 21:30:10',
            ),
            7 => 
            array (
                'id' => 8,
                'formula_id' => 2,
                'insumo_id' => 13,
                'kilos_por_tonelada' => 12,
                'created_at' => '2020-05-22 21:30:10',
                'updated_at' => '2020-05-22 21:30:10',
            ),
            8 => 
            array (
                'id' => 9,
                'formula_id' => 2,
                'insumo_id' => 20,
                'kilos_por_tonelada' => 2,
                'created_at' => '2020-05-22 21:30:10',
                'updated_at' => '2020-05-22 21:30:10',
            ),
            9 => 
            array (
                'id' => 10,
                'formula_id' => 3,
                'insumo_id' => 1,
                'kilos_por_tonelada' => 723,
                'created_at' => '2020-05-22 21:30:10',
                'updated_at' => '2020-05-22 21:30:10',
            ),
            10 => 
            array (
                'id' => 11,
                'formula_id' => 3,
                'insumo_id' => 2,
                'kilos_por_tonelada' => 255,
                'created_at' => '2020-05-22 21:30:10',
                'updated_at' => '2020-05-22 21:30:10',
            ),
            11 => 
            array (
                'id' => 12,
                'formula_id' => 3,
                'insumo_id' => 8,
                'kilos_por_tonelada' => 22,
                'created_at' => '2020-05-22 21:30:10',
                'updated_at' => '2020-05-22 21:30:10',
            ),
            12 => 
            array (
                'id' => 13,
                'formula_id' => 4,
                'insumo_id' => 1,
                'kilos_por_tonelada' => 508,
                'created_at' => '2020-05-22 21:30:10',
                'updated_at' => '2020-05-22 21:30:10',
            ),
            13 => 
            array (
                'id' => 14,
                'formula_id' => 4,
                'insumo_id' => 2,
                'kilos_por_tonelada' => 430,
                'created_at' => '2020-05-22 21:30:10',
                'updated_at' => '2020-05-22 21:30:10',
            ),
            14 => 
            array (
                'id' => 15,
                'formula_id' => 4,
                'insumo_id' => 3,
                'kilos_por_tonelada' => 40,
                'created_at' => '2020-05-22 21:30:10',
                'updated_at' => '2020-05-22 21:30:10',
            ),
            15 => 
            array (
                'id' => 16,
                'formula_id' => 4,
                'insumo_id' => 5,
                'kilos_por_tonelada' => 3,
                'created_at' => '2020-05-22 21:30:10',
                'updated_at' => '2020-05-22 21:30:10',
            ),
            16 => 
            array (
                'id' => 17,
                'formula_id' => 4,
                'insumo_id' => 10,
                'kilos_por_tonelada' => 19,
                'created_at' => '2020-05-22 21:30:10',
                'updated_at' => '2020-05-22 21:30:10',
            ),
            17 => 
            array (
                'id' => 18,
                'formula_id' => 5,
                'insumo_id' => 1,
                'kilos_por_tonelada' => 506,
                'created_at' => '2020-05-22 21:30:10',
                'updated_at' => '2020-05-22 21:30:10',
            ),
            18 => 
            array (
                'id' => 19,
                'formula_id' => 5,
                'insumo_id' => 2,
                'kilos_por_tonelada' => 330,
                'created_at' => '2020-05-22 21:30:10',
                'updated_at' => '2020-05-22 21:30:10',
            ),
            19 => 
            array (
                'id' => 20,
                'formula_id' => 5,
                'insumo_id' => 3,
                'kilos_por_tonelada' => 25,
                'created_at' => '2020-05-22 21:30:10',
                'updated_at' => '2020-05-22 21:30:10',
            ),
            20 => 
            array (
                'id' => 21,
                'formula_id' => 5,
                'insumo_id' => 4,
                'kilos_por_tonelada' => 115,
                'created_at' => '2020-05-22 21:30:10',
                'updated_at' => '2020-05-22 21:30:10',
            ),
            21 => 
            array (
                'id' => 22,
                'formula_id' => 5,
                'insumo_id' => 5,
                'kilos_por_tonelada' => 7,
                'created_at' => '2020-05-22 21:30:10',
                'updated_at' => '2020-05-22 21:30:10',
            ),
            22 => 
            array (
                'id' => 23,
                'formula_id' => 5,
                'insumo_id' => 11,
                'kilos_por_tonelada' => 17,
                'created_at' => '2020-05-22 21:30:10',
                'updated_at' => '2020-05-22 21:30:10',
            ),
            23 => 
            array (
                'id' => 24,
                'formula_id' => 6,
                'insumo_id' => 1,
                'kilos_por_tonelada' => 576,
                'created_at' => '2020-05-22 21:30:10',
                'updated_at' => '2020-05-22 21:30:10',
            ),
            24 => 
            array (
                'id' => 25,
                'formula_id' => 6,
                'insumo_id' => 2,
                'kilos_por_tonelada' => 190,
                'created_at' => '2020-05-22 21:30:10',
                'updated_at' => '2020-05-22 21:30:10',
            ),
            25 => 
            array (
                'id' => 26,
                'formula_id' => 6,
                'insumo_id' => 3,
                'kilos_por_tonelada' => 22,
                'created_at' => '2020-05-22 21:30:10',
                'updated_at' => '2020-05-22 21:30:10',
            ),
            26 => 
            array (
                'id' => 27,
                'formula_id' => 6,
                'insumo_id' => 4,
                'kilos_por_tonelada' => 190,
                'created_at' => '2020-05-22 21:30:10',
                'updated_at' => '2020-05-22 21:30:10',
            ),
            27 => 
            array (
                'id' => 28,
                'formula_id' => 6,
                'insumo_id' => 5,
                'kilos_por_tonelada' => 6,
                'created_at' => '2020-05-22 21:30:10',
                'updated_at' => '2020-05-22 21:30:10',
            ),
            28 => 
            array (
                'id' => 29,
                'formula_id' => 6,
                'insumo_id' => 12,
                'kilos_por_tonelada' => 16,
                'created_at' => '2020-05-22 21:30:10',
                'updated_at' => '2020-05-22 21:30:10',
            ),
            29 => 
            array (
                'id' => 30,
                'formula_id' => 7,
                'insumo_id' => 1,
                'kilos_por_tonelada' => 619,
                'created_at' => '2020-05-22 21:30:10',
                'updated_at' => '2020-05-22 21:30:10',
            ),
            30 => 
            array (
                'id' => 31,
                'formula_id' => 7,
                'insumo_id' => 2,
                'kilos_por_tonelada' => 125,
                'created_at' => '2020-05-22 21:30:10',
                'updated_at' => '2020-05-22 21:30:10',
            ),
            31 => 
            array (
                'id' => 32,
                'formula_id' => 7,
                'insumo_id' => 3,
                'kilos_por_tonelada' => 14,
                'created_at' => '2020-05-22 21:30:10',
                'updated_at' => '2020-05-22 21:30:10',
            ),
            32 => 
            array (
                'id' => 33,
                'formula_id' => 7,
                'insumo_id' => 4,
                'kilos_por_tonelada' => 220,
                'created_at' => '2020-05-22 21:30:10',
                'updated_at' => '2020-05-22 21:30:10',
            ),
            33 => 
            array (
                'id' => 34,
                'formula_id' => 7,
                'insumo_id' => 5,
                'kilos_por_tonelada' => 8,
                'created_at' => '2020-05-22 21:30:10',
                'updated_at' => '2020-05-22 21:30:10',
            ),
            34 => 
            array (
                'id' => 35,
                'formula_id' => 7,
                'insumo_id' => 13,
                'kilos_por_tonelada' => 14,
                'created_at' => '2020-05-22 21:30:10',
                'updated_at' => '2020-05-22 21:30:10',
            ),
            35 => 
            array (
                'id' => 36,
                'formula_id' => 8,
                'insumo_id' => 1,
                'kilos_por_tonelada' => 615,
                'created_at' => '2020-05-22 21:30:10',
                'updated_at' => '2020-05-22 21:30:10',
            ),
            36 => 
            array (
                'id' => 37,
                'formula_id' => 8,
                'insumo_id' => 2,
                'kilos_por_tonelada' => 315,
                'created_at' => '2020-05-22 21:30:10',
                'updated_at' => '2020-05-22 21:30:10',
            ),
            37 => 
            array (
                'id' => 38,
                'formula_id' => 8,
                'insumo_id' => 6,
                'kilos_por_tonelada' => 30,
                'created_at' => '2020-05-22 21:30:10',
                'updated_at' => '2020-05-22 21:30:10',
            ),
            38 => 
            array (
                'id' => 39,
                'formula_id' => 8,
                'insumo_id' => 7,
                'kilos_por_tonelada' => 40,
                'created_at' => '2020-05-22 21:30:10',
                'updated_at' => '2020-05-22 21:30:10',
            ),
            39 => 
            array (
                'id' => 40,
                'formula_id' => 9,
                'insumo_id' => 1,
                'kilos_por_tonelada' => 595,
                'created_at' => '2020-05-22 21:30:10',
                'updated_at' => '2020-05-22 21:30:10',
            ),
            40 => 
            array (
                'id' => 41,
                'formula_id' => 9,
                'insumo_id' => 2,
                'kilos_por_tonelada' => 335,
                'created_at' => '2020-05-22 21:30:10',
                'updated_at' => '2020-05-22 21:30:10',
            ),
            41 => 
            array (
                'id' => 42,
                'formula_id' => 9,
                'insumo_id' => 6,
                'kilos_por_tonelada' => 30,
                'created_at' => '2020-05-22 21:30:10',
                'updated_at' => '2020-05-22 21:30:10',
            ),
            42 => 
            array (
                'id' => 43,
                'formula_id' => 9,
                'insumo_id' => 8,
                'kilos_por_tonelada' => 40,
                'created_at' => '2020-05-22 21:30:10',
                'updated_at' => '2020-05-22 21:30:10',
            ),
            43 => 
            array (
                'id' => 44,
                'formula_id' => 10,
                'insumo_id' => 1,
                'kilos_por_tonelada' => 476,
                'created_at' => '2020-05-22 21:30:10',
                'updated_at' => '2020-05-22 21:30:10',
            ),
            44 => 
            array (
                'id' => 45,
                'formula_id' => 10,
                'insumo_id' => 2,
                'kilos_por_tonelada' => 430,
                'created_at' => '2020-05-22 21:30:10',
                'updated_at' => '2020-05-22 21:30:10',
            ),
            45 => 
            array (
                'id' => 46,
                'formula_id' => 10,
                'insumo_id' => 3,
                'kilos_por_tonelada' => 70,
                'created_at' => '2020-05-22 21:30:10',
                'updated_at' => '2020-05-22 21:30:10',
            ),
            46 => 
            array (
                'id' => 47,
                'formula_id' => 10,
                'insumo_id' => 5,
                'kilos_por_tonelada' => 3,
                'created_at' => '2020-05-22 21:30:10',
                'updated_at' => '2020-05-22 21:30:10',
            ),
            47 => 
            array (
                'id' => 48,
                'formula_id' => 10,
                'insumo_id' => 19,
                'kilos_por_tonelada' => 21,
                'created_at' => '2020-05-22 21:30:10',
                'updated_at' => '2020-05-22 21:30:10',
            ),
            48 => 
            array (
                'id' => 49,
                'formula_id' => 11,
                'insumo_id' => 1,
                'kilos_por_tonelada' => 521,
                'created_at' => '2020-05-22 21:30:10',
                'updated_at' => '2020-05-22 21:30:10',
            ),
            49 => 
            array (
                'id' => 50,
                'formula_id' => 11,
                'insumo_id' => 2,
                'kilos_por_tonelada' => 390,
                'created_at' => '2020-05-22 21:30:10',
                'updated_at' => '2020-05-22 21:30:10',
            ),
            50 => 
            array (
                'id' => 51,
                'formula_id' => 11,
                'insumo_id' => 3,
                'kilos_por_tonelada' => 70,
                'created_at' => '2020-05-22 21:30:10',
                'updated_at' => '2020-05-22 21:30:10',
            ),
            51 => 
            array (
                'id' => 52,
                'formula_id' => 11,
                'insumo_id' => 20,
                'kilos_por_tonelada' => 19,
                'created_at' => '2020-05-22 21:30:10',
                'updated_at' => '2020-05-22 21:30:10',
            ),
            52 => 
            array (
                'id' => 53,
                'formula_id' => 12,
                'insumo_id' => 1,
                'kilos_por_tonelada' => 563,
                'created_at' => '2020-05-22 21:30:10',
                'updated_at' => '2020-05-22 21:30:10',
            ),
            53 => 
            array (
                'id' => 54,
                'formula_id' => 12,
                'insumo_id' => 2,
                'kilos_por_tonelada' => 360,
                'created_at' => '2020-05-22 21:30:10',
                'updated_at' => '2020-05-22 21:30:10',
            ),
            54 => 
            array (
                'id' => 55,
                'formula_id' => 12,
                'insumo_id' => 3,
                'kilos_por_tonelada' => 60,
                'created_at' => '2020-05-22 21:30:10',
                'updated_at' => '2020-05-22 21:30:10',
            ),
            55 => 
            array (
                'id' => 56,
                'formula_id' => 12,
                'insumo_id' => 21,
                'kilos_por_tonelada' => 17,
                'created_at' => '2020-05-22 21:30:10',
                'updated_at' => '2020-05-22 21:30:10',
            ),
            56 => 
            array (
                'id' => 57,
                'formula_id' => 13,
                'insumo_id' => 1,
                'kilos_por_tonelada' => 624,
                'created_at' => '2020-05-22 21:30:10',
                'updated_at' => '2020-05-22 21:30:10',
            ),
            57 => 
            array (
                'id' => 58,
                'formula_id' => 13,
                'insumo_id' => 2,
                'kilos_por_tonelada' => 245,
                'created_at' => '2020-05-22 21:30:10',
                'updated_at' => '2020-05-22 21:30:10',
            ),
            58 => 
            array (
                'id' => 59,
                'formula_id' => 13,
                'insumo_id' => 3,
                'kilos_por_tonelada' => 60,
                'created_at' => '2020-05-22 21:30:10',
                'updated_at' => '2020-05-22 21:30:10',
            ),
            59 => 
            array (
                'id' => 60,
                'formula_id' => 13,
                'insumo_id' => 4,
                'kilos_por_tonelada' => 55,
                'created_at' => '2020-05-22 21:30:10',
                'updated_at' => '2020-05-22 21:30:10',
            ),
            60 => 
            array (
                'id' => 61,
                'formula_id' => 13,
                'insumo_id' => 22,
                'kilos_por_tonelada' => 16,
                'created_at' => '2020-05-22 21:30:10',
                'updated_at' => '2020-05-22 21:30:10',
            ),
            61 => 
            array (
                'id' => 62,
                'formula_id' => 14,
                'insumo_id' => 1,
                'kilos_por_tonelada' => 656,
                'created_at' => '2020-05-22 21:30:10',
                'updated_at' => '2020-05-22 21:30:10',
            ),
            62 => 
            array (
                'id' => 63,
                'formula_id' => 14,
                'insumo_id' => 2,
                'kilos_por_tonelada' => 200,
                'created_at' => '2020-05-22 21:30:10',
                'updated_at' => '2020-05-22 21:30:10',
            ),
            63 => 
            array (
                'id' => 64,
                'formula_id' => 14,
                'insumo_id' => 3,
                'kilos_por_tonelada' => 40,
                'created_at' => '2020-05-22 21:30:10',
                'updated_at' => '2020-05-22 21:30:10',
            ),
            64 => 
            array (
                'id' => 65,
                'formula_id' => 14,
                'insumo_id' => 4,
                'kilos_por_tonelada' => 90,
                'created_at' => '2020-05-22 21:30:10',
                'updated_at' => '2020-05-22 21:30:10',
            ),
            65 => 
            array (
                'id' => 66,
                'formula_id' => 14,
                'insumo_id' => 23,
                'kilos_por_tonelada' => 14,
                'created_at' => '2020-05-22 21:30:10',
                'updated_at' => '2020-05-22 21:30:10',
            ),
            66 => 
            array (
                'id' => 67,
                'formula_id' => 15,
                'insumo_id' => 1,
                'kilos_por_tonelada' => 492,
                'created_at' => '2020-05-22 21:30:10',
                'updated_at' => '2020-05-22 21:30:10',
            ),
            67 => 
            array (
                'id' => 68,
                'formula_id' => 15,
                'insumo_id' => 2,
                'kilos_por_tonelada' => 423,
                'created_at' => '2020-05-22 21:30:10',
                'updated_at' => '2020-05-22 21:30:10',
            ),
            68 => 
            array (
                'id' => 69,
                'formula_id' => 15,
                'insumo_id' => 3,
                'kilos_por_tonelada' => 66,
                'created_at' => '2020-05-22 21:30:10',
                'updated_at' => '2020-05-22 21:30:10',
            ),
            69 => 
            array (
                'id' => 70,
                'formula_id' => 15,
                'insumo_id' => 24,
                'kilos_por_tonelada' => 2,
                'created_at' => '2020-05-22 21:30:10',
                'updated_at' => '2020-05-22 21:30:10',
            ),
            70 => 
            array (
                'id' => 71,
                'formula_id' => 15,
                'insumo_id' => 20,
                'kilos_por_tonelada' => 17,
                'created_at' => '2020-05-22 21:30:10',
                'updated_at' => '2020-05-22 21:30:10',
            ),
            71 => 
            array (
                'id' => 72,
                'formula_id' => 16,
                'insumo_id' => 1,
                'kilos_por_tonelada' => 553,
                'created_at' => '2020-05-22 21:30:10',
                'updated_at' => '2020-05-22 21:30:10',
            ),
            72 => 
            array (
                'id' => 73,
                'formula_id' => 16,
                'insumo_id' => 2,
                'kilos_por_tonelada' => 365,
                'created_at' => '2020-05-22 21:30:10',
                'updated_at' => '2020-05-22 21:30:10',
            ),
            73 => 
            array (
                'id' => 74,
                'formula_id' => 16,
                'insumo_id' => 3,
                'kilos_por_tonelada' => 63,
                'created_at' => '2020-05-22 21:30:10',
                'updated_at' => '2020-05-22 21:30:10',
            ),
            74 => 
            array (
                'id' => 75,
                'formula_id' => 16,
                'insumo_id' => 24,
                'kilos_por_tonelada' => 2,
                'created_at' => '2020-05-22 21:30:10',
                'updated_at' => '2020-05-22 21:30:10',
            ),
            75 => 
            array (
                'id' => 76,
                'formula_id' => 16,
                'insumo_id' => 21,
                'kilos_por_tonelada' => 17,
                'created_at' => '2020-05-22 21:30:10',
                'updated_at' => '2020-05-22 21:30:10',
            ),
            76 => 
            array (
                'id' => 77,
                'formula_id' => 17,
                'insumo_id' => 1,
                'kilos_por_tonelada' => 616,
                'created_at' => '2020-05-22 21:30:10',
                'updated_at' => '2020-05-22 21:30:10',
            ),
            77 => 
            array (
                'id' => 78,
                'formula_id' => 17,
                'insumo_id' => 2,
                'kilos_por_tonelada' => 304,
                'created_at' => '2020-05-22 21:30:10',
                'updated_at' => '2020-05-22 21:30:10',
            ),
            78 => 
            array (
                'id' => 79,
                'formula_id' => 17,
                'insumo_id' => 3,
                'kilos_por_tonelada' => 63,
                'created_at' => '2020-05-22 21:30:10',
                'updated_at' => '2020-05-22 21:30:10',
            ),
            79 => 
            array (
                'id' => 80,
                'formula_id' => 17,
                'insumo_id' => 24,
                'kilos_por_tonelada' => 2,
                'created_at' => '2020-05-22 21:30:10',
                'updated_at' => '2020-05-22 21:30:10',
            ),
            80 => 
            array (
                'id' => 81,
                'formula_id' => 17,
                'insumo_id' => 22,
                'kilos_por_tonelada' => 15,
                'created_at' => '2020-05-22 21:30:10',
                'updated_at' => '2020-05-22 21:30:10',
            ),
            81 => 
            array (
                'id' => 82,
                'formula_id' => 18,
                'insumo_id' => 1,
                'kilos_por_tonelada' => 631,
                'created_at' => '2020-05-22 21:30:10',
                'updated_at' => '2020-05-22 21:30:10',
            ),
            82 => 
            array (
                'id' => 83,
                'formula_id' => 18,
                'insumo_id' => 2,
                'kilos_por_tonelada' => 290,
                'created_at' => '2020-05-22 21:30:10',
                'updated_at' => '2020-05-22 21:30:10',
            ),
            83 => 
            array (
                'id' => 84,
                'formula_id' => 18,
                'insumo_id' => 3,
                'kilos_por_tonelada' => 63,
                'created_at' => '2020-05-22 21:30:10',
                'updated_at' => '2020-05-22 21:30:10',
            ),
            84 => 
            array (
                'id' => 85,
                'formula_id' => 18,
                'insumo_id' => 24,
                'kilos_por_tonelada' => 2,
                'created_at' => '2020-05-22 21:30:10',
                'updated_at' => '2020-05-22 21:30:10',
            ),
            85 => 
            array (
                'id' => 86,
                'formula_id' => 18,
                'insumo_id' => 23,
                'kilos_por_tonelada' => 14,
                'created_at' => '2020-05-22 21:30:10',
                'updated_at' => '2020-05-22 21:30:10',
            ),
            86 => 
            array (
                'id' => 87,
                'formula_id' => 19,
                'insumo_id' => 1,
                'kilos_por_tonelada' => 670,
                'created_at' => '2020-05-22 21:30:10',
                'updated_at' => '2020-05-22 21:30:10',
            ),
            87 => 
            array (
                'id' => 88,
                'formula_id' => 19,
                'insumo_id' => 2,
                'kilos_por_tonelada' => 300,
                'created_at' => '2020-05-22 21:30:10',
                'updated_at' => '2020-05-22 21:30:10',
            ),
            88 => 
            array (
                'id' => 89,
                'formula_id' => 19,
                'insumo_id' => 6,
                'kilos_por_tonelada' => 5,
                'created_at' => '2020-05-22 21:30:10',
                'updated_at' => '2020-05-22 21:30:10',
            ),
            89 => 
            array (
                'id' => 90,
                'formula_id' => 19,
                'insumo_id' => 7,
                'kilos_por_tonelada' => 25,
                'created_at' => '2020-05-22 21:30:10',
                'updated_at' => '2020-05-22 21:30:10',
            ),
            90 => 
            array (
                'id' => 91,
                'formula_id' => 20,
                'insumo_id' => 1,
                'kilos_por_tonelada' => 710,
                'created_at' => '2020-05-22 21:30:10',
                'updated_at' => '2020-05-22 21:30:10',
            ),
            91 => 
            array (
                'id' => 92,
                'formula_id' => 20,
                'insumo_id' => 2,
                'kilos_por_tonelada' => 265,
                'created_at' => '2020-05-22 21:30:10',
                'updated_at' => '2020-05-22 21:30:10',
            ),
            92 => 
            array (
                'id' => 93,
                'formula_id' => 20,
                'insumo_id' => 8,
                'kilos_por_tonelada' => 25,
                'created_at' => '2020-05-22 21:30:10',
                'updated_at' => '2020-05-22 21:30:10',
            ),
            93 => 
            array (
                'id' => 94,
                'formula_id' => 21,
                'insumo_id' => 1,
                'kilos_por_tonelada' => 675,
                'created_at' => '2020-05-22 21:30:10',
                'updated_at' => '2020-05-22 21:30:10',
            ),
            94 => 
            array (
                'id' => 95,
                'formula_id' => 21,
                'insumo_id' => 2,
                'kilos_por_tonelada' => 255,
                'created_at' => '2020-05-22 21:30:10',
                'updated_at' => '2020-05-22 21:30:10',
            ),
            95 => 
            array (
                'id' => 96,
                'formula_id' => 21,
                'insumo_id' => 6,
                'kilos_por_tonelada' => 30,
                'created_at' => '2020-05-22 21:30:10',
                'updated_at' => '2020-05-22 21:30:10',
            ),
            96 => 
            array (
                'id' => 97,
                'formula_id' => 21,
                'insumo_id' => 8,
                'kilos_por_tonelada' => 40,
                'created_at' => '2020-05-22 21:30:10',
                'updated_at' => '2020-05-22 21:30:10',
            ),
        ));
        
        
    }
}
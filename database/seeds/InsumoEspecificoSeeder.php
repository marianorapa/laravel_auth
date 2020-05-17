<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InsumoEspecificoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
//        $insumoEspecifico = new \App\InsumoEspecifico();
//        $insumoEspecifico->gtin = "98765432132145";
//        $insumoEspecifico->descripcion = "Acidificante 85 Proveedor SA";
//
//        $insumoTrazable = DB::table('insumo_trazable')
//            ->join('insumo', 'insumo_trazable.id', '=', 'insumo.id')
//            ->where('insumo.descripcion', 'like','%Acid%')
//            ->get();
//
//        $insumoEspecifico->insumo_trazable_id = $insumoTrazable->first()->id;
//
//
//        $proveedores = DB::table('proveedor')->join('empresa', 'proveedor.id', '=', 'empresa.id')
//            ->where('empresa.denominacion', 'like', '%PROVEEDOR%')->get();
//
//        $insumoEspecifico->proveedor_id = $proveedores->first()->id;
//
//        $insumoEspecifico->save();




        $insumoEspecifico = new \App\InsumoEspecifico();
        $insumoEspecifico->gtin = "98765432132146";
        $insumoEspecifico->descripcion = "Acidificante 95 Proveedor SA";

        $insumoTrazable = DB::table('insumo_trazable')
            ->join('insumo', 'insumo_trazable.id', '=', 'insumo.id')
            ->where('insumo.descripcion', 'like','%Acid%')
            ->get();

        $insumoEspecifico->insumo_trazable_id = $insumoTrazable->first()->id;


        $proveedores = DB::table('proveedor')->join('empresa', 'proveedor.id', '=', 'empresa.id')
            ->where('empresa.denominacion', 'like', '%PROVEEDOR%')->get();

        $insumoEspecifico->proveedor_id = $proveedores->first()->id;

        $insumoEspecifico->save();




        $insumoEspecifico = new \App\InsumoEspecifico();
        $insumoEspecifico->gtin = "98765432132155";
        $insumoEspecifico->descripcion = "Lactato de sodio 90 Proveedor SA";

        $insumoTrazable = DB::table('insumo_trazable')
            ->join('insumo', 'insumo_trazable.id', '=', 'insumo.id')
            ->where('insumo.descripcion', 'like','%sodio%')
            ->get();

        $insumoEspecifico->insumo_trazable_id = $insumoTrazable->first()->id;


        $proveedores = DB::table('proveedor')->join('empresa', 'proveedor.id', '=', 'empresa.id')
            ->where('empresa.denominacion', 'like', '%PROVEEDOR%')->get();

        $insumoEspecifico->proveedor_id = $proveedores->first()->id;

        $insumoEspecifico->save();



        $insumoEspecifico = new \App\InsumoEspecifico();
        $insumoEspecifico->gtin = "98765899832111";
        $insumoEspecifico->descripcion = "Lactato de sodio 95 FabricARG SRL";

        $insumoTrazable = DB::table('insumo_trazable')
            ->join('insumo', 'insumo_trazable.id', '=', 'insumo.id')
            ->where('insumo.descripcion', 'like','%sodio%')
            ->get();

        $insumoEspecifico->insumo_trazable_id = $insumoTrazable->first()->id;


        $proveedores = DB::table('proveedor')->join('empresa', 'proveedor.id', '=', 'empresa.id')
            ->where('empresa.denominacion', 'like', '%FabricARG%')->get();

        $insumoEspecifico->proveedor_id = $proveedores->first()->id;

        $insumoEspecifico->save();


    }
}

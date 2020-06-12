<?php

namespace App\Http\Controllers;

use App\Insumo;
use App\InsumoEspecifico;
use App\InsumoNoTrazable;
use App\InsumoTrazable;
use App\Proveedor;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\In;

class InsumoController extends Controller
{
    //

    public function index(Request $request){

        $descripcion = $request->get('descripcion');

        // Recuperar todos los insumos
        $insumos = Insumo::descripcion($descripcion)->paginate(10);

        $insumosEspecificos = InsumoEspecifico::descripcion($descripcion)->paginate(10);

        return view('administracion.insumos.index', compact('insumos', 'insumosEspecificos'));
    }

    public function createNormal(){
        // Vista de crear insumo normal
        return view('administracion.insumos.createNormal');
    }

    public function createEspecifico(){
        // Vista de crear insumo especifico

        $insumos = InsumoTrazable::all();
        $proveedores = Proveedor::all();
        return view('administracion.insumos.createEspecifico', compact('proveedores', 'insumos'));
    }

    public function storeNormal(Request $request){
        // Guardar un insumo no especifico
        $validated = $request->validate([
            'descripcion' => 'required',
            'isTrazable' => 'required'
        ]);

        $insumo = new Insumo();
        $insumo->descripcion = $validated['descripcion'];

        $insumo->save();

        if ($validated['isTrazable'] == 'true'){
            $insumoTrazable = new InsumoTrazable();
            $insumoTrazable->insumo()->associate($insumo);
            $insumoTrazable->save();
        }
        else {
            $insumoNoTrazable = new InsumoNoTrazable();
            $insumoNoTrazable->insumo()->associate($insumo);
            $insumoNoTrazable->save();
        }

        return redirect()->action('InsumoController@index')->with('message', 'Insumo registrado con éxito!');
    }

    public function storeEspecifico(Request $request){
        // Guardar un insumo especifico
        $validated = $request->validate([
            'gtin' => 'required|unique:insumo_especifico,gtin',
            'descripcion' => 'required|unique:insumo_especifico,descripcion',
            'proveedor' => 'required|exists:empresa,denominacion',
            'insumoTrazable' => 'required|exists:insumo,descripcion'
        ]);
        // Determinar a que trazable va asociado y proveedor

        $proveedor = Proveedor::nombre($validated['proveedor'])->get()->first();
        $insumo = InsumoTrazable::nombre($validated['insumoTrazable'])->get()->first();

        $insumoEspecifico = new InsumoEspecifico();
        $insumoEspecifico->gtin = $validated['gtin'];
        $insumoEspecifico->descripcion = $validated['descripcion'];
        $insumoEspecifico->insumoTrazable()->associate($insumo);
        $insumoEspecifico->proveedor()->associate($proveedor);
        $insumoEspecifico->save();

        return redirect()->action('InsumoController@index')->with('message', 'Insumo registrado con éxito!');
    }


}

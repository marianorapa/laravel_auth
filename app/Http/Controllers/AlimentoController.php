<?php

namespace App\Http\Controllers;

use App\Alimento;
use App\AlimentoFormula;
use App\alimentoTipo;
use App\Cliente;
use App\Empresa;
use http\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AlimentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $cliente = $request->get('cliente');
        $alimento = $request->get('alimento');
        $tipo = $request->get('tiposearch');
        //
        //id  descrpcion  tipo  empresa.denominacion  gtin
        $alimentos = Alimento::all();
        $alimentoss = DB::table('alimento')
                      ->where('alimento.descripcion','like',"%$alimento%")
                      ->join('cliente','alimento.cliente_id','cliente.id')
                      ->join('empresa','empresa.id','cliente.id')
                      ->where('empresa.denominacion','like',"%$cliente%")
                      ->join('alimento_tipo','alimento.tipo','alimento_tipo.id')
                      ->where('alimento_tipo.descripcion','like',"%$tipo%")
                      ->select('alimento.id as id','alimento.descripcion as descripcion','alimento_tipo.descripcion as tipo','empresa.denominacion as denominacion', 'alimento.gtin as gtin')
                      ->paginate(10);

        return view('administracion.producto.indexProducto',compact('alimentoss'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $clientes = DB::table('cliente')
                    ->join('empresa','cliente.id','empresa.id')
                    ->get();

        $tipos = alimentoTipo::all();
        return view('administracion.producto.createProducto',compact('clientes','tipos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $messages = [
          'required' => 'el campo :attribute es requerido',
        ];

        $validator = Validator::make($request->input(),[
            'cliente' =>'required',
            'tipo' => 'required',
            'descripcion' => 'required|max:255',
            'gtin' => 'max:10'//no se cual es el verdadero rango del gtin (tambien esta validado en la vista)
        ],$messages);

        if ($validator->fails()){
            return back()->withInput()->withErrors($validator);
        }else{
            $cliente = Cliente::find($request->get('cliente'));
            $tipo = alimentoTipo::find($request->get('tipo'));
            $alimentoNew = new Alimento();
            $alimentoNew->cliente_id = $cliente->id;
            $alimentoNew->tipo = $tipo->id;
            $alimentoNew->descripcion = $request->get('descripcion');
            $alimentoNew->gtin = $request->get('gtin');
            $alimentoNew->save();

            /*$nuevaFormula = new AlimentoFormula();
            $nuevaFormula->alimento_id = $alimentoNew->id;
            $nuevaFormula->fecha_desde = now();
            $nuevaFormula->fecha_hasta = null;
            $nuevaFormula->save();*/

            return back()->with('message', 'producto creado.');


        }
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

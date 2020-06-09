<?php

namespace App\Http\Controllers;

use App\Domicilio;
use App\Empresa;
use App\PersonaTipo;
use App\TipoDocumento;
use App\Utils\DomicilioManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class EmpresasController extends Controller
{
    //
    public function index(){

        $proveedores = DB::table('empresa as e')->join('proveedor as p', 'p.id', 'e.id')
            ->select('e.id', 'e.denominacion', 'e.fecha_inicio_actividades', 'p.gln',
                DB::raw("'Proveedor' as tipo"));

        $clientes = DB::table('empresa as e')->join('cliente as c', 'c.id', 'e.id')->select()
            ->select('e.id', 'e.denominacion', 'e.fecha_inicio_actividades',
                DB::raw('null as col1'), DB::raw("'Cliente' as tipo"));

        $transportistas = DB::table('empresa as e')->join('transportista as t', 't.id', 'e.id')
            ->select('e.id', 'e.denominacion', 'e.fecha_inicio_actividades',
                DB::raw('null as col1'), DB::raw("'Transporte' as tipo"));

        $empresas = $proveedores->union($clientes)->union($transportistas)->get();

        return view('administracion.empresas.index', compact('empresas'));
    }

    public function create(){
        return view('administracion.empresas.createEmpresa');
    }

    public function store(Request $request){

        $messages = [
            'required' => 'el campo :attribute es requerido',
        ];

        $validator = Validator::make($request->input(),[
           'denominacion' => 'required|max:255',
           'id_tipo_documento' =>'required',
           'nro_documento' => 'required',
           'email'=>'required',
           'telefono' =>'required',
           'observaciones' => 'required',
           'calle' => 'required',
           'numero' => 'required',
           'provincia' => 'required',
           'localidad' => 'required',
        ],$messages);

        if ($validator->fails()){
            return back()->withInput()->withErrors($validator);
            }else{

                $validatedPersonaTipo = Validator::make($request->input(),[
                    'id_tipo_documento' => ['required', 'exists:tipo_documento,id'],
                    'nro_documento' => ['required'],
    //            'id_tipo_documento,nro_documento' => ['unique'], se podra??
                    'email' => ['required', 'string', 'email', 'max:255'],
                    'telefono' => ['required'],
                    'observaciones' => ['nullable', 'string']
                ]);

                if ($validatedPersonaTipo->fails()){

                    return back()->withInput()->withErrors($validator);
                }
                $empresaexiste = DB::table('persona_tipo')
                                 ->where('tipo_documento_id','=',$request->get('tipo_documento'))
                                 ->where('nro_documento','=',$request->get('nro_documento'))->first();

                if ($empresaexiste){
                    return back()->withInput()->with('error','La entidad que esta tratando de registrar ya existe')->withErrors($validator);
                }

                $domicilio = new  Domicilio();
                DomicilioManager::store($request,$domicilio);


                $tipoDocumento = TipoDocumento::findOrFail($request->get('id_tipo_documento'));

                $persona_tipo = new PersonaTipo();
                $persona_tipo->nro_documento = $request->get('nro_documento');
                $persona_tipo->observaciones = $request->get('observaciones');
                $persona_tipo->telefono = $request->get('telefono');
                $persona_tipo->email = $request->get('email');
                $persona_tipo->tipoDocumento()->associate($tipoDocumento);
                $persona_tipo->domicilio()->associate($domicilio);
                $persona_tipo->save();

                $empresaNew = new Empresa();
                $empresaNew->denominacion = $request->get('denominacion');
                $empresaNew->personaTipo()->associate($persona_tipo);
                $empresaNew->fecha_inicio_actividades = now();
                $empresaNew->save();


                return back()->with('message','Empresa Registrada con exito!');

            }
    }
}

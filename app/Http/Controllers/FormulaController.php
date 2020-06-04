<?php

namespace App\Http\Controllers;

use App\AlimentoFormula;
use App\Cliente;
use App\FormulaComposicion;
use App\Insumo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FormulaController extends Controller
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

//        $formulas = DB::table('alimento_formula')->paginate(10);
        $formulas = AlimentoFormula::cliente($cliente)->alimento($alimento)
            ->paginate(10);
        //id_formula/empresa.denominacion/alimento.descripcion/fecha_desde/fechahasta
        $formulas2 = DB::table("alimento_formula")
                          ->join("alimento","alimento.id","alimento_formula.alimento_id")
                          ->join("cliente","cliente.id","alimento.cliente_id")
                          ->join("empresa","empresa.id","cliente.id")
                          ->where("empresa.denominacion","like","%$cliente%")
                          ->where("alimento.descripcion","like","%$alimento%")
                          ->select("alimento_formula.id as id","empresa.denominacion as denominacion","alimento.descripcion as descripcion","alimento_formula.fecha_desde","alimento_formula.fecha_hasta")
                          ->paginate(10);


        return view('administracion.formula.index',compact('formulas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $clientes = Cliente::all();
        return view('administracion.formula.createFormula',compact('clientes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'cliente' => ['required', 'exists:cliente,id'],
            'producto' => ['required', 'exists:alimento,id'],
            'fechadesde' => ['required', 'after:yesterday']
        ]);

        $idProducto = $request->get('producto');
        $fechaDesde = $request->get('fechadesde');
        $fechaHasta = $request->get('fechahasta');

        $insumos = $request->get('insumos');

        $suma = 0;
        foreach ($insumos as $id=>$content){
            $exists = DB::table('insumo')->find($id);
            if (!$exists){
                return back()->with('error', "El insumo $id no existe.");
            }
            else {
                $suma += $content['cantidad'];
            }
        }

        if ($suma != 1000){
            return back()->with('error', "Las proporciones indicadas deben sumar 1000 kgs. Obtenido: $suma kgs");
        }

        $formula = AlimentoFormula::all()->where('alimento_id', '=', $idProducto)
            ->where('fecha_hasta', '=', null)
            ->first();

        $formula->fecha_hasta = $fechaDesde;
        $formula->save();

        $nuevaFormula = new AlimentoFormula();
        $nuevaFormula->alimento_id = $idProducto;
        $nuevaFormula->fecha_desde = $fechaDesde;
        $nuevaFormula->fecha_hasta = $fechaHasta;
        $nuevaFormula->save();

        foreach ($insumos as $insumo=>$content){
            $composicion = new FormulaComposicion();
            $composicion->formula_id = $nuevaFormula->id;
            $composicion->insumo_id = $insumo;
            $composicion->kilos_por_tonelada = $content['cantidad'];
            $composicion->save();
        }

        return redirect()->action('FormulaController@index')
            ->with('mensaje', 'Formula registrada con éxito!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $nombreAlimento = DB::table("alimento")
                            ->where("alimento.id",'=',$id)
                            ->select("alimento.descripcion")->first();
        $formula= DB::table('formula_composicion')
                    ->join("alimento_formula","alimento_formula.id","formula_composicion.formula_id")
                    ->join("alimento","alimento.id","alimento_formula.alimento_id")
                    ->join("insumo","insumo.id","formula_composicion.insumo_id")
                    ->where("alimento_formula.alimento_id","=",$id)
                    ->where("alimento_formula.fecha_hasta","=",null)
                    ->select("formula_composicion.insumo_id","insumo.descripcion","formula_composicion.kilos_por_tonelada")->get();
        //dd($formula);
        return view("administracion.formula.showFormula",compact('formula','nombreAlimento'));
        //return back()->with('error', 'Funcionalidad aun no disponible!');
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

    public function getAllInsumos(){
        $insumos = Insumo::all();
        return response()->json($insumos);
    }
}

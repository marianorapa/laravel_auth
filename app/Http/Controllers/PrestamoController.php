<?php

namespace App\Http\Controllers;

use App\Utils\PrestamosManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PrestamoController extends Controller
{
    //

    public function index(Request $request)
    {
        $cliente = $request->get('cliente');

        $prestamos = DB::table('prestamo_cliente as pc')
            ->join('op_detalle_no_trazable as opnt', 'opnt.id', 'pc.op_detalle_id')
            ->join('insumo as i', 'i.id', 'opnt.insumo_id')
            ->join('orden_de_produccion_detalle as opd', 'opd.id', 'opnt.op_detalle_id')
            ->join('orden_de_produccion as op', 'op.id', 'opd.op_id')
            ->join('alimento as a', 'a.id', 'op.producto_id')
            ->join('empresa as e', 'e.id', 'a.cliente_id')
            ->where('e.denominacion', 'like', "%$cliente%")
            ->select('pc.id', 'pc.created_at as fecha', 'e.denominacion as cliente', 'i.descripcion as insumo',
                'opd.cantidad', 'pc.cancelado', 'pc.anulado')
            ->orderByDesc('fecha')->get();

        return view('administracion.prestamos.index', compact('prestamos'));
    }

    public function getCreditoCliente(Request $request){
        $idCliente = $request->get('id');

        return PrestamosManager::getLimiteRestanteCliente($idCliente);
    }
}

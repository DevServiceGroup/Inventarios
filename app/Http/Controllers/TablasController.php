<?php

namespace App\Http\Controllers;

use App\Models\Clientes;
use App\Models\Detalle_movimientos;
use App\Models\Entradas;
use App\Models\Estados;
use App\Models\Movimientos;
use App\Models\Productos;
use App\Models\Salidas;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasRoles;

// use Illuminate\Http\Request;

class TablasController extends Controller
{
    use HasRoles;
    public function salidas()
    {
        $salidas = Movimientos::all()->where('tipo', 'SALIDA');
        foreach ($salidas as $salida) {
            $dia = new DateTime($salida->created_at);
            $salida->creacion = $dia->format('Y-m-d');
            $salida->estado = Estados::find($salida->estados_id)->estado;
            if ($salida->estado == "Anulada") {
                $salida->anulado = "si";
            } else {
                $salida->anulado = "no";
            }
        }
        return response()->json($salidas);
    }
    public function entradas()
    {
        $entradas = Movimientos::all()->where('tipo', 'ENTRADA');
        foreach ($entradas as $entrada) {
            $cliente = Clientes::find($entrada->clientes_id)->nombre;
            $entrada->namecliente = $cliente;
        }
        return response()->json($entradas);
    }
    public function vewEntradas($id){
        $entradas=Detalle_movimientos::where('movimiento_id',$id)->get();
        foreach ($entradas as $entrada) {
            $producto = Productos::find($entrada->productos_id);
            $entrada->referencia=$producto->referencia;
            $entrada->descripcion=$producto->descripcion;
            $entrada->totalstock=$producto->stock;
        }
        return response()->json($entradas);
    }
    public function vewSalidas($mensaje){
        $salidas=Detalle_movimientos::where('movimiento_id',$mensaje)->get();
        foreach ($salidas as $salida) {
            $producto = Productos::find($salida->productos_id);
            $salida->referencia=$producto->referencia;
            $salida->descripcion=$producto->descripcion;
            $salida->totalstock=$producto->stock;
        }
        return response()->json($salidas);
    }
    public function verinventario(){
        $productos = Productos::all();

        return response()->json($productos);
    }

}

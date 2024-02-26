<?php

namespace App\Http\Controllers;

use App\Models\Clientes;
use App\Models\Detalle_movimientos;
use App\Models\Entradas;
use App\Models\Estados;
use App\Models\Movimientos;
use App\Models\Productos;
use App\Models\Salidas;
use App\Models\User;
use App\Models\Users_has_clientes;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasRoles;

// use Illuminate\Http\Request;

class TablasController extends Controller
{
    use HasRoles;
    public function salidas()
    {
        if (User::find(Auth::id())->getRoleNames()->first() == 'admin') {
            $salidas = Movimientos::all()->where('tipo', 'SALIDA');
        } else {
            $salidas = Movimientos::all()->where('tipo', 'SALIDA')->where('clientes_id',Users_has_clientes::all()->where('users_id',Auth::id())->first()->clientes_id);
        }
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
        if (User::find(Auth::id())->getRoleNames()->first() == 'admin') {
            $entradas = Movimientos::all()->where('tipo', 'ENTRADA');
        } else {
            $entradas = Movimientos::all()->where('tipo', 'ENTRADA')->where('clientes_id',Users_has_clientes::all()->where('users_id',Auth::id())->first()->clientes_id);
        }
        foreach ($entradas as $entrada) {
            $cliente = Clientes::find($entrada->clientes_id)->nombre;
            $entrada->namecliente = $cliente;
        }
        return response()->json($entradas);
    }
    public function vewEntradas($id)
    {
        $entradas = Detalle_movimientos::where('movimiento_id', $id)->get();
        foreach ($entradas as $entrada) {
            $producto = Productos::find($entrada->productos_id);
            $entrada->referencia = $producto->referencia;
            $entrada->descripcion = $producto->descripcion;
            $entrada->totalstock = $producto->stock;
        }
        return response()->json($entradas);
    }
    public function vewSalidas($mensaje)
    {
        $salidas = Detalle_movimientos::where('movimiento_id', $mensaje)->get();
        foreach ($salidas as $salida) {
            $producto = Productos::find($salida->productos_id);
            $id = Auth::id();
            $users = Users_has_clientes::where('users_id', $id)->get();
            foreach ($users as $user) {
                if ($producto->clientes_id == $user->clientes_id) {
                    $salida->referencia = $producto->referencia;
                    $salida->descripcion = $producto->descripcion;
                    $salida->totalstock = $producto->stock;
                } else {
                    continue;
                }
            }
        }
        return response()->json($salidas);
    }
    public function verinventario()
    {
        $id = Auth::id();
        $users = Users_has_clientes::where('users_id', $id)->get();
        $i = 0;
        foreach ($users as $user) {
            $productosa = Productos::all()->where('clientes_id', $user->clientes_id);
            foreach ($productosa as $productosb) {
                if ($productosb == null) {
                    continue;
                }
                $productos[$i] = $productosb;
                $i++;
            }
        }
        return response()->json($productos);
    }
}

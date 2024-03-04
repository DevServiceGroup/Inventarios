<?php

namespace App\Http\Controllers;

use App\Imports\SalidasImport;
use App\Mail\InventariosMail;
use App\Models\Clientes;
use App\Models\Detalle_movimientos;
use App\Models\Productos;
use App\Models\Movimientos;
use App\Models\Users_has_clientes;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Traits\HasRoles;

class SalidasController extends Controller
{
    use HasRoles;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuario = Auth::user();
        $roles = $usuario->getRoleNames()->first();
        if ($roles == 'admin') {
            $admin = 'si';
        } else {
            $admin = 'no';
        }
        return view('salidas')->with('productos', Productos::all())->with('admin', $admin)->with('clientes', Clientes::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->hasFile('archivo') && $request->filled('cliente')) {
            $exel = $request->file('archivo');
            $entradas = new Movimientos();
            $entradas->tipo = "SALIDA";
            $entradas->estados_id = 1;
            if ($request->filled('cliente')) {
                $entradas->clientes_id = $request->filled('cliente');
            } else {
                $entradas->clientes_id = Users_has_clientes::find(Auth::id())->clientes_id;
            }
            $entradas->save();
            $id = $entradas->id;
            $bien = Excel::import(new SalidasImport($id), $exel);
            if ($bien != 'exedido') {
                return redirect()->back()->with('bien', 'si');
            } else {
                return redirect()->back()->with('exedido', 'si');
            }
        }
        if ($request->filled('referencia') && $request->filled('cantidad')) {
            $productos = Productos::find($request->input('referencia'));
            $productos->stock = $productos->stock - $request->input('cantidad');
            if ($productos->stock >= 0) {
                $productos->save();
                $newsalida = new Movimientos();
                $newsalida->cantidad = $request->input('cantidad');
                $newsalida->estados_id = 1;
                $newsalida->tipo = 'SALIDA';
                if ($request->filled('cliente')) {
                    $newsalida->clientes_id = $request->filled('cliente');
                } else {
                    $newsalida->clientes_id = Users_has_clientes::all()->where('users_id', Auth::id())->first()->clientes_id;
                }
                $newsalida->save();
                $newdetallesalida = new Detalle_movimientos();
                $newdetallesalida->movimiento_id = $newsalida->id;
                $newdetallesalida->productos_id = $productos->id;
                $newdetallesalida->cantidad = $request->input('cantidad');
                // Mail::to('correodejorge@gmail.com')->send(new InventariosMail);
                $newdetallesalida->save();
                return redirect()->back()->with('bien', 'si');
            } else {
                return redirect()->back()->with('exedido', 'si');
            }
        }
        return redirect()->back()->with('datos', 'inco');
    }
    //$productos = Productos::find($request->input('referencia'));
    //$productos->stock = $productos->stock - $request->input('cantidad');

    /**
     * Display the specified resource.
     */
    public function show(Movimientos $salida)
    {
        $salida->fecha = Carbon::now()->toDateString();
        $salida->estados_id = 2;
        $salida->save();
        return redirect()->back()->with('estado', 'si');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Movimientos $salida)
    {
        $salida->estados_id = 3;
        $salida->update();
        return redirect()->back()->with('estado', 'si');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Movimientos $salida)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Movimientos $salida)
    {
    }
    public function entregado(Movimientos $salida)
    {
        $salida->estados_id = 4;
        $salida->update();
        return redirect()->back()->with('estado', 'si');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Clientes;
use App\Models\Productos;
use App\Models\Tipo_productos;
use Illuminate\Http\Request;

class ProductosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
     
        return view('nuevoproduc')->with('clientes', Clientes::all())->with('tipos',Tipo_productos::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->filled('tipo_producto') && $request->filled('cliente')) {
            $newtipoproducto = new Tipo_productos();
            $newtipoproducto->clientes_id = $request->input('cliente');
            $newtipoproducto->nombre = $request->input('tipo_producto');
            if ($newtipoproducto->save()) {
                return redirect()->back()->with('bien','si');
            }else {
                return redirect()->back()->with('bien','no');
            }
            
        } else if ($request->filled('referencia') && $request->filled('descripcion') && $request->filled('tipo_de_producto')) {
            $newproducto = new Productos();
            $newproducto->referencia = $request->input('referencia');
            $newproducto->descripcion = $request->input('descripcion');
            $newproducto->tipo_productos_id = $request->input('tipo_de_producto');
            if ($newproducto->save()) {
                return redirect()->back()->with('bien','si');
            }else {
                return redirect()->back()->with('bien','no');
            }
            
        } else if ($request->filled('nombre_cliente') && $request->filled('nit')) {
            $newcliente = new Clientes();
            $newcliente->nombre = $request->input('nombre_cliente');
            $newcliente->nit = $request->input('nit');
            if ($newcliente->save()) {
                return redirect()->back()->with('bien','si');
            }else {
                return redirect()->back()->with('bien','no');
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Productos $productos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Productos $productos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Productos $productos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Productos $productos)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Imports\EntradasImport;
use App\Models\Clientes;
use App\Models\Movimientos;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class EntradasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('entrada')->with('clientes', Clientes::all());
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
        if ($request->hasFile('exel')) {
            $exel = $request->file('exel');
            $fecha = $request->input('fecha');
            
            $entradas = new Movimientos();
            $entradas->tipo = "ENTRADA";
            $entradas->estados_id = 1;
            $entradas->fecha = $fecha;
            $entradas->clientes_id = $request->input('cliente');
            $entradas->save();
            $id=$entradas->id;
            Excel::import(new EntradasImport($id), $exel);
            

            return redirect()->back()->with('bien', 'si');
        }
        
        return redirect()->back()->with('error', 'si');
    }

    /**
     * Display the specified resource.
     */
    public function show(Movimientos $movimientos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Movimientos $movimientos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Movimientos $movimientos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Movimientos $movimientos)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Clientes;
use App\Models\User;
use App\Models\Users_has_clientes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ClientesController extends Controller
{
    public function index()
    {
        $clientes = Clientes::all();
        return view('registercliente')->with('clientes', $clientes);
    }
    public function store(Request $request)
    {
        if ($request->filled('nombre') && $request->filled('correo') && $request->filled('contraseña') && $request->filled('cliente')) {
            $user = new User();
            $user->name = $request->input('nombre');
            $user->email = $request->input('correo');
            $user->password = Hash::make($request->input('contraseña'));
            $user->assignRole('ciente');
            $user->save();
            $user_cliente = new Users_has_clientes();
            $user_cliente->users_id = $user->id;
            $user_cliente->clientes_id = $request->input('cliente');
            $user_cliente->save();

            return redirect()->back()->with('datos','ok');
        }else{
            return redirect()->back()->with('datos','faltan');
        }
    }
}

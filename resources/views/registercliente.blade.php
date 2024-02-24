@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Nuevo Cliente</h1>
@stop

@section('content')
    <div class="container">
        <div class="card col-6 m-auto">
            <div class="card-body">
                <h4 class="card-title mb-3">Cliente</h4>
                <form action="{{route('admin.cliente.store')}}" method="post" class="card-text">
                    @csrf
                    <div class="form-group ">
                        <label for="">Nombre</label>
                        <input type="text" class="form-control" name="nombre" id="" aria-describedby="helpId"
                            placeholder="">
                    </div>
                    <div class="form-group ">
                        <label for="">Correo</label>
                        <input type="text" class="form-control" name="correo" id="" aria-describedby="helpId"
                            placeholder="">
                    </div>
                    <div class="form-group ">
                        <label for="">Contraseña</label>
                        <input type="password" class="form-control" name="contraseña" id="" placeholder="">
                    </div>
                    <div class="form-group ">
                        <label for="">Empresa</label>
                        <select name="cliente" id="" class="form-control">
                            <option value="" disabled selected></option>
                            @foreach ($clientes as $cliente)
                                <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success m-auto col-4">Enviar</button>
                </form>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.0/css/dataTables.dataTables.min.css">

@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.datatables.net/2.0.0/js/dataTables.min.js"></script>

    @if (session('datos') == 'ok')
        <script>
            Swal.fire({
                title: "Creado Correctamente",
                text: "usuario creado con Exito",
                icon: "success"
            });
        </script>
    @endif
    @if (session('datos') == 'faltan')
        <script>
            Swal.fire({
                title: "Error",
                text: "Rellene todos los datos",
                icon: "error"
            });
        </script>
    @endif
@stop

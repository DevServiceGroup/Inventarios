@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class="accordion" id="accordionExample">
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                    Crear Nuevo Tipo de Producto
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Nuevo tipo producto</h4>
                            <p class="card-text">
                            <form action="{{ route('admin.productos.store') }}" method="post" class="row">
                                @csrf
                                <div class="form-group col-6">
                                    <label for="">Nombre del Producto</label>
                                    <input type="text" name="tipo_producto" class="form-control"
                                        aria-describedby="tipo_producto" placeholder="Nombre del Producto">
                                </div>
                                <div class="form-group col-6">
                                    <label for="">Cliente</label>
                                    <select name="cliente" id="" class="form-control">
                                        <option value="" selected disabled>Eliga el Cliente</option>
                                        @foreach ($clientes as $cliente)
                                            <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-success m-auto col-4">Enviar</button>
                            </form>
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    Crear Nuevo Articulo
                </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <div class="card">
                        <img class="card-img-top" src="holder.js/100x180/" alt="">
                        <div class="card-body">
                            <h4 class="card-title">Nuevo Articulo</h4>
                            <p class="card-text">
                            <form action="{{ route('admin.productos.store') }}" method="post" class="row">
                                @csrf
                                <div class="form-group col-6">
                                    <label for="">Tipo de Producto</label>
                                    <select name="tipo_de_producto" id="" class="form-control">
                                        <option value="" selected disabled>Eliga el tipo</option>
                                        @foreach ($tipos as $tipo)
                                            <option value="{{ $tipo->id }}">{{ $tipo->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-6">
                                    <label for="">Referencia</label>
                                    <input type="text" name="referencia" class="form-control"
                                        aria-describedby="referencia">
                                </div>
                                <div class="form-group col-12">
                                    <label for="">Descripcion</label>
                                    <input type="text" name="descripcion" class="form-control"
                                        aria-describedby="nombre_producto">
                                </div>
                                <button type="submit" class="btn btn-success m-auto col-4">Enviar</button>
                            </form>
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    Crear Nuevo Cliente
                </button>
            </h2>
            <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Nuevo Cliente</h4>
                            <p class="card-text">
                            <form action="{{ route('admin.productos.store') }}" method="post" class="row">
                                @csrf
                                <div class="form-group col-6">
                                    <label for="">Nombre</label>
                                    <input type="text" name="nombre_cliente" id="" class="form-control"
                                        placeholder="Nombre">
                                </div>
                                <div class="form-group col-6">
                                    <label for="nit">Nit</label>
                                    <input type="text" name="nit" id="nit" class="form-control"
                                        placeholder="900.100.000">
                                </div>
                                <button type="submit" class="btn btn-success m-auto col-4">Enviar</button>
                            </form>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session('bien') == 'si')
        <script>
            console.log('esta')
        </script>
        <script>
            Swal.fire({
                title: "Creado",
                text: "El registro se creo correctamente",
                icon: "success"
            });
        </script>
    @endif
    @if (session('bien') == 'no')
        <script>
            Swal.fire({
                title: "Error",
                text: "El registor se creo correctamente",
                icon: "error"
            });
        </script>
    @endif
@stop

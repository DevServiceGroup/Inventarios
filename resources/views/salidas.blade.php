@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Registrar salida de productos</h1>
@stop

@section('content')

    <div class="row">
        @if ($admin == 'no')
            <div class="card col m-2">
                <div class="card-body">
                    <h4 class="card-title">Individual</h4>
                    <p class="card-text">
                    <form action="{{ route('admin.salidas.store') }}" method="post" class="row">
                        @csrf
                        <div class="form-group">
                            <label for="">Referencia</label>
                            <select name="referencia" id="" class="form-control">
                                <option value="" disabled selected></option>
                                @foreach ($productos as $producto)
                                    <option value="{{ $producto->id }}">{{ $producto->referencia }}</option>
                                @endforeach
                            </select>
                        </div>
                        @if ($admin == 'si')
                            <div class="form-group">
                                <label for="">Cliente</label>
                                <select name="cliente" id="" class="form-control">
                                    <option value="" disabled selected></option>
                                    @foreach ($clientes as $cliente)
                                        <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif
                        <div class="form-group">
                            <label for="">Cantidad</label>
                            <input class="form-control" type="number" name="cantidad">
                        </div>
                        <button type="submit" class="btn btn-success m-auto col-4">Enviar</button>
                    </form>
                    </p>
                </div>
            </div>
            <div class="card col m-2">
                <div class="card-body">
                    <h4 class="card-title">Multiple</h4>
                    <p class="card-text">
                    <form action="{{ route('admin.salidas.store') }}" method="post" class="row"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="">Archivo de Exel</label>
                            <input type="file" name="archivo" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="">Cliente</label>
                            <select name="cliente" id="" class="form-control">
                                <option value="" disabled selected></option>
                                @foreach ($clientes as $cliente)
                                    <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            {{-- <label for="" class="col-12">Plantilla</label> --}}
                            <button type="button" class="btn btn-danger mt-4">Descargar Plantilla</button>
                        </div>
                        <button type="submit" class="btn btn-success m-auto col-4">Enviar</button>
                    </form>
                    </p>
                </div>
            </div>
    </div>
    @endif
    <div class="card">
        <img class="card-img-top" src="holder.js/100x180/" alt="">
        <div class="card-body">
            <h4 class="card-title">Salidas</h4>
            <div class="card-text">
                <table id="example" class="table table-striped" style="width:100%;">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Fecha Creacion</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Fecha Salida</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <div class="modal fade " id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="close cerrarModal" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Referencia</th>
                                <th>Descripcion</th>
                                <th>Cantidad Ingresada</th>
                                <th>Stock Total</th>
                            </tr>
                        </thead>
                        <tbody id="modalTableBody">

                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary cerrarModal" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save</button>
                </div>
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

    <script>
        $(document).ready(function() {
            $(".cerrarModal").click(function() {
                $("#modelId").modal('hide');
            });
            var dataTable = $('#example').DataTable({
                scrollY: '450px',
                paging: true,
                searching: true
            });

            var admin = "{{ $admin }}";

            $.ajax({
                url: '{{ url('/salidas') }}',
                method: 'GET',
                dataType: 'json',
                success: function(data) {

                    // Iterar sobre los datos y agregar filas a la tabla
                    $.each(data, function(index, item) {
                        var enlace = '';
                        if (admin == 'si' && item.anulado == 'no' && item.estados_id == 1) {
                            var showUrl =
                                "{{ route('admin.salidas.show', ['salida' => ':id']) }}";
                            showUrl = showUrl.replace(':id', item.id);
                            enlace = "<a href='" + showUrl +
                                "' class='btn btn-danger m-1'>Completar</a>";
                        } else if (admin == 'no' && item.anulado == 'no') {
                            var direccion =
                                "{{ route('admin.salidas.edit', ['salida' => ':id']) }}";
                            direccion = direccion.replace(':id', item.id);
                            enlace = "<a href='" + direccion +
                                "' class='btn btn-secondary m-1'>Anular</a>";
                        }
                        enlace = enlace +
                            '<button type="button" class="btn btn-primary btn-ver-detalles m-1" data-toggle="modal" data-target="#modelId" data-id="' +
                            item.id + '">Ver Detalles</button>',

                            dataTable.row.add([
                                item.id,
                                item.creacion,
                                item.cantidad,
                                item.fecha,
                                item.estado,
                                enlace,
                            ]).draw(false);
                    });
                    $('.btn-ver-detalles').on('click', function() {
                        var itemId = $(this).data('id');
                        console.log(itemId);
                        // Realizar solicitud AJAX para obtener detalles del controlador
                        $.ajax({
                            url: '/vewSalidas/' + itemId,
                            method: 'GET',
                            success: function(response) {
                                console.log(response);
                                // Llenar el modal con los datos obtenidos
                                $('#modalTableBody')
                                    .empty(); // Limpiar el cuerpo de la tabla en el modal

                                // Iterar sobre los detalles obtenidos y agregar filas a la tabla dentro del modal
                                $.each(response, function(index,
                                    detalle) {
                                    $('#modalTableBody').append(
                                        '<tr><td>' + detalle
                                        .id +
                                        '</td><td>' +
                                        detalle.referencia +
                                        '</td><td>' +
                                        detalle
                                        .descripcion +
                                        '</td><td>' +
                                        detalle.cantidad +
                                        '</td><td>' +
                                        detalle.totalstock +
                                        '</td></tr>');
                                });

                                // Mostrar el modal
                                $('#modelId').modal('show');
                            },
                            error: function(error) {
                                console.error(
                                    'Error al obtener detalles:',
                                    error);
                            }
                        });
                    });
                },
                error: function(error) {
                    console.error('Error en la solicitud Ajax: ', error);
                }
            });
        });
    </script>
    @if (session('bien') == 'si')
        <script>
            Swal.fire({
                title: "Salida en proceso",
                text: "En el transcurso del dia haremos la salida",
                icon: "success"
            });
        </script>
    @endif
    @if (session('exedido') == 'si')
        <script>
            Swal.fire({
                title: "Error",
                text: "Stock exedido",
                icon: "error"
            });
        </script>
    @endif
    @if (session('datos') == 'inco')
        <script>
            Swal.fire({
                title: "Error",
                text: "Digite los datos necesarios",
                icon: "error"
            });
        </script>
    @endif
    @if (session('encontrado') == 'no')
        <script>
            Swal.fire({
                title: "Error",
                text: "El producto no esta creado",
                icon: "error"
            });
        </script>
    @endif
    @if (session('estado') == 'si')
        <script>
            Swal.fire({
                title: "Exitoso",
                text: "Se cambio el estado",
                icon: "success"
            });
        </script>
    @endif
@stop

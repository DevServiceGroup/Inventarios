@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    @if ($admin == 'si')
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Entrada de Productos</h4>
                <p class="card-text">
                <form action="{{ route('admin.entradas.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="archivo">Suba el Archivo</label>
                        <input class="form-control" type="file" name="exel" accept=".xls , .xlsx" id="archivo">
                    </div>
                    <div class="form-group">
                        <label for="archivo">Fecha</label>
                        <input class="form-control" type="date" name="fecha">
                    </div>


                    <div class="form-group">
                        <label for="archivo">Cliente</label>
                        <select name="cliente" id="" class="form-control">
                            <option value="" disabled selected></option>
                            @foreach ($clientes as $cliente)
                                <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success m-auto">Enviar</button>
                    <button type="button" class="btn btn-danger m-auto">Ver Entradas</button>
                </form>
                </p>
            </div>
        </div>
    @endif
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Lisra de Entradas</h4>
            <div class="card-text">
                <table id="example" class="table table-striped" style="width:100%; ">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Fecha</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
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
                $("#modelId").modal('hide')
            });
            var dataTable = $('#example').DataTable({
                scrollY: '450px',
                paging: true, // Habilitar paginación
                searching: true
            });
            // Hacer la solicitud Ajax al servidor Laravel
            $.ajax({
                url: '{{ url('/entradas') }}',
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    // Limpiar la tabla antes de agregar nuevos datos
                    dataTable.clear().draw();

                    // Iterar sobre los datos y agregar filas a la tabla
                    $.each(data, function(index, item) {
                        dataTable.row.add([
                            item.id,
                            item.fecha,
                            item.cantidad,
                            item.namecliente,
                            '<button type="button" class="btn btn-primary btn-ver-detalles" data-toggle="modal" data-target="#modelId" data-id="' +
                            item.id + '">Ver Detalles</button>'
                        ]).draw(false);
                    });

                    $('.btn-ver-detalles').on('click', function() {
                        var itemId = $(this).data('id');
                        // Realizar solicitud AJAX para obtener detalles del controlador
                        $.ajax({
                            url: '/vewEntradas/' + itemId,
                            method: 'GET',
                            success: function(response) {
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
    @if (session('encontrado') == 'no')
        <script>
            Swal.fire({
                title: "Error",
                text: "El producto no esta creado",
                icon: "error"
            });
        </script>
    @endif
    @if (session('error') == 'si')
        <script>
            Swal.fire({
                title: "Error",
                text: "Error, por favor verifique los datos",
                icon: "error"
            });
        </script>
    @endif
@stop

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
@stop

@section('content')
    <div class="card mt-4">
        <div class="card-body">
            <h4 class="card-title">Inventarios</h4>
            <div class="card-text">
                <table id="tabla1" class="table table-striped" style="width:100%; ">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Referencia</th>
                            <th>Descripcion</th>
                            <th>Stock</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
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
            var dataTable = $('#tabla1').DataTable({
                scrollY: '450px',
                paging: true, // Habilitar paginación
                searching: true
            });
            // Hacer la solicitud Ajax al servidor Laravel
            $.ajax({
                url: '{{ url('/verinventario') }}',
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    // Limpiar la tabla antes de agregar nuevos datos
                    dataTable.clear().draw();
                    // Iterar sobre los datos y agregar filas a la tabla
                    $.each(data, function(index, item) {
                        dataTable.row.add([
                            item.id,
                            item.referencia,
                            item.descripcion,
                            item.stock,
                        ]).draw(false);
                    });
                },
                error: function(error) {
                    console.error('Error en la solicitud Ajax: ', error);
                }
            });
        });
    </script>
@stop

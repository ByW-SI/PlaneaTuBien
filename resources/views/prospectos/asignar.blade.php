@extends('principal')
@section('content')

<div class="card">
    <div class="card-header">
        <div class="row">
            <h4>Asignar asesor</h4>
        </div>
    </div>
    <div class="card-body">
        <div id="alert" style="display: none;">
            <div class="alert alert-success" role="alert">
                <strong>Exito!</strong> Se asigno al asesor correctamente.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
            <div class="row">
                <div class="col-sm-5">
                    <form method="post" id="formdata">
                    @csrf
                    <h5 class="text-center"><strong>Prospectos</strong></h5>
                    <table id="prospectosTable" class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Apellido paterno</th>
                                <th>Apellido materno</th>
                                <th>Correo</th>
                                <th>Seleccionar</th>
                            </tr>
                        </thead>
                        <tbody id="cuerpoProspectos">
                            @foreach($prospectos as $prospecto)
                            <tr>
                                <td>{{ $prospecto->nombre }}</td>
                                <td>{{ $prospecto->appaterno }}</td>
                                <td>{{ $prospecto->apmaterno }}</td>
                                <td>{{ $prospecto->email }}</td>
                                <td>
                                    <input type="checkbox" name="prospecto_id[]" value="{{ $prospecto->id }}">
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    </form>
                </div>
                <div class="col-sm-5 offset-2">
                    <h5 class="text-center"><strong>Asesores</strong></h5>
                    <table id="asesoresTable" class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Nombre completo</th>
                                <th>Correo</th>
                                <th>Seleccionar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($asesores as $asesor)
                            <tr>
                                <td>{{ $asesor->FullName }}</td>
                                <td>{{ $asesor->email }}</td>
                                <td>
                                    <input type="hidden" value="{{ $asesor->id }}">
                                    <button type="button" class="btn btn-success asignar">Asignar</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>        
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>    
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" defer></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js" defer></script>
<script>
    $(document).ready(function() {
        var table = $('#prospectosTable').DataTable({
            "language": {
                "sProcessing": "Procesando...",
                "sLengthMenu": "Mostrar _MENU_ registros",
                "sZeroRecords": "No se encontraron resultados",
                "sEmptyTable": "Ningún dato disponible en esta tabla",
                "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix": "",
                "sSearch": "Buscar:",
                "sUrl": "",
                "sInfoThousands": ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast": "Último",
                    "sNext": "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            }
        });
        $('#asesoresTable').DataTable({
            "language": {
                "sProcessing": "Procesando...",
                "sLengthMenu": "Mostrar _MENU_ registros",
                "sZeroRecords": "No se encontraron resultados",
                "sEmptyTable": "Ningún dato disponible en esta tabla",
                "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix": "",
                "sSearch": "Buscar:",
                "sUrl": "",
                "sInfoThousands": ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast": "Último",
                    "sNext": "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            }
        });

        $('.asignar').click(function() {
            let prospectos = [];
            $('#formdata').find('input[type=checkbox]:checked').each(function(index, el) {
                prospectos.push($(el).val());
            });
            
            $.ajax({
                url: '{{ route('prospectos.asignar.asesor.store') }}',
                type: 'POST',
                dataType: 'json',
                data: {
                    _token: "{{ csrf_token() }}",
                    prospectos: prospectos,
                    asesor: $('.asignar').parent().children('input').val()
                },
            })
            .done(function(res) {
                // console.log("success", res);
                $('#alert').prop('style', 'display:block;');
                $('#alert').empty();
                $('#alert').append(`<div class="alert alert-success" role="alert">
                <strong>Exito!</strong> Se asigno al asesor correctamente.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>`);
                table.clear();
                let filas = [];
                for(let i = 0; i < res.prospectos.length; i++){
                    filas.push([
                        res.prospectos[i].nombre,
                        res.prospectos[i].appaterno,
                        res.prospectos[i].apmaterno,
                        res.prospectos[i].email,
                        `<input type="checkbox" name="prospecto_id[]" value="${res.prospectos[i].id}">`
                    ]);
                }
                table.rows.add(filas).draw();

            })
            .fail(function(err) {
                console.log("error", err);
            });
        });
    } );


</script>

@endsection
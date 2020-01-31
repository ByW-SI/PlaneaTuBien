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
            {{-- CONTENEDOR TABLA DE PROSPECTOS --}}
            <div class="col-sm-6">
                <form method="post" id="formdata">
                    @csrf
                    <h5 class="text-center"><strong>Prospectos</strong></h5>
                    <div class="table-responsive">
                        {{-- TABLA PROSPECTOS --}}
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
                    </div>
                </form>
            </div>
            {{-- CONTENEDOR TABLA ASESORES --}}
            <div class="col-sm-6">
                <h5 class="text-center"><strong>Asesores</strong></h5>
                <div class="table-responsive">
                    <table id="asesoresTable" class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Nombre completo</th>
                                <th>Correo</th>
                                <th>Prospectos</th>
                                <th>Seleccionar</th>
                                <th>Temporal definido</th>
                                <th>Temporal indefinido</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($asesores as $asesor)
                            <tr>
                                <td>{{ $asesor->FullName }}</td>
                                <td>{{ $asesor->email }}</td>
                                <td><button class="btn btn-primary botonVerAsesor"
                                        asesorId="{{$asesor->id}}">Ver</button>
                                </td>
                                <td>
                                    <input type="hidden" value="{{ $asesor->id }}">
                                    <button type="button" class="btn btn-sm btn-success asignar"
                                        asesorId="{{$asesor->id}}">Asignar</button>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-success asignarTemporal"
                                        asesorId={{$asesor->id}}>Temporal</button>
                                </td>
                                <td nowrap>
                                    <button type="button" class="btn btn-success asignarTemporalIndefinido"
                                        asesorId={{$asesor->id}}>Temporal indefinido</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            {{-- CONTENEDOR TABLA PROSPECTOS DEL ASESOR SELECCIONADO --}}
            <div class="col-sm-6">
                <form method="post" id="formdata2">
                    @csrf
                    <h5 class="text-center"><strong>Prospectos</strong></h5>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="seleccionarTodos">
                                <label class="form-check-label" for="seleccionarTodos">Seleccionar todos</label>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        {{-- TABLA PROSPECTOS --}}
                        <table id="tablaProspectosAsesor" class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Apellido paterno</th>
                                    <th>Apellido materno</th>
                                    <th>Correo</th>
                                    <th>Seleccionar</th>
                                </tr>
                            </thead>
                            <tbody id="tbodyProspectosDeAsesor">
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" defer></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js" defer></script>
<script>
    /*
* ======
* EVENTS
* ======
*/

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

        var tablaProspectosAsesor = $('#tablaProspectosAsesor').DataTable({
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
            // console.log('asesor seleccionado', $(this).attr('asesorId'));
            let prospectos = [];
            $('#formdata').find('input[type=checkbox]:checked').each(function(index, el) {
                prospectos.push($(el).val());
            });

            $('#formdata2').find('input[type=checkbox]:checked').each(function(index, el) {
                prospectos.push($(el).val());
                // console.log('works formdata2');
            });
            
            $.ajax({
                url: '{{ route('prospectos.asignar.asesor.store') }}',
                type: 'POST',
                dataType: 'json',
                data: {
                    _token: "{{ csrf_token() }}",
                    prospectos: prospectos,
                    asesor: $(this).attr('asesorId')
                },
            })
            .done(function(res) {
                location.reload();
            })
            .fail(function(err) {
                console.log("error", err);
            });
        });

        /*
        * ================================
        * SELECCIONAR TODOS LOS PROSPECTOS
        * ================================
        */

        $(document).on('change', '#seleccionarTodos', function(){
            if($(this).is(":checked")){
                $('.inputSeleccionarProspecto').each(function(){
                    $(this).prop('checked', true);
                });
            }else{
                $('.inputSeleccionarProspecto').each(function(){
                    $(this).prop('checked', false);
                });
            }
        });        

        /*
        * ===============
        * ASESOR TEMPORAL
        * ===============
        */

        $('.asignarTemporal').click(function() {
            // console.log('asesor seleccionado', $(this).attr('asesorId'));
            let prospectos = [];
            $('#formdata').find('input[type=checkbox]:checked').each(function(index, el) {
                prospectos.push($(el).val());
            });

            $('#formdata2').find('input[type=checkbox]:checked').each(function(index, el) {
                prospectos.push($(el).val());
                // console.log('works formdata2');
            });
            
            $.ajax({
                url: '{{ route('prospectos.asignar_asesor_temporal') }}',
                type: 'POST',
                dataType: 'json',
                data: {
                    _token: "{{ csrf_token() }}",
                    prospectos: prospectos,
                    asesor: $(this).attr('asesorId')
                },
            })
            .done(function(res) {
                // console.log(res.request.asesor);
                location.reload();
            })
            .fail(function(err) {
                console.log("error", err);
            });
        });

        /*
        * ==========================
        * ASESOR TEMPORAL INDEFINIDO
        * ==========================
        */

        $('.asignarTemporalIndefinido').click(function() {
            // console.log('asesor seleccionado', $(this).attr('asesorId'));
            let prospectos = [];
            $('#formdata').find('input[type=checkbox]:checked').each(function(index, el) {
                prospectos.push($(el).val());
            });

            $('#formdata2').find('input[type=checkbox]:checked').each(function(index, el) {
                prospectos.push($(el).val());
                // console.log('works formdata2');
            });

            // console.log({
            //     event: 'BOTON ASIGNARTEMPORALINDEFINIDO CLICKEADO',
            //     asesor: $(this).attr('asesorId')
            // });
            
            $.ajax({
                url: '{{ route('prospectos.asignar_asesor_temporal_indefinido') }}',
                type: 'POST',
                dataType: 'json',
                data: {
                    _token: "{{ csrf_token() }}",
                    prospectos: prospectos,
                    asesor: $(this).attr('asesorId')
                },
            })
            .done(function(res) {
                console.log(res.request.asesor);
                location.reload();
            })
            .fail(function(err) {
                console.log("error", err);
            });
        });

    } );

    $(document).on('click', '.botonVerAsesor', async function(){
        asesorId = $(this).attr('asesorId');
        quitarProspectos();
        prospectosDeAsesor = await getProspectos(asesorId);
        prospectosDeAsesor.forEach(prospecto => {
            appendProspecto(prospecto);
        });
    });

/*
* =========
* FUNCTIONS
* =========
*/

function quitarProspectos(){
    var tablaProspectosAsesor = $('#tablaProspectosAsesor').DataTable();
    tablaProspectosAsesor.clear();
    tablaProspectosAsesor.draw();
}

function appendProspecto(prospecto){

    var tablaProspectosAsesor = $('#tablaProspectosAsesor').DataTable();

    // console.log(
    //     prospecto.nombre
    // );
    
    tablaProspectosAsesor.row.add([
        prospecto.nombre,
        prospecto.appaterno,
        prospecto.apmaterno,
        prospecto.email,
        `<input type="checkbox" name="prospecto_id[]" value="${prospecto.id}" class="inputSeleccionarProspecto">`
        ]);

    tablaProspectosAsesor.draw();

    // $('#tbodyProspectosDeAsesor').append(`
    //             <tr>
    //                 <td>${prospecto.nombre}</td>
    //                 <td>${prospecto.appaterno}</td>
    //                 <td>${prospecto.apmaterno}</td>
    //                 <td>${prospecto.email}</td>
    //                 <td>
    //                     <input type="checkbox" name="prospecto_id[]" value="${prospecto.id}">
    //                 </td>
    //             </tr>
    //         `);
}

async function getProspectos(asesorId){
    // console.log('entro en funcion get prospectos');
    const url = window.location.origin + `/api/empleados/${asesorId}/prospectos`;
    // console.log('url',url);
    const response = await $.ajax({
    url:url,  
    success:function(response) {
    //   console.log('response',response);
    }
  });

  return response;

}

</script>

@endsection
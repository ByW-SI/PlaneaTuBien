@extends('principal')
@section('content')
<div class="mx-3">
    <div class="card mb-5">
        <div class="card-header">
            <h3 class="text-center my-3">Seguimiento llamadas</h3>
        </div>
        {{-- <form action="{{ route('seguimiento.llamadas.store') }}" method="POST"> --}}
        {{-- @csrf --}}
        <div class="card-body">
            <table class="table table-striped table-hover" id="seguimientotable" style="width:100%">
                <thead>
                    <tr class="text-center">
                        <th scope="col">Nombre</th>
                        <th scope="col">Celular</th>
                        <th scope="col">Telefono</th>
                        <th class="table-danger" style=" width: 150px;">Comentario</th>
                        <th class="table-primary">Fecha actual</th>
                        <th class="table-primary" style=" width: 150px;">Estatus</th>
                        <th class="table-primary">Fecha Seguimiento</th>
                        <th class="table-warning">Fecha actual</th>
                        <th class="table-warning">Estatus</th>
                        <th class="table-warning">Fecha Seguimiento</th>
                        <th class="table-secondary">Fecha actual</th>
                        <th class="table-secondary">Estatus</th>
                        <th class="table-secondary">Fecha Seguimiento</th>
                        <th class="table-dark">Fecha actual</th>
                        <th class="table-dark">Estatus</th>
                        <th class="table-dark">Fecha Seguimiento</th>
                        <th class="table-warning">Fecha actual</th>
                        <th class="table-warning">Estatus</th>
                        <th class="table-warning">Fecha Seguimiento</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($prospectos as $key => $prospecto)
                    <tr>
                        <th scope="row">{{ $prospecto->fullName }}</th>
                        <th scope="row">{{ $prospecto->celular }}</th>
                        <th scope="row">{{ $prospecto->telefono }}</th>
                        <td nowrap>
                            <div class="form-group" style="display: block; width: 150px;">
                                <textarea class="form-control inputComentario" name="comentario[]" rows="3" maxlength="500" prospectoId="{{$prospecto->id}}">{{ $prospecto->seguimientoLlamadas->count() > 0 && $prospecto->seguimientoLlamadas->last()->comentario !== null ? $prospecto->seguimientoLlamadas->last()->comentario : ""}}</textarea>
                                <input type="hidden" name="prospecto_id[]" value="{{ $prospecto->id }}">
                            </div>
                        </td>
                        <td nowrap>
                            <input type="date" name="fecha_contacto[]" class="form-control" value="{{  date("Y-m-d") }}"
                                readonly="" prospectoId="{{$prospecto->id}}">
                        </td>
                        {{-- INPUT STATUS --}}
                        <td style="display: inline-block; width: 150px;">
                            <select name="resultado_llamada_id[]" class="form-control estatus inputEstatus" prospectoId="{{$prospecto->id}}">
                                <option value="">Seleccionar</option>
                                @foreach($estatusLlamada as $codigo)
                                <option value="{{ $codigo->id }}">{{ $codigo->nombre.' ('.$codigo->codigo.')' }}</option>
                                @endforeach
                            </select>
                        </td>
                        {{-- INPUT FECHA SEGUIMIENTO --}}
                        <td nowrap>
                            <input type="date" name="fecha_siguiente_contacto" prospectoId="{{$prospecto->id}}"
                                class="form-control fecha_sig_cont fechaSeguimiento" min="{{  date("Y-m-d") }}">
                            @include('prospectos.seguimientoLlamadas.modalCrearCita', ['prospecto' => $prospecto])
                        </td>
                        <!-- FECHAS ANTERIORES -->
                        @foreach($seguimientoLlamadas[$key] as $reg)
                        <td nowrap>
                            {{ $reg[0] }}
                        </td>
                        <td nowrap>{{ $reg[1] }}</td>
                        <td nowrap>{{ $reg[2] }}</td>
                        @endforeach
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        <div class="card-footer">
            <div class="text-center">
                <button class="btn btn-success" type="submit">Guardar</button>
            </div>
        </div>
        {{-- </form> --}}
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" defer></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js" defer></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    /**
* =======
* EVENTOS
* =======
*/

$(document).ready(function() {
    var table = $('#seguimientotable').DataTable({
        "columnDefs": [{
            "orderable": false,
            "targets": [3,4,5,6]
        }],
        "scrollX": true,
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

    console.log( $('#perteneceAUsuarioAutenticado').val() );
});

$(document).on('change', '.fechaSeguimiento', async function(){
    prospectoId = $(this).attr('prospectoId');
    response = await actualizarDatosProspecto(prospectoId);
    console.log('respuesta despues de guardar', response);
    if(requiereCita(prospectoId) ){
        mostrarModalCrear(prospectoId);
    }else{
        location.reload(true);
    }
});

$(document).on('change', '.modalCrearCitaInput', function(){
    prospectoId = $(this).attr('prospectoId');
    modificarInputClavePreautorizacion(prospectoId);
});

/**
* =========
* FUNCIONES
* =========
*/

async function actualizarDatosProspecto(prospectoId){

    console.log(window.location.origin);
    comentario = $(`.inputComentario[prospectoId=${prospectoId}]`).val();
    estatus = $(`.inputEstatus[prospectoId=${prospectoId}] option:selected`).val();
    fechaSeguimiento = $(`.fechaSeguimiento[prospectoId=${prospectoId}]`).val();

    console.log('COMENTARIO:',comentario);
    console.log('ESTATUS:',estatus);
    console.log('PROSPECTO ID:',prospectoId);
    console.log('FECHA SIGUIENTE CONTACTO:',prospectoId);

    response = await $.ajax({
    type:"POST",
    url: window.location.origin + "/api/seguimiento_llamadas/store",
    data:{
        comentario: comentario,
        estatus: estatus,
        prospectoId: prospectoId,
        fechaSeguimiento: fechaSeguimiento
        },
    success:function(response){
        console.log(response);
     },
});

    return response;

}

function modificarInputClavePreautorizacion(prospectoId){

    perteneceAUsuarioAutenticado = $(`.perteneceAUsuarioAutenticado[prospectoId=${prospectoId}]`).val();

    if(perteneceAUsuarioAutenticado == 1){
        inicialesOficina = $(`.oficinaIniciales[prospectoId=${prospectoId}]`).val();
        inicialesGerente = $(`.inicialesJefe[prospectoId=${prospectoId}]`).val();
        numeroTarjetas = $(`.numeroTarjetas[prospectoId=${prospectoId}]`).val();
        inicialesAsesor = $(`.inicialesAsesor[prospectoId=${prospectoId}]`).val();
        sueldo = $(`.sueldo[prospectoId=${prospectoId}]`).val();
        $(`.clavePreautorizacion[prospectoId=${prospectoId}]`).val(
            inicialesOficina + inicialesGerente + "/" + 
            inicialesAsesor + "/" +
            numeroTarjetas + "/" + 
            sueldo + "/" +
            prospectoId
            );
    }else{
        inicialesOficina = $(`.oficinaIniciales[prospectoId=${prospectoId}]`).val();
        inicialesGerente = $(`.inicialesJefe[prospectoId=${prospectoId}]`).val();
        numeroTarjetas = $(`.numeroTarjetas[prospectoId=${prospectoId}]`).val();
        inicialesUsuario = $(`.inicialesUsuario[prospectoId=${prospectoId}]`).val();
        inicialesAsesor = $(`.inicialesAsesor[prospectoId=${prospectoId}]`).val();
        sueldo = $(`.sueldo[prospectoId=${prospectoId}]`).val();
        $(`.clavePreautorizacion[prospectoId=${prospectoId}]`).val(
            inicialesOficina + inicialesGerente + "/" + 
            inicialesUsuario + inicialesAsesor + "/" +
            numeroTarjetas + "/" + 
            sueldo + "/" +
            prospectoId
            );
    }

    // console.log('oficina',  $(`.inputOficinaAsesor[prospectoId=${prospectoId}]`).val() );

}

function mostrarModalCrear(prospectoId){
        $(`.modalCrearCita[prospectoId=${prospectoId}]`).modal('show');
}

function requiereCita(prospectoId){
    const opcion = getEstatusSeleccionado();
    return opcion.includes('Cita');
}

function getEstatusSeleccionado(){
    return $(`.inputEstatus[prospectoId=${prospectoId}] option:selected`).text();
}

</script>
@endsection
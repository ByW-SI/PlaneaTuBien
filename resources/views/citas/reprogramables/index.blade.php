@extends('principal')

@section('content')

<div class="container">

    <h3 class="text-center text-uppercase text-muted">
        Reprogramar citas
    </h3>

    <div class="row">
        {{-- CONTENEDOR FILTRO DE FECHA --}}
        <div class="col-12 col-md-6">
            <div class="card rounded-0">
                <div class="card-header">
                    <h5 class="text-center text-uppercase text-muted m-0">FILTRO POR FECHA DE CITA</h5>
                </div>
                <form action="{{route('citas.reprogramables.index')}}" method="GET">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            {{-- CONTENEDOR INPUT FECHA INICIO --}}
                            <div class="col-6 my-1">
                                <label for="" class="text-uppercase text-muted">FECHA INICIO</label>
                                <input type="date" class="form-control" name="fechaCitaInicio"
                                    value="{{request()->input('fechaCitaInicio')}}">
                            </div>
                            {{-- CONTENEDOR INPUT FECHA FIN --}}
                            <div class="col-6 my-1">
                                <label for="" class="text-uppercase text-muted">FECHA FIN</label>
                                <input type="date" class="form-control" name="fechaCitaFin"
                                    value="{{request()->input('fechaCitaFin')}}">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-success btn-sm rounded-0">BUSCAR</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover" id="citas">
                                    <thead>
                                        <tr class="text-center">
                                            <th>Status</th>
                                            <th>Prospecto</th>
                                            <th>Clave de preautorizacion</th>
                                            <th>Asesor</th>
                                            <th>Fecha cita</th>
                                            <th>Hora</th>
                                            <th>Acción</th>
                                            <th>Agendar cita</th>
                                            <th>Llamadas</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($citas as $cita)
                                        <tr>
                                            <td nowrap>{{$cita->prospecto->estatus()->first()->nombre}}</td>
                                            <td nowrap>{{$cita->prospecto->nombre}} {{$cita->prospecto->appaterno}}
                                                {{$cita->prospecto->apmaterno}}</td>
                                            <td nowrap>{{$cita->clave_preautorizacion}}</td>
                                            <td nowrap>{{$cita->prospecto->asesor()->first()->nombre}}
                                                {{$cita->prospecto->asesor()->first()->paterno}}
                                                {{$cita->prospecto->asesor->first()->materno}}</td>
                                            <td nowrap>{{$cita->fecha_cita}}</td>
                                            <td nowrap>{{$cita->hora}}</td>
                                            <td nowrap>
                                                {{-- BOTON ACCION --}}
                                                <button type="button" class="btn btn-success" data-toggle="modal"
                                                    data-target="#modal-accion-{{$cita->id}}">
                                                    Acción
                                                </button>
                                                {{-- MODAL BOTON ACCION --}}
                                                <div class="modal fade bd-example-modal-lg"
                                                    id="modal-accion-{{$cita->id}}" tabindex="-1" role="dialog"
                                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">
                                                                    REAGENDAR LLAMADA
                                                                </h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form
                                                                    action="{{route('citas.reprogramables.store',['citas'=>$cita->id])}}"
                                                                    method="POST">
                                                                    @csrf
                                                                    <div class="row">
                                                                        {{-- PROSPECTO --}}
                                                                        <input type="hidden" name="prospecto_id"
                                                                            value="{{$cita->id}}">
                                                                        {{-- RESULTADO DE LA LLAMADA --}}
                                                                        <div class="col-6 mt-2">
                                                                            <label for=""
                                                                                class="text-uppercase text-muted">Resultado
                                                                                de
                                                                                llamada</label>
                                                                            <select name="accion"
                                                                                class="form-control inputResultadoLlamada"
                                                                                citaId={{$cita->id}}>
                                                                                <option value="">Seleccionar</option>
                                                                                <option value="SEGUIMIENTO LLAMADA">
                                                                                    SEGUIMIENTO LLAMADA</option>
                                                                                <option value="CANCELAR CITA">LISTA
                                                                                    NEGRA</option>
                                                                            </select>
                                                                            {{-- <input type="text" name="resultado_llamada_id"
                                                                                class="form-control"> --}}
                                                                        </div>
                                                                        {{-- FECHA DE SIGUIENTE CONTACTO --}}
                                                                        <div class="col-12 mt-2 contenedorInputFechaSiguienteContacto"
                                                                            citaId={{$cita->id}} style="display:none">
                                                                            <label for=""
                                                                                class="text-uppercase text-muted">Fecha
                                                                                de
                                                                                siguiente contacto</label>
                                                                            <input type="date"
                                                                                name="fecha_siguiente_contacto"
                                                                                class="form-control inputFechaSiguienteContacto"
                                                                                citaId={{$cita->id}}>
                                                                        </div>
                                                                        {{-- COMENTARIO --}}
                                                                        <div class="col-12 mt-2 contenedorInputComentario"
                                                                            citaId={{$cita->id}} style="display:none">
                                                                            <label for=""
                                                                                class="text-uppercase text-muted">Comentario</label>
                                                                            <textarea name="comentario" id="" cols="30"
                                                                                rows="2"
                                                                                class="form-control"></textarea>
                                                                        </div>

                                                                        <br>
                                                                        <hr>
                                                                        <br>
                                                                        <div class="col-12 mt-2">
                                                                            <button type="submit"
                                                                                class="btn btn-success">GUARDAR</button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td nowrap>
                                                <button type="submit" class="btn btn-success botonAgendarCita"
                                                    prospectoId={{$cita->prospecto->id}}>
                                                    Agendar cita
                                                </button>
                                                @include('prospectos.seguimientoLlamadas.modalCrearCita', ['prospecto'
                                                =>
                                                $cita->prospecto])
                                            </td>
                                            <td nowrap>
                                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                                    data-target="#modal-llamadas-{{$cita->prospecto->id}}">
                                                    Llamadas
                                                </button>
                                                {{-- MODAL BOTON LLAMADAS --}}
                                                <div class="modal fade bd-example-modal-lg"
                                                    id="modal-llamadas-{{$cita->prospecto->id}}" tabindex="-1"
                                                    role="dialog" aria-labelledby="exampleModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-lg" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">LLAMADAS DE
                                                                    {{$cita->prospecto->nombre}}
                                                                </h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <div class="table-responsive">
                                                                            @include('componentes.llamadas.historial.table',
                                                                            ['llamadas' =>
                                                                            $cita->prospecto->seguimientoLlamadas])
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" defer></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js" defer></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
    $(document).ready( function(){
        var table = $('#citas').DataTable();
    } );

    $(document).on('change', '.inputResultadoLlamada', function(){

const prospectoId = $(this).attr('prospectoId');
const accion = $(this).val();

$(`.contenedorInputFechaSiguienteContacto[prospectoId=${prospectoId}]`).hide('slow');

if(accion == 'VOLVER A LLAMAR'){
    $(`.contenedorInputFechaSiguienteContacto[prospectoId=${prospectoId}]`).show('slow');
}

console.log({
    prospectoId,
    accion
});

});

$(document).on('click', '.botonAgendarCita', function(){
const prospectoId = $(this).attr('prospectoId');
console.log({
    prospectoId
});

mostrarModalCrear(prospectoId);

// $(`.modalCrearCita[prospectoId=${prospectoId}]`).modal('show');

});

/**
* =======
* EVENTOS
* =======
*/

$(document).ready(function() {
var table = $('#seguimientotable').DataTable();

console.log( $('#perteneceAUsuarioAutenticado').val() );
});



$(document).on('change', '.modalCrearCitaInput', function(){
prospectoId = $(this).attr('prospectoId');
modificarInputClavePreautorizacion(prospectoId);
});

</script>

@endsection
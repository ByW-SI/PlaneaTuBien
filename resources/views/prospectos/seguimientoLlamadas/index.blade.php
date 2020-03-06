@extends('principal')

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" defer></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js" defer></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<style>
    .background-success {
        background-color: #E6FCDD !important;
    }

    .background-error {
        background-color: #F9EBEB !important;
    }
</style>

@section('content')
<div class="mx-3">
    <div class="card mb-5">
        <div class="card-header">
            <h3 class="text-center my-3">Seguimiento llamadas</h3>
        </div>
        {{-- <form action="{{ route('seguimiento.llamadas.store') }}" method="POST"> --}}
        {{-- @csrf --}}
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover" id="seguimientotable" style="width:100%">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">Nombre</th>
                            <th scope="col">Celular</th>
                            <th></th>
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
                            <th class="table-warning">Llamadas</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($prospectos as $key => $prospecto)
                        <tr
                            class="{{ date('Y-m-d') == $seguimientoLlamadas[$key][0][2] ? 'background-success' : '' }}  {{date('Y-m-d') > $seguimientoLlamadas[$key][0][2] ? 'background-error' : ''}}">

                            <th scope="row">{{ $prospecto->fullName }}</th>
                            <th scope="row">{{ $prospecto->celular }}</th>
                            <th>{{ $seguimientoLlamadas[$key][0][2] }}</th>
                            <th scope="row">{{ $prospecto->telefono }}</th>
                            <td nowrap>
                                <div class="form-group" style="display: block; width: 150px;">
                                    <textarea class="form-control inputComentario" name="comentario[]" rows="3"
                                        maxlength="500"
                                        prospectoId="{{$prospecto->id}}">{{ $prospecto->seguimientoLlamadas->count() > 0 && $prospecto->seguimientoLlamadas->last()->comentario !== null ? $prospecto->seguimientoLlamadas->last()->comentario : ""}}</textarea>
                                    <input type="hidden" name="prospecto_id[]" value="{{ $prospecto->id }}">
                                </div>
                            </td>
                            <td nowrap>
                                <input type="date" name="fecha_contacto[]" class="form-control"
                                    value="{{  date("Y-m-d") }}" readonly="" prospectoId="{{$prospecto->id}}">
                            </td>
                            {{-- INPUT STATUS --}}
                            <td style="display: inline-block; width: 150px;">
                                <select name="resultado_llamada_id[]" class="form-control estatus inputEstatus"
                                    prospectoId="{{$prospecto->id}}">
                                    <option value="">Seleccionar</option>
                                    @foreach($estatusLlamada as $codigo)
                                    <option value="{{ $codigo->id }}">{{ $codigo->nombre.' ('.$codigo->codigo.')' }}
                                    </option>
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
                            {{-- {{dd($reg)}} --}}
                            <td nowrap>
                                {{ $reg[0] }}
                            </td>
                            <td nowrap>{{ $reg[1] }}</td>
                            <td nowrap>{{ $reg[2] }}</td>
                            @endforeach
                            <td>
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#modal-llamadas-{{$prospecto->id}}">
                                    Llamadas
                                </button>
                                {{-- MODAL BOTON LLAMADAS --}}
                                <div class="modal fade bd-example-modal-lg" id="modal-llamadas-{{$prospecto->id}}"
                                    tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">LLAMADAS DE
                                                    {{$prospecto->nombre}}
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
                                                            @include('componentes.llamadas.historial.table', ['llamadas' => $prospecto->seguimientoLlamadas])
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
    $(document).ready( function(){
        var table = $('#seguimientotable').DataTable();
        } );
</script>


<script>
    /**
    * ======
    * EVENTS
    * ======
    */

    $(document).on('focusout', '.fechaSeguimiento', async function(){
        prospectoId = $(this).attr('prospectoId');
        response = await actualizarDatosProspecto(prospectoId);
        // console.log('fecha seguimiento lenfght', ();
    
        if(($(this).val()).length){
            if(requiereCita(prospectoId) ){
                mostrarModalCrear(prospectoId);
            }else{
                location.reload(true);
            }
        }
    });
    
    
    $(document).on('change', '.modalCrearCitaInput', function(){
        prospectoId = $(this).attr('prospectoId');
        modificarInputClavePreautorizacion(prospectoId);
    });

</script>

@endsection
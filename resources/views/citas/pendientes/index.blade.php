@extends('principal')

@section('content')

<div class="container">
    <h3 class="text-center text-uppercase text-muted">CITAS PENDIENTES</h3>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover" id="citas">
                    <thead>
                        <tr class="text-center">
                            <th>Status</th>
                            <th>Prospecto</th>
                            <th>Fecha cita</th>
                            <th>Teléfono</th>
                            <th>Celular</th>
                            <th>Asesor</th>
                            <th>Hora</th>
                            <th>Acción</th>
                            <th>Llamadas</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($citas as $cita)
                        <tr>
                            {{-- ESTATUS --}}
                            <td nowrap>{{$cita->prospecto->estatus()->first()->nombre}}</td>
                            {{-- PROSPECTO --}}
                            <td nowrap>{{$cita->prospecto->nombre}} {{$cita->prospecto->appaterno}}
                                {{$cita->prospecto->telefono}}</td>
                            {{-- INPUT FECHA CITA --}}
                            <td nowrap>{{$cita->fecha_cita}}</td>
                            {{-- TELÉFONO --}}
                            <td nowrap>{{$cita->prospecto->telefono}}</td>
                            {{-- CELULAR --}}
                            <td nowrap>{{$cita->prospecto->celular}}</td>
                            {{-- ASESOR --}}
                            <td nowrap>{{$cita->prospecto->asesor()->first()->nombre}}
                                {{$cita->prospecto->asesor()->first()->paterno}}
                                {{$cita->prospecto->asesor->first()->materno}}</td>
                            {{-- INPUT HORA --}}
                            <td nowrap>{{$cita->hora}}</td>
                            {{-- INPUT ACCIÓN --}}
                            <td nowrap>
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#modal-{{$cita->prospecto->id}}">
                                    Acción
                                </button>
                                {{-- MODAL BOTON ACCION --}}
                                <div class="modal fade" id="modal-{{$cita->prospecto->id}}" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">{{$cita->prospecto->nombre}}
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{route('citas.pendientes.update', ['id' => $cita->id])}}"
                                                method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="row">
                                                        {{-- INPUT ACCION --}}
                                                        <div class="col-12 mt-2">
                                                            <label for=""
                                                                class="text-uppercase text-muted">Acción</label>
                                                            <select name="accion" class="form-control inputAccion"
                                                                citaId="{{$cita->id}}" required>
                                                                <option value="">Seleccionar</option>
                                                                <option value="CONFIRMAR FECHA">Confirmar fecha</option>
                                                                <option value="CANCELAR CITA">Cancelar</option>
                                                                <option value="REAGENDAR LLAMADA">Volver a llamar
                                                                </option>
                                                            </select>
                                                        </div>
                                                        {{-- INPUT FECHA CITA --}}
                                                        <div class="col-12 mt-2 contenedorInputFechaCita"
                                                            style="display: none;" citaId="{{$cita->id}}">
                                                            <label for="" class="text-uppercase text-muted">Fecha de
                                                                cita</label>
                                                            <input type="date" name="fechaCita" class="form-control">
                                                        </div>
                                                        {{-- INPUT COMENTARIO --}}
                                                        <div class="col-12 mt-2 contenedorInputComentario"
                                                            style="display: none;" citaId="{{$cita->id}}">
                                                            <label for=""
                                                                class="text-uppercase text-muted">Comentario</label>
                                                            <textarea name="comentarioCancelacion" cols="30" rows="10"
                                                                class="form-control"></textarea>
                                                        </div>
                                                        {{-- INPUT ASESOR QUE CONFIRMA --}}
                                                        <div class="col-12 mt-2 contenedorInputIdAsesorQueConfirma"
                                                            style="display: none;" citaId="{{$cita->id}}">
                                                            <label for="" class="text-uppercase text-muted">Asesor que
                                                                confirma</label>
                                                            <select name="idAsesorQueConfirma" class="form-control">
                                                                <option value="">Seleccionar</option>
                                                                @foreach ($asesores as $asesor)
                                                                <option value="{{$asesor->id}}">{{$asesor->nombre}}
                                                                </option>
                                                                @endforeach
                                                            </select>
                                                            {{-- <input type="text" name="" class="form-control"> --}}
                                                        </div>
                                                        {{-- ASESOR PROSPECTO --}}
                                                        <div class="col-12 mt-2 contenedorInputAsesorDeProspecto"
                                                            style="display: none;" citaId="{{$cita->id}}">
                                                            <label for="" class="text-uppercase text-muted">Asesor del
                                                                prospecto</label>
                                                            <input type="text" class="form-control" readonly
                                                                value="{{$cita->prospecto->asesor->nombre}} {{$cita->prospecto->asesor->paterno}} {{$cita->prospecto->asesor->materno}}">
                                                        </div>
                                                        {{-- OPCIONES CANCELACIÓN --}}
                                                        <div class="col-12 mt-2 contenedorInputOpcionCancelacion"
                                                            style="display: none;" citaId="{{$cita->id}}">
                                                            <label for="" class="text-uppercase text-muted">Opción de
                                                                cancelación</label>
                                                            <select name="opcionCancelacion" class="form-control">
                                                                <option value="x1">x1</option>
                                                                <option value="x2">x2</option>
                                                                <option value="x3">x3</option>
                                                                <option value="x4">x4</option>
                                                            </select>
                                                        </div>
                                                        {{-- VOLVER A LLAMAR --}}
                                                        <div class="col-12 mt-2 contenedorInputNuevaFechaLlamada"
                                                            style="display: none;" citaId="{{$cita->id}}">
                                                            <label for="" class="text-uppercase text-muted">Nueva fecha
                                                                llamada</label>
                                                            <input type="date" name="nuevaFechaLlamada"
                                                                class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-success">Guardar</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            {{-- LLAMADAS --}}
                            <td>
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#modal-llamadas-{{$cita->prospecto->id}}">
                                    Llamadas
                                </button>
                                {{-- MODAL BOTON LLAMADAS --}}
                                <div class="modal fade bd-example-modal-lg" id="modal-llamadas-{{$cita->prospecto->id}}"
                                    tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">LLAMADAS DE {{$cita->prospecto->nombre}}
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <table class="table table-hover">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col">Resultado</th>
                                                                    <th scope="col">Fecha de contacto</th>
                                                                    <th scope="col">Fecha de siguiente contacto</th>
                                                                    <th scope="col">Comentario</th>
                                                                    <th scope="col"></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($cita->prospecto->seguimientoLlamadas as
                                                                $llamada)
                                                                <tr>
                                                                    <td nowrap>
                                                                        {{!$llamada->resultadoLLamada ? '' : $llamada->resultadoLLamada->nombre}}
                                                                    </td>
                                                                    <td nowrap>{{$llamada->fecha_contacto}}</td>
                                                                    <td nowrap>{{$llamada->fecha_siguiente_contacto}}
                                                                    </td>
                                                                    <td nowrap>{{$llamada->comentario}}</td>
                                                                    <td nowrap></td>
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
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
    $(document).ready( function(){
        var table = $('#citas').DataTable();
        } );

    $(document).on('change', '.inputAccion', function(){
        const accion = $(this).val();
        const citaId = $(this).attr('citaId');

        console.log({
            mensaje: 'CAMBIAR INPUTS',
            accion: accion,
            citaId: citaId
        });

        ocultarInputsExtra(citaId);

        if(accion == 'CONFIRMAR FECHA'){
            mostrarInputsConfirmarFecha(citaId);
        }

        if(accion == 'CANCELAR CITA'){
            mostrarInputsCancelacion(citaId);
        }

        if(accion == 'REAGENDAR LLAMADA'){
            mostrarInputsReagendarLlamada(citaId);
        }

    });

    /*
    * =========
    * FUNCTIONS
    * =========
    */

    function ocultarInputsExtra(citaId){
        $(`.contenedorInputFechaCita[citaId=${citaId}]`).hide('slow');
        $(`.contenedorInputComentario[citaId=${citaId}]`).hide('slow');
        $(`.contenedorInputIdAsesorQueConfirma[citaId=${citaId}]`).hide('slow');
        $(`.contenedorInputAsesorDeProspecto[citaId=${citaId}]`).hide('slow');
        $(`.contenedorInputOpcionCancelacion[citaId=${citaId}]`).hide('slow');
        $(`.contenedorInputNuevaFechaLlamada[citaId=${citaId}]`).hide('slow');
    }

    function mostrarInputsConfirmarFecha(citaId){
        $(`.contenedorInputFechaCita[citaId=${citaId}]`).show('slow');
    }

    function mostrarInputsCancelacion(citaId){
        $(`.contenedorInputComentario[citaId=${citaId}]`).show('slow');
        $(`.contenedorInputIdAsesorQueConfirma[citaId=${citaId}]`).show('slow');
        $(`.contenedorInputAsesorDeProspecto[citaId=${citaId}]`).show('slow');
        $(`.contenedorInputOpcionCancelacion[citaId=${citaId}]`).show('slow');
    }

    function mostrarInputsReagendarLlamada(citaId){
        $(`.contenedorInputNuevaFechaLlamada[citaId=${citaId}]`).show('slow');
    }

</script>

@endsection
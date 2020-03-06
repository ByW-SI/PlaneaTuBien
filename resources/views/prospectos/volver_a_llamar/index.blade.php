@extends('principal')

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" defer></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js" defer></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

@section('content')

<div class="container">
    <h3 class="text-center text-uppercase text-muted">VOLVER A LLAMAR</h3>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover" id="citas">
                    <thead>
                        <tr class="text-center">
                            <th>Prospecto</th>
                            <th>Teléfono</th>
                            <th>Celular</th>
                            <th>Ver llamada</th>
                            <th>Acción</th>
                            <th>Agendar cita</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($prospectos as $prospecto)
                        <tr>
                            {{-- PROSPECTO --}}
                            <td class="text-center">
                                {{$prospecto->nombre}} {{$prospecto->appaterno}} {{$prospecto->apmaterno}}
                            </td>
                            {{-- TELEFONO --}}
                            <td>
                                {{$prospecto->telefono ?: 'N/D'}}
                            </td>
                            {{-- CELULAR --}}
                            <td>
                                {{$prospecto->celular ?: 'N/D'}}
                            </td>
                            {{-- VER LLAMADA --}}
                            <td class="text-center">
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
                                                <h5 class="modal-title">LLAMADAS DE {{$prospecto->nombre}}
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
                                                            <table class="table table-hover">
                                                                <thead>
                                                                    <tr>
                                                                        <th scope="col">Status</th>
                                                                        <th scope="col">Fecha de contacto</th>
                                                                        <th scope="col">Fecha de siguiente contacto</th>
                                                                        <th scope="col">Comentario</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($prospecto->seguimientoLlamadas as
                                                                    $llamada)
                                                                    <tr>
                                                                        <td nowrap>
                                                                            {{$llamada->resultadoLLamada->codigo}}
                                                                        </td>
                                                                        <td nowrap>{{$llamada->fecha_contacto}}</td>
                                                                        <td nowrap>
                                                                            {{$llamada->fecha_siguiente_contacto}}
                                                                        </td>
                                                                        <td nowrap>{{$llamada->comentario}}</td>
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
                            </td>
                            {{-- REAGENDAR LLAMADA --}}
                            <td class="text-center">

                                <button type="button" class="btn btn-success" data-toggle="modal"
                                    data-target="#modal-reagendar-llamada-{{$prospecto->id}}">
                                    Acción
                                </button>
                                {{-- MODAL BOTON LLAMADAS --}}
                                <div class="modal fade bd-example-modal-lg"
                                    id="modal-reagendar-llamada-{{$prospecto->id}}" tabindex="-1" role="dialog"
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
                                                <form action="{{route('volver_a_llamar.store')}}" method="POST">
                                                    @csrf
                                                    <div class="row">
                                                        {{-- ASESOR DEL PROSPECTO --}}
                                                        <div class="col-6 mt-2">
                                                            <label for=""
                                                                class="text-uppercase text-muted">Asesor</label>
                                                            <input type="text" value="{{$prospecto->asesor->nombre}}"
                                                                readonly class="form-control">
                                                        </div>
                                                        {{-- PROSPECTO --}}
                                                        <input type="hidden" name="prospecto_id"
                                                            value="{{$prospecto->id}}">
                                                        {{-- RESULTADO DE LA LLAMADA --}}
                                                        <div class="col-6 mt-2">
                                                            <label for="" class="text-uppercase text-muted">Resultado de
                                                                llamada</label>
                                                            <select name="accion"
                                                                class="form-control inputResultadoLlamada"
                                                                prospectoId={{$prospecto->id}}>
                                                                <option value="">Seleccionar</option>
                                                                <option value="VOLVER A LLAMAR">VOLVER A LLAMAR</option>
                                                                <option value="CANCELAR CITA">LISTA NEGRA</option>
                                                            </select>
                                                            {{-- <input type="text" name="resultado_llamada_id"
                                                                class="form-control"> --}}
                                                        </div>
                                                        {{-- FECHA DE SIGUIENTE CONTACTO --}}
                                                        <div class="col-12 mt-2 contenedorInputFechaSiguienteContacto"
                                                            prospectoId={{$prospecto->id}} style="display:none">
                                                            <label for="" class="text-uppercase text-muted">Fecha de
                                                                siguiente contacto</label>
                                                            <input type="date" name="fecha_siguiente_contacto"
                                                                class="form-control inputFechaSiguienteContacto"
                                                                prospectoId={{$prospecto->id}}>
                                                        </div>
                                                        {{-- COMENTARIO --}}
                                                        <div class="col-12 mt-2 contenedorInputComentario"
                                                            prospectoId={{$prospecto->id}} style="display:none">
                                                            <label for=""
                                                                class="text-uppercase text-muted">Comentario</label>
                                                            <textarea name="comentario" id="" cols="30" rows="2"
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
                            {{-- AGENDAR CITA --}}
                            <td>
                                <button type="submit" class="btn btn-success botonAgendarCita"
                                    prospectoId={{$prospecto->id}}>
                                    Agendar cita
                                </button>
                                @include('prospectos.seguimientoLlamadas.modalCrearCita', ['prospecto' =>
                                $prospecto])
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready( function(){
        var table = $('#citas').DataTable();
        } );

    $(document).on('change', '.inputResultadoLlamada', function(){

        const prospectoId = $(this).attr('prospectoId');
        const accion = $(this).val();

        $(`.contenedorInputFechaSiguienteContacto[prospectoId=${prospectoId}]`).hide('slow');
        $(`.contenedorInputComentario[prospectoId=${prospectoId}]`).hide('slow');

        if(accion == 'VOLVER A LLAMAR'){
            $(`.contenedorInputFechaSiguienteContacto[prospectoId=${prospectoId}]`).show('slow');
            $(`.contenedorInputComentario[prospectoId=${prospectoId}]`).show('slow');
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
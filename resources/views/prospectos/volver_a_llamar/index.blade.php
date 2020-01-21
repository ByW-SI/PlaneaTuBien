@extends('principal')

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
                            <th>Ver llamada</th>
                            <th>Reagendar llamada</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($prospectos as $prospecto)
                        <tr>
                            {{-- PROSPECTO --}}
                            <td>
                                {{$prospecto->nombre}} {{$prospecto->appaterno}} {{$prospecto->apmaterno}}
                            </td>
                            {{-- VER LLAMADA --}}
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
                                                                        <th scope="col">Resultado</th>
                                                                        <th scope="col">Fecha de contacto</th>
                                                                        <th scope="col">Fecha de siguiente contacto</th>
                                                                        <th scope="col">Comentario</th>
                                                                        <th scope="col"></th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($prospecto->seguimientoLlamadas as
                                                                    $llamada)
                                                                    <tr>
                                                                        <td nowrap>
                                                                            {{!$llamada->resultadoLLamada ? '' : $llamada->resultadoLLamada->nombre}}
                                                                        </td>
                                                                        <td nowrap>{{$llamada->fecha_contacto}}</td>
                                                                        <td nowrap>
                                                                            {{$llamada->fecha_siguiente_contacto}}
                                                                        </td>
                                                                        <td nowrap>{{$llamada->comentario}}</td>
                                                                        <td nowrap>
                                                                            {{!$llamada->resultadoLLamada ? "" : $llamada->resultadoLLamada->nombre}}
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
                            </td>
                            {{-- REAGENDAR LLAMADA --}}
                            <td>

                                <button type="button" class="btn btn-success" data-toggle="modal"
                                    data-target="#modal-reagendar-llamada-{{$prospecto->id}}">
                                    Reagendar llamada
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
                                                <form action="{{route('seguimiento.llamadas.store')}}" method="POST">
                                                    @csrf
                                                    <div class="row">
                                                        {{-- ASESOR DEL PROSPECTO --}}
                                                        <div class="col-12 mt-2">
                                                            <label for=""
                                                                class="text-uppercase text-muted">Asesor</label>
                                                            <input type="text" value="{{$prospecto->asesor->nombre}}"
                                                                readonly class="form-control">
                                                        </div>
                                                        {{-- PROSPECTO --}}
                                                        <input type="hidden" name="prospecto_id"
                                                            value="{{$prospecto->id}}">
                                                        {{-- RESULTADO DE LA LLAMADA --}}
                                                        <div class="col-12 mt-2">
                                                            <label for="" class="text-uppercase text-muted">Resultado de
                                                                llamada</label>
                                                            <input type="text" name="resultado_llamada_id"
                                                                class="form-control">
                                                        </div>
                                                        {{-- FECHA DE CONTACTO --}}
                                                        <div class="col-12 mt-2">
                                                            <label for="" class="text-uppercase text-muted">Fecha de
                                                                contacto</label>
                                                            <input type="date" name="fecha_contacto"
                                                                class="form-control">
                                                        </div>
                                                        {{-- FECHA DE SIGUIENTE CONTACTO --}}
                                                        <div class="col-12 mt-2">
                                                            <label for="" class="text-uppercase text-muted">Fecha de
                                                                siguiente contacto</label>
                                                            <input type="date" name="fecha_siguiente_contacto"
                                                                class="form-control">
                                                        </div>
                                                        {{-- FECHA DE SIGUIENTE CONTACTO --}}
                                                        <div class="col-12 mt-2">
                                                            <label for=""
                                                                class="text-uppercase text-muted">Comentario</label>
                                                            <textarea name="comentario" class="form-control" id=""
                                                                cols="30" rows="5"></textarea>
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
</script>

@endsection
@extends('principal')

@section('content')

<div class="container">
    <h3 class="text-center text-uppercase text-muted">CITAS CONFIRMADAS</h3>
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
                            <th>Asistió</th>
                            <th>No asistió</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($citas as $cita)
                        <tr>
                            <td>{{$cita->prospecto->estatus()->first()->nombre}}</td>
                            <td>{{$cita->prospecto->nombre}} {{$cita->prospecto->appaterno}}
                                {{$cita->prospecto->apmaterno}}</td>
                            <td>{{$cita->clave_preautorizacion}}</td>
                            <td>{{$cita->prospecto->asesor()->first()->nombre}}
                                {{$cita->prospecto->asesor()->first()->paterno}}
                                {{$cita->prospecto->asesor->first()->materno}}</td>
                            <td>{{$cita->fecha_cita}}</td>
                            <td>{{$cita->hora}}</td>
                            <td>
                                {{-- BOTON ASISITIO --}}
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target=".asistio-cita-{{$cita->id}}">
                                    Asistió
                                </button>
                                {{-- MODAL ASISTIO --}}
                                <div class="modal fade asistio-cita-{{$cita->id}}" id="exampleModalCenter" tabindex="-1"
                                    role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">
                                                    {{$cita->prospecto->nombre}} {{$cita->prospecto->appaterno}}
                                                    {{$cita->prospecto->apmaterno}}
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label for="" class="text-uppercase text-muted">
                                                            asesor
                                                        </label>
                                                        <input type="text" class="form-control"
                                                            value="{{$cita->prospecto->asesor->nombre}}" readonly>
                                                    </div>
                                                    <div class="col-12">
                                                        <label for="" class="text-uppercase text-muted">
                                                            reasignar
                                                        </label>
                                                        <input type="text" class="form-control" name="nuevoAsesorId">
                                                    </div>
                                                    <div class="col-12">
                                                        <label for="" class="text-uppercase text-muted">
                                                            comentario
                                                        </label>
                                                        <textarea name="comentario" cols="30" rows="5" class="form-control"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-success">GUARDAR</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <form action="{{route('citas.confirmadas.update',['id'=>$cita->id])}}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">No asistió</button>
                                </form>
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
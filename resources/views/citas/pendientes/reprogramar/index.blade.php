@extends('principal')

@section('content')

<div class="container">

    <h3 class="text-center text-uppercase text-muted mt-4">CITAS PENDIENTES REPROGRAMAR</h3>

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

@endsection
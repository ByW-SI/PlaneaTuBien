@extends('principal')

@section('content')

<div class="container">

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover" id="citas">
                    <thead>
                        <tr class="text-center">
                            <th>Prospecto</th>
                            <th>Asesor</th>
                            <th>Fecha cita</th>
                            <th>Hora</th>
                            <th>Confirmar</th>
                            <th>Cancelar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($citas as $cita)
                        <tr>
                            <td>{{$cita->prospecto->nombre}} {{$cita->prospecto->appaterno}} {{$cita->prospecto->apmaterno}}</td>
                            <td>{{$cita->prospecto->asesor()->first()->nombre}}  {{$cita->prospecto->asesor()->first()->paterno}} {{$cita->prospecto->asesor->first()->materno}}</td>
                            <td>{{$cita->fecha_cita}}</td>
                            <td>{{$cita->hora}}</td>
                            <td>
                                <a href="#" class="btn btn-success">Aceptar</a>
                            </td>
                            <td>
                                <a href="#" class="btn btn-danger">Rechazar</a>
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
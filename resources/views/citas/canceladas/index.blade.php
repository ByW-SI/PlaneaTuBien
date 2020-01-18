@extends('principal')

@section('content')

<div class="container">
    <h3 class="text-center text-uppercase text-muted">LISTA NEGRA</h3>
    <div class="card">
        <div class="card-body">
            <table class="table table-striped table-hover" id="citas">
                <thead>
                    <tr class="text-center">
                        <th>Status</th>
                        <th>Prospecto</th>
                        <th>Asesor</th>
                        <th>Comentario</th>
                        <th>Asesor que confirma</th>
                        <th>Opción de cancelación</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($citas as $cita)
                    <tr>
                        <td>{{$cita->prospecto->estatus()->first()->nombre}}</td>
                        <td>{{$cita->prospecto->nombre}} {{$cita->prospecto->appaterno}}
                            {{$cita->prospecto->apmaterno}}</td>
                        <td>{{$cita->prospecto->asesor()->first()->nombre}}
                            {{$cita->prospecto->asesor()->first()->paterno}}
                            {{$cita->prospecto->asesor->first()->materno}}</td>
                        <td>{{$cita->citaCancelada->comentario}}</td>
                        <td>{{!$cita->citaCancelada->asesor ? '' : $cita->citaCancelada->asesor->nombre}}</td>
                        <td>{{$cita->citaCancelada->tipo_cancelacion}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
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
@extends('principal')

@section('content')

<div class="container">
    <h3 class="text-center text-uppercase text-muted">LISTA NEGRA</h3>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover" id="citas" style="white-space: nowrap">
                    <thead>
                        <tr class="text-center">
                            {{-- <th>Status</th> --}}
                            <th>Prospecto</th>
                            <th>Asesor</th>
                            <th>Comentario</th>
                            <th>Asesor que confirma</th>
                            <th>Opción de cancelación</th>
                            <th>Reactivar</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($citas as $cita)
                        <tr>
                            {{-- <td nowrap>{{$cita->prospecto->estatus()->first()->nombre}}</td> --}}
                            <td nowrap>{{$cita->prospecto->nombre}} {{$cita->prospecto->appaterno}}
                                {{$cita->prospecto->apmaterno}}</td>
                            <td nowrap>{{$cita->prospecto->asesor()->first()->nombre}}
                                {{$cita->prospecto->asesor()->first()->paterno}}
                                {{$cita->prospecto->asesor->first()->materno}}</td>
                            <td nowrap>{{$cita->citaCancelada->comentario}}</td>
                            <td nowrap>{{!$cita->citaCancelada->asesor ? '' : $cita->citaCancelada->asesor->nombre}}
                            </td>
                            <td nowrap>{{$cita->citaCancelada->tipo_cancelacion}}</td>
                            <td nowrap>
                                <a href="{{route('citas.canceladas.reactivar', ['citas' => $cita->id])}}"
                                    class="btn btn-success">REACTIVAR</a>
                            </td>
                            <td nowrap>
                                <form action="{{route('prospectos.destroy', ['id'=>$cita->prospecto])}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">
                                        ELIMINAR
                                    </button>
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
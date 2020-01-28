@extends('principal')

@section('content')

<div class="container">
    <h3 class="text-center text-uppercase text-muted">LISTA NEGRA</h3>

    <div class="row">
        {{-- CONTENEDOR FILTRO DE FECHA --}}
        <div class="col-12 col-md-6">
            <div class="card rounded-0">
                <div class="card-header">
                    <h5 class="text-center text-uppercase text-muted m-0">FILTRO POR FECHA DE CANCELACIÓN</h5>
                </div>
                <form action="{{route('citas.canceladas.index')}}" method="GET">
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
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="citas" style="white-space: nowrap">
                            <thead>
                                <tr class="text-center">
                                    {{-- <th>Status</th> --}}
                                    <th>Prospecto</th>
                                    <th>Asesor</th>
                                    <th>Comentario</th>
                                    <th>Fecha cancelación</th>
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
                                    <td nowrap>
                                        {{$cita->prospecto->seguimientoLlamadas()->orderBy('id','desc')->first()->comentario}}
                                    </td>
                                    <td>{{$cita->citaCancelada->created_at}}</td>
                                    <td nowrap>
                                        {{!$cita->citaCancelada->asesor ? '' : $cita->citaCancelada->asesor->nombre}}
                                    </td>
                                    <td nowrap>{{$cita->citaCancelada->tipo_cancelacion}}</td>
                                    <td nowrap>
                                        <a href="{{route('citas.canceladas.reactivar', ['citas' => $cita->id])}}"
                                            class="btn btn-success">REACTIVAR</a>
                                    </td>
                                    <td nowrap>
                                        <form action="{{route('prospectos.destroy', ['id'=>$cita->prospecto])}}"
                                            method="POST">
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
@extends('principal')
@section('content')

    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3>EMPLEADOS DADOS DE BAJA</h3>
            </div>
            {{-- Tabla de empleados dados de baja --}}
            <div class="card-body">
                <table class="table table-bordered table-striped" id="tablaClientes">
                    <thead>
                        <tr>
                            <th class="text-center" scope="col">#</th>
                            <th class="text-center" scope="col">Nombre</th>
                            <th class="text-center" scope="col">Apellido paterno</th>
                            <th class="text-center" scope="col">Apellido materno</th>
                            <th class="text-center" scope="col">Motivo</th>
                            <th class="text-center" scope="col">¿Es reingresable?</th>
                            <th class="text-center" scope="col">¿Es recomendable?</th>
                            <th class="text-center">Restablecer</th>
                            <th class="text-center">Ver</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($empleadosEliminados as $key => $empleado)
                        <tr class="text-center">
                            <td>{{$key + 1}}</td>
                            <td>{{$empleado->nombre}}</td>
                            <td>{{$empleado->paterno}}</td>
                            <td>{{$empleado->materno}}</td>
                            <td>{{$empleado->motivo_baja}}</td>
                            <td>{{ $empleado->es_reingresable ? 'SI' : 'NO' }}</td>
                            <td>{{ $empleado->es_recomendable ? 'SI' : 'NO' }}</td>
                            <td>
                                {{-- Botón para restablecer al empleado --}}
                                <form action="{{route('empleados.undelete')}}" method="POST">
                                    @csrf
                                    <input type="hidden" value="{{$empleado->id}}" name="empleado_id">
                                    <button type="submit" class="btn btn-success">
                                        <strong><i class="fas fa-level-up-alt"></i></strong>
                                    </button>                                    
                                </form>
                            </td>
                            <td>
                                {{-- Botón para mirar el historial del empleado --}}
                                {{-- <a href="{{route('empleados.show',['id'=>$empleado->id])}}" class="btn btn-info mt-1"><strong>Ver</strong></a> --}}
                                <a href="{{ route('empleados.show', [$empleado]) }}" class="btn btn-primary mt-1">
                                    <i class="fa fa-eye"></i>
                                </a>
                            </td>
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
    <script>
        $(document).ready(function() {
            $('#tablaClientes').DataTable();
        } );
    </script>

@endsection
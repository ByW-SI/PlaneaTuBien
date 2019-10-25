@extends('empleado.show')
@section('submodulos')
<div class="container p-5">

    <div class="card">
        <div class="card-header">
            <h4>Agregar Empleado</h4>
        </div>
        <form method="POST" action="{{route('empleados.relaciones.store',['empleado'=>$empleado])}}">
            <div class="card-body">

                {{ csrf_field() }}
                <div class="form-row mt-3">
                    <div class="col-6">
                        <div class="input-group">
                            @if (!is_null($empleados))
                            <select name="empleado" class="custom-select" id="listaEmpleados" required>
                                <option value="">Seleccionar</option>
                                @foreach($empleados as $emp)
                                    <option value="{{ $emp->id }}">{{ $emp->nombre }} {{ $emp->paterno }} {{ $emp->materno }}</option>
                                @endforeach
                            </select>
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-outline-success" type="button">Agregar</button>
                            </div>
                            @else
                            <div class="alert alert-danger">
                                No hay empleados por asignar.
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="alert alert-secondary" role="alert">
                <p>Para los gerentes: Aparecen solo los supervisores sin un jefe asignado</p>
                <p>Para los supervisores: Aparecen solo los asesores sin un jefe asignado</p>
                  </div>
            </div>

        </form>
    </div>

</div>

@endsection
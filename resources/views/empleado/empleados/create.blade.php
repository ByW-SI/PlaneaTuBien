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
                    <div class="col-6 offset-3">
                        <div class="input-group">
                            {{-- <select required class="custom-select" id="empleado" aria-label="Example select with button addon" name="empleado">
                                <option selected>Agente...</option>
                                @foreach($empleados as $emp)
                                    <option value="{{ $emp->id }}">{{ $emp->nombre }} {{ $emp->paterno }} {{ $emp->materno }}</option>
                                @endforeach
                            </select> --}}
                            <select name="empleado" class="custom-select" id="listaEmpleados" required>
                                <option value=""></option>
                                @foreach($empleados as $emp)
                                    <option value="{{ $emp->id }}">{{ $emp->nombre }} {{ $emp->paterno }} {{ $emp->materno }}</option>
                                @endforeach
                            </select>
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-outline-success" type="button">Agregar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </form>
    </div>

</div>

@endsection
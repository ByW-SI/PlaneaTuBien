@extends('principal')
@section('content')
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-sm-4">
                <h4>Datos del Agente:</h4>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="form-group col-4">
                <label class="control-label">Nombre:</label>
                <input type="text" class="form-control" value="{{ $empleado->nombre }}" readonly="">
            </div>
            <div class="form-group col-4">
                <label class="control-label">Apellido Paterno:</label>
                <input type="text" class="form-control" value="{{ $empleado->paterno }}" readonly="">
            </div>	
            <div class="form-group col-4">
                <label class="control-label">Apellido Materno:</label>
                <input type="text" class="form-control" value="{{ $empleado->materno }}" readonly="">
            </div>		
        </div>
        <div class="row">
            <div class="form-group col-4">
                <label class="control-label">Edad:</label>
                <input type="text" class="form-control" value="{{ $empleado->edad }}" readonly="">
            </div>
            <div class="form-group col-4">
                <label class="control-label">Sexo:</label>
                <input type="text" class="form-control" value="{{ $empleado->sexo }}" readonly="">
            </div>	
            <div class="form-group col-4">
                <label class="control-label">Tipo:</label>
                <input type="text" class="form-control" value="{{ $empleado->tipo }}" readonly="">
            </div>			
        </div>
        <div class="row">
            <div class="form-group col-4">
                <label class="control-label">Sucursal:</label>
                <input type="text" class="form-control" value="{{ $empleado->sucursal->nombre }}" readonly="">
            </div>
            <div class="form-group col-4">
                <label class="control-label">Cargo:</label>
                <input type="text" class="form-control" value="{{ $empleado->cargo }}" readonly="">
            </div>	
           {{--  @if($empleado->tipo == 'Asesor')
                <div class="form-group col-4">
                    <label class="control-label">Supervisor:</label>
                    <input type="text" class="form-control" value="{{ $empleado->jefe->nombre }}" readonly="">
                </div>
            @elseif($empleado->tipo == 'Supervisor')
                <div class="form-group col-4">
                    <label class="control-label">Gerente:</label>
                    <input type="text" class="form-control" value="{{ $empleado->jefe->nombre }}" readonly="">
                </div>
            @endif --}}
        </div>
        @yield('submodulos')
    </div>
</div>


@endsection

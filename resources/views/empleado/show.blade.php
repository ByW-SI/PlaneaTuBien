@extends('principal')
@section('content')
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-sm-4">
                <h4>Datos del Agente:</h4>
            </div>
            <div class="col-sm-4 text-center">
                <a href="{{ route('empleados.index') }}" class="btn btn-primary">
                    <i class="fa fa-book"></i><strong> Lista de Agentes</strong>
                </a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
                <label class="control-label">Nombre:</label>
                <input type="text" class="form-control" value="{{ $empleado->nombre }}" readonly="">
            </div>
            <div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
                <label class="control-label">Apellido Paterno:</label>
                <input type="text" class="form-control" value="{{ $empleado->paterno }}" readonly="">
            </div>	
            <div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
                <label class="control-label">Apellido Materno:</label>
                <input type="text" class="form-control" value="{{ $empleado->materno }}" readonly="">
            </div>		
            <div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
                <label class="control-label">Fecha de nacimiento:</label>
                <input type="date" class="form-control" value="{{ $empleado->fecha_nacimiento }}" readonly="">
            </div>
            <div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
                <label class="control-label">Edad:</label>
                <input type="text" class="form-control" value="{{ $empleado->edad }}" readonly="">
            </div>
            <div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
                <label class="control-label">Sexo:</label>
                <input type="text" class="form-control" value="{{ $empleado->sexo }}" readonly="">
            </div>  
            <div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
                <label class="control-label">Correo electrónico:</label>
                <input type="email" class="form-control" value="{{ $empleado->email }}" readonly="">
            </div>	

            <div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
                <label class="control-label">Sucursal:</label>
                <input type="text" class="form-control" value="{{ $empleado->sucursal ? $empleado->sucursal->nombre : 'NA' }}" readonly="">
            </div>
            <div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
                <label class="control-label">Puesto:</label>
                <input type="text" class="form-control" value="{{ $empleado->tipo }}" readonly="">
            </div>			
            {{-- <div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
                <label class="control-label">Cargo:</label>
                <input type="text" class="form-control" value="{{ $empleado->cargo }}" readonly="">
            </div>	 --}}
            @if($empleado->tipo == 'Asesor')
                <div class="form-group col-4">
                    <label class="control-label">Supervisor:</label>
                    @if(isset($empleado->jefe))
                    <input type="text" class="form-control" value="{{ $empleado->jefe->nombre }} {{ $empleado->jefe->paterno }} {{ $empleado->jefe->materno }}" readonly="">
                    @else
                    <h5 class="alert-danger">No tiene asignado un Supervisor</h5>
                    @endif
                </div>
            @elseif($empleado->tipo == 'Supervisor')
                <div class="form-group col-4">
                    <label class="control-label">Gerente:</label>
                    @if(isset($empleado->jefe))
                    <input type="text" class="form-control" value="{{ $empleado->jefe->nombre }} {{ $empleado->jefe->paterno }} {{ $empleado->jefe->materno }}" readonly="">
                    @else
                    <h5 class="alert-danger p-2 rounded">No tiene asignado un Gerente</h5>
                    @endif
                </div>
            @endif
        </div>
        @yield('submodulos')
    </div>
</div>


@endsection

@extends('empleado.show')
@section('submodulos')
<div class="row">
    <div class="col-sm-12">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('empleados.show', ['empleado' => $empleado]) }}">Datos generales</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('empleados.laborals.index', ['empleado' => $empleado]) }}">Datos Laborales</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('empleados.contactos.index', ['empleado' => $empleado]) }}">Contactos</a>
            </li>
            @if($empleado->tipo != "Asesor")
            <li class="nav-item">
                <a class="nav-link" href="{{ route('empleados.relaciones.index', ['empleado' => $empleado]) }}">Empleados</a>
            </li>
            @endif
            <li class="nav-item">
                <a class="nav-link" href="{{ route('empleados.direcciones.index' , ['empleado' => $empleado]) }}">Dirección</a>
            </li>
        </ul>
    </div>
</div>
<div class="card card-default">
	<div class="card-header">
		<h4>
			Datos Laborales
		</h4>
	</div>
	<div class="card-header">
		<h5>
			Registro actual
		</h5>
	</div>
	<div class="card-body">
		@if ($dato_lab)
			
		@else
			<div class="alert alert-warning" role="alert">
				El agente {{$empleado->nombre." ".$empleado->paterno." ".$empleado->materno}} aún no tiene registro laboral. <a href="{{ route('empleados.laborals.create',['empleado'=>$empleado]) }}" class="alert-link">Por favor, cree un nuevo registro aquí</a>.
			</div>
		@endif
	</div>
	<div class="card-header">
		<h5>Historial de registos laborales</h5>
	</div>
	<div class="card-body">
		<table class="table table-striped table-bordered"></table>
	</div>
	<div class="card-footer">
		<div class="d-flex justify-content-center">
			<a href="{{ route('empleados.laborals.create',['empleado'=>$empleado]) }}" class="btn btn-success">
				<i class="fa fa-plus"></i><strong> Agregar registro laboral</strong>
			</a>
		</div>
	</div>
</div>
@endsection
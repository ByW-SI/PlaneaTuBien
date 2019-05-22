@extends('empleado.show')
@section('submodulos')

<div class="row">
    <div class="col-sm-12">
        <ul class="nav nav-tabs">
        	<li class="nav-item">
                <a class="nav-link" href="{{ route('empleados.show', ['empleado' => $empleado]) }}">Datos generales</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('empleados.laborals.index', ['empleado' => $empleado]) }}">Datos Laborales</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('empleados.contactos.index', ['empleado' => $empleado]) }}">Contactos</a>
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

<div class="card">
	<div class="card-header">
		<div class="row">
			<div class="col-sm-4">
				<h4>Contactos</h4>
			</div>
			<div class="col-sm-4 text-center">
				<a href="{{ route('empleados.contactos.create', ['empleado' => $empleado]) }}" class="btn btn-success">
					<i class="fa fa-plus"></i><strong> Agregar Contacto</strong>
				</a>
			</div>
		</div>
	</div>
	<div class="card-body">
		<div class="row">
			<div class="col-sm-12">
				@if(count($contactos) > 0)
					<table class="table table-striped table-bordered table-hover" style="margin-bottom: 0px">
						<tr class="info">
							<th>Telefono</th>
							<th>Celular</th>
							<th>Correo</th>
							<th>Acción</th>
						</tr>  
						@foreach($contactos as $contacto)
							<tr>
								<td>{{ $contacto->telefono }} </td>
								<td>{{ $contacto->celular }}</td>
								<td>{{ $contacto->correo }}</td>
								<td>
									<button type="button" class="btn btn-warning">Editar</button>
									<button type="button" class="btn btn-danger">Baja</button>
								</td>
							</tr>
						@endforeach
					</table>
				@else
					<h4>No hay contactos disponibles.</h4>
				@endif
			</div>
		</div>
	</div>
</div>

@endsection
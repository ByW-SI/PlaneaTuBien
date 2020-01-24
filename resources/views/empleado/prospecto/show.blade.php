@extends('principal')
@section('content')
@if ($errors->any())
<div class="alert alert-danger">
	<ul>
		@foreach ($errors->all() as $error)
		<li>{{ $error }}</li>
		@endforeach
	</ul>
</div>
@endif
<div class="card card-default">
	<div class="card-header">
		<h4>
			Prospecto: {{$prospecto->nombre." ".$prospecto->appaterno." ".$prospecto->apmaterno}}
		</h4>
		<h4>
			Asesor:
			{{ $prospecto->asesor ? $prospecto->asesor->nombre.' '.$prospecto->asesor->paterno.' '.$prospecto->asesor->materno : ""}}
		</h4>
	</div>
	<div class="card-header">
		<h5>Datos generales del prospecto:</h5>
		<div class="d-flex justify-content-around">
			<a href="{{ route('empleados.prospectos.index',['empleado'=>$empleado]) }}" class="btn btn-primary">
				<i class="fa fa-bars"></i><strong> Lista de Prospectos</strong>
			</a>
			{{-- <a href=" route('empleados.prospectos.crms.index',['empleado'=>$empleado,'prospecto'=>$prospecto])" class="btn btn-info" id="basic-addon1">
				<i class="far fa-calendar-check"></i>
				<strong> C.R.M.</strong>
			</a> --}}
			<a href="{{ route('empleados.prospectos.edit',['empleado'=>$empleado,'prospecto'=>$prospecto]) }}"
				class="btn btn-warning" id="basic-addon1">
				<i class="fas fa-user-edit"></i>
				<strong> Editar prospecto</strong>
			</a>
			{{-- <a href=" route('empleados.prospectos.cotizacions.index',['empleado'=>$empleado,'prospecto'=>$prospecto]) " class="btn btn-info" id="basic-addon1">
				<i class="fas fa-file-invoice-dollar"></i>
				<strong> Cotizador</strong>
			</a> --}}
			@if ($prospecto->perfil)
			<a href="{{ route('prospectos.perfil.datos_personal.index',['prospecto'=>$prospecto]) }}"
				class="btn btn-success" id="basic-addon1">
				<i class="fas fa-file-invoice"></i>
				<strong> Perfil</strong>
			</a>

			@endif
		</div>
	</div>
	<div class="card-body">
		{{-- CONTENEDOR DATOS GENERALES --}}
		<div class="card">
			<div class="card-body">
				<div class="row row-group">
					<div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
						<label>Nombre:</label>
						<input type="text" class="form-control" value="{{ $prospecto->nombre }}" readonly="">
					</div>
					<div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
						<label>Apellido Paterno:</label>
						<input type="text" class="form-control" value="{{ $prospecto->appaterno }}" readonly="">
					</div>
					<div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
						<label>Apellido Materno:</label>
						<input type="text" class="form-control" value="{{ $prospecto->apmaterno }}" readonly="">
					</div>
					<div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
						<label>Correo electronico:</label>
						<input type="text" class="form-control" value="{{ $prospecto->email }}" readonly="">
					</div>
					<div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
						<label>Telefono:</label>
						<input type="text" class="form-control" value="{{ $prospecto->telefono }}" readonly="">
					</div>
					<div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
						<label>Telefono movil:</label>
						<input type="text" class="form-control" value="{{ $prospecto->celular }}" readonly="">
					</div>
					<div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
						<label>Asesor:</label>
						<input type="text" class="form-control"
							value="{{ $prospecto->asesor ? $prospecto->asesor->nombre.' '.$prospecto->asesor->paterno.' '.$prospecto->asesor->materno : "No asignado" }}"
							readonly="">
					</div>
					<div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
						<label>Estatus Prospecto:</label>
						<input type="text" class="form-control"
							value="{{ $prospecto->asesor ? 'Seguimiento Llamada' : 'Sin asesor' }}" readonly="">
					</div>
				</div>
			</div>
		</div>
		<h5 class="text-center text-uppercase text-muted my-4">ASESORES TEMPORALES</h5>
		{{-- CONTENEDOR ASESORES --}}
		<div class="card">
			<div class="card-body">
				<div class="table-responsive">
					@forelse ($asesoresTemporales as $asesor)
					<table id="asesores" class="table">
						<thead class="thead-dark">
							<tr>
								<th>ID</th>
								<th>Asesor</th>
								<th>Fecha inicio</th>
								<th>Fecha fin</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>{{$asesor->id}}</td>
								<td>{{$asesor->nombre}} {{$asesor->appaterno}} {{$asesor->apmaterno}}</td>
								<td>{{$asesor->pivot->fechaInicioTemporal}}</td>
								<td>{{$asesor->pivot->fechaFinTemporal}}</td>
							</tr>
							@empty
							<div class="alert alert-info">
								No cuenta con asesores temporales.
							</div>
							@endforelse
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
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

<div class="row">
	<div class="col-12 col-md-4 mt-4">
		<div class="card">
			<div class="card-header">
				<h5 class="text-center text-uppercase text-muted">PROSPECTO</h5>
			</div>
			<div class="card-body">
				<span class="text-uppercase">
					{{$prospecto->nombre." ".$prospecto->appaterno." ".$prospecto->apmaterno}}
				</span>
			</div>
		</div>
	</div>
	@if (is_null($prospecto->empleado) || $prospecto->empleado->es_asesor)
	<div class="col-12 col-md-4 mt-4">
		<div class="card">
			<div class="card-header">
				<h5 class="text-center text-uppercase text-muted">ASESOR</h5>
			</div>
			<div class="card-body">
				<span class="text-uppercase">
					{{ $prospecto->asesor ? $prospecto->asesor->nombre.' '.$prospecto->asesor->paterno.' '.$prospecto->asesor->materno : "NO ASIGNADO"}}
				</span>
			</div>
		</div>
	</div>
	@endif

	@if (is_null( $prospecto->empleado ) || !$prospecto->empleado->es_asesor)
	<div class="col-12 col-md-4 mt-4">
		<div class="card">
			<div class="card-header">
				<h5 class="text-center text-uppercase text-muted">DIRECTIVO</h5>
			</div>
			<div class="card-body">
				<span class="text-uppercase">
					<form action="{{route('prospectos.asignar.directivo', ['prospecto' => $prospecto->id])}}" class="form-inline" method="POST">
						@csrf
						<select name="directivo_id" id="inputDirectivos" class="form-group form-control">
							<option value="">Seleccionar</option>
							@foreach ($directivos as $directivo)
							<option value="{{$directivo->id}}" {{$prospecto->empleado == $directivo ? 'selected' : ''}}>{{$directivo->full_name}}</option>
							@endforeach
						</select>
						<button class="btn btn-success form-group form-control ml-2" type="submit">Guardar</button>
					</form>
				</span>
			</div>
		</div>
	</div>
	@endif
</div>

<div class="row">
	<div class="col-12">
		<div class="card card-default mt-4">
			<div class="card-header">
				<a href="{{ route('empleados.prospectos.index',['empleado'=>$empleado]) }}" class="btn btn-primary">
					<i class="fa fa-bars"></i><strong> Lista de Prospectos</strong>
				</a>
				{{-- CRM --}}
				<a href="{{ route('empleados.prospectos.crms.index',['empleado'=>$empleado,'prospecto'=>$prospecto]) }}"
					class="btn btn-primary" id="basic-addon1">
					<i class="fas fa-user-edit"></i>
					<strong> CRM</strong>
				</a>
				<a href="{{ route('empleados.prospectos.edit',['empleado'=>$empleado,'prospecto'=>$prospecto]) }}"
					class="btn btn-warning" id="basic-addon1">
					<i class="fas fa-user-edit"></i>
					<strong> Editar prospecto</strong>
				</a>
				@if (!is_null( $prospecto->empleado ))
				<a href="{{ route('empleados.prospectos.cotizacions.index',['empleado'=>$prospecto->empleado->id,'prospecto'=>$prospecto]) }}"
					class="btn btn-success" id="basic-addon1">
					<i class="fas fa-file-invoice"></i>
					<strong> Cotizaciones</strong>
				</a>
				@endif
				@if ($prospecto->perfil)
				<a href="{{ route('prospectos.perfil.datos_personal.index',['prospecto'=>$prospecto]) }}"
					class="btn btn-success" id="basic-addon1">
					<i class="fas fa-file-invoice"></i>
					<strong> Ver Perfil</strong>
				</a>
				@else
				<div style="display:inline-block" data-toggle="tooltip" data-placement="top"
					title="Para poder crear un perfil es necesario asginar un asesor a este prospecto.">
					<a href="{{ route('crear-perfil-sin-cotizacion',['prospecto'=>$prospecto]) }}"
						class="btn btn-success {{ $prospecto->empleado ? '' : 'disabled' }}" id="basic-addon1">
						<i class="fas fa-file-invoice"></i>
						<strong> Crear Perfil</strong>
					</a>
				</div>
				@endif
				@if ($prospecto->perfil && $prospecto->cotizaciones)
				<a href="{{ route('prospectos.presolicitud.create',['prospecto'=>$prospecto]) }}"
					class="btn btn-primary" id="basic-addon1">
					<i class="fas fa-file-invoice"></i>
					<strong> Generar presolicitud</strong>
				</a>
				@endif
			</div>
			<div class="card-body">
				<div class="row">
					{{-- CONTENEDOR DATOS GENERALES --}}
					<div class="col-12 col-md-6">
						<h5 class="text-center text-uppercase text-muted my-4">datos generales</h5>
						<div class="card">
							<div class="card-body">
								<div class="row row-group">
									<div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
										<label class="text-uppercase text-muted">Nombre:</label>
										<input type="text" class="form-control" value="{{ $prospecto->nombre }}"
											readonly="">
									</div>
									<div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
										<label class="text-uppercase text-muted">Apellido Paterno:</label>
										<input type="text" class="form-control" value="{{ $prospecto->appaterno }}"
											readonly="">
									</div>
									<div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
										<label class="text-uppercase text-muted">Apellido Materno:</label>
										<input type="text" class="form-control" value="{{ $prospecto->apmaterno }}"
											readonly="">
									</div>
									<div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
										<label class="text-uppercase text-muted">Correo electronico:</label>
										<input type="text" class="form-control" value="{{ $prospecto->email }}"
											readonly="">
									</div>
									<div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
										<label class="text-uppercase text-muted">Telefono:</label>
										<input type="text" class="form-control" value="{{ $prospecto->telefono }}"
											readonly="">
									</div>
									<div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
										<label class="text-uppercase text-muted">Telefono movil:</label>
										<input type="text" class="form-control" value="{{ $prospecto->celular }}"
											readonly="">
									</div>
									<div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
										<label class="text-uppercase text-muted">Asesor:</label>
										<input type="text" class="form-control"
											value="{{ $prospecto->asesor ? $prospecto->asesor->nombre.' '.$prospecto->asesor->paterno.' '.$prospecto->asesor->materno : "No asignado" }}"
											readonly="">
									</div>
									<div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
										<label class="text-uppercase text-muted">Estatus Prospecto:</label>
										<input type="text" class="form-control"
											value="{{ $prospecto->asesor ? 'Seguimiento Llamada' : 'Sin asesor' }}"
											readonly="">
									</div>
								</div>
							</div>
						</div>
					</div>
					{{-- CONTENEDOR ASESORES --}}
					<div class="col-12 col-md-6">
						<h5 class="text-center text-uppercase text-muted my-4">ASESORES TEMPORALES</h5>
						<div class="card">
							<div class="card-body">
								<div class="table-responsive">
									@if (!empty($asesoresTemporales))
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
											@forelse ($asesoresTemporales as $asesor)
											<tr>
												<td>{{$asesor->id}}</td>
												<td>{{$asesor->nombre}} {{$asesor->appaterno}} {{$asesor->apmaterno}}
												</td>
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
									@else
									<div class="alert alert-info">
										No cuenta con asesores temporales.
									</div>
									@endif
								</div>
							</div>
						</div>
					</div>
					{{-- PRESOLICITUDES --}}
					<div class="col-12 col-md-6">
						<h5 class="text-center text-uppercase text-muted my-4">presolicitud</h5>
						<div class="card">
							<div class="card-body">
								<div class="row">
									@if ($prospecto->perfil && $prospecto->perfil->presolicitud)
									<div class="col-12 mt-2 col-md-6">
										<label for="" class="text-uppercase text-muted">ID</label>
										<input type="text" class="form-control"
											value="{{$prospecto->perfil->presolicitud->id}}" readonly>
									</div>
									<div class="col-12 mt-2 col-md-6">
										<label for="" class="text-uppercase text-muted">folio</label>
										<input type="text" class="form-control"
											value="{{$prospecto->perfil->presolicitud->folio}}" readonly>
									</div>
									<div class="col-12 mt-2 col-md-6">
										<label for="" class="text-uppercase text-muted">Plan</label>
										<input type="text" class="form-control"
											value="{{$prospecto->perfil->presolicitud->plan}}" readonly>
									</div>
									<div class="col-12 mt-2">
										<a href="{{
												route('prospectos.presolicitud.index', ['id'=>$prospecto->id])
											}}" class="btn btn-success">Ver</a>
									</div>
									@else
									<div class="col-12 mt-2">
										<div class="alert alert-info">
											No tienen ningúna presolicitud.
										</div>
										Para generar una presolicitud
										es necesario crear un perfil y contar con al menos una cotización.
									</div>
									@endif
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

<script>
	$(document).on('change','#inputDirectivos', function(){
	console.log( $(this).val() )
})

</script>

@endsection
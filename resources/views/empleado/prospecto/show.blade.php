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
	<div class="col-4">
		<div class="card">
			<div class="card-header">
				<h5 class="text-center text-uppercase text-muted">PROSPECTO</h5>
			</div>
			<div class="card-body">
				<span class="text-uppercase">
					{{$prospecto->nombre." ".$prospecto->appaterno." ".$prospecto->apmaterno}}
					{{ $prospecto->asesor ? $prospecto->asesor->nombre.' '.$prospecto->asesor->paterno.' '.$prospecto->asesor->materno : ""}}

				</span>
			</div>
		</div>
	</div>
	<div class="col-4">
		<div class="card">
			<div class="card-header">
				<h5 class="text-center text-uppercase text-muted">ASESOR</h5>
			</div>
			<div class="card-body">
				<span class="text-uppercase">
					{{ $prospecto->asesor ? $prospecto->asesor->nombre.' '.$prospecto->asesor->paterno.' '.$prospecto->asesor->materno : ""}}

				</span>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-12">
		<div class="card card-default mt-4">
			<div class="card-header">
				<a href="{{ route('empleados.prospectos.index',['empleado'=>$empleado]) }}" class="btn btn-primary">
					<i class="fa fa-bars"></i><strong> Lista de Prospectos</strong>
				</a>
				<a href="{{ route('empleados.prospectos.edit',['empleado'=>$empleado,'prospecto'=>$prospecto]) }}"
					class="btn btn-warning" id="basic-addon1">
					<i class="fas fa-user-edit"></i>
					<strong> Editar prospecto</strong>
				</a>
				<a href="{{ route('empleados.prospectos.cotizacions.index',['empleado'=>$prospecto->empleado->id,'prospecto'=>$prospecto]) }}"
					class="btn btn-success" id="basic-addon1">
					<i class="fas fa-file-invoice"></i>
					<strong> Cotizaciones</strong>
				</a>
				@if ($prospecto->perfil)
				<a href="{{ route('prospectos.perfil.datos_personal.index',['prospecto'=>$prospecto]) }}"
					class="btn btn-success" id="basic-addon1">
					<i class="fas fa-file-invoice"></i>
					<strong> Ver Perfil</strong>
				</a>
				@else
				<a href="{{ route('crear-perfil-sin-cotizacion',['prospecto'=>$prospecto]) }}" class="btn btn-success"
					id="basic-addon1">
					<i class="fas fa-file-invoice"></i>
					<strong> Crear Perfil</strong>
				</a>
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

@endsection
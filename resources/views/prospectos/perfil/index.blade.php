@extends('principal')
@section('content')
<div class="row no-guttters">
	<div class="d-sm-none d-md-block col">
		@include('prospectos.perfil.info')
	</div>
	<div class="col">
		<div class="card">
			<div class="card-header">
				<div class="d-flex justify-content-between">
					<h4 class="mt-0">Perfil:</h4>
					{{-- BOTON IMPRIMIR PERFIL --}}
					<a href="{{ route('prospectos.perfil.pdf',['prospecto'=>$prospecto]) }}"
						class="btn btn-success">Imprimir perfil</a>
					{{-- BOTON COTIZACIONES --}}
					<a href="{{ route('empleados.prospectos.cotizacions.index',['empleado'=>$prospecto->empleado->id,'prospecto'=>$prospecto]) }}"
						class="btn btn-success" id="basic-addon1">
						<i class="fas fa-file-invoice"></i>
						<strong> Cotizaciones</strong>
					</a>
					@if ($prospecto->perfil && $prospecto->cotizaciones)
					<a href="{{ route('prospectos.presolicitud.create',['prospecto'=>$prospecto]) }}"
						class="btn btn-primary" id="basic-addon1">
						<i class="fas fa-file-invoice"></i>
						<strong> Generar presolicitud</strong>
					</a>
					@endif

					{{-- @if($cotizacion && $cotizacion->plan->tipo != 'libre') --}}
					{{-- <a class="btn btn-success" href="{{ route('prospectos.cotizacions.pagos.index',['prospecto'=>$prospecto,'cotizacion'=>$cotizacion]) }}">Pagos</a>
					--}}
					{{-- @else --}}
					{{-- <a class="btn btn-success" href="#">Pagos --</a> --}}
					{{-- @endif --}}
					{{-- @if ( ($cotizacion && $cotizacion->liberar) || $cotizacion->plan->tipo == 'libre') --}}
					{{-- <a href="{{ route('prospectos.presolicitud.index',['prospecto'=>$prospecto]) }}" class="btn
					btn-success">Presolicitud</a> --}}
					{{-- @endif --}}
				</div>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-6">
						<label for="folio" class="col-form-label">Folio:</label>
						<label class="form-control" readonly="">{{$perfil->folio}}</label>
					</div>
					<div class="col-6">
						<label for="asesor" class="col-form-label">Asesor:</label>
						<label class="form-control"
							readonly="">@if($perfil->asesor){{$perfil->asesor->nombre." ".$perfil->asesor->paterno." ".$perfil->asesor->materno}}
							@else -- @endif</label>
					</div>
					<div class="col-6">
						<label for="fecha" class="col-form-label">fecha:</label>
						<label class="form-control" readonly="">{{$perfil->fecha}}</label>
					</div>
					<div class="col-6">
						<label for="clave" class="col-form-label">Clave:</label>
						<label class="form-control" readonly="">{{$perfil->clave}}</label>
					</div>
					<div class="col-6">
						<label for="plan" class="col-form-label">Plan:</label>
						<label class="form-control" readonly="">{{$perfil->plan}}</label>
					</div>
				</div>
				{{-- {{$perfil->historial_crediticio}} --}}
			</div>
			<ul class="nav nav-tabs" id="myTab" role="tablist">
				<li class="nav-item">
					<a class="nav-link active" id="datos_personal-tab" data-toggle="tab" href="#datos_personal"
						role="tab" aria-controls="datos_personal" aria-selected="true">Datos personales</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" id="crediticio-tab" data-toggle="tab" href="#crediticio" role="tab"
						aria-controls="crediticio" aria-selected="false">Historial crediticio</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" id="inmueble-tab" data-toggle="tab" href="#inmueble" role="tab"
						aria-controls="inmueble" aria-selected="false">Inmueble</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" id="referencia-tab" data-toggle="tab" href="#referencia" role="tab"
						aria-controls="referencia" aria-selected="false">Referencias personales</a>
				</li>
			</ul>
			<div class="tab-content" id="myTabContent">
				<div class="tab-pane fade show active" id="datos_personal" role="tabpanel"
					aria-labelledby="datos_personal-tab">
					@include('prospectos.perfil.datos_personal.info',['personal'=>$perfil])
				</div>
				<div class="tab-pane fade" id="crediticio" role="tabpanel" aria-labelledby="crediticio-tab">
					@include('prospectos.perfil.historial_crediticio.info', ['credito' =>
					$perfil->historial_crediticio])
				</div>
				<div class="tab-pane fade" id="inmueble" role="tabpanel" aria-labelledby="inmueble-tab">
					@include('prospectos.perfil.inmueble_pretendido.info', ['inmueble' => $perfil->inmueble_pretendido])
				</div>
				<div class="tab-pane fade" id="referencia" role="tabpanel" aria-labelledby="referencia-tab">
					@include('prospectos.perfil.referencia_personals.info', ['referencias' =>
					$perfil->referencia_personals])
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
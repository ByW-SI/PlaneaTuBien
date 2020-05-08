@extends('principal')
@section('content')
<div class="card">
	@include('prospectos.presolicitud.navs',['prospectos'=>$prospecto,'presolicitud'=>$presolicitud,'active'=>'Solicitante'])
	<div class="card-body">
		<div class="row">
			<div class="col-sm-12 col-md-3 col-lg-3 col-xl-3 form-group">
				<label for="">Folio</label>
				<label class="form-control bg-light">{{$presolicitud->folio}}</label>
			</div>
			<div class="col-sm-12 col-md-3 col-lg-3 col-xl-3 form-group">
				<label for="">Precio inicial</label>
				<div class="input-group mb-3">
					<div class="input-group-prepend">
						<span class="input-group-text" id="basic-addon1">$</span>
					</div>
					<label class="form-control bg-light">{{number_format($presolicitud->precio_inicial,2)}}</label>
				</div>
			</div>
			<div class="col-sm-12 col-md-3 col-lg-3 col-xl-3 form-group">
				<label for="">Plazo contratado</label>
				<div class="input-group mb-3">
					<label class="form-control bg-light">{{$presolicitud->plazo_contratado,2}}</label>
					<div class="input-group-append">
						<span class="input-group-text" id="basic-addon1">Meses</span>
					</div>
				</div>
			</div>
			<div class="col-sm-12 col-md-3 col-lg-3 col-xl-3 form-group">
				<label for="">Plan</label>
				<label class="form-control bg-light">{{$presolicitud->plan}}</label>
			</div>
			<div class="col-12">
				<p>
					<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample"
						aria-expanded="false" aria-controls="collapseExample">
						Cambiar cotización
					</button>
				</p>
				<div class="collapse" id="collapseExample">
					<div class="card card-body">
						<div class="row">
							<div class="col-12">
								<div class="row">
									@foreach ($prospecto->cotizaciones as $cotizacion)
									{{-- {{$presolicitud->perfil->cotizacion->totalPagadoDeInscripcion}} --}}
									{{-- {{$cotizacion->inscripcion}} --}}
									{{-- {{floatval($presolicitud->perfil->cotizacion->totalPagadoDeInscripcion) - 300}}
									--}}
									{{-- {{}} --}}
									<div class="col-12 col-md-4 mt-3">
										<div
											class="card {{$presolicitud->perfil->cotizacion->id == $cotizacion->id ? 'border border-success' : ''}}">
											<div class="card-body">
												<div class="row">
													<div class="col-6 mt-3">
														<label for="" class="text-uppercase text-muted">ID
															COTIZACIÓN</label>
														<input type="text" readonly value="{{$cotizacion->id}}"
															class="form-control">
													</div>
													<div class="col-6 mt-3">
														<label for="" class="text-uppercase text-muted">Monto</label>
														<input type="text" readonly value="{{$cotizacion->monto}}"
															class="form-control">
													</div>
													<div class="col-6 mt-3">
														<label for="" class="text-uppercase text-muted">Plan</label>
														<input type="text" readonly
															value="{{$cotizacion->plan->nombre}}" class="form-control">
													</div>
													<div class="col-6 mt-3">
														<label for="" class="text-uppercase text-muted">Diferencia
															inscripción</label>
														<input type="text" readonly
															class="form-control {{ floatval($presolicitud->perfil->cotizacion->totalPagadoDeInscripcion) - $cotizacion->inscripcion < 0 ? 'is-invalid' : 'is-valid' }}"
															value="{{floatval($presolicitud->perfil->cotizacion->totalPagadoDeInscripcion) - $cotizacion->inscripcion}}">
														@if (
														floatval($presolicitud->perfil->cotizacion->totalPagadoDeInscripcion)
														- $cotizacion->inscripcion > 0 )
														<div class="valid-feedback">
															La diferencia será abonada al siguiente pago.
														</div>
														@endif
													</div>
												</div>
												<div class="row">
													<div class="col-6 mt-3">
														<form
															action="{{route('presolicitudes.cotizaciones.cambiar',['presolictud' => $presolicitud->id])}}"
															method="POST">
															@csrf
															@method('PUT')
															<input type="text" name="cotizacion_id"
																value="{{$cotizacion->id}}" class="form-control d-none">
															<button type="submit"
																class="btn btn-primary">Cambiar</button>
														</form>
													</div>
												</div>
											</div>
										</div>
									</div>

									@endforeach
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-12 mt-2">
				<h5>
					Solicitante
				</h5>
			</div>
			<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
				<label for="">Apellido Paterno</label>
				<label class="form-control bg-light">{{$presolicitud->paterno}}</label>
			</div>
			<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
				<label for="">Apellido Materno</label>
				<label class="form-control bg-light">{{$presolicitud->materno}}</label>
			</div>
			<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
				<label for="">Nombre(s)</label>
				<label class="form-control bg-light">{{$presolicitud->nombre}}</label>
			</div>
			<div class="col-12">
				<h5>
					Domicilio
				</h5>
			</div>
			<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
				<label for="">Calle</label>
				<label class="form-control bg-light">{{$presolicitud->calle}}</label>
			</div>
			<div class="col-sm-12 col-md-2 col-lg-2 col-xl-2 form-group">
				<label for="">Numero exterior</label>
				<label class="form-control bg-light">{{$presolicitud->numero_ext}}</label>
			</div>
			<div class="col-sm-12 col-md-2 col-lg-2 col-xl-2 form-group">
				<label for="">Numero interior</label>
				<label class="form-control bg-light">{{$presolicitud->numero_int}}</label>
			</div>
			<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
				<label for="">Colonia</label>
				<label class="form-control bg-light">{{$presolicitud->colonia}}</label>
			</div>
			<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
				<label for="">Alcaldía o Municipio</label>
				<label class="form-control bg-light">{{$presolicitud->municipio}}</label>
			</div>
			<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
				<label for="">Estado</label>
				<label class="form-control bg-light">{{$presolicitud->estado}}</label>
			</div>
			<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
				<label for="">Código Postal</label>
				<label class="form-control bg-light">{{$presolicitud->cp}}</label>
			</div>
			<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
				<label for="">R.F.C.</label>
				<label class="form-control bg-light">{{$presolicitud->rfc}}</label>
			</div>
			<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
				<label for="">Télefono de casa</label>
				<label class="form-control bg-light">{{$presolicitud->tel_casa}}</label>
			</div>
			<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
				<label for="">Télefono de oficina</label>
				<label class="form-control bg-light">{{$presolicitud->tel_oficina}}</label>
			</div>
			<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
				<label for="">Télefono celular</label>
				<label class="form-control bg-light">{{$presolicitud->tel_celular}}</label>
			</div>
			<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
				<label for="">Correo Electrónico</label>
				<label class="form-control bg-light">{{$presolicitud->email}}</label>
			</div>
			<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
				<label for="">Fecha de nacimiento</label>
				<label class="form-control bg-light">{{$presolicitud->fecha_nacimiento}}</label>
			</div>
			<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
				<label for="">Lugar de Nacimiento</label>
				<label class="form-control bg-light">{{$presolicitud->lugar_nacimiento}}</label>
			</div>
			<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
				<label for="">Nacionalidad</label>
				<label class="form-control bg-light">{{$presolicitud->nacionalidad}}</label>
			</div>
			<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
				<label for="">Sexo</label>
				<label class="form-control bg-light">{{$presolicitud->sexo}}</label>
			</div>
			<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
				<label for="">Edad</label>
				<label class="form-control bg-light">{{$presolicitud->age}}</label>
			</div>
			<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
				<label for="">Estado Civil</label>
				<label class="form-control bg-light">{{$presolicitud->estado_civil}}</label>
			</div>
			<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
				<label for="">Profesión/Actividad</label>
				<label class="form-control bg-light">{{$presolicitud->profesion}}</label>
			</div>
			<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
				<label for="">Empresa donde trabaja</label>
				<label class="form-control bg-light">{{$presolicitud->empresa}}</label>
			</div>
			<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
				<label for="">Puesto</label>
				<label class="form-control bg-light">{{$presolicitud->puesto}}</label>
			</div>
			<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
				<label for="">Antigüedad trabajo actual</label>
				<label class="form-control bg-light">{{$presolicitud->antiguedad_actual}}</label>
			</div>
			<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
				<label for="">Antigüedad trabajo anterior</label>
				<label class="form-control bg-light">{{$presolicitud->antiguedad_anterior}}</label>
			</div>
			<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
				<label for="">Ingreso mensual familiar</label>
				<label class="form-control bg-light">{{$presolicitud->ingreso_mensual}}</label>
			</div>
			<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
				<label for="">¿Cómo se entero de nosotros?</label>
				<label class="form-control bg-light">{{$presolicitud->enterarse}}</label>
			</div>
		</div>
		<div class="d-flex justify-content-center">
			<a 
			href="{{ route('prospectos.presolicitud.edit',
			[
			'prospecto'=>$prospecto,
			'presolicitud'=>$presolicitud
			]) }}" 

			class="btn btn-success">Editar</a>
		</div>
	</div>
	@include('prospectos.presolicitud.footer',['presolicitud'=>$presolicitud])

</div>
@endsection
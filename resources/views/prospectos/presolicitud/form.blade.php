@extends('principal')
@section('content')
<div class="card">
	<div class="card-header">
		<h5>
			Pre solicitud para {{$prospecto->nombre." ".$prospecto->appaterno." ".$prospecto->apmaterno}}
		</h5>
		<div class="progress">
			<div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="2"
				aria-valuemin="0" aria-valuemax="100" style="width: 2%"></div>
		</div>
	</div>
	<form method="POST" action="{{ route('prospectos.presolicitud.store',['prospecto'=>$prospecto]) }}">
		@csrf

		<ul class="nav nav-tabs">
			<li class="nav-item">
				<a class="nav-link active" href="#">SOLICITANTE</a>
			</li>
			<li class="nav-item">
				<a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">CÓNYUGE, CONCUBINO U OBLIGADO
					SOLIDARIO</a>
			</li>
			<li class="nav-item">
				<a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">BENEFICIARIO</a>
			</li>
			<li class="nav-item">
				<a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">REFERENCIAS PERSONALES</a>
			</li>
			<li class="nav-item">
				<a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">RECIBO PROVISIONAL</a>
			</li>
		</ul>
		<div class="card-body">
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

				{{-- DATOS GENERALES --}}

				<div class="col-12">
					<h4 class="text-muted text-uppercase">Datos generales</h4>
					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
									<label for="">✱ Apellido Paterno</label>
									<input type="text" class="form-control" name="appaterno" required=""
										value="{{old('appaterno') ?: $prospecto->appaterno}}">
								</div>
								<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
									<label for="">✱ Apellido Materno</label>
									<input type="text" class="form-control" name="apmaterno" required=""
										value="{{old('apmaterno') ?: $prospecto->apmaterno}}">
								</div>
								<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
									<label for="">✱ Nombre(s)</label>
									<input type="text" class="form-control" name="nombre" required=""
										value="{{$prospecto->nombre}}">
								</div>
								<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
									<label for="">✱ R.F.C.</label>
									<input type="text" class="form-control" value="{{$prospecto->perfil->rfc_1}}"
										name="rfc" required="">
								</div>
								<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
									<label for="">✱ Fecha de Nacimiento</label>
									<input type="date" class="form-control" value="{{old('fecha_nacimiento') ?: $prospecto->fecha_nacimiento}}"
										name="fecha_nacimiento"
										min="{{(integer)date('Y')-64}}-{{date('m')}}-{{date('d')}}"
										max="{{(integer)date('Y')-18}}-{{date('m')}}-{{date('d')}}" required=""
										onchange="getAge(this.value)">
								</div>
								<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
									<label for="">✱ Edad</label>
									<input type="number" class="form-control" id="edad" value="{{old('edad')}}" min="0"
										max="64" required="" readonly>
								</div>
								{{-- <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
									<label for="">✱ Lugar de Nacimiento</label>
									<input type="text" class="form-control" value="{{old('lugar_nacimiento')}}"
								name="lugar_nacimiento" required="">
							</div> --}}
							<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
								<label for="">✱ Nacionalidad</label>
								<input type="text" class="form-control"
									value="{{ old('nacionalidad_1') ?: $prospecto->perfil->nacionalidad_1 }}"
									name="nacionalidad_1" required="">
							</div>
							<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
								<label for="">✱ Sexo</label>
								<select class="form-control" name="sexo" required="">
									<option value="">Seleccione una opción</option>
									<option {{$prospecto->sexo == "Masculino" ? 'selected' : ""}} value="Masculino">
										Masculino</option>
									<option {{$prospecto->sexo == "Femenino" ? 'selected' : ""}} value="Femenino">
										Femenino</option>
								</select>
							</div>
							<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
								<label for="">✱ Estado Civil</label>
								<select class="form-control" name="estado_civil" required="">
									<option value="{{$prospecto->perfil->estado_civil}}">
										{{$prospecto->perfil->estado_civil}}
									</option>
									<option value="Soltero">Soltero</option>
									<option value="Casado">Casado</option>
									<option value="Viudo">Viudo</option>
									<option value="Divorciado">Divorciado</option>
									<option value="Unión Libre">Unión Libre</option>
								</select>
							</div>
						</div>
					</div>
				</div>
			</div>

			{{-- DIRECCIÓN --}}

			<div class="col-12 mt-4">
				<h4 class="text-muted text-uppercase">Dirección</h4>
				<div class="card">
					<div class="card-body">
						<div class="row">
							<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
								<label for="">✱ Calle</label>
								<input type="text" class="form-control" required=""
									value="{{$prospecto->perfil->calle}}" name="calle">
							</div>
							<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
								<label for="">✱ Número Exterior</label>
								<input type="text" class="form-control" value="{{$prospecto->perfil->numero_ext}}"
									name="numero_ext" required="">
							</div>
							<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
								<label for="">Número Interior</label>
								<input type="text" class="form-control" value="{{$prospecto->perfil->numero_int}}"
									name="numero_int">
							</div>
							<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
								<label for="">✱ Código Postal</label>
								<input type="text" class="form-control" value="{{$prospecto->perfil->cp}}" name="cp"
									id="cp" required="" minlength="5" maxlength="5">
							</div>
							<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
								<label for="">✱ Colonia o Población</label>
								<select class="form-control" name="colonia" id="colonia" required="">
									<option>Seleccione una colonía ó población</option>
								</select>
							</div>
							<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
								<label for="">✱ Alcaldía o Municipio</label>
								<input type="text" class="form-control" value="{{$prospecto->perfil->municipio}}"
									name="municipio" id="municipio" required="">
							</div>
							<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
								<label for="">✱ Estado</label>
								<input type="text" class="form-control" value="{{$prospecto->perfil->estado}}"
									name="estado" id="estado" required="">
							</div>
						</div>
					</div>
				</div>
			</div>

			{{-- CONTACTO --}}

			<div class="col-12 mt-4">
				<h4 class="text-muted text-uppercase">CONTACTO</h4>
				<div class="card">
					<div class="card-body">
						<div class="row">
							<div class="col-sm-12 col-md-3 form-group">
								<label for="">✱ Teléfono de Casa</label>
								<input type="text" class="form-control" value="{{$prospecto->perfil->telefono_casa}}"
									name="tel_casa" required="">
							</div>
							<div class="col-sm-12 col-md-3 form-group">
								<label for="">Teléfono de Oficina</label>
								<input type="text" class="form-control" value="{{$prospecto->perfil->telefono_oficina}}"
									name="tel_oficina">
							</div>
							<div class="col-sm-12 col-md-3 form-group">
								<label for="">✱ Teléfono Celular</label>
								<input type="text" class="form-control" value="{{$prospecto->perfil->telefono_celular}}"
									name="tel_celular" required="">
							</div>
							<div class="col-sm-12 col-md-3 form-group">
								<label for="">✱ Correo Electrónico</label>
								<input type="email" class="form-control" value="{{$prospecto->perfil->email}}"
									name="email" required="">
							</div>
						</div>
					</div>
				</div>
			</div>

			{{-- DATOS PROFESIONALES --}}

			<div class="col-12 mt-4">
				<h4 class="text-muted text-uppercase">DATOS PROFESIONALES</h4>
				<div class="card">
					<div class="card-body">
						<div class="row">
							<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
								<label for="">✱ Profesión/Actividad</label>
								<input type="text" class="form-control"
									value="{{old('ocupacion_1') ?: $prospecto->perfil->ocupacion_1}}" name="ocupacion_1"
									required="">
							</div>
							<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
								<label for="">Empresa donde trabaja</label>
								<input type="text" class="form-control" value="{{$prospecto->perfil->empresa_1}}"
									name="empresa">
							</div>
							<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
								<label for="">Puesto</label>
								<input type="text" class="form-control"
									value="{{old('ocupacion_1') ?: $prospecto->perfil->ocupacion_1}}"
									name="ocupacion_1">
							</div>
							<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
								<label for="">✱ Antigüedad trabajo actual</label>
								<input type="text" class="form-control" value="{{$prospecto->perfil->antiguedad_1}}"
									name="antiguedad_1" required="">
							</div>
							<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
								<label for="">✱ Antigüedad trabajo anterior</label>
								<input type="text" class="form-control"
									value="{{old('antiguedad_2') ?: $prospecto->perfil->antiguedad_2}}"
									name="antiguedad_2" required="">
							</div>
							<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
								<label for="">✱ Ingreso Mensual Familiar</label>
								<input type="text" class="form-control" value="{{$prospecto->perfil->ingreso_total}}"
									name="ingreso_mensual" required="">
							</div>
						</div>
					</div>
				</div>
			</div>


			<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group mt-4">
				<label for="">✱ ¿Cómo se entero de nosotros?</label>
				<select name="enterarse" id="enterarse" required="" class="form-control">
					@foreach ($mediosDeContacto as $medioDeContacto)
					<option value="{{$medioDeContacto->id}}"
						{{ $medioDeContacto->nombre ==$prospecto->perfil->inmueble_pretendido->medio_entero ? 'selected=""' : ''}}>
						{{$medioDeContacto->nombre}}</option>
					@endforeach
					{{--<option value="">Medío por el que se entero de nosotros</option>
						<option value="Internet">Internet</option>
						<option value="T.V.">T.V.</option>
						<option value="Periodico">Periodico</option>
						<option value="Otro">Otro</option>--}}
				</select>
			</div>
		</div>

		<div class="row">
			<div class="col-4"></div>
			<div class="col-4">
				<h4 class="text-center text-uppercase text-muted">SELECCIONAR COTIZACIÓN</h4>
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table class="table">
								<thead class="thead-dark">
									<tr>
										<th scope="col">Seleccionar</th>
										<th scope="col">Folio</th>
										<th scope="col">Monto</th>
										<th scope="col">Plan</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($prospecto->cotizaciones as $cotizacion)
									<tr>
										<th scope="row">
											<input name="cotizacion_id" type="radio" value="{{$cotizacion->id}}"
												required class="radioButtonCotizacion">
										</th>
										<td>{{$cotizacion->folio}}</td>
										<td>{{$cotizacion->monto}}</td>
										<td>{{$cotizacion->plan->nombre}}</td>
									</tr>

									<!-- Modal -->
									<div class="modal fade" id="modal-cotizacion-{{$cotizacion->id}}" tabindex="-1"
										role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
										<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" id="exampleModalLongTitle">
														Pago de inscripción
													</h5>
													<button type="button" class="close" data-dismiss="modal"
														aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body">
													<div class="row">
														<div class="col-12">
															@if (!$cotizacion->pago_inscripcions->count())
															<div class="alert alert-danger">
																La cotización aún no tiene ningún pago de
																inscripción. <br>
																<a class="btn btn-primary"
																	href="{{route('prospectos.cotizacions.pagos.create',['prospecto'=>$cotizacion->prospecto->id,'cotizacions'=>$cotizacion->id])}}">
																	Realizar pago
																</a>
															</div>
															@else
															<div class="alert alert-success">
																La cotización puede ser seleccionada ya que cuenta
																con un pago
																de inscripción. <br>
															</div>
															@endif
														</div>
													</div>
												</div>
												<div class="modal-footer">
													{{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
													{{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
												</div>
											</div>
										</div>
									</div>

									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="col-4"></div>
		</div>

</div>
<div class="card-footer">
	<div class="d-flex justify-content-center">
		<button class="btn btn-success" type="submit"><i class="fas fa-arrow-alt-circle-right"></i>
			Siguiente</button>
	</div>
</div>

</form>
</div>
@endsection
@push('scripts')
<script>
	$(document).on('click','.radioButtonCotizacion', function(){
		cotizacionId = $(this).val();
		// $(`#modal-cotizacion-${cotizacionId}`).show();
		console.log({
			message: 'Cotizacion seleccionada',
			cotizacionId,
			modal: `#modal-cotizacion-${cotizacionId}`
		});
		$(`#modal-cotizacion-${cotizacionId}`).modal('show');
	});

	$(document).ready(function() {
			getColonias();
		});
		function getAge(dateString) 
		{
		    var today = new Date();
		    var birthDate = new Date(dateString);
		    var age = today.getFullYear() - birthDate.getFullYear();
		    var m = today.getMonth() - birthDate.getMonth();
		    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) 
		    {
		        age--;
		    }
		    $("#edad").val(age);
		    return age;
		}
		$("#cp").change(function(){
			getColonias();
		});
		$("#colonia").change(function(){
			var cp = $("#cp").val();
			var colonia = $("#colonia").val();
			$.ajax({
				url: `{{ url('cp') }}/${cp}/${colonia}`,
				dataType: 'json',
				success:function(result,status,xhr){
					let res = result.cp[0];
					$("#municipio").val(res.municipio);
					$("#estado").val(res.estado);
				},
				error:function(xhr,status,error){
					// alert(error);
				}
			});
		});

		function getColonias() {
			var cp = $("#cp").val();
			$("#colonia").empty();
			$("#colonia").append("<option>Seleccione una colonía ó población</option>");
			$.ajax({
				url: `{{ url('cp') }}/${cp}`,
				dataType: 'json',
				success:function(result,status,xhr){
					console.log(result);
					let res_array = result.cp;
					res_array.forEach(function(item,index){
						var opt = `<option value="${item.poblacion}">${item.poblacion}</option>`
						$("#colonia").append(opt)
					});
					setColoniaDefault();
				},
				error:function(xhr,status,error){
					// alert(error);
				}
			});
		}

		function setColoniaDefault() {
			let colonia = '{{ $prospecto->perfil->colonia }}';
			$("#colonia").children().each(function(index, el) {
				if($(el).val() == colonia){
					$(el).attr("selected",true);
				}
			});

		}
</script>
@endpush
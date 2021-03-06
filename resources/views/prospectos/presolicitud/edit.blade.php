@extends('principal')
@section('content')
<div class="card">
	@include('prospectos.presolicitud.navs',['prospectos'=>$prospecto,'presolicitud'=>$presolicitud,'active'=>'Solicitante'])
	<form method="POST" action="{{ route('prospectos.presolicitud.update',['prospecto'=>$prospecto,
			'presolicitud'=>$presolicitud]) }}">
		@csrf

		@method('PUT')
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
									<input type="text" class="form-control" name="paterno" required=""
										value="{{old('appaterno') ?: $presolicitud->paterno}}">
								</div>
								<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
									<label for="">✱ Apellido Materno</label>
									<input type="text" class="form-control" name="materno" required=""
										value="{{old('apmaterno') ?: $presolicitud->materno}}">
								</div>
								<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
									<label for="">✱ Nombre(s)</label>
									<input type="text" class="form-control" name="nombre" required=""
										value="{{$presolicitud->nombre}}">
								</div>
								<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
									<label for="">✱ R.F.C.</label>
									<input type="text" class="form-control" value="{{$presolicitud->rfc}}"
										name="rfc" required="">
								</div>
								<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
									<label for="">✱ Fecha de Nacimiento</label>
									<input type="date" class="form-control" value="{{old('fecha_nacimiento') ?: $presolicitud->fecha_nacimiento}}"
										name="fecha_nacimiento"
										min="{{(integer)date('Y')-64}}-{{date('m')}}-{{date('d')}}"
										max="{{(integer)date('Y')-18}}-{{date('m')}}-{{date('d')}}" required=""
										onchange="getAge(this.value)">
								</div>
								{{--<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
									<label for="">✱ Edad</label>
									<input type="number" class="form-control" id="edad" value="{{old('edad')}}" min="0"
										max="64" required="" readonly>
								</div>
								 <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
									<label for="">✱ Lugar de Nacimiento</label>
									<input type="text" class="form-control" value="{{$presolicitud->lugar_nacimiento}}"
								name="lugar_nacimiento" required="">
							</div> --}}
							<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
								<label for="">✱ Nacionalidad</label>
								<input type="text" class="form-control"
									value="{{ $presolicitud->nacionalidad}}"
									name="nacionalidad" required="">
							</div>
							<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
								<label for="">✱ Sexo</label>
								<select class="form-control" name="sexo" required="">
									<option value="">Seleccione una opción</option>
									<option {{$presolicitud->sexo == "Masculino" ? 'selected' : ""}} value="Masculino">
										Masculino</option>
									<option {{$presolicitud->sexo == "Femenino" ? 'selected' : ""}} value="Femenino">
										Femenino</option>
								</select>
							</div>
							<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
								<label for="">✱ Estado Civil</label>
								<select class="form-control" name="estado_civil" required="">
									<option value="{{$presolicitud->estado_civil}}">
										{{$presolicitud->estado_civil}}
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
									value="{{$presolicitud->calle}}" name="calle">
							</div>
							<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
								<label for="">✱ Número Exterior</label>
								<input type="text" class="form-control" value="{{$presolicitud->numero_ext}}"
									name="numero_ext" required="">
							</div>
							<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
								<label for="">Número Interior</label>
								<input type="text" class="form-control" value="{{$presolicitud->numero_int}}"
									name="numero_int">
							</div>
							<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
								<label for="">✱ Código Postal</label>
								<input type="text" class="form-control" value="{{$presolicitud->cp}}" name="cp"
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
								<input type="text" class="form-control" value="{{$presolicitud->municipio}}"
									name="municipio" id="municipio" required="">
							</div>
							<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
								<label for="">✱ Estado</label>
								<input type="text" class="form-control" value="{{$presolicitud->estado}}"
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
								<input type="text" class="form-control" value="{{$presolicitud->tel_casa}}"
									name="tel_casa" required="">
							</div>
							<div class="col-sm-12 col-md-3 form-group">
								<label for="">Teléfono de Oficina</label>
								<input type="text" class="form-control" value="{{$presolicitud->tel_oficina}}"
									name="tel_oficina">
							</div>
							<div class="col-sm-12 col-md-3 form-group">
								<label for="">✱ Teléfono Celular</label>
								<input type="text" class="form-control" value="{{$presolicitud->tel_celular}}"
									name="tel_celular" required="">
							</div>
							<div class="col-sm-12 col-md-3 form-group">
								<label for="">✱ Correo Electrónico</label>
								<input type="email" class="form-control" value="{{$presolicitud->email}}"
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
									value="{{$presolicitud->profesion}}" name="profesion"
									required="">
							</div>
							<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
								<label for="">Empresa donde trabaja</label>
								<input type="text" class="form-control" value="{{$presolicitud->empresa}}"
									name="empresa">
							</div>
							<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
								<label for="">Puesto</label>
								<input type="text" class="form-control"
									value="{{$presolicitud->puesto}}"
									name="ocupacion_1">
							</div>
							<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
								<label for="">✱ Antigüedad trabajo actual</label>
								<input type="text" class="form-control" value="{{$presolicitud->antiguedad_actual}}"
									name="antiguedad_actual" required="">
							</div>
							<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
								<label for="">✱ Antigüedad trabajo anterior</label>
								<input type="text" class="form-control"
									value="{{$presolicitud->antiguedad_anterior}}"
									name="antiguedad_anterior" required="">
							</div>
							<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
								<label for="">✱ Ingreso Mensual Familiar</label>
								<input type="text" class="form-control" value="{{$presolicitud->ingreso_mensual}}"
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
						{{ $medioDeContacto->nombre ==$presolicitud->enterarse ? 'selected=""' : ''}}>
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
</div>
<div class="card-footer">
	<div class="d-flex justify-content-center">
		<button class="btn btn-success" type="submit"><i class="fas fa-arrow-alt-circle-right"></i>
			Guardar</button>
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
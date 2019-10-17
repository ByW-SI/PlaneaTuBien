@extends('principal')
@section('content')

@if ( session('status') )
	<div class="alert alert-danger">
		{{session('status')}}
	</div>
@endif

<div class="card card-default">
	<div class="card-header">
		<h3 class="title">
			Empleado
		</h3>
	</div>
	<form method="POST" action="{{$edit ? route('empleados.update',['empleado'=>$empleado]) : route('empleados.store') }}">
		@csrf
		@if ($edit)
			@method('PUT')
		@endif
		<div class="card-body">
			<div class="row row-group">
				<div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
					<label for="nombre">✱Nombre:</label>
					<input type="text" name="nombre" value="{{$empleado->nombre}}" class="form-control" required>
				</div>
				<div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
					<label for="paterno">✱Apellido Paterno:</label>
					<input type="text" name="paterno" value="{{$empleado->paterno}}" class="form-control" required>
				</div>
				<div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
					<label for="materno">✱Apellido Materno:</label>
					<input type="text" name="materno" value="{{$empleado->materno}}" class="form-control" required>
				</div>
				<div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
					<label for="fecha_nacimiento">✱Fecha de nacimiento:</label>
					<input type="date" name="fecha_nacimiento" id="fecha_nacimiento" value="{{$empleado->fecha_nacimiento}}" class="form-control" required>
				</div>
				<div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
					<label for="edad">Edad:</label>
					<input type="number" step="1" name="edad" id="edad" value="{{$empleado->edad}}" class="form-control" readonly="">
				</div>
				<div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
					<label for="sexo">Sexo:</label>
					<select class="form-control" name="sexo">
						<option value="" {{$empleado->sexo == "" ? "selected" : ""}}>Seleccione el sexo</option>
						<option value="Hombre" {{$empleado->sexo == "Hombre" ? "selected" : ""}}>Hombre</option>
						<option value="Mujer" {{$empleado->sexo == "Mujer" ? "selected" : ""}}>Mujer</option>
					</select>
				</div>
				<div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
					<label for="email">Correo electronico (interno):</label>
					<input type="text" name="email" value="{{$empleado->email}}" class="form-control">
				</div>
				<div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
					<label for="sucursal">Sucursal:</label>
					<select class="form-control" name="sucursal">
						<option value="" {{$empleado->sucursal_id == "" ? "selected" : ""}}>Seleccione la sucursal</option>
						@foreach ($sucursales as $sucursal)
							<option value="{{$sucursal->id}}" {{$empleado->sucursal_id == $sucursal->id ? "selected" : ""}} >{{$sucursal->nombre}}</option>
						@endforeach
					</select>
				</div>
			</div>
		</div>
		<div class="card-header">
			<h4 class="title">
				Datos Generales
			</h4>
		</div>
		<div class="card-body">
			<div class="row row-group">
				<div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
					<label for="rfc">✱R.F.C.:</label>
					<input class="form-control" type="text" name="rfc" pattern="^[A-Za-z]{4}[0-9]{6}[A-Za-z0-9]{3}" title="Siga el formato: 4 letras seguidas por 6 digitos y 3 caracteres" value="{{$empleado->rfc}}" required>
				</div>
				<div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
					<label for="telefono">Telefono:</label>
					<input class="form-control" type="text" name="telefono" pattern= "[0-9]{10}" title="Número telefonico de maximo 10 digitos" value="{{$empleado->telefono}}">
				</div>
				<div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
					<label for="movil">Telefono movil:</label>
					<input class="form-control" type="text" name="movil" pattern= "[0-9]{10}" title="Número telefonico de maximo 10 digitos" value="{{$empleado->movil}}">
				</div>
				<div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
					<label for="nss">Número de seguro social (NSS):</label>
					<input class="form-control" type="text" name="nss" value="{{$empleado->nss}}">
				</div>
				<div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
					<label for="curp">C.U.R.P.:</label>
					<input class="form-control" type="text" name="curp" value="{{$empleado->curp}}">
				</div>
				<div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
					<label for="infonavit">Número INFONAVIT:</label>
					<input class="form-control" type="text" name="infonavit" value="{{$empleado->infonavit}}">
				</div>
			</div>
		</div>
		<div class="card-header">
			<h4 class="title">
				Dirección
			</h4>
		</div>
		<div class="card-body">
			<div class="row row-group">
				<div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
					<label for="cp">Código Postal:</label>
					<input class="form-control" type="text" name="cp" id="cp" value="{{$empleado->cp}}">
				</div>
				<div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
					<label for="colonia">@if($edit)✱@endif Colonia:</label>
					<select class="form-control" name="colonia" id="colonia" @if($edit) required="" @endif></select>
					{{-- <input  type="text"  value="{{$empleado->colonia}}"> --}}
				</div>
				<div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
					<label for="municipio">Alcaldía o municipio:</label>
					<input class="form-control" type="text" name="municipio" id="municipio" value="{{$empleado->municipio}}" readonly="">
				</div>
				<div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
					<label for="estado">Estado o ciudad</label>
					<input class="form-control" type="text" name="estado" id="estado" value="{{$empleado->estado}}" readonly="">
				</div>
				<div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
					<label for="Calle">Calle:</label>
					<input class="form-control" type="text" name="calle" value="{{$empleado->calle}}">
				</div>
				<div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
					<label for="num_ext">Número exterior:</label>
					<input class="form-control" type="text" name="num_ext" value="{{$empleado->num_ext}}">
				</div>
				<div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
					<label for="num_int">Número interior:</label>
					<input class="form-control" type="text" name="num_int" value="{{$empleado->num_int}}">
				</div>
				<div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
					<label for="calles">Entre calles:</label>
					<input class="form-control" type="text" name="calles" value="{{$empleado->calles}}">
				</div>
				<div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
					<label for="referencia">Referencia adicional</label>
					<input class="form-control" type="text" name="referencia" value="{{$empleado->referencia}}">
				</div>
			</div>
		</div>
		<div class="card-footer">
			<div class="d-flex justify-content-center">
				<button type="submit" class="btn btn-success" id="basic-addon1">
					<i class="fas fa-save"></i>
					<strong> Guardar</strong>
				</button>
			</div>
		</div>
	</form>
</div>
@endsection
@push('scripts')
<script>
	$(document).ready(function() {
		let cp = $("#cp").val();
		if(cp != '' && cp.length === 5){
			$("#colonia").empty();
			getColonias(cp);
		}
	});
    $('#fecha_nacimiento').on('change', function(event) {
		$('#edad').val(getEdad($(this).val()));
	});

	$("#cp").change(function(){
		let cp = $("#cp").val();
		if(cp.length === 5){
			$("#colonia").empty();
			getColonias(cp);
		}
		
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
				$("#municipio").val('');
				$("#estado").val('');
			}
		});
	});

	function getEdad(fecha) {
		let fecha_nacimiento = fecha.split('-');
		fecha_nacimiento = new Date(fecha_nacimiento[0], fecha_nacimiento[1] -1, fecha_nacimiento[2]);
		let fecha_hoy = new Date();
		let edad = fecha_hoy.getFullYear() - fecha_nacimiento.getFullYear();
		let mes = fecha_hoy.getMonth() - fecha_nacimiento.getMonth();
		if (mes < 0 || ( mes == 0 && fecha_hoy.getDate() < fecha_nacimiento.getDate()))
			edad--;
		return edad;
	}

	function getColonias(cp) {
		let opt = '';
		$.ajax({
			url: `{{ url('cp') }}/${cp}`,
			dataType: 'json',
			success:function(result,status,xhr){
				console.log(result);
				let res_array = result.cp;
				res_array.forEach(function(item,index){
					opt += `<option value="${item.poblacion}">${item.poblacion}</option>`
				});
				$("#colonia").append("<option value=''>Seleccione una colonia ó población</option>");
				$("#colonia").append(opt);
			},
			error:function(xhr,status,error){
				alert(error);
				$("#colonia").empty();
				$("#municipio").val('');
				$("#estado").val('');
			}
		});
	}
</script>
@endpush
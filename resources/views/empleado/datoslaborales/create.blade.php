@extends('empleado.show')
@section('submodulos')
<div class="row">
    <div class="col-sm-12">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link " href="{{ route('empleados.show', ['empleado' => $empleado]) }}">Datos generales</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('empleados.laborals.index', ['empleado' => $empleado]) }}">Laborales</a>
            </li>
            @if($empleado->tipo != "Asesor")
            <li class="nav-item">
                <a class="nav-link" href="{{ route('empleados.relaciones.index', ['empleado' => $empleado]) }}">Empleados</a>
            </li>
            @endif
            <li class="nav-item">
                <a class="nav-link" href="{{ route('empleados.vacacions.index' , ['empleado' => $empleado]) }}">Vacaciones</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('empleados.beneficiario.index' , ['empleado' => $empleado]) }}">Beneficiario</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('empleados.permisos.index' , ['empleado' => $empleado]) }}">Permisos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('empleados.faltas.index' , ['empleado' => $empleado]) }}">Faltas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('empleados.estudios.index' , ['empleado' => $empleado]) }}">Estudios</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('empleados.emergencias.index' , ['empleado' => $empleado]) }}">Emergencias</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('empleados.disciplinas.index' , ['empleado' => $empleado]) }}">Falta Administrativa</a>
            </li>
        </ul>
    </div>
</div>
<div class="card card-default">
	<form role="form" method="POST" action="{{ route('empleados.laborals.store',['empleado'=>$empleado]) }}">
	{{ csrf_field() }}
	<div class="card-header">
		<h4 class="title">Datos Laborales</h4>
	</div>
	<div class="card-body">
		<div class="row row-group">
			<input type="hidden" name="empleado_id" value="{{$empleado->id}}">
			<div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
                <label class="control-label" for="fecha_contrato"><i class="fa fa-asterisk" aria-hidden="true"></i>Fecha de contratación:</label>
				<input class="form-control" type="date" id="fecha_contrato" name="fecha_contrato" required value="{{!$empleado->datos_laborales()->first() ? : $empleado->datos_laborales()->first()->fecha_contrato }}" {{ !$empleado->datos_laborales()->first() ? : !$empleado->datos_laborales()->first()->fecha_contrato ? : 'readonly'}}>
            </div>
			<div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
                <label class="control-label" for="contrato_id"><i class="fas fa-sync"></i> Tipo de contrato:</label>
				<select type="select" class="form-control" name="contrato_id" id="contrato_id" >
					<option  value="">Sin Definir</option>
					@foreach ($contratos as $contrato)
						<option id="{{$contrato->id}}" value="{{$contrato->id}}">{{$contrato->nombre}}</option>
					@endforeach
				</select>
            </div>
			{{-- <div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
				<label for="cargo">✱Cargo:</label>
                    <select required class="form-control" id="cargo" name="cargo">
                        <option value="" {{$empleado->cargo == "" ? "selected" : ""}}>
                    		Seleccionar
                    	</option>
                        <option value="Asesor" {{$empleado->cargo == "Asesor" ? "selected" : ""}}>
                    		Asesor
                    	</option>
                        <option value="Supervisor" {{$empleado->cargo == "Supervisor" ? "selected" : ""}}>
                    		Supervisor
                    	</option>
                        <option value="Gerente" {{$empleado->cargo == "Gerente" ? "selected" : ""}}>
                    		Gerente
                    	</option>
                        <option value="Mesa de trabajo" {{$empleado->cargo == "Mesa de trabajo" ? "selected" : ""}}>
                    		Mesa de trabajo
                    	</option>
                        <option value="Ejecutivo de cuenta" {{$empleado->cargo == "Ejecutivo de cuenta" ? "selected" : ""}}>
                    		Ejecutivo de cuenta
                    	</option>
                        <option value="Juridico" {{$empleado->cargo == "Juridico" ? "selected" : ""}}>
                    		Jurídico
                    	</option>
                        <option value="Contador" {{$empleado->cargo == "Contador" ? "selected" : ""}}>
                    		Contador
                    	</option>
                        <option value="Gerente de area" {{$empleado->cargo == "Gerente de area" ? "selected" : ""}}>
                    		Gerente de área
                    	</option>
                        <option value="Director de area" {{$empleado->cargo == "Director de area" ? "selected" : ""}}>
                    		Director de área
                    	</option>
                    </select>
            </div> --}}
			<div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
                <label class="control-label" for="tipo"><i class="fas fa-sync"></i> Puesto:</label>
				<select required class="form-control" id="tipo" name="tipo">
                        <option value="" {{$empleado->tipo == "" ? "selected" : ""}}>
                        	Seleccionar
                    	</option>
                        <option value="Asesor" {{$empleado->tipo == "Asesor" ? "selected" : ""}}>
                        	Asesor
                    	</option>
                        <option value="Supervisor" {{$empleado->tipo == "Supervisor" ? "selected" : ""}}>
                        	Supervisor
                    	</option>
                        <option value="Gerente" {{$empleado->tipo == "Gerente" ? "selected" : ""}}>
                        	Gerente
                    	</option>
                        <option value="TKM" {{$empleado->tipo == "TKM" ? "selected" : ""}}>
                        	TKM
                    	</option>
                        <option value="Becario" {{$empleado->tipo == "Becario" ? "selected" : ""}}>
                        	Becario
                    	</option>
                        <option value="Mesa de control" {{$empleado->tipo == "Mesa de control" ? "selected" : ""}}>
                        	Mesa de control
                    	</option>
                        <option value="Ejecutivo de cuenta" {{$empleado->tipo == "Ejecutivo de cuenta" ? "selected" : ""}}>
                        	Ejecutivo de cuenta
                    	</option>
                        <option value="Juridico" {{$empleado->tipo == "Juridico" ? "selected" : ""}}>
                        	Jurídico
                    	</option>
                        <option value="Contador" {{$empleado->tipo == "Contador" ? "selected" : ""}}>
                        	Contador
                    	</option>
                        <option value="Jefe atención a clientes" {{$empleado->tipo == "Jefe atención a clientes" ? "selected" : ""}}>
                        	Jefe de atención a clientes
                    	</option>
                        <option value="Jefe archivo" {{$empleado->tipo == "Jefe archivo" ? "selected" : ""}}>
                        	Jefe de archivo
                    	</option>
                        <option value="Jefe ventas" {{$empleado->tipo == "Jefe ventas" ? "selected" : ""}}>
                        	Jefe de ventas
                    	</option>
                        <option value="Jefe jurídico" {{$empleado->tipo == "Jefe jurídico" ? "selected" : ""}}>
                        	Jefe de jurídico
                    	</option>
                        <option value="Jefe contabilidad" {{$empleado->tipo == "Jefe contabilidad" ? "selected" : ""}}>
                        	Jefe de contabilidad
                    	</option>
                        <option value="Directivo" {{$empleado->tipo == "Directivo" ? "selected" : ""}}>
                        	Directivo
                    	</option>
                        <option value="Administrador" {{$empleado->tipo == "Administrador" ? "selected" : ""}}>
                        	Administrador
                    	</option>
                    </select>
            </div>
			<div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
                <label class="control-label" for="lugar_trabajo">Lugar de Trabajo:</label>
				<select type="select" name="lugar_trabajo" class="form-control" id="lugar_trabajo" value="">
					<option id="1" value="Oficinas">Oficinas</option>
					<option id="2" value="Campo">Campo</option>
				</select>
            </div>
			<div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
                <label class="control-label" for="salario_nomina"><i class="fa fa-asterisk" aria-hidden="true"></i>Salario Nóminal:</label>
				<input class="form-control" type="text" id="salario_nomina" name="salario_nomina" value="" required>
            </div>
            <div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
                <label class="control-label" for="salario_dia">Salario Diario:</label>
				<input class="form-control" type="text" id="salario_dia" name="salario_dia" value="">
            </div>
            <div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
                <label class="control-label" for="periodo_paga">Periodicidad de Pago:</label>
				<select type="select" class="form-control" name="periodo_paga" id="periodo_paga">
					<option id="1" value="Semanal">Semanal</option>
					<option id="2" value="Quincenal">Quincenal</option>
					<option id="3" value="Mensual">Mensual</option>
				</select>
            </div>
            <div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
                <label class="control-label" for="prestaciones">Prestaciones:</label>
				<select class="form-control" type="select" name="prestaciones" id="prestaciones">
					<option id="1" value="De Ley">De Ley</option>
				</select>
            </div>
            <div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
                <label class="control-label" for="regimen">Régimen de Contratación:</label>
				<select class="form-control" type="select" name="regimen" id="regimen">
					<option id="1" value="Sueldos y Salarios">Sueldos y Salarios</option>
					<option id="2" value="Jubilados">Jubilados</option>
					<option id="3" value="Pensionados">Pensionados</option>
				</select>
            </div>
            <div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
                <label class="control-label" for="hora_entrada">Hora de Entrada:</label>
				<input class="form-control" type="time" id="hora_entrada" name="hora_entrada" value="">
            </div>
            <div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
                <label class="control-label" for="hora_salida">Hora de Salida:</label>
				<input class="form-control" type="time" id="hora_salida" name="hora_salida" value="">
            </div>
            <div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
                <label class="control-label" for="hcomida">Hora de Comida:</label>
				<input class="form-control" type="time" name="hora_comida" id="hora_comida" value="">
            </div>
            <div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
                <label class="control-label" for="banco"><i class="fas fa-sync"></i> Banco:</label>
				<select class="form-control" type="select" name="banco" id="banco">
					<option value="">Sin Definir</option>
					@foreach ($bancos as $banco)
						<option id="{{$banco->nombre}}" value="{{$banco->nombre}}">{{$banco->nombre}}</option>
					@endforeach
				</select>
            </div>
            <div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
                <label class="control-label" for="cuenta">Cuenta:</label>
				<input class="form-control" type="text" id="cuenta" name="cuenta" value="">
            </div>
            <div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
                <label class="control-label" for="clabe">CLABE:</label>
				<input class="form-control" type="clabe" name="clabe" id="clabe" value="">
            </div>
		</div>
	</div>
	<div class="card-header">
		<h4 class="title">Datos de Baja</h4>
	</div>
	<div class="card-body">
		<div class="row row-group">
			<div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
	            <label class="control-label" for="fecha_baja">Fecha de la baja:</label>
				<input class="form-control" type="date" id="fecha_baja" name="fecha_baja" value="">
	        </div>
	        <div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
	            <label class="control-label" for="baja_id">Tipo de Baja:</label>
				<select class="form-control" type="select" name="baja_id" id="baja_id">
					<option id="0" value="">No hay baja</option>
					@foreach ($bajas as $baja)
						<option id="{{$baja->id}}" value="{{$baja->id}}">{{ $baja->nombre }}</option>
					@endforeach
				</select>
	        </div>
	        <div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
	            <label class="control-label" for="comentario_baja">Comentarios:</label>
				<textarea class="form-control" id="comentario_baja" name="comentario_baja" maxlength="500"></textarea>
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

<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script type="text/javascript">
	function getAreas()
	{
	  $.ajaxSetup({
	    headers: {
	      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    }
	  });
	  $.ajax({
	    url: "{{ url('/getareas') }}",
	    type: "GET",
	    dataType: "html",
	  }).done(function(resultado){
	    $("#area_id").html(resultado);
	  });
	}
	function getContratos(){
		$.ajaxSetup({
	    headers: {
	      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    }
		});
		$.ajax({
			url: "{{ url('/getcontratos') }}",
		    type: "GET",
		    dataType: "html",
		}).done(function(resultado){
		    $("#contrato_id").html(resultado);
		});
	}
	function getPuestos(){
		$.ajaxSetup({
	    headers: {
	      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    }
		});
		$.ajax({
			url: "{{ url('/getpuestos') }}",
		    type: "GET",
		    dataType: "html",
		}).done(function(resultado){
		    $("#puesto_id").html(resultado);
		});
	}
	function getBajas(){
		$.ajaxSetup({
	    headers: {
	      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    }
		});
		$.ajax({
			url: "{{ url('/getbajas') }}",
		    type: "GET",
		    dataType: "html",
		}).done(function(resultado){
		    $("#tipobaja_id").html(resultado);
		});
	}
	function getBancos(){
		$.ajaxSetup({
	    headers: {
	      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    }
		});
		$.ajax({
			url: "{{ url('/getbancos') }}",
		    type: "GET",
		    dataType: "html",
		}).done(function(resultado){
		    $("#banco").html(resultado);
		});
	}

</script>
@endsection
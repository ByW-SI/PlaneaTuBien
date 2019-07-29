@extends('empleado.show')
@section('submodulos')
	{{-- NAV --}}
<div class="row">
    <div class="col-sm-12">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link " href="{{ route('empleados.show', ['empleado' => $empleado]) }}">Datos generales</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('empleados.laborals.index', ['empleado' => $empleado]) }}">Laborales</a>
            </li>
            @if($empleado->tipo != "Asesor")
            <li class="nav-item">
                <a class="nav-link" href="{{ route('empleados.relaciones.index', ['empleado' => $empleado]) }}">Empleados</a>
            </li>
            @endif
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('empleados.vacacions.index' , ['empleado' => $empleado]) }}">Vacaciones</a>
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
	<div class="card">
		<div class="card-header">
			<h4>Vacaciones:</h4>
		</div>
		@if ($diastotales == 0)
			{{-- expr --}}
			<div class="card-body">
				<h4>Todavía no cumple un año en la institución</h4>
			</div>
		@else
			<div class="card-body">
				@if ($diastotales > $diasdisfrutados)
					{{-- expr --}}
					<form method="POST" action="{{ route('empleados.vacacions.store',['empleado'=>$empleado]) }}">
						@csrf
						<div class="row form-group">
							<div class="col-3 offset-1">
								<label class="control-label" for="contratacion" id="lbl_vacaciones">Fecha de contratación:</label>
								<input type="date" class="form-control disabled" id="contratacion" readonly="" name="contratacion" value="{{$empleado->datos_laborales->first()->fecha_contrato}}">
							</div>
							<div class="col-3">
								<label class="control-label" for="diastotales" id="lbl_vacaciones">Antigüedad:</label>
								<div class="input-group mb-3">
								  <input type="number" class="form-control" id="diastotales" readonly="" name="diastotales" value="{{$antiguedad}}">
								  <div class="input-group-append">
								    <span class="input-group-text" id="basic-addon2">años</span>
								  </div>
								</div>
							</div>
							<div class="col-3">
								<label class="control-label" for="contratacion" id="lbl_vacaciones">Días totales de vacaciones:</label>
								<input type="number" class="form-control disabled" id="contratacion" readonly="" name="contratacion" value="{{$diastotales}}">
							</div>
						</div>
						<div class="row form-group">
							<div class="col-3 offset-1">
								<label class="control-label" for="fechainicio" id="lbl_vacaciones">Fecha de Inicio:</label>
								<input type="date" class="form-control" id="fechainicio" name="fecha_inicio" min="{{date('Y-m-d')}}">
							</div>
							<div class="col-3">
								<label class="control-label" for="fechafin" id="lbl_vacaciones">Fecha de Fin:</label>
								<input type="date" class="form-control" id="fechafin" name="fecha_fin">
							</div>
							<div class="col-3">
								<label class="control-label" for="diastomados">Número de días de vacaciones:</label>
		    					<input type="text" class="form-control" id="dias_a_disfrutar" step="1" min="1" name="dias_tomados">
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12 text-center">
								<button type="submit" class="btn btn-success">
								 	<strong>Guardar</strong>
								</button>
							</div>
						</div>
					</form>
				@else 
					<div class="container">
						<h5>Vacaciones tomadas</h5>
					</div>
				@endif
				<div class="container form-group mt-3">
					<table class="table table-striped table-bordered table-hover">
						<thead>
							<tr class="table-info">
								<th>Fecha</th>
								<th>Fecha de inicio</th>
								<th>Fecha de termino</th>
								<th>Días a disfrutar</th>
								<th>Días restantes</th>
							</tr>
						</thead>
						@foreach ($vacaciones as $vacacion)
							{{-- expr --}}
							<tr class="active">
								<td>{{$vacacion->created_at->toDateString()}}</td>
								<td>{{$vacacion->fecha_inicio}}</td>
								<td>{{$vacacion->fecha_fin}}</td>
								<td>{{$vacacion->dias_tomados}}</td>
								<td>{{$diastotales-$diasdisfrutados}}</td>
							</tr>
						@endforeach
					</table>
				</div>
			</div>
		
		@endif
	</div>
@endsection
@section('script')
	{{-- expr --}}
	<script type="text/javascript">
		$('#fechainicio').change(function(e){
			console.log($("#fechainicio").val());
			$("#fechafin").attr('min',$('#fechainicio').val());	
			var fin = new Date($('#fechainicio').val());
			fin.setDate(fin.getDate()+{{$diastotales-$diasdisfrutados}});
			console.log(fin.toISOString().slice(0,10));
			$("#fechafin").attr('max',fin.toISOString().slice(0,10));
		})
	</script>
@endsection
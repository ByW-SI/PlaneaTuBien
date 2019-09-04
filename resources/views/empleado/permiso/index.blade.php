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
                <a class="nav-link" href="{{ route('empleados.vacacions.index' , ['empleado' => $empleado]) }}">Vacaciones</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('empleados.beneficiario.index' , ['empleado' => $empleado]) }}">Beneficiario</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('empleados.permisos.index' , ['empleado' => $empleado]) }}">Permisos</a>
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
			<h4>Permisos:</h4>
		</div>
		<div class="card-body">
			<form role="form" method="POST" action="{{ route('empleados.permisos.store',['empleado'=>$empleado]) }}">
				@csrf
				<div class="row form-group">
					<div class="col-3 offset-2">
						<label for="tipopermiso" class="control-label">Tipo de permiso</label>
						<select id="tipopermiso" name="tipopermiso" class="form-control" required="">
							<option value="">Seleccione el tipo de permiso a otorgar</option>
							<option value="dia">Por día</option>
							<option value="hora">Por hora</option>
						</select>
					</div>
					<div class="col-3">
						<label for="permiso" class="control-label">Permiso</label>
						<select id="permiso" name="permiso" class="form-control" required>
							<option value="">Permiso a otorgar</option>
							<option value="con_sueldo">Con goce de sueldo</option>
							<option value="sin_sueldo">Sin goce de sueldo</option>

							<option value="tiempo">Tiempo por tiempo</option>
						</select>
					</div>
					<div class="col-3">
						<label for="fecha" class="control-label">Fecha del permiso</label>
						<input type="date" name="fecha" class="form-control" id="fecha">
					</div>
				</div>
				<div class="row form-group d-none" id="dia">
					<div class="col-3 offset-2">
						<label for="fechainicio" class="control-label">Fecha de inicio</label>
						<input type="date" name="fechainicio" class="form-control" id="fechainicio">
					</div>
					<div class="col-3">
						<label for="fechafin" class="control-label">Fecha de termino</label>
						<input type="date" name="fechafin" class="form-control" id="fechafin">
					</div>
					<div class="col-3">
						<label for="diastotales" class="control-label">Días solicitados</label>
						<input type="number" step="1" min="0" name="diastotales" class="form-control" id="diastotales">
					</div>
				</div>
				<div class="row form-group d-none" id="hora">
					<div class="col-3 offset-2">
						<label for="horainicio" class="control-label">Hora de inicio</label>
						<input type="time" name="horainicio" class="form-control" id="horainicio">
					</div>
					<div class="col-3">
						<label for="horafin" class="control-label">Hora de termino</label>
						<input type="time" name="horafin" class="form-control" id="horafin">
					</div>
					<div class="col-3">
						<label for="horastotales" class="control-label">Horas solicitadas</label>
						<input type="number" step="0.5" min="0" name="horastotales" class="form-control" id="horastotales">
					</div>
				</div>
				<div class="row form-group">
					<div class="col-5 text-center offset-4">
						<label for="motivo" class="control-label">Especificar motivo:</label>
						<textarea name="motivo" id="motivo" class="form-control" maxlength="50"></textarea>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-12 text-center">
						<button type="submit" class="btn btn-success">
						 	<strong>Guardar</strong>
						</button>
					</div>
				</div>
			</form>
			<div class="container">
				<table class="table table-striped table-bordered table-hover">
					<thead>
						<tr class="table-info">
							<th scope="col">Tipo de permiso</th>
							<th scope="col">Permiso otorgado</th>
							<th scope="col">Fecha</th>
							<th scope="col">Inicio</th>
							<th scope="col">Fin</th>
							<th scope="col">Total</th>
							<th scope="col">Motivo</th>
						</tr>
					</thead>
					<tbody>
						@forelse ($permisos as $permiso)
							{{-- expr --}}
							<tr>
								<td>{{$permiso->tipo}}</td>
								<td>{{$permiso->perm}}</td>
								<td>{{$permiso->fecha}}</td>
								<td>{{$permiso->inicio}}</td>
								<td>{{$permiso->final}}</td>
								<td>{{$permiso->total}}</td>
								<td>{{$permiso->motivo}}</td>
							</tr>
						@empty
							<div class="alert alert-danger" role="alert">
								El empleado {{$empleado->nombre." ".$empleado->appaterno." ".$empleado->apmaterno}} no tiene registros de permisos
							</div>
						@endforelse
					</tbody>
				</table>
			</div>
		</div>
	</div>
@endsection
	<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
	<script type="text/javascript">
		$(document).ready(function($) {
			$("#tipopermiso").change(function(){
				let tipo = $("#tipopermiso").val();
				console.log(tipo);
				if (tipo == '') {
					console.log('ninguno')
					$("#dia").addClass('d-none');
					$("#hora").addClass('d-none');
				}
				else {
					if (tipo == 'dia') {
						console.log('dia')
						$("#dia").removeClass('d-none');
						$("#hora").addClass('d-none');
						document.getElementById("fechainicio").required = true;
						document.getElementById("fechafin").required = true;
						document.getElementById("diastotales").required = true;
						document.getElementById("horainicio").required = false;
						document.getElementById("horafin").required = false;
						document.getElementById("horastotales").required = false;
						
					}
					if(tipo == 'hora'){
						console.log('hora')
						$("#hora").removeClass('d-none');
						$("#dia").addClass('d-none');

						document.getElementById("horainicio").required = true;
						document.getElementById("horafin").required = true;
						document.getElementById("horastotales").required = true;
						document.getElementById("fechainicio").required = false;
						document.getElementById("fechafin").required = false;
						document.getElementById("diastotales").required = false;
					} 
				}
			});
		});
	</script>

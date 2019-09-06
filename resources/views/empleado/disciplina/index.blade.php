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
                <a class="nav-link active" href="{{ route('empleados.disciplinas.index' , ['empleado' => $empleado]) }}">Falta Administrativa</a>
            </li>
        </ul>
    </div>
</div>
	<div class="card">
		<div class="card-header">
			<h4>Reportes de disciplina:</h4>
		</div>
		<div class="card-body">
			<form role="form" method="POST" action="{{ route('empleados.disciplinas.store',['empleado'=>$empleado]) }}">
				@csrf
				<div class="row form-group">
					<div class="col-4">
						<label for="fecha" class="control-label">Fecha de Reporte de Disciplina</label>
						<input type="date" name="fecha" id="fecha" class="form-control" required="">
					</div>
					<div class="col-4">
						<label for="tipoindisciplina" class="control-label">Tipo de amonestación</label>
						<select name="tipofalta" id="tipoindisciplina" class="form-control" required="">
							<option value="">Seleccione la amonestación que cometio el empleado</option>
							<option value="amonestacion_verb">Amonestación verbal</option>
							<option value="amonestacion_escr">Amonestación escrita</option>
							<option value="suspension">Suspensión de labores</option>
							<option value="rescicion">Rescición de contrato</option>
						</select>
					</div>
					<div class="col-4">
						<label for="motivo" class="control-label">Especifique el motivo</label>
						<textarea class="form-control" id="problema" name="problema" maxlength="50" required></textarea>
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
							<th>Fecha del reporte</th>
							<th>Tipo de disciplina</th>
							<th>Motivo</th>
						</tr>
					</thead>
					<tbody>
						@forelse ($disciplinas as $disciplina)
							<tr>
								<td>{{$disciplina->fecha}}</td>
								<td>{{$disciplina->tipofalta}}</td>
								<td>{{$disciplina->problema}}</td>
							</tr>
						@empty
							<div class="alert alert-danger" role="alert">
								El empleado {{$empleado->nombre." ".$empleado->appaterno." ".$empleado->apmaterno}} no tiene registros de altercados
							</div>
						@endforelse
					</tbody>
				</table>
			</div>
		</div>
	</div>
@endsection
@section('script')

@endsection
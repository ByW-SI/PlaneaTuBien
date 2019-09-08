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
                <a class="nav-link active" href="{{ route('empleados.faltas.index' , ['empleado' => $empleado]) }}">Faltas</a>
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
			<h4>Faltas Laborales:</h4>
		</div>
		<div class="card-body">
			<form role="form" method="POST" action="{{ route('empleados.faltas.store',['empleado'=>$empleado]) }}">
				@csrf
				<div class="row form-group">
					<div class="col-3">
						<label class="control-label" for="fecha" id="lbl_fecha">Fecha de la falta:</label>
						<input type="date" class="form-control" id="id_fecha" name="fecha" required>
					</div>
					<div class="col-3">
						<label class="control-label" for="problema" id="lbl_problema">Tipo de falta:</label>
						<select id="tipofalta" name="tipofalta" class="form-control" required="">
							<option value="">Seleccione el tipo de falta</option>
							<option value="retardo justificado">Retardo justificado</option>
							<option value="retardo injustificado">Retardo injustificado</option>
							<option value="falta justificada">Falta justificada</option>
							<option value="falta injustificada">Falta injustificada</option>
						</select>
					</div>
					<div class="col-5">
						<label class="control-label" for="motivo" id="lbl_comen">Especificar el motivo de la falta:</label>
						<textarea class="form-control" id="id_coment" name="motivo" maxlength="500"></textarea>
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
							<th scope="col">Fecha</th>
							<th scope="col">Tipo de falta</th>
							<th scope="col-2" colspan="2">motivo</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($faltas as $falta)
							<tr>
								<td>{{$falta->fecha}}</td>
								<td>{{$falta->tipofalta}}</td>
								<td colspan="2">{{$falta->motivo}}</td>
							</tr>
						@endforeach
					</tbody>
				</table>
				<div class="row">
					<div class="col-12 col-md-3">
						<div class="form-group">
							<label for=""><strong>Retardos justificados</strong></label>
							<input type="text" value="{{count($faltas->where('tipofalta','retardo justificado'))}}" class="form-control" readonly>
						</div>
					</div>
					<div class="col-12 col-md-3">
						<div class="form-group">
							<label for=""><strong>Retardos injustificados</strong></label>
							<input type="text" value="{{count($faltas->where('tipofalta','retardo injustificado'))}}" class="form-control" readonly>
						</div>
					</div>
					<div class="col-12 col-md-3">
						<div class="form-group">
							<label for=""><strong>Falta justificada</strong></label>
							<input type="text" value="{{count($faltas->where('tipofalta','falta justificada'))}}" class="form-control" readonly>
						</div>
					</div>
					<div class="col-12 col-md-3">
						<div class="form-group">
							<label for=""><strong>Falta insjustificada</strong></label>
							<input type="text" value="{{count($faltas->where('tipofalta','falta injustificada'))}}" class="form-control" readonly>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
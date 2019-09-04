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
                <a class="nav-link active" href="{{ route('empleados.beneficiario.index' , ['empleado' => $empleado]) }}">Beneficiario</a>
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
<div>
	<div class="card">
		<div class="card-header">
			<h4>Beneficiario</h4>
		</div>
		<div class="card-body">
			<div class="row">
				<div class="form-group col-3">
					<label class="control-label">
						Nombre:
					</label>
					<strong><dd>{{$beneficiario->nombre}}</dd></strong>
				</div>
				<div class="form-group col-3">
					<label class="control-label">
						Apellido Paterno:
					</label>
					<strong><dd>{{$beneficiario->appaterno}}</dd></strong>
				</div>
				<div class="form-group col-3">
					<label class="control-label">
						Apellido Materno:
					</label>
					<strong><dd>{{$beneficiario->apmaterno}}</dd></strong>
				</div>
				<div class="form-group col-3">
					<label class="control-label">
						Parentesco:
					</label>
					<strong><dd>{{$beneficiario->parentesco}}</dd></strong>
				</div>
				<div class="form-group col-3">
					<label class="control-label">
						RFC:
					</label>
					<strong><dd>{{$beneficiario->rfc}}</dd></strong>
				</div>
				<div class="form-group col-3">
					<label class="control-label">
						Calle:
					</label>
					<strong><dd>{{$beneficiario->calle}}</dd></strong>
				</div>
				<div class="form-group col-3">
					<label class="control-label">
						Número exterior:
					</label>
					<strong><dd>{{$beneficiario->num_ext}}</dd></strong>
				</div>
				<div class="form-group col-3">
					<label class="control-label">
						Número interior:
					</label>
					<strong><dd>{{$beneficiario->num_int}}</dd></strong>
				</div>
				<div class="form-group col-3">
					<label class="control-label">
						Colonia:
					</label>
					<strong><dd>{{$beneficiario->colonia}}</dd></strong>
				</div>
				<div class="form-group col-3">
					<label class="control-label">
						Alcaldía o municipio:
					</label>
					<strong><dd>{{$beneficiario->municipio}}</dd></strong>
				</div>
				<div class="form-group col-3">
					<label class="control-label">
						Estado:
					</label>
					<strong><dd>{{$beneficiario->estado}}</dd></strong>
				</div>
				<div class="form-group col-3">
					<label class="control-label">
						Telefono:
					</label>
					<strong><dd>{{$beneficiario->telefono}}</dd></strong>
				</div>
				<div class="form-group col-3">
					<label class="control-label">
						Unidad medica
					</label>
					<strong><dd>{{$beneficiario->unidad_medica}}</dd></strong>
				</div>
				<div class="form-group col-3">
					<label class="control-label">
						Turno
					</label>
					<strong><dd>{{$beneficiario->turno_atencion}}</dd></strong>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12 text-center">
					<a href="{{ route('empleados.beneficiario.edit',['empleado'=>$empleado,'beneficiario'=>$beneficiario]) }}" class="btn btn-success">
					 	<strong>Editar</strong>
					</a>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
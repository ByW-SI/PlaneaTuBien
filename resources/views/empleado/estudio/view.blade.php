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
                <a class="nav-link active" href="{{ route('empleados.estudios.index' , ['empleado' => $empleado]) }}">Estudios</a>
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
			<h4>Estudios:</h4>
		</div>
		<div class="card-body">
			<div class="row form-group">
				<div class="col-3">
					<label class="control-label" for="escolaridad1" id="lbl_escolaridad1">Escolaridad 1:</label>
					<strong><dd>{{$estudio->escolaridad1}}</dd></strong>
				</div>
				<div class="col-3">
					<label class="control-label" for="institucion1" id="lbl_inst1">Institución:</label>
					<strong><dd>{{ $estudio->institucion1 }}</dd></strong>
				</div>
				<div class="col-3">
					<label class="control-label" for="cedula1" id="lbl_cedula">Número de Cédula:</label>
					<strong><dd>{{ $estudio->cedula1 }}</dd></strong>
				</div>
				<div class="col-3">
					<label class="control-label" for="escolaridad2" id="lbl_escolaridad2">Escolaridad 2:</label>
					<strong><dd>{{$estudio->escolaridad2}}</dd></strong>
				</div>
			</div>
			<div class="row form-group">
				<div class="col-3">
					<label class="control-label" for="institucion2" id="lbl_inst2">Institución:</label>
					<strong><dd>{{ $estudio->institucion2 }}</dd></strong>
				</div>
				<div class="col-3">
					<label class="control-label" for="cedula2" id="lbl_cedula">Número de Cédula:</label>
					<strong><dd>{{ $estudio->cedula2 }}</dd></strong>
				</div>
				<div class="col-3">
					<label class="control-label" for="idioma1" id="lbl_idioma">Idioma 1:</label>
					<strong><dd>{{$estudio->idioma1}}</dd></strong>
				</div>
				<div class="col-3">
					<label class="control-label" for="nivel1" id="lbl_nivel">Nivel:</label>
					<strong><dd>{{$estudio->nivel1}}</dd></strong>
				</div>
			</div>
			<div class="row form-group">
				<div class="col-3">
					<label class="control-label" for="idioma2" id="lbl_idioma">Idioma 2:</label>
					<strong><dd>{{$estudio->idioma2}}</dd></strong>
				</div>
				<div class="col-3">
					<label class="control-label" for="nivel2" id="lbl_nivel">Nivel:</label>
					<strong><dd>{{$estudio->nivel2}}</dd></strong>
				</div>
				<div class="col-3">
					<label class="control-label" for="idioma3" id="lbl_idioma">Idioma 3:</label>
					<strong><dd>{{$estudio->idioma3}}</dd></strong>
				</div>
				<div class="col-3">
					<label class="control-label" for="nivel3" id="lbl_nivel">Nivel:</label>
					<strong><dd>{{$estudio->nivel3}}</dd></strong>
				</div>
			</div>
			<div class="row form-group">
				<div class="col-3">
					<label class="control-label" for="curso1" id="lbl_curso">Curso 1:</label>
					<strong><dd>{{ $estudio->curso1 }}</dd></strong>
					<label class="control-label">¿Certificación?</label>
					<strong><dd>{{$estudio->certificado1 ? "SI" : "NO"}}</dd></strong>
				</div>
				<div class="col-3">
					<label class="control-label" for="curso1" id="lbl_curso">Curso 2:</label>
					<strong><dd>{{ $estudio->curso2 }}</dd></strong>
					<label class="control-label">¿Certificación?</label>
					<strong><dd>{{$estudio->certificado2 ? "SI" : "NO"}}</dd></strong>
				</div>
				<div class="col-3">
					<label class="control-label" for="curso1" id="lbl_curso">Curso 3:</label>
					<strong><dd>{{ $estudio->curso3 }}</dd></strong>
					<label class="control-label">¿Certificación?</label>
					<strong><dd>{{$estudio->certificado3 ? "SI" : "NO"}}</dd></strong>
				</div>
			</div>
			<div class="d-flex justify-content-center">
				<div class="offset-2 col-4">
					<a class="btn btn-warning btn-md" href="{{ route('empleados.estudios.edit',['empleado'=>$empleado,'estudio'=>$estudio]) }}">
						<strong>Editar</strong>
					</a>
				</div>
			</div>
		</div>
	</div>
@endsection
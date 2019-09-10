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
                <a class="nav-link active" href="{{ route('empleados.emergencias.index' , ['empleado' => $empleado]) }}">Emergencias</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('empleados.disciplinas.index' , ['empleado' => $empleado]) }}">Falta Administrativa</a>
            </li>
        </ul>
    </div>
</div>
	<div class="card">
		<div class="card-header">
			<h4>Emergencias:</h4>
		</div>
		<div class="card-body">
			<form role="form" method="POST" action="{{ $edit ? route('empleados.emergencias.update',['empleado'=>$empleado,'emergencia'=>$emergencia]) : route('empleados.emergencias.store',['empleado'=>$empleado]) }}">
				@csrf
				@if ($edit)
					@method('PUT')
				@endif
				<div class="row form-group">
					<div class="col-4">
						<label class="control-label" for="sangre" id="sangre">Tipo de Sangre:</label>
						<select type="select" name="sangre" class="form-control" id="sangre" required>
							<option value="">Seleccione el tipo de sangre</option>
							<option id="1" value="O-" @if ($emergencia->sangre == "O-")
								{{-- expr --}}
								selected="selected" 
							@endif>O-</option>
							<option id="2" value="O+" @if ($emergencia->sangre == "O+")
								{{-- expr --}}
								selected="selected" 
							@endif>O+</option>
	    					<option id="3" value="AB+" @if ($emergencia->sangre == "AB+")
	    						{{-- expr --}}
	    						selected="selected" 
	    					@endif>AB+</option>
	    					<option id="4" value="AB-" @if ($emergencia->sangre == "AB-")
	    						{{-- expr --}}
	    						selected="selected" 
	    					@endif>AB-</option>
							<option id="5" value="A+" @if ($emergencia->sangre == "A+")
								{{-- expr --}}
								selected="selected" 
							@endif>A+</option>
	    					<option id="6" value="A-" @if ($emergencia->sangre == "A-")
	    						{{-- expr --}}
	    						selected="selected" 
	    					@endif>A-</option>
	    					<option id="7" value="B-" @if ($emergencia->sangre == "B-")
	    						{{-- expr --}}
	    						selected="selected" 
	    					@endif>B-</option>
	    					<option id="8" value="B+" @if ($emergencia->sangre == "B+")
	    						{{-- expr --}}
	    						selected="selected" 
	    					@endif>B+</option>
						</select>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-4">
						<label class="control-label" for="enfermedades" id="lbl_enf">Enfermedades:</label>
						<textarea class="form-control" id="enfermedades" name="enfermedades" maxlength="500" >{{ $emergencia->enfermedades }}</textarea>
					</div>
					<div class="col-4">
						<label class="control-label" for="alergias" id="lbl_alerg">Alergias:</label>
						<textarea class="form-control" id="alergias" name="alergias" maxlength="500">{{ $emergencia->alergias }}</textarea>
					</div>
					<div class="col-4">
						<label class="control-label" for="operaciones" id="lbl_oper">Operaciones:</label>
						<textarea class="form-control" id="operaciones" name="operaciones" maxlength="500">{{ $emergencia->operaciones }}</textarea>
					</div>
				</div>
				<div class="row card-header">
					<h5>En caso de emergencia llamar a:</h5>
				</div>
				<div class="row form-group">
					<div class="col-3">
						<label class="control-label" for="nombrecontac1">Nombre:</label>
    					<input type="text" class="form-control" id="nombrecontac1" name="nombrecontac1" value="{{ $emergencia->nombrecontac1 }}">
					</div>
					<div class="col-3">
						<label class="control-label" for="parentescocontac1">Parentesco:</label>
    					<input type="text" class="form-control" id="parentescocontac1" name="parentescocontac1" value="{{ $emergencia->parentescocontac1 }}">
					</div>
					<div class="col-3">
						<label class="control-label" for="telefonocontac1">Télefono:</label>
    					<input type="text" class="form-control" id="telefonocontac1" name="telefonocontac1" value="{{ $emergencia->telefonocontac1 }}">
					</div>
					<div class="col-3">
						<label class="control-label" for="movilcontac1">Telefono celular:</label>
    					<input type="text" class="form-control" id="movilcontac1" name="movilcontac1" value="{{ $emergencia->movilcontac1 }}">
					</div>
				</div>
				<div class="row form-group">
					<div class="col-3">
						<label class="control-label" for="nombrecontac2">Nombre:</label>
    					<input type="text" class="form-control" id="nombrecontac2" name="nombrecontac2" value="{{ $emergencia->nombrecontac2 }}">
					</div>
					<div class="col-3">
						<label class="control-label" for="parentescocontac2">Parentesco:</label>
    					<input type="text" class="form-control" id="parentescocontac2" name="parentescocontac2" value="{{ $emergencia->parentescocontac2 }}">
					</div>
					<div class="col-3">
						<label class="control-label" for="telefonocontac2">Télefono:</label>
    					<input type="text" class="form-control" id="telefonocontac2" name="telefonocontac2" value="{{ $emergencia->telefonocontac2 }}">
					</div>
					<div class="col-3">
						<label class="control-label" for="movilcontac2">Telefono celular:</label>
    					<input type="text" class="form-control" id="movilcontac2" name="movilcontac2" value="{{ $emergencia->movilcontac2 }}">
					</div>
				</div>
				<div class="row form-group">
					<div class="col-3">
						<label class="control-label" for="nombrecontac3">Nombre:</label>
    					<input type="text" class="form-control" id="nombrecontac3" name="nombrecontac3" value="{{ $emergencia->nombrecontac3 }}">
					</div>
					<div class="col-3">
						<label class="control-label" for="parentescocontac3">Parentesco:</label>
    					<input type="text" class="form-control" id="parentescocontac3" name="parentescocontac3" value="{{ $emergencia->parentescocontac3 }}">
					</div>
					<div class="col-3">
						<label class="control-label" for="telefonocontac3">Télefono:</label>
    					<input type="text" class="form-control" id="telefonocontac3" name="telefonocontac3" value="{{ $emergencia->telefonocontac3 }}">
					</div>
					<div class="col-3">
						<label class="control-label" for="movilcontac3">Telefono celular:</label>
    					<input type="text" class="form-control" id="movilcontac3" name="movilcontac3" value="{{ $emergencia->movilcontac3 }}">
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
		</div>
	</div>
@endsection
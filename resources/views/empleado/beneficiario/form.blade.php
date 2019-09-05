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
		<div class="card-header">
			<form role="form" method="POST" action="{{ $edit ? route('empleados.beneficiario.update',['empleado'=>$empleado,'beneficiario'=>$beneficiario]) : route('empleados.beneficiario.store',['empleado'=>$empleado]) }}">
				@csrf
				@if ($edit)
					@method('PUT')
				@endif
				<div class="row">
					<div class="form-group col-3">
						<label class="control-label">
							Nombre:
						</label>
						<input type="text" name="nombre" class="form-control" id="nombre" value="{{$beneficiario->nombre}}">
					</div>
					<div class="form-group col-3">
						<label class="control-label">
							Apellido Paterno:
						</label>
						<input type="text" name="appaterno" class="form-control" id="appaterno" value="{{$beneficiario->appaterno}}">
					</div>
					<div class="form-group col-3">
						<label class="control-label">
							Apellido Materno:
						</label>

						<input type="text" name="apmaterno" class="form-control" id="apmaterno" value="{{$beneficiario->apmaterno}}">
					</div>
					<div class="form-group col-3">
						<label class="control-label">
							Parentesco:
						</label>

						<input type="text" name="parentesco" class="form-control" id="parentesco" value="{{$beneficiario->parentesco}}">
					</div>
					<div class="form-group col-3">
						<label class="control-label">
							RFC:
						</label>

						<input type="text" name="rfc" class="form-control" id="rfc" value="{{$beneficiario->rfc}}">
					</div>
					<div class="form-group col-3">
						<label class="control-label">
							Calle:
						</label>

						<input type="text" name="calle" class="form-control" id="calle" value="{{$beneficiario->calle}}">
					</div>
					<div class="form-group col-3">
						<label class="control-label">
							Número exterior:
						</label>

						<input type="text" name="num_ext" class="form-control" id="num_ext" value="{{$beneficiario->num_ext}}">
					</div>
					<div class="form-group col-3">
						<label class="control-label">
							Número interior:
						</label>

						<input type="text" name="num_int" class="form-control" id="num_int" value="{{$beneficiario->num_int}}">
					</div>
					<div class="form-group col-3">
						<label class="control-label">
							Colonia:
						</label>

						<input type="text" name="colonia" class="form-control" id="colonia" value="{{$beneficiario->colonia}}">
					</div>
					<div class="form-group col-3">
						<label class="control-label">
							Alcaldía o municipio:
						</label>

						<input type="text" name="municipio" class="form-control" id="municipio" value="{{$beneficiario->municipio}}">
					</div>
					<div class="form-group col-3">
						<label class="control-label">
							Estado:
						</label>

						<input type="text" name="estado" class="form-control" id="estado" value="{{$beneficiario->estado}}">
					</div>
					<div class="form-group col-3">
						<label class="control-label">
							Telefono:
						</label>

						<input type="text" name="telefono" class="form-control" id="telefono" value="{{$beneficiario->telefono}}">
					</div>
					{{-- <div class="form-group col-3">
						<label class="control-label">
							Unidad medica
						</label>
						<input type="text" name="unidad_medica" class="form-control" id="unidad_medica" value="{{$beneficiario->unidad_medica}}">
					</div>
					<div class="form-group col-3">
						<label class="control-label">
							Turno
						</label>
						<input type="text" name="turno_atencion" class="form-control" id="turno_atencion" value="{{$beneficiario->turno_atencion}}">
					</div> --}}
					<div class="form-group col-3">
						<label class="control-label">
							Otro telefono
						</label>
						<input type="text" name="telefono_2" class="form-control" id="telefono_2" value="{{$beneficiario->telefono_2}}">
					</div>
					<div class="form-group col-3">
						<label class="control-label">
							Celular
						</label>
						<input type="text" name="celular" class="form-control" id="celular" value="{{$beneficiario->celular}}">
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
</div>
@endsection
@extends('empleado.show')
@section('submodulos')
	{{-- NAV --}}
<div class="row">
    <div class="col-sm-12">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('empleados.show', ['empleado' => $empleado]) }}">Datos generales</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('empleados.laborals.index', ['empleado' => $empleado]) }}">Datos Laborales</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('empleados.contactos.index', ['empleado' => $empleado]) }}">Contactos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('empleados.relaciones.index', ['empleado' => $empleado]) }}">Empleados</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('empleados.direcciones.index' , ['empleado' => $empleado]) }}">Dirección</a>
            </li>
        </ul>
    </div>
</div>
<div class="card card-default">
	<div class="card-header">
		<h4 class="title">Datos Generales</h4>
	</div>
	<div class="card-body">
		<div class="row row-group">
			<div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
                <label>R.F.C.:</label>
                <input type="text" class="form-control" value="{{ $empleado->rfc }}" readonly="">
            </div>
			<div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
                <label>Telefono:</label>
                <input type="text" class="form-control" value="{{ $empleado->telefono }}" readonly="">
            </div>
			<div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
                <label>Telefono movil:</label>
                <input type="text" class="form-control" value="{{ $empleado->movil }}" readonly="">
            </div>
			<div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
                <label>Telefono movil:</label>
                <input type="text" class="form-control" value="{{ $empleado->movil }}" readonly="">
            </div>
			<div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
                <label>Número de seguro social (NSS):</label>
                <input type="text" class="form-control" value="{{ $empleado->nss }}" readonly="">
            </div>
			<div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
                <label>C.U.R.P.:</label>
                <input type="text" class="form-control" value="{{ $empleado->curp }}" readonly="">
            </div>
			<div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
                <label>Número INFONAVIT:</label>
                <input type="text" class="form-control" value="{{ $empleado->infonavit }}" readonly="">
            </div>
		</div>
	</div>
	<div class="card-header">
		<h4 class="title">Dirección</h4>
	</div>
	<div class="card-body">
		<div class="row row-group">
			<div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
                <label>Calle:</label>
                <input type="text" class="form-control" value="{{ $empleado->calle }}" readonly="">
            </div>
			<div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
                <label>Número exterior:</label>
                <input type="text" class="form-control" value="{{ $empleado->num_ext }}" readonly="">
            </div>
			<div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
                <label>Número interior:</label>
                <input type="text" class="form-control" value="{{ $empleado->num_int }}" readonly="">
            </div>
			<div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
                <label>Código postal:</label>
                <input type="text" class="form-control" value="{{ $empleado->cp }}" readonly="">
            </div>
			<div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
                <label>Colonia:</label>
                <input type="text" class="form-control" value="{{ $empleado->colonia }}" readonly="">
            </div>
			<div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
                <label>Alcaldía o municipio:</label>
                <input type="text" class="form-control" value="{{ $empleado->municipio }}" readonly="">
            </div>
			<div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
                <label>Estado o ciudad:</label>
                <input type="text" class="form-control" value="{{ $empleado->estado }}" readonly="">
            </div>
			<div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
                <label>Entre calles:</label>
                <input type="text" class="form-control" value="{{ $empleado->calles }}" readonly="">
            </div>
			<div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
                <label>Referencia adicional:</label>
                <input type="text" class="form-control" value="{{ $empleado->referencia }}" readonly="">
            </div>
		</div>
	</div>
	<div class="card-footer">
		<div class="d-flex justify-content-center">
			<a href="{{ route('empleados.edit',['empleado'=>$empleado]) }}" class="btn btn-success" id="basic-addon1">
				<i class="fas fa-edit"></i>
				<strong> Editar</strong>
			</a>
		</div>
	</div>
</div>
@endsection
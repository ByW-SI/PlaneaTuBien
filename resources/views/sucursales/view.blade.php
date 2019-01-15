@extends('principal')
@section('content')

<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-sm-3">
                <h4>Datos de la Sucursal:</h4>
            </div>
            <div class="col-sm-3 text-center">
                <a href="{{ route('sucursals.edit', ['sucursal' => $sucursal]) }}" class="btn btn-warning">
                    <strong>✎ Editar Sucursal</strong>
                </a>
            </div>
            <div class="col-sm-3 text-center">
                <a href="{{ route('sucursals.create') }}" class="btn btn-success">
                    <i class="fa fa-plus"></i><strong> Agregar Sucursal</strong>
                </a>
            </div>
            <div class="col-sm-3 text-center">
                <a href="{{ route('sucursals.index') }}" class="btn btn-primary">
                    <i class="fa fa-bars"></i><strong> Lista de Sucursales</strong>
                </a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="form-group col-sm-4">
				<label>Nombre:</label>
				<dd>{{ $sucursal->nombre }}</dd>
            </div>
            <div class="form-group col-sm-4">
				<label>Abreviatura:</label>
				<dd>{{ $sucursal->abreviatura }}</dd>
            </div>
            <div class="form-group col-sm-4">
				<label>Responsable:</label>
				<dd>{{ $sucursal->responsable }}</dd>
            </div>
        </div>
        <div class="row">
        	<div class="form-group col-sm-4">
				<label>Teléfono:</label>
				<dd>{{ $sucursal->telefono ? $sucursal->telefono : 'N/A' }}</dd>
        	</div>
            <div class="form-group col-sm-4">
				<label>Descripción:</label>
				<dd>{{ $sucursal->descripcion ? $sucursal->descripcion : 'N/A' }}</dd>
            </div>
        </div>
        <div class="row">
        	<div class="col-sm-12">
        		<h5>Dirección:</h5>
        		<hr>
        	</div>
        </div>
        <div class="row">
        	<div class="form-group col-sm-4">
				<label>Calle:</label>
				<dd>{{ $sucursal->responsable }}</dd>
        	</div>
        	<div class="form-group col-sm-4">
				<label>Número Exterior:</label>
				<dd>{{ $sucursal->numext }}</dd>
        	</div>
        	<div class="form-group col-sm-4">
				<label>Número Interior:</label>
				<dd>{{ $sucursal->numint ? $sucursal->numint : 'N/A' }}</dd>
        	</div>
        </div>
        <div class="row">
        	<div class="form-group col-sm-4">
				<label>Código Postal:</label>
				<dd>{{ $sucursal->cp }}</dd>
        	</div>
        	<div class="form-group col-sm-4">
				<label>Estado:</label>
				<dd>{{ $sucursal->estado }}</dd>
        	</div>
        	<div class="form-group col-sm-4">
				<label>Delegación:</label>
				<dd>{{ $sucursal->delegacion }}</dd>
        	</div>
        </div>
    </div>
</div>

@endsection
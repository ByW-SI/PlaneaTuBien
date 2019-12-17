@extends('principal')
@section('content')

<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-sm-4">
                <h4>Datos de la Sucursal:</h4>
            </div>
            <div class="col-sm-4 text-center">
                <a href="{{ route('sucursals.index') }}" class="btn btn-primary">
                    <i class="fa fa-bars"></i><strong> Lista de Sucursales</strong>
                </a>
            </div>
        </div>
    </div>
    <form action="{{ route('sucursals.store') }}" method="post">
    	{{ csrf_field() }}
	    <div class="card-body">
	        <div class="row">
	            <div class="form-group col-sm-4">
					<label class="control-label">✱Nombre:</label>
					<input type="text" class="form-control" name="nombre" required="">
	            </div>
	            <div class="form-group col-sm-4">
					<label class="control-label">✱Abreviatura:</label>
					<input type="text" class="form-control" name="abreviatura" required="" maxlength="4">
	            </div>
	            <div class="form-group col-sm-4">
					<label class="control-label">Responsable:</label>
					<input type="text" class="form-control" name="responsable">
	            </div>
	        </div>
	        <div class="row">
	        	<div class="form-group col-sm-4">
					<label class="control-label">Teléfono:</label>
					<input type="text" class="form-control" name="telefono">
	        	</div>
	            <div class="form-group col-sm-4">
					<label class="control-label">Descripción:</label>
					<textarea class="form-control" name="descripcion"></textarea>
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
					<label class="control-label">✱Calle:</label>
					<input type="text" class="form-control" name="calle" required="">
	        	</div>
	        	<div class="form-group col-sm-4">
					<label class="control-label">✱Número Exterior:</label>
					<input type="text" class="form-control" name="numext" required="">
	        	</div>
	        	<div class="form-group col-sm-4">
					<label class="control-label">Número Interior:</label>
					<input type="text" class="form-control" name="numint">
	        	</div>
	        </div>
	        <div class="row">
	        	<div class="form-group col-sm-4">
					<label class="control-label">✱Colonia:</label>
					<input type="text" class="form-control" name="colonia" required="">
	        	</div>
	        	<div class="form-group col-sm-4">
					<label class="control-label">✱Código Postal:</label>
					<input type="text" class="form-control" name="cp" required="">
	        	</div>
	        	<div class="form-group col-sm-4">
					<label class="control-label">✱Estado:</label>
					<input type="text" class="form-control" name="estado" required="">
	        	</div>
	        	<div class="form-group col-sm-4">
					<label class="control-label">✱Delegación:</label>
					<input type="text" class="form-control" name="delegacion" required="">
	        	</div>
	        </div>
	    </div>
	    <div class="card-footer">
	        <div class="row">
	            <div class="col-4 offset-4 text-center">
	                <button type="submit" class="btn btn-success">
	                    <i class="fa fa-check"></i> Guardar
	                </button>
	            </div>
	            <div class="col-sm-4 text-right text-danger">
	                ✱Campos Requeridos.
	            </div>
	        </div>
	    </div>
	</form>
</div>

@endsection
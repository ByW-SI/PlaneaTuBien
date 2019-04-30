@extends('principal')
@section('content')

<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-sm-4">
                <h4>Datos de la Sucursal:</h4>
            </div>
            @foreach(Auth::user()->perfil->componentes as $c)
	            @if($c->nombre == "crear sucursal" || $c->nombre == "indice Sucursales")
	                @if($c->nombre == "crear sucursal")
		            <div class="col-sm-4 text-center">
		                <a href="{{ route('sucursals.create') }}" class="btn btn-success">
		                    <i class="fa fa-plus"></i><strong> Agregar Sucursal</strong>
		                </a>
		            </div>
		            @endif
		            @if($c->nombre == "indice Sucursales")
		            <div class="col-sm-4 text-center">
		                <a href="{{ route('sucursals.index') }}" class="btn btn-primary">
		                    <i class="fa fa-bars"></i><strong> Lista de Sucursales</strong>
		                </a>
		            </div>
		            @endif
	            @endif
            @endforeach
        </div>
    </div>
    <form action="{{ route('sucursals.update', ['sucursal' => $sucursal]) }}" method="post">
    	{{ csrf_field() }}
    	@method('PUT')
	    <div class="card-body">
	        <div class="row">
	            <div class="form-group col-sm-4">
					<label class="control-label">✱Nombre:</label>
					<input type="text" class="form-control" name="nombre" required="" value="{{ $sucursal->nombre }}">
	            </div>
	            <div class="form-group col-sm-4">
					<label class="control-label">✱Abreviatura:</label>
					<input type="text" class="form-control" name="abreviatura" required="" maxlength="4" value="{{ $sucursal->abreviatura }}">
	            </div>
	            <div class="form-group col-sm-4">
					<label class="control-label">✱Responsable:</label>
					<input type="text" class="form-control" name="responsable" required="" value="{{ $sucursal->responsable }}">
	            </div>
	        </div>
	        <div class="row">
	        	<div class="form-group col-sm-4">
					<label class="control-label">Teléfono:</label>
					<input type="text" class="form-control" name="telefono" value="{{ $sucursal->telefono }}">
	        	</div>
	            <div class="form-group col-sm-4">
					<label class="control-label">Descripción:</label>
					<textarea class="form-control" name="descripcion">{{ $sucursal->descripcion }}</textarea>
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
					<input type="text" class="form-control" name="calle" required="" value="{{ $sucursal->calle }}">
	        	</div>
	        	<div class="form-group col-sm-4">
					<label class="control-label">✱Número Exterior:</label>
					<input type="text" class="form-control" name="numext" required="" value="{{ $sucursal->numext }}">
	        	</div>
	        	<div class="form-group col-sm-4">
					<label class="control-label">Número Interior:</label>
					<input type="text" class="form-control" name="numint" value="{{ $sucursal->numint }}">
	        	</div>
	        </div>
	        <div class="row">
	        	<div class="form-group col-sm-4">
					<label class="control-label">✱Código Postal:</label>
					<input type="text" class="form-control" name="cp" required="" value="{{ $sucursal->cp }}">
	        	</div>
	        	<div class="form-group col-sm-4">
					<label class="control-label">✱Estado:</label>
					<input type="text" class="form-control" name="estado" required="" value="{{ $sucursal->estado }}">
	        	</div>
	        	<div class="form-group col-sm-4">
					<label class="control-label">✱Delegación:</label>
					<input type="text" class="form-control" name="delegacion" required="" value="{{ $sucursal->delegacion }}">
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
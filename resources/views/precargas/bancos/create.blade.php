@extends('principal')
@section('content')

<div class="card">
	<div class="card-header">
		<div class="row">
			<div class="col-sm-4">
				<h4>Datos del Bancos:</h4>
			</div>
			<div class="col-sm-4 text-center">
				<a href="{{ route('bancos.index') }}" class="btn btn-primary">
					<i class="fa fa-bars"></i><strong> Lista de Bancos</strong>
				</a>
			</div>
		</div>
	</div>
	<form action="{{ route('bancos.store') }}" method="post">
        {{ csrf_field() }}
		<div class="card-body">
			<div class="row">
				<div class="form-group col-sm-4">
					<label class="control-label">✱Nombre:</label>
					<input type="text" name="nombre" class="form-control" required="">
				</div>
				<div class="form-group col-sm-4">
					<label class="control-label">Etiqueta:</label>
					<input type="text" name="etiqueta" class="form-control">
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
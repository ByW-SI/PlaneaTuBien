@extends('principal')
@section('content')
<div class="card card-default">
	<div class="card-header">
		<h3 class="title">
			{{$titulo}}
		</h3>
	</div>
	<form method="POST" action="{{$edit ? route($edit,['precarga'=>$precarga]) : route($guardar) }}">
		@csrf
		@if ($edit)
			@method('PUT')
		@endif
		<div class="card-body">
			<div class="row row-group">
				<div class="col-12 col-sm-12 offset-md-2 col-md-4 offset-lg-2 col-lg-4 offset-xl-2 col-xl-4 form-group">
					<label for="nombre">Nombre:</label>
					<input class="form-control" type="text" value="{{$precarga->nombre}}" name="nombre" required>
				</div>
				<div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
					<label for="descripcion">Descripción:</label>
					<textarea class="form-control" name="descripcion">{{$precarga->descripcion}}</textarea>
				</div>
			</div>
		</div>
		<div class="card-footer">
			<div class="d-flex justify-content-center">
				<button type="submit" class="btn btn-success" id="basic-addon1">
					<i class="fas fa-save"></i>
					<strong> Guardar</strong>
				</button>
			</div>
		</div>
	</form>
</div>
@endsection
@extends('principal')
@section('content')
<div class="card card-default">
	<div class="card-header">
		<h5 class="title">
			Polizas
		</h5>
	</div>
	<form method="POST" action="{{ $edit ? route('polizas.update',['poliza'=>$poliza]) : route('polizas.store') }}">
		@csrf
		@if ($edit)
			@method('PUT')
		@endif
		<div class="card-body">
			@if ($errors->any())
			    <div class="alert alert-danger">
			        <ul>
			            @foreach ($errors->all() as $error)
			                <li>{{ $error }}</li>
			            @endforeach
			        </ul>
			    </div>
			@endif
			<div class="row row-group">
				<div class="col-12 col-md-3">
					<label for="nombre">Nombre</label>
					<input type="text" name="nombre" id="nombre" value="{{$edit ? $poliza->nombre : old('nombre')}}" class="form-control" required="">
				</div>
				<div class="col-12 col-md-3">
					<label for="descripcion">Descripción</label>
					<textarea name="descripcion" id="descripcion" class="form-control" rows="2" cols="50">{{$edit ? $poliza->descripcion : old('descripcion')}}</textarea>
				</div>
				<div class="col-12 col-md-6">
					<label for="fecha_inicio">Vigencia</label>
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon-de">de</span>
						</div>
						<input type="date" name="fecha_inicio" id="fecha_inicio" value="{{$edit ? $poliza->fecha_inicio : old('fecha_inicio')}}" class="form-control" required="">
						<div class="input-group-append">
							<span class="input-group-text" id="basic-addon-a">a</span>
						</div>
						<input type="date" name="fecha_fin" id="fecha_fin" value="{{$edit ? $poliza->fecha_fin : old('fecha_fin')}}" class="form-control" required="">
					</div>
				</div>
			</div>
			<div class="row row-group">
				<div class="col-12 col-md-4">
					<label for="folio">Folio</label>
					<input type="text" name="folio" id="folio" value="{{$edit ? $poliza->folio : old('folio')}}" class="form-control" required="">
				</div>
				<div class="col-12 col-md-4">
					<label for="tel_contacto">Telefono de contacto</label>
					<input type="text" name="tel_contacto"  id="tel_contacto" value="{{$edit ? $poliza->tel_contacto : old('tel_contacto')}}" class="form-control" required="">
				</div>
				<div class="col-12 col-md-4">
					<label for="nombre_asesor">Nombre del asesor</label>
					<input type="text" name="nombre_asesor" id="nombre_asesor" value="{{$edit ? $poliza->nombre_asesor : old('nombre_asesor')}}" class="form-control" required="">
				</div>
			</div>
		</div>
		<div class="card-footer">
			<div class="d-flex justify-content-center">
				<button type="submit" class="btn btn-success"><i class="far fa-save"></i> Guardar</button>
			</div>
		</div>
	</form>
</div>
@endsection
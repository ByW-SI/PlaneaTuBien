@extends('principal')
@section('content')
<div class="card card-default">
	<div class="card-header">
		<h3 class="title">
			Promoción
		</h3>
	</div>
	<form method="POST" action="{{$edit ? route('promocions.update',['promocion'=>$promocion]) : route('promocions.store') }}">
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
				<div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
					<label for="nombre">Nombre:</label>
					<input class="form-control" type="text" value="{{old('nombre') ? old('nombre') : $promocion->nombre}}" name="nombre" required>
				</div>
				<div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
					<label for="monto">Monto del descuento:</label>
					<input class="form-control" type="number" step="any" value="{{old('monto') ? old('monto') : $promocion->monto}}" name="monto" required>
				</div>
				<div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
					<label for="monto">Tipo de descuento:</label>
					<div class="form-check">
						<input class="form-check-input" type="radio" name="tipo_monto" id="tipo_monto1" value="porcentaje" required {{(old('tipo_monto') == "porcentaje") ? "checked" : (($promocion->tipo_monto == "porcentaje") ? "checked" : "") }}>
				  		<label class="form-check-label" for="tipo_monto1">
					    	Porcentaje (%)
					  	</label>
					</div>
					<div class="form-check">
				  		<input class="form-check-input" type="radio" name="tipo_monto" id="tipo_monto2" value="efectivo" {{(old('tipo_monto') == "efectivo") ? "checked" : (($promocion->tipo_monto == "efectivo") ? "checked" : "") }}>
					  	<label class="form-check-label" for="tipo_monto2">
					    	Efectivo (MXN)
					  	</label>
					</div>
				</div>
				<div class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8 form-group">
					<label for="valido_inicio">Valido:</label>
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1">De: </span>
						</div>
						<input type="date" class="form-control" name="valido_inicio" value="{{old('valido_inicio') ? old('valido_inicio') : $promocion->valido_inicio}}" required>
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1">hasta:</span>
						</div>
						<input type="date" class="form-control" name="valido_fin" value="{{old('valido_fin') ? old('valido_fin') : $promocion->valido_fin}}" required>
					</div>
				</div>
				<div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
					<label for="tipo_promo">Tipo de promoción:</label>
					<select class="form-control" name="tipo_promo" required="">
						<option value="">Seleccione una opción</option>
						@foreach ($tipo_promociones as $tipo_promo)
							<option value="{{$tipo_promo->id}}" title="{{$tipo_promo->descripcion}}" {{old('tipo_promo') == $tipo_promo->id ? 'selected=""' : ($promocion->tipo_promocion->id == $tipo_promo->id ? 'selected=""' : '' )}}>{{$tipo_promo->nombre}}</option>
						@endforeach
					</select>
				</div>
				<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 form-group">
					<label for="descripcion">Descripción (opcional):</label>
					<textarea class="form-control" name="descripcion">{{old('descripcion') ? old('descripcion') : $promocion->descripcion}}</textarea>
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

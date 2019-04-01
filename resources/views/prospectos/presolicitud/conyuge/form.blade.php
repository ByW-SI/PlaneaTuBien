@extends('principal')
@section('content')
<div class="card">
	@include('prospectos.presolicitud.navs',['prospectos'=>$prospecto,'presolicitud'=>$presolicitud,'active'=>'Conyuge'])
	<form method="POST" action="{{ route('prospectos.presolicitud.conyuge.store',['prospecto'=>$prospecto,'presolicitud'=>$presolicitud]) }}">
		@csrf
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
			<div class="row">
				<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
					<label for="">Apellido Paterno</label>
					<input type="text" class="form-control" name="paterno" required="" value="{{old('paterno')}}">
				</div>
				<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
					<label for="">Apellido Materno</label>
					<input type="text" class="form-control" name="materno" value="{{old('materno')}}">
				</div>
				<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
					<label for="">Nombre(s)</label>
					<input type="text" class="form-control" name="nombre" required="" value="{{old('nombre')}}">
				</div>
				<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
					<label for="">Fecha de nacimiento</label>
					<input type="date" class="form-control" name="fecha_nacimiento" required="" value="{{old('fecha_nacimiento')}}">
				</div>
				<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
					<label for="">Lugar de nacimiento</label>
					<input type="text" class="form-control" name="lugar_nacimiento" required="" value="{{old('lugar_nacimiento')}}">
				</div>
				<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
					<label for="">Nacionalidad</label>
					<input type="text" class="form-control" name="nacionalidad" required="" value="{{old('nacionalidad')}}">
				</div>
				<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
					<label for="">Teléfono de casa</label>
					<input type="text" class="form-control" name="tel_casa" required="" value="{{old('tel_casa')}}">
				</div>
				<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
					<label for="">Teléfono de oficina</label>
					<input type="text" class="form-control" name="tel_oficina" value="{{old('tel_oficina')}}">
				</div>
				<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
					<label for="">Teléfono celular</label>
					<input type="text" class="form-control" name="tel_celular" value="{{old('tel_celular')}}">
				</div>
				<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
					<label for="">Correo electrónico</label>
					<input type="email" class="form-control" name="email" required="" value="{{old('email')}}">
				</div>
			</div>
		</div>
		<div class="card-footer">
			<div class="d-flex justify-content-center">
				<button class="btn btn-success" type="submit"><i class="fas fa-arrow-alt-circle-right"></i> Siguiente</button>
			</div>
		</div>

	</form>
</div>
@endsection
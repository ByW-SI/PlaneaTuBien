@extends('principal')
@section('content')
<div class="card">
	@include('prospectos.presolicitud.navs',['prospectos'=>$prospecto,'presolicitud'=>$presolicitud,'active'=>'Conyuge'])
	<div class="card-body">
		<div class="row">
			<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
				<label for="">Apellido Paterno</label>
				<label class="form-control bg-light">{{$conyuge->paterno}}</label>
			</div>
			<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
				<label for="">Apellido Materno</label>
				<label class="form-control bg-light">{{$conyuge->materno}}</label>
			</div>
			<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
				<label for="">Nombre(s)</label>
				<label class="form-control bg-light">{{$conyuge->nombre}}</label>
			</div>
			<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
				<label for="">Fecha de nacimiento</label>
				<label class="form-control bg-light">{{$conyuge->fecha_nacimiento}}</label>
			</div>
			<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
				<label for="">Lugar de Nacimiento</label>
				<label class="form-control bg-light">{{$conyuge->lugar_nacimiento}}</label>
			</div>
			<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
				<label for="">Nacionalidad</label>
				<label class="form-control bg-light">{{$conyuge->nacionalidad}}</label>
			</div>
			<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
				<label for="">Télefono de casa</label>
				<label class="form-control bg-light">{{$conyuge->tel_casa}}</label>
			</div>
			<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
				<label for="">Télefono de oficina</label>
				<label class="form-control bg-light">{{$conyuge->tel_oficina}}</label>
			</div>
			<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
				<label for="">Télefono celular</label>
				<label class="form-control bg-light">{{$conyuge->tel_celular}}</label>
			</div>
			<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
				<label for="">Correo Electrónico</label>
				<label class="form-control bg-light">{{$conyuge->email}}</label>
			</div>
			
			
		</div>
	</div>
	@include('prospectos.presolicitud.footer',['presolicitud'=>$presolicitud])
</div>
@endsection
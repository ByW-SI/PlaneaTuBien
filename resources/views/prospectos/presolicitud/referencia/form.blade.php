@extends('principal')
@section('content')
<div class="card">
	@include('prospectos.presolicitud.navs',['prospectos'=>$prospecto,'presolicitud'=>$presolicitud,'active'=>'Referencias'])
	<form method="POST" action="{{ route('prospectos.presolicitud.referencias.store',['prospecto'=>$prospecto,'presolicitud'=>$presolicitud]) }}">
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
			@for ($i = 0; $i <= 2; $i++)
				{{-- expr --}}
				<label>Referencia #{{$i+1}}</label>
				<div class="row">
					<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
						<label for="">Apellido Paterno</label>
						<input type="text" class="form-control" name="paterno[{{$i}}]" required="" value="{{old('paterno.'.$i)}}">
					</div>
					<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
						<label for="">Apellido Materno</label>
						<input type="text" class="form-control" name="materno[{{$i}}]" value="{{old('materno.'.$i.'')}}">
					</div>
					<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
						<label for="">Nombre(s)</label>
						<input type="text" class="form-control" name="nombre[{{$i}}]" required="" value="{{old('nombre.'.$i)}}">
					</div>
					<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
						<label for="">telefono</label>
						<input type="text" step="1" min="0" class="form-control" name="telefono[{{$i}}]" required="" value="{{old('telefono.'.$i)}}">
					</div>
					<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
						<label for="">Parentesco</label>
						<input type="text" step="1" min="0" class="form-control" name="parentesco[{{$i}}]" required="" value="{{old('parentesco.'.$i)}}">
					</div>
				</div>
			@endfor
		</div>
		<div class="card-footer">
			<div class="d-flex justify-content-center">
				<button class="btn btn-success" id="submit" type="submit"><i class="fas fa-arrow-alt-circle-right"></i> Siguiente</button>
			</div>
		</div>

	</form>
</div>
@endsection
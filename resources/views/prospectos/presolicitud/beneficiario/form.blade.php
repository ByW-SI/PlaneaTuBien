@extends('principal')
@section('content')
<div class="card">
	@include('prospectos.presolicitud.navs',['prospectos'=>$prospecto,'presolicitud'=>$presolicitud,'active'=>'Beneficiario'])
		<div class="card-body">
	<form method="POST" action="{{ route('prospectos.presolicitud.beneficiarios.store',['prospecto'=>$prospecto,'presolicitud'=>$presolicitud]) }}">
		@csrf
			@if ($errors->any())
			    <div class="alert alert-danger">
			        <ul>
			            @foreach ($errors->all() as $error)
			                <li>{{ $error }}</li>
			            @endforeach
			        </ul>
			    </div>
			@endif
			@for ($i = 0; $i <= 3; $i++)
				{{-- expr --}}
				<label>Beneficiario #{{$i+1}}</label>
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
						<label for="">Edad</label>
						<input type="number" step="1" min="0" class="form-control" name="edad[{{$i}}]" required="" value="{{old('edad.'.$i)}}">
					</div>
					<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
						<label for="">Parentesco</label>
						<input type="text" step="1" min="0" class="form-control" name="parentesco[{{$i}}]" required="" value="{{old('parentesco.'.$i)}}">
					</div>
					<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
						<label for="">Porcentaje del bien</label>
						<div class="input-group">
							<input type="number" step="any" min="1" max="100" class="form-control" name="porcentaje[]" required="" onchange="cienporciento(this.value)" value="{{old('porcentaje.'.$i)}}">
					        <div class="input-group-append">
					          <div class="input-group-text">%</div>
					        </div>
				      	</div>
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
@push('scripts')
<script type="text/javascript">
	function cienporciento(value){
		var porcentaje = 0.00;
		$('input[name="porcentaje[]"]').each(function(){
			if(this.value){
				porcentaje += +this.value;
			}
		})
		if (porcentaje != 100) {
			alert('El porcentaje total debe de ser del 100%.Tu porcentaje total: '+porcentaje+"%");
			$('#submit').prop('disabled', true);
		}
		else{
			$('#submit').prop('disabled', false);
		}
	}
</script>

@endpush
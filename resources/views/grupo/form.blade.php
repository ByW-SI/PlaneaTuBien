@extends('principal')
@section('content')
	<div class="card">
		<div class="card-header">
			Grupos:
		</div>
		<form method="POST" action="{{ $edit ? route('grupos.update',['grupo'=>$grupo]) : route('grupos.store') }}">
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
				<div class="row">
					<div class="col-12 col-xs-12 col-md-6 col-lg-3 col-xl-3">
						<label for="fecha_inicio">✱Fecha de inicio</label>
						<input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" value="{{$edit ? $grupo->fecha_inicio : old('fecha_inicio')}}" required="">
					</div>
					<div class="col-12 col-xs-12 col-md-6 col-lg-3 col-xl-3">
						<label for="vigencia">✱Vigencia del grupo</label>
						<div class="input-group mb-3">
						  <input type="number" step="1" name="vigencia" id="vigencia" class="form-control" value="{{$edit ? $grupo->vigencia : old('vigencia')}}" required="">
						  <div class="input-group-append">
						    <span class="input-group-text" id="basic-addon2">Meses</span>
						  </div>
						</div>
					</div>
					<div class="col-12 col-xs-12 col-md-6 col-lg-3 col-xl-3">
						<label for="fecha_fin">✱Fecha de termino</label>
						<input type="date" class="form-control" name="fecha_fin" id="fecha_fin" value="{{$edit ? $grupo->fecha_fin : old('fecha_fin')}}" required="">
					</div>
					<div class="col-12 col-xs-12 col-md-6 col-lg-3 col-xl-3">
						<label for="contratos">✱Números de contratos</label>
						<div class="input-group mb-3">
						  <div class="input-group-preppend">
						    <span class="input-group-text" id="basic-addon2">#</span>
						  </div>
						  <input type="number" step="1" name="contratos" id="contratos" class="form-control" value="{{$edit ? $grupo->contratos : old('contratos')}}" required="">
						</div>
					</div>
				</div>
			</div>
			<div class="card-footer">
                <div class="row">
                    <div class="col-4 offset-4 text-center">
                        <button type="submit" class="btn btn-success">
                            <i class="fa fa-save"></i> Guardar
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
@push('scripts')
<script src="http://momentjs.com/downloads/moment.js"></script>
	<script>
		$("#vigencia").change(function(){
			cambiar_fin();
		});
		$("#fecha_inicio").change(function(){
			cambiar_fin();
		});
		function cambiar_fin() {
			var date_inicio = new Date($("#fecha_inicio").val());
			var vigencia = $("#vigencia").val();
			new Date(date_inicio.setMonth(date_inicio.getMonth()+ +vigencia));
			// $("#fecha_fin").val(date_fin.getFullYear()+'-'+date_fin.getMonth()+'-'+date_fin.getDate());
			$("#fecha_fin").val(moment(date_inicio).format('YYYY-MM-DD'));
		}
	</script>
@endpush
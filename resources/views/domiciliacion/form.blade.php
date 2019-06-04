@extends('principal')
@section('content')
<div class="card">
	<div class="card-header">Agregar Forma de domiciliación</div>
	<form method="POST" action="{{ $edit ? route('contratos.domiciliacion.update',['contrato'=>$contrato,'domiciliacion'=>$domiciliacion] ) : route('contratos.domiciliacion.store',['contrato'=>$contrato]) }}">
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
				<div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 form-group">
					<label for="emisor">Cliente del emisor titular del servicio(Nombre Completo)</label>
					<input type="text" class="form-control" name="emisor" id="emisor" required="" value="{{$edit ? $domiciliacion->emisor : $contrato->presolicitud->nombre.' '.$contrato->presolicitud->paterno.' '.$contrato->presolicitud->materno}}">
				</div>
				<div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 form-group">
					<label for="referencia">Referencia</label>
					<input type="text" class="form-control" name="referencia" id="referencia" required="" value="{{$edit ? $domiciliacion->referencia : $contrato->presolicitud->cotizacion()->folio}}">
				</div>
				<div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 form-group">
					<label for="titular">Cliente usuario titular de la cuenta bancaria (nombre completo)</label>
					<input type="text" class="form-control" name="titular" id="titular" required="" value="{{$edit ? $domiciliacion->titular : $contrato->presolicitud->nombre.' '.$contrato->presolicitud->paterno.' '.$contrato->presolicitud->materno}}">
				</div>
				<div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 form-group">
					<label for="tipo">Tipo de cuenta</label>
					<select name="tipo" id="tipo" class="form-control" required="">
						<option value="">Seleccione una opción</option>
						<option value="CLABE">CLABE</option>
						<option value="Tarjeta de crédito/débito">Tarjeta de crédito/débito</option>
					</select>
				</div>
				<div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 form-group">
					<label for="banco">Banco receptor donde recida la cuenta bancaria(Razón Social)</label>
					<input type="text" name="banco" id="banco" class="form-control" value="{{$edit ? $domiciliacion->banco : old('banco')}}">
				</div>
				<div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 form-group">
					<label for="numero">Número</label>
					<input type="text" name="numero" id="numero" class="form-control" value="{{$edit ? $domiciliacion->numero : old('numero')}}" pattern="">
				</div>
				<div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 form-group">
					<label for="monto">Monto</label>
					<input type="number" step="any" name="monto" id="monto" class="form-control" value="{{$edit ? $domiciliacion->monto : old('monto')}}" required="">
				</div>
			</div>
		</div>
		<div class="card-footer">
			<div class="d-flex justify-content-center">
				<button class="btn btn-success" id="submit" type="submit"><i class="fas fa-save"></i> Guardar</button>
			</div>
		</div>
	</form>
</div>
@push('scripts')
    <script type="text/javascript">
    	$('#tipo').change(function () {
    		var tipo_val = $("#tipo").val();
    		if(tipo_val == "CLABE"){
    			$("#numero").attr({
    				'pattern':'[0-9]{18}',
    				'title':'El numero de la CLABE debe ser de 18 digitos'
    			});
    		}
    		if(tipo_val == "Tarjeta de crédito/débito"){
    			$("#numero").attr({
    				'pattern':'[0-9]{16}',
    				'title':'El numero de la tarjeta debe ser de 16 digitos'
    			});
    		}
    	})
    </script>
@endpush
@endsection
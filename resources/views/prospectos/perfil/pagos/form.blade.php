@extends('principal')
@section('content')
<div class="card">
	<div class="card-header">
		<h4>
			{{$edit ? "Actualizar Pago" : "Nuevo Pago"}}
		</h4>
	</div>
	<form method="POST" action="{{ $edit ? route('prospectos.cotizacions.pagos.update',['prospecto'=>$prospecto,'cotizacion'=>$cotizacion,'pago'=>$pago]) : route('prospectos.cotizacions.pagos.store',['prospecto'=>$prospecto,'cotizacion'=>$cotizacion]) }}">
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
				<div class="col-12 col-xs-12 col-md-6 col-lg-6 form-group">
					<label for="referencia">Referencia</label>
					<input type="text" class="form-control" step="any" min="0" value="{{$cotizacion->folio}}" name="referencia" id="referencia" readonly="">
				</div>
				<div class="col-12 col-xs-12 col-md-6 col-lg-6 form-group">
					<label for="folio">Folio</label>
					<input type="text" class="form-control" step="any" min="0" value="{{$folio}}" name="folio" id="folio" readonly="">
				</div>
				<div class="col-12 col-xs-12 col-md-6 col-lg-4 form-group">
					<label for="identificacion">Tipo de Identificación</label>
					<select name="identificacion" id="identificacion" class="form-control" required="">
						<option value="">Seleccionar una opción</option>
						<option value="INE">INE/IFE</option>
						<option value="Pasaporte">Pasaporte</option>
						<option value="Cédula Profesional">Cédula Profesional</option>
						<option value="Cartilla">Cartilla</option>
						<option value="Otro">Otro</option>
					</select>
				</div>
				<div class="col-12 col-xs-12 col-md-6 col-lg-4 form-group">
					<label for="comprobante">Comprobante de Domicilio</label>
					<select name="comprobante" id="comprobante" class="form-control" required="">
						<option value="">Seleccionar una opción</option>
						<option value="Luz">Luz</option>
						<option value="Agua">Agua</option>
						<option value="Teléfono">Teléfono</option>
						<option value="Predial">Predial</option>
						<option value="Otro">Otro</option>
					</select>
				</div>
				<div class="col-12 col-xs-12 col-md-6 col-lg-4 form-group">
					<label for="forma">Forma de Pago</label>
					<select name="forma" id="forma" class="form-control" required="">
						<option value="">Seleccionar una opción</option>
						<option value="Efectivo">Efectivo</option>
						<option value="Depósito">Depósito</option>
						<option value="Cheque">Cheque</option>
						<option value="Tarjeta de Crédito">Tarjeta de Crédito</option>
						<option value="Tarjeta de Débito">Tarjeta de Débito</option>
						<option value="Transferencia">Transferencia</option>
					</select>
				</div>
				<div class="" id="div_banco"></div>
				<div class="col-12 col-xs-12 col-md-6 col-lg-3 form-group" id="div_monto">
					<label for="monto">Monto</label>
					<div class="input-group mb-3">
						<div class="input group-prepend">
							<span class="input-group-text">$</span>
						</div>
						<input type="number" class="form-control" step="any" min="0" name="monto" id="monto" required="">
					</div>
				</div>
				<div class="col-12 col-xs-12 col-md-6 col-lg-3 form-group" id="div_monto">
					<label for="total">Total</label>
					<div class="input-group mb-3">
						<div class="input group-prepend">
							<span class="input-group-text">$</span>
						</div>
						<input type="number" class="form-control" step="any" min="0" name="total" id="total">
					</div>
				</div>
			</div>
		</div>
		<div class="card-header">
			<div class="d-flex justify-content-center">
				<button type="submit" class="btn btn-success">Guardar</button>
			</div>
		</div>
	</form>
</div>
@endsection
@push('scripts')
	<script type="text/javascript">
		$("#forma").change(function(){
			var forma_pago = $("#forma").val();
			$("#div_banco").removeClass("col-12 col-xs-12 col-md-6 col-lg-3 form-group");
			$("#div_banco").empty();
			if(forma_pago == "Depósito"){
				var html = `<label for="banco">Banco</label>
					<select name="banco" id="banco" class="form-control" required="">
						<option value="">Seleccionar una opción</option>
						@foreach ($bancos as $banco)
							<option value="{{$banco->nombre}}" title="{{$banco->etiqueta}}">{{$banco->nombre}}</option>
						@endforeach
					</select>`;
				$("#div_banco").addClass("col-12 col-xs-12 col-md-6 col-lg-3 form-group");
				$("#div_banco").append(html);
			}
		});
		$("#monto").change(function(){
			setTotal(); 
		});
		$("#adeudo").change(function(){
			setTotal(); 
		});
		function setTotal() {
			var monto = parseFloat($("#monto").val());
			total = monto;
			$("#total").val(total);
		}
	</script>
@endpush

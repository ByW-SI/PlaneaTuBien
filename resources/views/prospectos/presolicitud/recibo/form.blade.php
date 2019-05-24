@extends('principal')
@section('content')
<div class="card">
	@include('prospectos.presolicitud.navs',['prospectos'=>$prospecto,'presolicitud'=>$presolicitud,'active'=>'Recibo'])
	<form method="POST" action="{{ route('prospectos.presolicitud.recibos.store',['prospecto'=>$prospecto,'presolicitud'=>$presolicitud]) }}">
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
				<div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 border">
					<div class="row mt-3">

						<div class="col-sm-12 col-md-3 col-lg-3 col-xl-3 form-group">
							<label for="monto">Recibo por </label>
							<input type="number" name="monto" class="form-control" id="monto" required="" value="{{$cotizacion->monto}}" readonly="">
						</div>
						<div class="col-sm-12 col-md-3 col-lg-3 col-xl-3 form-group">
							<label for="">Sucursal</label>
							<input type="text" class="form-control" name="sucursal" value="{{old('sucursal')}}">
						</div>
						<div class="col-sm-12 col-md-3 col-lg-3 col-xl-3 form-group">
							<label for="">Tipo pago</label>
							<select class="form-control" id="tipo_pago" name="tipo_pago" required="">
								<option value="">Elija una opción</option>
								<option value="Tarjeta de crédito" {{old('tipo_pago') == "Tarjeta de crédito" ? 'selected' : ''}}>Tarjeta de crédito</option>
								<option value="Cheque" {{old('tipo_pago') == "Cheque" ? 'selected' : ''}}>Cheque</option>
							</select>
						</div>
						<div class="col-sm-12 col-md-3 col-lg-3 col-xl-3 form-group" id="tarjetas">
						</div>
						<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 form-group">
							<label for="">No.</label>
							<input type="text" class="form-control" name="numero" value="{{old('numero')}}">
						</div>
						<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 form-group">
							<label for="">Banco Emisor</label>
							<select type="text" class="form-control" name="banco" id="banco">
								<option value="">Seleccionar un banco</option>
								@foreach ($bancos as $banco)
									<option value="{{$banco->nombre}}" {{ old('banco') == $banco->nombre ? 'selected=""' : ''}}>{{$banco->nombre}}</option>
								@endforeach
							</select>
						</div>
					</div>
				</div>
				<div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 border bg-light border">
					<div class="row mt-3">
						<div class="col-6 mt-2">
							<label>Inscripción inicial</label>
						</div>
						<div class="col-6">
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text">$</span>
								</div>
								<input type="number" readonly="" class="form-control text-center" name="insc_inicial" min="1" value="{{$inscripcion_inicial}}" id="insc_inicial" required="">
							</div>
						</div>
						<div class="col-6 mt-2">
							<label>I.V.A.</label>
						</div>
						<div class="col-6">
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text">$</span>
								</div>
								<input type="number" readonly="" class="form-control text-center" name="iva" id="iva" min="1" value="{{$iva}}" required="">
							</div>
						</div>
						<div class="col-6 mt-2">
							<label>Subtotal</label>
						</div>
						<div class="col-6">
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text">$</span>
								</div>
								<input type="number" readonly="" class="form-control text-center" name="subtotal" id="subtotal" value="{{$monto_inscripcion_con_iva}}" min="1" required="">
							</div>
						</div>
						<div class="col-6 mt-2">
							<label>Cuota Periódica Total:</label>
						</div>
						<div class="col-6">
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text">$</span>
								</div>
								<select name="cuota_periodica" class="form-control text-center" id="cuota_periodica">
									<option value="0.00">0.00</option>
									<option value="{{round($cuota_periodica,2)}}">{{round($cuota_periodica,2)}}</option>
								</select>
							</div>
						</div>
						<div class="col-6 mt-2">
							<label>Total:</label>
						</div>
						<div class="col-6">
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text">$</span>
								</div>
								<input type="text" readonly="" class="form-control text-center" name="total" id="total" value="{{$monto_inscripcion_con_iva}}" required="">
							</div>
						</div>
					</div>
				</div>
				
			</div>
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
		// $(document).ready(function(){
		$("#tipo_pago").change(function(){
			var value = this.value;
			var html= `
			<label for="">Tarjeta</label>
			<select class="form-control" id="tipo_tarjeta" name="tipo_tarjeta" required="">
				<option value="">Elija una opción</option>
				<option value="Visa" {{old('tipo_tarjeta') == "Visa" ? 'selected' : ''}}>Visa</option>
				<option value="MasterCard" {{old('tipo_tarjeta') == "MasterCard" ? 'selected' : ''}}>MasterCard</option><option value="American Express" {{old('tipo_tarjeta') == "American Express" ? 'selected' : ''}}>American Express</option>
			</select>
			`;
			$("#tarjetas").empty();
			if(value == "Tarjeta de crédito"){
				$("#tarjetas").append(html);
			}
			else{
				$("#tarjetas").empty();
			}
		});
		$(document).ready(function(){
			// alert($("#tipo_pago").val() );
			if($("#tipo_pago").val() == "Tarjeta de crédito"){
				$("#tarjetas").append(`
			<label for="">Tarjeta</label>
			<select class="form-control" id="tipo_tarjeta" name="tipo_tarjeta" required="">
				<option value="">Elija una opción</option>
				<option value="Visa" {{old('tipo_tarjeta') == "Visa" ? 'selected' : ''}}>Visa</option>
				<option value="MasterCard" {{old('tipo_tarjeta') == "MasterCard" ? 'selected' : ''}}>MasterCard</option>
				<option value="American Express" {{old('tipo_tarjeta') == "American Express" ? 'selected' : ''}}>American Express</option>
			</select>
			`);
			}
		});
		$("#cuota_periodica").change(function(){
			var cuota_periodica = $("#cuota_periodica").val();
			var subtotal = $("#subtotal").val();
			var total = parseFloat(subtotal) + parseFloat(cuota_periodica);
			$("#total").val(total.toFixed(2));
		});
		// $("#monto_contrato").change(function(){
		// 	var monto = $("#monto").val();
		// 	$("#cuota_periodica").empty();
		// 	$("#cuota_periodica").append($("<option>").attr("value",0.00).text(0.00))
		// 	$.ajax({
		// 		url: "{{ url('api/inscripcion') }}/"+monto+"/{{$cotizacion->plan->id}}/{{$cotizacion->descuento}}",
		// 		method: "GET",
		// 		success:function(result){
		// 			if(result.recibo){
		// 				var recibo = result.recibo
		// 				console.log(recibo);
		// 				$("#insc_inicial").val(recibo.inscripcion_inicial.toFixed(2));
		// 				$("#iva").val(recibo.iva.toFixed(2));
		// 				$("#subtotal").val(recibo.monto_inscripcion_con_iva.toFixed(2));
		// 				$("#cuota_periodica").append($("<option>").attr("value",recibo.cuota_periodica.toFixed(2)).text(recibo.cuota_periodica.toFixed(2)));
		// 				$("#total").val(recibo.monto_inscripcion_con_iva.toFixed(2));

		// 			}

		// 		},
		// 		error:function(err){
		// 			console.error(err);
		// 			$("#insc_inicial").val(0);
		// 		}
		// 	});
		// });
	</script>
@endpush
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
							<select class="form-control" name="monto" id="monto_contrato" required="">
								<option value="">Seleccione una opción</option>
								@foreach (array_unique($contratos) as $contrato)
									<option value="{{$contrato}}">{{number_format($contrato,2)}}</option>
								@endforeach
							</select>
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
								<input type="text" readonly="" class="form-control text-center" name="insc_inicial" value="{{round(($cotizacion->plan->monto_inscripcion_con_iva($cotizacion->monto))-($cotizacion->plan->monto_inscripcion_con_iva($cotizacion->monto)*0.16),2)}}">
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
								<input type="text" readonly="" class="form-control text-center" name="iva" value="{{round($cotizacion->plan->monto_inscripcion_con_iva($cotizacion->monto)*0.16,2)}}">
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
								<input type="text" readonly="" class="form-control text-center" name="subtotal" value="{{round($cotizacion->plan->monto_inscripcion_con_iva($cotizacion->monto),2)}}">
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
									<option value="{{$cotizacion->plan->cotizador($cotizacion->monto)['cuota_periodica_integrante']}}">{{round($cotizacion->plan->cotizador($cotizacion->monto)['cuota_periodica_integrante'],2)}}</option>
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
								<input type="text" readonly="" class="form-control text-center" name="total" id="total" value="{{round($cotizacion->plan->monto_inscripcion_con_iva($cotizacion->monto),2)}}">
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
			if(cuota_periodica != "0.00"){
				$("#total").val("{{round($cotizacion->plan->monto_inscripcion_con_iva($cotizacion->monto)+$cotizacion->plan->cotizador($cotizacion->monto)['cuota_periodica_integrante'],2)}}");
			}
			else{
				$("#total").val("{{round($cotizacion->plan->monto_inscripcion_con_iva($cotizacion->monto),2)}}");
			}
		});
		$("#monto_contrato").change(function(){
			var monto = $("#monto_contrato").val();
			$.ajax({
				url: "{{ url('api/inscripcion') }}/"+monto+"/{{$cotizacion->plan->id}}",
				method: "GET",
				success:function(result){
					console.log(result);

				}
			});
		});
	</script>
@endpush
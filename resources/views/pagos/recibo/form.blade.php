@extends('principal')
@section('content')
	<div class="card card-default">
		<div class="card-header">
			<h4 class="title">
				Recibo Provisional para el pago #{{$pago->folio}} de {{$prospecto->full_name}} (Referencia: {{$pago->referencia}})
			</h4>
		</div>
		<form method="POST" action="{{ route('pagos.submit_recibo_provisional',['pago'=>$pago]) }}">
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
								<input type="text" name="monto" class="form-control" id="monto" required="" value="{{number_format($cotizacion->monto,2)}}" readonly="">
							</div>
							<div class="col-sm-12 col-md-3 col-lg-3 col-xl-3 form-group">
								<label for="">Sucursal</label>
								<input type="text" class="form-control" name="sucursal" value="{{old('sucursal')}}">
							</div>
							<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
								<label for="">Tipo pago</label>
								<input type="text" id="tipo_pago" name="tipo_pago" class="form-control" value="{{$pago->forma}}" readonly="">
							</div>
							@if ($pago->forma == "Tarjeta de Crédito" || $pago->forma == "Tarjeta de Débito")
								{{-- expr --}}
								<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
									<label for="">Tarjeta</label>
									<select class="form-control" id="tipo_tarjeta" name="tipo_tarjeta" required="">
										<option value="">Elija una opción</option>
										<option value="Visa" {{old('tipo_tarjeta') == "Visa" ? 'selected' : ''}}>Visa</option>
										<option value="MasterCard" {{old('tipo_tarjeta') == "MasterCard" ? 'selected' : ''}}>MasterCard</option><option value="American Express" {{old('tipo_tarjeta') == "American Express" ? 'selected' : ''}}>American Express</option>
									</select>
								</div>
							@endif
							@if ($pago->forma == "Tarjeta de Crédito" || $pago->forma == "Tarjeta de Débito" || $pago->forma == "Cheque")
								{{-- expr --}}
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
							@endif
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
									<input type="text" readonly="" class="form-control text-center" name="insc_inicial" value="{{number_format($inscripcion_inicial,2)}}" id="insc_inicial" required="">
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
									<input type="text" readonly="" class="form-control text-center" name="iva" id="iva" min="1" value="{{number_format($iva,2)}}" required="">
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
									<input type="text" readonly="" class="form-control text-center" name="subtotal" id="subtotal" value="{{number_format($monto_inscripcion_con_iva,2)}}" required="">
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
									<input type="text" readonly="" class="form-control text-center" name="cuota_periodica" id="cuota_periodica" value="{{number_format($cuota_periodica,2)}}" required="">
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
									<input type="text" readonly="" class="form-control text-center" name="total" id="total" value="{{number_format($total,2)}}" required="">
								</div>
							</div>
						</div>
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
		
	</script>
@endpush
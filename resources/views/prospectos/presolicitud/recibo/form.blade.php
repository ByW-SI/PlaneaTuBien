@extends('principal')
@section('content')
<div class="card">
	@include('prospectos.presolicitud.navs',['prospectos'=>$prospecto,'presolicitud'=>$presolicitud,'active'=>'Conyuge'])
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
						<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
							<label for="">Sucursal</label>
							<input type="text" class="form-control" name="sucursal" value="{{old('sucursal')}}">
						</div>
						<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
							<label for="">Tipo pago</label>
							<select class="form-control" id="tipo_pago" name="tipo_pago" required="">
								<option value="">Elija una opción</option>
								<option value="Tarjeta de crédito" {{old('tipo_pago') == "Tarjeta de crédito" ? 'selected' : ''}}>Tarjeta de crédito</option>
								<option value="Cheque" {{old('tipo_pago') == "Cheque" ? 'selected' : ''}}>Cheque</option>
							</select>
						</div>
						<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group" id="tarjetas">
						</div>
						<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 form-group">
							<label for="">No.</label>
							<input type="text" class="form-control" name="numero" value="{{old('numero')}}">
						</div>
						<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 form-group">
							<label for="">Banco Emisor</label>
							<input type="text" class="form-control" name="banco" value="{{old('banco')}}">
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
								<input type="number" readonly="" class="form-control text-center" name="insc_inicial" value="{{(float)str_replace(array('.', ','), array('.', ''), $cotizacion->inscripcion)-((float)str_replace(array('.', ','), array('.', ''), $cotizacion->inscripcion)*0.16)}}">
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
								<input type="number" readonly="" class="form-control text-center" name="iva" value="{{((float)str_replace(array('.', ','), array('.', ''), $cotizacion->inscripcion)*0.16)}}">
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
								<input type="number" readonly="" class="form-control text-center" name="subtotal" value="{{(float)str_replace(array('.', ','), array('.', ''), $cotizacion->inscripcion)}}">
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
								<input type="number" readonly="" class="form-control text-center" name="cuota_periodica" value="{{(float)str_replace(array('.', ','), array('.', ''), $cotizacion->mensualidad)}}">
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
								<input type="number" readonly="" class="form-control text-center" name="total" value="{{(float)str_replace(array('.', ','), array('.', ''), $cotizacion->mensualidad)+(float)str_replace(array('.', ','), array('.', ''), $cotizacion->inscripcion)}}">
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
	</script>
@endpush
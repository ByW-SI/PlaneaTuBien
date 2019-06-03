@extends('principal')
@section('content')
	<div class="card card-default">
		<div class="card-header">
			<div class="d-flex bd-highlight">
			  <div class="p-2 w-100 bd-highlight">
				<h4 class="title">
					Recibo Provisional para el pago #{{$pago->folio}} de {{$prospecto->full_name}} (Referencia: {{$pago->referencia}})
				</h4>
			  </div>
			  <div class="p-2 flex-shrink-1 bd-highlight">
			  	<a href="{{ route('pagos.index') }}" class="btn btn-sm btn-primary">Regresar</a>
			  </div>
			</div>
		</div>
		<div class="card-body">
			<div class="row">
				<div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 border">
					<div class="row mt-3">

						<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 form-group">
							<label for="monto">Asesor</label>
							<span class="form-control bg-light">{{$recibo->asesor}}</span>
						</div>
						<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
							<label for="monto">Recibo por </label>
							<span class="form-control bg-light">${{number_format($recibo->monto,2)}}</span>
						</div>
						<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
							<label for="">Sucursal</label>
							<span class="form-control bg-light">{{$recibo->sucursal}}</span>
						</div>
						<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
							<label for="">Tipo pago</label>
							<span class="form-control bg-light">{{$recibo->tipo_pago}}</span>
						</div>
						@if ($pago->forma == "Tarjeta de Crédito" || $pago->forma == "Tarjeta de Débito")
							{{-- expr --}}
							<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
								<label for="">Tarjeta</label>
								<span class="form-control bg-light">{{$recibo->tipo_tarjeta}}</span>
							</div>
						@endif
						@if ($pago->forma == "Tarjeta de Crédito" || $pago->forma == "Tarjeta de Débito" || $pago->forma == "Cheque")
							{{-- expr --}}
							<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 form-group">
								<label for="">No.</label>
								<span class="form-control bg-light">{{$recibo->numero}}</span>
							</div>
							<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 form-group">
								<label for="">Banco Emisor</label>
								<span class="form-control bg-light">{{$recibo->banco}}</span>
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
								<span class="form-control bg-light">{{number_format($recibo->insc_inicial,2)}}</span>
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
								<span class="form-control bg-light">{{number_format($recibo->iva,2)}}</span>
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
								<span class="form-control bg-light">{{number_format($recibo->subtotal,2)}}</span>
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
								<span class="form-control bg-light">{{number_format($recibo->cuota_periodica,2)}}</span>
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
								<span class="form-control bg-light">{{number_format($recibo->total,2)}}</span>

							</div>
						</div>
					</div>
				</div>
				
			</div>
		</div>
		<div class="card-footer">
			
		</div>
	</div>
@endsection

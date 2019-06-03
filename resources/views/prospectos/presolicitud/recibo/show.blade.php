@extends('principal')
@section('content')
<div class="card">
	@include('prospectos.presolicitud.navs',['prospectos'=>$prospecto,'presolicitud'=>$presolicitud,'active'=>'Recibo'])
	<div class="card-body">
		<div class="row">
				<div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 border">
					<div class="row mt-3">

						<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
							<label for="monto">Recibo por </label>
							<span class="form-control">{{$recibo->monto}}</span>
						</div>
						<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
							<label for="">Sucursal</label>
							<span class="form-control">{{$recibo->sucursal}}</span>
						</div>
						<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
							<label for="">Tipo pago</label>
							<span class="form-control">{{$recibo->tipo_pago}}</span>
						</div>
						@if ($recibo->tipo_pago == "Tarjeta de crédito")
							<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
								<label for="">Tarjeta</label>
								<span class="form-control">{{$recibo->tipo_tarjeta}}</span>
							</div>
						@endif
						<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 form-group">
							<label for="">No.</label>
							<span class="form-control">{{$recibo->numero}}</span>
						</div>
						<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 form-group">
							<label for="">Banco Emisor</label>
							<span class="form-control">{{$recibo->banco}}</span>
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
								<span class="form-control text-center">{{number_format($recibo->insc_inicial,2)}}</span>
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
								<span class="form-control text-center">{{number_format($recibo->iva,2)}}</span>
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
								<span class="form-control text-center">{{number_format($recibo->subtotal,2)}}</span>
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
								<span class="form-control text-center">{{number_format($recibo->cuota_periodica,2)}}</span>
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
								<span class="form-control text-center">{{number_format($recibo->total,2)}}</span>
							</div>
						</div>
					</div>
				</div>
				
			</div>
		{{-- <table class="table table-bordered table-striped">
			<thead>
				<tr>
					<th scope="col">Número de contrato</th>
					<th scope="col">Monto</th>
					<th scope="col">Pago</th>
					<th scope="col">No.</th>
					<th scope="col">Banco</th>
					<th scope="col">Sucursal</th>
					<th scope="col">Total</th>
					<th scope="col">Acciones</th>
				</tr>
			</thead>
			<tbody>
				@forelse ($recibos as $recibo)
					<tr>
						<th scope="row">{{$recibo->numero_contrato}}</th>
						<td>${{number_format($recibo->contrato->monto,2)}}</td>
						<td>{{$recibo->tipo_pago}}</td>
						<td>{{$recibo->numero}}</td>
						<td>{{$recibo->banco}}</td>
						<td>{{$recibo->sucursal}}</td>
						<td>${{number_format($recibo->total,2)}}</td>
						<td>
							<div class="d-flex justify-content-center mb-3">
								<a href="{{ route('prospectos.presolicitud.recibos.pdf',['prospecto'=>$prospecto,'presolicitud'=>$presolicitud,'recibo'=>$recibo]) }}" class="btn btn-info btn-sm mr-3">
								Imprimir Presolicitud</a>
								
						      	<a href="{{ route('prospectos.presolicitud.recibos.contrato',['prospecto'=>$prospecto,'presolicitud'=>$presolicitud,'recibo'=>$recibo]) }}" class="btn btn-info btn-sm mr-3">Contrato</a>
						      	
						      	<a href="{{ route('prospectos.presolicitud.recibos.declaracion_salud',['prospecto'=>$prospecto,'presolicitud'=>$presolicitud,'recibo'=>$recibo]) }}" class="btn btn-info btn-sm mr-3">Declaración de Salud</a>
						      	<a href="{{ route('recibos.checklist.index',['recibo'=>$recibo]) }}" class="btn btn-info btn-sm mr-3">Checklist</a>
							</div>
							<div class="d-flex justify-content-center mb-3">
						      	<a href="{{ route('recibos.domiciliacion.index',['recibo'=>$recibo]) }}" class="btn btn-info btn-sm mr-3">Formato de Domiciliación</a>
						      	<a href="{{ route('prospectos.presolicitud.recibos.ficha_deposito',['prospecto'=>$prospecto,'presolicitud'=>$presolicitud,'recibo'=>$recibo]) }}" class="btn btn-info btn-sm mr-3">Ficha de Deposito</a>
					      	
					      		<a href="{{ route('prospectos.presolicitud.recibos.anexo_tanda',['prospecto'=>$prospecto,'presolicitud'=>$presolicitud,'recibo'=>$recibo]) }}" class="btn btn-info btn-sm mr-3">Anexo {{$perfil->cotizacion->plan->nombre}}</a>
					      		<a href="{{ route('prospectos.presolicitud.recibos.anexo_tanda_clasica',['prospecto'=>$prospecto,'presolicitud'=>$presolicitud,'recibo'=>$recibo]) }}" class="btn btn-info btn-sm mr-3">Anexo Tanda Clasica</a>
					      		<a href="{{ route('prospectos.presolicitud.recibos.anexo_inscripcion_diferida',['prospecto'=>$prospecto,'presolicitud'=>$presolicitud,'recibo'=>$recibo]) }}" class="btn btn-info btn-sm mr-3">Anexo Inscripcion Diferida</a>
							</div>
						</td>
					</tr>
				@empty
				@endforelse
			</tbody>
		</table> --}}
	</div>
	@include('prospectos.presolicitud.footer',['presolicitud'=>$presolicitud])
	

</div>
@endsection
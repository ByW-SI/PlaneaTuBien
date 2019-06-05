@extends('principal')
@section('content')
<div class="card">
	@include('prospectos.presolicitud.navs',['prospectos'=>$prospecto,'presolicitud'=>$presolicitud,'active'=>'Recibo'])
	<div class="card-body">
		<div class="d-flex justify-content-around mb-3">
			{{-- <a href="{{ route('prospectos.presolicitud.recibos.create',['prospecto'=>$prospecto,'presolicitud'=>$presolicitud]) }}" class="btn btn-primary">Crear Recibo Provisional</a> --}}
		</div>
		<table class="table table-bordered table-striped">
			<thead>
				<tr>
					<th scope="col">#</th>
					<th scope="col">Monto Total</th>
					<th scope="col">Identificación</th>
					<th scope="col">Comprobante</th>
					<th scope="col">Forma de pago</th>
					<th scope="col">Referencia</th>
					<th scope="col">Folio</th>
					<th scope="col">Acciones</th>
				</tr>
			</thead>
			<tbody>
				@forelse ($pagos as $key=>$pago)
					<tr>
						<th scope="row">{{$key+1}}</th>
						<td>${{number_format($pago->monto,2)}}</td>
						<td>{{$pago->identificacion}}</td>
						<td>{{$pago->comprobante}}</td>
						<td>{{$pago->forma}}</td>
						<td>{{$pago->referencia}}</td>
						<td>{{$pago->folio}}</td>
						<td>
							<div class="d-flex justify-content-center mb-3">
								@if ($pago->recibo)
									<a href="{{ route('prospectos.presolicitud.recibos.pdf',['prospecto'=>$prospecto,'presolicitud'=>$presolicitud,'recibo'=>$pago->recibo]) }}" class="btn btn-info btn-sm mr-3">
										Imprimir Presolicitud
									</a>
								@endif
							</div>
						</td>
					</tr>
				@empty
					@if($presolicitud->cotizacion()->tipo_inscripcion == '0_inscripcion_inicial' && $pagos->isEmpty())
						<tr>
						<th scope="row">N/A</th>
						<td>N/A</td>
						<td>N/A</td>
						<td>N/A</td>
						<td>N/A</td>
						<td>N/A</td>
						<td>N/A</td>
						<td>
							<div class="d-flex justify-content-center mb-3">
								
								<a href="{{ route('prospectos.presolicitud.recibos.pdf',['prospecto'=>$prospecto,'presolicitud'=>$presolicitud,'recibo'=>'insc_0']) }}" class="btn btn-info btn-sm mr-3">
									Imprimir Presolicitud
								</a>
							
							</div>
						</td>
					</tr>
					@endif
				@endforelse
			</tbody>
		</table>
	</div>
	@include('prospectos.presolicitud.footer',['presolicitud'=>$presolicitud])
	

</div>
@endsection
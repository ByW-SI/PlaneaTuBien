@extends('principal')
@section('content')
<div class="card">
	@include('prospectos.presolicitud.navs',['prospectos'=>$prospecto,'presolicitud'=>$presolicitud,'active'=>'Recibo'])
	<div class="card-body">
		<div class="d-flex justify-content-around mb-3">
			<a href="{{ route('prospectos.presolicitud.recibos.create',['prospecto'=>$prospecto,'presolicitud'=>$presolicitud]) }}" class="btn btn-primary">Crear Recibo Provisional</a>
		</div>
		<table class="table table-bordered table-striped">
			<thead>
				<tr>
					<th scope="col">#</th>
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
				@forelse ($presolicitud->recibos as $key=>$recibo)
					<tr>
						<th scope="row">{{$key+1}}</th>
						<td>${{number_format($recibo->monto,2)}}</td>
						<td>{{$recibo->tipo_pago}}</td>
						<td>{{$recibo->numero}}</td>
						<td>{{$recibo->banco}}</td>
						<td>{{$recibo->sucursal}}</td>
						<td>${{number_format($recibo->total,2)}}</td>
						<td>
							<div class="d-flex justify-content-center mb-3">
								<a href="{{ route('prospectos.presolicitud.recibos.pdf',['prospecto'=>$prospecto,'presolicitud'=>$presolicitud,'recibo'=>$recibo]) }}" class="btn btn-info btn-sm mr-3">
								Imprimir Presolicitud</a>
							</div>
						</td>
					</tr>
				@empty
				@endforelse
			</tbody>
		</table>
	</div>
	@include('prospectos.presolicitud.footer',['presolicitud'=>$presolicitud])
	

</div>
@endsection
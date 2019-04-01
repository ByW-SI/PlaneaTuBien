@extends('principal')
@section('content')
<div class="card">
	@include('prospectos.presolicitud.navs',['prospectos'=>$prospecto,'presolicitud'=>$presolicitud,'active'=>'Recibo'])
	<div class="card-body">
		<div class="d-flex justify-content-center mb-3">
			<a href="{{ route('prospectos.presolicitud.recibos.create',['prospecto'=>$prospecto,'presolicitud'=>$presolicitud]) }}" class="btn btn-success">Crear recibo</a>
		</div>
		<table class="table table-bordered table-striped">
			<thead>
				<tr>
					<th scope="col">Número de contrato</th>
					<th scope="col">Pago</th>
					<th scope="col">No.</th>
					<th scope="col">Banco</th>
					<th scope="col">Sucursal</th>
					<th scope="col">Total</th>
					<th scope="col">Acciones</th>
				</tr>
			</thead>
			<tbody>
				@forelse ($presolicitud->recibos as $recibo)
					<tr>
						<th scope="row">{{$recibo->numero_contrato}}</th>
						<td>{{$recibo->tipo_pago}}</td>
						<td>{{$recibo->numero}}</td>
						<td>{{$recibo->banco}}</td>
						<td>{{$recibo->sucursal}}</td>
						<td>${{number_format($recibo->total,2)}}</td>
						<td>
							<div class="d-flex justify-content-center">
								<a href="{{ route('prospectos.presolicitud.recibos.pdf',['prospecto'=>$prospecto,'presolicitud'=>$presolicitud,'recibo'=>$recibo]) }}" class="btn btn-success">Imprimir Presolicitud</a>
							</div>
						</td>
					</tr>
				@empty
					{{-- empty expr --}}
				@endforelse
			</tbody>
		</table>
	</div>

</div>
@endsection
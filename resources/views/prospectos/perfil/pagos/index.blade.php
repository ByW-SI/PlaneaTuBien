@extends('principal')
@section('content')

<div class="card">
	<div class="card-header">
		<div class="d-flex justify-content-between">
			<h4>Pagos:</h4>   
        	<a href="{{ route('prospectos.perfil.pdf',['prospecto'=>$prospecto]) }}" class="btn btn-success">Imprimir perfil</a>
			<a href="{{ route('prospectos.perfil.datos_personal.index',['prospecto'=>$prospecto]) }}" class="btn btn-success">Ver perfil</a>
			{{-- {{dd($cotizacion->pagos->count())}} --}}
			@if ($cotizacion->liberar)
        		<a href="{{ route('prospectos.presolicitud.index',['prospecto'=>$prospecto]) }}" class="btn btn-success">Presolicitud</a>
        	@endif
        </div>
	</div>
	<div class="card-body">
		@if ($cotizacion->inscripcionFaltante() > 0)
			<div class="d-flex justify-content-center mb-3">
				<a href="{{ route('prospectos.cotizacions.pagos.create',['prospecto'=>$prospecto,'cotizacion'=>$cotizacion]) }}" class="btn btn-info"><i class="fas fa-money-check-alt"></i> Nuevo Pago</a>
			</div>
		@endif
		<div class="row">
			<div class="col-12">
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th class="text-center" scope="col">Folio</th>
							<th class="text-center" scope="col">Forma de pago</th>
							<th class="text-center" scope="col">Folio de cotización</th>
							<th class="text-center" scope="col">Estado del pago</th>
							<th class="text-center" scope="col">Aprobar</th>
							<th class="text-center" scope="col">Monto total a pagar</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							@forelse ($cotizacion->pago_inscripcions as $pago)
								<tr class="{{$pago->status == 'registrado' ? 'table-warning' : ($pago->status == 'rechazado' ? 'table-danger' : 'table-success')}}">
									<th scope="row">{{$pago->folio}}</th>
									<td class="text-center">{{$pago->forma}}</td>
									<td class="text-center">{{$pago->referencia}}</td>
									<td class="text-center">{{ucwords($pago->status)}}</td>
									<td class="text-center">
										@if ($pago->status == 'registrado')
										<form action="{{route('aprobar.pago', ['id'=>$pago->id])}}" method="POST">
											@csrf
											<button type="submit" class="btn btn-success">Aprobar</button>
										</form>
										@endif
									</td>
									<td class="text-center">${{number_format($pago->monto,2)}}</td>
								</tr>
							@empty
								<div class="alert alert-danger" role="alert">
								No tienes ningún pago registrado. Haz <a href="{{ route('prospectos.cotizacions.pagos.create',['prospecto'=>$prospecto,'cotizacion'=>$cotizacion]) }}" class="alert-link">click aquí</a> para realizar uno.
							</div>
							@endforelse
							<tr>
								<th colspan="5" class="text-center">Inscripción Total</th>
								<th class="text-center">${{number_format($cotizacion->inscripcion_total,2)}}</th>
							</tr>
							<tr>
								<th colspan="5" class="text-center">Cuota Periodica Total:</th>
								<th class="text-center">${{number_format($cotizacion->cuota_periodica_total,2)}}</th>
							</tr>
							@if ($cotizacion->inscripcionFaltante() >= 0)
								<tr>
									<th colspan="5" class="text-center">Falta</th>
									<th class="text-center">${{number_format($cotizacion->inscripcionFaltante(),2)}}</th>
								</tr>
							@else
								<tr>
									<th colspan="5" class="text-center">Saldo a favor</th>
									<th class="text-center">${{number_format($cotizacion->inscripcionFaltante()*-1,2)}}</th>
								</tr>
							@endif
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection
@push('scripts')
	<script type="text/javascript">
		function cambiarstatus(id) {
			swal({
			  title: "¿Desea cambiar este status?",
			  text: "Una vez cambiado, ya no podrás actualizarlo",
			  icon: "warning",
			  buttons: true,
			  dangerMode: true,
			})
			.then((willDelete) => {
			  if (willDelete) {
			    swal("Eliminando", {
			      icon: "info",
			    });
			    $("#estatus"+id).submit();

			  } else {
			    swal("¡Cancelado!");
			    $("#selectStatus"+id).val('registrado');
			  }
			});
		}
	</script>
@endpush
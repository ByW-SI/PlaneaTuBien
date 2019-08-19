@extends('layouts.cliente')
@section('content')
<div class="card">
	<div class="card-header">
		Historial de Pagos de {{$cliente->nombre." ".$cliente->paterno." ".$cliente->materno}}
	</div>
	<div class="accordion" id="accordionExample">
	@foreach ($cliente->contratos as $key=>$contrato)
	 @if ($contrato->checklist && $contrato->checklist->status)
	  <div class="card">
	    <div class="card-header" id="heading{{ $contrato->id }}">
	      <h2 class="mb-0">
	        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse{{ $contrato->id }}" aria-expanded="true" aria-controls="collapse{{ $contrato->id }}">
	          <h5>
				Contrato de folio: @php(printf('%03d', $contrato->grupo->id)){{$contrato->numero_contrato}} con valor de {{number_format($contrato->monto,2)}}
			</h5>
	        </button>
	      </h2>
	    </div>

	    <div id="collapse{{ $contrato->id }}" class="collapse " aria-labelledby="heading{{ $contrato->id }}" data-parent="#accordionExample">
	        <div class="col-12">
                <table class="table table-bordered table-striped text-center">
					<thead>
						<tr>
							<th scope="col">Fecha de Pago</th>
							<th scope="col">Monto</th>
							<th scope="col">Referencia</th>
							<th scope="col">Estado del Pago</th>
						</tr>
					</thead>
					<tbody>
						@if(isset($pagos[$contrato->id]))
						@foreach($pagos[$contrato->id] as $pago)
						<tr>
							<td>{{ $pago->fecha_pago }}</td>
							<td>{{ number_format($pago->monto, 2) }}</td>
							<td>{{ $pago->referencia }}</td>
							@if($pago->status_id == 1)
								<td><p class="alert-success"><b>Aprobado</b></p></td>
							@elseif($pago->status_id == 2)
								<td><p class="alert-warning"><b>Validando</b></p></td>
							@elseif($pago->status_id == 3)
								<td><p class="alert-success"><b>Rechazado</b></p></td>
							@endif
						</tr>
						@endforeach
						@endif
					</tbody>
				</table>
            </div>
	    </div>
	  </div>
	  @endif
	@endforeach
	</div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>    
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script>
	$(document).ready(function() {
		console.log($('#corrdia'));
	    $('#corrida').DataTable();
	} );
</script>
@endsection
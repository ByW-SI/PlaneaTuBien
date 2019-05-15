@extends('layouts.cliente')
@section('content')
<div class="card">
	<div class="card-header">
		PAGA TU MENSUALIDAD
	</div>
	<form action="#" class="form-inline">
		<div class="card-body">
			<table class="table table-bordered table-striped">
				<thead>
					<tr>
						<th class="text-center" scope="col">Seleccionar</th>
						<th class="text-center" scope="col">Contrato</th>
						<th class="text-center" scope="col">Monto</th>
						<th class="text-center" scope="col">Mensualidad</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($cliente->recibos as $recibo)
        				{{-- @if ($recibo->checklist && $recibo->checklist->status) --}}
							<tr>
								<td class="text-center">
									<label for="recibo{{$recibo->id}}"><input type="checkbox" name="recibo[]" id="recibo{{$recibo->id}}" value="{{$plan->cuota_periodica_integrante($recibo->monto)}}"></label>
								</td>
								<td class="text-center">
									<label for="recibo{{$recibo->id}}">
										{{$recibo->clave.$recibo->contrato->numero_contrato}}
									</label>
								</td>
								<td class="text-center">
									<label for="recibo{{$recibo->id}}">
										${{number_format($recibo->contrato->monto,2)}}
									</label>
								</td>
								<td class="text-center">
									<label for="recibo{{$recibo->id}}">
										${{number_format($plan->cuota_periodica_integrante($recibo->monto),2)}}
									</label>
								</td>
							</tr>
        				{{-- @endif --}}
    				@endforeach
    				<tr>
    					<td class="text-center" colspan="3">Total</td>
    					<td class="text-center" id="total">$0.00</td>
    				</tr>
				</tbody>
			</table>
			<div class="d-flex justify-content-center">
				<button class="btn btn-success" type="submit"><i class="far fa-credit-card"> PAGAR</i></button>
			</div>
		</div>
	</form>
</div>
@endsection
@push('scripts')
	<script type="text/javascript">
		$("input[name='recibo[]']").click(function () {
			setTotal();
		});
		function setTotal() {
			var total = 0.00;
			$("input[name='recibo[]']:checked").each(
			    function() {
			    	total += parseFloat($(this).val());
			        // alert("El checkbox con valor " + $(this).val() + " está seleccionado"+total);
			    }
			);
    		$("#total").text('$'+total.toFixed(2));
		}
	</script>
@endpush

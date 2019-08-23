@extends('layouts.cliente')
@section('content')
<div class="card">
	<div class="card-header">
		Confirmar Pago
	</div>
	
	<form action="{{-- {{ route('Cliente-pagos.store') }} --}}" method="POST" class="form-inline">
		@csrf
		<div class="card-body col-6 offset-3">
			<h4 class="text-center m-3">Contratos a pagar:</h4>
			<div class="row">
				<div class="col-6 offset-3">
				 	<div class="form-check form-check-inline">
					  <input class="form-check-input" type="radio" name="opcion" id="tarjeta" value="tarjeta">
					  <label class="form-check-label" for="tarjeta">
					    Tarjeta de Crédito/ Débito
					  </label>
					</div>
					<div class="form-check form-check-inline">
					  <input class="form-check-input" type="radio" name="opcion" id="deposito" value="deposito">
					  <label class="form-check-label" for="deposito">
					    Depósito o transferencia
					  </label>
					</div>
				</div>
			</div>
			<div class="row" id="TC-TD" style="display: none;">
				<div class="col-11 offset-1">
					<div class="card my-3 p-3" style="width: 100%;">
					<div class="card-body">
						<table class="table">
							<thead>
								<tr>
									<th>Contrato</th>
									<th>Monto</th>
									<th>Referencia</th>
								</tr>
							</thead>
							<tbody>
							@foreach($cliente->contratos as $contrato)
							@if(isset($montos[$contrato->numero_contrato]))
								<tr>
									<td>
										@php(printf('%03d', $contrato->grupo->id)){{ $contrato->numero_contrato }}
										<input type="hidden" name="contrato[]" value="{{ $contrato->id }}">
									</td>
									<td>
										{{ number_format($montos[$contrato->id],2) }}
										<input type="hidden" name="monto[]" value="{{ $montos[$contrato->id] }}">
									</td>
									<td>{{ $referencias[$contrato->id] }}</td>
									<input type="hidden" name="referencia[]" value="{{ $referencias[$contrato->numero_contrato] }}">
								</tr>
							@endif
							@endforeach
							<tr>
								<td>Total</td>
								<td>
									<div class="input-group mb-3">
									  <div class="input-group-prepend">
									    <span class="input-group-text" id="basic-addon1">$</span>
									  </div>
									  <input type="text" class="form-control"  readonly="" name="total" id="total" value="{{ $total }}">
									</div>
								</td>
							</tr>
							</tbody>
						</table>
						<div class="d-flex justify-content-center">
							<button class="btn btn-success" type="submit"><i class="far fa-credit-card"> PAGAR</i></button>
						</div>
					</div>
					</div>
				</div>
			</div>
			<div class="row" id="div-deposito" style="display: none;">
				<div class="col-12">
					<div class="card my-5" style="width: 100%;">
					  <div class="card-body">
					    <h5 class="card-title">Depósito</h5>
					    <p class="card-text">Favor de realizar su pago en Bancomer con su referencia y al finalizar subir al sistema su váucher.</p>
					    <div class="d-flex justify-content-center">
							<a class="btn btn-primary" href="{{ route('confirmardeposito') }}"><i class="fas fa-file-upload"></i> Confirmar Pago</a>
						</div>
					  </div>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>
@endsection
@push('scripts')
	<script type="text/javascript">
		$(document).ready(function() {
			$('input[name=opcion]').click(function() {
				console.log($(this).val());
				if ($(this).val() === 'tarjeta'){
					$('#TC-TD').prop('style', '');
					$('#div-deposito').prop('style', 'display:none;');
				}
				else{
					$('#TC-TD').prop('style', 'display:none;');
					$('#div-deposito').prop('style', '');
				}
			});
		});
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

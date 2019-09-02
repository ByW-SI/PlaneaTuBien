<div class="card">
	<div class="card-header">
		Historial crediticio:
	</div>
	<div class="card-body">
		<div class="form-group row">
			<div class="col-6">
				<label>¿Tarjeta debito o Cuenta de Ahorro?:</label>
				<label class="form-control" readonly="">
					{{ $credito && $credito->tarjeta_debito ? "Si" : "No" }}
				</label>
			</div>
			@if ($credito && $credito->tarjeta_debito)
				<div class="col-6">
					<label>Número de tarjetas:</label>
	    			
					<label class="form-control" readonly="">
						{{ $credito->numero_tarjeta_debito }}
					</label>
				</div>
				<div class="col-sm-12">
					<h4>Tarjetas de debito o Cuenta de Ahorro:</h4>
				</div>
				@if(json_decode($credito->tarjetas_debito))
				@foreach (json_decode($credito->tarjetas_debito) as $tarjeta)
					<div class="col-sm-4">
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text">
									<i class="far fa-credit-card"></i>
								</span>
							</div>
							<span class="form-control">
								{{$tarjeta}}
							</span>
						</div>
					</div>
				@endforeach
				@endif
				<div class="col-6">
					<label>Buró de crédito:</label>
					<label class="form-control" readonly="">
						{{ $credito->en_buro_credito ? "Si" : "No" }}
					</label>
				</div>
				@if ($credito->en_buro_credito)
				<div class="col-sm-6">
					<label class="form-control mt-4" readonly="">
						{{ $credito->buro_credito }}
					</label>
				</div>
				@endif
			@endif
		</div>
		<div class="form-group row">
			<div class="col-6">
				<label>¿Tarjeta de credito?:</label>
				<label class="form-control" readonly="">
					{{ $credito && $credito->tarjeta_credito ? "Si" : "No" }}
				</label>
			</div>
			@if ($credito && $credito->tarjeta_credito)
			<div class="col-6">
				<label>Tarjetas</label>
				<span class="form-control" readonly=>{{$credito->numero_tarjeta_credito}}</span>
			</div>
			<div class="col-sm-12">
				<h4>Tarjetas de credito:</h4>
			</div>
			@if(json_decode($credito->tarjetas_credito))
			@foreach (json_decode($credito->tarjetas_credito) as $tarjeta_cred)
				<div class="col-sm-4">
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text">
								<i class="fas fa-credit-card"></i>
							</span>
						</div>
						<span class="form-control">
							{{$tarjeta_cred}}
						</span>
					</div>
				</div>
			@endforeach
			@endif
			<div class="offset-sm-1 col-sm-11">

				@if ($credito->tc_bancomer)

				<div class="form-check form-check-inline mt-1">
					<label class="form-check-label" for="tc_bancomer"><img src="{{ asset('img/bbva.png') }}" width="150" height="30"></label>
				</div>

				@endif

				@if ($credito->tc_santander)

				<div class="form-check form-check-inline mt-1">
					<label class="form-check-label" for="tc_santander"><img src="{{ asset('img/santander.png') }}" width="150" height="30"></label>
				</div>
				
				@endif

				@if ($credito->tc_hsbc)

				<div class="form-check form-check-inline mt-1">
					<label class="form-check-label" for="tc_hsbc"><img src="{{ asset('img/hsbc.png') }}" width="150" height="30"></label>
				</div>

				
				@endif

				@if ($credito->tc_scotiabank)

				<div class="form-check form-check-inline mt-1">
					<label class="form-check-label" for="tc_scotiabank"><img src="{{ asset('img/scotiabank.png') }}" width="150" height="30"></label>
				</div>
				
				@endif

				@if ($credito->tc_amex)

				<div class="form-check form-check-inline mt-1">
					<label class="form-check-label" for="tc_amex"><img src="{{ asset('img/amex.png') }}" width="100" height="30"></label>
				</div>
				
				@endif

				@if ($credito->tc_banamex)

				<div class="form-check form-check-inline mt-1">
					<label class="form-check-label" for="tc_banamex"><img src="{{ asset('img/banamex.png') }}" width="150" height="30"></label>
				</div>
				
				@endif

				@if ($credito->tc_banorte)

				<div class="form-check form-check-inline mt-1">
					<label class="form-check-label" for="tc_banorte"><img src="{{ asset('img/banorte.png') }}" width="150" height="30"></label>
				</div>
						
				
				@endif

			</div>
			<div class="col-6">
				<label>Límite de Credito:</label>
				<label class="form-control" readonly="">
					{{ $credito->limite_credito }}
				</label>
			</div>
			@endif
			<div class="col-6">
				<label>Destino:</label>
				<label class="form-control" readonly="">
					{{ $credito ? $credito->destino_1 : "--"}}
				</label>
			</div>
			<div class="col-6 mt-3">
				<div class="input-group mt-3">
					<div class="input-group-prepend">
						<span class="input-group-text" id="basic-addon1">$</span>
					</div>
					<label class="form-control" readonly="">
						@if($credito)
						{{number_format($credito->monto_destino_1,2)}}
						@else
							--
						@endif
					</label>
					<div class="input-group-append">
						<span class="input-group-text" id="basic-addon1">{{$credito ? $credito->tipo_destino_1 : "--"}}</span>
					</div>
				</div>
			</div>
			<div class="col-6">
				<label>Destino:</label>
				<label class="form-control" readonly="">
					{{$credito ? $credito->destino_2 : "--"}}
				</label>
			</div>
			<div class="col-6 mt-3">
				<div class="input-group mt-3">
					<div class="input-group-prepend">
						<span class="input-group-text" id="basic-addon1">$</span>
					</div>
					<label class="form-control" readonly="">
						@if($credito)
							{{number_format($credito->monto_destino_2,2)}}
						@else
							--
						@endif
					</label>
					<div class="input-group-append">
						<span class="input-group-text" id="basic-addon1">{{$credito ? $credito->tipo_destino_2 : "--"}}</span>
					</div>
				</div>
			</div>
			<div class="col-6">
				<label>Destino:</label>
				<label class="form-control" readonly="">
					{{ $credito ? $credito->destino_3 : "--"}}
				</label>
			</div>
			<div class="col-6 mt-3">
				<div class="input-group mt-3">
					<div class="input-group-prepend">
						<span class="input-group-text" id="basic-addon1">$</span>
					</div>
					<label class="form-control" readonly="">
						@if($credito)
							{{number_format($credito->monto_destino_3,2)}}
						@else
							--
						@endif
					</label>
					<div class="input-group-append">
						<span class="input-group-text" id="basic-addon1">{{$credito ? $credito->tipo_destino_3 : "--"}}</span>
					</div>
				</div>
			</div>
			<div class="col-6">
				<label>Calificación del cliente:</label>
				<label class="form-control" readonly="">
					@if($credito)
					{{$credito->calificacion_credito}}
					@else
						--
					@endif
				</label>
			</div>
			<div class="col-6">
				<label>Descripción de calificación:</label>
				<textarea class="form-control" readonly="">{{$credito ? $credito->descripcion_calificacion : "--"}}</textarea>
			</div>
		</div>
	</div>
	<div class="card-footer">
		<div class="d-flex justify-content-center">
			<a href="#" class="btn btn-success">Editar historial crediticio</a>
		</div>
	</div>
</div>
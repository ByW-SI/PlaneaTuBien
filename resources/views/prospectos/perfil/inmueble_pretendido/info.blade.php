<div class="card">
	<div class="card-header">
		Inmueble pretendido:
	</div>
	<div class="card-body">
		<div class="form-group row">
			<div class="col-6">
				<label>Tipo de inmueble pretendido:</label>
    			<label class="form-control" readonly="">
					{{$inmueble ? $inmueble->tipo_inmueble : "--"}}
				</label>
			</div>
			<div class="col-6">
				<label>Precio aproximado:</label>
    			<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text" id="basic-addon1">$</span>
					</div>
					<label class="form-control" readonly="">
						@if($inmueble)
							{{number_format($inmueble->precio_aprox,2)}}
						@else
							--
						@endif
					</label>
				</div>
			</div>
			<div class="col-6">
				<label>Area aproximado del inmueble:</label>
    			<div class="input-group">
					<label class="form-control" readonly="">
						{{$inmueble ? $inmueble->area_inmueble : "--"}}
					</label>
					<div class="input-group-append">
						<span class="input-group-text" id="basic-addon1">m²</span>
					</div>
				</div>
			</div>
			<div class="col-6">
				<label>Estado: {{ $inmueble->estado }} </label>
    			<label class="form-control" readonly="">
    				@if($inmueble->estado)
							{{$inmueble->estado}}
						@else
							--
						@endif
				</label>
			</div>
			<div class="col-6">
				<label>Colonia:</label>
    			<label class="form-control" readonly="">
					{{$inmueble ? $inmueble->colonia : "--"}}
				</label>
			</div>
			<div class="col-6">
				<label>Recamaras:</label>
    			<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text" id="basic-addon1">#</span>
					</div>
					<label class="form-control" readonly="">
						{{$inmueble ? $inmueble->recamara : "--"}}
					</label>
				</div>
			</div>
			<div class="col-6">
				<label>Baños:</label>
    			<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text" id="basic-addon1">#</span>
					</div>
					<label class="form-control" readonly="">
						{{$inmueble ? $inmueble->banio : "--"}}
					</label>
				</div>
			</div>
			<div class="col-6">
				<label>Lugares de Estacionamiento:</label>
    			<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text" id="basic-addon1">#</span>
					</div>
					<label class="form-control" readonly="">
						{{$inmueble ? $inmueble->estacionamiento : "--"}}
					</label>
				</div>
			</div>
			<div class="col-6">
				<label>Jardin:</label>
    			<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text" id="basic-addon1">#</span>
					</div>
					<label class="form-control" readonly="">
						{{$inmueble ? $inmueble->jardin : "--"}}
					</label>
				</div>
			</div>
			<div class="col-6">
				<label>Gastos Notariales:</label>
    			<label class="form-control" readonly="">
					{{$inmueble ? $inmueble->gastos_notariales : "--"}}
				</label>
			</div>
			<div class="col-6">
				<label>Monto a contratar:</label>
    			<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text" id="basic-addon1">$</span>
					</div>
					<label class="form-control" readonly="">
						@if($inmueble)
							{{number_format($inmueble->monto_contratar,2)}}
						@else
							--
						@endif
					</label>
				</div>
			</div>
			<div class="col-6">
				<label>¿Cuánto tiempo ha pensado en esta compra?:</label>
				<label class="form-control" readonly="">
					{{$inmueble ? $inmueble->tiempo_decision : "--"}}
				</label>
			</div>
			<div class="col-6">
				<label>¿Cuánta prioridad le da a esta meta?:</label>
				<textarea class="form-control" readonly="">{{$inmueble ? $inmueble->prioridad : "--"}}</textarea>
			</div>
			<div class="col-6">
				<label>¿La decisión de cumplir su meta depende de alguien más?:</label>
				@if($inmueble)
					<textarea class="form-control" readonly="">{{$inmueble->desicion_propia ? "Si, ".$inmueble->toma_desicion : "No"}}</textarea>
				@else
					<textarea class="form-control" readonly="">--</textarea>
				@endif
			</div>
			<div class="col-6">
				<label>¿Porqué no ha logrado su meta?:</label>
				<textarea class="form-control" readonly="">{{$inmueble ? $inmueble->lograr_meta : "--"}}</textarea>
			</div>
			<div class="col-6">
				<label>Si el día de hoy le ofrecemos una propuesta de esquema de financiamiento adaptada a sus necesidades y posibilidades ¿Lo tomaría? :</label>
				@if($inmueble)
					<textarea class="form-control" readonly="">{{$inmueble->tomaria_desicion ? "Si" : "No "}} {{$inmueble->motivo_tomaria_desicion}}</textarea>
				@else
					<textarea class="form-control" readonly="">--</textarea>
				@endif
			</div>
			<div class="col-6">
				<label>Medio por el cuál se enteró de nosotros: </label>
				<label class="form-control" readonly="">{{$inmueble ? $inmueble->medio_entero : "--"}}</label>
			</div>
			<div class="col-12">
				<label>Observaciones: </label>
				<textarea class="form-control" readonly="">{{ $inmueble  ? $inmueble->observaciones : "--"}}</textarea>
			</div>
		</div>
	</div>
	<div class="card-footer">
		<div class="d-flex justify-content-center">
			<a href="{{ route('prospectos.perfil.inmueble_pretendido.edit',['prospecto'=>$prospecto,'inmueble'=>$inmueble]) }}" class="btn btn-success">Editar Inmueble</a>
		</div>
	</div>
</div>
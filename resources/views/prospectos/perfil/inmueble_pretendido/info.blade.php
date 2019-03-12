<div class="card">
	<div class="card-header">
		Inmueble pretendido:
	</div>
	<div class="card-body">
		<div class="form-group row">
			<div class="col-6">
				<label>Tipo de inmueble pretendido:</label>
    			<label class="form-control" readonly="">
					{{$inmueble->tipo_inmueble}}
				</label>
			</div>
			<div class="col-6">
				<label>Precio aproximado:</label>
    			<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text" id="basic-addon1">$</span>
					</div>
					<label class="form-control" readonly="">
						{{number_format($inmueble->precio_aprox,2)}}
					</label>
				</div>
			</div>
			<div class="col-6">
				<label>Area aproximado del inmueble:</label>
    			<div class="input-group">
					<label class="form-control" readonly="">
						{{$inmueble->area_inmueble}}
					</label>
					<div class="input-group-append">
						<span class="input-group-text" id="basic-addon1">m²</span>
					</div>
				</div>
			</div>
			<div class="col-6">
				<label>Estado:</label>
    			<label class="form-control" readonly="">
					{{$inmueble->estado}}
				</label>
			</div>
			<div class="col-6">
				<label>Colonia:</label>
    			<label class="form-control" readonly="">
					{{$inmueble->colonia}}
				</label>
			</div>
			<div class="col-6">
				<label>Recamaras:</label>
    			<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text" id="basic-addon1">#</span>
					</div>
					<label class="form-control" readonly="">
						{{$inmueble->recamara}}
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
						{{$inmueble->banio}}
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
						{{$inmueble->estacionamiento}}
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
						{{$inmueble->jardin}}
					</label>
				</div>
			</div>
			<div class="col-6">
				<label>Gastos Notariales:</label>
    			<label class="form-control" readonly="">
					{{$inmueble->gastos_notariales}}
				</label>
			</div>
			<div class="col-6">
				<label>Monto a contratar:</label>
    			<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text" id="basic-addon1">$</span>
					</div>
					<label class="form-control" readonly="">
						{{number_format($inmueble->monto_contratar,2)}}
					</label>
				</div>
			</div>
			<div class="col-6">
				<label>¿Cuánto tiempo ha pensado en esta compra?:</label>
				<label class="form-control" readonly="">
					{{$inmueble->tiempo_decision}}
				</label>
			</div>
			<div class="col-6">
				<label>¿Cuánta prioridad le da a esta meta?:</label>
				<textarea class="form-control" readonly="">{{$inmueble->prioridad}}</textarea>
			</div>
			<div class="col-6">
				<label>¿La decisión de cumplir su meta depende de alguien más?:</label>
				<textarea class="form-control" readonly="">{{$inmueble->desicion_propia ? "Si, ".$inmueble->toma_desicion : "No"}}</textarea>
			</div>
			<div class="col-6">
				<label>¿Porqué no ha logrado su meta?:</label>
				<textarea class="form-control" readonly="">{{$inmueble->lograr_meta}}</textarea>
			</div>
			<div class="col-6">
				<label>Si el día de hoy le ofrecemos una propuesta de esquema de financiamiento adaptada a sus necesidades y posibilidades ¿Lo tomaría? :</label>
				<textarea class="form-control" readonly="">{{$inmueble->tomaria_desicion ? "Si" : "No "}} {{$inmueble->motivo_tomaria_desicion}}</textarea>
			</div>
			<div class="col-6">
				<label>Medio por el cuál se enteró de nosotros: </label>
				<label class="form-control" readonly="">{{$inmueble->medio_entero}}</label>
			</div>
			<div class="col-12">
				<label>Observaciones: </label>
				<textarea class="form-control" readonly="">{{$inmueble->observaciones}}</textarea>
			</div>
		</div>
	</div>
	<div class="card-footer">
		<div class="d-flex justify-content-center">
			<a href="#" class="btn btn-success">Editar Inmueble</a>
		</div>
	</div>
</div>
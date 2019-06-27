<div class="card">
	<div class="card-header">
		Datos Personales:
	</div>
	<div class="card-body">
		<div class="form-group row">
			<div class="col-6">
				<label>Cliente:</label>
				<label class="form-control" readonly="">
					{{$personal->prefijo_1." ".$personal->nombre_completo_1}}
				</label>
			</div>
			<div class="col-6">
				<label>Ocupación:</label>
    			<label class="form-control" readonly="">
					{{$personal->ocupacion_1}}
				</label>
			</div>
			<div class="col-6">
				<label>Empresa:</label>
    			<label class="form-control" readonly="">
					{{$personal->empresa_1}}
				</label>
			</div>
			<div class="col-6">
				<label>Antigüedad:</label>
    			<label class="form-control" readonly="">
					{{$personal->antiguedad_1}}
				</label>
			</div>
			<div class="col-6">
				<label>Salario:</label>
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text" id="basic-addon1">$</span>
					</div>
					<label class="form-control" readonly="">
						{{number_format($personal->salario_1,2)}}
					</label>
				</div>
			</div>
			<div class="col-6">
				<label>RFC:</label>
    			<label class="form-control" readonly="">
					{{$personal->rfc_1}}
				</label>
			</div>
			<div class="col-6">
				<label>Nacionalidad:</label>
    			<label class="form-control" readonly="">
					{{$personal->nacionalidad_1}}
				</label>
			</div>
			<div class="col-6">
				<label>Estado Civil:</label>
    			<label class="form-control" readonly="">
					{{$personal->estado_civil}}
				</label>
			</div>
			@if ($personal->estado_civil == "Casado" || $personal->estado_civil == "Unión Libre")
				<div class="col-12 mt-2">
					<h5>Datos de la pareja:</h5>
				</div>
				<div class="col-6">
					<label>Pareja:</label>
					<label class="form-control" readonly="">
						{{$personal->prefijo_2." ".$personal->nombre_completo_2}}
					</label>
				</div>
				<div class="col-6">
					<label>Ocupación:</label>
	    			<label class="form-control" readonly="">
						{{$personal->ocupacion_2}}
					</label>
				</div>
				<div class="col-6">
					<label>Empresa:</label>
	    			<label class="form-control" readonly="">
						{{$personal->empresa_2}}
					</label>
				</div>
				<div class="col-6">
					<label>Antigüedad:</label>
	    			<label class="form-control" readonly="">
						{{$personal->antiguedad_2}}
					</label>
				</div>
				<div class="col-6">
					<label>Salario:</label>
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1">$</span>
						</div>
						<label class="form-control" readonly="">
							{{$personal->salario_2}}
						</label>
					</div>
				</div>
				<div class="col-6">
					<label>RFC:</label>
	    			<label class="form-control" readonly="">
						{{$personal->rfc_2}}
					</label>
				</div>
				<div class="col-6">
					<label>Nacionalidad:</label>
	    			<label class="form-control" readonly="">
						{{$personal->nacionalidad_2}}
					</label>
				</div>
				<div class="col-6">
					<label>Régimen Matrimonial:</label>
	    			<label class="form-control" readonly="">
						{{$personal->regimen_matrimonial}}
					</label>
				</div>
			@endif
			<div class="col-6">
				<label>Dirección:</label>
    			<textarea class="form-control" readonly="">{{$personal->direccion}}</textarea>
			</div>
			<div class="col-6">
				<label>Teléfono de casa:</label>
    			<label class="form-control" readonly="">
					{{$personal->telefono_casa}}
				</label>
			</div>
			<div class="col-6">
				<label>Teléfono celular:</label>
    			<label class="form-control" readonly="">
					{{$personal->telefono_celular}}
				</label>
			</div>
			<div class="col-6">
				<label>Teléfono oficina:</label>
    			<label class="form-control" readonly="">
					{{$personal->telefono_oficina}}
				</label>
			</div>
			<div class="col-6">
				<label>Email:</label>
    			<label class="form-control" readonly="">
					{{$personal->email}}
				</label>
			</div>
			<div class="col-6">
				<label>Residencia actual:</label>
    			<label class="form-control" readonly="">
					{{$personal->tipo_residencia." | ".$personal->duenio_residencia}}
				</label>
			</div>
			<div class="col-6">
				<label>Habitantes:</label>
    			<label class="form-control" readonly="">
					{{$personal->habitantes}}
				</label>
			</div>
			<div class="col-6">
				<label>Costo:</label>
    			<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text" id="basic-addon1">$</span>
					</div>
					<label class="form-control" readonly="">
						{{ number_format($personal->costo_residencia,2) }}
					</label>
				</div>
			</div>
			<div class="col-6">
				<label>Tiempo viviendo en la residencia:</label>
    			<label class="form-control" readonly="">
					{{$personal->tiempo_viviendo}}
				</label>
			</div>
			<div class="col-6">
				<label>Hijos:</label>
    			<label class="form-control" readonly="">
					{{$personal->hijos ? "Si" : 'No'}}
				</label>
			</div>
			@if ($personal->hijos)
			<div class="col-6">
				<label>Número de hijos:</label>
    			<label class="form-control" readonly="">
					{{ $personal->numero_hijos }}
				</label>
			</div>
			@endif
			<div class="col-6">
				<label>Dependientes económicos:</label>
    			<label class="form-control" readonly="">
					{{$personal->dependientes_economicos ? "Si" : 'No'}}
				</label>
			</div>
			@if ($personal->dependientes_economicos)
			<div class="col-6">
				<label>Número de hijos:</label>
    			<label class="form-control" readonly="">
					{{ $personal->numero_dependientes }}
				</label>
			</div>
			@endif
			@if ($personal->ingresos_extras)
			<div class="col-6">
				<label>Ingresos extras:</label>
    			<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text" id="basic-addon1">$</span>
					</div>
					<label class="form-control" readonly="">
						{{ number_format($personal->ingresos_extras,2) }}
					</label>
				</div>
			</div>
			@endif
			<div class="col-6">
				<label>Ingresos totales:</label>
    			<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text" id="basic-addon1">$</span>
					</div>
					<label class="form-control" readonly="">
						{{ number_format($personal->ingreso_total,2) }}
					</label>
				</div>
			</div>
			<div class="col-6">
				<label>¿Enganche o ahorro inicial? :</label>
    			
				<label class="form-control" readonly="">
					{{ $personal->ahorro_inicial ? "Si" : "No" }}
				</label>
			</div>
			@if ($personal->forma_ahorro)
			<div class="col-6">
				<label>Forma que tiene disponible el ahorro inicial :</label>
    			
				<label class="form-control" readonly="">
					{{ $personal->forma_ahorro }}
				</label>
			</div>
			@endif
			<div class="col-6">
				<label>¿Ahorra?:</label>
    			
				<label class="form-control" readonly="">
					{{ $personal->ahorra ? "Si" : "No" }}
				</label>
			</div>
			@if ($personal->ahorros)
			<div class="col-6">
				<label>¿Cuanto ahorra?:</label>
    			<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text" id="basic-addon1">$</span>
					</div>
					<label class="form-control" readonly="">
						{{ number_format($personal->ahorros,2) }}
					</label>
					<div class="input-group-append">
						<span class="input-group-text" id="basic-addon1">{{$personal->tipo_ahorro}}</span>
					</div>
				</div>
			</div>
			@endif
			<div class="col-6">
				<label>¿Alguna otra persona participará en la compra? :</label>
    			
				<label class="form-control" readonly="">
					{{ $personal->otro_participante ? "Si" : "No" }}
				</label>
			</div>
			@if ($personal->otro_participante)
			<div class="col-6">
				<label>Otro participante:</label>
    			
				<label class="form-control" readonly="">
					{{ $personal->participante }}
				</label>
			</div>
			@endif
    	</div>
	</div>
	<div class="card-footer">
		<div class="d-flex justify-content-center">
			<a href="{{ route('prospectos.perfil.datos_personal.edit',['prospecto'=>$prospecto,'datos_personal'=>$personal]) }}" class="btn btn-success">Editar datos personales</a>
		</div>
	</div>
</div>
@extends('principal')
@section('content')
<div class="row no-guttters">
  <div class="d-sm-none d-md-block col">
    @include('prospectos.perfil.info')
  </div>
  <div class="col">
    <div class="card">
		<div class="card-header">
	        <h4>Crear perfil:</h4>   
	    </div>
	    <div class="card-header">
	    	Datos personales:
	    </div>
	    <div class="card-body">
	    	<div class="row">
		    	<label for="folio" class="offset-5 col-sm-2 col-form-label">Folio:</label>
			    <div class="col">
			      	<input type="text" class="form-control" id="folio" name="folio" placeholder="número de folio">
			    </div>
	    	</div>
	    	<div class="row">
		    	<label for="asesor" class="offset-5 col-sm-2 col-form-label">Asesor:</label>
			    <div class="col">
			      	<input type="text" class="form-control" id="asesor" readonly="" value="{{$prospecto->asesor->nombre." ".$prospecto->asesor->paterno." ".$prospecto->asesor->materno}}">
					<input type="hidden" name="asesor_id" value="{{$prospecto->asesor->id}}">
			    </div>
	    	</div>
	    	<div class="row">
		    	<label for="fecha" class="offset-5 col-sm-2 col-form-label">fecha:</label>
			    <div class="col">
			      	<input type="date" class="form-control" id="fecha" name="fecha" value="{{date('Y-m-d')}}" readonly="">
			    </div>
	    	</div>
	    	<div class="row">
		    	<label for="clave" class="offset-5 col-sm-2 col-form-label">Clave:</label>
			    <div class="col">
			      	<input type="text" class="form-control" id="clave" name="clave" placeholder="Clave">
			    </div>
	    	</div>
	    	<div class="row mb-3">
		    	<label for="plan" class="offset-5 col-sm-2 col-form-label">Plan:</label>
			    <div class="col">
			      	<input type="text" class="form-control" id="plan" name="plan" placeholder="plan" value="{{$cotizacion->plan}}" readonly="">
			    </div>
	    	</div>
	    	<div class="form-group row">
	    		<div class="col-12">
		    		<div class="input-group">
						<select class="custom-select" id="prefijo_1" namme="prefijo_1" required="">
							<option value="">Elige...</option>
							<option value="Sr.">Sr.</option>
							<option value="Sra.">Sra.</option>
							<option value="Srta.">Srta.</option>
						</select>
						<div class="input-group-append w-75">
						<input type="text" class="form-control" name="nombre_completo_1" id="nombre_completo_1" value="{{$prospecto->nombre." ".$prospecto->appaterno." ".$prospecto->apmaterno}}">
						</div>
					</div>
	    		</div>
	    	</div>
	    	<div class="form-group row">
	    		<label for="ocupacion_1" class="col-form-label col-sm-2">Ocupación:</label>
	    		<div class="col-sm-10">
	    			<input type="text" name="ocupacion_1" class="form-control" id="ocupacion_1">
	    		</div>
	    	</div>
	    	<div class="form-group row">
	    		<label for="empresa_1" class="col-form-label col-sm-2">Empresa:</label>
	    		<div class="col-sm-10">
	    			<input type="text" name="empresa_1" class="form-control" id="empresa_1">
	    		</div>
	    	</div>
	    	<div class="form-group row">
	    		<label for="antiguedad_1" class="col-form-label col-sm-3">Antigüedad:</label>
	    		<div class="col-sm-9">
	    			<input type="text" name="antiguedad_1" class="form-control" id="antiguedad_1">
	    		</div>
	    	</div>
	    	<div class="form-group row">
	    		<label for="salario_1" class="col-form-label col-sm-2">Salario:</label>
	    		<div class="col-sm-10">
	    			<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1">$</span>
						</div>
						<input type="number" name="salario_1" class="form-control" min="0" id="salario_1">
					</div>
	    		</div>
	    	</div>
	    	<div class="form-group row">
	    		<label for="rfc_1" class="col-form-label col-sm-2">RFC:</label>
	    		<div class="col-sm-10">
	    			<input type="text" name="rfc_1" class="form-control" id="rfc_1">
	    		</div>
	    	</div>
	    	<div class="form-group row">
	    		<label for="nacionalidad_1" class="col-form-label col-sm-3">Nacionalidad:</label>
	    		<div class="col-sm-9">
	    			<input type="text" name="nacionalidad_1" class="form-control" id="nacionalidad_1">
	    		</div>
	    	</div>
	    	<div class="form-group row">
	    		<label for="estado_civil" class="col-form-label col-sm-3">Estado civil:</label>
	    		<div class="col-sm-9">
	    			<div class="form-check form-check-inline mt-1">
						<input class="form-check-input" type="radio" name="estado_civil" id="Soltero" value="Soltero" required="">
						<label class="form-check-label" for="Soltero">Soltero</label>
					</div>
					<div class="form-check form-check-inline mt-1">
						<input class="form-check-input" type="radio" name="estado_civil" id="Casado" value="Casado">
						<label class="form-check-label" for="Casado">Casado</label>
					</div>
					<div class="form-check form-check-inline mt-1">
						<input class="form-check-input" type="radio" name="estado_civil" id="Unión Libre" value="Unión Libre">
						<label class="form-check-label" for="Unión Libre">Unión Libre</label>
					</div>
					<div class="form-check form-check-inline mt-1">
						<input class="form-check-input" type="radio" name="estado_civil" id="Divorciado" value="Divorciado">
						<label class="form-check-label" for="Divorciado">Divorciado</label>
					</div>
					<div class="form-check form-check-inline mt-1">
						<input class="form-check-input" type="radio" name="estado_civil" id="Viudo" value="Viudo">
						<label class="form-check-label" for="Viudo">Viudo</label>
					</div>
    			</div>
	    	</div>
			<div class="form-group row" id="regimen_matrimonial">
    			<label for="regimen_matrimonial" class="col-form-label col-sm-4">Régimen matrimonial:</label>
    			<div class="col-sm-8">
    				<div class="form-check form-check-inline mt-1">
						<input class="form-check-input" type="radio" name="regimen_matrimonial" id="Sociedad Conyugal" value="Sociedad Conyugal">
						<label class="form-check-label" for="Sociedad Conyugal">Sociedad Conyugal</label>
					</div>
					<div class="form-check form-check-inline mt-1">
						<input class="form-check-input" type="radio" name="regimen_matrimonial" id="Separación de Bienes" value="Separación de Bienes">
						<label class="form-check-label" for="Separación de Bienes">Separación de Bienes</label>
					</div>
    			</div>
    		</div>
    		<div id="pareja">
    			<div class="form-group row">
    				<h5 class="card-title col-12">Datos de la pareja:</h5>
    			</div>
    			<div class="form-group row">
		    		<div class="col-12">
			    		<div class="input-group">
							<select class="custom-select" id="prefijo_2" namme="prefijo_2" required="">
								<option value="">Elige...</option>
								<option value="Sr.">Sr.</option>
								<option value="Sra.">Sra.</option>
								<option value="Srta.">Srta.</option>
							</select>
							<div class="input-group-append w-75">
							<input type="text" class="form-control" name="nombre_completo_2" id="nombre_completo_2" placeholder="Nombre completo de la pareja">
							</div>
						</div>
		    		</div>
		    	</div>
    			<div class="form-group row">
		    		<label for="ocupacion_2" class="col-form-label col-sm-2">Ocupación:</label>
		    		<div class="col-sm-10">
		    			<input type="text" name="ocupacion_2" class="form-control" id="ocupacion_2" placeholder="Ocupación de la pareja">
		    		</div>
		    	</div>
		    	<div class="form-group row">
		    		<label for="empresa_2" class="col-form-label col-sm-2">Empresa:</label>
		    		<div class="col-sm-10">
		    			<input type="text" name="empresa_2" class="form-control" id="empresa_2" placeholder="Empresa en la que labora de la pareja">
		    		</div>
		    	</div>
		    	<div class="form-group row">
		    		<label for="antiguedad_2" class="col-form-label col-sm-3">Antigüedad:</label>
		    		<div class="col-sm-9">
		    			<input type="text" name="antiguedad_2" class="form-control" id="antiguedad_2" placeholder="Antigüedad en la empresa">
		    		</div>
		    	</div>
		    	<div class="form-group row">
		    		<label for="salario_2" class="col-form-label col-sm-2">Salario:</label>
		    		<div class="col-sm-10">
		    			<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text" id="basic-addon1">$</span>
							</div>
							<input type="number" name="salario_2" class="form-control" min="0" id="salario_2" placeholder="Salario de la pareja">
						</div>
		    		</div>
		    	</div>
		    	<div class="form-group row">
		    		<label for="rfc_2" class="col-form-label col-sm-2">RFC:</label>
		    		<div class="col-sm-10">
		    			<input type="text" name="rfc_2" class="form-control" id="rfc_2" placeholder="RFC de la pareja">
		    		</div>
		    	</div>
		    	<div class="form-group row">
		    		<label for="nacionalidad_2" class="col-form-label col-sm-3">Nacionalidad:</label>
		    		<div class="col-sm-9">
		    			<input type="text" name="nacionalidad_2" class="form-control" id="nacionalidad_2" placeholder="Nacionalidad de la pareja">
		    		</div>
		    	</div>
    		</div>
    		<div class="form-group row">
	    		<label for="direccion" class="col-form-label col-sm-2">Direccion:</label>
	    		<div class="col-sm-10">
	    			<textarea name="direccion" class="form-control" id="direccion" placeholder="Dirección del domicilio del prospecto"></textarea>
	    		</div>
	    	</div>
	    	<div class="form-group row">
	    		<label for="telefono_casa" class="col-form-label col-sm-2">Teléfono de casa:</label>
	    		<div class="col-sm-4">
	    			<input type="text" name="telefono_casa" class="form-control" id="telefono_casa">
	    		</div>
	    		<label for="telefono_celular" class="col-form-label col-sm-2">Teléfono celular:</label>
	    		<div class="col-sm-4">
	    			<input type="text" name="telefono_celular" class="form-control" id="telefono_celular">
	    		</div>
	    	</div>
	    	<div class="form-group row">
	    		<label for="telefono_oficina" class="col-form-label col-sm-2">Teléfono de oficina:</label>
	    		<div class="col-sm-4">
	    			<input type="text" name="telefono_oficina" class="form-control" id="telefono_oficina">
	    		</div>
	    		<label for="email" class="col-form-label col-sm-2">Email:</label>
	    		<div class="col-sm-4">
	    			<input type="email" name="email" class="form-control" id="email">
	    		</div>
	    	</div>
	    	<div class="form-group row">
	    		<label for="tipo_residencia" class="col-form-label col-sm-3">Residencia Actual:</label>
    			<div class="col-sm-3">
    				<div class="form-check form-check-inline">
						<input class="form-check-input" type="radio" name="tipo_residencia" id="Casa" value="Casa">
						<label class="form-check-label" for="Casa">Casa</label>
					</div>
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="radio" name="tipo_residencia" id="Departamento" value="Departamento">
						<label class="form-check-label" for="Departamento">Departamento</label>
					</div>
    			</div>
    			<div class="col-sm-6">
    				<div class="form-check form-check-inline">
						<input class="form-check-input" type="radio" name="duenio_residencia" id="Propio" value="Propio">
						<label class="form-check-label" for="Propio">Propio</label>
					</div>
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="radio" name="duenio_residencia" id="Familiar" value="Familiar">
						<label class="form-check-label" for="Familiar">Familiar</label>
					</div>
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="radio" name="duenio_residencia" id="Renta" value="Renta">
						<label class="form-check-label" for="Renta">Renta</label>
					</div>
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="radio" name="duenio_residencia" id="Hipotecada" value="Hipotecada">
						<label class="form-check-label" for="Hipotecada">Hipotecada</label>
					</div>
    			</div>
	    	</div>
	    	<div class="form-group row">
	    		<label for="habitantes" class="col-form-label col-sm-2">Número de habitantes:</label>
	    		<div class="col-sm-4">
	    			<input type="number" name="habitantes" min="1" step="1" value="1" class="form-control" id="habitantes">
	    		</div>
	    		<label for="costo_residencia" class="col-form-label col-sm-2">Costo de la residencia:</label>
	    		<div class="col-sm-4">
	    			<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1">$</span>
						</div>
						<input type="number" step="any" min="0" name="costo_residencia" class="form-control" id="costo_residencia">
					</div>
	    		</div>
	    	</div>
	    	<div class="form-group row">
	    		<label for="tiempo_viviendo" class="col-form-label col-sm-3">¿Cuánto tiempo lleva viviendo ahí?:</label>
	    		<div class="col-sm-9">
	    			<input type="text" name="tiempo_viviendo" class="form-control" id="tiempo_viviendo">
	    		</div>
	    	</div>
	    	<div class="form-group row">
	    		<label for="hijos" class="col-form-label col-sm-3">Hijos:</label>
    			<div class="col-sm-3">
    				<div class="form-check form-check-inline mt-1">
						<input class="form-check-input" type="radio" name="hijos" id="hijos_si" value="true">
						<label class="form-check-label" for="hijos_si">Si</label>
					</div>
					<div class="form-check form-check-inline mt-1">
						<input class="form-check-input" type="radio" name="hijos" id="hijos_no" value="false">
						<label class="form-check-label" for="hijos_no">No</label>
					</div>
    			</div>
    			<label for="numero_hijos" class="col-form-label col-sm-3">Número de hijos:</label>
    			<div class="col-sm-3">
    				<input type="number" step="any" min="0" name="numero_hijos" class="form-control" id="numero_hijos">
    			</div>
	    	</div>
	    	<div class="form-group row">
	    		<label for="dependientes_economicos" class="col-form-label col-sm-3">Dependientes económicos:</label>
    			<div class="col-sm-3">
    				<div class="form-check form-check-inline mt-1">
						<input class="form-check-input" type="radio" name="dependientes_economicos" id="dependientes_economicos_si" value="true">
						<label class="form-check-label" for="dependientes_economicos_si">Si</label>
					</div>
					<div class="form-check form-check-inline mt-1">
						<input class="form-check-input" type="radio" name="dependientes_economicos" id="dependientes_economicos_no" value="false">
						<label class="form-check-label" for="dependientes_economicos_no">No</label>
					</div>
    			</div>
    			<label for="numero_dependientes" class="col-form-label col-sm-3">Número de dependientes económicos:</label>
    			<div class="col-sm-3">
    				<input type="number" step="any" min="0" name="numero_dependientes" class="form-control" id="numero_dependientes">
    			</div>
	    	</div>
	    	<div class="form-group row">
	    		<label for="ingresos_extras" class="col-form-label col-sm-2">Ingresos extras:</label>
	    		<div class="col-sm-4">
	    			<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1">$</span>
						</div>
	    				<input type="number" name="ingresos_extras" class="form-control" step="any" min="0">
					</div>
	    		</div>
	    		<label for="ingresos_total" class="col-form-label col-sm-2">Ingresos totales:</label>
	    		<div class="col-sm-4">
	    			<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1">$</span>
						</div>
	    				<input type="number" name="ingresos_total" class="form-control" step="any" min="0">
					</div>
	    		</div>
	    	</div>
	    	<div class="form-group row">
	    		<label for="ahorro_inicial" class="col-form-label col-sm-9">¿Cuenta con algún tipo de enganche o ahorro destinado para iniciar?</label>
	    		<div class="col-sm-3">
    				<div class="form-check form-check-inline mt-1">
						<input class="form-check-input" type="radio" name="ahorro_inicial" id="ahorro_inicial_si" value="true">
						<label class="form-check-label" for="ahorro_inicial_si">Si</label>
					</div>
					<div class="form-check form-check-inline mt-1">
						<input class="form-check-input" type="radio" name="ahorro_inicial" id="ahorro_inicial_no" value="false">
						<label class="form-check-label" for="ahorro_inicial_no">No</label>
					</div>
    			</div>
	    	</div>
	    	<div class="form-group row">
	    		<label for="forma_ahorro" class="col-form-label col-sm-3">¿En qué forma lo tiene disponible?</label>
	    		<div class="col-sm-9">
	    			<input type="text" name="forma_ahorro" class="form-control">
	    		</div>
	    	</div>
	    	<div class="form-group row">
	    		<label for="ahorra" class="col-form-label col-sm-2">¿Ahorra?</label>
				<div class="col-sm-2">
    				<div class="form-check form-check-inline mt-1">
						<input class="form-check-input" type="radio" name="ahorra" id="ahorra_si" value="true">
						<label class="form-check-label" for="ahorra_si">Si</label>
					</div>
					<div class="form-check form-check-inline mt-1">
						<input class="form-check-input" type="radio" name="ahorra" id="ahorra_no" value="false">
						<label class="form-check-label" for="ahorra_no">No</label>
					</div>
    			</div>
    			<div class="col-sm-8">
    				<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1">$</span>
						</div>
	    				<input type="number" name="ahorros" class="form-control" step="any" min="0">
	    				<div class="input-group-append">
	    					<select class="form-control" name="tipo_ahorro">
	    						<option value="">Elija una opcion</option>
	    						<option value="Semanal">Semanal</option>
	    						<option value="Mensual">Mensual</option>
	    					</select>
	    				</div>
					</div>
    			</div>
	    	</div>
	    	<div class="form-group row">
	    		<label for="otro_participante" class="col-form-label col-sm-5">¿Alguna otra persona participará en la compra?</label>
				<div class="col-sm-1">
    				<div class="form-check form-check-inline mt-1">
						<input class="form-check-input" type="radio" name="otro_participante" id="otro_participante_si" value="true">
						<label class="form-check-label" for="otro_participante_si">Si</label>
					</div>
					<div class="form-check form-check-inline mt-1">
						<input class="form-check-input" type="radio" name="otro_participante" id="otro_participante_no" value="false">
						<label class="form-check-label" for="otro_participante_no">No</label>
					</div>
    			</div>
    			<div class="col-sm-6">
    				<input type="text" name="participante" id="participante" class="form-control">
    			</div>
	    	</div>
	    </div>
	    <div class="card-header">
	    	Historial Crediticio:
	    </div>
	    <div class="card-body">
	    	<div class="form-group row">
	    		<label for="tarjeta_debito" class="col-form-label col-sm-6">Tarjeta de Débito o Cuenta de Ahorro:</label>
    			<div class="col-sm-2">
    				<div class="form-check form-check-inline mt-1">
						<input class="form-check-input" type="radio" name="tarjeta_debito" id="tarjeta_debito_si" value="true">
						<label class="form-check-label" for="tarjeta_debito_si">Si</label>
					</div>
					<div class="form-check form-check-inline mt-1">
						<input class="form-check-input" type="radio" name="tarjeta_debito" id="tarjeta_debito_no" value="false">
						<label class="form-check-label" for="tarjeta_debito_no">No</label>
					</div>
    			</div>
    			<label for="" class="col-form-label col-sm-1">#</label>
    			<div class="col-sm-3">
    				<input type="number" name="numero_tarjeta_debito" id="numero_tarjeta_debito" class="form-control">
    			</div>
	    	</div>
			<div class="form-group row">
				<div class="offset-sm-1 col-sm-11">
    				<div class="form-check form-check-inline mt-1">
						<input class="form-check-input" type="checkbox" name="td_bancomer" id="td_bancomer" value="true">
						<label class="form-check-label" for="td_bancomer"><img src="{{ asset('img/bbva.png') }}" width="150" height="30"></label>
					</div>

    				<div class="form-check form-check-inline mt-1">
						<input class="form-check-input" type="checkbox" name="td_santander" id="td_santander" value="true">
						<label class="form-check-label" for="td_santander"><img src="{{ asset('img/santander.png') }}" width="150" height="30"></label>
					</div>

    				<div class="form-check form-check-inline mt-1">
						<input class="form-check-input" type="checkbox" name="td_hsbc" id="td_hsbc" value="true">
						<label class="form-check-label" for="td_hsbc"><img src="{{ asset('img/hsbc.png') }}" width="150" height="30"></label>
					</div>
				</div>
			</div>
			<div class="form-group row">
				<div class="offset-sm-1 col-sm-11">	
    				<div class="form-check form-check-inline mt-1">
						<input class="form-check-input" type="checkbox" name="td_scotiabank" id="td_scotiabank" value="true">
						<label class="form-check-label" for="td_scotiabank"><img src="{{ asset('img/scotiabank.png') }}" width="150" height="30"></label>
					</div>
					
    				<div class="form-check form-check-inline mt-1">
						<input class="form-check-input" type="checkbox" name="td_banamex" id="td_banamex" value="true">
						<label class="form-check-label" for="td_banamex"><img src="{{ asset('img/banamex.png') }}" width="150" height="30"></label>
					</div>
					
    				<div class="form-check form-check-inline mt-1">
						<input class="form-check-input" type="checkbox" name="td_banorte" id="td_banorte" value="true">
						<label class="form-check-label" for="td_banorte"><img src="{{ asset('img/banorte.png') }}" width="150" height="30"></label>
					</div>
					
    			</div>
			</div>
			<div class="form-group row">
	    		<label for="tarjeta_credito" class="col-form-label col-sm-6">Tarjeta de Crédito:</label>
    			<div class="col-sm-2">
    				<div class="form-check form-check-inline mt-1">
						<input class="form-check-input" type="radio" name="tarjeta_credito" id="tarjeta_credito_si" value="true">
						<label class="form-check-label" for="tarjeta_credito_si">Si</label>
					</div>
					<div class="form-check form-check-inline mt-1">
						<input class="form-check-input" type="radio" name="tarjeta_credito" id="tarjeta_credito_no" value="false">
						<label class="form-check-label" for="tarjeta_credito_no">No</label>
					</div>
    			</div>
    			<label for="" class="col-form-label col-sm-1">#</label>
    			<div class="col-sm-3">
    				<input type="number" name="numero_tarjeta_credito" id="numero_tarjeta_credito" class="form-control">
    			</div>
	    	</div>
			<div class="form-group row">
				<div class="offset-sm-1 col-sm-11">
    				<div class="form-check form-check-inline mt-1">
						<input class="form-check-input" type="checkbox" name="tc_bancomer" id="tc_bancomer" value="true">
						<label class="form-check-label" for="tc_bancomer"><img src="{{ asset('img/bbva.png') }}" width="100" height="30"></label>
					</div>

    				<div class="form-check form-check-inline mt-1">
						<input class="form-check-input" type="checkbox" name="tc_santander" id="tc_santander" value="true">
						<label class="form-check-label" for="tc_santander"><img src="{{ asset('img/santander.png') }}" width="100" height="30"></label>
					</div>

    				<div class="form-check form-check-inline mt-1">
						<input class="form-check-input" type="checkbox" name="tc_hsbc" id="tc_hsbc" value="true">
						<label class="form-check-label" for="tc_hsbc"><img src="{{ asset('img/hsbc.png') }}" width="100" height="30"></label>
					</div>

    				<div class="form-check form-check-inline mt-1">
						<input class="form-check-input" type="checkbox" name="tc_amex" id="tc_amex" value="true">
						<label class="form-check-label" for="tc_amex"><img src="{{ asset('img/amex.png') }}" width="100" height="30"></label>
					</div>
				</div>
			</div>
			<div class="form-group row">
				<div class="offset-sm-1 col-sm-11">	
    				<div class="form-check form-check-inline mt-1">
						<input class="form-check-input" type="checkbox" name="tc_scotiabank" id="tc_scotiabank" value="true">
						<label class="form-check-label" for="tc_scotiabank"><img src="{{ asset('img/scotiabank.png') }}" width="150" height="30"></label>
					</div>
					
    				<div class="form-check form-check-inline mt-1">
						<input class="form-check-input" type="checkbox" name="tc_banamex" id="tc_banamex" value="true">
						<label class="form-check-label" for="tc_banamex"><img src="{{ asset('img/banamex.png') }}" width="150" height="30"></label>
					</div>
					
    				<div class="form-check form-check-inline mt-1">
						<input class="form-check-input" type="checkbox" name="tc_banorte" id="tc_banorte" value="true">
						<label class="form-check-label" for="tc_banorte"><img src="{{ asset('img/banorte.png') }}" width="150" height="30"></label>
					</div>
					
    			</div>
			</div>
	    </div>
	</div>
  </div>
</div>
{{-- <div class="row no-gutters">
	<div class="col-6">
		<div>
			@include('prospectos.perfil.info')
		</div>
	</div>
	<div class="col-6">
		<div>
			
		</div>
	</div>
</div> --}}
@endsection
@extends('principal')
@section('content')
<div class="row no-guttters">
  <div class="d-sm-none d-md-block col">
    @include('prospectos.perfil.info')
  </div>
  <div class="col">
	<form method="POST" action="{{ route('prospectos.cotizacions.perfils.store',['prospecto'=>$prospecto,'cotizacion'=>$cotizacion]) }}" id="perfil">
		@csrf
	    <div class="card">
			<div class="card-header">
		        <h4>Crear perfil:</h4>   
		    </div>
		    <div class="card-header">
		    	Datos personales:
		    </div>
		    <div class="card-body">
		    	@if ($errors->any())
				    <div class="alert alert-danger">
				        <ul>
				            @foreach ($errors->all() as $error)
				                <li>{{ $error }}</li>
				            @endforeach
				        </ul>
				    </div>
				@endif
		    	<div class="row">
			    	<label for="folio" class="offset-5 col-sm-2 col-form-label">Folio:</label>
				    <div class="col">
				      	<input type="text" class="form-control" id="folio" name="folio" placeholder="número de folio" readonly="" value="{{$folio}}">
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
				      	<input type="text" class="form-control" id="clave" name="clave" placeholder="Clave" value="{{str_random(9)}}" readonly="">
				    </div>
		    	</div>
		    	<div class="row mb-3">
			    	<label for="plan" class="offset-5 col-sm-2 col-form-label">Plan:</label>
				    <div class="col">
				      	<input type="text" class="form-control" id="plan" name="plan" placeholder="plan" value="{{$cotizacion->plan->nombre}}" readonly="">
				    </div>
		    	</div>
		    	<div class="form-group row">
		    		<div class="col-12">
			    		<div class="input-group">
							<select class="custom-select" name="prefijo_1" id="prefijo_1" required="">
								<option value="" {{old('prefijo_1' == "" ? 'selected=""' : '')}}>Elige...</option>
								<option value="Sr." {{old('prefijo_1' == "Sr." ? 'selected=""' : '')}}>Sr.</option>
								<option value="Sra." {{old('prefijo_1' == "Sra." ? 'selected=""' : '')}}>Sra.</option>
								<option value="Srta." {{old('prefijo_1' == "Srta." ? 'selected=""' : '')}}>Srta.</option>
							</select>
							<div class="input-group-append w-75">
								<input type="text" name="nombre_1" id="nombre_1" placeholder="Nombre" value="{{old("nombre_1") ? old('nombre_1') : $prospecto->nombre}}" class="form-control" required="">
								<input type="text" name="paterno_1" id="paterno_1" placeholder="Apellido Paterno" value="{{ old("paterno_1") ? old("paterno_1") : $prospecto->appaterno}}" class="form-control" required="">
								<input type="text" name="materno_1" id="materno_1" placeholder="Apellido Materno" value="{{ old("materno_1") ? old("materno_1") : $prospecto->apmaterno}}" class="form-control">
							</div>
						</div>
		    		</div>
		    	</div>
		    	<div class="form-group row">
		    		<label for="ocupacion_1" class="col-form-label col-sm-2">Ocupación:</label>
		    		<div class="col-sm-10">
		    			<input type="text" name="ocupacion_1" class="form-control" id="ocupacion_1" value="{{old('ocupacion_1')}}" required="">
		    		</div>
		    	</div>
		    	<div class="form-group row">
		    		<label for="empresa_1" class="col-form-label col-sm-2">Empresa:</label>
		    		<div class="col-sm-10">
		    			<input type="text" name="empresa_1" class="form-control" id="empresa_1" value="{{old('empresa_1')}}" required="">
		    		</div>
		    	</div>
		    	<div class="form-group row">
		    		<label for="antiguedad_1" class="col-form-label col-sm-3">Antigüedad:</label>
		    		<div class="col-sm-9">
		    			<input type="text" name="antiguedad_1" class="form-control" id="antiguedad_1" value="{{old('antiguedad_1')}}" required="">
		    		</div>
		    	</div>
		    	<div class="form-group row">
		    		<label for="salario_1" class="col-form-label col-sm-2">Salario:</label>
		    		<div class="col-sm-10">
		    			<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text" id="basic-addon1">$</span>
							</div>
							<input type="number" name="salario_1" class="form-control" min="0" id="salario_1" value="{{old('salario_1') ? old('salario_1') : $prospecto->sueldo}}" required="">
						</div>
		    		</div>
		    	</div>
		    	<div class="form-group row">
		    		<label for="rfc_1" class="col-form-label col-sm-2">RFC:</label>
		    		<div class="col-sm-10">
		    			<input type="text" name="rfc_1" class="form-control" id="rfc_1" value="{{old('rfc_1')}}" required="">
		    		</div>
		    	</div>
		    	<div class="form-group row">
		    		<label for="nacionalidad_1" class="col-form-label col-sm-3">Nacionalidad:</label>
		    		<div class="col-sm-9">
		    			<input type="text" name="nacionalidad_1" class="form-control" id="nacionalidad_1" value="{{old('nacionalidad_1')}}" required="">
		    		</div>
		    	</div>
		    	<div class="form-group row">
		    		<label for="estado_civil" class="col-form-label col-sm-3">Estado civil:</label>
		    		<div class="col-sm-9">
		    			<div class="form-check form-check-inline mt-1">
							<input class="form-check-input" type="radio" name="estado_civil" id="Soltero" value="Soltero" {{old('estado_civil') == "Soltero" ? 'checked=""' : ''}} required="">
							<label class="form-check-label" for="Soltero">Soltero</label>
						</div>
						<div class="form-check form-check-inline mt-1">
							<input class="form-check-input" type="radio" name="estado_civil" id="Casado" value="Casado" {{old('estado_civil') == "Casado" ? 'checked=""' : ''}}>
							<label class="form-check-label" for="Casado">Casado</label>
						</div>
						<div class="form-check form-check-inline mt-1">
							<input class="form-check-input" type="radio" name="estado_civil" id="Unión Libre" value="Unión Libre" {{old('estado_civil') == "Unión Libre" ? 'checked=""' : ''}}>
							<label class="form-check-label" for="Unión Libre">Unión Libre</label>
						</div>
						<div class="form-check form-check-inline mt-1">
							<input class="form-check-input" type="radio" name="estado_civil" id="Divorciado" value="Divorciado" {{old('estado_civil') == "Divorciado" ? 'checked=""' : ''}}>
							<label class="form-check-label" for="Divorciado">Divorciado</label>
						</div>
						<div class="form-check form-check-inline mt-1">
							<input class="form-check-input" type="radio" name="estado_civil" id="Viudo" value="Viudo" {{old('estado_civil') == "Viudo" ? 'checked=""' : ''}}>
							<label class="form-check-label" for="Viudo">Viudo</label>
						</div>
	    			</div>
		    	</div>
	    		<div id="pareja">
	    			@if (old('estado_civil') == "Casado" || old('estado_civil') == "Unión Libre")
	    				<div class="form-group row" id="regimen_matrimonial">
			    			<label for="regimen_matrimonial" class="col-form-label col-sm-4">Régimen matrimonial:</label>
			    			<div class="col-sm-8">
			    				<div class="form-check form-check-inline mt-1">
									<input class="form-check-input" type="radio" name="regimen_matrimonial" id="Sociedad Conyugal" value="Sociedad Conyugal" required="" {{old('regimen_matrimonial') == "Sociedad Conyugal" ? 'checked=""' : ''}}>
									<label class="form-check-label" for="Sociedad Conyugal">Sociedad Conyugal</label>
								</div>
								<div class="form-check form-check-inline mt-1">
									<input class="form-check-input" type="radio" name="regimen_matrimonial" id="Separación de Bienes" value="Separación de Bienes" {{old('regimen_matrimonial') == "Separación de Bienes" ? 'checked=""' : ''}}>
									<label class="form-check-label" for="Separación de Bienes">Separación de Bienes</label>
								</div>
			    			</div>
			    		</div>
		    			<div class="form-group row">
		    				<h5 class="card-title col-12">Datos de la pareja:</h5>
		    			</div>
		    			<div class="form-group row">
				    		<div class="col-12">
					    		<div class="input-group">
									<select class="custom-select" name="prefijo_2" id="prefijo_2" required="">
										<option value="" {{old('prefijo_2' == "" ? 'selected=""' : '')}}>Elige...</option>
										<option value="Sr." {{old('prefijo_2' == "Sr." ? 'selected=""' : '')}}>Sr.</option>
										<option value="Sra." {{old('prefijo_2' == "Sra." ? 'selected=""' : '')}}>Sra.</option>
										<option value="Srta." {{old('prefijo_2' == "Srta." ? 'selected=""' : '')}}>Srta.</option>
									</select>
									<div class="input-group-append w-75">
										<input type="text" name="nombre_2" id="nombre_2" placeholder="Nombre" value="{{old("nombre_2") ? old('nombre_2') : ''}}" class="form-control" required="">
										<input type="text" name="paterno_2" id="paterno_2" placeholder="Apellido Paterno" value="{{ old("paterno_2") ? old("paterno_2") : ''}}" class="form-control" required="">
										<input type="text" name="materno_2" id="materno_2" placeholder="Apellido Materno" value="{{ old("materno_2") ? old("materno_2") : ''}}" class="form-control">
									</div>
								</div>
				    		</div>
				    	</div>
		    			<div class="form-group row">
				    		<label for="ocupacion_2" class="col-form-label col-sm-2">Ocupación:</label>
				    		<div class="col-sm-10">
				    			<input type="text" name="ocupacion_2" class="form-control" id="ocupacion_2" value="{{old('ocupacion_2')}}" placeholder="Ocupación de la pareja"  required="">
				    		</div>
				    	</div>
				    	<div class="form-group row">
				    		<label for="empresa_2" class="col-form-label col-sm-2">Empresa:</label>
				    		<div class="col-sm-10">
				    			<input type="text" name="empresa_2" class="form-control" id="empresa_2" value="{{old('empresa_2')}}" placeholder="Empresa en la que labora de la pareja"  required="">
				    		</div>
				    	</div>
				    	<div class="form-group row">
				    		<label for="antiguedad_2" class="col-form-label col-sm-3">Antigüedad:</label>
				    		<div class="col-sm-9">
				    			<input type="text" name="antiguedad_2" class="form-control" id="antiguedad_2" placeholder="Antigüedad en la empresa" value="{{old('antiguedad_2')}}" required="">
				    		</div>
				    	</div>
				    	<div class="form-group row">
				    		<label for="salario_2" class="col-form-label col-sm-2">Salario:</label>
				    		<div class="col-sm-10">
				    			<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text" id="basic-addon1">$</span>
									</div>
									<input type="number" name="salario_2" class="form-control" min="0" id="salario_2" placeholder="Salario de la pareja" value="{{old('salario_2')}}" required="">
								</div>
				    		</div>
				    	</div>
				    	<div class="form-group row">
				    		<label for="rfc_2" class="col-form-label col-sm-2">RFC:</label>
				    		<div class="col-sm-10">
				    			<input type="text" name="rfc_2" class="form-control" id="rfc_2" value="{{old('rfc_2')}}" placeholder="RFC de la pareja">
				    		</div>
				    	</div>
				    	<div class="form-group row">
				    		<label for="nacionalidad_2" class="col-form-label col-sm-3">Nacionalidad:</label>
				    		<div class="col-sm-9">
				    			<input type="text" name="nacionalidad_2" class="form-control" id="nacionalidad_2" placeholder="Nacionalidad de la pareja" value="{{old('nacionalidad_2')}}" required="">
				    		</div>
				    	</div>
	    			@endif
	    		</div>
	    		<div class="form-group row">
		    		<label for="direccion" class="col-form-label col-sm-2">Direccion:</label>
		    		<div class="col-sm-10">
		    			<div class="input-group">
		    				<div class="input-group-prepend">
		    					<span class="input-group-text">Calle</span>
		    				</div>
		    				<input type="text" name="calle" id="calle" class="form-control w-25" placeholder="Calle" required="">
		    				<div class="input-group-prepend">
		    					<span class="input-group-text">#</span>
		    				</div>
	    					<input type="text" name="numero_ext" class="form-control" required="">
		    				<div class="input-group-prepend">
		    					<span class="input-group-text">Int.</span>
		    				</div>
	    					<input type="text" name="numero_int" class="form-control">
		    			</div>
		    		</div>
		    		<div class="col-sm-10 offset-sm-2">
		    			<div class="input-group">
		    				<input type="text" name="cp" id="cp" class="form-control" placeholder="Código Postal" required="">
		    				<select class="form-control" name="colonia" id="colonia" required="">
								<option>Seleccione una colonía ó población</option>
							</select>
		    			</div>
		    		</div>
		    		<div class="col-sm-10 offset-sm-2">
	    				<div class="input-group">
		    				<input type="text" class="form-control" placeholder="Alcaldía o Municipio" value="{{old('municipio')}}" name="municipio" id="municipio" required="">
		    				<input type="text" class="form-control" placeholder="Estado" value="{{old('estado')}}" name="estado" id="estado" required="">
		    			</div>
		    		</div>
		    	</div>
		    	<div class="form-group row">
		    		<label for="telefono_casa" class="col-form-label col-sm-2">Teléfono de casa:</label>
		    		<div class="col-sm-4">
		    			<input type="text" name="telefono_casa" class="form-control" id="telefono_casa" value="{{old('telefono_casa') ? old('telefono_casa') : $prospecto->tel}}" required="">
		    		</div>
		    		<label for="telefono_celular" class="col-form-label col-sm-2">Teléfono celular:</label>
		    		<div class="col-sm-4">
		    			<input type="text" name="telefono_celular" class="form-control" id="telefono_celular" value="{{old('telefono_celular') ? old('telefono_celular') : $prospecto->movil}}" required="">
		    		</div>
		    	</div>
		    	<div class="form-group row">
		    		<label for="telefono_oficina" class="col-form-label col-sm-2">Teléfono de oficina:</label>
		    		<div class="col-sm-4">
		    			<input type="text" name="telefono_oficina" class="form-control" id="telefono_oficina" value="{{old('telefono_oficina')}}">
		    		</div>
		    		<label for="email" class="col-form-label col-sm-2">Email:</label>
		    		<div class="col-sm-4">
		    			<input type="email" name="email" class="form-control" id="email" value="{{old('email') ? old('email') : $prospecto->email}}" required="">
		    		</div>
		    	</div>
		    	<div class="form-group row">
		    		<label for="tipo_residencia" class="col-form-label col-sm-3">Residencia Actual:</label>
	    			<div class="col-sm-3">
	    				<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="tipo_residencia" id="Casa" value="Casa" {{old('tipo_residencia') == 'Casa' ? 'checked=""' : ''}} required="">
							<label class="form-check-label" for="Casa">Casa</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="tipo_residencia" id="Departamento" {{old('tipo_residencia') == 'Departamento' ? 'checked=""' : '' }} value="Departamento">
							<label class="form-check-label" for="Departamento">Departamento</label>
						</div>
	    			</div>
	    			<div class="col-sm-6">
	    				<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="duenio_residencia" id="Propio" {{old('duenio_residencia') == "Propio" ? 'checked=""' : '' }} value="Propio" required="">
							<label class="form-check-label" for="Propio">Propio</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="duenio_residencia" id="Familiar" {{old('duenio_residencia') == "Familiar" ? 'checked=""' : '' }} value="Familiar">
							<label class="form-check-label" for="Familiar">Familiar</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="duenio_residencia" id="Renta" {{old('duenio_residencia') == "Renta" ? 'checked=""' : '' }} value="Renta">
							<label class="form-check-label" for="Renta">Renta</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="duenio_residencia" id="Hipotecada" {{old('duenio_residencia') == "Hipotecada" ? 'checked=""' : '' }} value="Hipotecada">
							<label class="form-check-label" for="Hipotecada">Hipotecada</label>
						</div>
	    			</div>
		    	</div>
		    	<div class="form-group row">
		    		<label for="habitantes" class="col-form-label col-sm-2">Número de habitantes:</label>
		    		<div class="col-sm-4">
		    			<input type="number" name="habitantes" min="1" step="1" value="{{old('habitantes')}}" class="form-control" id="habitantes" required="">
		    		</div>
		    		<label for="costo_residencia" class="col-form-label col-sm-2">Costo de la residencia:</label>
		    		<div class="col-sm-4">
		    			<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text" id="basic-addon1">$</span>
							</div>
							<input type="number" step="any" min="0" name="costo_residencia" class="form-control" id="costo_residencia" value="{{old('costo_residencia') ? old('costo_residencia') : $prospecto->monto}}" required="">
						</div>
		    		</div>
		    	</div>
		    	<div class="form-group row">
		    		<label for="tiempo_viviendo" class="col-form-label col-sm-3">¿Cuánto tiempo lleva viviendo ahí?:</label>
		    		<div class="col-sm-9">
		    			<input type="text" name="tiempo_viviendo" class="form-control" id="tiempo_viviendo" value="{{old('tiempo_viviendo')}}" required="">
		    		</div>
		    	</div>
		    	<div class="form-group row">
		    		<label for="hijos" class="col-form-label col-sm-3">Hijos:</label>
	    			<div class="col-sm-3">
	    				<div class="form-check form-check-inline mt-1">
							<input class="form-check-input" type="radio" name="hijos" id="hijos_si" value="1" {{old('hijos') == "1" ? 'checked=""' : ''}} required="">
							<label class="form-check-label" for="hijos_si">Si</label>
						</div>
						<div class="form-check form-check-inline mt-1">
							<input class="form-check-input" type="radio" name="hijos" id="hijos_no" value="0" {{old('hijos') == "0" ? 'checked=""' : ''}}>
							<label class="form-check-label" for="hijos_no">No</label>
						</div>
	    			</div>
	    			<label for="numero_hijos" class="col-form-label col-sm-3">Número de hijos:</label>
	    			<div class="col-sm-3">
	    				<input type="number" step="any" min="0" name="numero_hijos" class="form-control" id="numero_hijos" value="{{old('numero_hijos')}}">
	    			</div>
		    	</div>
		    	<div class="form-group row">
		    		<label for="dependientes_economicos" class="col-form-label col-sm-3">Dependientes económicos:</label>
	    			<div class="col-sm-3">
	    				<div class="form-check form-check-inline mt-1">
							<input class="form-check-input" type="radio" name="dependientes_economicos" id="dependientes_economicos_si" value="1" {{old('dependientes_economicos') == "1" ? 'checked=""' : ''}} required="">
							<label class="form-check-label" for="dependientes_economicos_si">Si</label>
						</div>
						<div class="form-check form-check-inline mt-1">
							<input class="form-check-input" type="radio" name="dependientes_economicos" id="dependientes_economicos_no" value="0" {{old('dependientes_economicos') == "0" ? 'checked=""' : ''}}>
							<label class="form-check-label" for="dependientes_economicos_no">No</label>
						</div>
	    			</div>
	    			<label for="numero_dependientes" class="col-form-label col-sm-3">Número de dependientes económicos:</label>
	    			<div class="col-sm-3">
	    				<input type="number" step="any" min="0" name="numero_dependientes" class="form-control" id="numero_dependientes" value="{{old('numero_dependientes')}}">
	    			</div>
		    	</div>
		    	<div class="form-group row">
		    		<label for="ingresos_extras" class="col-form-label col-sm-2">Ingresos extras:</label>
		    		<div class="col-sm-4">
		    			<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text" id="basic-addon1">$</span>
							</div>
		    				<input type="number" name="ingresos_extras" class="form-control" step="any" value="{{old('ingresos_extras')}}" min="0">
						</div>
		    		</div>
		    		<label for="ingreso_total" class="col-form-label col-sm-2">Ingresos totales:</label>
		    		<div class="col-sm-4">
		    			<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text" id="basic-addon1">$</span>
							</div>
		    				<input type="number" name="ingreso_total" class="form-control" step="any" min="0" value="{{old('ingresos_extras')}}" required="">
						</div>
		    		</div>
		    	</div>
		    	<div class="form-group row">
		    		<label for="ahorro_inicial" class="col-form-label col-sm-9">¿Cuenta con algún tipo de enganche o ahorro destinado para iniciar?</label>
		    		<div class="col-sm-3">
	    				<div class="form-check form-check-inline mt-1">
							<input class="form-check-input" type="radio" name="ahorro_inicial" id="ahorro_inicial_si" {{old('ahorro_inicial') == "1" ? 'checked=""' : ''}} value="1" required="">
							<label class="form-check-label" for="ahorro_inicial_si">Si</label>
						</div>
						<div class="form-check form-check-inline mt-1">
							<input class="form-check-input" type="radio" name="ahorro_inicial" id="ahorro_inicial_no" {{old('ahorro_inicial') == "0" ? 'checked=""' : ''}} value="0">
							<label class="form-check-label" for="ahorro_inicial_no">No</label>
						</div>
	    			</div>
		    	</div>
		    	<div class="form-group row">
		    		<label for="forma_ahorro" class="col-form-label col-sm-3">¿En qué forma lo tiene disponible?</label>
		    		<div class="col-sm-9">
		    			<input type="text" name="forma_ahorro" value="{{old('forma_ahorro')}}" class="form-control">
		    		</div>
		    	</div>
		    	<div class="form-group row">
		    		<label for="ahorra" class="col-form-label col-sm-2">¿Ahorra?</label>
					<div class="col-sm-2">
	    				<div class="form-check form-check-inline mt-1">
							<input class="form-check-input" type="radio" name="ahorra" id="ahorra_si" value="1" {{old('ahorra') == "" ? 'checked=""' : ''}} required="">
							<label class="form-check-label" for="ahorra_si">Si</label>
						</div>
						<div class="form-check form-check-inline mt-1">
							<input class="form-check-input" type="radio" name="ahorra" id="ahorra_no" value="0" {{old('ahorra') == "0" ? 'checked=""' : ''}}>
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
		    						<option value="Semanal" {{old('tipo_ahorro') == "Semanal" ? 'selected=""' : ''}}>Semanal</option>
		    						<option value="Mensual" {{old('tipo_ahorro') == "Mensual" ? 'selected=""' : ''}}>Mensual</option>
		    					</select>
		    				</div>
						</div>
	    			</div>
		    	</div>
		    	<div class="form-group row">
		    		<label for="otro_participante" class="col-form-label col-sm-5">¿Alguna otra persona participará en la compra?</label>
					<div class="col-sm-1">
	    				<div class="form-check form-check-inline mt-1">
							<input class="form-check-input" type="radio" name="otro_participante" id="otro_participante_si" value="1" required="" {{old('otro_participante') == "1" ? 'checked=""' : ''}}>
							<label class="form-check-label" for="otro_participante_si">Si</label>
						</div>
						<div class="form-check form-check-inline mt-1">
							<input class="form-check-input" type="radio" name="otro_participante" id="otro_participante_no" value="0" {{old('otro_participante') == "0" ? 'checked=""' : ''}}>
							<label class="form-check-label" for="otro_participante_no">No</label>
						</div>
	    			</div>
	    			<div class="col-sm-6">
	    				<input type="text" name="participante" id="participante" value="{{old('participante')}}" class="form-control">
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
							<input class="form-check-input" type="radio" name="tarjeta_debito" id="tarjeta_debito_si" value="1" required="" {{old('tarjeta_debito') == "1" ? 'checked=""' : ''}}>
							<label class="form-check-label" for="tarjeta_debito_si">Si</label>
						</div>
						<div class="form-check form-check-inline mt-1">
							<input class="form-check-input" type="radio" name="tarjeta_debito" id="tarjeta_debito_no" value="0" {{old('tarjeta_debito') == "0" ? 'checked=""' : ''}}>
							<label class="form-check-label" for="tarjeta_debito_no">No</label>
						</div>
	    			</div>
	    			<label for="" class="col-form-label col-sm-1">#</label>
	    			<div class="col-sm-3">
	    				<input type="number" name="numero_tarjeta_debito" id="numero_tarjeta_debito" value="{{old('numero_tarjeta_debito')}}" class="form-control">
	    			</div>
		    	</div>
				<div class="form-group row">
					<div class="col-sm-12">
						<div class="input-group mb-3" title="Tarjetas de débito">
							<div class="input-group-prepend">
								<span class="input-group-text"  title="Tarjetas de débito">
									<i class="far fa-credit-card"></i>
								</span>
							</div>
							<select name="tarjetas_debito[]" id="tarjetas_debito" class="select-bancos form-control w-75" multiple="multiple">
								@foreach ($bancos as $banco)
									<option value="{{$banco->nombre}}" {{old('tarjetas_debito') && in_array($banco->nombre,old('tarjetas_debito')) ? 'selected=""' : ''}} title="{{$banco->etiqueta}}">{{$banco->nombre}}</option>
								@endforeach
							</select>

						</div>
					</div>
				</div>
				<div class="form-group row">
					<label for="en_buro_credito" class="col-form-label col-sm-3">Buró de Crédito:</label>
					<div class="col-sm-3">
						<div class="form-check form-check-inline mt-1">
							<input class="form-check-input" type="radio" name="en_buro_credito" id="en_buro_credito_si" value="1" required="" {{old('en_buro_credito') == '1' ? 'checked=""' : ''}}>
							<label class="form-check-label" for="en_buro_credito_si">Si</label>
						</div>
						<div class="form-check form-check-inline mt-1">
							<input class="form-check-input" type="radio" name="en_buro_credito" id="en_buro_credito_no" value="0"  {{old('en_buro_credito') == '0' ? 'checked=""' : ''}}>
							<label class="form-check-label" for="en_buro_credito_no">No</label>
						</div>
					</div>
					<div class="col-sm-6">
						<input type="text" name="buro_credito" class="form-control" value="{{old('buro_credito')}}">
					</div>
				</div>
				<hr>
				<div class="form-group row">
		    		<label for="tarjeta_credito" class="col-form-label col-sm-6">Tarjeta de Crédito:</label>
	    			<div class="col-sm-2">
	    				<div class="form-check form-check-inline mt-1">
							<input class="form-check-input" type="radio" name="tarjeta_credito" id="tarjeta_credito_si" value="1" required=""  {{old('tarjeta_credito') == '1' ? 'checked=""' : ''}}>
							<label class="form-check-label" for="tarjeta_credito_si">Si</label>
						</div>
						<div class="form-check form-check-inline mt-1">
							<input class="form-check-input" type="radio" name="tarjeta_credito" id="tarjeta_credito_no" value="0"  {{old('en_buro_credito') == '0' ? 'checked=""' : ''}}>
							<label class="form-check-label" for="tarjeta_credito_no">No</label>
						</div>
	    			</div>
	    			<label for="numero_tarjeta_credito" class="col-form-label col-sm-1">#</label>
	    			<div class="col-sm-3">
	    				<input type="number" name="numero_tarjeta_credito" id="numero_tarjeta_credito" value="{{old('numero_tarjeta_credito')}}" class="form-control">
	    			</div>
		    	</div>
				<div class="form-group row">
					<div class="col-sm-12">
						<div class="input-group mb-3"  title="Tarjetas de crédito">
							<div class="input-group-prepend">
								<span class="input-group-text" title="Tarjetas de crédito">
									<i class="fas fa-credit-card"></i>
								</span>
							</div>
							<select name="tarjetas_credito[]" id="tarjetas_credito" class="select-bancos form-control w-75" multiple="multiple">
								@foreach ($bancos as $banco)
									<option value="{{$banco->nombre}}" {{old('tarjetas_credito') && in_array($banco->nombre,old('tarjetas_credito')) ? 'selected=""' : ''}} title="{{$banco->etiqueta}}">{{$banco->nombre}}</option>
								@endforeach
							</select>
						</div>
					</div>
				</div>
				<div class="form-group row">
					<label for="limite_credito" class="col-form-label col-sm-3">Límite de Credito:</label>
					<div class="col-sm-9">
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text" id="basic-addon1">$</span>
							</div>
							<input type="number" step="any" min="0" class="form-control" name="limite_credito" value="{{old('limite_credito')}}" id="limite_credito">
						</div>
					</div>
				</div>
				<hr>
				<div class="form-group row">
					<label for="destino_1" class="col-form-label col-sm-2">Destino:</label>
					<div class="col-sm-4">
						<input type="text" name="destino_1" class="form-control" value="{{old('destino_1')}}" required="">
					</div>
					<div class="col-sm-2">
						<div class="form-check form-check-inline mt-1">
							<input class="form-check-input" type="radio" name="tipo_destino_1" id="tipo_destino_1_semanal" value="Semanal" required="" {{old('tipo_destino_1') == 'Semanal' ? 'checked=""' : ''}}>
							<label class="form-check-label" for="tipo_destino_1_semanal">Semanal</label>
						</div>
						<div class="form-check form-check-inline mt-1">
							<input class="form-check-input" type="radio" name="tipo_destino_1" id="tipo_destino_1_mensual" value="Mensual" {{old('tipo_destino_1') == 'Mensual' ? 'checked=""' : ''}}>
							<label class="form-check-label" for="tipo_destino_1_mensual">Mensual</label>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text" id="basic-addon1">$</span>
							</div>
							<input type="number" step="any" min="0" class="form-control" name="monto_destino_1" id="monto_destino_1" required="" value="{{old('monto_destino_1')}}">
						</div>
					</div>
				</div>
				<div class="form-group row">
					<label for="destino_2" class="col-form-label col-sm-2">Destino:</label>
					<div class="col-sm-4">
						<input type="text" name="destino_2" class="form-control" value="{{old('destino_2')}}" required="">
					</div>
					<div class="col-sm-2">
						<div class="form-check form-check-inline mt-1">
							<input class="form-check-input" type="radio" name="tipo_destino_2" id="tipo_destino_2_semanal" value="Semanal" required=""  {{old('tipo_destino_2') == 'Semanal' ? 'checked=""' : ''}}>
							<label class="form-check-label" for="tipo_destino_2_semanal">Semanal</label>
						</div>
						<div class="form-check form-check-inline mt-1">
							<input class="form-check-input" type="radio" name="tipo_destino_2" id="tipo_destino_2_mensual" value="Mensual"  {{old('tipo_destino_2') == 'Mensual' ? 'checked=""' : ''}}>
							<label class="form-check-label" for="tipo_destino_2_mensual">Mensual</label>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text" id="basic-addon1">$</span>
							</div>
							<input type="number" step="any" min="0" class="form-control" name="monto_destino_2" id="monto_destino_2" value="{{old('monto_destino_2')}}" required="">
						</div>
					</div>
				</div>
				<div class="form-group row">
					<label for="destino_3" class="col-form-label col-sm-2">Destino:</label>
					<div class="col-sm-4">
						<input type="text" name="destino_3" class="form-control" required="" value="{{old('destino_3')}}">
					</div>
					<div class="col-sm-2">
						<div class="form-check form-check-inline mt-1">
							<input class="form-check-input" type="radio" name="tipo_destino_3" id="tipo_destino_3_semanal" value="Semanal" required=""  {{old('tipo_destino_3') == 'Semanal' ? 'checked=""' : ''}}>
							<label class="form-check-label" for="tipo_destino_3_semanal">Semanal</label>
						</div>
						<div class="form-check form-check-inline mt-1">
							<input class="form-check-input" type="radio" name="tipo_destino_3" id="tipo_destino_3_mensual" value="Mensual"  {{old('tipo_destino_3') == 'Mensual' ? 'checked=""' : ''}}>
							<label class="form-check-label" for="tipo_destino_3_mensual">Mensual</label>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text" id="basic-addon1">$</span>
							</div>
							<input type="number" step="any" min="0" class="form-control" name="monto_destino_3" id="monto_destino_3" value="{{old('monto_destino_3')}}" required="">
						</div>
					</div>
				</div>
				<div class="form-group row">
					<label for="calificacion_credito" class="col-form-label col-sm-6">Calificación del cliente:</label>
					<div class="col-sm-6">
						<div class="form-check form-check-inline mt-1">
							<input class="form-check-input" type="radio" name="calificacion_credito" id="calificacion_credito_bien" value="Bien" required=""  {{old('calificacion_credito') == 'Bien' ? 'checked=""' : ''}}>
							<label class="form-check-label" for="calificacion_credito_bien">😊</label>
						</div>
						<div class="form-check form-check-inline mt-1">
							<input class="form-check-input" type="radio" name="calificacion_credito" id="calificacion_credito_regular" value="Regular" {{old('calificacion_credito') == 'Regular' ? 'checked=""' : ''}}>
							<label class="form-check-label" for="calificacion_credito_regular">😐</label>
						</div>
						<div class="form-check form-check-inline mt-1">
							<input class="form-check-input" type="radio" name="calificacion_credito" id="calificacion_credito_mal" value="Mal" {{old('calificacion_credito') == 'Mal' ? 'checked=""' : ''}}>
							<label class="form-check-label" for="calificacion_credito_mal">☹️</label>
						</div>
					</div>
				</div>
				<div class="form-group row">
					<label for="descripcion_calificacion" class="col-form-label col-sm-3">Descripción de calificación:</label>
					<div class="col-sm-9">
						<textarea class="form-control" rows="3" name="descripcion_calificacion" id="descripcion_calificacion">{{old('descripcion_calificacion')}}</textarea>
					</div>
				</div>
		    </div>
		    <div class="card-header">
		    	Inmueble Pretendido:
		    </div>
		    <div class="card-body">
		    	<div class="form-group row">
		    		<div class="col-sm-12">
		    			<div class="form-check form-check-inline mt-1">
							<input class="form-check-input" type="radio" name="tipo_inmueble" id="tipo_inmueble_casa" value="Casa" required="" {{old('tipo_inmueble') == 'Casa' ? 'checked=""' : ''}}>
							<label class="form-check-label" for="tipo_inmueble_casa">Casa</label>
						</div>
		    			<div class="form-check form-check-inline mt-1">
							<input class="form-check-input" type="radio" name="tipo_inmueble" id="tipo_inmueble_departamento" value="Departamento" {{old('tipo_inmueble') == 'Departamento' ? 'checked=""' : ''}}>
							<label class="form-check-label" for="tipo_inmueble_departamento">Departamento</label>
						</div>
		    			<div class="form-check form-check-inline mt-1">
							<input class="form-check-input" type="radio" name="tipo_inmueble" id="tipo_inmueble_terreno" value="Terreno" {{old('tipo_inmueble') == 'Terreno' ? 'checked=""' : ''}}>
							<label class="form-check-label" for="tipo_inmueble_terreno">Terreno</label>
						</div>
		    			<div class="form-check form-check-inline mt-1">
							<input class="form-check-input" type="radio" name="tipo_inmueble" id="tipo_inmueble_local" value="Local Comercial" {{old('tipo_inmueble') == 'Local Comercial' ? 'checked=""' : ''}}>
							<label class="form-check-label" for="tipo_inmueble_local">Local Comercial</label>
						</div>
		    			<div class="form-check form-check-inline mt-1">
							<input class="form-check-input" type="radio" name="tipo_inmueble" id="tipo_inmueble_bodega" value="Bodega" {{old('tipo_inmueble') == 'Bodega' ? 'checked=""' : ''}}>
							<label class="form-check-label" for="tipo_inmueble_bodega">Bodega</label>
						</div>
					</div>
				</div>
				<div class="form-group row">
		    		<div class="offset-3 col-sm-3">
		    			<div class="form-check form-check-inline mt-1">
							<input class="form-check-input" type="radio" name="tipo_inmueble" id="tipo_inmueble_otro" value="Otro" {{old('tipo_inmueble') == 'Otro' ? 'checked=""' : ''}}>
							<label class="form-check-label" for="tipo_inmueble_otro">Otro:</label>
						</div>
					</div>
					<div class="col-sm-6">
						<input type="text" name="otro_name" value="{{old('otro_name')}}" class="form-control">
					</div>
		    	</div>
		    	<div class="form-group row">
		    		<label for="precio_aprox" class="col-form-label col-sm-3">Precio Aproximado:</label>
		    		<div class="col-sm-4">
		    			<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text" id="basic-addon1">$</span>
							</div>
							<input type="number" step="any" min="0" class="form-control" value="{{old('precio_aprox') ? old('precio_aprox') : $cotizacion->monto}}" name="precio_aprox" id="precio_aprox" required="">
						</div>
		    		</div>
		    		<label for="area_inmueble" class="col-form-label col-sm-2">Area:</label>
		    		<div class="col-sm-3">
		    			<div class="input-group">
							<input type="number" step="any" min="0" class="form-control" name="area_inmueble" id="area_inmueble" required="" value="{{old('area_inmueble')}}">
							<div class="input-group-append">
								<span class="input-group-text" id="basic-addon1">m²</span>
							</div>
						</div>
		    		</div>
		    	</div>
		    	<div class="form-group row">
		    		<label for="estado" class="col-form-label col-sm-2">Estado:</label>
		    		<div class="col-sm-4">
		    			<input type="text" name="estado" class="form-control" value="{{old('estado')}}" required="">
		    		</div>
		    		<label for="colonia" class="col-form-label col-sm-2">Colonia:</label>
		    		<div class="col-sm-4">
		    			<input type="text" name="colonia" class="form-control" value="{{old('colonia')}}" required="">
		    		</div>
		    	</div>
		    	<div class="form-group row">
		    		<label class="col-form-label col-sm-3" for="recamara">Recámaras:</label>
		    		<div class="col-sm-3">
		    			<input type="number" min="0" name="recamara" class="form-control" value="{{old('recamara')}}" required="">
		    		</div>
		    		<label class="col-form-label col-sm-3" for="banio">Baños:</label>
		    		<div class="col-sm-3">
		    			<input type="number" min="0" step="any" name="banio" class="form-control" value="{{old('banio')}}" required="">
		    		</div>
				</div>
		    	<div class="form-group row">
		    		<label class="col-form-label col-sm-3" for="estacionamiento">Lugares de Estacionamiento:</label>
		    		<div class="col-sm-3">
		    			<input type="number" min="0" value="0" name="estacionamiento" class="form-control" required="" value="{{old('estacionamiento')}}">
		    		</div>
		    		<label class="col-form-label col-sm-3" for="jardin">Jardin:</label>
		    		<div class="col-sm-3">
		    			<input type="number" min="0" value="0" name="jardin" class="form-control" required="" value="{{old('jardin')}}">
		    		</div>
		    	</div>
		    	<div class="form-group row">
		    		<label class="col-form-label col-sm-2" for="gastos_notariales">Gastos Notariales:</label>
		    		<div class="col-sm-3">
		    			<input type="text" name="gastos_notariales" class="form-control" value="{{old('gastos_notariales')}}">
		    		</div>
		    		<label class="col-form-label col-sm-2" for="monto_contratar">Monto a contratar:</label>
		    		<div class="col-sm-5">
		    			<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text" id="basic-addon1">$</span>
							</div>
							<input type="number" step="any" min="0" step="any" value="{{$cotizacion->monto}}" class="form-control" name="monto_contratar" id="monto_contratar" required="">
						</div>
		    		</div>
		    	</div>
		    	<div class="form-group row">
		    		<label for="tiempo_decision" class="col-form-label col-sm-12">¿Cuánto tiempo ha pensado en esta compra?</label>
		    		<div class="col-sm-12">
		    			<input type="text" name="tiempo_decision" class="form-control" required="" value="{{old('tiempo_decision')}}">
		    		</div>
		    	</div>
		    	<div class="form-group row">
		    		<label class="col-form-label col-sm-12" for="prioridad">¿Cuánta prioridad le da a esta meta?</label>
		    		<div class="col-sm-12">
		    			<input type="text" name="prioridad" class="form-control" required="" value="{{old('prioridad')}}">
		    		</div>
		    	</div>
		    	<div class="form-group row">
		    		<label class="col-form-label col-sm-9" for="desicion_propia">¿La decisión de cumplir su meta depende de alguien más?</label>
		    		<div class="col-sm-3">
		    			<div class="form-check form-check-inline mt-1">
							<input class="form-check-input" type="radio" name="desicion_propia" id="desicion_propia_si" value="1" required="" {{old('desicion_propia') == "1" ? 'checked=""' : '' }}>
							<label class="form-check-label" for="desicion_propia_si">Si</label>
						</div>
		    			<div class="form-check form-check-inline mt-1">
							<input class="form-check-input" type="radio" name="desicion_propia" id="desicion_propia_no" value="0" {{old('desicion_propia') == "0" ? 'checked=""' : '' }}>
							<label class="form-check-label" for="desicion_propia_no">No</label>
						</div>
		    		</div>
		    		<div class="col-sm-12">
		    			<textarea name="toma_desicion" class="form-control">{{old('toma_desicion')}}</textarea>
		    		</div>
		    	</div>
		    	<div class="form-group row">
		    		<label class="col-form-label col-sm-12" for="lograr_meta">¿Porqué no ha logrado su meta?</label>
		    		<div class="col-sm-12">
		    			<textarea name="lograr_meta" class="form-control">{{old('lograr_meta')}}</textarea>
		    		</div>
		    	</div>
		    	<div class="form-group row">
		    		<label class="col-form-label col-sm-9" for="tomaria_desicion">
		    			Si el día de hoy le ofrecemos una propuesta de esquema de financiamiento adaptada a sus necesidades y posibilidades ¿Lo tomaría? 
		    		</label>
		    		<div class="col-sm-3 mt-4">
		    			<div class="form-check form-check-inline mt-1">
							<input class="form-check-input" type="radio" name="tomaria_desicion" id="tomaria_desicion_si" value="1" {{old('tomaria_desicion') == "1" ? 'checked=""' : ''}}  required="">
							<label class="form-check-label" for="tomaria_desicion_si">Si</label>
						</div>
		    			<div class="form-check form-check-inline mt-1">
							<input class="form-check-input" type="radio" name="tomaria_desicion" id="tomaria_desicion_no" value="0" {{old('tomaria_desicion') == "0" ? 'checked=""' : ''}}>
							<label class="form-check-label" for="tomaria_desicion_no">No</label>
						</div>
		    		</div>
		    		<div class="col-sm-12">
		    			<textarea name="motivo_tomaria_desicion" class="form-control">{{old('motivo_tomaria_desicion')}}</textarea>
		    		</div>
		    	</div>
		    	<div class="form-group row">
		    		<label for="medio_entero" class="col-form-label col-sm-6">Medio por el cuál se enteró de nosotros:</label>
		    		<div class="col-sm-6">
		    			<select name="medio_entero" id="medio_entero" required="" class="form-control">
							<option value="">Medío por el que se entero de nosotros</option>
							<option value="Internet" {{old('medio_entero') == "Internet" ? 'checked=""' : '' }}>Internet</option>
							<option value="T.V." {{old('medio_entero') == "T.V." ? 'checked=""' : '' }}>T.V.</option>
							<option value="Periodico" {{old('medio_entero') == "Periodico" ? 'checked=""' : '' }}>Periodico</option>
							<option value="Otro" {{old('medio_entero') == "Otro" ? 'checked=""' : '' }}>Otro</option>
						</select>
		    		</div>
		    	</div>
		    </div>
			<div class="card-header">
				Referencias Personales:
			</div>
			<div class="card-body">
				<h4>Referencia #1</h4>
				<div class="form-group row">
					<label class="col-form-label col-sm-2" for="nombre_completo[1]">Nombre:</label>
					<div class="form-group col-sm-10 pr-0 pl-0">
						<div class="input-group">
							<input type="text" name="nombre[1]" id="nombre[1]" placeholder="Nombre" value="{{old("nombre_1")}}" class="form-control" required="">
							<input type="text" name="paterno[1]" id="paterno[1]" placeholder="Apellido Paterno" value="{{ old("paterno[1]")}}" class="form-control" required="">
							<input type="text" name="materno[1]" id="materno[1]" placeholder="Apellido Materno" value="{{ old("materno[1]")}}" class="form-control">
						</div>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-form-label col-sm-2" for="parentesco[1]">Parentesco:</label>
					<div class="form-group col-sm-2 pr-0 pl-0">
						<input type="text" name="parentesco[1]" value="{{old('parentesco[1]')}}" class="form-control" required="">
					</div>
					<label class="col-form-label col-sm-2" for="telefono[1]">Telefonos:</label>
					<div class="form-group col-sm-6 pr-0 pl-0">
						<div class="input-group">
							<input type="text" name="telefono[1]" value="{{old('telefono[1]')}}" class="form-control" placeholder="Particular" required="">
							<input type="text" name="celular[1]" value="{{old('celular[1]')}}" class="form-control" placeholder="Celular" required="">
						</div>
					</div>
				</div>
				<h4>Referencia #2</h4>
				<div class="form-group row">
					<label class="col-form-label col-sm-2" for="nombre_completo[2]">Nombre:</label>
					<div class="form-group col-sm-10 pr-0 pl-0">
						<div class="input-group">
							<input type="text" name="nombre[2]" id="nombre[2]" placeholder="Nombre" value="{{old("nombre_1")}}" class="form-control" required="">
							<input type="text" name="paterno[2]" id="paterno[2]" placeholder="Apellido Paterno" value="{{ old("paterno[2]")}}" class="form-control" required="">
							<input type="text" name="materno[2]" id="materno[2]" placeholder="Apellido Materno" value="{{ old("materno[2]")}}" class="form-control">
						</div>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-form-label col-sm-2" for="parentesco[2]">Parentesco:</label>
					<div class="form-group col-sm-2 pr-0 pl-0">
						<input type="text" name="parentesco[2]" value="{{old('parentesco[2]')}}" class="form-control" required="">
					</div>
					<label class="col-form-label col-sm-2" for="telefono[2]">Telefonos:</label>
					<div class="form-group col-sm-6 pr-0 pl-0">
						<div class="input-group">
							<input type="text" name="telefono[2]" value="{{old('telefono[2]')}}" class="form-control" placeholder="Particular" required="">
							<input type="text" name="celular[2]" value="{{old('celular[2]')}}" class="form-control" placeholder="Celular" required="">
						</div>
					</div>
				</div>
				<h4>Referencia #3</h4>
				<div class="form-group row">
					<label class="col-form-label col-sm-2" for="nombre_completo[3]">Nombre:</label>
					<div class="form-group col-sm-10 pr-0 pl-0">
						<div class="input-group">
							<input type="text" name="nombre[3]" id="nombre[3]" placeholder="Nombre" value="{{old("nombre_1")}}" class="form-control" required="">
							<input type="text" name="paterno[3]" id="paterno[3]" placeholder="Apellido Paterno" value="{{ old("paterno[3]")}}" class="form-control" required="">
							<input type="text" name="materno[3]" id="materno[3]" placeholder="Apellido Materno" value="{{ old("materno[3]")}}" class="form-control">
						</div>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-form-label col-sm-2" for="parentesco[3]">Parentesco:</label>
					<div class="form-group col-sm-2 pr-0 pl-0">
						<input type="text" name="parentesco[3]" value="{{old('parentesco[3]')}}" class="form-control" required="">
					</div>
					<label class="col-form-label col-sm-2" for="telefono[3]">Telefonos:</label>
					<div class="form-group col-sm-6 pr-0 pl-0">
						<div class="input-group">
							<input type="text" name="telefono[3]" value="{{old('telefono[3]')}}" class="form-control" placeholder="Particular" required="">
							<input type="text" name="celular[3]" value="{{old('celular[3]')}}" class="form-control" placeholder="Celular" required="">
						</div>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-form-label col-sm-12" for="observaciones">Observaciones:</label>
					<div class="col-sm-12">
						<textarea class="form-control" name="observaciones" id="observaciones" rows="5">{{old('observaciones')}}</textarea>
					</div>
				</div>
			</div>
			<div class="card-footer">
				<div class="d-flex justify-content-center">
					<button class="btn btn-primary" type="submit">Guardar</button>
				</div>
			</div>
		</div>
	</form>
  </div>
</div>
@endsection
@push('scripts')
	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
	<script type="text/javascript">
	    $(document).ready(function() {
	        $('.select-bancos').select2();
	    });
    </script>
    <script type="text/javascript">
    	$('#perfil input[name=estado_civil]').on('change', function() {
    		var val = $('input[name=estado_civil]:checked', '#perfil').val();
    		// alert(val);
			$("#pareja").empty();
    		if(val == "Casado" || val == "Unión Libre"){
    			var html_row = `
    			<div class="form-group row" id="regimen_matrimonial">
	    			<label for="regimen_matrimonial" class="col-form-label col-sm-4">Régimen matrimonial:</label>
	    			<div class="col-sm-8">
	    				<div class="form-check form-check-inline mt-1">
							<input class="form-check-input" type="radio" name="regimen_matrimonial" id="Sociedad Conyugal" value="Sociedad Conyugal" required="" {{old('regimen_matrimonial') == "Sociedad Conyugal" ? 'checked=""' : ''}}>
							<label class="form-check-label" for="Sociedad Conyugal">Sociedad Conyugal</label>
						</div>
						<div class="form-check form-check-inline mt-1">
							<input class="form-check-input" type="radio" name="regimen_matrimonial" id="Separación de Bienes" value="Separación de Bienes" {{old('regimen_matrimonial') == "Separación de Bienes" ? 'checked=""' : ''}}>
							<label class="form-check-label" for="Separación de Bienes">Separación de Bienes</label>
						</div>
	    			</div>
	    		</div>
    			<div class="form-group row">
    				<h5 class="card-title col-12">Datos de la pareja:</h5>
    			</div>
    			<div class="form-group row">
		    		<div class="col-12">
			    		<div class="input-group">
							<select class="custom-select" name="prefijo_2" id="prefijo_2" required="">
								<option value="" {{old('prefijo_2' == "" ? 'selected=""' : '')}}>Elige...</option>
								<option value="Sr." {{old('prefijo_2' == "Sr." ? 'selected=""' : '')}}>Sr.</option>
								<option value="Sra." {{old('prefijo_2' == "Sra." ? 'selected=""' : '')}}>Sra.</option>
								<option value="Srta." {{old('prefijo_2' == "Srta." ? 'selected=""' : '')}}>Srta.</option>
							</select>
							<div class="input-group-append w-75">
								<input type="text" name="nombre_2" id="nombre_2" placeholder="Nombre" value="{{old("nombre_2") ? old('nombre_2') : ''}}" class="form-control" required="">
								<input type="text" name="paterno_2" id="paterno_2" placeholder="Apellido Paterno" value="{{ old("paterno_2") ? old("paterno_2") : ''}}" class="form-control" required="">
								<input type="text" name="materno_2" id="materno_2" placeholder="Apellido Materno" value="{{ old("materno_2") ? old("materno_2") : ''}}" class="form-control">
							</div>
						</div>
		    		</div>
		    	</div>
    			<div class="form-group row">
		    		<label for="ocupacion_2" class="col-form-label col-sm-2">Ocupación:</label>
		    		<div class="col-sm-10">
		    			<input type="text" name="ocupacion_2" class="form-control" id="ocupacion_2" value="{{old('ocupacion_2')}}" placeholder="Ocupación de la pareja"  required="">
		    		</div>
		    	</div>
		    	<div class="form-group row">
		    		<label for="empresa_2" class="col-form-label col-sm-2">Empresa:</label>
		    		<div class="col-sm-10">
		    			<input type="text" name="empresa_2" class="form-control" id="empresa_2" value="{{old('empresa_2')}}" placeholder="Empresa en la que labora de la pareja"  required="">
		    		</div>
		    	</div>
		    	<div class="form-group row">
		    		<label for="antiguedad_2" class="col-form-label col-sm-3">Antigüedad:</label>
		    		<div class="col-sm-9">
		    			<input type="text" name="antiguedad_2" class="form-control" id="antiguedad_2" placeholder="Antigüedad en la empresa" value="{{old('antiguedad_2')}}" required="">
		    		</div>
		    	</div>
		    	<div class="form-group row">
		    		<label for="salario_2" class="col-form-label col-sm-2">Salario:</label>
		    		<div class="col-sm-10">
		    			<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text" id="basic-addon1">$</span>
							</div>
							<input type="number" name="salario_2" class="form-control" min="0" id="salario_2" placeholder="Salario de la pareja" value="{{old('salario_2')}}" required="">
						</div>
		    		</div>
		    	</div>
		    	<div class="form-group row">
		    		<label for="rfc_2" class="col-form-label col-sm-2">RFC:</label>
		    		<div class="col-sm-10">
		    			<input type="text" name="rfc_2" class="form-control" id="rfc_2" value="{{old('rfc_2')}}" placeholder="RFC de la pareja">
		    		</div>
		    	</div>
		    	<div class="form-group row">
		    		<label for="nacionalidad_2" class="col-form-label col-sm-3">Nacionalidad:</label>
		    		<div class="col-sm-9">
		    			<input type="text" name="nacionalidad_2" class="form-control" id="nacionalidad_2" placeholder="Nacionalidad de la pareja" value="{{old('nacionalidad_2')}}" required="">
		    		</div>
		    	</div>
    			`;
    			$("#pareja").html(html_row);
    		}

		   // if ($('input[name=estado_civil]:checked', '#perfil').val() == "casado") {
		   	// alert('Se frego'):

		   // } 
		});

		// CP
		$("#cp").change(function(){
			var cp = $("#cp").val();

			$("#colonia").empty();
			$("#colonia").append("<option>Seleccione una colonía ó población</option>");
			$.ajax({
				url: `{{ url('cp') }}/${cp}`,
				dataType: 'json',
				success:function(result,status,xhr){
					console.log(result);
					let res_array = result.cp;
					res_array.forEach(function(item,index){
						var opt = `<option value="${item.poblacion}">${item.poblacion}</option>`
						$("#colonia").append(opt)
					})
				},
				error:function(xhr,status,error){
					alert(error);
				}
			});
		});
		$("#colonia").change(function(){
			var cp = $("#cp").val();
			var colonia = $("#colonia").val();
			$.ajax({
				url: `{{ url('cp') }}/${cp}/${colonia}`,
				dataType: 'json',
				success:function(result,status,xhr){
					let res = result.cp[0];
					$("#municipio").val(res.municipio);
					$("#estado").val(res.estado);
				},
				error:function(xhr,status,error){
					alert(error);
				}
			});
		});
    </script>
@endpush
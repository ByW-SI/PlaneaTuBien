@extends('principal')
@section('content')
<div class="row no-guttters">
  <div class="d-sm-none d-md-block col">
    @include('prospectos.perfil.info')
  </div>
  <div class="col">
 	<div class="card">
 		<div class="card-header">
	        <div class="d-flex justify-content-between">
	        	<h4>Perfil:</h4>   
	        	<a href="{{ route('prospectos.perfil.pdf',['prospecto'=>$prospecto]) }}" class="btn btn-success">Imprimir perfil</a>
	        	@if($cotizacion && $cotizacion->plan->abreviatura != "PL")
	        		<a class="btn btn-success" href="{{ route('prospectos.cotizacions.pagos.index',['prospecto'=>$prospecto,'cotizacion'=>$cotizacion]) }}">Pagos</a>
	        	@endif
	        	@if ($cotizacion && $cotizacion->liberar)
	        		<a href="{{ route('prospectos.presolicitud.index',['prospecto'=>$prospecto]) }}" class="btn btn-success">Presolicitud</a>
	        	@endif
	        </div>
	    </div>
	    <div class="card-body">
	    	<div class="row">
		    	<label for="folio" class="offset-5 col-sm-2 col-form-label">Folio:</label>
			    <div class="col">
			      	<label class="form-control" readonly="">{{$perfil->folio}}</label>
			    </div>
	    	</div>
	    	<div class="row">
		    	<label for="asesor" class="offset-5 col-sm-2 col-form-label">Asesor:</label>
			    <div class="col">
			    	@if($perfil->asesor)
			      	<label class="form-control" readonly="">{{$perfil->asesor->nombre." ".$perfil->asesor->paterno." ".$perfil->asesor->materno}}</label>
			      	@else
			      		<label class="form-control" readonly="">--</label>
			      	@endif
			    </div>
	    	</div>
	    	<div class="row">
		    	<label for="fecha" class="offset-5 col-sm-2 col-form-label">fecha:</label>
			    <div class="col">
			      	<label class="form-control" readonly="">{{$perfil->fecha}}</label>
			    </div>
	    	</div>
	    	<div class="row">
		    	<label for="clave" class="offset-5 col-sm-2 col-form-label">Clave:</label>
			    <div class="col">
			      	<label class="form-control" readonly="">{{$perfil->clave}}</label>
			    </div>
	    	</div>
	    	<div class="row">
		    	<label for="plan" class="offset-5 col-sm-2 col-form-label">Plan:</label>
			    <div class="col">
			      	<label class="form-control" readonly="">{{$perfil->plan}}</label>
			    </div>
	    	</div>
	    	{{-- {{$perfil->historial_crediticio}} --}}
	    </div>
	    <ul class="nav nav-tabs" id="myTab" role="tablist">
		  <li class="nav-item">
		    <a class="nav-link active" id="datos_personal-tab" data-toggle="tab" href="#datos_personal" role="tab" aria-controls="datos_personal" aria-selected="true">Datos personales</a>
		  </li>
		  <li class="nav-item disabled" aria-disabled="true">
		    <a class="nav-link  disabled" aria-disabled="true" id="crediticio-tab" data-toggle="tab" href="#crediticio" role="tab" aria-controls="crediticio" aria-selected="false">Historial crediticio</a>
		  </li>
		  <li class="nav-item disabled" aria-disabled="true">
		    <a class="nav-link  disabled" aria-disabled="true" id="inmueble-tab" data-toggle="tab" href="#inmueble" role="tab" aria-controls="inmueble" aria-selected="false">Inmueble</a>
		  </li>
		  <li class="nav-item disabled" aria-disabled="true">
		    <a class="nav-link  disabled" aria-disabled="true" id="referencia-tab" data-toggle="tab" href="#referencia" role="tab" aria-controls="referencia" aria-selected="false">Referencias personales</a>
		  </li>
		</ul>
		<div class="tab-content" id="myTabContent">
		  <div class="tab-pane fade show active" id="datos_personal" role="tabpanel" aria-labelledby="datos_personal-tab">
		  	<div class="card">
		  		<div class="card-header">
		  			Cambiar Datos Personales:
		  		</div>
		  		<form method="POST" action="{{ route('prospectos.perfil.datos_personal.update',['prospecto'=>$prospecto,'datos_personal'=>$datos_personal]) }}">
		  			@method('PUT')
		  			@csrf
			  		<div class="card-body">
			  			<div class="row-group row">
			  				<div class="form-group col-12 col-md-12">
			  					<label for="cliente">Cliente</label>
			  					<div class="input-group">
									<select class="custom-select" name="prefijo_1" id="prefijo_1" required="">
										<option value="">Elige...</option>
										<option value="Sr." {{$datos_personal->prefijo_1 == "Sr." ? "selected=''" : ( old('prefijo_1') == "Sr." ? "selected=''" :"")}}>Sr.</option>
										<option value="Sra." {{$datos_personal->prefijo_1 == "Sra." ? "selected=''" : ( old('prefijo_1') == "Sra." ? "selected=''" :"")}}>Sra.</option>
										<option value="Srta." {{$datos_personal->prefijo_1 == "Srta." ? "selected=''" : ( old('prefijo_1') == "Srta." ? "selected=''" :"")}}>Srta.</option>
									</select>
									<div class="input-group-append w-75">
									<input type="text" class="form-control" name="nombre_1" id="nombre_1" value="{{$datos_personal->nombre_1}}" required="">
									<input type="text" class="form-control" name="paterno_1" id="paterno_1" value="{{$datos_personal->paterno_1}}" required="">
									<input type="text" class="form-control" name="materno_1" id="materno_1" value="{{$datos_personal->materno_1}}" required="">
									</div>
								</div>
			  				</div>
			  				<div class="form-group col-12 col-md-6">
			  					<label for="ocupacion_1">Ocupación</label>
			  					<input type="text" class="form-control" name="ocupacion_1" value="{{$datos_personal->ocupacion_1}}" required="">
			  				</div>
			  				<div class="form-group col-12 col-md-6">
			  					<label for="empresa_1">Empresa</label>
			  					<input type="text" class="form-control" name="empresa_1" value="{{$datos_personal->empresa_1}}" required="">
			  				</div>
			  				<div class="form-group col-12 col-md-6">
			  					<label for="antiguedad_1">Antigüedad</label>
			  					<input type="text" class="form-control" name="antiguedad_1" value="{{$datos_personal->antiguedad_1}}" required="">
			  				</div>
			  				<div class="form-group col-12 col-md-6">
			  					<label for="salario_1">Salario</label>
			  					<input type="number" step="any" class="form-control" name="salario_1" value="{{$datos_personal->salario_1}}" required="" onchange="actualizarTotalIngreso()">
			  				</div>
			  				<div class="form-group col-12 col-md-6">
			  					<label for="rfc_1">RFC</label>
			  					<input type="text" class="form-control" name="rfc_1" value="{{$datos_personal->rfc_1}}" required="">
			  				</div>
			  				<div class="form-group col-12 col-md-6">
			  					<label for="nacionalidad_1">Nacionalidad</label>
			  					<input type="text" class="form-control" name="nacionalidad_1" value="{{$datos_personal->nacionalidad_1}}" required="">
			  				</div>
			  				<div class="form-group col-12 col-md-6">
			  					<label for="estado_civil">Estado civil:</label>
			  					<select name="estado_civil" id="estado_civil" class="form-control" required="">
			  						<option value="">Seleccione una opción</option>
			  						<option value="Soltero" {{$datos_personal->estado_civil == "Soltero" ? "selected=''" : ( old('estado_civil') == "Soltero" ? "selected=''" :"")}}>Soltero</option>
			  						<option value="Casado" {{$datos_personal->estado_civil == "Casado" ? "selected=''" : ( old('estado_civil') == "Casado" ? "selected=''" :"")}}>Casado</option>
			  						<option value="Unión Libre" {{$datos_personal->estado_civil == "Unión Libre" ? "selected=''" : ( old('estado_civil') == "Unión Libre" ? "selected=''" :"")}}>Unión Libre</option>
			  						<option value="Divorciado" {{$datos_personal->estado_civil == "Divorciado" ? "selected=''" : ( old('estado_civil') == "Divorciado" ? "selected=''" :"")}}>Divorciado</option>
			  						<option value="Viudo" {{$datos_personal->estado_civil == "Viudo" ? "selected=''" : ( old('estado_civil') == "Viudo" ? "selected=''" :"")}}>Viudo</option>
			  					</select>
			  				</div>
			  			</div>
			  			<div id="pareja_form">
			  				@if ($datos_personal->estado_civil == "Casado" || $datos_personal->estado_civil == "Unión Libre")
			  					<div class="row-group row" id="regimen_matrimonial">
				  					<div class="form-group col-12 col-md-6">
					  					<label for="regimen_matrimonial">Régimen matrimonial</label>
					  					<select name="regimen_matrimonial" id="regimen_matrimonial" class="form-control" required="">
					  						<option value="">Seleccione una opción</option>
					  						<option value="Sociedad Conyugal" {{$datos_personal->estado_civil == "Sociedad Conyugal" ? "selected=''" : ( old('estado_civil') == "Sociedad Conyugal" ? "selected=''" :"")}}>Sociedad Conyugal</option>
					  						<option value="Separación de Bienes" {{$datos_personal->estado_civil == "Separación de Bienes" ? "selected=''" : ( old('estado_civil') == "Separación de Bienes" ? "selected=''" :"")}}>Separación de Bienes</option>
					  					</select>
				  					</div>
				  				</div>
				  				<div class="form-group row">
				    				<h5 class="card-title col-12">Datos de la pareja:</h5>
				    			</div>
				    			<div class="row-group row">
					  				<div class="form-group col-12 col-md-6">
					  					<label for="pareja">Pareja</label>
					  					<div class="input-group">
											<select class="custom-select" name="prefijo_2" id="prefijo_2" required="">
												<option value="">Elige...</option>
												<option value="Sr." {{$datos_personal->prefijo_2 == "Sr." ? "selected=''" : ( old('prefijo_2') == "Sr." ? "selected=''" :"")}}>Sr.</option>
												<option value="Sra." {{$datos_personal->prefijo_2 == "Sra." ? "selected=''" : ( old('prefijo_2') == "Sra." ? "selected=''" :"")}}>Sra.</option>
												<option value="Srta." {{$datos_personal->prefijo_2 == "Srta." ? "selected=''" : ( old('prefijo_2') == "Srta." ? "selected=''" :"")}}>Srta.</option>
											</select>
											<div class="input-group-append w-75">
											<input type="text" class="form-control" name="nombre_completo_2" id="nombre_completo_1" value="{{$datos_personal->nombre_completo_2}}" required="">
											</div>
										</div>
					  				</div>
					  				<div class="form-group col-12 col-md-6">
					  					<label for="ocupacion_2">Ocupación</label>
					  					<input type="text" class="form-control" name="ocupacion_2" value="{{$datos_personal->ocupacion_2}}" required="">
					  				</div>
					  				<div class="form-group col-12 col-md-6">
					  					<label for="empresa_2">Empresa</label>
					  					<input type="text" class="form-control" name="empresa_2" value="{{$datos_personal->empresa_2}}" required="">
					  				</div>
					  				<div class="form-group col-12 col-md-6">
					  					<label for="antiguedad_2">Antigüedad</label>
					  					<input type="text" class="form-control" name="antiguedad_2" value="{{$datos_personal->antiguedad_2}}" required="">
					  				</div>
					  				<div class="form-group col-12 col-md-6">
					  					<label for="salario_2">Salario</label>
					  					<input type="text" class="form-control" name="salario_2" value="{{$datos_personal->salario_2}}" required="">
					  				</div>
					  				<div class="form-group col-12 col-md-6">
					  					<label for="rfc_2">RFC</label>
					  					<input type="text" class="form-control" name="rfc_2" value="{{$datos_personal->rfc_2}}" required="">
					  				</div>
					  				<div class="form-group col-12 col-md-6">
					  					<label for="nacionalidad_2">Nacionalidad</label>
					  					<input type="text" class="form-control" name="nacionalidad_2" value="{{$datos_personal->nacionalidad_2}}" required="">
					  				</div>
					  			</div>
			  				@endif
			  			</div>
			  			<div class="row-group row">
			  				<div class="form-group row">
			  					<!-- DIRECCION-->
					    		<label for="direccion" class="col-form-label col-sm-2">Direccion:</label>
					    		<div class="col-sm-10">
					    			<div class="input-group">
					    				<div class="input-group-prepend">
					    					<span class="input-group-text">✱ Calle</span>
					    				</div>
					    				<input type="text" name="calle" id="calle" class="form-control w-25" placeholder="Calle" required="" value="{{$datos_personal->calle}}">
					    			</div>
					    			<div class="input-group">
					    				<div class="input-group-prepend">
					    					<span class="input-group-text">✱ Número ext.</span>
					    				</div>
				    					<input type="text" name="numero_ext" class="form-control" required="" value="{{$datos_personal->numero_ext}}">
					    				<div class="input-group-prepend">
					    					<span class="input-group-text"> Número int.</span>
					    				</div>
				    					<input type="text" name="numero_int" class="form-control" value="{{$datos_personal->numero_int}}">
					    			</div>
					    		</div>
					    		<div class="col-sm-10 offset-sm-2">
					    			<div class="input-group">
					    				<input type="text" name="cp" id="cp" class="form-control" placeholder="Código Postal" required="" value="{{$datos_personal->cp}}">
					    				<select class="form-control" name="colonia" id="colonia" required="">
											<option>Seleccione una colonía ó población</option>
										</select>
					    			</div>
					    		</div>
					    		<div class="col-sm-10 offset-sm-2">
				    				<div class="input-group">
					    				<input type="text" class="form-control" placeholder="Alcaldía o Municipio" value="{{$datos_personal->municipio}}" name="municipio" id="municipio" required="" readonly="">
					    				<input type="text" class="form-control" placeholder="Estado" value="{{$datos_personal->estado}}" name="estado" id="estado" required="" readonly="">
					    			</div>
					    		</div>
					    	</div>
					    	<!-- FIN DIRECCION-->
			  				<div class="form-group col-12 col-md-6">
			  					<label for="telefono_casa">Teléfono de casa</label>
			  					<input type="text" class="form-control" name="telefono_casa" value="{{$datos_personal->telefono_casa}}" required="">
			  				</div>
			  				<div class="form-group col-12 col-md-6">
			  					<label for="telefono_celular">Teléfono movil</label>
			  					<input type="text" class="form-control" name="telefono_celular" value="{{$datos_personal->telefono_celular}}" required="">
			  				</div>
			  				<div class="form-group col-12 col-md-6">
			  					<label for="telefono_oficina">Teléfono de oficina</label>
			  					<input type="text" class="form-control" name="telefono_oficina" value="{{$datos_personal->telefono_oficina}}">
			  				</div>
			  				<div class="form-group col-12 col-md-6">
			  					<label for="email">Correo electrónico</label>
			  					<input type="email" class="form-control" name="email" value="{{$datos_personal->email}}" required="">
			  				</div>
			  				<div class="form-group col-12 col-md-6">
			  					<label for="tipo_residencia">Tipo de residencia actual:</label>
			  					<select name="tipo_residencia" id="tipo_residencia" class="form-control" required="">
			  						<option value="">Seleccione una opción</option>
			  						<option value="Casa" {{$datos_personal->tipo_residencia == "Casa" ? "selected=''" : ( old('tipo_residencia') == "Casa" ? "selected=''" :"")}}>Casa</option>
			  						<option value="Departamento" {{$datos_personal->tipo_residencia == "Departamento" ? "selected=''" : ( old('tipo_residencia') == "Departamento" ? "selected=''" :"")}}>Departamento</option>
			  					</select>
			  				</div>
			  				<div class="form-group col-12 col-md-6">
			  					<label for="duenio_residencia">Propietario de la residencia actual:</label>
			  					<select name="duenio_residencia" id="duenio_residencia" class="form-control" required="">
			  						<option value="">Seleccione una opción</option>
			  						<option value="Propio" {{$datos_personal->duenio_residencia == "Propio" ? "selected=''" : ( old('duenio_residencia') == "Propio" ? "selected=''" :"")}}>Propio</option>
			  						<option value="Familiar" {{$datos_personal->duenio_residencia == "Familiar" ? "selected=''" : ( old('duenio_residencia') == "Familiar" ? "selected=''" :"")}}>Familiar</option>
			  						<option value="Renta" {{$datos_personal->duenio_residencia == "Renta" ? "selected=''" : ( old('duenio_residencia') == "Renta" ? "selected=''" :"")}}>Renta</option>
			  						<option value="Hipotecada" {{$datos_personal->duenio_residencia == "Hipotecada" ? "selected=''" : ( old('duenio_residencia') == "Hipotecada" ? "selected=''" :"")}}>Hipotecada</option>
			  					</select>
			  				</div>
			  				<div class="form-group col-12 col-md-6">
			  					<label for="habitantes">Habitantes</label>
			  					<input type="number" step="1" min="1" class="form-control" name="habitantes" value="{{$datos_personal->habitantes}}" required="">
			  				</div>
			  				<div class="form-group col-12 col-md-6">
			  					<label for="costo_residencia">Costo de la residencia</label>
			  					<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text" id="basic-addon1">$</span>
									</div>
			  						<input type="number" step="1" class="form-control" name="costo_residencia" value="{{$datos_personal->costo_residencia}}" required="">
								</div>
			  				</div>
			  				<div class="form-group col-12 col-md-6">
			  					<label for="tiempo_viviendo">¿Cuánto tiempo lleva viviendo ahí?</label>
			  					<input type="text" class="form-control" name="tiempo_viviendo" value="{{$datos_personal->tiempo_viviendo}}" required="">
			  				</div>
			  				<div class="form-group col-12 col-md-6">
			  					<label for="hijos">Hijos:</label>
			  					<select name="hijos" id="hijos" class="form-control" required="">
			  						<option value="">Seleccione una opción</option>
			  						<option value="1" {{$datos_personal->hijos == "1" ? "selected=''" : ( old('hijos') == "1" ? "selected=''" :"")}}>Si</option>
			  						<option value="0" {{$datos_personal->hijos == "0" ? "selected=''" : ( old('hijos') == "0" ? "selected=''" :"")}}>No</option>
			  					</select>
			  				</div>
			  				<div class="form-group col-12 col-md-6">
			  					<label for="numero_hijos">Número de hijos</label>
			  					<input type="number" step="1" class="form-control" name="numero_hijos" value="{{$datos_personal->numero_hijos}}" >
			  				</div>
			  				<div class="form-group col-12 col-md-6">
			  					<label for="dependientes_economicos">Dependientes económicos</label>
			  					<select name="dependientes_economicos" id="dependientes_economicos" class="form-control" required="">
			  						<option value="">Seleccione una opción</option>
			  						<option value="1" {{$datos_personal->dependientes_economicos == "1" ? "selected=''" : ( old('dependientes_economicos') == "1" ? "selected=''" :"")}}>Si</option>
			  						<option value="0" {{$datos_personal->dependientes_economicos == "0" ? "selected=''" : ( old('dependientes_economicos') == "0" ? "selected=''" :"")}}>No</option>
			  					</select>
			  				</div>
			  				<div class="form-group col-12 col-md-6">
			  					<label for="numero_dependientes">Número de dependientes económicos</label>
			  					<input type="number" step="1" class="form-control" name="numero_dependientes" value="{{$datos_personal->numero_dependientes}}" >
			  				</div>
			  				<div class="form-group col-12 col-md-6">
			  					<label for="ingresos_extras">Ingresos extras</label>
			  					<input type="number" step="any" min="0" class="form-control" name="ingresos_extras" value="{{$datos_personal->ingresos_extras}}" onchange="actualizarTotalIngreso()">
			  				</div>
			  				<div class="form-group col-12 col-md-6">
			  					<label for="ingreso_total">Ingresos totales</label>
			  					<input type="number" step="any" min="0" class="form-control" name="ingreso_total" value="{{$datos_personal->ingreso_total}}" >
			  				</div>
			  				<div class="form-group col-12 col-md-6">
			  					<label for="ahorro_inicial">¿Enganche o ahorro inicial?</label>
			  					<select name="ahorro_inicial" id="ahorro_inicial" class="form-control" required="">
			  						<option value="">Seleccione una opción</option>
			  						<option value="1" {{$datos_personal->ahorro_inicial == "1" ? "selected=''" : ( old('ahorro_inicial') == "1" ? "selected=''" :"")}}>Si</option>
			  						<option value="0" {{$datos_personal->ahorro_inicial == "0" ? "selected=''" : ( old('ahorro_inicial') == "0" ? "selected=''" :"")}}>No</option>
			  					</select>
			  				</div>
			  				<div class="form-group col-12 col-md-6">
			  					<label for="forma_ahorro">Forma que tiene disponible el ahorro inicial (de ser así)</label>
			  					<input type="text" class="form-control" name="forma_ahorro" value="{{$datos_personal->forma_ahorro}}" >
			  				</div>
			  				<div class="form-group col-12 col-md-6">
			  					<label for="ahorra">¿Ahorra?</label>
			  					<select name="ahorra" id="ahorra" class="form-control" required="">
			  						<option value="">Seleccione una opción</option>
			  						<option value="1" {{$datos_personal->ahorra == "1" ? "selected=''" : ( old('ahorra') == "1" ? "selected=''" :"")}}>Si</option>
			  						<option value="0" {{$datos_personal->ahorra == "0" ? "selected=''" : ( old('ahorra') == "0" ? "selected=''" :"")}}>No</option>
			  					</select>
			  				</div>
			  				<div class="form-group col-12 col-md-6">
			  					<label for="ahorros">¿Cuanto Ahorra?</label>
			  					<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text" id="basic-addon1">$</span>
									</div>
									<input type="number" class="form-control" name="ahorros" value="{{$datos_personal->ahorros}}" step="any" min="0">
									<div class="input-group-append">
				    					<select class="form-control" name="tipo_ahorro">
				    						<option value="">Elija una opcion</option>
				    						<option value="Semanal" {{$datos_personal->tipo_ahorro == "Semanal" ? "selected=''" : ( old('tipo_ahorro') == "0" ? "selected=''" :"")}}>Semanal</option>
				    						<option value="Mensual" {{$datos_personal->tipo_ahorro == "Mensual" ? "selected=''" : ( old('tipo_ahorro') == "Mensual" ? "selected=''" :"")}}>Mensual</option>
				    					</select>
				    				</div>
								</div>
			  				</div>
			  				<div class="form-group col-12 col-md-6">
			  					<label for="otro_participante">¿Alguna otra persona participará en la compra?</label>
			  					<select name="otro_participante" id="otro_participante" class="form-control" required="">
			  						<option value="">Seleccione una opción</option>
			  						<option value="1" {{$datos_personal->otro_participante == "1" ? "selected=''" : ( old('otro_participante') == "1" ? "selected=''" :"")}}>Si</option>
			  						<option value="0" {{$datos_personal->otro_participante == "0" ? "selected=''" : ( old('otro_participante') == "0" ? "selected=''" :"")}}>No</option>
			  					</select>
			  				</div>
			  				<div class="form-group col-12 col-md-6">
			  					<label for="participante">Nombre completo de quien participará en la compra (de ser así)</label>
			  					<input type="text" class="form-control" name="participante" value="{{$datos_personal->participante}}" >
			  				</div>
			  			</div>
			  		</div>
			  		<div class="card-footer">
			  			<div class="d-flex justify-content-center">
			  				<button type="submit" class="btn btn-success">Actualizar</button>
			  			</div>
			  		</div>
		  		</form>
		  	</div>
		  </div>
		</div>
 	</div>
  </div>
</div>
@endsection
@push('scripts')
	<script type="text/javascript">
		$(document).ready(function() {
			getColonias();
		});

		$("#estado_civil").on("change",function(){
			var estado_civil = $("#estado_civil").val();
			$("#pareja_form").empty();
			if(estado_civil == "Casado" || estado_civil == "Unión Libre"){
				var html_row=`
				<div class="row-group row" id="regimen_matrimonial">
		  					<div class="form-group col-12 col-md-6">
			  					<label for="regimen_matrimonial">Régimen matrimonial</label>
			  					<select name="regimen_matrimonial" id="regimen_matrimonial" class="form-control" required="">
			  						<option value="">Seleccione una opción</option>
			  						<option value="Sociedad Conyugal" {{$datos_personal->estado_civil == "Sociedad Conyugal" ? "selected=''" : ( old('estado_civil') == "Sociedad Conyugal" ? "selected=''" :"")}}>Sociedad Conyugal</option>
			  						<option value="Separación de Bienes" {{$datos_personal->estado_civil == "Separación de Bienes" ? "selected=''" : ( old('estado_civil') == "Separación de Bienes" ? "selected=''" :"")}}>Separación de Bienes</option>
			  					</select>
		  					</div>
		  				</div>
		  				<div class="form-group row">
		    				<h5 class="card-title col-12">Datos de la pareja:</h5>
		    			</div>
		    			<div class="row-group row">
			  				<div class="form-group col-12 col-md-6">
			  					<label for="pareja">Pareja</label>
			  					<div class="input-group">
									<select class="custom-select" name="prefijo_2" id="prefijo_2" required="">
										<option value="">Elige...</option>
										<option value="Sr." {{$datos_personal->prefijo_2 == "Sr." ? "selected=''" : ( old('prefijo_2') == "Sr." ? "selected=''" :"")}}>Sr.</option>
										<option value="Sra." {{$datos_personal->prefijo_2 == "Sra." ? "selected=''" : ( old('prefijo_2') == "Sra." ? "selected=''" :"")}}>Sra.</option>
										<option value="Srta." {{$datos_personal->prefijo_2 == "Srta." ? "selected=''" : ( old('prefijo_2') == "Srta." ? "selected=''" :"")}}>Srta.</option>
									</select>
									<div class="input-group-append w-75">
									<input type="text" class="form-control" name="nombre_completo_2" id="nombre_completo_1" value="{{$datos_personal->nombre_completo_2}}" required="">
									</div>
								</div>
			  				</div>
			  				<div class="form-group col-12 col-md-6">
			  					<label for="ocupacion_2">Ocupación</label>
			  					<input type="text" class="form-control" required="" value="{{$datos_personal->ocupacion_2}}" required="">
			  				</div>
			  				<div class="form-group col-12 col-md-6">
			  					<label for="empresa_2">Empresa</label>
			  					<input type="text" class="form-control" required="" value="{{$datos_personal->empresa_2}}" required="">
			  				</div>
			  				<div class="form-group col-12 col-md-6">
			  					<label for="antiguedad_2">Antigüedad</label>
			  					<input type="text" class="form-control" required="" value="{{$datos_personal->antiguedad_2}}" required="">
			  				</div>
			  				<div class="form-group col-12 col-md-6">
			  					<label for="salario_2">Salario</label>
			  					<input type="text" class="form-control" required="" value="{{$datos_personal->salario_2}}" required="">
			  				</div>
			  				<div class="form-group col-12 col-md-6">
			  					<label for="rfc_2">RFC</label>
			  					<input type="text" class="form-control" required="" value="{{$datos_personal->rfc_2}}" required="">
			  				</div>
			  				<div class="form-group col-12 col-md-6">
			  					<label for="nacionalidad_2">Nacionalidad</label>
			  					<input type="text" class="form-control" required="" value="{{$datos_personal->nacionalidad_2}}" required="">
			  				</div>
			  			</div>
					`;
				
			}
			
			$("#pareja_form").append(html_row);
		});

		$("#cp").change(function(){
			getColonias();
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

		function getColonias() {
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
					});
					setColoniaDefault();
				},
				error:function(xhr,status,error){
					alert(error);
				}
			});
		}

		function setColoniaDefault() {
			let colonia = '{{ $datos_personal->colonia }}';
			$("#colonia").children().each(function(index, el) {
				if($(el).val() == colonia){
					$(el).attr("selected",true);
				}
			});

		}
		function actualizarTotalIngreso() {
			var Total=parseInt(0,10);;
		  if ($("#salario_1").val()) {
		  	Total+=parseInt($("#salario_1").val(),10);
		  }
		  if ($("#ingresos_extras").val()) {
		  	Total+=parseInt($("#ingresos_extras").val(),10);
		  }
		  $("#ingreso_total").val(Total);

		}
	</script>
@endpush
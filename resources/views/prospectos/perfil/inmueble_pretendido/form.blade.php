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
		  <li class="nav-item " aria-disabled="true">
		    <a class="nav-link " aria-disabled="true" id="datos_personal-tab" data-toggle="tab" href="#datos_personal" role="tab" aria-controls="datos_personal" aria-selected="false">Datos personales</a>
		  </li>
		  <li class="nav-item disabled" aria-disabled="true">
		    <a class="nav-link  disabled" aria-disabled="true" id="crediticio-tab" data-toggle="tab" href="#crediticio" role="tab" aria-controls="crediticio" aria-selected="false">Historial crediticio</a>
		  </li>
		  <li class="nav-item active" >
		    <a class="nav-link  active"  id="inmueble-tab" data-toggle="tab" href="#inmueble" role="tab" aria-controls="inmueble" aria-selected="true">Inmueble</a>
		  </li>
		  <li class="nav-item disabled" aria-disabled="true">
		    <a class="nav-link  disabled" aria-disabled="true" id="referencia-tab" data-toggle="tab" href="#referencia" role="tab" aria-controls="referencia" aria-selected="false">Referencias personales</a>
		  </li>
		</ul>
		<div class="tab-content" id="myTabContent">
		  <div class="tab-pane fade show active" id="datos_personal" role="tabpanel" aria-labelledby="datos_personal-tab">
		  	<div class="card">
		  		<div class="card-header">
		  			Cambiar Datos Inmueble Pretendido:
		  		</div>
		  		<form method="POST" action="{{ route('prospectos.perfil.inmueble_pretendido.update',['prospecto'=>$prospecto,'inmueble'=>$inmueble]) }}">
		  			@method('PUT')
		  			@csrf
			  		<div class="card-body">
				    	<div class="form-group row">
				    		<div class="col-sm-12">
				    			<div class="form-check form-check-inline mt-1">
									<input class="form-check-input" type="radio" name="tipo_inmueble" id="tipo_inmueble_casa" value="Casa" required="" {{$inmueble->tipo_inmueble == 'Casa' ? 'checked=""' : ''}}>
									<label class="form-check-label" for="tipo_inmueble_casa">Casa</label>
								</div>
				    			<div class="form-check form-check-inline mt-1">
									<input class="form-check-input" type="radio" name="tipo_inmueble" id="tipo_inmueble_departamento" value="Departamento" {{$inmueble->tipo_inmueble == 'Departamento' ? 'checked=""' : ''}}>
									<label class="form-check-label" for="tipo_inmueble_departamento">Departamento</label>
								</div>
				    			<div class="form-check form-check-inline mt-1">
									<input class="form-check-input" type="radio" name="tipo_inmueble" id="tipo_inmueble_terreno" value="Terreno" {{$inmueble->tipo_inmueble == 'Terreno' ? 'checked=""' : ''}}>
									<label class="form-check-label" for="tipo_inmueble_terreno">Terreno</label>
								</div>
				    			<div class="form-check form-check-inline mt-1">
									<input class="form-check-input" type="radio" name="tipo_inmueble" id="tipo_inmueble_local" value="Local Comercial" {{$inmueble->tipo_inmueble == 'Local Comercial' ? 'checked=""' : ''}}>
									<label class="form-check-label" for="tipo_inmueble_local">Local Comercial</label>
								</div>
				    			<div class="form-check form-check-inline mt-1">
									<input class="form-check-input" type="radio" name="tipo_inmueble" id="tipo_inmueble_bodega" value="Bodega" {{$inmueble->tipo_inmueble == 'Bodega' ? 'checked=""' : ''}}>
									<label class="form-check-label" for="tipo_inmueble_bodega">Bodega</label>
								</div>
							</div>
						</div>
						<div class="form-group row">
				    		<div class="offset-3 col-sm-3">
				    			<div class="form-check form-check-inline mt-1">
									<input class="form-check-input" type="radio" name="tipo_inmueble" id="tipo_inmueble_otro" value="Otro" {{$inmueble->tipo_inmueble == 'Otro' ? 'checked=""' : ''}}>
									<label class="form-check-label" for="tipo_inmueble_otro">Otro:</label>
								</div>
							</div>
							<div class="col-sm-6">
								<input type="text" name="otro_name" value="{{$inmueble->otro_name}}" class="form-control">
							</div>
				    	</div>
				    	<div class="form-group row">
				    		<label for="precio_aprox" class="col-form-label col-sm-3">✱ Precio Aproximado:</label>
				    		<div class="col-sm-4">
				    			<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text" id="basic-addon1">$</span>
									</div>
									{{-- @if($cotizacion) --}}
									{{-- <input type="number" step="any" min="0" class="form-control" value="{{old('precio_aprox') ? old('precio_aprox') : $cotizacion->monto}}" name="precio_aprox" id="precio_aprox" required=""> --}}
									{{-- @else --}}
									<input type="number" step="any" min="0" class="form-control" value="{{$inmueble->precio_aprox ? $inmueble->precio_aprox : 0}}" name="precio_aprox" id="precio_aprox" required="">
									{{-- @endif --}}
								</div>
				    		</div>
				    		<label for="area_inmueble" class="col-form-label col-sm-2">✱ Area:</label>
				    		<div class="col-sm-3">
				    			<div class="input-group">
									<input type="number" step="any" min="0" class="form-control" name="area_inmueble" id="area_inmueble" required="" value="$inmueble->area_inmueble}}">
									<div class="input-group-append">
										<span class="input-group-text" id="basic-addon1">m²</span>
									</div>
								</div>
				    		</div>
				    	</div>
				    	<div class="form-group row">
				    		<label for="estado" class="col-form-label col-sm-2">✱ Estado:</label>
				    		<div class="col-sm-4">
				    			<input type="text" name="estado" class="form-control" value="$inmueble->estado}}" required="">
				    		</div>
				    		<label for="colonia" class="col-form-label col-sm-2">✱ Colonia:</label>
				    		<div class="col-sm-4">
				    			<input type="text" name="colonia" class="form-control" value="{{$inmueble->colonia}}" required="">
				    		</div>
				    	</div>
				    	<div class="form-group row">
				    		<label class="col-form-label col-sm-3" for="recamara">✱ Recámaras:</label>
				    		<div class="col-sm-3">
				    			<input type="number" min="0" name="recamara" class="form-control" value="{{$inmueble->recamara}}" required="">
				    		</div>
				    		<label class="col-form-label col-sm-3" for="banio">✱ Baños:</label>
				    		<div class="col-sm-3">
				    			<input type="number" min="0" step="any" name="banio" class="form-control" value="{{$inmueble->banio}}" required="">
				    		</div>
						</div>
				    	<div class="form-group row">
				    		<label class="col-form-label col-sm-3" for="estacionamiento">✱ Lugares de Estacionamiento:</label>
				    		<div class="col-sm-3">
				    			<input type="number" min="0" value="0" name="estacionamiento" class="form-control" required="" value="{{$inmueble->estacionamiento}}">
				    		</div>
				    		<label class="col-form-label col-sm-3" for="jardin">✱ Jardin:</label>
				    		<div class="col-sm-3">
				    			<input type="number" min="0" value="0" name="jardin" class="form-control" required="" value="{{$inmueble->jardin}}">
				    		</div>
				    	</div>
				    	<div class="form-group row">
				    		<label class="col-form-label col-sm-2" for="gastos_notariales">Gastos Notariales:</label>
				    		<div class="col-sm-3">
				    			<input type="text" name="gastos_notariales" class="form-control" value="{{$inmueble->gastos_notariales}}">
				    		</div>
				    		<label class="col-form-label col-sm-2" for="monto_contratar">✱ Monto a contratar:</label>
				    		<div class="col-sm-5">
				    			<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text" id="basic-addon1">$</span>
									</div>
									{{-- @if($cotizacion) --}}
									{{-- <input type="number" step="any" min="0" step="any" value="{{$cotizacion->monto}}" class="form-control" name="monto_contratar" id="monto_contratar" required=""> --}}
									{{-- @else --}}
									<input type="number" step="any" min="0" step="any" value="{{number_format($inmueble->monto_contratar,2)}}" class="form-control" name="monto_contratar" id="monto_contratar" required="">
									{{-- @endif --}}
								</div>
				    		</div>
				    	</div>
				    	<div class="form-group row">
				    		<label for="tiempo_decision" class="col-form-label col-sm-12">✱ ¿Cuánto tiempo ha pensado en esta compra?</label>
				    		<div class="col-sm-12">
				    			<input type="text" name="tiempo_decision" class="form-control" required="" value="{{$inmueble->tiempo_decision}}">
				    		</div>
				    	</div>
				    	<div class="form-group row">
				    		<label class="col-form-label col-sm-12" for="prioridad">✱ ¿Cuánta prioridad le da a esta meta?</label>
				    		<div class="col-sm-12">
				    			<input type="text" name="prioridad" class="form-control" required="" value="{{$inmueble->prioridad}}">
				    		</div>
				    	</div>
				    	<div class="form-group row">
				    		<label class="col-form-label col-sm-9" for="desicion_propia">✱ ¿La decisión de cumplir su meta depende de alguien más?</label>
				    		<div class="col-sm-3">
				    			<div class="form-check form-check-inline mt-1">
									<input class="form-check-input" type="radio" name="desicion_propia" id="desicion_propia_si" value="1" required="" {{$inmueble->desicion_propia == "1" ? 'checked=""' : '' }}>
									<label class="form-check-label" for="desicion_propia_si">Si</label>
								</div>
				    			<div class="form-check form-check-inline mt-1">
									<input class="form-check-input" type="radio" name="desicion_propia" id="desicion_propia_no" value="0" {{$inmueble->desicion_propia == "0" ? 'checked=""' : '' }}>
									<label class="form-check-label" for="desicion_propia_no">No</label>
								</div>
				    		</div>
				    		<div class="col-sm-12">
				    			<textarea name="toma_desicion" class="form-control">{{$inmueble->toma_desicion}}</textarea>
				    		</div>
				    	</div>
				    	<div class="form-group row">
				    		<label class="col-form-label col-sm-12" for="lograr_meta">¿Porqué no ha logrado su meta?</label>
				    		<div class="col-sm-12">
				    			<textarea name="lograr_meta" class="form-control">{{$inmueble->lograr_meta}}</textarea>
				    		</div>
				    	</div>
				    	<div class="form-group row">
				    		<label class="col-form-label col-sm-9" for="tomaria_desicion">
				    			✱ Si el día de hoy le ofrecemos una propuesta de esquema de financiamiento adaptada a sus necesidades y posibilidades ¿Lo tomaría? 
				    		</label>
				    		<div class="col-sm-3 mt-4">
				    			<div class="form-check form-check-inline mt-1">
									<input class="form-check-input" type="radio" name="tomaria_desicion" id="tomaria_desicion_si" value="1" {{$inmueble->tomaria_desicion == "1" ? 'checked=""' : ''}}  required="">
									<label class="form-check-label" for="tomaria_desicion_si">Si</label>
								</div>
				    			<div class="form-check form-check-inline mt-1">
									<input class="form-check-input" type="radio" name="tomaria_desicion" id="tomaria_desicion_no" value="0" {{$inmueble->tomaria_desicion == "0" ? 'checked=""' : ''}}>
									<label class="form-check-label" for="tomaria_desicion_no">No</label>
								</div>
				    		</div>
				    		<div class="col-sm-12">
				    			<textarea name="motivo_tomaria_desicion" class="form-control">{{$inmueble->motivo_tomaria_desicion}}</textarea>
				    		</div>
				    	</div>
				    	<div class="form-group row">
				    		<label for="medio_entero" class="col-form-label col-sm-6">✱ Medio por el cuál se enteró de nosotros:</label>
				    		<div class="col-sm-6">
				    			<select name="medio_entero" id="medio_entero" required="" class="form-control">
									@foreach ($mediosDeContacto as $medioDeContacto)
										<option value="{{$medioDeContacto->id}}"
										    {{ $medioDeContacto->nombre ==$inmueble->medio_entero ? 'selected=""' : ''}}  
											>{{$medioDeContacto->nombre}}</option>
									@endforeach
									{{-- <option value="">Medío por el que se entero de nosotros</option>
									<option value="Internet" {{old('medio_entero') == "Internet" ? 'checked=""' : '' }}>Internet</option>
									<option value="T.V." {{old('medio_entero') == "T.V." ? 'checked=""' : '' }}>T.V.</option>
									<option value="Periodico" {{old('medio_entero') == "Periodico" ? 'checked=""' : '' }}>Periodico</option>
									<option value="Otro" {{old('medio_entero') == "Otro" ? 'checked=""' : '' }}>Otro</option> --}}
								</select>
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

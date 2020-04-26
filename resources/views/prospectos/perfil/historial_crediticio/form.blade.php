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
		  <li class="nav-item disabled" aria-disabled="true">
		    <a class="nav-link disabled" id="datos_personal-tab" aria-disabled="true" data-toggle="tab" href="#datos_personal" role="tab" aria-controls="datos_personal" aria-selected="false">Datos personales</a>
		  </li>
		  <li class="nav-item active" >
		    <a class="nav-link  active"  id="crediticio-tab" data-toggle="tab" href="#crediticio" role="tab" aria-controls="crediticio" aria-selected="true">Historial crediticio</a>
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
		  			Cambiar Historial crediticio:
		  		</div>
		  		<form method="POST" action="{{ route('prospectos.perfil.historial_crediticio.update',['prospecto'=>$prospecto,'credito'=>$credito]) }}">
		  			@method('PUT')
		  			@csrf
			  		<div class="card-body">
				    	<div class="form-group row">
				    		<label for="tarjeta_debito" class="col-form-label col-sm-6">✱ Tarjeta de Débito o Cuenta de Ahorro:</label>
			    			<div class="col-sm-2">
			    				<div class="form-check form-check-inline mt-1">
									<input class="form-check-input" type="radio" name="tarjeta_debito" id="tarjeta_debito_si" value="1" required="" {{  $credito->tarjeta_debito== 1 ? "checked" : "" }}>
									<label class="form-check-label" for="tarjeta_debito_si" 
									
										>Si</label>
								</div>
								<div class="form-check form-check-inline mt-1">
									<input class="form-check-input" type="radio" name="tarjeta_debito" id="tarjeta_debito_no" value="0" {{  $credito->tarjeta_debito== 0 ? "checked" : "" }}>
									<label class="form-check-label" for="tarjeta_debito_no">No</label>
								</div>
			    			</div>
			    			<label for="" class="col-form-label col-sm-1">#</label>
			    			<div class="col-sm-3">
			    				<input type="number" name="numero_tarjeta_debito" id="numero_tarjeta_debito" value="{{  $credito->tarjeta_debito }}" class="form-control">
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
											<option value="{{$banco->nombre}}" 
												{{('["'.$banco->nombre.'"]')==$credito->tarjetas_debito ? 'selected=""' : ''}}  title="{{$banco->etiqueta}}">{{$banco->nombre}}</option>
										@endforeach
									</select>

								</div>
							</div>
						</div>
						<div class="form-group row">
							<label for="en_buro_credito" class="col-form-label col-sm-3">✱ Buró de Crédito:</label>
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
				    		<label for="tarjeta_credito" class="col-form-label col-sm-6">✱ Tarjeta de Crédito:</label>
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
							<label for="destino_1" class="col-form-label col-sm-2">✱ Destino:</label>
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
							<label for="destino_2" class="col-form-label col-sm-2">✱ Destino:</label>
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
							<label for="destino_3" class="col-form-label col-sm-2">✱ Destino:</label>
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
							<label for="calificacion_credito" class="col-form-label col-sm-6">✱ Calificación del cliente:</label>
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
							<label for="descripcion_calificacion" class="col-form-label col-sm-3">✱ Descripción de calificación:</label>
							<div class="col-sm-9">
								<textarea class="form-control" rows="3" name="descripcion_calificacion" id="descripcion_calificacion" required="">{{old('descripcion_calificacion')}}</textarea>
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

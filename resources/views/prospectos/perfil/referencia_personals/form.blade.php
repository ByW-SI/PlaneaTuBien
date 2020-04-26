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
		  <li class="nav-item active" aria-disabled="true">
		    <a class="nav-link  active" aria-disabled="true" id="inmueble-tab" data-toggle="tab" href="#inmueble" role="tab" aria-controls="inmueble" aria-selected="false">Inmueble</a>
		  </li>
		  <li class="nav-item active" >
		    <a class="nav-link  active"  id="referencia-tab" data-toggle="tab" href="#referencia" role="tab" aria-controls="referencia" aria-selected="true">Referencias personales</a>
		  </li>
		</ul>
		<div class="tab-content" id="myTabContent">
		  <div class="tab-pane fade show active" id="datos_personal" role="tabpanel" aria-labelledby="datos_personal-tab">
		  	<div class="card">
		  		<div class="card-header">
		  			Cambiar Datos De Referencias Personales:
		  		</div>
		  		<form method="POST" action="{{ route('prospectos.perfil.referencia_personals.update',['prospecto'=>$prospecto,'referencias'=>$referencias]) }}">
		  			@method('PUT')
		  			@csrf
			  		<div class="card-body">
						<h4>Referencia #1</h4>
						<div class="form-group row">
							<label class="col-form-label col-sm-2" for="nombre_completo[1]">✱ Nombre:</label>
							<div class="form-group col-sm-10 pr-0 pl-0">
								<div class="input-group">
									<input type="text" name="nombre[1]" id="nombre[1]" placeholder="Nombre" value="{{old("nombre_1")}}" class="form-control" required="">
									<input type="text" name="paterno[1]" id="paterno[1]" placeholder="Apellido Paterno" value="{{ old("paterno[1]")}}" class="form-control" required="">
									<input type="text" name="materno[1]" id="materno[1]" placeholder="Apellido Materno" value="{{ old("materno[1]")}}" class="form-control">
								</div>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-form-label col-sm-2" for="parentesco[1]">✱ Parentesco:</label>
							<div class="form-group col-sm-2 pr-0 pl-0">
								<input type="text" name="parentesco[1]" value="{{old('parentesco[1]')}}" class="form-control" required="">
							</div>
							<label class="col-form-label col-sm-2" for="telefono[1]">✱ Telefonos:</label>
							<div class="form-group col-sm-6 pr-0 pl-0">
								<div class="input-group">
									<input numeroReferencia="1" type="text" name="telefono[1]" minlength="10" maxlength="10" value="{{old('telefono[1]')}}" class="form-control numeroReferencia" placeholder="Particular" required="">
									<input numeroReferencia="1" type="text" name="celular[1]" minlength="10" maxlength="10" value="{{old('celular[1]')}}" class="form-control numeroReferencia" placeholder="Celular" required="">
								</div>
							</div>
						</div>
						@foreach ($referencias as $index=> $referencia)
							<div class="form-group row">
								<div class="col-12">
									<h5>Referencia #{{$index+1}}</h5>
								</div>
								<div class="col-6">
									<label for="">✱ Nombre:</label>
									<div class="form-group col-sm-10 pr-0 pl-0">
										<div class="input-group">
											<input type="text" name="nombre[{{$index+1}}]" id="nombre[{{$index+1}}]" placeholder="Nombre" value="{{referencia->nombre}}" class="form-control" required="">
											<input type="text" name="paterno[{{$index+1}}]" id="paterno[{{$index+1}}]" placeholder="Apellido Paterno" value="{{ referencia->paterno}}" class="form-control" required="">
											<input type="text" name="materno[{{$index+1}}]" id="materno[{{$index+1}}]" placeholder="Apellido Materno" value="{{ referencia->materno}}" class="form-control">
										</div>
									</div>
								</div>
								<div class="col-6">
									<label for="">Parentesco:</label>
									<input type="text" name="parentesco[{{$index+1}}]" value="{{$referencia->parentesco}}" class="form-control" required="">
								</div>
								<div class="col-6">
									<label for="">Telefono:</label>
									<input numeroReferencia="1" type="text" name="telefono[{{$index+1}}]" minlength="10" maxlength="10" value="{{$referencia->telefono}}" class="form-control numeroReferencia" placeholder="Particular" required="">
									
								</div>
								<div class="col-6">
									<label for="">Celular:</label>
									<input numeroReferencia="1" type="text" name="celular[{{$index+1}}]" minlength="10" maxlength="10" value="{{$referencia->celular}}" class="form-control numeroReferencia" placeholder="Celular" required="">
								</div>
							</div>
						@endforeach
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

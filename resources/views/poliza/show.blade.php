<div class="modal-content">
  	<div class="modal-header">
		<h5 class="modal-title" id="exampleModalLabel">{{$poliza->nombre." #".$poliza->folio}}</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	  		<span aria-hidden="true">&times;</span>
		</button>
  	</div>
  	<div class="modal-body">
		<div class="row row-group">
			<div class="col-12 col-md-3">
			  	<label for="nombre">Nombre</label>
			  	<input type="text" value="{{$poliza->nombre}}" class="form-control" readonly="">
			</div>
			<div class="col-12 col-md-3">
			  	<label for="descripcion">Descripción</label>
			  	<textarea class="form-control" rows="2" cols="50" readonly="">{{ $poliza->descripcion }}</textarea>
			</div>
			<div class="col-12 col-md-6">
			  	<label for="fecha_inicio">Vigencia</label>
			  	<div class="input-group mb-3">
				<div class="input-group-prepend">
				  	<span class="input-group-text" id="basic-addon-de">de</span>
				</div>
				<input type="date" value="{{$poliza->fecha_inicio}}" class="form-control" readonly="">
				<div class="input-group-append">
				  	<span class="input-group-text" id="basic-addon-a">a</span>
				</div>
				<input type="date" value="{{ $poliza->fecha_fin }}" class="form-control" readonly="">
			  	</div>
			</div>
	  	</div>
	  	<div class="row row-group">
			<div class="col-12 col-md-4">
			  	<label for="folio">Folio</label>
			  	<input type="text" value="{{$poliza->folio}}" class="form-control" readonly="">
			</div>
			<div class="col-12 col-md-4">
			  	<label for="tel_contacto">Telefono de contacto</label>
			  	<input type="text" value="{{$poliza->tel_contacto}}" class="form-control" readonly="">
			</div>
			<div class="col-12 col-md-4">
			  	<label for="nombre_asesor">Nombre del asesor</label>
			  	<input type="text" value="{{$poliza->nombre_asesor}}" class="form-control" readonly="">
			</div>
	  	</div>
  	</div>
  	<div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
		<a href="{{ route('polizas.edit',['poliza'=>$poliza]) }}" class="btn btn-primary">Editar</a>
  	</div>
</div>
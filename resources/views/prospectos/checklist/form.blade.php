@extends('principal')
@section('content')
<div class="card">
    <div class="card-header">
        <h5>
        	CHECKLIST FOLDER DE {{$presolicitud->nombre." ".$presolicitud->paterno." ".$presolicitud->materno}}
        </h5>
    </div>
    <form method="POST" action="{{ route('contratos.checklist.store',['contrato'=>$contrato]) }}" enctype="multipart/form-data">
	@csrf
		
	    <div class="card-body">
	    	<div class="row">
	    		<h4>
	    			Contrato {{$contrato->numero_contrato}}
	    		</h4>
	    	</div>
	    	<div class="row">
	    		@if (!$contrato->checklist->ficha_deposito_path)
	    		<div class="col-12 col-sm-12 col-md-4 col-xl-4 form-group">
	    			<label for="ficha_deposito_path">Ficha de deposito</label>
	    			<input id="input-id" type="file" accept=".docx, .pdf, .jpg" class="file" name="ficha_deposito_path" data-preview-file-type="text" {{-- required --}}>
	    		</div>
	    		@endif
	    		@if (!$contrato->checklist->perfil_path)
	    		<div class="col-12 col-sm-12 col-md-4 col-xl-4 form-group">
	    			<label for="perfil_path">Perfil</label>
	    			<input id="input-id" type="file" accept=".docx, .pdf, .jpg" class="file" name="perfil_path" data-preview-file-type="text" {{-- required --}}>
	    		</div>
	    		@endif
	    		@if (!$contrato->checklist->presolicitud_path)
	    		<div class="col-12 col-sm-12 col-md-4 col-xl-4 form-group">
	    			<label for="presolicitud_path">Presolicitud Firmada</label>
	    			<input id="input-id" type="file" accept=".docx, .pdf, .jpg" class="file" name="presolicitud_path" data-preview-file-type="text" {{-- required --}}>
	    		</div>
	    		@endif
	    		@if (!$contrato->checklist->contrato_path)
	    		<div class="col-12 col-sm-12 col-md-4 col-xl-4 form-group">
	    			<label for="contrato_path">Contrato Firmado</label>
	    			<input id="input-id" type="file" accept=".docx, .pdf, .jpg" class="file" name="contrato_path" data-preview-file-type="text" {{-- required --}}>
	    		</div>
	    		@endif
	    		@if (!$contrato->checklist->hoja_aceptacion_path)
	    		<div class="col-12 col-sm-12 col-md-4 col-xl-4 form-group">
	    			<label for="hoja_aceptacion_path">Hoja de aceptación del seguro</label>
	    			<input id="input-id" type="file" accept=".docx, .pdf, .jpg" class="file" name="hoja_aceptacion_path" data-preview-file-type="text" {{-- required --}}>
	    		</div>
	    		@endif
	    		@if (!$contrato->checklist->manual_consumidor_path)
	    		<div class="col-12 col-sm-12 col-md-4 col-xl-4 form-group">
	    			<label for="manual_consumidor_path">Manual del consumidor firmado</label>
	    			<input id="input-id" type="file" accept=".docx, .pdf, .jpg" class="file" name="manual_consumidor_path" data-preview-file-type="text" {{-- required --}}>
	    		</div>
	    		@endif
	    		@if (!$contrato->checklist->calidad_path)
	    		<div class="col-12 col-sm-12 col-md-4 col-xl-4 form-group">
	    			<label for="calidad_path">Cuestionario de calidad</label>
	    			<input id="input-id" type="file" accept=".docx, .pdf, .jpg" class="file" name="calidad_path" data-preview-file-type="text" {{-- required --}}>
	    		</div>
	    		@endif
	    		@if (!$contrato->checklist->privacidad_path)
	    		<div class="col-12 col-sm-12 col-md-4 col-xl-4 form-group">
	    			<label for="privacidad_path">Aviso de Privacidad</label>
	    			<input id="input-id" type="file" accept=".docx, .pdf, .jpg" class="file" name="privacidad_path" data-preview-file-type="text" {{-- required --}}>
	    		</div>
	    		@endif
	    		@if (!$contrato->checklist->copia_ficha_deposito_path)
	    		<div class="col-12 col-sm-12 col-md-4 col-xl-4 form-group">
	    			<label for="copia_ficha_deposito_path">Copia ficha de deposito</label>
	    			<input id="input-id" type="file" accept=".docx, .pdf, .jpg" class="file" name="copia_ficha_deposito_path" data-preview-file-type="text" {{-- required --}}>
	    		</div>
	    		@endif
	    		@if (!$contrato->checklist->identificacion_path)
	    		<div class="col-12 col-sm-12 col-md-4 col-xl-4 form-group">
	    			<label for="identificacion_path">Identificación Oficial</label>
	    			<input id="input-id" type="file" accept=".docx, .pdf, .jpg" class="file" name="identificacion_path" data-preview-file-type="text" {{-- required --}}>
	    		</div>
	    		@endif
	    		@if (!$contrato->checklist->comprobante_domicilio_path)
	    		<div class="col-12 col-sm-12 col-md-4 col-xl-4 form-group">
	    			<label for="comprobante_domicilio_path">Comprobante de domicilio</label>
	    			<input id="input-id" type="file" accept=".docx, .pdf, .jpg" class="file" name="comprobante_domicilio_path" data-preview-file-type="text" {{-- required --}}>
	    		</div>
	    		@endif
	    		@if (!$contrato->checklist->croquis_ubicacion_path)
	    		<div class="col-12 col-sm-12 col-md-4 col-xl-4 form-group">
	    			<label for="croquis_ubicacion_path">Croquis de ubicación</label>
	    			<input id="input-id" type="file" accept=".docx, .pdf, .jpg" class="file" name="croquis_ubicacion_path" data-preview-file-type="text" {{-- required --}}>
	    		</div>
	    		@endif
	    		@if (!$contrato->checklist->carta_bienvenida_path)
	    		<div class="col-12 col-sm-12 col-md-4 col-xl-4 form-group">
	    			<label for="carta_bienvenida_path">Carta de bienvenida</label>
	    			<input id="input-id" type="file" accept=".docx, .pdf, .jpg" class="file" name="carta_bienvenida_path" data-preview-file-type="text" {{-- required --}}>
	    		</div>
	    		@endif
	    		@if (!$contrato->checklist->anexos_path)
	    		<div class="col-12 col-sm-12 col-md-4 col-xl-4 form-group">
	    			<label for="anexos_path">Anexo</label>
	    			<input id="input-id" type="file" accept=".docx, .pdf, .jpg" class="file" name="anexos_path" data-preview-file-type="text" {{-- required --}}>
	    		</div>
	    		@endif
	    	</div>
		</div>
		<div class="card-footer">
			<div class="d-flex justify-content-center">
				<button class="btn btn-success" type="submit"><i class="fas fa-save"></i> Guardar</button>
			</div>
		</div>
    </form>
</div>
	
@endsection
@extends('principal')
@section('content')
<div class="card">
    <div class="card-header">
        <h5>
        	CHECKLIST FOLDER DE {{$presolicitud->nombre." ".$presolicitud->paterno." ".$presolicitud->materno}}
        </h5>
    </div>
    <form method="POST" action="{{ route('recibos.checklist.store',['recibo'=>$recibo]) }}" enctype="multipart/form-data">
	@csrf
		
	    <div class="card-body">
	    	<div class="row">
	    		<h4>
	    			Recibo {{$recibo->clave.$recibo->id}}
	    		</h4>
	    	</div>
	    	<div class="row">
	    		<div class="col-12 col-sm-12 col-md-4 col-xl-4 form-group">
	    			<label for="ficha_deposito_path">Ficha de deposito</label>
	    			<input id="input-id" type="file" accept=".docx, .pdf, .jpg" class="file" name="ficha_deposito_path" data-preview-file-type="text" {{-- required --}}>
	    		</div>
	    		<div class="col-12 col-sm-12 col-md-4 col-xl-4 form-group">
	    			<label for="perfil_path">Perfil</label>
	    			<input id="input-id" type="file" accept=".docx, .pdf, .jpg" class="file" name="perfil_path" data-preview-file-type="text" {{-- required --}}>
	    		</div>
	    		<div class="col-12 col-sm-12 col-md-4 col-xl-4 form-group">
	    			<label for="presolicitud_path">Presolicitud Firmada</label>
	    			<input id="input-id" type="file" accept=".docx, .pdf, .jpg" class="file" name="presolicitud_path" data-preview-file-type="text" {{-- required --}}>
	    		</div>
	    		<div class="col-12 col-sm-12 col-md-4 col-xl-4 form-group">
	    			<label for="contrato_path">Contrato Firmado</label>
	    			<input id="input-id" type="file" accept=".docx, .pdf, .jpg" class="file" name="contrato_path" data-preview-file-type="text" {{-- required --}}>
	    		</div>
	    		<div class="col-12 col-sm-12 col-md-4 col-xl-4 form-group">
	    			<label for="hoja_aceptacion_path">Hoja de aceptación del seguro</label>
	    			<input id="input-id" type="file" accept=".docx, .pdf, .jpg" class="file" name="hoja_aceptacion_path" data-preview-file-type="text" {{-- required --}}>
	    		</div>
	    		<div class="col-12 col-sm-12 col-md-4 col-xl-4 form-group">
	    			<label for="manual_consumidor_path">Manual del consumidor firmado</label>
	    			<input id="input-id" type="file" accept=".docx, .pdf, .jpg" class="file" name="manual_consumidor_path" data-preview-file-type="text" {{-- required --}}>
	    		</div>
	    		<div class="col-12 col-sm-12 col-md-4 col-xl-4 form-group">
	    			<label for="calidad_path">Cuestionario de calidad</label>
	    			<input id="input-id" type="file" accept=".docx, .pdf, .jpg" class="file" name="calidad_path" data-preview-file-type="text" {{-- required --}}>
	    		</div>
	    		<div class="col-12 col-sm-12 col-md-4 col-xl-4 form-group">
	    			<label for="privacidad_path">Aviso de Privacidad</label>
	    			<input id="input-id" type="file" accept=".docx, .pdf, .jpg" class="file" name="privacidad_path" data-preview-file-type="text" {{-- required --}}>
	    		</div>
	    		<div class="col-12 col-sm-12 col-md-4 col-xl-4 form-group">
	    			<label for="copia_ficha_deposito_path">Copia ficha de deposito</label>
	    			<input id="input-id" type="file" accept=".docx, .pdf, .jpg" class="file" name="copia_ficha_deposito_path" data-preview-file-type="text" {{-- required --}}>
	    		</div>
	    		<div class="col-12 col-sm-12 col-md-4 col-xl-4 form-group">
	    			<label for="identificacion_path">Identificación Oficial</label>
	    			<input id="input-id" type="file" accept=".docx, .pdf, .jpg" class="file" name="identificacion_path" data-preview-file-type="text" {{-- required --}}>
	    		</div>
	    		<div class="col-12 col-sm-12 col-md-4 col-xl-4 form-group">
	    			<label for="comprobante_domicilio_path">Comprobante de domicilio</label>
	    			<input id="input-id" type="file" accept=".docx, .pdf, .jpg" class="file" name="comprobante_domicilio_path" data-preview-file-type="text" {{-- required --}}>
	    		</div>
	    		<div class="col-12 col-sm-12 col-md-4 col-xl-4 form-group">
	    			<label for="croquis_ubicacion_path">Croquis de ubicación</label>
	    			<input id="input-id" type="file" accept=".docx, .pdf, .jpg" class="file" name="croquis_ubicacion_path" data-preview-file-type="text" {{-- required --}}>
	    		</div>
	    		<div class="col-12 col-sm-12 col-md-4 col-xl-4 form-group">
	    			<label for="carta_bienvenida_path">Carta de bienvenida</label>
	    			<input id="input-id" type="file" accept=".docx, .pdf, .jpg" class="file" name="carta_bienvenida_path" data-preview-file-type="text" {{-- required --}}>
	    		</div>
	    		<div class="col-12 col-sm-12 col-md-4 col-xl-4 form-group">
	    			<label for="anexos_path">Anexo</label>
	    			<input id="input-id" type="file" accept=".docx, .pdf, .jpg" class="file" name="anexos_path" data-preview-file-type="text" {{-- required --}}>
	    		</div>
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
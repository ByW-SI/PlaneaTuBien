@php($documentos = $prospecto->documentos)
@if($documentos)
	<div class="row">
		<div class="form-group col-sm-3">
			<label class="control-label">Fecha de nacimiento:</label>
			<dd>{{ date('d/m/Y', strtotime($documentos->nacimiento)) }}</dd>
		</div>
		<div class="form-group col-sm-3">
			<label class="control-label">Nacionalidad:</label>
			<dd>{{ $documentos->nacionalidad }}</dd>
		</div>
		<div class="form-group col-sm-3">
			<label class="control-label">Lugar de nacimiento:</label>
			<dd>{{ $documentos->lugar }}</dd>
		</div>
		<div class="form-group col-sm-3">
			<label class="control-label">Estado civil:</label>
			<dd>{{ $documentos->civil }}</dd>
		</div>
	</div>
	<div class="row">
		<div class="form-group col-sm-3">
			<label class="control-label">Profesión:</label>
			<dd>{{ $documentos->profesion }}</dd>
		</div>
		<div class="form-group col-sm-3">
			<label class="control-label">Empresa:</label>
			<dd>{{ $documentos->empresa }}</dd>
		</div>
		<div class="form-group col-sm-3">
			<label class="control-label">Puesto actual:</label>
			<dd>{{ $documentos->actual }}</dd>
		</div>
		<div class="form-group col-sm-3">
			<label class="control-label">Puesto anterior:</label>
			<dd>{{ $documentos->anterior ? $documentos->anterior : 'N/A' }}</dd>
		</div>
	</div>
    <div class="row">
        <div class="form-group col-sm-3">
            <label class="control-label">Antigüedad:</label>
            <dd>{{ $documentos->antiguo ? $documentos->antiguo : 'N/A' }}</dd>
        </div>
    </div>
@else
    <div class="row">
		<div class="col-sm-12 text-center">
			<h4>No hay documentación disponible.</h4>
			<a href="{{ route('prospectos.documentos.create', ['prospecto' => $prospecto]) }}" class="btn btn-success">
				<i class="fa fa-plus"></i><strong> Agregar</strong>
			</a>
		</div>
	</div>
@endif
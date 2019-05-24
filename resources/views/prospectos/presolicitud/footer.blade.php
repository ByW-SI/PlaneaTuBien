<div class="card-footer">
	<div class="d-flex justify-content-center">
		@if ($presolicitud->recibo)
			<a class="btn btn-success" href="{{ route('presolicituds.credencials.create',['presolicitud'=>$presolicitud]) }}"><i class="fas fa-save"></i> Generar credencial al usuario</a>
		@endif
	</div>
</div>
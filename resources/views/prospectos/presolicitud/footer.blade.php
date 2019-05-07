<div class="card-footer">
	<div class="d-flex justify-content-center">
		{{-- @if (sizeof($cotizacion->contratos()) == sizeof($presolicitud->recibos)) --}}
			<a class="btn btn-success" href="{{ route('presolicituds.checklist.index',['presolicitud'=>$presolicitud]) }}"><i class="fas fa-tasks"></i> Checklist Folder</a>
		{{-- @endif --}}
	</div>
</div>
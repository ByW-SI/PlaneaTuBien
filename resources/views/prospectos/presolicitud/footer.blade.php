<div class="card-footer">
	<div class="d-flex justify-content-center">
		@if (sizeof($cotizacion->contratos()) == sizeof($presolicitud->recibos))
			<a class="btn btn-success" href="{{ route('presolicituds.checklist.index',['presolicitud'=>$presolicitud]) }}"><i class="fas fa-tasks"></i> Checklist Folder</a>
			<a href="{{$presolicitud->cliente_credential ? route('prospectos.presolicitud.credencials.edit',['prospecto'=>$prospecto,'presolicitud'=>$presolicitud,'credencial'=>$presolicitud->cliente_credential]) : route('prospectos.presolicitud.credencials.create',['prospecto'=>$prospecto,'presolicitud'=>$presolicitud,])}}" class="btn btn-info">{{$presolicitud->cliente_credential ? "Cambiar credencial para el prospecto" : "Crear credencial para el prospecto"}}</a>
		@endif
	</div>
</div>
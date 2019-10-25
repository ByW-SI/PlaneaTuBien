@extends('empleado.show')
@section('submodulos')
	{{-- NAV --}}
<div class="row">
    <div class="col-sm-12">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link " href="{{ route('empleados.show', ['empleado' => $empleado]) }}">Datos generales</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('empleados.laborals.index', ['empleado' => $empleado]) }}">Laborales</a>
            </li>
            @if($empleado->tipo != "Asesor")
            <li class="nav-item">
                <a class="nav-link" href="{{ route('empleados.relaciones.index', ['empleado' => $empleado]) }}">Empleados</a>
            </li>
            @endif
            <li class="nav-item">
                <a class="nav-link" href="{{ route('empleados.vacacions.index' , ['empleado' => $empleado]) }}">Vacaciones</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('empleados.beneficiario.index' , ['empleado' => $empleado]) }}">Beneficiario</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('empleados.permisos.index' , ['empleado' => $empleado]) }}">Permisos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('empleados.faltas.index' , ['empleado' => $empleado]) }}">Faltas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('empleados.estudios.index' , ['empleado' => $empleado]) }}">Estudios</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('empleados.emergencias.index' , ['empleado' => $empleado]) }}">Emergencias</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('empleados.disciplinas.index' , ['empleado' => $empleado]) }}">Falta Administrativa</a>
            </li>
        </ul>
    </div>
</div>
	<div class="card">
			@if (session('status'))
			<div class="alert alert-success">
				{{ session('status') }}
			</div>
		@endif
		<div class="card-header">
			<h4>Faltas Laborales:</h4>
		</div>
		<div class="card-body">
			<form method="POST" action="{{ route('empleados.faltas.store',['empleado'=>$empleado]) }}">
				@csrf
				<div class="row form-group">
					<div class="col-3">
						<label class="control-label" for="fecha" id="lbl_fecha">Fecha de la falta:</label>
						<input type="date" class="form-control" id="id_fecha" name="fecha" required>
					</div>
					<div class="col-3">
						<label class="control-label" for="problema" id="lbl_problema">Tipo de falta:</label>
						<select id="tipofalta" name="tipofalta" class="form-control" required="">
							<option value="">Seleccione el tipo de falta</option>
							<option value="retardo justificado">Retardo justificado</option>
							<option value="retardo injustificado">Retardo injustificado</option>
							<option value="falta justificada">Falta justificada</option>
							<option value="falta injustificada">Falta injustificada</option>
						</select>
					</div>
					<div class="col-5">
						<label class="control-label" for="motivo" id="lbl_comen">Especificar el motivo de la falta:</label>
						<textarea class="form-control" id="id_coment" name="motivo" maxlength="500" required></textarea>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-12 text-center">
						<button type="submit" class="btn btn-success">
						 	<strong>Guardar</strong>
						</button>
					</div>
				</div>
			</form>
			<div class="container">
				<table class="table table-striped table-bordered table-hover" id="tabla-faltas">
					<thead>
						<tr>
							<th>Fecha</th>
							<th>Tipo de falta</th>
							<th>motivo</th>
							<th>editar</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($faltas as $falta)
							<tr>
								<td fecha-id={{$falta->id}}>{{$falta->fecha}}</td>
								<td tipofalta-id={{$falta->id}}>{{$falta->tipofalta}}</td>
								<td motivo-id={{$falta->id}}>{{$falta->motivo}}</td>
								<td class="text-center">
									@if ($falta->tipofalta == 'falta injustificada')
										<button button-id={{$falta->id}} class="btn btn-warning rounded-0" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">
											<i class="fas fa-edit"></i>
										</button>
									@endif
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>

				<div class="row">
					<div class="col-12 col-md-2">
						<div class="form-group">
							<label for=""><strong>Retardos justificados</strong></label>
							<input type="text" value="{{count($faltas->where('tipofalta','retardo justificado'))}}" class="form-control" readonly>
						</div>
					</div>
					<div class="col-12 col-md-2">
						<div class="form-group">
							<label for=""><strong>Retardos injustificados</strong></label>
							<input type="text" value="{{count($faltas->where('tipofalta','retardo injustificado'))}}" class="form-control" readonly>
						</div>
					</div>
					<div class="col-12 col-md-2">
						<div class="form-group">
							<label for=""><strong>Falta justificada</strong></label>
							<input type="text" value="{{count($faltas->where('tipofalta','falta justificada'))}}" class="form-control" readonly>
						</div>
					</div>
					<div class="col-12 col-md-2">
						<div class="form-group">
							<label for=""><strong>Falta injustificada</strong></label>
							<input type="text" value="{{count($faltas->where('tipofalta','falta injustificada'))}}" class="form-control" readonly>
						</div>
					</div>
					<div class="col-12 col-md-2">
						<div class="form-group">
							<label for=""><strong>Faltas por retardos</strong></label>
							<input type="text" value="{{count($faltas->where('tipofalta','falta por retardos'))}}" class="form-control" readonly>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-12">
						<h3 class="text-center">Faltas y retardos en el mes actual: {{$mes_actual}} del {{date('Y')}}</h3>
					</div>
				</div>
				<div class="row">
					<div class="col-12 col-md-3"></div>
					<div class="col-12 col-md-3">
						<label for="retardos_mes_actual"><strong>Retardos</strong></label>
						<input type="text" class="form-control" readonly value="{{count($empleado->faltas()->whereIn('tipofalta',['retardo justificado','retardo injustificado'])->whereMonth('fecha',date('m'))->get())}}">
					</div>
					<div class="col-12 col-md-3">
						<label for="faltas_mes_actual"><strong>Faltas</strong></label>
						<input type="text" class="form-control" readonly value="{{count($empleado->faltas()->where('tipofalta','like','%falta%')->whereMonth('fecha',date('m'))->get())}}">
					</div>
				</div>
			</div>
		</div>
	</div>

	{{-- MODAL --}}
	<!-- Modal -->
	
		<form action="{{route('empleados.faltas.actualizar')}}" method="POST">
				<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			@csrf
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="row">
							<input type="hidden" class="form-control mb-1" id="falta-id" name="falta_id">
							<div class="col-12">
								<label for="fecha">Fecha</label>
								<input type="date" class="form-control mb-1" id="modal-fecha" name="fecha">
							</div>
							<div class="col-12">
								<label for="modal-tipo-falta">Tipo de falta</label>
								<input type="text" class="form-control mb-1" id="modal-tipo-falta" name="tipofalta">
							</div>
							<div class="col-12">
								<label for="modal-motivo">Motivo</label>
								<textarea type="text" class="form-control mb-1" id="modal-motivo" name="motivo"></textarea>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="rounded-0 btn btn-danger" data-dismiss="modal"><i class="fas fa-window-close"></i></button>
						<input type="submit" value="Guardar" class="rounded-0 btn btn-primary">
						{{-- <button type="submit" class="rounded-0 btn btn-primary">Guardar</button> --}}
					</div>
				</div>
			</div>
		</div>
		</form>


	<script src="https://code.jquery.com/jquery-3.3.1.js"></script>    
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" defer></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js" defer></script>
    <script>
        $(document).ready(function() {
            $('#tabla-faltas').DataTable();
        } );


		$('button').click( function(){
			const falta_id = $(this).attr('button-id');

			console.log(  );

			$('#falta-id').val( falta_id );
			$('#modal-fecha').val( $("td[fecha-id="+falta_id+"]").html() );
			$('#modal-tipo-falta').val( $("td[tipofalta-id="+falta_id+"]").html() );
			$('#modal-motivo').val( $("td[motivo-id="+falta_id+"]").html() );
		} );

	</script>
@endsection
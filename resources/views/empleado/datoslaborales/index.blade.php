@extends('empleado.show')
@section('submodulos')
<div class="row">
    <div class="col-sm-12">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link " href="{{ route('empleados.show', ['empleado' => $empleado]) }}">Datos generales</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('empleados.laborals.index', ['empleado' => $empleado]) }}">Laborales</a>
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
                <a class="nav-link" href="{{ route('empleados.faltas.index' , ['empleado' => $empleado]) }}">Faltas</a>
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
<div class="card card-default">
	<div class="card-header">
		<h4>
			Datos Laborales
		</h4>
	</div>
	<div class="card-body">
		@if ($dato_lab)
			<h4>
				Registro actual
			</h4>
			<div class="row">
				<div class="col-sm-3">
					<div class="form-group">
						<label for="fechacontratacion" class="control-label">Fecha de contratación</label>
						<dd><strong> {{ $dato_lab->fecha_contrato }}</strong></dd>
					</div>
				</div>
				<div class="col-sm-3">
					<div class="form-group">
						<label class="control-label">Tipo de contrato:</label>
						@if($dato_lab->contrato==null)
							<dd><strong>NO DEFINIDO</strong></dd>
						@else
							<dd><strong>{{ $dato_lab->contrato->codigo }} - {{ $dato_lab->contrato->nombre }}</strong></dd>
						@endif
					</div>
				</div>
				<div class="col-sm-3">
					<div class="form-group">
						<label class="control-label">Fecha fin contrato:</label>
						@if($dato_lab->fecha_fin_contrato==null)
							<dd><strong>N/A</strong></dd>
						@else
							<dd><strong>{{ $dato_lab->fecha_fin_contrato }}</strong></dd>
						@endif
					</div>
				</div>
				<div class="col-sm-3">
					<div class="form-group">
						<label class="control-label">Tipo de jornada:</label>
						@if($dato_lab->tipo_jornada_id==null)
							<dd><strong>NO DEFINIDO</strong></dd>
						@else
							<dd><strong>{{ $dato_lab->tipo_jornada->codigo }} - {{ $dato_lab->tipo_jornada->nombre }}</strong></dd>
						@endif
					</div>
				</div>
				<div class="col-sm-3">
					<div class="form-group">
						<label class="control-label">Puesto:</label>
						@if($dato_lab->puesto==null)
							<dd><strong>NO DEFINIDO</strong></dd>
						@else
							<dd><strong>{{ $dato_lab->puesto->nombre }}</strong></dd>
						@endif
					</div>
				</div>
				<div class="col-sm-3">
					<div class="form-group">
						<label class="control-label">Riesgo puesto:</label>
						@if($dato_lab->riesgo_puesto==null)
							<dd><strong>NO DEFINIDO</strong></dd>
						@else
							<dd><strong>{{ $dato_lab->riesgo_puesto }}</strong></dd>
						@endif
					</div>
				</div>
				<div class="col-sm-3">
					<div class="form-group">
						<label class="control-label">
							Salario Nóminal:
						</label>
						<input type="hidden" value="{{$dato_lab->salario_nomina}}" id="salario_nominal_input">
						<dd><strong id="salario_nominal">$ {{ $dato_lab->salario_nomina }}</strong></dd>
					</div>
				</div>
				<div class="col-sm-3">
					<div class="form-group">
						<label class="control-label">
							Salario Diario
						</label>
						<dd><strong>$ {{ $dato_lab->salario_dia }}</strong></dd>
					</div>
				</div>
				<div class="col-sm-3">
					<div class="form-group">
						<label class="control-label">
							Periodicidad de pago:
						</label>
						<dd><strong>{{ $dato_lab->periodo_paga }}</strong></dd>
					</div>
				</div>
				<div class="col-sm-3">
					<div class="form-group">
						<label class="control-label">
							Prestaciones:
						</label>
						<dd><strong>{{ $dato_lab->prestaciones }}</strong></dd>
					</div>
				</div>
				<div class="col-sm-3">
					<div class="form-group">
						<label class="control-label">
							Régimen de contratación:
						</label>
						<dd><strong>{{ $dato_lab->regimen }}</strong></dd>
					</div>
				</div>
				<div class="col-sm-3">
					<div class="form-group">
						<label class="control-label">
							Hora de entrada:
						</label>
						<dd><strong>{{ $dato_lab->hora_entrada }}</strong></dd>
					</div>
				</div>
				<div class="col-sm-3">
					<div class="form-group">
						<label class="control-label">
							Hora de salida:
						</label>
						<dd><strong>{{ $dato_lab->hora_salida }}</strong></dd>
					</div>
				</div>
				<div class="col-sm-3">
					<div class="form-group">
						<label class="control-label">
							Hora de comida:
						</label>
						<dd><strong>{{ $dato_lab->hora_comida }}</strong></dd>
					</div>
				</div>
				<div class="col-sm-3">
					<div class="form-group">
						<label class="control-label">
							Banco:
						</label>
						@if($dato_lab->banco==null)
							<dd><strong>NO DEFINIDO</strong></dd>
						@else
							<dd><strong>{{ $dato_lab->banco }}</strong></dd>
						@endif
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-3">
					<div class="form-group">
						<label class="control-label">
							Cuenta:
						</label>
						<dd><strong>{{ $dato_lab->cuenta }}</strong></dd>
					</div>
				</div>
				<div class="col-sm-3">
					<div class="form-group">
						<label class="control-label">
							CLABE:
						</label>
						<dd><strong>{{ $dato_lab->clabe }}</strong></dd>
					</div>
				</div>
			</div>
			@if ($dato_lab->fechabaja)
				<div class="card-header">
					Datos de baja:
				</div>
				<div class="row mt-3">
					<div class="col-sm-4">
						<div class="form-group">
							<label for="" class="control-label">
								Fecha de baja:
							</label>
							<dd><strong>{{ $dato_lab->fechabaja }}</strong></dd>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="form-group">
							<label for="" class="control-label">
								Tipo de Baja:
							</label>
	  						<dd><strong>{{$dato_lab->tipobaja->nombre}}</strong></dd>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="form-group">
							<label for="" class="control-label">
								Comentarios:
							</label>
							<dd><strong>{{$dato_lab->comentariobaja}}</strong></dd>
						</div>
					</div>
				</div>
			@else
				<div class="d-flex justify-content-center">
					{{-- <div class="offset-2 col-4">
						<a class="btn btn-warning btn-md" href="{{ route('empleados.laborals.edit',['empleado'=>$empleado,'dato_lab'=>$dato_lab]) }}">
							<i class="fa fa-pencil"></i><strong>Editar</strong>
						</a>
					</div> --}}
					<div class="col-4"></div>
					<div class="col-4 text-center">
						<a class="btn btn-success btn-md" href="{{ route('empleados.laborals.create',['empleado'=>$empleado]) }}">
							<i class="fa fa-plus"></i><strong>Nuevo</strong>
						</a>
					</div>
					<div class="col-4"></div>
				</div>
			@endif
		@else
			<div class="alert alert-warning" role="alert">
				El agente {{$empleado->nombre." ".$empleado->paterno." ".$empleado->materno}} aún no tiene registro laboral. <a href="{{ route('empleados.laborals.create',['empleado'=>$empleado]) }}" class="alert-link">Por favor, cree un nuevo registro aquí</a>.
			</div>
		@endif
	</div>
	<div class="card-header">
		<h5>Historial de registos laborales</h5>
	</div>
	<div class="card-body">
		<table class="table table-striped table-bordered table-hover">
				<thead>
					<tr class="table-info">
						<th>Fecha</th>
						<th>Contrato</th>
						<th>Puesto</th>
						<th>Salario nominal</th>
						<th>Hora de entrada</th>
						<th>Hora de salida</th>
						<th>Acción</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($historial as $datoslab)
						<tr {{--  title="Haz click para más detalles" style="cursor: pointer;" data-toggle="modal" data-target="#modal-info" onclick="buscarDato({{$datoslab->id}})"--}}>
							<td>{{$datoslab->fecha_contrato}}</td>
							<td>{{ !$datoslab->contrato ? : $datoslab->contrato->nombre}}</td>
							<td>{{ !$datoslab->puesto ? : $datoslab->puesto->nombre}}</td>
							<td>{{$datoslab->salario_nomina}}</td>
							<td>{{$datoslab->hora_entrada}}</td>
							<td>{{$datoslab->hora_salida}}</td>
							<td>
								<a href="#" class="btn btn-info">Ver</a>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
			{{ $historial->links() }}
	</div>
	<div class="card-footer">
		<div class="d-flex justify-content-center">
			<a href="{{ route('empleados.laborals.create',['empleado'=>$empleado]) }}" class="btn btn-success">
				<i class="fa fa-plus"></i><strong> Agregar registro laboral</strong>
			</a>
		</div>
	</div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>   
<script>

function currencyFormat(num) {
  return '$' + num.toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
}

// console.log( currencyFormat($('#salario_nominal_input').val()) );

</script>

@endsection
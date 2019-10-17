@extends('principal')
@section('content')
<div class="card card-default">
	<div class="card-header">
		<h4>CRM</h4>
	</div>
	<div class="card-body">
		<div class="row-group">
			<div class="d-flex justify-content-center">
				<form action="{{ route('crms.index') }}" method="GET">
				 	<div class="row row-group">
	                    <div class="col-6 col-sm-6 col-md-4 col-lg-4 col-xl-4 form-group">
	                        <label for="desde">Desde:</label>
	                        <input class="form-control" type="date" name="desde" value="">
	                    </div>
	                    <div class="col-6 col-sm-6 col-md-4 col-lg-4 col-xl-4 form-group">
	                        <label for="hasta">Hasta:</label>
	                        <input class="form-control" type="date" name="hasta" value="">
	                    </div>
	                    <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
	                    	<label><br></label>
                            <button class="form-control btn btn-primary" type="submit"><i class="fas fa-search"></i> Buscar</button>
	                    </div>
	                </div>
				</form>
			</div>
		</div>
		<div class="row-group">
			<table class="table table-striped table-bordered" id="crms">
				<thead>
					<tr class="thead-light">
                        <th class="text-center">Prospecto</th>
                        <th class="text-center" style="white-space:nowrap;">Fecha contacto</th>
                        <th class="text-center">Hora</th>
                        <th class="text-center" style="white-space:nowrap;">Fecha aviso</th>
						<th class="text-center">Teléfono</th>
						<th class="text-center">Celular</th>
                        <th class="text-center">Correo</th>
						<th class="text-center">Tarea</th>
						<th class="text-center">Status</th>
						<th class="text-center">Proceso</th>
						<th class="text-center">Detalles</th>
						<th class="text-center">CRM</th>
                        <th class="text-center">Acción</th>
                    </tr>
				</thead>
				<tbody>
					@forelse ($crms as $crm)
						<tr class="text-center">
							<td style="white-space:nowrap;">
                                {{$crm->prospecto->nombre." ".$crm->prospecto->appaterno." ".$crm->prospecto->apaterno}}
                            </td>
                            <td>
                                {{$crm->fecha_contacto}}
                            </td>
                            <td>
                                {{$crm->hora_contacto}}
                            </td>
                            <td style="white-space:nowrap;">
                            	{{$crm->fecha_aviso}}
                            </td>
                            <td>
								{{$crm->prospecto->tel}}
							</td>
							<td>
								{{$crm->prospecto->movil}}
							</td>
                            <td>
                                {{$crm->prospecto->email}}
                            </td>
                            <td>
                                @foreach ($crm->tasks as $tarea)
                                    <form method="POST" action="{{ route('crms.tareas.tarea_checked',['crm'=>$crm,'tarea'=>$tarea]) }}">
                                        @csrf
                                        <p title="{{$tarea->descripcion}}">{{$tarea->nombre}} <input type="checkbox"  {{$tarea->pivot->hecho ? 'checked="" disabled=""' : ''}} onChange="if(confirm('¿Tarea realizada?')){this.form.submit();}else{this.checked = false}"></p>
                                    </form>
                                @endforeach
                            </td>
                            <td>
                                {{$crm->status}}
							</td>
							<td>
								<a class="btn btn-sm mt-1 mb-1 ml-1 mr-1 btn-light" href="{{ route('empleados.prospectos.crms.show',['prospecto'=>$crm->prospecto,'empleado'=>$empleado,'crm'=>$crm]) }}"><i class="fas fa-info-circle"></i></a> 
							</td>
							<td style="white-space:nowrap;">
								<a class="btn btn-sm mt-1 mb-1 ml-1 mr-1 btn-success" href="{{ route('empleados.prospectos.crms.index',['empleado'=>$empleado,'prospecto'=>$crm->prospecto]) }}"><i class="far fa-calendar-alt"></i><strong> CRM</strong></a>
							</td>
							<td>
                                <div class="row justify-content-around">
									<a class="btn btn-sm mt-1 mb-1 ml-1 mr-1 btn-info" href="{{ route('empleados.prospectos.show',['empleado'=>$empleado,'prospecto'=>$crm->prospecto]) }}"><i class="far fa-eye"></i><strong> Prospecto</strong></a>
                                    <a class="btn btn-sm mt-1 mb-1 ml-1 mr-1 btn-success" href="{{ route('empleados.prospectos.crms.create', ['empleado'=>$empleado,'prospecto' => $crm->prospecto]) }}"><i class="fas fa-calendar-plus"></i></i><strong> Nuevo</strong></a>
								</div>
							</td>
						</tr>
					@empty
						<div class="alert alert-warning" role="alert">
							No se encontraron registros
						</div>
					@endforelse
				</tbody>
			</table>
		</div>
	</div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>    
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" defer></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js" defer></script>
    <script>
        $(document).ready(function() {
            // console.log($('#corrdia'));
            $('#crms').DataTable();
        } );
    </script>

@endsection
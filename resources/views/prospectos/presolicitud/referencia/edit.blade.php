@extends('principal')
@section('content')
<div class="card">
	@include('prospectos.presolicitud.navs',['prospectos'=>$prospecto,'presolicitud'=>$presolicitud,'active'=>'Referencias'])
	<form method="POST"
		action="{{ route('prospectos.presolicitud.referencias.update',['prospecto'=>$prospecto,'presolicitud'=>$presolicitud]) }}">
		@csrf
		@method('PUT')
		<div class="card-body">
			@if ($errors->any())
			<div class="alert alert-danger">
				<ul>
					@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
			@endif
			@foreach ($presolicitud->referencias as $i=>$referencia)
				<label>Referencia #{{$i+1}}</label>
				<div class="row">
					<input name="index[{{$i}}]" type="hidden" value="{{$referencia->id}}">
					<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
						<label for="">Apellido Paterno</label>
						<input type="text" class="form-control" name="paterno[{{$i}}]" required=""
							value="{{$referencia->paterno}}">
					</div>
					<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
						<label for="">Apellido Materno</label>
						<input type="text" class="form-control" name="materno[{{$i}}]"
							value="{{$referencia->materno}}">
					</div>
					<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
						<label for="">Nombre(s)</label>
						<input type="text" class="form-control" name="nombre[{{$i}}]" required=""
							value="{{$referencia->nombre}}">
					</div>
					<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
						<label for="">Telefono</label>
						<input type="text" step="1" min="0" class="form-control" name="telefono[{{$i}}]" required=""
							value="{{$referencia->telefono}}">
					</div>
					<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
						<label for="">Parentesco</label>
						<input type="text" step="1" min="0" class="form-control" name="parentesco[{{$i}}]" required=""
							value="{{$referencia->parentesco}}">
					</div>
				</div>
				@endforeach
		</div>



		<!-- Modal -->
		<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
			aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">CREAR GRUPO</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-12">
								<div class="card">
									<div class="card-body">
										<p class="text-monospace text-muted m-0">Solo aparecerán los grupos con una vigencia mayor o igual a 90 meses.</p>
									</div>
								</div>
							</div>
						</div>
						<div class="row mt-2">
							@if ($grupos->count() != 0)
							<div class="col-12">
								<label for="">ASIGNAR GRUPO</label>
								<select name="grupo" id="" class="form-control">
									<option value="">Automaticamente</option>
									@foreach ($grupos as $grupo)
									<option value="{{$grupo->id}}">{{$grupo->id}}</option>
									@endforeach
								</select>
							</div>
							@else
							<div class="col-12">
								<div class="alert alert-danger">
									No hay ningún grupo disponible que tenga una vigencia igual o mayor a 90 meses.
								</div>
							</div>
							@endif
						</div>
					</div>
					<div class="modal-footer">
						<button class="btn btn-success" id="submit" type="submit"><i
								class="fas fa-arrow-alt-circle-right"></i>
							Siguiente</button>
					</div>
				</div>
			</div>
		</div>

		<div class="card-footer">
			<div class="d-flex justify-content-center">
				<!-- Button trigger modal -->
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
					Guardar
				</button>
			</div>
		</div>

	</form>
</div>
@endsection
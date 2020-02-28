@extends('principal')
@section('content')
<div class="card">
	@include('prospectos.presolicitud.navs',['prospectos'=>$prospecto,'presolicitud'=>$presolicitud,'active'=>'Referencias'])
	<form method="POST"
		action="{{ route('prospectos.presolicitud.referencias.store',['prospecto'=>$prospecto,'presolicitud'=>$presolicitud]) }}">
		@csrf
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
			@for($i = 0; $i < $prospecto->perfil->referencia_personals->count(); $i++)
				<label>Referencia #{{$i+1}}</label>
				<div class="row">
					<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
						<label for="">Apellido Paterno</label>
						<input type="text" class="form-control" name="paterno[{{$i}}]" required=""
							value="{{$prospecto->perfil->referencia_personals[$i]->paterno}}">
					</div>
					<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
						<label for="">Apellido Materno</label>
						<input type="text" class="form-control" name="materno[{{$i}}]"
							value="{{$prospecto->perfil->referencia_personals[$i]->materno}}">
					</div>
					<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
						<label for="">Nombre(s)</label>
						<input type="text" class="form-control" name="nombre[{{$i}}]" required=""
							value="{{$prospecto->perfil->referencia_personals[$i]->nombre}}">
					</div>
					<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
						<label for="">Telefono</label>
						<input type="text" step="1" min="0" class="form-control" name="telefono[{{$i}}]" required=""
							value="{{$prospecto->perfil->referencia_personals[$i]->telefono}}">
					</div>
					<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
						<label for="">Parentesco</label>
						<input type="text" step="1" min="0" class="form-control" name="parentesco[{{$i}}]" required=""
							value="{{$prospecto->perfil->referencia_personals[$i]->parentesco}}">
					</div>
				</div>
				@endfor
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
								<label for="">ASIGNAR GRUPO</label>
								<select name="grupo" id="" class="form-control">
									<option value="">Automaticamente</option>
									@foreach ($grupos as $grupo)
										<option value="{{$grupo->id}}">{{$grupo->id}}</option>
									@endforeach
								</select>
							</div>
						</div>
					</div>
					<div class="modal-footer">
							<button class="btn btn-success" id="submit" type="submit"><i class="fas fa-arrow-alt-circle-right"></i>
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
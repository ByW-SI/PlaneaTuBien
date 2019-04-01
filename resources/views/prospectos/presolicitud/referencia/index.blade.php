@extends('principal')
@section('content')
<div class="card">
	@include('prospectos.presolicitud.navs',['prospectos'=>$prospecto,'presolicitud'=>$presolicitud,'active'=>'Referencias'])
	<div class="card-body">
		<div class="row">
			<table class="table table-bordered table-striped">
				<thead>
					<tr>
						<th scope="col">#</th>
						<th scope="col">Apellido Paterno</th>
						<th scope="col">Apellido Materno</th>
						<th scope="col">Nombre(s)</th>
						<th scope="col">Teléfono</th>
						<th scope="col">Parentesco</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($presolicitud->referencias as $index=>$referencia)
						<tr>
							<th scope="row">{{$index+1}}</th>
							<td>{{$referencia->paterno}}</td>
							<td>{{$referencia->materno}}</td>
							<td>{{$referencia->nombre}}</td>
							<td>{{$referencia->telefono}}</td>
							<td>{{$referencia->parentesco}}</td>
						</tr>
					@endforeach
				</tbody>
			</table>
			
			
		</div>
	</div>
	<div class="card-footer">
		<div class="d-flex justify-content-center">
			{{-- <button class="btn btn-success" type="submit"><i class="fas fa-arrow-alt-circle-right"></i> Siguiente</button> --}}
		</div>
	</div>

	</form>
</div>
@endsection
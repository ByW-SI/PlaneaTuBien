@extends('principal')
@section('content')
<div class="card">
	@include('prospectos.presolicitud.navs',['prospectos'=>$prospecto,'presolicitud'=>$presolicitud,'active'=>'Beneficiario'])
	<div class="card-body">
		<div class="row">
			<table class="table table-bordered table-striped">
				<thead>
					<tr>
						<th scope="col">#</th>
						<th scope="col">Apellido Paterno</th>
						<th scope="col">Apellido Materno</th>
						<th scope="col">Nombre(s)</th>
						<th scope="col">Edad</th>
						<th scope="col">Parentesco</th>
						<th scope="col">Porcentaje del bien</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($presolicitud->beneficiarios as $index=>$beneficiario)
						<tr>
							<th scope="row">{{$index+1}}</th>
							<td>{{$beneficiario->paterno}}</td>
							<td>{{$beneficiario->materno}}</td>
							<td>{{$beneficiario->nombre}}</td>
							<td>{{$beneficiario->edad}}</td>
							<td>{{$beneficiario->parentesco}}</td>
							<td>{{$beneficiario->porcentaje}}%</td>
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
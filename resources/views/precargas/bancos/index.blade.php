@extends('principal')
@section('content')

<div class="card">
	<div class="card-header">
		<div class="row">
			<div class="col-sm-4">
				<h4>Bancos:</h4>
			</div>
			<div class="col-sm-4 text-center">
				<a href="{{ route('bancos.create') }}" class="btn btn-success">
					<i class="fa fa-plus"></i><strong> Agregar Banco</strong>
				</a>
			</div>
		</div>
	</div>
	<div class="card-body">
		<div class="row">
			<div class="col-sm-12">
				@if(count($bancos) > 0)
					<table class="table table-bordered table-hover table-stripped" style="margin-bottom: 0px;">
						<tr class="table-primary">
							<th>Nombre</th>
							<th>Etiqueta</th>
							<th>Eliminar</th>
						</tr>
						@foreach($bancos as $banco)
							<tr>
								<td>{{ $banco->nombre }}</td>
								<td>{{ $banco->etiqueta ? $banco->etiqueta : 'N/A' }}</td>
								<td class="text-center">
									<form action="{{url('bancos', ['banco'=>$banco])}}" method="POST">
										@csrf
										<input type="hidden" name="_method" value="delete" />
										<button class="btn btn-danger" type="submit">Eliminar</button>
									</form>
								</td>
							</tr>
						@endforeach
					</table>
				@else
					<h4>No hay bancos disponibles.</h4>
				@endif
			</div>
		</div>
	</div>
</div>

@endsection
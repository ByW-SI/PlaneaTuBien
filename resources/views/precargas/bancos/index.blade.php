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
							{{-- <th>Acción</th> --}}
						</tr>
						@foreach($bancos as $banco)
							<tr>
								<td>{{ $banco->nombre }}</td>
								<td>{{ $banco->etiqueta ? $banco->etiqueta : 'N/A' }}</td>
								{{-- <td class="text-center">
									<a href="{{ route('bancos.show', ['banco' => $banco]) }}" class="btn btn-sm btn-primary">
										<i class="fa fa-eye"></i> Ver
									</a>
									<a href="{{ route('bancos.edit', ['banco' => $banco]) }}" class="btn btn-sm btn-warning">
										✎ Editar
									</a>
								</td> --}}
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
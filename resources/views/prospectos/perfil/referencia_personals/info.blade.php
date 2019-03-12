<div class="card">
	<div class="card-header">
		Referencia personal:
	</div>
	<div class="card-body">
		{{-- {{$referencias}} --}}
		@foreach ($referencias as $index=> $referencia)
			<div class="form-group row">
				<div class="col-12">
					<h5>Referencia #{{$index+1}}</h5>
				</div>
				<div class="col-6">
					<label for="">Nombre:</label>
					<label class="form-control" readonly="">{{$referencia->nombre_completo}}</label>
				</div>
				<div class="col-6">
					<label for="">Parentesco:</label>
					<label class="form-control" readonly="">{{$referencia->parentesco}}</label>
				</div>
				<div class="col-6">
					<label for="">Telefono:</label>
					<label class="form-control" readonly="">{{$referencia->telefono}}</label>
				</div>
				<div class="col-6">
					<label for="">Celular:</label>
					<label class="form-control" readonly="">{{$referencia->celular}}</label>
				</div>
			</div>
		@endforeach
	</div>
	<div class="card-footer">
		<div class="d-flex justify-content-center">
			<a href="#" class="btn btn-success">Agregar referencia personal</a>
		</div>
	</div>
</div>
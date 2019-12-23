@extends('principal')
@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="card card-default">
	<div class="card-header">
		<h4>
			Prospecto: {{$prospecto->nombre." ".$prospecto->appaterno." ".$prospecto->apmaterno}}
		</h4>
		@if($prospecto->asesor)
		<h4>
			Asesor: {{$prospecto->asesor->nombre.' '.$prospecto->asesor->paterno.' '.$prospecto->asesor->materno}}
		</h4>
		@else
		<h4>
			Asesor: Sin asesor.
		</h4>
		@endif
	</div>
	<div class="card-header">
		<h5>Datos generales del prospecto:</h5>
	</div>
	<form method="POST" action="{{ route('empleados.prospectos.update',['prospecto'=>$prospecto,'empleado'=>$empleado]) }}">
		@csrf
		@method('PUT')
		<div class="card-body">
		<div class="row row-group">
			<div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
                <label>✱ Nombre:</label>
                <input type="text" name="nombre" class="form-control" value="{{ $prospecto->nombre }}" required="">
            </div>
			<div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
                <label>✱ Apellido Paterno:</label>
                <input type="text" name="appaterno" class="form-control" value="{{ $prospecto->appaterno }}" required="">
            </div>
			<div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
                <label>Apellido Materno:</label>
                <input type="text" name="apmaterno" class="form-control" value="{{ $prospecto->apmaterno }}">
            </div>
			<div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
                <label>✱ Sexo:</label>
                <select class="form-control" name="sexo" required="">
                    <option value="">Seleccionar</option>
                    <option value="Hombre" {{$prospecto->sexo && $prospecto->sexo  == "Hombre"? "selected" : ""}}>Hombre</option>
                    <option value="Mujer" {{$prospecto->sexo && $prospecto->sexo  == "Mujer" ? "selected" : ""}}>Mujer</option>
                </select>
            </div>
			<div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
                <label>✱ Correo electronico:</label>
                <input type="text" name="email" class="form-control" value="{{ $prospecto->email }}" required=""
            </div>
			<div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
                <label>Telefono:</label>
                <input type="text" name="telefono" class="form-control" value="{{ $prospecto->telefono }}">
            </div>
			<div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
                <label>✱ Telefono movil:</label>
                <input type="text" name="celular" class="form-control" value="{{ $prospecto->celular }}" required="">
            </div>
			<div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
                <label>Asesor:</label>
                <input type="text" class="form-control" value="{{$prospecto->asesor ? $prospecto->asesor->nombre.' '.$prospecto->asesor->paterno.' '.$prospecto->asesor->materno : "" }}" readonly="">
            </div>
            <div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
                <label>Estatus Prospecto:</label>
                <input type="text" class="form-control" value="{{ $prospecto->asesor ? 'Seguimiento Llamada' : 'Sin asesor' }}" readonly="">
            </div>
		</div>
	</div>
	<div class="card-footer">
		<div class="d-flex justify-content-center">
			<button type="submit" class="btn btn-success" id="basic-addon1">
				<i class="fas fa-save"></i>
				<strong> Guardar</strong>
			</button>
		</div>
	</div>
	</form>
</div>
@endsection
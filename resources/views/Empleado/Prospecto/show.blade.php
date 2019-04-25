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
		<h4>
			Asesor: {{$prospecto->asesor->nombre.' '.$prospecto->asesor->paterno.' '.$prospecto->asesor->materno}}
		</h4>
	</div>
	<div class="card-header">
		<h5>Datos generales del prospecto:</h5>
	</div>
	<div class="card-body">
		<div class="row row-group">
			<div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
                <label>Nombre:</label>
                <input type="text" class="form-control" value="{{ $prospecto->nombre }}" readonly="">
            </div>
			<div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
                <label>Apellido Paterno:</label>
                <input type="text" class="form-control" value="{{ $prospecto->appaterno }}" readonly="">
            </div>
			<div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
                <label>Apellido Materno:</label>
                <input type="text" class="form-control" value="{{ $prospecto->apmaterno }}" readonly="">
            </div>
			<div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
                <label>Sexo:</label>
                <input type="text" class="form-control" value="{{ $prospecto->sexo }}" readonly="">
            </div>
			<div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
                <label>Correo electronico:</label>
                <input type="text" class="form-control" value="{{ $prospecto->email }}" readonly="">
            </div>
			<div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
                <label>Telefono:</label>
                <input type="text" class="form-control" value="{{ $prospecto->tel }}" readonly="">
            </div>
			<div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
                <label>Telefono movil:</label>
                <input type="text" class="form-control" value="{{ $prospecto->movil }}" readonly="">
            </div>
			<div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
                <label>Asesor:</label>
                <input type="text" class="form-control" value="{{ $prospecto->asesor->nombre.' '.$prospecto->asesor->paterno.' '.$prospecto->asesor->materno }}" readonly="">
            </div>
		</div>
	</div>
	
	<div class="card-header">
		<h4>
			Estudio socioeconómico
		</h4>
	</div>
	<div class="card-body">
		<div class="row row-group">
			<div class="form-group col-12 col-xs-12 col-md-4 col-lg-4 col-xl-4">
				<label for="sueldo">Sueldo mensual del prospecto:</label>
				<div class="input-group mb-3">
					<div class="input-group-prepend">
						<span class="input-group-text" id="basic-addon1">$</span>
					</div>
					<input class="form-control" readonly="" type="text" value="{{number_format($prospecto->sueldo,2)}}">
				</div>
			</div><div class="form-group col-12 col-xs-12 col-md-4 col-lg-4 col-xl-4">
				<label for="sueldo">Gastos mensual del prospecto:</label>
				<div class="input-group mb-3">
					<div class="input-group-prepend">
						<span class="input-group-text" id="basic-addon1">$</span>
					</div>
					<input class="form-control" readonly="" type="text" value="{{number_format($prospecto->gastos,2)}}">
				</div>
			</div>
			<div class="form-group col-12 col-xs-12 col-md-4 col-lg-4 col-xl-4">
				<label for="ahorro">Ahorro neto del prospecto:</label>
				<div class="input-group mb-3">
					<div class="input-group-prepend">
						<span class="input-group-text" id="basic-addon1">$</span>
					</div>
					<input class="form-control" readonly="" type="text" value="{{number_format($prospecto->ahorro,2)}}">
				</div>
			</div>
			<div class="form-group col-12 col-xs-12 col-md-4 offset-md-2 col-lg-4 offset-lg-2 col-xl-4  offset-xl-2">
				<label for="calificacion">Calificación del prospecto:</label>
				<input class="form-control" readonly="" type="text" value="{{$prospecto->calificacion}}">
			</div>
			<div class="form-group col-12 col-xs-12 col-md-12 col-lg-4 col-xl-4">
				<label for="estado">Estado del prospecto:</label>
				<input class="form-control" readonly="" type="text" value="{{$prospecto->aprobado ? 'Aprobado' : 'No Aprobado'}}" >
			</div>
		</div>
	</div>
	<div class="card-header">
		<h4>
			Datos del prestamo
		</h4>
	</div>
	<div class="card-body">
		<div class="row row-group">
			<div class="form-group col-12 col-xs-12 col-md-6 col-lg-6 col-xl-6">
                <label for="monto">Monto que desea obtener/ monto que puede obtener:</label>
				<div class="input-group mb-3">
					<div class="input-group-prepend">
						<span class="input-group-text" id="basic-addon1">$</span>
					</div>
					<input class="form-control" readonly="" type="text" value="{{number_format($prospecto->monto,2)}}">
				</div>
            </div>
            <div class="form-group col-12 col-xs-12 col-md-6 col-lg-6 col-xl-6">
				<label for="plan">Plan que desea obtener/ plan que puede obtener:</label>
				<input class="form-control" readonly="" type="text" value="{{$prospecto->plan}}" >
			</div>
		</div>
	</div>
	<div class="card-footer">
		<div class="d-flex justify-content-around">
			<a href="{{ route('empleados.prospectos.crms.index',['empleado'=>$empleado,'prospecto'=>$prospecto]) }}" class="btn btn-info" id="basic-addon1">
				<i class="far fa-calendar-check"></i>
				<strong> C.R.M.</strong>
			</a>
			<a href="{{ route('empleados.prospectos.edit',['empleado'=>$empleado,'prospecto'=>$prospecto]) }}" class="btn btn-success" id="basic-addon1">
				<i class="fas fa-user-edit"></i>
				<strong> Editar prospecto</strong>
			</a>
			<a href="{{ route('empleados.prospectos.cotizacions.index',['empleado'=>$empleado,'prospecto'=>$prospecto]) }}" class="btn btn-info" id="basic-addon1">
				<i class="fas fa-file-invoice-dollar"></i>
				<strong> Cotizador</strong>
			</a>
			@if ($prospecto->perfil)
				<a href="{{ route('prospectos.perfil.datos_personal.index',['prospecto'=>$prospecto]) }}" class="btn btn-success" id="basic-addon1">
					<i class="fas fa-file-invoice"></i>
					<strong> Perfil</strong>
				</a>
			
			@endif
		</div>
	</div>
</div>
@endsection
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
	<form method="POST" action="{{ route('empleados.prospectos.update',['prospecto'=>$prospecto,'empleado'=>$empleado]) }}">
		@csrf
		@method('PUT')
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
						<input class="form-control" type="number" name="sueldo" step="any" required>
					</div>
				</div>
				<div class="form-group col-12 col-xs-12 col-md-4 col-lg-4 col-xl-4">
					<label for="ahorro">Ahorro neto del prospecto:</label>
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1">$</span>
						</div>
						<input class="form-control" type="number" name="ahorro" step="any" required>
					</div>
				</div>
				<div class="form-group col-12 col-xs-12 col-md-4 col-lg-4 col-xl-4">
					<label for="calificacion">Calificación del prospecto:</label>
					<input class="form-control" type="number" name="calificacion" step="1" min="0" max="10" required>
				</div>
				<div class="form-group col-12 col-xs-12 col-md-12 offset-md-4 col-lg-12 offset-lg-4 col-xl-12 offset-xl-4">
					<div class="form-check form-check-inline">
					  <input class="form-check-input" type="radio" name="aprobado" id="aprobado" required value="1">
					  <label class="form-check-label" for="inlineRadio1">Aprobado</label>
					</div>
					<div class="form-check form-check-inline">
					  <input class="form-check-input" type="radio" name="aprobado" id="inlineRadio2" value="0">
					  <label class="form-check-label" for="inlineRadio2">No aprobado</label>
					</div>
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
					<select name="monto" class="form-control" id="monto" required>
						<option value="">Seleccionar</option>
	                    @for($i = 300000; $i <= 20000000; $i += 50000)
	                    	<option value="{{ $i }}" {{$prospecto->monto == $i ? "selected" : ""}} >${{ number_format($i, 2) }}</option>
	                    @endfor
	                </select>
	            </div>
	            <div class="form-group col-12 col-xs-12 col-md-6 col-lg-6 col-xl-6">
					<label for="plan">Plan que desea obtener/ plan que puede obtener:</label>
					<select name="plan" class="form-control" id="plan" required>
	            		<option value="">Seleccionar</option>
	            		<option value="15 años" {{$prospecto->plan == "15 años" ? "selected" : ""}}>15 años</option>
	            		<option value="10 años" {{$prospecto->plan == "10 años" ? "selected" : ""}}>10 años</option>
	            		<option value="6 años" {{$prospecto->plan == "6 años" ? "selected" : ""}}>6 años</option>
	            		<option value="5 años" {{$prospecto->plan == "5 años" ? "selected" : ""}}>5 años</option>
	            		<option value="3 años" {{$prospecto->plan == "3 años" ? "selected" : ""}}>3 años</option>
	            	</select>
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
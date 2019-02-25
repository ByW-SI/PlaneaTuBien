@extends('layouts.app')
@section('content')
@if ($alert)
	<div class="alert alert-{{$alert['status']}} alert-dismissible fade show" role="alert">
		<h4 class="title">Gracias por interesarse en los servicios de Planea Tu Bien</h4>
		<p>
  			{{$alert['message']}}
		</p>
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    <span aria-hidden="true">&times;</span>
		</button>
	</div>
@endif
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="container-fluid">
	<div class="card border-primary">
		<div class="card-header bg-primary text-white">
			<h4 class="title text-center">
				Bienvenido a Tanda Casa de Planea Tu Bien
			</h4>
			<h5 class="title text-center">
				¿Deseas saber más de nuestros planes? Dejanos tus datos y nos contactamos contigo
			</h5>
		</div>
		<form action="{{ route('prospecto.submit') }}" method="POST">
			<div class="card-body">
				@csrf
				<div class="row">
					<div class="col-sm-12 col-md-6 col-lg-4 col-xl-4 form-group">
						<label for="nombre">Nombre</label>
						<input class="form-control" value="{{old('nombre')}}" name="nombre" required="">
					</div>
					<div class="col-sm-12 col-md-6 col-lg-4 col-xl-4 form-group">
						<label for="appaterno">Apellido paterno</label>
						<input class="form-control" value="{{old('appaterno')}}" name="appaterno" required="">
					</div>
					<div class="col-sm-12 col-md-6 col-lg-4 col-xl-4 form-group">
						<label for="apmaterno">Apellido materno</label>
						<input class="form-control" value="{{old('apmaterno')}}" name="apmaterno">
					</div>
					<div class="col-sm-12 col-md-6 col-lg-4 col-xl-4 form-group">
						<label for="sexo">Sexo</label>
						<select class="form-control" name="sexo">
							<option value="">Seleccionar</option>
	                        <option value="Hombre" {{old('sexo') == "Hombre" ? "selected" : ""}}>Hombre</option>
	                        <option value="Mujer" {{old('sexo') == "Mujer" ? "selected" : ""}}>Mujer</option>
						</select>
					</div>
					<div class="col-sm-12 col-md-6 col-lg-4 col-xl-4 form-group">
						<label for="email">Correo electrónico</label>
						<input class="form-control" value="{{old('email')}}" name="email" required="">
					</div>
					<div class="col-sm-12 col-md-6 col-lg-4 col-xl-4 form-group">
						<label for="tel">Telefono particular</label>
						<input class="form-control" value="{{old('tel')}}" name="tel" required="">
					</div>
					<div class="col-sm-12 col-md-6 col-lg-4 col-xl-4 form-group">
						<label for="movil">Telefono Movil</label>
						<input class="form-control" value="{{old('movil')}}" name="movil">
					</div>
					<div class="col-sm-12 col-md-6 col-lg-4 col-xl-4 form-group">
						<label for="monto">Monto que deseas obtener</label>
						<select name="monto" class="form-control" id="monto" required>
							<option value="">Seleccionar</option>
                            @for($i = 300000; $i <= 20000000; $i += 50000)
                            	<option value="{{ $i }}" {{old('monto') == $i ? "selected" : ""}} >${{ number_format($i, 2) }}</option>
                            @endfor
                        </select>
					</div>
					<div class="col-sm-12 col-md-6 col-lg-4 col-xl-4 form-group">
						<label for="plan">Plan que deseas obtener</label>
						<select name="plan" class="form-control" id="plan" required>
                    		<option value="">Seleccionar</option>
                    		<option value="15 años" {{old('plan') == "15 años" ? "selected" : ""}}>15 años</option>
                    		<option value="10 años" {{old('plan') == "10 años" ? "selected" : ""}}>10 años</option>
                    		<option value="6 años" {{old('plan') == "6 años" ? "selected" : ""}}>6 años</option>
                    		<option value="5 años" {{old('plan') == "5 años" ? "selected" : ""}}>5 años</option>
                    		<option value="3 años" {{old('plan') == "3 años" ? "selected" : ""}}>3 años</option>
                    	</select>
					</div>
				</div>
			</div>
			<div class="card-footer bg-primary">
				<div class="row">
                    <div class="col-4 offset-4 text-center">
                        <button type="submit" class="btn btn-success bg-success">
                            <i class="fa fa-check"></i> Guardar
                        </button>
                    </div>
                </div>
			</div>
		</form>
	</div>
</div>
@endsection
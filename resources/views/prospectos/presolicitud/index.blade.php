@extends('principal')
@section('content')
<div class="card">
	@include('prospectos.presolicitud.navs',['prospectos'=>$prospecto,'presolicitud'=>$presolicitud,'active'=>'Solicitante'])
	<div class="card-body">
		<div class="row">
			<div class="col-sm-12 col-md-3 col-lg-3 col-xl-3 form-group">
				<label for="">Folio</label>
				<label class="form-control bg-light">{{$presolicitud->folio}}</label>
			</div>
			<div class="col-sm-12 col-md-3 col-lg-3 col-xl-3 form-group">
				<label for="">Precio inicial</label>
				<div class="input-group mb-3">
				  	<div class="input-group-prepend">
				    	<span class="input-group-text" id="basic-addon1">$</span>
				  	</div>
					<label class="form-control bg-light">{{number_format($presolicitud->precio_inicial,2)}}</label>
				</div>
			</div>
			<div class="col-sm-12 col-md-3 col-lg-3 col-xl-3 form-group">
				<label for="">Plazo contratado</label>
				<div class="input-group mb-3">
					<label class="form-control bg-light">{{$presolicitud->plazo_contratado,2}}</label>
				  	<div class="input-group-append">
				    	<span class="input-group-text" id="basic-addon1">Meses</span>
				  	</div>
				</div>
			</div>
			<div class="col-sm-12 col-md-3 col-lg-3 col-xl-3 form-group">
				<label for="">Seguro de vida</label>
				<div class="input-group mb-3">
				  	<div class="input-group-prepend">
				    	<span class="input-group-text" id="basic-addon1">$</span>
				  	</div>
					<label class="form-control bg-light">{{number_format($presolicitud->precio_nolose,2)}}</label>
				</div>
			</div>
			<div class="col-12">
				<h5>
					Solicitante
				</h5>
			</div>
			<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
				<label for="">Apellido Paterno</label>
				<label class="form-control bg-light">{{$presolicitud->paterno}}</label>
			</div>
			<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
				<label for="">Apellido Materno</label>
				<label class="form-control bg-light">{{$presolicitud->materno}}</label>
			</div>
			<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
				<label for="">Nombre(s)</label>
				<label class="form-control bg-light">{{$presolicitud->nombre}}</label>
			</div>
			<div class="col-12">
				<h5>
					Domicilio
				</h5>
			</div>
			<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
				<label for="">Calle</label>
				<label class="form-control bg-light">{{$presolicitud->calle}}</label>
			</div>
			<div class="col-sm-12 col-md-2 col-lg-2 col-xl-2 form-group">
				<label for="">Numero exterior</label>
				<label class="form-control bg-light">{{$presolicitud->numero_ext}}</label>
			</div>
			<div class="col-sm-12 col-md-2 col-lg-2 col-xl-2 form-group">
				<label for="">Numero interior</label>
				<label class="form-control bg-light">{{$presolicitud->numero_int}}</label>
			</div>
			<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
				<label for="">Colonia</label>
				<label class="form-control bg-light">{{$presolicitud->colonia}}</label>
			</div>
			<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
				<label for="">Alcaldía o Municipio</label>
				<label class="form-control bg-light">{{$presolicitud->municipio}}</label>
			</div>
			<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
				<label for="">Estado</label>
				<label class="form-control bg-light">{{$presolicitud->estado}}</label>
			</div>
			<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
				<label for="">Código Postal</label>
				<label class="form-control bg-light">{{$presolicitud->cp}}</label>
			</div>
			<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
				<label for="">R.F.C.</label>
				<label class="form-control bg-light">{{$presolicitud->rfc}}</label>
			</div>
			<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
				<label for="">Télefono de casa</label>
				<label class="form-control bg-light">{{$presolicitud->tel_casa}}</label>
			</div>
			<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
				<label for="">Télefono de oficina</label>
				<label class="form-control bg-light">{{$presolicitud->tel_oficina}}</label>
			</div>
			<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
				<label for="">Télefono celular</label>
				<label class="form-control bg-light">{{$presolicitud->tel_celular}}</label>
			</div>
			<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
				<label for="">Correo Electrónico</label>
				<label class="form-control bg-light">{{$presolicitud->email}}</label>
			</div>
			<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
				<label for="">Fecha de nacimiento</label>
				<label class="form-control bg-light">{{$presolicitud->fecha_nacimiento}}</label>
			</div>
			<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
				<label for="">Lugar de Nacimiento</label>
				<label class="form-control bg-light">{{$presolicitud->lugar_nacimiento}}</label>
			</div>
			<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
				<label for="">Nacionalidad</label>
				<label class="form-control bg-light">{{$presolicitud->nacionalidad}}</label>
			</div>
			<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
				<label for="">Sexo</label>
				<label class="form-control bg-light">{{$presolicitud->sexo}}</label>
			</div>
			<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
				<label for="">Edad</label>
				<label class="form-control bg-light">{{$presolicitud->edad}}</label>
			</div>
			<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
				<label for="">Estado Civil</label>
				<label class="form-control bg-light">{{$presolicitud->estado_civil}}</label>
			</div>
			<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
				<label for="">Profesión/Actividad</label>
				<label class="form-control bg-light">{{$presolicitud->profesion}}</label>
			</div>
			<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
				<label for="">Empresa donde trabaja</label>
				<label class="form-control bg-light">{{$presolicitud->empresa}}</label>
			</div>
			<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
				<label for="">Puesto</label>
				<label class="form-control bg-light">{{$presolicitud->puesto}}</label>
			</div>
			<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
				<label for="">Antigüedad trabajo actual</label>
				<label class="form-control bg-light">{{$presolicitud->antiguedad_actual}}</label>
			</div>
			<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
				<label for="">Antigüedad trabajo anterior</label>
				<label class="form-control bg-light">{{$presolicitud->antiguedad_anterior}}</label>
			</div>
			<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
				<label for="">Ingreso mensual familiar</label>
				<label class="form-control bg-light">{{$presolicitud->ingreso_mensual}}</label>
			</div>
			<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
				<label for="">¿Cómo se entero de nosotros?</label>
				<label class="form-control bg-light">{{$presolicitud->enterarse}}</label>
			</div>
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
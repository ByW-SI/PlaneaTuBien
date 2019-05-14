@extends('principal')
@section('content')
<div class="card">
    <div class="card-header">
        Pago {{$pago->id.$pago->cotizacion->folio}} del prospecto {{$pago->prospecto->nombre." ".$pago->prospecto->appaterno." ".$pago->prospecto->apmaterno}}
    </div>
    <div class="card-body">
    	<div class="row">
    		<div class="col-12 col-xs-12 col-md-4 col-lg-4 form-group">
    			<label for="folio">Prospecto</label>
				<span class="form-control">{{$pago->prospecto->nombre." ".$pago->prospecto->appaterno." ".$pago->prospecto->apmaterno}}</span>
    		</div>
    		<div class="col-12 col-xs-12 col-md-3 col-lg-3 form-group">
    			<label for="folio">Monto del bien</label>
				<span class="form-control">${{number_format($pago->cotizacion->monto,2)}}</span>
    		</div>
    		<div class="col-12 col-xs-12 col-md-2 col-lg-2 form-group">
    			<label for="folio">Plan</label>
				<span class="form-control">{{$pago->cotizacion->plan->nombre}}</span>
    		</div>
    		<div class="col-12 col-xs-12 col-md-3 col-lg-3 form-group">
    			<label for="folio">Monto de inscripción</label>
				<span class="form-control">${{number_format($pago->cotizacion->inscripcion_total,2)}}</span>
    		</div>
    		<div class="col-12 col-xs-12 col-md-4 col-lg-4 form-group">
    			<label for="folio">Asesor</label>
				<span class="form-control">{{$pago->prospecto->asesor->nombre." ".$pago->prospecto->asesor->paterno." ".$pago->prospecto->asesor->materno}}</span>
    		</div>
    		<div class="col-12 col-xs-12 col-md-4 col-lg-4 form-group">
				<label for="referencia">Referencia</label>
				<span class="form-control">{{$pago->referencia}}</span>
			</div>
    		<div class="col-12 col-xs-12 col-md-4 col-lg-4 form-group">
    			<label for="folio">Folio</label>
				<span class="form-control">{{$pago->folio}}</span>
    		</div>
    		<div class="col-12 col-xs-12 col-md-4 col-lg-4 form-group">
    			<label for="folio">Tipo de Identificación</label>
				<span class="form-control">{{$pago->identificacion}}</span>
    		</div>
    		<div class="col-12 col-xs-12 col-md-4 col-lg-4 form-group">
				<label for="comprobante">Comprobante de Domicilio</label>
				<span class="form-control">{{$pago->comprobante}}</span>
			</div>
    		<div class="col-12 col-xs-12 col-md-4 col-lg-4 form-group">
    			<label for="folio">Forma de Pago</label>
				<span class="form-control">{{$pago->forma}}</span>
    		</div>
    		@if ($pago->forma == "Depósito")
	    		<div class="col-12 col-xs-12 col-md-4 col-lg-4 form-group">
	    			<label for="folio">Banco</label>
					<span class="form-control">{{$pago->banco}}</span>
	    		</div>
    		@endif
    	</div>
    	<div class="row">
    		<div class="col-12 col-xs-12 col-md-4 col-lg-4 form-group">
    			<label for="folio">Monto</label>
				<span class="form-control">${{number_format($pago->monto,2)}}</span>
    		</div>
    		<div class="col-12 col-xs-12 col-md-4 col-lg-4 form-group">
    			<label for="folio">total</label>
				<span class="form-control">${{number_format($pago->total,2)}}</span>
    		</div>
    	</div>
    </div>
    <div class="card-header">
    	<div class="d-flex justify-content-around">
    		<a href="{{ route('pagos.index') }}" class="btn btn-info text-white"><i class="fas fa-angle-left"></i>Regresar</a>
    	</div>
    </div>
</div>
@endsection
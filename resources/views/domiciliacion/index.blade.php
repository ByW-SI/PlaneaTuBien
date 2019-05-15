@extends('principal')
@section('content')
<div class="card">
	<div class="card-header">
		Formato de domiciliación para el recibo #{{$recibo->clave.$recibo->id}}
	</div>
	<div class="card-body">
		<div class="row">
			<div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6 form-group">
				<label for="">Emisor</label>
				<span class="form-control bg-light">PLANEA TU BIEN S.A. DE C.V.</span>
			</div>
			<div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6 form-group">
				<label for="">R.F.C.</label>
				<span class="form-control bg-light">PTB091030MS1</span>
			</div>
			<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 form-group">
				<label for="">Domicilio</label>
				<span class="form-control bg-light">HOMERO 229, INT-103, COL. CHAPULTEPEC MORALES, C.P. 11570, MEXICO DISTRITO FEDERAL</span>
			</div>
			<div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6 form-group">
				<label for="">Cliente del emisor titular del servicio (Nombre Completo)</label>
				<span class="form-control bg-light">{{strtoupper($domiciliacion->emisor)}}</span>
			</div>
			<div class="col-12 col-sm-6 col-md-4 col-lg-6 col-xl-6 form-group">
				<label for="">Referencia</label>
				<span class="form-control bg-light">{{strtoupper($domiciliacion->referencia)}}</span>
			</div>
			<div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-4 form-group">
				<label for="">Concepto del recibo</label>
				<span class="form-control bg-light">PAGO DE MENSUALIDAD</span>
			</div>
			<div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-4 form-group">
				<label for="">Monto del recibo</label>
				<span class="form-control bg-light">${{number_format($plan->cuota_periodica_integrante($recibo->monto),2)}}</span>
			</div>
			<div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-4 form-group">
				<label for="">I.V.A. del recibo</label>
				<span class="form-control bg-light">$0.00</span>
			</div>
			<div class="col-12 col-sm-6 col-md-6 col-lg-12 col-xl-12 form-group">
				<label for="">Cliente usuario titular de la cuenta bancaria (Nombre Completo)</label>
				<span class="form-control bg-light">{{strtoupper($domiciliacion->titular)}}</span>
			</div>
			<div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6 form-group">
				<label for="">Banco receptor donde recida la cuenta bancaria (Razón Social)</label>
				<span class="form-control bg-light">{{strtoupper($domiciliacion->banco)}}</span>
			</div>
			<div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6 form-group">
				<label for="">Numero de {{$domiciliacion->tipo}}</label>
				<span class="form-control bg-light">{{$domiciliacion->numero}}</span>
			</div>
		</div>
	</div>
	<div class="card-footer">
		<div class="d-flex justify-content-around">
			<a href="{{ route('recibos.domiciliacion.edit',['recibo'=>$recibo,'domiciliacion'=>$domiciliacion]) }}" class="btn btn-info">Editar</a>
			<a href="{{ route('recibos.domiciliacion.show',['recibo'=>$recibo,'domiciliacion'=>$domiciliacion]) }}" class="btn btn-success">Descargar formato</a>
		</div>
	</div>
</div>
@endsection
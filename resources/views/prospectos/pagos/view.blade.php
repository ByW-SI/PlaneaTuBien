@extends('principal')
@section('content')

<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-sm-3">
                <h4>Datos del Prospecto:</h4>
            </div>
            <div class="col-sm-3 text-center">
                <a href="{{ route('prospectos.edit', ['prospecto' => $prospecto]) }}" class="btn btn-warning">
                    <strong>✎ Editar Prospecto</strong>
                </a>
            </div>
            <div class="col-sm-3 text-center">
                <a href="{{ route('prospectos.create') }}" class="btn btn-success">
                    <i class="fa fa-plus"></i><strong> Agregar Prospecto</strong>
                </a>
            </div>
            <div class="col-sm-3 text-center">
                <a href="{{ route('prospectos.index') }}" class="btn btn-primary">
                    <i class="fa fa-bars"></i><strong> Lista de Prospectos</strong>
                </a>
            </div>
        </div>
    </div>
    <div class="card-body">
        @include('prospectos.info')
        <div class="row">
            <div class="col-sm-12">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('prospectos.cotizacions.index', ['prospecto' => $prospecto]) }}">Cotización</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('prospectos.pagos.index', ['prospecto' => $prospecto]) }}">Pagos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">CRM</a>
                    </li>
                </ul>
            </div>
        </div>
		<div class="card">
		    <div class="card-header">
				<div class="row">
					<div class="col-sm-4">
						<h4>Datos del Pago:</h4>
					</div>
                    <div class="col-sm-4 text-center">
                        <a href="{{ route('prospectos.pagos.create', ['prospecto' => $prospecto]) }}" class="btn btn-success">
                            <i class="fa fa-plus"></i><strong> Agregar Pago</strong>
                        </a>
                    </div>
                    <div class="col-sm-4 text-center">
                        <a href="{{ route('prospectos.pagos.index', ['prospecto' => $prospecto]) }}" class="btn btn-primary">
                            <i class="fa fa-bars"></i><strong> Lista de Pagos</strong>
                        </a>
                    </div>
				</div>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-sm-3 form-group">
						<label class="control-label">Préstamo:</label>
						<dd>${{ number_format($pago->cotizacion->prestamo, 2) }}</dd>
					</div>
					<div class="col-sm-3 form-group">
						<label class="control-label">Meses:</label>
						<dd>{{ $pago->cotizacion->meses }} meses</dd>
					</div>
					<div class="col-sm-3 form-group">
						<label class="control-label">Total a pagar:</label>
						<dd>${{ number_format($pago->total, 2) }}</dd>
					</div>
					<div class="col-sm-3 form-group">
						<label class="control-label">Fecha del pago:</label>
						<dd>{{ $pago->created_at }}</dd>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-3 form-group">
						<label class="control-label">Identificación:</label>
						<dd>{{ $pago->identificacion }}</dd>
					</div>
					<div class="col-sm-3 form-group">
						<label class="control-label">Comprobante de Domicilio:</label>
						<dd>{{ $pago->comprobante }}</dd>
					</div>
					<div class="col-sm-3 form-group">
						<label class="control-label">Forma de Pago:</label>
						<dd>{{ $pago->forma }}</dd>
					</div>
					@if($pago->banco)
						<div class="col-sm-3 form-group">
							<label class="control-label">Banco:</label>
							<dd>{{ $pago->banco }}</dd>
						</div>
					@endif
					@if($pago->cheque)
						<div class="col-sm-3 form-group">
							<label class="control-label">Número de Cheque:</label>
							<dd>{{ $pago->cheque }}</dd>
						</div>
					@endif
					@if($pago->tarjeta)
						<div class="col-sm-3 form-group">
							<label class="control-label">Número de Tarjeta:</label>
							<dd>{{ $pago->tarjeta }}</dd>
						</div>
					@endif
					@if($pago->tarjetaHabiente)
						<div class="col-sm-3 form-group">
							<label class="control-label">Nombre del Tarjetahabiente:</label>
							<dd>{{ $pago->tarjetaHabiente }}</dd>
						</div>
					@endif
					@if($pago->deposito)
						<div class="col-sm-3 form-group">
							<label class="control-label">Folio de Depósito:</label>
							<dd>{{ $pago->deposito }}</dd>
						</div>
					@endif
					<div class="col-sm-3 form-group">
						<label class="control-label">Monto del Pago:</label>
						<dd>${{ number_format($pago->monto, 2) }}</dd>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-3 form-group">
						<label class="control-label">Número de Referencia:</label>
						<dd>{{ $pago->referencia }}</dd>
					</div>
					<div class="col-sm-3 form-group">
						<label class="control-label">Número de Fólio:</label>
						<dd>{{ $pago->folio }}</dd>
					</div>
					<div class="col-sm-3 form-group">
						<label class="control-label">Cantidad a Pagar:</label>
						<dd>${{ number_format($pago->restante + $pago->monto, 2) }}</dd>
					</div>
					<div class="col-sm-3 form-group">
						<label class="control-label">Restante:</label>
						<dd>${{ number_format($pago->restante, 2) }}</dd>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
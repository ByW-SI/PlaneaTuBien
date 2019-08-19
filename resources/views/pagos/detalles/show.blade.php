@extends('principal')
@section('content')

<div class="container">
        <form action="#" >
            <div class="row">
                <div class="col-12 col-md-4 form-group">
                    <label><b>SPEI</b></label><br>
                    {{$pago->spei}}
                </div>
                <div class="col-12 col-md-4 form-group">
                    <label for="cliente"><strong>CLIENTE</strong></label><br>
                    {{$presolicitud->nombre." ".$presolicitud->paterno." ".$presolicitud->materno}}
                </div>
                <div class="col-12 col-md-4">
                    <label for="fecha"><strong>FECHA</strong></label><br>
                    {{$deposito_efectivo->dia}}
                </div>
                <div class="col-12 col-md-4">
                    <label for="contrato"><strong># CONTRATO</strong></label><br>
                    {{$deposito_efectivo->contrato()->first()->numero_contrato}}
                </div>
                <div class="col-12 col-md-4">
                    <label for="referencia"><strong>REFERENCIA</strong></label><br>
                    {{$deposito_efectivo->concepto}}
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-12 col-md-3">
                    <label for="monto_pagado"><strong>MONTO PAGADO</strong></label>
                    <input type="text" class="form-control" name="monto_pagado" id="monto_pagado" value="{{$pago->monto}}">
                </div>
                <div class="col-12 col-md-3">
                    <label for="monto_a_pagar"><strong>MONTO A PAGAR</strong></label>
                    <input type="text" class="form-control" name="monto_a_pagar" id="monto_a_pagar">
                </div>
                <div class="col-12 col-sm-6 text-right">
                    <button class="btn btn-success mt-4">Validar</button>
                    <button class="btn btn-danger mt-4">Rechazar</button>
                    <button class="btn btn-warning mt-4">Modificar</button>
                </div>
            </div>
            <br>
            <div class="row">
                @if( isset($pago->file_comprobante) && !empty($pago->file_comprobante) )
                    <div class="col-12 col-sm-4 form-group">
                        <img src="img/comprobantes/{{$pago->file_comprobante}}" class="img-fluid">
                    </div>
                @else
                    <div class="col-12 col-sm-4 form-group">
                        <input type="file" class="custom-file-input" id="imagen">
                        <label class="custom-file-label" for="imagen">Subir imagen</label>
                    </div>
                @endif
            </div>
        </form>
</div>

@endsection
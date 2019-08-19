@extends('principal')
@section('content')

<div class="container">
    <div class="card mb-5">
        <div class="card-body">
            <form action="#" >
                {{-- Datos generales --}}
                <div class="row">
                    <div class="col-12 col-md-4 form-group">
                        <label><b>SPEI</b></label><br>
                        @if ($pago)
                            {{$pago->spei}}
                        @else
                            N/A
                        @endif
                        
                    </div>
                    <div class="col-12 col-md-4 form-group">
                        <label for="cliente"><strong>CLIENTE</strong></label><br>
                        @if ($presolicitud)
                            {{$presolicitud->nombre." ".$presolicitud->paterno." ".$presolicitud->materno}}
                        @else
                            N/A
                        @endif
                    </div>
                    <div class="col-12 col-md-4">
                        <label for="fecha"><strong>FECHA</strong></label><br>
                        {{$deposito_efectivo->dia}}
                    </div>
                    <div class="col-12 col-md-4">
                        <label for="contrato"><strong># CONTRATO</strong></label><br>
                        @if ($deposito_efectivo->contrato()->first())
                            {{$deposito_efectivo->contrato()->first()->numero_contrato}}
                        @else
                            N/A
                        @endif
                    </div>
                    <div class="col-12 col-md-4">
                        <label for="referencia"><strong>REFERENCIA</strong></label><br>
                        {{$deposito_efectivo->concepto}}
                    </div>
                </div>
                <hr>
                {{-- Datos y opciones del pago --}}
                <div class="row">
                    <div class="col-12 col-md-3">
                        <label for="monto_pagado"><strong>MONTO PAGADO</strong></label>
                        <input type="text" class="form-control" name="monto_pagado" id="monto_pagado" value="@if($pago){{$pago->monto}}@else{{'0'}}@endif">
                    </div>
                    <div class="col-12 col-md-3">
                        <label for="monto_a_pagar"><strong>MONTO A PAGAR</strong></label>
                        <input type="text" class="form-control" name="monto_a_pagar" id="monto_a_pagar">
                    </div>
                    <div class="col-12 col-sm-6 text-right">
                        <button class="btn btn-success">
                            <i class="fa fa-check"></i>
                            <strong>Validar</strong>
                        </button>
                        <button class="btn btn-danger">
                            <i class="fa fa-ban"></i>
                            <strong>Rechazar</strong>
                        </button>
                        <button class="btn btn-warning">
                            <i class="fa fa-pencil-alt"></i>
                            <strong>Modificar</strong>
                        </button>
                    </div>
                </div>
                <br>
                {{-- Imagen y opción de imagen --}}
                <div class="row">
                    <div class="col-12 col-sm-4"></div>
                    <div class="col-12 col-sm-4">
                        <div class="form-group">
                            @if( isset($pago->file_comprobante) && !empty($pago->file_comprobante) )
                                <img src="img/comprobantes/{{$pago->file_comprobante}}" class="img-fluid img-thumbnail">
                            @else
                                <input type="file" class="custom-file-input" id="imagen">
                                <label class="custom-file-label" for="imagen">Subir imagen</label>
                            @endif
                        </div>
                    </div>
                    <div class="col-12 col-sm-4"></div>
                </div>
            </form>
        </div>
    </div>
    
</div>

@endsection
@extends('principal')
@section('content')

<div class="container">
        <form action="#" >
            <div class="row">
                <div class="col-12 col-md-4 form-group">
                    <label for="spei">SPEI</label>
                    <input type="text" class="form-control" name="spei" id="spei">
                </div>
                <div class="col-12 col-md-4 form-group">
                    <label for="cliente">cliente</label>
                    <input type="text" class="form-control" name="cliente" id="cliente">
                </div>
                <div class="col-12 col-md-4">
                    <label for="fecha">fecha</label>
                    <input type="text" class="form-control" name="fecha" id="fecha" value="{{$deposito_efectivo->dia}}">
                </div>
                <div class="col-12 col-md-4">
                    <label for="contrato">contrato</label>
                    <input type="text" class="form-control" name="contrato" id="contrato">
                </div>
                <div class="col-12 col-md-4">
                    <label for="referencia">referencia</label>
                    <input type="text" class="form-control" name="referencia" id="referencia" value="{{$deposito_efectivo->concepto}}">
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-12 col-md-3">
                    <label for="monto_pagado">monto pagado</label>
                    <input type="text" class="form-control" name="monto_pagado" id="monto_pagado">
                </div>
                <div class="col-12 col-md-3">
                    <label for="monto_a_pagar">monto a pagar</label>
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
                <div class="col-12 col-sm-4 form-group">
                    <input type="file" class="custom-file-input" id="imagen">
                    <label class="custom-file-label" for="imagen">Subir imagen</label>
                </div>
            </div>
        </form>
</div>

@endsection
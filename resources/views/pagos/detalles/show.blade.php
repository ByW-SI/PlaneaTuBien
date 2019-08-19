@extends('principal')
@section('content')

<div class="container">
        <form action="{{ route('depositoPagoValidar') }}" method="POST" id="formulario">
        {{ csrf_field() }}
            <div class="row">
                <div class="col-12 col-md-4 form-group">
                    <label for="spei">SPEI</label>
                    <input type="text" class="form-control" name="spei" id="spei" readonly="">
                </div>
                <div class="col-12 col-md-4 form-group">
                    <label for="cliente">cliente</label>
                    <input type="text" class="form-control" name="cliente" id="cliente" readonly="" value="{{ $cliente->nombre }} {{ $cliente->paterno }}  {{ $cliente->materno }}">
                </div>
                <div class="col-12 col-md-4">
                    <label for="fecha">fecha</label>
                    <input type="text" class="form-control" name="fecha" id="fecha" value="{{$deposito_efectivo->dia}}" @if(!$edit) readonly="" @endif>
                </div>
                <div class="col-12 col-md-4">
                    <label for="contrato">contrato</label>
                    <input type="text" class="form-control" name="contrato" id="contrato" value="@php(printf('%03d',$deposito_efectivo->grupo())){{ $deposito_efectivo->contrato()->first()->numero_contrato }}" @if(!$edit) readonly="" @endif>
                </div>
                <div class="col-12 col-md-4">
                    <label for="referencia">referencia</label>
                    <input type="text" class="form-control" name="referencia" id="referencia" value="{{$deposito_efectivo->concepto}}" @if(!$edit) readonly="" @endif>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-12 col-md-3">
                    <label for="monto_pagado">monto pagado</label>
                    <input type="text" class="form-control" name="monto_pagado" id="monto_pagado" @if(!$edit) readonly="" @endif value="{{ $deposito_efectivo->abono }}">
                    <input type="hidden" name="deposito_id" id="deposito_id" value="{{ $deposito_efectivo->id }}">
                </div>
                <div class="col-12 col-md-3">
                    <label for="monto_a_pagar">monto a pagar</label>
                    <input type="text" class="form-control" name="monto_a_pagar" id="monto_a_pagar" readonly="" value="{{ number_format($plan->corrida_meses_fijos($deposito_efectivo->contrato()->first()->monto)['integrante']['total'], 2)}}">
                </div>
                <div class="col-12 col-sm-6 text-right">
                        <button class="btn btn-success mt-4" id="validar">Validar</button>
                    <form action="{{ route('depositoPagoRechazar') }}" method="POST">
                        @csrf
                        <button class="btn btn-danger mt-4" id="rechazar">Rechazar</button>
                    </form>
                    <a class="btn btn-warning mt-4" href="{{ route('estadoCuenta.edit', ['deposito_efectivo'=>$deposito_efectivo]) }}">Modificar</a>
                    
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
    {{-- <div class="card mb-5">
        <div class="card-body">
            <form action="#" >
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
    </div> --}}
</div>
<script
              src="https://code.jquery.com/jquery-3.4.1.min.js"
              integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
              crossorigin="anonymous"></script>
<script>
    $('#validar').click(function(event) {
        /* Act on the event */
        event.preventDefault();
        console.log('validar');
        let spei = $('#spei').val();
        let cliente = $('#cliente').val();
        let fecha = $('#fecha').val();
        let contrato = $('#contrato').val();
        let referencia = $('#referencia').val();
        let monto_pagado = $('#monto_pagado').val();
        let monto_pagar = $('#monto_a_pagar').val();
        let deposito_id = $('#deposito_id').val();
        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });
        $.ajax({
          method: "POST",
          dataType: "json",
          url: "{{ route('depositoPagoValidar') }}",
          data: {
            "spei": spei,
            "cliente": cliente,
            "fecha": fecha,
            "contrato": contrato,
            "referencia": referencia,
            "monto_pagado": monto_pagado,
            "monto_pagar": monto_pagar,
            "deposito_id": deposito_id
            }
        })
          .done(function( msg ) {
            console.log( msg );
            if (msg.estado == "ok") {
                alert('Pago validado');
                window.location.replace("{{ url('excelpagos') }}");
            }
            else {
                alert('El Pago no se valido');
            }
        }).fail(function (msg){
            console.log('Fail');
            console.log(msg);
        });
    });
    $('#rechazar').click(function(event) {
        /* Act on the event */
        event.preventDefault();
        console.log('rechazar');
        let spei = $('#spei').val();
        let cliente = $('#cliente').val();
        let fecha = $('#fecha').val();
        let contrato = $('#contrato').val();
        let referencia = $('#referencia').val();
        let monto_pagado = $('#monto_pagado').val();
        let monto_pagar = $('#monto_a_pagar').val();
        let deposito_id = $('#deposito_id').val();
        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });
        $.ajax({
          method: "POST",
          dataType: "json",
          url: "{{ route('depositoPagoRechazar') }}",
          data: {
            "spei": spei,
            "cliente": cliente,
            "fecha": fecha,
            "contrato": contrato,
            "referencia": referencia,
            "monto_pagado": monto_pagado,
            "monto_pagar": monto_pagar,
            "deposito_id": deposito_id
            }
        })
          .done(function( msg ) {
            console.log( msg );
            if (msg.estado == "fail") {
                alert('No se encontro un pago con los datos enviados');
            }
            else if(msg.estado == "ok"){
                alert('Se Rechazo el pago con exito');
            }
        })
          .fail(function (msg){
            console.log(msg);
        });
    });

</script>

@endsection
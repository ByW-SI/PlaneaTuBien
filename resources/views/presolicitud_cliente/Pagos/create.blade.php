@extends('principal')
@section('content')

<div class="container">
    <h3 class="text-center text-uppercase text-muted">💵 NUEVO PAGO</h3>
    <div class="card">
        <div class="card-body">
            <form
                action=""
                method="post" id="pay" name="pay">
                @csrf
                <input id="contrato_id" name="contrato_id" type="hidden" value="{{$mensualidad->contrato_id}}">

                <fieldset>
                    <div class="row">


                        {{-- DATOS PROSPECTO --}}

                        <div class="col-12 col-md-6 mt-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 col-md-6 mt-2">
                                            <label class="text-muted text-uppercase" for="referencia">Prospecto</label>
                                            <input type="text" class="form-control" value="{{$prospecto->full_name}}"
                                                readonly>
                                        </div>
                                        <div class="col-12 col-md-6 mt-2">
                                            <label class="text-muted text-uppercase" for="referencia">Email</label>
                                            <input type="text" class="form-control" value="{{$prospecto->email}}"
                                                readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- IDENTIFICADORES PAGO --}}

                        <div class="col-12 col-md-6 mt-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 col-md-6 mt-2">
                                            <label class="text-muted text-uppercase" for="referencia">Mes</label>
                                            <input type="text" class="form-control" step="any" min="0"
                                                value="{{$mensualidad->fecha}}" name="referencia" id="referencia">
                                        </div>
                                        <div class="col-12 col-md-6 mt-2">
                                            <label class="text-muted text-uppercase" for="folio">Folio</label>
                                            <input type="text" class="form-control" step="any" min="0"
                                                value="{{$folio}}" name="folio" id="folio" readonly="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- DATOS PAGO --}}

                        <div class="col-12 col-md-12 mt-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">

                                        {{-- CONTENEDOR INPUT FORMA PAGO --}}
                                        <div class="col-12 col-md-6 mt-2">
                                            <label class="text-muted text-uppercase" for="forma">Forma de Pago</label>
                                            <select name="forma" id="forma" class="form-control" required="">
                                                <option value="">Seleccionar una opción</option>
                                                <option value="Efectivo">Efectivo</option>
                                                <option value="Depósito">Depósito</option>
                                                <option value="Cheque">Cheque</option>
                                                <option value="Tarjeta de Crédito">Tarjeta de Crédito</option>
                                                <option value="Tarjeta de Débito">Tarjeta de Débito</option>
                                                <option value="Transferencia">Transferencia</option>
                                                <option value="Mercado Pago">Mercado Pago</option>
                                            </select>
                                        </div>

                                        {{-- CONTENEDOR MONTO --}}
                                        <div class="col-12 col-md-6 mt-2">
                                            <label class="text-muted text-uppercase" for="monto">Monto</label>
                                            <div class="input-group">
                                                <div class="input group-prepend">
                                                    <span class="input-group-text">$</span>
                                                </div>
                                                <input type="number" class="form-control" step="any" value="0.00"
                                                    id="inputMonto"
                                                    min="1"
                                                    name="monto" id="monto" required="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                       
                    
                    <div class="row" id="grupoInputsMercadoPago" style="display:none">
                        <div class="col-12">
                            <hr>
                        </div>
                        <div class="col-12 col-md-4 mt-2">
                            <label for="email" class="text-uppercase text-muted">Correo</label>
                            <input type="email" id="email" name="email" value="{{$prospecto->email}}"
                                placeholder="your email" class="form-control" required />
                        </div>
                        <div class="col-12 col-md-4 mt-2">
                            <label for="cardNumber" class="text-uppercase text-muted">Número de tarjeta de
                                crédito:</label>
                            <input type="text" id="cardNumber" data-checkout="cardNumber"
                                placeholder="4509 9535 6623 3704" value="4509 9535 6623 3704"
                                onselectstart="return false" onpaste="return false" onCopy="return false"
                                onCut="return false" onDrag="return false" onDrop="return false" autocomplete=off
                                class="form-control" required minlength="6" />
                        </div>
                        <div class="col-12 col-md-4 mt-2">
                            <label for="securityCode" class="text-uppercase text-muted">Código de seguridad:</label>
                            <input type="text" id="securityCode" data-checkout="securityCode" placeholder="123"
                                value="123" onselectstart="return false" onpaste="return false" onCopy="return false"
                                onCut="return false" onDrag="return false" onDrop="return false" autocomplete=off
                                class="form-control" required minlength="3" />
                        </div>
                        <div class="col-12 col-md-4 mt-2">
                            <label for="cardExpirationMonth" class="text-uppercase text-muted">Mes de
                                expiración:</label>
                            <input type="text" id="cardExpirationMonth" data-checkout="cardExpirationMonth"
                                placeholder="11" value="11" onselectstart="return false" onpaste="return false"
                                onCopy="return false" onCut="return false" onDrag="return false" onDrop="return false"
                                autocomplete=off class="form-control" minlength="2" required />
                        </div>
                        <div class="col-12 col-md-4 mt-2">
                            <label for="cardExpirationYear" class="text-uppercase text-muted">Año de expiración:</label>
                            <input type="text" id="cardExpirationYear" data-checkout="cardExpirationYear"
                                placeholder="2025" value="2025" onselectstart="return false" onpaste="return false"
                                onCopy="return false" onCut="return false" onDrag="return false" onDrop="return false"
                                autocomplete=off class="form-control" minlength="4" maxlength="4" required />
                        </div>
                        <div class="col-12 col-md-4 mt-2">
                            <label for="cardholderName" class="text-uppercase text-muted">Nombre del titular:</label>
                            <input type="text" id="cardholderName" data-checkout="cardholderName" placeholder="APRO"
                                value="APRO" class="form-control" required />
                        </div>
                        {{-- <div class="col-12 col-md-4 mt-2">
                            <label for="docType" class="text-uppercase text-muted">Document type:</label>
                            <select id="docType" data-checkout="docType" class="form-control"></select>
                        </div> --}}
                        {{-- <div class="col-12 col-md-4 mt-2">
                            <label for="docNumber" class="text-uppercase text-muted">Document number:</label>
                            <input type="text" id="docNumber" data-checkout="docNumber" placeholder="12345678"
                                value="12345678" class="form-control" />
                        </div> --}}
                    </div>


                    <div class="col-12 col-md-12 mt-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 col-md-4">
                                            <label for="" class="text-uppercase text-muted">Total a pagar</label>
                                            <input type="text" id="inputTotalAPagar"
                                                value="{{$mensualidad->cantidad}}"
                                                class="form-control" readonly>
                                        </div>
                                        <div class="col-12 col-md-4">
                                            <label for="" class="text-uppercase text-muted">Abono</label>
                                            <input name="montoMasComision" type="number" step="any" value="{{$mensualidad->abono}}"
                                                class="form-control" id="inputMontoPagadoMasComision" readonly>
                                        </div>
                                        <div class="col-12 col-md-4">
                                            <label for="" class="text-uppercase text-muted">Restante</label>
                                            <input type="text" value="{{$mensualidad->cantidad-$mensualidad->abono}}" class="form-control" readonly
                                                id="inputRestante">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-md-12 text-center">
                                                <input type="hidden" name="amount" id="amount" />
                                                <input type="hidden" name="description" />
                                                <input type="hidden" name="paymentMethodId" />
                                                <input type="submit" value="Pagar" class="btn btn-success" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    

                    
                    <br><br>
                    
                </fieldset>



            </form>
        </div>
    </div>
</div>

@endsection
@push('scripts')

<script src="https://secure.mlstatic.com/sdk/javascript/v1/mercadopago.js"></script>

<script type="text/javascript">
    class Pago{
        static getMonto(){
            return parseFloat($("#inputMonto").val())
        }

        static getTotalAPagar(){
            return parseFloat( $('#inputTotalAPagar').val() )
        }

        static getRestante(){
            return this.getTotalAPagar() - this.getMonto()
        }

        static actualizarRestante(){
            $('#inputRestante').val( this.getRestante().toFixed(2) )
        }
    }

    class Comision {

        static getCobroComision(){
            const MONTO = $('#inputMonto').val();

            if( $('#forma').val() == 'Mercado Pago' ){
                return MONTO * 0.10
            }

            return 0

        }

        static actualizar(){
            const total = (Pago.getMonto() + this.getCobroComision()).toFixed(2)
            $('#inputMontoPagadoMasComision').val( total )
        }

    }

    // ==========================
    // OBTENCION DE CLAVE PUBLICA
    // ==========================

    window.Mercadopago.setPublishableKey("{{getenv('MERCADO_PAGO_PUBLIC_KEY')}}");


    // ============================
    // OBTENCIÓN DEL METODO DE PAGO
    // ============================

    function addEvent(to, type, fn){ 
            if(document.addEventListener){
                to.addEventListener(type, fn, false);
            } else if(document.attachEvent){
                to.attachEvent('on'+type, fn);
            } else {
                to['on'+type] = fn;
            }  
        }; 

    addEvent(document.querySelector('#cardNumber'), 'keyup', guessingPaymentMethod);
    addEvent(document.querySelector('#cardNumber'), 'change', guessingPaymentMethod);

    function getBin() {
    const cardnumber = document.getElementById("cardNumber");
    return cardnumber.value.substring(0,6);
    };

    function guessingPaymentMethod(event) {
        var bin = getBin();

        if (event.type == "keyup") {
            if (bin.length >= 6) {
                window.Mercadopago.getPaymentMethod({
                    "bin": bin
                }, setPaymentMethodInfo);
            }
        } else {
            setTimeout(function() {
                if (bin.length >= 6) {
                    window.Mercadopago.getPaymentMethod({
                        "bin": bin
                    }, setPaymentMethodInfo);
                }
            }, 100);
        }
    };

    function setPaymentMethodInfo(status, response) {
        if (status == 200) {
            const paymentMethodElement = document.querySelector('input[name=paymentMethodId]');

            if (paymentMethodElement) {
                paymentMethodElement.value = response[0].id;
            } else {
                const input = document.createElement('input');
                input.setAttribute('name', 'paymentMethodId');
                input.setAttribute('type', 'hidden');
                input.setAttribute('value', response[0].id);     

                form.appendChild(input);
            }

            // Mercadopago.getInstallments({
            //  "bin": getBin(),
            //  "amount": parseFloat(document.querySelector('#amount').value),
            // }, setInstallmentInfo);

        } else {
            alert(`payment method info error: ${response}`);  
        }
    };


    // =========================
    // CAPTURAR DATOS DE TARJETA
    // =========================

    doSubmit = false;
addEvent(document.querySelector('#pay'), 'submit', doPay);
function doPay(event){
    event.preventDefault();
    if(!doSubmit){
        var $form = document.querySelector('#pay');

        window.Mercadopago.createToken($form, sdkResponseHandler); // The function "sdkResponseHandler" is defined below

        return false;
    }
};

function sdkResponseHandler(status, response) {

    console.log(
        JSON.stringify(response)
    );

    if (status != 200 && status != 201) {
        swal({
              title: "Error. Verifica que la información sea correcta en los campos solicitados.",
              text: "Causa: " + response.cause[0].description,
              icon: "warning",
              buttons: true,
              dangerMode: true,
              confirmButtonText: 'Autorizar',
            })
        // alert("verify filled data");

    }else{
        var form = document.querySelector('#pay');
        var card = document.createElement('input');
        card.setAttribute('name', 'token');
        card.setAttribute('type', 'hidden');
        card.setAttribute('value', response.id);
        form.appendChild(card);
        doSubmit=true;
        form.submit();
    }
};


    // ======================
    // RECIBIR PAGO EN CUOTAS
    // ======================

    // function setInstallmentInfo(status, response) {
    //     var selectorInstallments = document.querySelector("#installments"),
    //     fragment = document.createDocumentFragment();
    //     selectorInstallments.options.length = 0;

    //     if (response.length > 0) {
    //         var option = new Option("Escolha...", '-1'),
    //         payerCosts = response[0].payer_costs;
    //         fragment.appendChild(option);

    //         for (var i = 0; i < payerCosts.length; i++) {
    //             fragment.appendChild(new Option(payerCosts[i].recommended_message, payerCosts[i].installments));
    //         }

    //         selectorInstallments.appendChild(fragment);
    //         selectorInstallments.removeAttribute('disabled');
    //     }
    // };


    // ================================
    // MANEJO DE INPUTS DE MERCADO PAGO
    // ================================

    $(document).on('change', '#forma, #inputMonto', function(){
        Comision.actualizar()
        Pago.actualizarRestante()
    });

    $(document).on('change','#forma', function(){
        
        const formaPago = $("#forma").val();

        if( formaPago == "Mercado Pago" ){
            $("#grupoInputsMercadoPago").show('slow');
        }else{
            $("#grupoInputsMercadoPago").hide('slow');
        }

        console.log({
            formaPago
        });

    });

    // ==========================
    // 
    // ==========================

    $(document).ready( function(){
        Comision.actualizar()
        Pago.actualizarRestante()
        console.log( Pago.getRestante() )
    } );

    // ==========================
    // 
    // ==========================

    $("#forma").change(function(){
            var forma_pago = $("#forma").val();
            $("#div_banco").removeClass("col-12 col-md-4");
            $("#div_banco").empty();
            if(forma_pago == "Depósito"){
                var html = `<label for="banco">Banco</label>
                    <select name="banco" id="banco" class="form-control" required="">
                        <option value="">Seleccionar una opción</option>
                        @foreach ($bancos as $banco)
                            <option value="{{$banco->nombre}}" title="{{$banco->etiqueta}}">{{$banco->nombre}}</option>
                        @endforeach
                    </select>`;
                $("#div_banco").addClass("col-12 col-md-4");
                $("#div_banco").append(html);
            }
        });
        $("#monto").change(function(){
            setTotal(); 
        });
        $("#adeudo").change(function(){
            setTotal(); 
        });
        function setTotal() {
            var monto = parseFloat($("#monto").val());
            total = monto;
            $("#total").val(total);
        }
</script>

@endpush
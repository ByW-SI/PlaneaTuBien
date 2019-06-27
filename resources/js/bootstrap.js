
window._ = require('lodash');

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {
    window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('jquery');

    require('bootstrap');
} catch (e) {
	console.log('e',e);
}

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Next we will register the CSRF Token as a common header with Axios so that
 * all outgoing HTTP requests automatically have it attached. This is just
 * a simple convenience so we don't have to attach every token manually.
 */

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}
/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo'

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     encrypted: true
// });

$("#ahorro_cliente").change(function(){
    var valor = $("#ahorro_cliente").val();
    var planes = null;
    axios.get('../../../../../api/planes/'+valor).then(
        res=>{ planes = res.data.planes[0];
            switch (valor){
                case "0":
                    // console.log(planes);
                    $("#plan_cliente").val(planes.id);
                    cotizar();

                    break;
                case "5":
                    // console.log(planes);
                    $("#plan_cliente").val(planes.id);
                    cotizar();

                    break;
                case "10":
                    // console.log(planes);
                    $("#plan_cliente").val(planes.id);
                    cotizar();

                    break;
                case "20":
                    // console.log(planes);
                    $("#plan_cliente").val(planes.id);
                    cotizar();

                    break;
                case "30":
                    // console.log(planes);
                    $("#plan_cliente").val(planes.id);
                    cotizar();

                    break;
                case "40":
                    // console.log(planes);
                    $("#plan_cliente").val(planes.id);
                    cotizar();

                    break;
                
                default:
                    alert('ninguno');
                    break;

            }
    }).catch(err=>{
        console.log(err);
    });
    // alert(valor);
    

});
function cotizar() {
    // body...
    var descuento =$("#descuento_input").val();
    if (descuento == "") {
        descuento = 0;
    }
    var monto =$("#monto").val();
    var plan_id = $("#plan_cliente").val();
    $("#cotizador").empty();
    axios.get(`../../../../../api/cotizar/${monto}/${plan_id}/${descuento}`).then(res=>{
        var plan = res.data.plan;
        var html = `
        <div class="row">
            <div class="col-12 col-xs-12 col-md-4 col-lg-4 col-xl-4 form-group">
                <h4>${plan.nombre}</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-xs-12 col-md-4 col-lg-4 col-xl-4 form-group">
                <label for="monto">Monto a adjudicar</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">$</span>
                    </div>
                    <input class="form-control" type="text" id="monto_adjudicar" value="${plan.monto_adjudicar}" readonly="">
                </div>
            </div>
            <div class="col-12 col-xs-12 col-md-4 col-lg-4 col-xl-4 form-group">
                <label for="monto">Plazo</label>
                <div class="input-group mb-3">
                    <input class="form-control" type="text" id="monto_adjudicar" value="${plan.plazo}" readonly="">
                    <div class="input-group-append">
                        <span class="input-group-text" id="basic-addon1">Meses</span>
                    </div>
                </div>
            </div>
            <div class="col-12 col-xs-12 col-md-4 col-lg-4 col-xl-4 form-group">
                <label for="monto">${plan.mes_aportacion_adjudicado} mensualidades de</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">$</span>
                    </div>
                    <input class="form-control" type="text" id="monto_adjudicar" value="${plan.cuota_periodica_integrante}" readonly="">
                </div>
            </div>
        </div>
        <div class="row">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Aportación extraordinaria</th>
                        <th>Porcentaje</th>
                        <th>Monto</th>
                        <th>Mes</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-center">1</td>
                        <td class="text-center">${plan.aportacion_1}%</td>
                        <td class="text-center">$${plan.monto_aportacion_1}</td>
                        <td class="text-center">#${plan.mes_1}</td>
                    </tr>
                    <tr>
                        <td class="text-center">2</td>
                        <td class="text-center">${plan.aportacion_2}%</td>
                        <td class="text-center">$${plan.monto_aportacion_2}</td>
                        <td class="text-center">#${plan.mes_2}</td>
                    </tr>
                    <tr>
                        <td class="text-center">3</td>
                        <td class="text-center">${plan.aportacion_3}%</td>
                        <td class="text-center">$${plan.monto_aportacion_3}</td>
                        <td class="text-center">#${plan.mes_3}</td>
                    </tr>
                    <tr>
                        <td class="text-center">Liquidación</td>
                        <td class="text-center">${plan.aportacion_liquidacion}%</td>
                        <td class="text-center">$${plan.monto_aportacion_liquidacion}</td>
                        <td class="text-center">#${plan.mes_liquidacion}</td>
                    </tr>
                    <tr>
                        <td class="text-center">Anual</td>
                        <td class="text-center">${plan.anual}%</td>
                        <td class="text-center">$${plan.monto_aportacion_anual}</td>
                        <td class="text-center">Cada Diciembre</td>
                    </tr>
                    <tr>
                        <td class="text-center">Semestral</td>
                        <td class="text-center">${plan.semestral}%</td>
                        <td class="text-center">$${plan.monto_aportacion_semestral}</td>
                        <td class="text-center">Cada Junio y Diciembre</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="row">
            <div class="col-12 col-xs-12 col-md-3 col-lg-3 col-xl-3 form-group">
                <label for="monto">Monto total que pagarás</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">$</span>
                    </div>
                    <input class="form-control" type="text" value="${plan.monto_total}" readonly="">
                </div>
            </div>
            <div class="col-12 col-xs-12 col-md-3 col-lg-3 col-xl-3 form-group">
                <label for="monto">Costo anual de </label>
                <div class="input-group mb-3">
                    <input class="form-control" type="text" value="${plan.sobrecosto_anual}" readonly="">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">%</span>
                    </div>
                </div>
            </div>
            <div class="col-12 col-xs-12 col-md-3 col-lg-3 col-xl-3 form-group">
                <label for="monto">Inscripción </label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">3%</span>
                    </div>
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">$</span>
                    </div>
                    <input class="form-control" type="text" id="inscripcion_input" readonly="" name="inscripcion" value="${plan.monto_inscripcion_con_iva}" required>
                </div>
            </div>
        </div>`;
        $("#cotizador").append(html);
    }).catch(err=>{
        console.log(err);
    })
}
$("#descuento_input").change(function(){
    cotizar();
    

});
$("#monto").change(function(){
    cotizar();
});
$("#plan_cliente").change(function(){
    cotizar();
});

$(document).ready(function() {

        $('#propiedad').change(function() {
            calculate();
        });

        $('#ahorro').change(function() {
            var ahorro = $('#ahorro').val();
            plan = ahorro == '0' ? 'Tanda 36' : ahorro == '0.05' ? 'Tanda 12' : ahorro == '0.1' ? 'Tanda 6' : ahorro == '0.2' ? 'Tanda 3' : ahorro == '0.3' ? 'Tanda 2' : ahorro == '0.4' ? 'Tanda 1' : '';
            $('#plan').val(plan);
            $('#plazo').val(plan ? '120' : '');
            calculate();
        });

        $('#plan').change(function() {
            var plan = $('#plan').val();
            $('#plazo').val(plan ? '120' : '');
            calculate();
        });

        $("#promocion_select").change(function(){
            var promo_id = $("#promocion_select").val();
            axios.get(`../../../../../promocion/${promo_id}`).then(
                res=>{
                    if (res.data) {
                        let promocion = res.data.promocion;
                        $("#promocion_div").empty();
                        
                        let html = `
                        <div class="form-group col-sm-3">
                            <label>Monto:</label>
                             <div class="input-group">
                                <input class="form-control" value="${promocion.monto}" readonly="">    
                                <div class="input-group-append">
                                    <span class="input-group-text">${promocion.tipo_monto == "porcentaje" ? "%" : "MXN"}</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-5">
                            <label>Tipo de promoción:</label>
                            <span class="input-group-text" id="tipo_promo">${promocion.tipo_promocion.nombre}</span>
                        </div>
                        <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
                            <label>Valido:</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">De: </span>
                                </div>
                                <input type="text" class="form-control"  value="${promocion.valido_inicio}" readonly="">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">hasta:</span>
                                </div>
                                <input type="text" class="form-control" value="${promocion.valido_fin}" readonly="">
                            </div>
                        </div>
                        <div class="form-group col-sm-5">
                            <label>Tipo de promoción:</label>
                            <textarea class="form-control" readonly>${promocion.descripcion}</textarea>
                        </div>
                        `;
                        $("#promocion_div").append(html);
                    }
                    else{
                        $("#promocion_div").empty();
                    }
                }).catch(err=>$("#promocion_div").empty());
        });

    });

    function calculate() {
        var montoCont = $('#propiedad').val();
        var plan = $('#plan').val();
        var plazo = $('#plazo').val();
        if(!plan) {
            $('#mensualidades').hide();
            $('#table').hide();
            return ;
        }
        var meses = plan == 'Tanda 36' ? 36 : plan == 'Tanda 24' ? 24 : plan == 'Tanda 18' ? 18 : plan == 'Tanda 12' ? 12 : plan == 'Tanda 6' ? 6 : plan == 'Tanda 3' ? 3 : plan == 'Tanda 2' ? 2 : plan == 'Tanda 1' ? 1 : 0;
        var años = meses/12 > 0 ? meses/12 : 0;
        if(años < 1)
            años = 0;
        var numAct = años * 2;
        var montoAdj = (montoCont * Math.pow(1.03, numAct)).toFixed(2);
        $('#adjudicar').val(montoAdj.replace(/\d(?=(\d{3})+\.)/g, '$&,'));
        $('#mensualidadTexto').html('' + (meses + 1) + ' mensualidades de:');
        $('#mensualidades').show();
        $('#table').show();
        var aporExts = [];
        aporExts[0] = meses == 36 ? 0    : meses == 24 ? 0    : meses == 18 ? 0   : meses == 12 ? 0.05 : meses == 6 ? 0.1 : meses == 3 ? 0.2 : meses == 2 ? 0.3 : meses == 1 ? 0.4 : 0;
        aporExts[1] = meses == 36 ? 0.05 : meses == 24 ? 0.05 : meses == 18 ? 0.1 : meses == 12 ? 0    : meses == 6 ? 0   : meses == 3 ? 0   : meses == 2 ? 0   : meses == 1 ? 0   : 0;
        aporExts[2] = meses == 36 ? 0.1  : meses == 24 ? 0.1  : meses == 18 ? 0   : meses == 12 ? 0.1  : meses == 6 ? 0.1 : meses == 3 ? 0   : meses == 2 ? 0   : meses == 1 ? 0   : 0;
        aporExts[3] = meses == 36 ? 0.2  : meses == 24 ? 0.2  : meses == 18 ? 0.2 : meses == 12 ? 0.2  : meses == 6 ? 0.2 : meses == 3 ? 0.2 : meses == 2 ? 0.1 : meses == 1 ? 0   : 0;
        var aporExt = 0;
        for(i = 0; i < 4; i++)
            aporExt += aporExts[i];
        var montoFin = (montoCont * (1 - aporExt));
        var cuotaAdm = meses < 12 ? 0.002 : 0.001;
        var aporInt = 0;
        var ant = +(montoFin/120);
        var montoAdm = 0;
        var ant2 = +(montoFin*cuotaAdm);
        var iva = 0;
        var ant3 = ant2 * 0.16;
        var sv = 0;
        var ant4 = montoCont * 0.0006;
        var aportacion = 0;
        var ant6 = ant + ant2 + ant3 + ant4;
        var alt = meses == 1 ? 11 : 10;
        for(i = 11; i <= meses + alt; i++) {
            if(i % 6 == 0) {
                ant = +(ant * 1.03);
                ant2 = +(ant2 * 1.03);
                ant3 = +(ant3 * 1.03);
                ant4 = +(ant4 * 1.03);
                ant6 = +(ant + ant2 + ant3 + ant4);
            }
            aporInt = +(aporInt + ant);
            montoAdm = +(montoAdm + ant2);
            iva = +(iva + ant3);
            sv = +(sv + ant4);
            if(i != meses + 11)
                aportacion = +(aportacion + ant6);
        }
        aportacion = +(aportacion + ant6);
        aportacion = +(aportacion/(meses + 1));
        aporInt = +(aporInt/meses);
        $('#mensualidad').val(('' + aportacion.toFixed(2)).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
        var montoApExt = +(montoAdj * aporExt);
        var montoInt = +(aportacion * (meses + 1));
        var ant5 = montoAdj * 0.0004;
        var sd = 0;
        var aporAdj = 0;
        var aportacionA = 0
        if(meses < 6)
            ant6 = ant + ant2 + ant3 + ant4 + ant5;
        if(meses == 1)
            alt -= 1;
        for(i = meses + alt + 2; i <= 120 + alt; i++) {
            if(i % 6 == 0) {
                ant = +(ant * 1.03);
                ant2 = +(ant2 * 1.03);
                ant3 = +(ant3 * 1.03);
                ant4 = +(ant4 * 1.03);
                if(i != meses + alt + 2)
                    ant5 = +(ant5 * 1.03);
                ant6 = +(ant + ant2 + ant3 + ant4 + ant5);
            }
            aporAdj = +(aporAdj + ant);
            montoAdm = +(montoAdm + ant2);
            iva = +(iva + ant3);
            sv = +(sv + ant4);
            sd = +(sd + ant4);
            aportacionA = +(aportacionA + ant6);
            console.log('mes ' + (i) + ':\n\tAportación: ' + ant.toFixed(2) + '\n\tCuota Administración: ' + ant2.toFixed(2) + '\n\tIVA: ' + ant3.toFixed(2) + '\n\tSV: ' + ant4.toFixed(2) + '\n\tSD: ' + ant5.toFixed(2) + '\n\tTotal: ' + ant6.toFixed(2));
        }
        aporAdj = +((aportacionA)/(119 - meses));
        var montoCuoAdj = +(aporAdj * (120 - (meses + 1)));
        var inscripcion = montoCont * 1.16 * 0.03;
        var derecho = montoAdj * 0.025 * 1.16;
        var montoTotal = montoApExt + montoInt + montoCuoAdj + inscripcion + derecho;
        var sobrecosto = montoTotal / montoAdj - 1;
        var sobrecostoAnual = sobrecosto * 10;
        $('#total').val((montoTotal.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,')));
        $('#anual').val((sobrecostoAnual).toFixed(2));
        $('#inscripcion').val(inscripcion.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
        $('#porc1').html((aporExts[0] * 100) + '%');
        $('#porc2').html((aporExts[1] * 100) + '%');
        $('#porc3').html((aporExts[2] * 100) + '%');
        $('#porc4').html((aporExts[3] * 100) + '%');
        $('[name="porc1"]').val((aporExts[0] * 100) + '%');
        $('[name="porc2"]').val((aporExts[1] * 100) + '%');
        $('[name="porc3"]').val((aporExts[2] * 100) + '%');
        $('[name="porc4"]').val((aporExts[3] * 100) + '%');
        $('#monto1').html('$' + (montoAdj * aporExts[0]).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
        $('#monto2').html('$' + (montoAdj * aporExts[1]).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
        $('#monto3').html('$' + (montoAdj * aporExts[2]).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
        $('#monto4').html('$' + (montoAdj * aporExts[3]).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
        $('[name="monto1"]').val('$' + (montoAdj * aporExts[0]).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
        $('[name="monto2"]').val('$' + (montoAdj * aporExts[1]).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
        $('[name="monto3"]').val('$' + (montoAdj * aporExts[2]).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
        $('[name="monto4"]').val('$' + (montoAdj * aporExts[3]).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
        var aux2 = meses < 12 ? 6 / 3 : meses / 3;
        $('#mes1').html(aux2);
        $('#mes2').html(aux2 * 2);
        $('#mes3').html(aux2 * 3);
        $('[name="mes1"]').val(aux2);
        $('[name="mes2"]').val(aux2 * 2);
        $('[name="mes3"]').val(aux2 * 3);
        

    }


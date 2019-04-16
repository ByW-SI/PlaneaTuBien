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
                        <a class="nav-link active" href="{{ route('prospectos.cotizacions.index', ['prospecto' => $prospecto]) }}">Cotización</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="">CRM</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-4">
                        <h5>Datos de la Cotización:</h5>
                    </div>
                    <div class="col-sm-4 text-center">
                        <a href="{{ route('prospectos.cotizacions.index', ['prospecto' => $prospecto]) }}" class="btn btn-primary">
                            <i class="fa fa-bars"></i><strong> Lista de Cotizaciones</strong>
                        </a>
                    </div>
                </div>
            </div>
            <form action="{{ route('prospectos.cotizacions.store', ['prospecto' => $prospecto]) }}" method="post">
                {{ csrf_field() }}
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-xs-12 col-md-4 col-lg-4 col-xl-3 form-group">
                            <label for="monto">✱Valor de la propiedad</label>
                            <input class="form-control" type="number" name="monto" min="300000" max="20000000" step="50000" required="">
                        </div>
                        <div class="col-12 col-xs-12 col-md-4 col-lg-4 col-xl-3 form-group">
                            <label for="ahorro">✱Ahorro del cliente</label>
                            <select name="ahorro" id="ahorro_cliente" class="form-control" required="">
                                <option value="">Seleccionar</option>
                                <option value="0">0%</option>
                                <option value="0.05">5%</option>
                                <option value="0.1">10%</option>
                                <option value="0.2">20%</option>
                                <option value="0.3">30%</option>
                                <option value="0.4">40%</option>
                            </select>
                        </div>
                        <div class="col-12 col-xs-12 col-md-4 col-lg-4 col-xl-3 form-group">
                            <label for="plan">✱Plan</label>
                            <select name="plan" id="plan_cliente" class="form-control">
                                <option value="">Seleccionar</option>
                                @foreach ($planes as $plan)
                                    <option value="{{$plan->id}}">{{$plan->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 col-xs-12 col-md-4 col-lg-4 col-xl-3 form-group">
                            <label for="promocion">Promoción</label>
                            <select name="promocion" id="promocion" class="form-control">
                                <option value="">Seleccionar</option>
                                @foreach ($promociones as $promocion)
                                    <option value="{{$promocion->id}}">{{$promocion->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-4 offset-4 text-center">
                            <button type="submit" class="btn btn-success">
                                <i class="fa fa-check"></i> Guardar
                            </button>
                        </div>
                        <div class="col-sm-4 text-right text-danger">
                            ✱Campos Requeridos.
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">

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

</script>

@endsection
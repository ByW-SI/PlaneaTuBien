<table border="1" style="border-collapse: collapse;border: red 5px solid;">
    <thead>
    <tr>
        <th colspan="5" style="text-align: center;">DATOS GENERALES</th>
    </tr>
    </thead>
    @if($plan->abreviatura != "TD" && $plan->abreviatura != "PL" && $plan->abreviatura != "TC")
    <tbody>
        <tr>
            <td><b>Monto contratado</b></td>
            <td>${{number_format($monto,2) }}</td>
            <td></td>
            <td><b>Plazo</b></td>
            <td>{{ $plan->plazo }} meses</td>
        </tr>
        <tr>
            <td><b>Aportaciones extraordinarias</b></td>
            <td>{{ $res['aportaciones_extraordinarias'] }}%</td>
            <td></td>
            <td><b>Monto a financiar</b></td>
            <td>${{ number_format($res['monto_financiar'],2) }}</td>
        </tr>
        <tr>
            <td><b>Cuota de administración</b></td>
            <td>{{$plan->cuota_admon}}%</td>
            <td></td>
            <td><b>Monto a adjudicar</b></td>
            <td>${{ number_format($res['monto_adjudicar'],2) }}</td>
        </tr>
        <tr>
            <td><b>Aportación integrante</b></td>
            <td>${{ number_format($res['aportacion_integrante'],2) }}</td>
            <td></td>
            <td><b>Aportación adjudicado</b></td>
            <td>${{ number_format($res['aportacion_adjudicado'],2)}}</td>
        </tr>
        <tr>
            <td><b>Cuota periodica integrante</b></td>
            <td>${{ number_format($res['cuota_periodica_integrante'],2)}}</td>
            <td></td>
            <td><b>Cuota periodica adjudicado</b></td>
            <td>${{ number_format($res['cuota_periodica_adjudicado'],2)}}</td>
        </tr>
        <tr>
            <td><b>Total aportaciones en mensualidades</b></td>
            <td>${{ number_format($res['total_aportacion_en_mensualidades'],2)}}</td>
            <td></td>
            <td><b>Total aportaciones extraordinarias</b></td>
            <td>${{ number_format($res['total_aportaciones_en_extraordin'],2)}}</td>
        </tr>
        <tr>
            <td><b>Total de aportaciones</b></td>
            <td>${{ number_format($res['total_aportacion'],2)}}</td>
            <td></td>
            <td><b>Total de cuota de administración</b></td>
            <td>${{ number_format($res['total_cuota_administracion'],2)}}</td>
        </tr>
        <tr>
            <td><b>Monto de aportación extraordinaría 1</b></td>
            <td>${{ number_format($plan->monto_aportacion_1($monto),2) }}</td>
            <td></td>
            <td><b>Monto de aportación extraordinaría 2</b></td>
            <td>${{ number_format($plan->monto_aportacion_2($monto),2) }}</td>
        </tr>
        <tr>
            <td><b>Monto de aportación extraordinaría 3</b></td>
            <td>${{ number_format($plan->monto_aportacion_3($monto),2) }}</td>
            <td></td>
            <td><b>Monto de aportación liquidación</b></td>
            <td>${{ number_format($plan->monto_aportacion_liquidacion($monto),2) }}</td>
        </tr>
        <tr>
            <td><b>Monto de aportación anual</b></td>
            <td>${{ number_format($plan->monto_aportacion_anual($monto),2) }}</td>
            <td></td>
            <td><b>Monto de aportación semestral</b></td>
            <td>${{ number_format($plan->monto_aportacion_semestral($monto),2) }}</td>
        </tr>
        <tr>
            <td><b>Monto cuota periodica integrante</b></td>
            <td>${{ number_format($plan->monto_cuota_periodica_integrante($monto),2) }}</td>
            <td></td>
            <td><b>Monto cuota periodica adjudicado</b></td>
            <td>${{ number_format($plan->monto_cuota_periodica_adjudicado($monto),2) }}</td>
        </tr>
        <tr>
            <td><b>Monto derecho de adjudicación</b></td>
            <td>${{ number_format($plan->monto_derecho_adjudicacion($monto),2) }}</td>
            <td></td>
            <td><b>Monto total a pagar</b></td>
            <td>${{ number_format($plan->monto_total_pagar($monto),2) }}</td>
        </tr>
        <tr>
            <td><b>Inscripción</b></td>
            <td>${{ number_format($plan->monto_inscripcion_con_iva($monto),2) }}</td>
            <td></td>
            <td><b>Sobrecosto anual</b></td>
            <td>{{ number_format($plan->sobrecosto_anual($monto),2) }}%</td>
        </tr>
    </tbody>
    @elseif($plan->abreviatura == "TC" || $plan->abreviatura == "TD")
    <tbody>
        <tr>
            <td><b>Monto contratado:</b></td>
            <td>${{number_format($monto,2)}}</td>
            <td></td>
            <td><b>Plazo:</b></td>
            <td>{{ $plan->plazo }} meses</td>
        </tr>
        <tr>
            <td><b>Mensualidad Inicial:</b></td>
            <td>${{ number_format($res['cuota_periodica_integrante'],2) }}</td>
            <td></td>
            <td><b>Aportaciones extraordinarias</b></td>
            <td>{{ $res['aportaciones_extraordinarias'] }}%</td>
        </tr>
        <tr>
            <td><b>Monto a financiar</b></td>
            <td>${{ number_format($res['monto_financiar'],2) }}</td>
            <td></td>
            <td><b>Cuota de administración</b></td>
            <td>{{$plan->cuota_admon}}%</td>
        </tr>
        <tr>
            <td><b>Aportación integrante</b></td>
            <td>${{ number_format($res['aportacion_integrante'],2)}}</td>
            <td></td>
            <td><b>Cuota periodica integrante</b></td>
            <td>${{ number_format($res['cuota_periodica_integrante'],2)}}</td>
        </tr>
        <tr>
            <td><b>Total aportaciones en mensualidades</b></td>
            <td>${{ number_format($res['total_aportacion_en_mensualidades'],2)}}</td>
            <td></td>
            <td><b>Total aportaciones extraordinarias</b></td>
            <td>${{ number_format($res['total_aportaciones_en_extraordin'],2)}}</td>
        </tr>
        <tr>
            <td><b>Total de aportaciones</b></td>
            <td>${{ number_format($res['total_aportacion'],2)}}</td>
            <td></td>
            <td><b>Total de cuota de administración</b></td>
            <td>${{ number_format($res['total_cuota_administracion'],2)}}</td>

        </tr>
        <tr>
            <td><b>Monto de aportación extraordinaría 1</b></td>
            <td>${{ number_format($plan->monto_aportacion_1($monto),2) }}</td>
            <td></td>
            <td><b>Monto de aportación anual</b></td>
            <td>${{ number_format($plan->monto_aportacion_anual($monto),2) }}</td>
        </tr>
        <tr>
            <td><b>Monto total a pagar</b></td>
            <td>${{ number_format($plan->monto_total_pagar($monto),2) }}</td>
            <td></td>
            <td><b>Inscripción</b></td>
            <td>${{ number_format($plan->monto_inscripcion_con_iva($monto),2) }}</td>
        </tr>
        <tr>
            <td><b>Sobrecosto anual</b></td>
            <td>{{ number_format($plan->sobrecosto_anual($monto),2) }}%</td>
        </tr>
    </tbody>
    @elseif($plan->abreviatura == "PL")
    <div class="row">
        <tr>
            <td></td>
            <td></td>
            <td>Monto contratado:</td>
            <td>${{ number_format($monto, 2) }}</td>
        </tr>
    </div>
    @endif
</table>

@if($plan->abreviatura != "PL")
    <table class="table table-stripped table-bordered">
        <thead class="thead-dark">
            <tr>
                <th colspan="8" style="text-align: center;">Corrida financiera</th>
            </tr>
            <tr>
                <th class="center">#</th>
                <th class="center">Aportación</th>
                <th class="center">Aportación anual</th>
                <th class="center">Cuota de administración</th>
                <th class="center">IVA</th>
                <th class="center">Seguro de vida</th>
                <th class="center">Seguro de daños</th>
                <th class="center">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($res['corrida'] as $key=>$mes)
            <tr>
                <th class="center" scope="row">
                    {{$key+1}}
                </th>
                <td class="center">
                    ${{number_format($mes['aportacion'],2)}}
                </td>
                <td class="center">
                    @if($mes['mes'] === "12")${{number_format($mes['monto_anual'], 2)}} @else $0.00 @endif
                </td>
                <td class="center">
                    ${{number_format($mes['cuota_administracion'],2)}}
                </td>
                <td class="center">
                    ${{number_format($mes['iva'],2)}}
                </td>
                <td class="center">
                    ${{number_format($mes['sv'],2)}}
                </td>
                <td class="center">
                    ${{number_format($mes['sd'],2)}}
                </td>
                <td class="center">
                    @if($mes['mes'] === "12" && $plan->abreviatura === "TC")
                        ${{number_format($mes['total'] + $mes['monto_anual'],2)}}
                    @elseif($mes['mes'] === "12" && $plan->abreviatura !== "TC")
                        ${{number_format($mes['total'] + $mes['monto_anual'],2)}}
                    @else
                        ${{number_format($mes['total'],2)}}
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@else
    <table class="table table-striped">
        <thead class="thead-dark">
            <tr>
                <th colspan="5" style="text-align: center;">Posibles pagos</th>
            </tr>
            <tr>
                <th scope="col">Mínimo</th>
                <th scope="col">Posible 1</th>
                <th scope="col">Posible 2</th>
                <th scope="col">Posible 3</th>
                <th scope="col">Máximo</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>${{ number_format($res['minimo'], 2) }}</td>
                <td>${{ number_format($res['posible1'], 2) }}</td>
                <td>${{ number_format($res['posible2'], 2) }}</td>
                <td>${{ number_format($res['posible3'], 2) }}</td>
                <td>${{ number_format($res['maximo'], 2) }}</td>
            </tr>
        </tbody>
    </table>
@endif


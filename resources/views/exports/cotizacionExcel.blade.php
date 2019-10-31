<table border="1" style="border-collapse: collapse;border: red 5px solid;">
    <thead>
    <tr>
        <th colspan="5" style="text-align: center;">DATOS GENERALES</th>
    </tr>
    </thead>
    <tbody>
        <tr>
            <td>Monto contratado</td>
            <td>${{number_format($monto,2) }}</td>
            <td>Plazo</td>
            <td>{{ $plan->plazo }} meses</td>
        </tr>
        <tr>
            <td>Aportaciones extraordinarias</td>
            <td>{{ $res['aportaciones_extraordinarias'] }}%</td>
            <td>Monto a financiar</td>
            <td>${{ number_format($res['monto_financiar'],2) }}</td>
        </tr>
        <tr>
            <td>Cuota de administración</td>
            <td>{{$plan->cuota_admon}}%</td>
            <td>Monto a adjudicar</td>
            <td>${{ number_format($res['monto_adjudicar'],2) }}</td>
        </tr>
        <tr>
            <td>Aportación integrante</td>
            <td></td>
            <td>Aportación adjudicado</td>
            <td></td>
        </tr>
        <tr>
            <td>Cuota periodica integrante</td>
            <td></td>
            <td>Cuota periodica adjudicado TN18</td>
            <td></td>
        </tr>
        <tr>
            <td>Total aportaciones en mensualidades</td>
            <td></td>
            <td>Total aportaciones extraordinarias</td>
            <td></td>
        </tr>
        <tr>
            <td>Total de aportaciones</td>
            <td></td>
            <td>Total de cuota de administración</td>
            <td></td>
        </tr>
        <tr>
            <td>Monto de aportación extraordinaría 1</td>
            <td></td>
            <td>Monto de aportación extraordinaría 2</td>
            <td></td>
        </tr>
        <tr>
            <td>Monto de aportación extraordinaría 3</td>
            <td></td>
            <td>Monto de aportación liquidación</td>
            <td></td>
        </tr>
        <tr>
            <td>Monto de aportación anual</td>
            <td></td>
            <td>Monto de aportación semestral</td>
            <td></td>
        </tr>
        <tr>
            <td>Monto cuota periodica integrante</td>
            <td></td>
            <td>Monto cuota periodica adjudicado</td>
            <td></td>
        </tr>
        <tr>
            <td>Monto derecho de adjudicación</td>
            <td></td>
            <td>Monto total a pagar</td>
            <td></td>
        </tr>
        <tr>
            <td>Inscripción</td>
            <td></td>
            <td>Sobrecosto anual</td>
            <td></td>
        </tr>
    </tbody>
</table>

<table>
    <thead>
    <tr>
        <th colspan="5" style="text-align: center;">DATOS GENERALES</th>
    </tr>
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Email</th>
        <th>Email</th>
        <th>Email</th>
    </tr>
    </thead>
    <tbody>
    {{-- @foreach($users as $user) --}}
        <tr>
            <td colspan="5" style="text-align: center;">DATOS GENERALES</td>
        </tr>
        <tr>
            <td>{{ $plan->nombre }}</td>
            <td>{{ $plan->abreviatura }}</td>
            <td>{{ $plan->abreviatura }}</td>
            <td>{{ $plan->abreviatura }}</td>
            <td>{{ $plan->abreviatura }}</td>
        </tr>
    {{-- @endforeach --}}
    </tbody>
</table>

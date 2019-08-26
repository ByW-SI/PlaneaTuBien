<h3 class="text-center">CONTRATO PARA ASIGNAR EL PAGO</h3>
<small>
    <strong>
        El pago será asignado a la mensualidad actual del contrato 
        seleccionado.
    </strong>
</small>
<table class="table table-bordered table-striped" id="corrida">
    <thead>
        <tr>
            <th class="text-center" scope="col"># Contrato</th>
            <th class="text-center" scope="col">Monto</th>
            <th class="text-center" scope="col">Estado</th>
            <th class="text-center" scope="col">Accion</th>
        </tr>
    </thead>
    <tbody>
        @foreach($contratos as $contrato)
        <tr class="text-center">
            <td class="num_contrato_{{$contrato->id}}">{{$contrato->numero_contrato}}</td>
            <td>{{ $contrato->monto }}</td>
            <td>{{ $contrato->estado }}</td>
            <td>
                <button type="button" class="btn btn-warning asignar_contrato" contrato-id="{{$contrato->id}}">
                    <strong>Asignar contrato</strong>
                </button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
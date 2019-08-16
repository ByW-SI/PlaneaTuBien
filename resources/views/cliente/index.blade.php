@extends('layouts.cliente')
@section('content')
@if(\Session::has('status'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <h3>¡Completado!</h3> Tu pago se realizo con éxito.
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
@endif
    <div class="card">
        <div class="card-header">
            Bienvenid@ {{$cliente->nombre." ".$cliente->paterno." ".$cliente->materno}}
        </div>
        <div class="card-body">
            <div class="container">
                <div class="row">
                    <label class="col-1" style="left: 48%;"><i class="fas fa-walking"></i></label>
                    <label class="col-1" style="left: 88%;"><i class="fas fa-home"></i></label>                    
                </div>
                <div class="progress">
                  <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%"></div>
                </div>
            </div>
        </div>
        <div class="card-header">
            Precio total del bien:  ${{number_format($cliente->precio_inicial,2)}}
        </div>
        <div class="card body">
            <div class="row">
                <div class="col-12 text-center mt-3">
                    <label>
                        Próximo Pagos
                    </label>
                </div>
                <div class="col-6 offset-3 text-center mt-3">
                    <table class="table table-borderless">
                        <thead class="thead-dark">
                            <tr>
                                <th style="border-top-left-radius: 10px;">Contratos</th>
                                <th>A Pagar</th>
                                <th>Recargo</th>
                                <th style="border-top-right-radius: 10px;">Fecha Límite</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($cliente->contratos as $contrato)
                            @if ($contrato->checklist && $contrato->checklist->status && $contrato->checklist->firmas == 1)
                            <tr>
                                <td>
                                    Contrato de folio: @php(printf('%03d', $contrato->grupo->id)){{$contrato->numero_contrato}}
                                </td>
                                <td>
                                    ${{number_format($plan->corrida_meses_fijos($contrato->monto,$cotizacion->factor_actualizacion)['integrante']['total'],2)}}
                                </td>
                                <td>$0</td>
                                <td>{{ date("7/m/Y", strtotime("+1 month", strtotime(date('d-m-Y'))))}}</td>
                            </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    Corrida Financiera Para El Plan {{$plan->nombre}}
                </div>
                <div class="card-body">
                    <div class="col-sm-8 offset-2">
                    <table class="table table-bordered table-striped" id="corrida">
                        <thead>
                            <tr>
                                <th class="text-center" scope="col">#</th>
                                <th class="text-center" scope="col">Aportación</th>
                                <th class="text-center" scope="col">Cuota de Administración</th>
                                <th class="text-center" scope="col">IVA</th>
                                <th class="text-center" scope="col">Seguro de vida</th>
                                <th class="text-center" scope="col">Seguro de desastres</th>
                                <th class="text-center" scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($plan->cotizador($cotizacion->monto, $cotizacion->factor_actualizacion)['corrida'] as $key=>$fila)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ number_format($fila["aportacion"], 2) }}</td>
                                <td>{{ number_format($fila["cuota_administracion"],2 ) }}</td>
                                <td>{{ number_format($fila["iva"], 2) }}</td>
                                <td>{{ number_format($fila["sv"],2 ) }}</td>
                                <td>{{ number_format($fila["sd"], 2) }}</td>
                                <td>{{ number_format($fila["total"], 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                </div>
            </div>
        </div>
        <div>
        </div>
        <div class="card-footer">
            <div class="d-flex justify-content-center">
                <span>
                    Cualquier duda con nuestro servicio por favor comunicate a nuestro telefonos de atención al cliente: 4456-54546-45546. En donde con gusto atenderemos.
                </span>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>    
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            console.log($('#corrdia'));
            $('#corrida').DataTable();
        } );
    </script>
@endsection
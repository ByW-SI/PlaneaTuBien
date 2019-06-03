@extends('layouts.cliente')
@section('content')
    <div class="card">
        <div class="card-header">
            Bienvenid@ {{$cliente->nombre." ".$cliente->paterno." ".$cliente->materno}}
        </div>
        <div class="card-body">
            <div class="container">
                <div class="row">
                    <label class="col-1" style="left: 50%;"><i class="fas fa-walking"></i></label>
                    <label class="col-1" style="left: 90%;"><i class="fas fa-home"></i></label>
                  {{-- <label style="margin-left: 50%;"></i></label> --}}
                  {{-- <label style="margin-left: 100%;"></label> --}}
                    
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
                        Numeros de contratos: {{sizeof($cliente->recibo->contratos)}}
                    </label>
                    
                </div>
                @foreach ($cliente->recibo->contratos as $contrato)
                    @if ($contrato->checklist && $contrato->checklist->status && $contrato->checklist->firmas == 1)
                        {{-- expr --}}
                        <div class="col-6">
                            <div class="card">
                                <div class="card-header">
                                    Contrato de folio: @php(printf('%03d', $contrato->grupo->id)){{$contrato->numero_contrato}} con valor de {{number_format($contrato->monto,2)}}
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend w-50">
                                                    <span class="input-group-text form-control">
                                                        Fecha del proximo pago
                                                    </span>
                                                </div>
                                                <div class="input-group-prepend w-50">
                                                    <span class="input-group-text form-control">
                                                        {{ date("7/m/Y", strtotime("+1 month", strtotime(date('d-m-Y'))))}}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend w-50">
                                                    <span class="input-group-text form-control">
                                                        Aportación
                                                    </span>
                                                </div>
                                                <div class="input-group-prepend w-50">
                                                    <span class="input-group-text form-control">
                                                        ${{number_format($plan->corrida_meses_fijos($contrato->monto,$cotizacion->factor_actualizacion)['integrante']['aportacion'],2)}}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend w-50">
                                                    <span class="input-group-text form-control">
                                                        Cuota de Administración
                                                    </span>
                                                </div>
                                                <div class="input-group-prepend w-50">
                                                    <span class="input-group-text form-control">
                                                        ${{number_format($plan->corrida_meses_fijos($contrato->monto,$cotizacion->factor_actualizacion)['integrante']['cuota_administracion'],2)}}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend w-50">
                                                    <span class="input-group-text form-control">
                                                        IVA
                                                    </span>
                                                </div>
                                                <div class="input-group-prepend w-50">
                                                    <span class="input-group-text form-control">
                                                        ${{number_format($plan->corrida_meses_fijos($contrato->monto,$cotizacion->factor_actualizacion)['integrante']['iva'],2)}}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend w-50">
                                                    <span class="input-group-text form-control">
                                                        Seguro de vida
                                                    </span>
                                                </div>
                                                <div class="input-group-prepend w-50">
                                                    <span class="input-group-text form-control">
                                                        ${{number_format($plan->corrida_meses_fijos($contrato->monto,$cotizacion->factor_actualizacion)['integrante']['sv'],2)}}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend w-50">
                                                    <span class="input-group-text form-control">
                                                        Seguro de daños
                                                    </span>
                                                </div>
                                                <div class="input-group-prepend w-50">
                                                    <span class="input-group-text form-control">
                                                        ${{number_format($plan->corrida_meses_fijos($contrato->monto,$cotizacion->factor_actualizacion)['integrante']['sd'],2)}}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend w-50">
                                                    <span class="input-group-text form-control">
                                                        Total
                                                    </span>
                                                </div>
                                                <div class="input-group-prepend w-50">
                                                    <span class="input-group-text form-control">
                                                        ${{number_format($plan->corrida_meses_fijos($contrato->monto,$cotizacion->factor_actualizacion)['integrante']['total'],2)}}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="d-flex justify-content-center">
                                            <a href="#" class="btn btn-success btn-sm"><i class="fas fa-credit-card"> PAGAR</i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
        <div class="card-footer">
            <div class="d-flex justify-content-center">
                <span>
                    Cualquier duda con nuestro servicio por favor comunicate a nuestro telefonos de atención al cliente: 4456-54546-45546. En donde con gusto atenderemos.
                </span>
            </div>
        </div>
    </div>
@endsection
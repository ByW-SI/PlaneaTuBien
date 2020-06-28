@extends('principal')
@section('content')


<!-- Modal Actualizar Status-->
<div class="modal fade" id="actualizarStatus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form id="actualizar_status_id"  action="{{route('pago.realizados.actualizarStatus')}}" method="POST">
        {{ csrf_field() }}
        <input id="pago_id" name="pago_id" type="hidden" value="">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" >Actualizar status pago</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Nuevo status</label>
                        <select class="form-control" id="status" name="status">
                            @foreach($status as $statu)
                                <option value="{{$statu->id}}">{{$statu->nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="desde">Por:</label>
                        <input class="form-control" type="text" name="nombre" value="{{Auth::user()->name}}" readonly>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </div>

    </form>
</div>
<!--fin del modal-->
<!-- Modal ver Mas-->
<div class="modal fade" id="verVoucher" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form id="ver_voucher_id"  action="" method="POST">
        {{ csrf_field() }}
        <input id="pago_id" name="pago_id" type="hidden" value="">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" >Voucher</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img id="img_vaucher" class="card" src="" width="450px" height="400px" alt="">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </div>
            </div>
        </div>

    </form>
</div>
<!--fin del modal-->

<div class="container">
    @if (session('status'))
        <div class="row">
            <div class="col-12">
                <div class="alert alert-success">
                    {{session('status')}}
                </div>
            </div>
        </div>
    @endif
    <div class="card mb-5">
        {{-- Titulo de la seccion --}}
        <div class="card-header"><h3><strong>Pagos realizados</strong></h3></div>
        <div class="card-body">
            {{-- Buscador de pagos --}}
            <form action="{{route('pagos.realizados')}}" method="POST">
                @csrf
                <div class="row">
                    {{-- Fecha de inicio --}}
                <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label for="fechaInicio">De:</label>
                            <input type="date" class="form-control" name="fecha_inicio" id="fechaInicio" required>
                        </div>
                    </div>
                    {{-- Fecha final --}}
                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label for="fechaInicio">A:</label>
                            <input type="date" class="form-control" name="fecha_final" id="fechaFinal" required>
                        </div>
                    </div>
                    {{-- Botón para buscar --}}
                    <div class="col-12 col-md-4 mt-4">
                        <button type="submit" class="btn btn-success">Buscar</button>
                    </div>
                </div>
            </form>
            <hr>
            {{-- Tabla de pagos --}}
            @if ($pagos)
                <table class="table table-bordered table-striped" id="corrida">
                    <thead>
                        <tr>
                            <th class="text-center" scope="col">Referencia</th>
                            <th class="text-center" scope="col">Fecha</th>
                            <th class="text-center" scope="col">Cliente</th>
                            <th class="text-center" scope="col">Grupo/Contrato</th>
                            <th class="text-center" scope="col">Pago</th>
                            <th class="text-center" scope="col">Debio pagar</th>
                            <th class="text-center" scope="col">Status pagar</th>
                            <th class="text-center" scope="col">Cambiar status</th>
                            <th class="text-center" scope="col">Voucher</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pagos as $pago)
                        <tr class="text-center">
                            <td>{{$pago->referencia}}</td>
                            <td>{{$pago->fecha_pago}}</td>
                            <td>{{$pago->contrato->presolicitud->nombre." ".$pago->contrato->presolicitud->paterno." ".$pago->contrato->presolicitud->materno}}</td>
                            <td>{{$pago->contrato->grupo->id."/".$pago->contrato->numero_contrato}}</td>
                            <td>{{$pago->monto}}</td>
                            <td>{{$pago->mensualidad ? $pago->mensualidad()->first()->cantidad : 'N/D'}}</td>
                            <td>{{$pago->statusPago->nombre}}</td>
                            <td>
                                <button id="actualizarStatusBTN" type="button" class="btn btn-primary actualizarStatusBTN" data-toggle="modal" data-target="#actualizarStatus" value="{{$pago->id}}">
                                      Actualizar
                                </button>
                            </td>
                            <td>
                                <button id="verVoucherBTN" type="button" class="btn btn-primary " data-toggle="modal" data-target="#verVoucher"  onclick='cambiarImagenVoucher("{{$pago->id}}","{{$pago->voucher}}");'>
                                      Ver mas
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <hr>
                <div class="row">
                    <div class="col-12 col-md-3 text-center">
                        <strong>Total pagos</strong><br>
                        {{count($pagos)}}
                    </div>
                    <div class="col-12 col-md-3 text-center">
                        <strong>Total monto pagado</strong><br>
                        {{$total_monto_pagado}}
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

@endsection
@push('scripts')
    <script type="text/javascript">
        $(document).ready(function(){
            $(".actualizarStatusBTN").click(function(){
                $("#pago_id").val($(this).val());
                
            });

            $(".verVoucherBTN").click(function(){
                $("#img_vaucher").attr("src","image2.jpg");
                
            });

            
        });
        function cambiarImagenVoucher(pago,archivo){

            var Raiz="{{ url('/voucher/') }}";
            $("#img_vaucher").attr("src",Raiz.concat(pago,archivo));

        }

    </script>
@endpush


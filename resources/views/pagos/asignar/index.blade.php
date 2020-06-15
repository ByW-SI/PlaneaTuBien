@extends('principal')
@section('content')

<div class="container">
    @if (isset($status))
        <div class="row">
            <div class="alert alert-success">
                {{$status}}
            </div>
        </div>
    @endif
    {{-- Buscador de depositos efectivos --}}
    <form action="{{route('pagos.referencia.buscar')}}" method="POST" class="row">
        @csrf
        {{-- Input de fecha --}}
        <div class="col-12 col-md-3">
            <div class="form-group">
                <label for="fecha">Fecha de pago por dia</label>
                <input type="date" name="fecha" id="fechaD" class="form-control" required>
            </div>
        </div>
        <div class="col-12 col-md-3">
            <div class="form-group">
                <label for="fecha">Fecha de pago por mes</label>
                <input type="month" name="fecha" id="fechaM" class="form-control" required>
            </div>
        </div>
        {{-- Input de monto --}}
        <div class="col-12 col-md-3">
            <div class="form-group">
                <label for="monto">Monto pagado</label>
                <input type="number" name="monto" step="0.01" class="form-control" required>
            </div>
        </div>
        {{-- Botón de buscar --}}
        <div class="col-12 col-md-3">
            <div class="form-group">
                <br>
                <input type="submit" id="buscar" class="btn btn-success" value="Buscar">
            </div>
        </div>
    </form>
    {{-- Lista de los depositos efectivos sin referencia --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    Depositos efectivos
                </div>
                <div class="card-body">
                    {{-- Tabla de los depositos --}}
                    <div class="col-12">
                        <h3 class="text-center">DEPOSITO PARA ASIGNAR EL PAGO</h3>
                        <table class="table table-bordered table-striped" id="corrida">
                            <thead>
                                <tr>
                                    <th class="text-center" scope="col">#</th>
                                    <th class="text-center" scope="col">fecha</th>
                                    <th class="text-center" scope="col">Concepto</th>
                                    <th class="text-center" scope="col">Monto</th>
                                    <th class="text-center" scope="col">Accion</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($depositos_efectivos as $key => $deposito)
                                <tr class="text-center">
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $deposito->dia }}</td>
                                    <td>{{ $deposito->concepto }}</td>
                                    <td class="abono_{{$deposito->id}}">{{ number_format($deposito->abono, 2) }}</td>
                                    <td>
                                        <button type="button" class="btn btn-warning asignar_deposito" deposito-id="{{$deposito->id}}">
                                            <strong>Asignar pago</strong>
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <hr>
                    {{-- Tabla para de los cliente --}}
                    <div class="col-12" style="display:none" id="buscadorCliente">
                        @if ($clientes)
                            <h3 class="text-center">CLIENTE PARA ASIGNAR EL PAGO</h3>
                            <table class="table table-bordered table-striped" id="tablaClientes">
                                <thead>
                                    <tr>
                                        <th class="text-center" scope="col">#</th>
                                        <th class="text-center" scope="col">Nombre</th>
                                        <th class="text-center" scope="col">Apellido paterno</th>
                                        <th class="text-center" scope="col">Apellido materno</th>
                                        <th class="text-center">Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($clientes as $key => $cliente)
                                    <tr class="text-center">
                                        <td>{{ $key + 1 }}</td>
                                        <td class="nombre_{{$cliente->id}}">{{ $cliente->nombre }}</td>
                                        <td class="materno_{{$cliente->id}}">{{ $cliente->materno }}</td>
                                        <td class="paterno_{{$cliente->id}}">{{ $cliente->paterno }}</td>
                                        <td>
                                            <button type="button" class="btn btn-warning asignar_cliente" cliente-id="{{$cliente->id}}">
                                                <strong>Asignar cliente</strong>
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                    <hr>
                    {{-- Tabla de los contratos --}}
                    <div class="col-12" style="display:none" id="buscadorContratos">
                    </div>
                    {{-- Formulario de confirmación --}}
                    <hr>
                    <div class="col-12" style="display:none" id="formularioConfirmacion">
                            <div class="row">
                                {{-- input del deposito seleccionado --}}
                                <div class="col-12 col-md-4">
                                    <div class="form-group">
                                        <label for="deposito_id">Deposito</label>
                                        <input type="text" class="form-control" name="input_abono" id="input_abono" readonly>
                                    </div>
                                </div>
                                {{-- input del cliente --}}
                                <div class="col-12 col-md-4">
                                    <div class="form-group">
                                        <label for="cliente_id">Cliente</label>
                                        <input type="text" class="form-control" name="input_cliente" id="input_cliente" readonly>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="form-group">
                                        <label for="contrato_id">Contrato</label>
                                        <input type="text" class="form-control" name="input_contrato" id="input_contrato" readonly>
                                    </div>
                                </div>
                                <form action="{{route('pagos.deposito.store')}}" method="POST">
                                    @csrf
                                    <input type="hidden" class="form-control" name="deposito_id" id="deposito_id">
                                    <input type="hidden" class="form-control" name="cliente_id" id="cliente_id">
                                    <input type="hidden" class="form-control" name="contrato_id" id="contrato_id">
                                    <button type="submit" class="btn btn-success">
                                        <strong>CONFIRMAR</strong>
                                    </button>
                                </form>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>    
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" defer></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js" defer></script>
<script>
    $(document).ready(function() {
        $('#tablaClientes').DataTable();
        $('#corrida').DataTable();
    } );
</script>

<script>

    $(document).ready( function(){

        /**/

        $('.asignar_deposito').click( function(){
            
            const deposito_id = $(this).attr('deposito-id');
            $('#deposito_id').val(deposito_id);

            const abono = $('.abono_'+deposito_id).html();
            $('#input_abono').val(abono);

            $('#buscadorCliente').show('slow');
        } );

        /**/

        $('.asignar_cliente').click( async function(){

        const cliente_id = $(this).attr('cliente-id');
        $('#cliente_id').val(cliente_id);

        const nombre_cliente = $('.nombre_'+cliente_id).html();
        const paterno_cliente = $('.paterno_'+cliente_id).html();
        const materno_cliente = $('.materno_'+cliente_id).html();
        $('#input_cliente').val(nombre_cliente+" "+paterno_cliente+" "+materno_cliente);
        
        await $.ajax({
                url: "{{ url('cliente') }}/"+cliente_id+"/contratos",
                type: "GET",
                dataType: "html",
                success: function(res){
                    $('#buscadorContratos').html(res);
                    $('#buscadorContratos').show('slow');
                },
                error: function (){
                    alert('<div class="alert alert-danger">Ha ocurrido un error</div>');
                }
            });


            $('.asignar_contrato').click( function(){
                const contrato_id = $(this).attr('contrato-id');
                $('#contrato_id').val(contrato_id);
                const num_contrato = $('.num_contrato_'+contrato_id).html();
                $('#input_contrato').val(num_contrato);
                $('#formularioConfirmacion').show('slow');
            } );

        } );
    } );

</script>

@endsection